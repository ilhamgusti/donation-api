<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;
use App\Http\Resources\KegiatanResource;
use App\Http\Transformers\KegiatanTransformer;
use App\Models\Kegiatan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Kegiatan::filter()->paginate($request->has('pageSize') ? $request->pageSize : 10);
        return KegiatanResource::collection($data->loadMissing(['user','panti']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKegiatanRequest $request)
    {
        if ($request->user()->tipe !== 0 || $request->user()->tipe !== 'Donatur') {
            return response()->json([
                'message' => 'Kamu tidak dapat akses untuk menambah kegiatan'
            ], 403);
        }
        DB::beginTransaction();
        try {
            $kegiatan = KegiatanTransformer::toInstance($request->validated());
            $request->user()->kegiatan()->save($kegiatan);
            DB::commit();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            DB::rollBack();
            return response()->json($ex->getMessage(), 409);
        }
        return (new KegiatanResource($kegiatan))
            ->additional([
                'meta' => [
                    'success' => true,
                    'message' => "Kegiatan saved"
                ]
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Kegiatan::findOrFail($id);
        return new KegiatanResource($data->loadMissing('panti'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKegiatanRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $kegiatan = KegiatanTransformer::toInstance($request->validated(),Kegiatan::findOrFail($id));
            $kegiatan->save();
            DB::commit();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            DB::rollBack();
            return response()->json($ex->getMessage(), 409);
        }
        return (new KegiatanResource($kegiatan))
            ->additional([
                'meta' => [
                    'success' => true,
                    'message' => "Kegiatan updated"
                ]
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Kegiatan::findOrFail($id);
        $data->delete();
        return response()->json([
            'message' => 'Delete Data Successfully'
        ]);
    }
}
