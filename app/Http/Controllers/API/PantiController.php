<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePantiRequest;
use App\Http\Requests\UpdatePantiRequest;
use App\Http\Resources\DonasiResource;
use App\Http\Resources\KegiatanResource;
use App\Http\Resources\PantiResource;
use App\Http\Transformers\PantiTransformer;
use App\Models\Donasi;
use App\Models\Kegiatan;
use App\Models\Panti;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PantiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->has('pageSize')) {
            $data = Panti::filter()->paginate($request->has('pageSize'));
        } else {
            $data = Panti::filter()->get();
        }

        return PantiResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePantiRequest $request)
    {

        // $validator->validate();
        if ($request->user()->tipe === 0 || $request->user()->tipe === 'Donatur') {
            return response()->json([
                'message' => 'Kamu tidak dapat akses untuk membuat panti'
            ], 403);
        }
        if ($request->user()->panti()->first()) {
            return response()->json([
                'message' => 'kamu tidak dapat membuat lebih dari satu panti'
            ], 403);
        };
        $panti = new Panti($request->all());

        $panti->ktp = URL::asset('storage/' . $request->ktp->store('images', 'public'));
        $panti->sertifikat = URL::asset('storage/' . $request->sertifikat->store('images', 'public'));
        $request->user()->panti()->save($panti);
        return new PantiResource($request->user()->panti);
        // $request->user()->panti()->create($request->all());
        // return $panti;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        if ($id === 'details') {
            if ($request->has('kegiatan')) {
                $data = Kegiatan::with('user')->where('pending', $request->query('kegiatan'))->where('panti_id', $request->$id)->get();
                return new KegiatanResource($data);
            } else if ($request->has('donasi')) {
                $data = Donasi::with('user')->where('pending', $request->query('donasi'))->where('panti_id', $request->$id)->get();
                return new DonasiResource($data);
            } else {
                $data = Panti::findOrFail($request->$id);
                if ($request->query('eventDate')) {
                    return Kegiatan::whereDate('hari_acara', $request->query('eventDate'))->where('panti_id', $request->id)->get();
                }
            }
        } else {
            if ($request->has('kegiatan')) {
                $data = Kegiatan::with('user')->where('pending', $request->query('kegiatan'))->where('panti_id', $id)->get();
                return new KegiatanResource($data);
            } else if ($request->has('donasi')) {
                $data = Donasi::with('user')->where('pending', $request->query('donasi'))->where('panti_id', $id)->get();
                return new DonasiResource($data);
            } else {
                $data = Panti::findOrFail($id);
                if ($request->query('eventDate')) {
                    return Kegiatan::with('panti')->with('user')->whereDate('hari_acara', $request->query('eventDate'))->where('panti_id', $id)->get();
                }
            }
        }
        return new PantiResource($data->loadMissing('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePantiRequest $request)
    {
        if ($request->user()->tipe === 'Donatur') {
            return response()->json([
                'message' => 'Kamu tidak dapat akses untuk mengubah panti'
            ], 403);
        }

        DB::beginTransaction();
        try {
            $panti = PantiTransformer::toInstance($request->validated(), $request->user()->panti);
            $panti->save();
            DB::commit();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            DB::rollBack();
            return response()->json($ex->getMessage(), 409);
        }

        return (new PantiResource($panti))
            ->additional([
                'meta' => [
                    'success' => true,
                    'message' => "Panti updated"
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->user()->tipe === 'Donatur') {
            return response()->json([
                'message' => 'Kamu tidak dapat akses untuk menghapus panti'
            ], 403);
        }
        $request->user()->panti()->delete();
        return response()->json([
            'message' => 'Delete Data Panti Successfully'
        ]);
    }
}
