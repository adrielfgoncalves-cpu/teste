<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order_Product extends Model
{
    use HasFactory;
    // nome da tabela
    protected $table = 'pedido_produto';

    protected $filelable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'preco_unitario',
        'preco_total',
    ];

    protected $casts = [
        'preco_unitario' => 'decimal:2',
        'preco_total' => 'decimal:2',
    ];

    //relacionamento com o pedido
    public function order()
    {
        return $this->belongsTo(Order::class, 'pedido_id', 'id'); 
    }

    //relacionamento com o produto
    public function product()
    {
        return $this->belongsTo(Product::class, 'produto_id', 'id');  
    }
}
