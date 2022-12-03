<?php

namespace App\Http\Resources;

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
        return parent::toArray($request);
        return [

            'id' => $this->id,
            'nome' => $this->nome,
            'dataNasc' => $this->dataNasc,
            'telefone' => $this->telefone,
            'email' => $this->email,
            'departamento_id' => $this->departamento_id,
            'empresa_id' => $this->empresa_id
        ];
    }
}
