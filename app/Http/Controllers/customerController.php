<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return response()->json($customers);
    }
    public function show($id){
        $customer = Customer::find($id);
        if($customer){
            return response()->json($customer);
        }
        return response()->json(['message'=>'Customer not found'], 404);
    }
    public function store(Request $request){
        $request->validate([
           'identify'=>'required|string',
            'name'=>'required|string',
            'phone'=>'required|string',
            'email'=>'required|string'
        ]);
        $customer = new Customer();
        $customer->identify = $request->input('identify');
        $customer->name = $request->input('name');
        $customer->phone = $request->input('phone');
        $customer->email = $request->input('email');

        $customer->save();
        return response()->json($customer, 201);
    }
    public function update(Request $request, $id){
        $customer = Customer::find($id);
        if($customer){
            $request->validate([
                'identify'=>'sometimes|string',
                'name'=>'sometimes|string',
                'phone'=>'sometimes|string',
                'email'=>'sometimes|string',
            ]);
            $customer->update($request->all());
            return response()->json($customer, 200);
        }
        return response()->json(['message'=>'Customer not found'], 404);
    }
    public function destroy($id){
        $customer = Customer::find($id);
        if($customer){
            $customer->delete();
            return response()->json(['message' =>'Customer deleted'], 204);
        }
        return response()->json(['message'=>'Customer not found'], 404);
    }
}
