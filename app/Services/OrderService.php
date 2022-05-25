<?php

namespace App\Services;

use App\Contracts\FullRestInterface;
use App\Repositories\OrderRepository;
use App\Traits\ResponseAPI;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Support\Carbon;

class OrderService implements FullRestInterface{

    use ResponseAPI;

    protected $order;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->order = $orderRepository;
    }

    public function getAll(): JsonResponse
    {
        $data = $this->order->getAll([], 'id');

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
        $request = $this->order->getOne($id,[]);
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
        $data['order_date'] = Carbon::now();
        try {
            $this->order->insert($data);
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
                $this->order->update($data, $id);
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
                $this->order->delete($id);
                return $this->successDelete();
            }
            throw new NotFoundHttpException;
        } catch (\Exception $exception) {
            return $this->serverError($exception->getMessage());
        }
    }

}

