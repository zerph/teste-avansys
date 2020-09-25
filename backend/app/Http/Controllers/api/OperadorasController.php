<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operadoras;

class OperadorasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operadoras = Operadoras::all();
        return response()->json($operadoras);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Operadoras::create($request->all())) {
            return response()->json(['message' => 'Criado com sucesso'], 200);
        } else {
            return response()->json(['message' => 'Não foi possível criar'], 406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operadora = Operadoras::findOrFail($id);
        return response()->json($operadora);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $operadora = Operadoras::findOrFail($id);
        if ($operadora->update($request->all())) {
            return response()->json($operadora);
        } else {
            return response()->json(['message' => 'Não foi possível atualizar'], 406);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $operadora = Operadoras::findOrFail($id);
        if ($operadora->delete()) {
            return response()->json(['message' => 'Excluído com sucesso'], 200);
        } else {
            return response()->json(['message' => 'Não foi possível excluir'], 406);
        }
    }
}
