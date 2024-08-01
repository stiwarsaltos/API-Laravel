<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class customerController extends Controller
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
            'email'=>'required|email'
        ]);
        $customer = Customer::create($request->all());
        return response()->json($customer, 201);
    }
    public function update(Request $request, $id){
        $customer = Customer::find($id);
        if($customer){
            $request->validate([
                'identify'=>'sometimes|string',
                'name'=>'sometimes|string',
                'phone'=>'sometimes|string',
                'email'=>'sometimes|email',
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
