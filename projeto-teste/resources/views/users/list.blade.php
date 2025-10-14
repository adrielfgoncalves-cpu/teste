@extends('layouts.admin')
@section('content')
    <div class="content-title">
                <h1 class="page-title">Lista de Usuários</h1>
        </div>
       
 <table class="border-collapse border border-gray-400 ...">
  <thead>
    <tr>
      <th class="border border-gray-300 ">Nome</th>
      <th class="border border-gray-300 ">Email</th>
      <th class="border border-gray-300 ">Ação</th>
    </tr>
  </thead>
  <tbody>
     @foreach ($users as $item)
        <tr>
             <td class="border border-gray-300 "> {{ $item->name }}</td>
       
            <td class="border border-gray-300 "> {{ $item->email }}</td>
       
            <td class="border border-gray-300 text-center">
                 <a href="{{ route('user.view', ['id' => $item->id]) }}">
                     <button type="button" class="btn-primary" >Editar</button>
                </a>                 
                             
                    <button type="button" class="btn-cancel" >Deletar</button>
                
            </td>
        </tr>    
    @endforeach

  </tbody>
</table>

@endsection