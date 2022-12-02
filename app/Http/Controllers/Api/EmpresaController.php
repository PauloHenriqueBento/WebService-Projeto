<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpresaRequest;
use App\Models\Empresa;
use App\Http\Resources\EmpresaResource;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Lista empresas retornada',
            'empresas' => EmpresaResource::collection($empresas)
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
    public function store(StoreEmpresaRequest $request)
    {
        $empresa = new Empresa();

        $empresa->nome = $request->nome;
        $empresa->CNPJ = $request->CNPJ;

        $empresa->save();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Empresa criada',
            'empresa' => new EmpresaResource($empresa)
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmpresaRequest $request, Empresa $empresa)
    {
        $empresa = Empresa::find($empresa->id);
        $empresa->nome = $request->nome;
        $empresa->CNPJ = $request->CNPJ;
        $empresa->update();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Empresa atualizada',
            'empresa' => new EmpresaResource($empresa)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return response()->json([
            'status' => 200,
            'mensagem' => 'Empresa apagada'
        ],200);
    }
}
