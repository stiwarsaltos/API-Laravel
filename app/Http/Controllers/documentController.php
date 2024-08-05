<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(Request $request){
        $documents = Document::all();
        return response()->json($documents);
    }

    public function filter(Request $request){
        $request->validate([
            'startDate'=>'nullable|date',
            'endDate'=>'nullable|date',
        ]);

        $query = Document::query();
        $startDate = new Carbon($request->query('startDate'));
        $endDate =  new Carbon($request->query('endDate'));

        if ($startDate) {
            $query->where('date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('date', '<=', $endDate);
        }

        $document = $query->get();
        return response()->json($document);
    }

    public function show($id){
        $document = Document::find($id);
        if($document){
            return response()->json($document);
        }
        return response()->json(['error' => 'Documento not found'], 404);
    }

    public function store(Request $request){
        $request->validate([
            'date' => 'required|date',
            'num' => 'required|string|max:255',
            'client_id' => 'required|string|max:255',
            'quantityProducts' => 'required|integer',
            'total' => 'required|numeric',
            'products' => 'required|array',
            'products.*.id' => 'required|integer',
            'products.*.name' => 'required|string|max:255',
            'products.*.quantity' => 'required|integer|min:0',
            'products.*.unitPrice' => 'required|numeric|min:0',
            'products.*.total' => 'required|numeric|min:0',
        ]);

        $customer = Customer::find($request->input('client_id'));
        if(!$customer){
            return response()->json(['error' => 'Customer not found'], 404);
        }

        $documentData = $request->all();
        $documentData['date'] = new \DateTime($documentData['date']);
        $documentData['client'] = $customer->toArray();
        $document = Document::create($documentData);
        return response()->json($document, 201);
    }

    public function update(Request $request, $id){
        $document = Document::find($id);
        if($document){
            $request->validate([
                'date' => 'required|date',
                'num' => 'required|string|max:9',
                'client_id' => 'required|string|max:255',
                'quantityProducts' => 'required|integer',
                'total' => 'required|numeric',
                'products' => 'required|array',
                'products.*.id' => 'required|integer',
                'products.*.name' => 'required|string|max:255',
                'products.*.quantity' => 'required|integer|min:0',
                'products.*.unitPrice' => 'required|numeric|min:0',
                'products.*.total' => 'required|numeric|min:0',
            ]);

            $customer = Customer::find($request->input('client_id'));
            if (!$customer) {
                return response()->json(['error' => 'Cliente no encontrado'], 404);
            }

            $documentData = $request->all();
            $documentData['date'] = new \DateTime($documentData['date']);
            $documentData['client'] = $customer->toArray();

            $document->update($documentData);
            return response()->json($document, 200);
        }
        return response()->json(['error' => 'Documento no encontrado'], 404);
    }

    public function destroy($id){
        $document = Document::find($id);
        if($document){
            $document->delete();
            return response()->json(['message'=>'Document deleted'], 204);
        }
        return response()->json(['error' => 'Document not found'], 404);
    }

}
