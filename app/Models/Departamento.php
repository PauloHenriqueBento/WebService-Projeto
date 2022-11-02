<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];

    protected $primaryKey = 'id';

    protected $table = "departamentos";

    public $incrementing = true;

    public $timestamp = false;
}
