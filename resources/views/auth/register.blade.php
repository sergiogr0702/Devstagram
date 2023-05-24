@extends('layouts.app')

@section('titulo', 'Registrate en Devstagram')

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen registro de usuarios">
        </div>

        <div class="md:w-4/12 bg-white p-6 shadow-xl rounded-lg">
            <form>
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        placeholder="Tu nombre"
                        class="border p-3 w-full rounded-lg"    
                    >
                </div>
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        id="username" 
                        placeholder="Tu nombre de usuario"
                        class="border p-3 w-full rounded-lg"    
                    >
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Tu email de registro"
                        class="border p-3 w-full rounded-lg"    
                    >
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="Password de registro"
                        class="border p-3 w-full rounded-lg"    
                    >
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">
                        Repetir Password
                    </label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        placeholder="Repite tu password"
                        class="border p-3 w-full rounded-lg"    
                    >
                </div>

                <input 
                    type="submit" 
                    value="Crear cuenta"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                            w-full uppercase font-bold p-3 text-white rounded-lg"
                />
            </form>
        </div>
    </div>

@endsection