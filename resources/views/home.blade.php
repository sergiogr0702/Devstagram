@extends('layouts.app')

@section('titulo', 'Página principal')

@section('contenido')

    <x-listar-post :posts="$posts"/>

@endsection