<?php

namespace App\Contracts;

use Illuminate\Http\JsonResponse;

interface FullRestInterface
{
    public function getAll(): JsonResponse;
    public function getOne(int $id): JsonResponse;
    public function create(array $data): JsonResponse;
    public function update(array $data, int $id): JsonResponse;
    public function delete(int $id): JsonResponse;
}
