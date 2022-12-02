<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'dataNasc', 'telefone', 'email', 'departamento_id', 'empresa_id'];

    protected $primaryKey = 'id';

    protected $table = "funcionarios";

    public $incrementing = true;

    public $timestamps = false;
}
