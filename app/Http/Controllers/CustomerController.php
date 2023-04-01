<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function show()
    {
        $customers = Customer::latest()->get();
        return view('customers', [
            "customers" => $customers
        ]);
    }
    public function showOne($id)
    {
        $customers = Customer::find($id);
        return view('edit-customer', [
            "customer" => $customers
        ]);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:5'
        ]);
        $input = $request->only('name');
        Customer::create($input);
        return redirect('customers');
    }
    public function delete($id)
    {
        try {
            Customer::find($id)->delete();
            return redirect('customers');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 400);
        }
    }
    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => 'required|min:5'
        ]);
        $input = $request->only('name');
        Customer::find($id)->update($input);
        return redirect('customers');
    }
}
