<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartamentoRequest;
use App\Models\Departamento;
use App\Http\Resources\DepartamentoResource;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Departamento::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista departamento retornada',
            'empresas' => DepartamentoResource::collection($empresas)
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartamentoRequest $request)
    {
        $empresa = new Departamento();

        $empresa->nome = $request->nome;
        $empresa->descricao = $request->descricao;

        $empresa->save();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Departamento criado',
            'empresa' => new DepartamentoResource($empresa)
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function show(Departamento $departamento)
    {
        //
        $departamento = Departamento::findOrFail($departamento->id);

        return response() -> json([
            'status' => 200,
            'mensagem' => "Departamento retornado",
            'departamento' => new DepartamentoResource($departamento)
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Departamento $departamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departamento  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDepartamentoRequest $request, Departamento $departamento)
    {
        $departamento = Departamento::find($departamento->id);
        $departamento->nome = $request->nome;
        $departamento->descricao = $request->descricao;
        $departamento->update();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Departamento atualizada',
            'empresa' => new DepartamentoResource($departamento)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departamento  $departamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departamento $departamento)
    {
        $departamento->delete();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Departamento apagada'
        ],200);
    }
}
