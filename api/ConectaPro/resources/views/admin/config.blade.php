@extends('layouts.panel')

@section('title', 'Config-Admin')

@section('content')
<main>
    <div class="container mt-3">
        <h1 class="mt-4">
            <a href="{{ route('admin') }}" style="color: #212529; text-decoration: none; margin-right: 10px;"><i class="fas fa-arrow-left"></i></a>
            Mis datos
        </h1>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="text-center">
            @if(auth()->user()->image)
                <img src="{{ asset('image/Perfil/' . auth()->user()->image) }}" alt="Foto de perfil" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            @else
                <img src="{{ asset('image/Perfil/Perfil.png') }}" alt="Foto de perfil por defecto" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-user me-1"></i>
                        Información Personal
                        <a href="#" id="editLink" class="float-end" style="margin-left: 10px;"><i class="fas fa-edit" style="color:#212529"></i></a>
                        <a href="#" id="closeForm" style="display: none;" class="float-end" ><i class="fas fa-times" style="color: red;"></i></a>
                    </div>
                    
                    <div class="card-body" id="userInfo">
                        <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
                        <p><strong>Apellido:</strong> {{ auth()->user()->surname }}</p>
                        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                        <p><strong>Celular:</strong> {{ auth()->user()->phone }}</p>
                        <p><strong>Rol:</strong> {{ auth()->user()->level->name }}</p>
                    </div>
                    <div class="card-body" id="editForm" style="display: none;">
                        <form action="" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                <label for="name">Nombre:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                                <label for="surname">Apellido:</label>
                                <input type="text" class="form-control" id="surname" name="surname" value="{{ auth()->user()->surname }}">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                                <label for="phone">Celular:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                                <label for="password">Contraseña:</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <label for="password_confirmation">Confirmar Contraseña:</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                <label for="image">Imagen:</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editLink = document.getElementById('editLink');
        const editForm = document.getElementById('editForm');
        const userInfo = document.getElementById('userInfo');
        const closeForm = document.getElementById('closeForm');

        editLink.addEventListener('click', function(event) {
            event.preventDefault();
            userInfo.style.display = 'none';
            editForm.style.display = 'block';
            closeForm.style.display = 'inline'; // Mostrar el icono de cierre al abrir el formulario de edición
        });

        closeForm.addEventListener('click', function(event) {
            event.preventDefault();
            userInfo.style.display = 'block';
            editForm.style.display = 'none';
            closeForm.style.display = 'none'; // Ocultar el icono de cierre al cerrar el formulario de edición
        });
    });
</script>

@endsection