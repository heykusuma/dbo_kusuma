<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseAPI
{
    public function coreResponse(string $message, int $code, bool $isSuccess = true): JsonResponse 
    {
        if ($isSuccess) {
            return response()->json([
                'status'  => true,
                'message' => $message,
                'code'    => $code
            ], $code);
        }

        return response()->json([
            'status' => false,
            'message' => $message,
            'code' => $code,
        ], $code);
    }

    protected function serverError(string $message, int $code = 500): JsonResponse
    {
        return $this->coreResponse($message, $code, false);
    }

    protected function successInsert(string $message = "Data berhasil ditambahkan", int $code = 201): JsonResponse 
    {
        return $this->coreResponse($message, $code, true);
    }

    protected function successUpdate(string $message = "Data berhasil diupdate", int $code = 200): JsonResponse 
    {
        return $this->coreResponse($message, $code, true);
    }

    protected function successGet($data): JsonResponse
    {
        return response()->json([
            'status'    => true,
            'message'   => 'Berhasil mengambil data',
            'code'      => 200,
            'data'      => $data
        ], 200);
    }

    protected function successGetOne($data): JsonResponse 
    {
        return response()->json([
            'status' => true,
            'code'   => 200,
            'data'   => $data
        ], 200);
    }

    protected function successDelete(string $message = "Data berhasil dihapus", int $code = 200): JsonResponse 
    {
        return $this->coreResponse($message, $code, true);
    }

    protected function error(string $message, $data): JsonResponse
    {
        return $this->coreResponse($message, 422, false, $data);
    }

    protected function errorLogin(string $message = "Username atau password salah", int $code = 401): JsonResponse 
    {
        return $this->coreResponse($message, $code, false);
    }

    protected function resToken($token, $tokenExpired): JsonResponse 
    {
        return response()->json([
            'token'         => $token,
            'token_type'    => 'bearer',
            'token expired' => $tokenExpired
        ], 200);
    }

}
