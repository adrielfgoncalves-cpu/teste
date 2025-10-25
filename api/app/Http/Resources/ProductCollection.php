<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        //pega o total de registros de produtos
        $total_reg = Product::count();
        //retorna os dados da coleção e o total de registros
        return [
            'data' => $this->collection,
            'infos' => [
                'total_reg' => $total_reg,
            ],
        ];
    }
}
