<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartamentoRequest;
use App\Models\Departamento;
use App\Http\Resources\DepartamentoResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/departamentos",
     *      operationId="getDepartamentoList",
     *      tags={"Departamentos"},
     *      summary="Retorna a lista de departamentos",
     *      description="Retorna o JSON da lista de Departamentos",
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso"
     *      )
     * )
     */
    public function index(Request $request)
    {
//        $empresas = Departamento::all();
        $query = Departamento::query();
        $mensagem = "Lista de Departamentos retornada";
        $codigoRetorno = 0;

        /**
         * Realizar o processo de Filtro
         */
        // Obtem o paramentro do filtro
        $filterParameter = $request->input("filtro");

        if($filterParameter == null){
            //Retorna todos os produtos e Default
            $mensagem = "Lista de empresa retornada completa";
            $codigoRetorno = 200;
        }else{
            //Obtem o nome do filtro e o criterio
            [$filterCriteria, $filterValue] = explode(":", $filterParameter);

            //Se o filtro está adequado
            if($filterCriteria == "nome"){
                //faz o Query onde o nome for igual ao passado
                $empresas = $query->where("nome", "=", $filterValue);
                $mensagem = "Lista departamento retornada - Filtrada";
                $codigoRetorno = 200;
            }else{
                //Usuario chamou um filtro que não existe, então não há nada a retornar
                $departamento = [];
                $mensagem = "filtro não aceito";
                $codigoRetorno = 406;
            }
        }

        if($codigoRetorno == 200){
            /**
             * Realizar o processo de ordenação
             */
            //Se há um input para ordenação
            if($request->input('ordenacao', '')){
                $sorts = explode(',', $request->input('ordenacao', ''));

                foreach($sorts as $sortColumn){
                    $sortDirection = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
                    $sortColumn = ltrim($sortColumn, '-');

                    //Transforma os nomes dos parametros em nomes dos campos do modelo
                    switch ($sortColumn){
                        case("nome");
                        $query->orderBy("nome", $sortDirection);
                        break;
                    }
                }
            }

            /**
             * Realiza o processo de paginação
             */
            $input = $request->input('pagina');
            if($input){
                $page = $input;
                $perPage = 2; //Registro por pagina
                $query->offset(($page-1) * $perPage)->limit($perPage);
                $departamento = $query->get();

                $recordsTotal = Departamento::count();
                $numberOfPages = ceil($recordsTotal / $perPage);

                $mensagem = $mensagem . "+ordenada";
            }

            //Se o processamento foi OK, retorna com base no criterio
            if($codigoRetorno == 200) {
                $departamento = $query->get();
                $response = response()->json([
                    'status' => 200,
                    'mensagem' => $mensagem,
                    'departamentos' => DepartamentoResource::collection($departamento)
                ], 200);
            } else {
                //Retorna o erro que ocorreu
                $response = response()->json([
                    'status' => 400,
                    'mensagem' => $mensagem,
                    'departamento' => $departamento
                ], 400);
            }
            return $response;
        }

//        return response()->json([
//            'status' => 200,
//            'mensagem' => 'Lista departamento retornada',
//            'empresas' => DepartamentoResource::collection($empresas)
//        ],200);
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
     * @OA\Post(
     *      path="/api/departamento",
     *      operationId="storeDepartamento",
     *      tags={"Departamentos"},
     *      summary="Cria uma nova departamento",
     *      description="Retorna o JSON com os dados da nova Departamento",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreDepartamentoRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso",
     *          @OA\JsonContent(ref="#/components/schemas/Departamento")
     *      )
     * )
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
     * @OA\Get(
     *      path="/api/departamentos/{id}",
     *      operationId="getDepartamentoById",
     *      tags={"Departamentos"},
     *      summary="Retorna a informação de um departamento",
     *      description="Retorna o JSON do departamento requisitada",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id da Departamento",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso"
     *      )
     * )
     */
    public function show($departamento_id)
    {
        $departamento = Departamento::find($departamento_id);

        if($departamento){
            return response() -> json([
                'status' => 200,
                'mensagem' => "Departamento retornado",
                'departamento' => new DepartamentoResource($departamento)
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'mensagem' => "Departamento não encontrada",
                'empresa' => []
            ],404);
        }
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
     * @OA\Patch(
     *      path="/api/departamentos/{id}",
     *      operationId="updateDepartamentos",
     *      tags={"Departamentos"},
     *      summary="Atualiza um Departamento existente",
     *      description="Retorna o JSON do Departamento atualizada",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id da Departamento",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreDepartamentoRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso"
     *      )
     * )
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
     * @OA\Delete(
     *      path="/api/departamentos/{id}",
     *      operationId="deleteDepartamento",
     *      tags={"Departamentos"},
     *      summary="Apaga uma departamento existente",
     *      description="Apaga uma Departamento existente e não há retorno de dados",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id da Empresa",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso",
     *          @OA\JsonContent()
     *      )
     * )
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
