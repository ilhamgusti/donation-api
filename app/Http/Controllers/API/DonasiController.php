<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonasiRequest;
use App\Http\Resources\DonasiResource;
use App\Http\Transformers\DonasiTransformer;
use App\Models\Donasi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Donasi::filter()->paginate($request->has('pageSize') ? $request->pageSize:10);
        return DonasiResource::collection($data->loadMissing(['panti','kegiatan']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonasiRequest $request)
    {
        DB::beginTransaction();
        try {
            $donasi = DonasiTransformer::toInstance($request->validated());
            $request->user()->donasi()->save($donasi);
            DB::commit();
        } catch (Exception $ex) {
            Log::info($ex->getMessage());
            DB::rollBack();
            return response()->json($ex->getMessage(), 409);
        }
        return (new DonasiResource($donasi))
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
    public function show(Request $request,$id)
    {
        if($id === 'details') {
            $data = Donasi::findOrFail($request->$id);
        }else{
            $data = Donasi::findOrFail($id);
        }
        return new DonasiResource($data->loadMissing('user','panti'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
