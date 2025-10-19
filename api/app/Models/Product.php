<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'produtos';
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'estoque',
    ];
    protected $casts = [
        'preco' => 'decimal:2',
        'estoque' => 'integer',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'pedido_produto');
    }

    // retorna os pedidos relacionados ao produto
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'pedido_produto', 'produto_id', 'pedido_id');
    }

}
