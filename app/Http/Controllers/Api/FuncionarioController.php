<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Resources\FuncionarioResource;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funcionarios = Funcionario::all();

        return response() -> json([
            'status' => 200,
            'mensagem' => 'lista retornada',
            'Lista de Funcionarios' => FuncionarioResource::collection($funcionarios)
        ], 200);
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
    public function store(StoreFuncionarioRequest $request)
    {
        $funcionario = new Funcionario();

        $funcionario->nome=$request->nome_do_funcionario;
        $funcionario->dataNasc=$request->dataNascimento;
        $funcionario->telefone=$request->telefone;
        $funcionario->email=$request->email;
        $funcionario->departamento_id=$request->departamento;
        $funcionario->empresa_id=$request->empresa;

        $funcionario->save();

        return response()-> json([
            'status' => 200,
            'msg' => 'Funcionario cadastrado com sucesso',
            'funcionario' => new FuncionarioResource($funcionario)
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFuncionarioRequest $request, Funcionario $funcionario)
    {

        $funcionario = Funcionario::find($funcionario->id);
        $funcionario->nome = $request->nome_do_funcionario;
        $funcionario->dataNasc = $request->dataNascimento;
        $funcionario->telefone = $request->telefone;
        $funcionario->email = $request->email;
        $funcionario->departamento_id = $request->departamento;
        $funcionario->empresa_id = $request->empresa;
        $funcionario->update();

        return response()-> json([
            'status' => 200,
            'msg' => 'Funcionario Atualizado com sucesso',
            'funcionario' => new FuncionarioResource($funcionario)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        return response() -> json([
            'status' => 200,
            'msg' => 'Funcionario apagado com sucesso'
        ],200);
    }
}
