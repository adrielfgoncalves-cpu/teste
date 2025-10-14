@extends('layouts.admin')
@section('content')   
    <div class='main-container'>
       <div class="content-title">
                <h1 class="page-title">Cadastrar Usuário</h1>
        </div>
        <form action="{{ route('user.add') }}" method="POST" class="form-container">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label" >Nome:</label>
                <input type="text" class="form-input" id="name" name="name" placeholder="Nome" 
                value="{{ old('name') }}" required>
            </div><br>
            <div class="mb-3">
                <label for="email" class="form-label" >Email:</label>
                <input type="email" class="form-input" id="email" name="email" placeholder="E-mail"  
                value="{{ old('email') }}" required>
            </div><br>
            <div class="mb-3">
                <label for="password">Senha:</label>
                <input type="password" class="form-input" id="password" name="password" placeholder="Senha"  
                value="{{ old('password') }}"  required>
            </div><br>
            <button type="submit" class="btn-success" >Cadastrar</button>
            <button type="button" class="btn-cancel" onclick="location.href='/'" >Cancelar </button>
            <br><br>
        <x-alert/>
        </form>
    </div>
</body>

@endsection