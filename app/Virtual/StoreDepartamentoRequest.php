<?php


namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Requisicao para novo Departamento",
 *      description="Requisição enviada via Body para uma novo departamento",
 *      type="object",
 *      required={"nome"}
 * )
 */

class StoreDepartamentoRequest
{
    /**
     * @OA\Property(
     *      title="nome d departamento",
     *      description="Nome do novo Departamento",
     *      example="Nome"
     * )
     * @var string
     */

    public $nome;

    /**
     * @OA\Property(
     *      title="Descrição do departamento",
     *      description="descrição do novo departamento",
     *      example="lorem ipsum"
     * )
     * @var string
     */

    public $descricao;
}
