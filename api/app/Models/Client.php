<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    //
   use HasFactory;

   //nome da tabela
   protected $table = 'clientes';

   protected $fillable = [
       'nome',
       'email',
       'telefone',
       'endereco',
   ];

  //pediso do cliente
   public function orders()
   {
       return $this->hasMany(Order::class, 'cliente_id', 'id');
   }

}
