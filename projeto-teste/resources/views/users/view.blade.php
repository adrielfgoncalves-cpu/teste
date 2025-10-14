@extends('layouts.admin')
@section('content') 
    {{$users->id}}
    <br>
    {{$users->name}} 
    <br>
    {{$users->email}}
  
@endsection