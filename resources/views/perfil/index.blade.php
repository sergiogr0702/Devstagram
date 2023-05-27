@extends('layouts.app')

@section('titulo', 'Editar perfil: ' . $user->username)


@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white p-6 shadow">
            <form class="md:mt-0 mt-10" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                        {{ session('mensaje') }}
                    </p>
                @endif

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                        Username
                    </label>
                    <input 
                        name="username" 
                        id="username" 
                        type="text"
                        placeholder="Nombre de usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}"
                    />

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                           {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input 
                        name="email" 
                        id="email" 
                        type="email"
                        placeholder="Correo electronico de usuario"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}"
                    />

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                           {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Contraseña actual
                    </label>
                    <input 
                        name="password" 
                        id="password" 
                        type="password"
                        placeholder="Contraseña actual para confirmar cambios"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                           {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="new_password" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nueva contraseña
                    </label>
                    <input 
                        name="new_password" 
                        id="new_password" 
                        type="password"
                        placeholder="Nueva contraseña para el usuario"
                        class="border p-3 w-full rounded-lg @error('new_password') border-red-500 @enderror"
                    />

                    @error('new_password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">
                           {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                        Imagen de perfil
                    </label>
                    <input 
                        name="imagen" 
                        id="imagen" 
                        type="file"
                        class="border p-3 w-full rounded-lg"
                        accept=".jpg, .jpeg, .png"
                    />

                <input 
                    type="submit" 
                    value="Guardar cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                            w-full uppercase font-bold p-3 text-white rounded-lg mt-5"
                />
                </div>
            </form>
        </div>
    </div>
@endsection