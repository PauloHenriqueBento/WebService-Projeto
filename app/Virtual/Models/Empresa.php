<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *      title="Empresa",
 *      description="Modelo da Empresa",
 *      @OA\Xml(
 *          name="Empresa"
 *      )
 * )
 */
class Empresa
{
    /**
     * @OA\Property(
     *      title="ID",
     *      description="ID",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */

     private $id;

     /**
      * @OA\Property(
      *     title="nome da empresa",
      *     description="Nome da Empresa",
      *     example="Empresa"
      *)
      *@var string
      */

      public $nome;

      /**
      * @OA\Property(
      *     title="CNPJ da empresa",
      *     description="CNPJ da Empresa",
      *     example="Empresa"
      *)
      *@var integer
      */

      public $CNPJ;
}
