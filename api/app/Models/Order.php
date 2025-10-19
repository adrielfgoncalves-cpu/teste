<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'pedidos';
    protected $fillable = [
        'cliente_id',
        'total',
        'data_pedido',
    ];
    protected $casts = [
        'total' => 'decimal:2',
        'data_pedido' => 'date',
    ];

    //relacionamente com o cliente
    public function client()
    {
        return $this->belongsTo(Client::class, 'cliente_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'pedido_produto', 'pedido_id', 'produto_id')
                    ->withPivot('quantidade', 'preco_unitario', 'preco_total');
    }
}
