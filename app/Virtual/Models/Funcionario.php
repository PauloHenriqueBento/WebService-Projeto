<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *      title="Funcionario",
 *      description="Modelo do Funcionario",
 *      @OA\Xml(
 *          name="Funcionario"
 *      )
 * )
 */
class Funcionario
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
      *     title="nome do Funcionario",
      *     description="Nome do Funcionario",
      *     example="Matheus"
      *)
      *@var string
      */

      public $nome;

      /**
      * @OA\Property(
      *     title="Data de nascimento do Funcionario",
      *     description="Data de nascimento do Funcionario",
      *     example="Funcionario"
      *)
      *@var string
      */

      public $dataNasc;

      /**
      * @OA\Property(
      *     title="Telefone do Funcionario",
      *     description="Telefone do Funcionario",
      *     example="Funcionario"
      *)
      *@var string
      */

      public $telefone;

      
      /**
      * @OA\Property(
      *     title="Email do Funcionario",
      *     description="Email do Funcionario",
      *     example="Funcionario"
      *)
      *@var string
      */

      public $email;

            
      /**
      * @OA\Property(
      *     title="Id do departamento do Funcionario",
      *     description="Id do departamento do Funcionario",
      *     example="Funcionario"
      *)
      *@var string
      */

      public $departamento_id;

                  
      /**
      * @OA\Property(
      *     title="Id da empresa do Funcionario",
      *     description="Id da empresa do Funcionario",
      *     example="Funcionario"
      *)
      *@var string
      */

      public $empresa_id;
}
