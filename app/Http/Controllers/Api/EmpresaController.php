<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmpresaRequest;
use App\Models\Empresa;
use App\Http\Resources\EmpresaResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$empresas = Empresa::all();


        //ORDENAÇÃO
        /*$sortParameter = $request->input('ordenacao','nome');
        $sortDirection = Str::startsWith($sortParameter,'-') ? 'desc':'asc';
        $sortColumn = ltrim($sortParameter,'-');

        if($sortColumn == 'nome'){
            $empresas = Empresa::orderBy('nome', $sortDirection)->get();
        }else{
            $empresas = Empresa::all();
        }*/

        /*return response()->json([
            'status' => 200,
            'mensagem' => 'Lista empresas retornada',
            'empresas' => EmpresaResource::collection($empresas)
        ],200);*/


        //PAGINAÇÃO
        //Captura a entrada a pagina
        /*$input = $request->input('pagina');

        //Monta a query com e sem paginação
        $query = Empresa::query();
        if($input){
            $page = $input;
            $perPage = 2;//registros por pagina
            $query->offset(($page-1) * $perPage)->limit($perPage);
            $empresas = $query->get();

            $recordsTotal = Empresa::count();
            $numberOfPages = ceil($recordsTotal / $perPage);
            $response = response()->json([
                'status' => 200,
                'mensagem' => 'Lista de empresas restornada',
                'empresas' => EmpresaResource::collection($empresas),
                'meta' => [
                    'total_numero_de_registros' => (string) $recordsTotal,
                    'numero_de_registros_por_pagina' => (string) $perPage,
                    'numero_de_paginas' => (string) $numberOfPages,
                    'pagina_total' => $page
                ]
            ],200);
        }else{
            $empresas = $query->get();

            $response = response()->json([
            'status' => 200,
            'mensagem' => 'Lista de empresas retornada',
            'empresas' => EmpresaResource::collection($empresas)
            ],200);
        }
        return $response;*/

        //FILTRAGEM
        //Query padrão
        /*$query = Empresa::query();
        //Obtém o parametro do filtro
        $filterParameter = $request->input("filtro");

        if($filterParameter == null){
            $empresas = $query->get();

            $response = response()->json([
                'status' => 200,
                'mensagem' => 'Lista de empresas retornada',
                'empresas' => EmpresaResource::collection($empresas)
            ],200);
        }else{
            //Obtem o nome do filtro e o criterio
            [$filterCriteria, $filterValue] = explode(":", $filterParameter);

            if($filterCriteria == "nome"){
                $empresas = $query->where("nome","=",$filterValue)->get();

                $response = response()->json([
                    'status' => 200,
                    'mensagem' => 'Lista de empresas retornada filtrada',
                    'empresas' => EmpresaResource::collection($empresas)
                ],200);
            }/*else{
                $response = response()->json([
                    'status' => 406,
                    'mensagem' => 'Filtro não aceito',
                    'empresas' => []
                ],406);
            }/*
        }
        return ($response);*/

        //UNINDO ORDENAÇÃO, PAGINAÇÃO E FILTRO
        $query = Empresa::query();
        $mensagem = "Lista de empresas retornada";
        $codigoRetorno = 0;

        /*
         * Realiza processamento do filtro
         */
        //Obtem o parametro do filtro
        $filterParameter = $request->input("filtro");

        //Se não há nenhum parametro
        if($filterParameter == null){
            //Retorna todos os produtos e Default
            $mensagem = "Lista de empresas retornada completa";
            $codigoRetorno = 200;
        }else{
            //Obtem o nome do filtro e o criterio
            [$filterCriteria, $filterValue] = explode(":",$filterParameter);

            //se o filtro está adequado
            if($filterCriteria == "nome"){
                //faz query onde o nome for igual ao passado
                $empresas = $query->where("nome","=",$filterValue);
                $mensagem = "Lista empresas retornada - filtrada";
                $codigoRetorno = 200;
            }else{
                //Usuario chamou um filtro que não existe, então não há nada a retornar
                $empresas = [];
                $mensagem = "filtro não aceito";
                $codigoRetorno = 406;
            }
        }

        if($codigoRetorno == 200){
            /**
             * Realiza o processamento da ordenação
             */
            //Se há um input para ordenação
            if($request->input('ordenacao','')){
                $sorts = explode(',',$request->input('ordenacao',''));

                foreach($sorts as $sortColumn){
                    $sortDirection = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
                    $sortColumn = ltrim($sortColumn, '-');

                    //Transforma os nomes dos parametros em nomes dos campos do modelo
                    switch($sortColumn){
                        case("nome");
                        $query->orderBy('nome', $sortDirection);
                        break;
                    }
                }
            }

            /**
             * Realiza o processamento da paginação
             */
            $input = $request->input('pagina');
            if($input){
                $page = $input;
                $perPage = 2;//Registro por pagina
                $query->offset(($page-1) * $perPage)->limit($perPage);
                $empresas =$query->get();

                $recordsTotal = Empresa::count();
                $numberOfPages = ceil($recordsTotal / $perPage);

                $mensagem = $mensagem . "+ordenada";
            }

            //Se o processamento foi OK, retorna com base no criterio
            if($codigoRetorno == 200){
                $empresas = $query->get();
                $response = response()->json([
                    'status' => 200,
                    'mensagem' => $mensagem,
                    'empresas' => EmpresaResource::collection($empresas)
                ],200);
            }else{
                //Retorna o erro que ocorreu
                $response = response()->json([
                    'status' => 406,
                    'mensagem' => $mensagem,
                    'empresas' => $empresas
                ],406);
            }
            return $response;
        }
    }
    //}

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
