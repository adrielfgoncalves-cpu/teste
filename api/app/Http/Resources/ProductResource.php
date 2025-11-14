<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //alterar para retornar os campos do produto
        return [
            'id' => $this->id,
            'Nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco != null ? 'R$ ' . number_format($this->preco, 2, ',', '.') : 'Não informado',
            'estoque' => $this->estoque,
            'orders' => $this->orders->count() > 0 ? $this->orders : ['Este produto não possui pedidos'],
        ];
    }
}
