<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests\StoreFuncionarioRequest;
use App\Http\Resources\FuncionarioResource;

class FuncionarioController extends Controller
{
    
    /**
     * @OA\Get(
     *      path="/api/funcionarios",
     *      operationId="getFuncionarioList",
     *      tags={"Funcionarios"},
     *      summary="Retorna a lista de Funcionarios",
     *      description="Retorna o JSON da lista de Funcionarios",
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso"
     *      )
     * )
     */
    public function index(Request $request)
    {
       //UNINDO ORDENAÇÃO, PAGINAÇÃO E FILTRO
       $query = Funcionario::query();
       $mensagem = "Lista de Funcionarios retornada";
       $codigoRetorno = 0;

       /*
        * Realiza processamento do filtro
        */
       //Obtem o parametro do filtro
       $filterParameter = $request->input("filtro");

       //Se não há nenhum parametro
       if($filterParameter == null){
           //Retorna todos os produtos e Default
           $mensagem = "Lista de Funcionarios retornada completa";
           $codigoRetorno = 200;
       }else{
           //Obtem o nome do filtro e o criterio
           [$filterCriteria, $filterValue] = explode(":",$filterParameter);

           //se o filtro está adequado
           if($filterCriteria == "nome"){
               //faz query onde o nome for igual ao passado
               $funcionarios = $query->where("nome","=",$filterValue);
               $mensagem = "Lista Funcionarios retornada - filtrada";
               $codigoRetorno = 200;
           }else{
               //Usuario chamou um filtro que não existe, então não há nada a retornar
               $funcionarios = [];
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
               $funcionarios = $query->get();

               $recordsTotal = Funcionario::count();
               $numberOfPages = ceil($recordsTotal / $perPage);

               $mensagem = $mensagem . "+ordenada";
           }

           //Se o processamento foi OK, retorna com base no criterio
           if($codigoRetorno == 200){
               $funcionarios = $query->get();
               $response = response()->json([
                   'status' => 200,
                   'mensagem' => $mensagem,
                   'empresas' => FuncionarioResource::collection($funcionarios)
               ],200);
           }else{
               //Retorna o erro que ocorreu
               $response = response()->json([
                   'status' => 406,
                   'mensagem' => $mensagem,
                   'empresas' => $funcionarios
               ],406);
           }
           return $response;
       }
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
     *      path="/api/funcionarios",
     *      operationId="storeFuncionarios",
     *      tags={"Funcionarios"},
     *      summary="Cadastra um novo funcionario",
     *      description="Retorna o JSON com os dados do novo funcionario",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreFuncionarioRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso",
     *          @OA\JsonContent(ref="#/components/schemas/Funcionario")
     *      )
     * )
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
     * @OA\Get(
     *      path="/api/funcionarios/{id}",
     *      operationId="getFuncionarioById",
     *      tags={"Funcionarios"},
     *      summary="Retorna a informação de um Funcionario",
     *      description="Retorna o JSON do funcionario requisitado",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id do Funcionario",
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
    public function show(Funcionario $funcionario)
    {
        $funcionario = Funcionario::find($funcionario->id);

        if($funcionario){
            return response()->json([
                'status' => 200,
                'mensagem' => "Funcionario retornada",
                'funcionario' => new FuncionarioResource($funcionario)
            ],200);
        }else{
            return response()->json([
                'status' => 406,
                'mensagem' => "Funcionario não encontrado",
                'funcionario' => []
            ],406);
        }
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
     * @OA\Patch(
     *      path="/api/funcionarios/{id}",
     *      operationId="updateFuncionario",
     *      tags={"Funcionarios"},
     *      summary="Atualiza um Funcionario existente",
     *      description="Retorna o JSON do Funcionario atualizado",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id do Funcionario",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreFuncionarioRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operação executada com sucesso"
     *      )
     * )
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
     * @OA\Delete(
     *      path="/api/funcionarios/{id}",
     *      operationId="deleteFuncionario",
     *      tags={"Funcionarios"},
     *      summary="Apaga um Funcionario existente",
     *      description="Apaga um Funcionario existente e não há retorno de dados",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id do Funcionario",
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
    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();

        return response() -> json([
            'status' => 200,
            'msg' => 'Funcionario apagado com sucesso'
        ],200);
    }
}
