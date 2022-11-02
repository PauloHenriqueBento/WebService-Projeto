<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'CNPJ'];

    protected $primaryKey = 'id';

    protected $table = "empresas";

    public $incrementing = true;

    public $timestamp = false;
}
