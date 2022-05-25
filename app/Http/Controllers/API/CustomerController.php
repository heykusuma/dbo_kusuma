<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customer;

    public function __construct(CustomerService $customerService)
    {
        $this->customer = $customerService;
    }

    public function index()
    {
        return $this->customer->getAll();
    }

    public function store(CustomerRequest $request)
    {
        $data = $request->validated();
        return $this->customer->create($data);
    }

    public function show($id)
    {
        return $this->customer->getOne($id);
    }

    public function update(CustomerRequest $request, $id)
    {
        $data = $request->validated();
        return $this->customer->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->customer->delete($id);
    }
}
