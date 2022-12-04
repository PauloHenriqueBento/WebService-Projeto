<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class FuncionarioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'nome' => $this->nome,
            'dataNasc' => $this->dataNasc,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'departamento' => $this->Departamento,
            'empresa' => $this->Empresa
        ];
    }
}
