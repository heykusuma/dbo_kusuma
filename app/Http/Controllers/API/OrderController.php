<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $order;

    public function __construct(OrderService $orderService)
    {
        $this->order = $orderService;
    }

    public function index()
    {
        return $this->order->getAll();
    }

    public function store(OrderRequest $request)
    {
        $data = $request->validated();
        return $this->order->create($data);
    }

    public function show($id)
    {
        return $this->order->getOne($id);
    }

    public function update(OrderRequest $request, $id)
    {
        $data = $request->validated();
        return $this->order->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->order->delete($id);
    }
}
