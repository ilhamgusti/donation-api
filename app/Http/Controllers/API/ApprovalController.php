<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateApprovalRequest;
use App\Http\Resources\PantiResource;
use App\Http\Transformers\PantiTransformer;
use App\Models\Panti;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->tipe === 2 || $request->user()->tipe === 'Admin') {
            if ($request->has('pageSize')) {
                $data = Panti::where('isVerified_ktp', 0)->orWhere('isVerified_sertifikat', 0)->paginate($request->has('pageSize'));
            } else {
                $data = Panti::where('isVerified_ktp', 0)->orWhere('isVerified_sertifikat', 0)->get();
            }

            return PantiResource::collection($data);
        } else {
            return response()->json([
                'message' => 'Kamu tidak dapat akses untuk melihat list panti yang belum di verifikasi'
            ], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApprovalRequest $request, $id)
    {
        if ($request->user()->tipe !== 2 || $request->user()->tipe !== 'Admin') {
            return response()->json([
                'message' => 'Kamu tidak dapat akses untuk verifikasi panti'
            ], 403);
        }

        DB::beginTransaction();
        try {
            $panti = PantiTransformer::toInstance($request->validated(), Panti::where('id', $id)->firstOrFail());
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
                    'message' => "Panti verified"
                ]
            ]);
    }
}
