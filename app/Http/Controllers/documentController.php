<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class documentController extends Controller
{
    public function index(){
        $documents = Document::all();
        return response()->json($documents);
    }
    public function show($id){
        $documents = Document::find($id);
        if($documents){
            return response()->json($documents);
        }
        return response()->json(['error' => 'Documento no encontrado'], 404);
    }
    public function store(Request $request){
        $request->validate([
           'date'=>'required|date',
            'number'=>'required|string',
            'client'=>'required|string',
            'products'=>'required|numeric',
            'total'=>'required|numeric',
            'products.*'=>'required|array',
            'products.*.id'=>'required|numeric',
            'products.*.name'=>'required|string',
            'products.*.quantity'=>'required|numeric',
            'products.*.unitPrice'=>'required|numeric',
            'products.*.total'=>'required|numeric',
        ]);
        $document = Document::create($request->all());
        return response()->json($document, 201);
    }
    public function update(Request $request, $id){
        $documents = Document::find($id);
        if($documents){
            $request->validate([
                'date'=>'required|date',
                'number'=>'required|string',
                'client'=>'required|string',
                'products'=>'required|numeric',
                'total'=>'required|numeric',
                'products.*'=>'required|array',
                'products.*.id'=>'required|numeric',
                'products.*.name'=>'required|string',
                'products.*.quantity'=>'required|numeric',
                'products.*.unitPrice'=>'required|numeric',
                'products.*.total'=>'required|numeric'
            ]);
            $documents->update($request->all());
            return response()->json($documents, 200);
        }
        return response()->json(['error' => 'Documento no encontrado'], 404);
    }
    public function destroy($id){
        $documents = Document::find($id);
        if($documents){
            $documents->delete();
            return response()->json(['message'=>'Document deleted'], 204);
        }
        return response()->json(['error' => 'Document not found'], 404);
    }
}
