<?php


namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Requisicao para nova Empresa",
 *      description="Requisição enviada via Body para uma nova Empresa",
 *      type="object",
 *      required={"nome"}
 * )
 */

 class StoreEmpresaRequest
 {
    /**
     * @OA\Property(
     *      title="nome da empresa",
     *      description="Nome da nova empresa",
     *      example="Nome"
     * )
     * @var string
     */

     public $nome;

     /**
     * @OA\Property(
     *      title="CNPJ da empresa",
     *      description="CNPJ da nova empresa",
     *      example="12345678901234"
     * )
     * @var integer
     */

    public $CNPJ;
 }
