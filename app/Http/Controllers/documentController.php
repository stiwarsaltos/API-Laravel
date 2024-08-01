<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index(){
        $documents = Document::all();
        return response()->json($documents);
    }

    public function show($id){
        $document = Document::find($id);
        if($document){
            return response()->json($document);
        }
        return response()->json(['error' => 'Documento no encontrado'], 404);
    }

    public function store(Request $request){
        $request->validate([
            'date'=>'required|date',
            'num'=>'required|string|max:255',
            'client'=>'required|string|max:255',
            'quantityProducts'=>'required|integer',
            'total'=>'required|numeric',
            'products'=>'required|array',
            'products.*.id'=>'required|integer',
            'products.*.name'=>'required|string|max:255',
            'products.*.quantity'=>'required|integer|min:0',
            'products.*.unitPrice'=>'required|numeric|min:0',
            'products.*.total'=>'required|numeric|min:0',
        ]);

        $document = Document::create($request->all());
        return response()->json($document, 201);
    }

    public function update(Request $request, $id){
        $document = Document::find($id);
        if($document){
            $request->validate([
                'date'=>'required|date',
                'num'=>'required|string|max:255',
                'client'=>'required|string|max:255',
                'quantityProducts'=>'required|integer',
                'total'=>'required|numeric',
                'products'=>'required|array',
                'products.*.id'=>'required|integer',
                'products.*.name'=>'required|string|max:255',
                'products.*.quantity'=>'required|integer|min:0',
                'products.*.unitPrice'=>'required|numeric|min:0',
                'products.*.total'=>'required|numeric|min:0',
            ]);

            $document->update($request->all());
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
