<?php

namespace App\Virtual\Models;

/**
 * @OA\Schema (
 *     title = "Departamento",
 *     description="Modelo de Departamento",
 *     @OA\Xml(
 *          name="Departamento"
 *      )
 * )
 */

class Departamento
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
     *     title="nome da departamento",
     *     description="Nome do departamento",
     *     example="Departamento"
     *)
     *@var string
     */

    public $nome;


    /**
     * @OA\Property(
     *     title="Descrição do departamento",
     *     description="descrição do departamento",
     *     example="Departamento"
     *)
     *@var string
     */

    public $descricao;
}
