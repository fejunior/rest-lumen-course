<?php

namespace App\Http\Controllers;

use App\Serie;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

abstract class BaseController
{
    protected $classe;


    public function index(Request $request)
    {
        // $offset = ($request->page - 1) * $request->per_page;


        return $this->classe::paginate($request->per_page);
    }

    public function store(Request $request)
    {

        return response()->json($this->classe::create($request->all()), 201);
    }

    public function show(int $id)
    {
        $recurso = $this->classe::find($id);

        if (is_null($recurso)) {
            return response()->json('', 204);
        }

        return response()->json($recurso);
    }

    public function update(int $id, Request $request)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json(["error" => "recurso naõ encontrado"], 404);
        }
        $recurso->fill($request->all());
        $recurso->save();

        return response()->json($recurso);
    }

    public function destroy(int $id)
    {

        $qtdRecursosRemovidos = $this->classe::destroy($id);
        if ($qtdRecursosRemovidos === 0) {

            return response()->json([
                "erro" => "Recurso não encontrado"
            ]);
        }

        return response()->json('', 204);
    }
}
