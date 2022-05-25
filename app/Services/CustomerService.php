<?php

namespace App\Services;

use App\Contracts\FullRestInterface;
use App\Repositories\CustomerRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CustomerService implements FullRestInterface{

    use ResponseAPI;

    protected $customer;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customer = $customerRepository;
    }

    public function getAll(): JsonResponse
    {
        $data = $this->customer->getAll([], 'id');

        if ($data->isEmpty()) {
            throw new NotFoundHttpException;
        }

        try {
            return $this->successGet($data);
        } catch (\Exception $exception) {
            return $this->serverError($exception->getMessage());
        }
    }

    public function getOne(int $id): JsonResponse
    {
        $request = $this->customer->getOne($id,[]);
        if (is_null($request)) {
            throw new NotFoundHttpException;
        }

        try {
            return $this->successGetOne($request);
        } catch (\Exception $exception) {
            return $this->serverError($exception->getMessage());
        }
    }

    public function create(array $data): JsonResponse
    {
        try {
            $this->customer->insert($data);
            return $this->successInsert();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function update(array $data, int $id): JsonResponse
    {
        $checkID = $this->getOne($id)->getData()->status;
        
        try {
            if ($checkID) {
                $this->customer->update($data, $id);
                return $this->successUpdate();
            }
            throw new NotFoundHttpException;
        } catch (\Exception $exception) {
            return $this->serverError($exception->getMessage());
        }
    }

    public function delete(int $id): JsonResponse
    {
        $checkID = $this->getOne($id)->getData()->status;
        
        try {
            if ($checkID) {
                $this->customer->delete($id);
                return $this->successDelete();
            }
            throw new NotFoundHttpException;
        } catch (\Exception $exception) {
            return $this->serverError($exception->getMessage());
        }
    }

}

