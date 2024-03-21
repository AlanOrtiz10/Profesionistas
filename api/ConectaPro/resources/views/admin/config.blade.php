@extends('layouts.panel')

@section('title', 'Perfil - Admin')

@section('content')
<main>
    <div class="container mt-3">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="card text-center">
            <div class="card-header">
                <h5 class="card-title">Mi Perfil</h5>
            </div>
            <div class="card-body">
                <img src="{{ asset('assets/users/' . auth()->user()->image) }}" alt="Foto de perfil" class="rounded-circle mb-4" style="width: 150px; height: 150px;">
                <h5 class="card-title">{{ auth()->user()->name }} {{ auth()->user()->surname }}</h5>
                <p class="card-text">{{ auth()->user()->email }}</p>
                <p class="card-text">{{ auth()->user()->phone }}</p>
                <p class="card-text"><small class="text-muted">Rol: {{ auth()->user()->level->name }}</small></p>
            </div>
            <div class="card-footer text-muted">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal"><i class="fas fa-edit me-1"></i>Editar Perfil</button>
            </div>
        </div>
    </div>
</main>

<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('editar-usuario', auth()->user()->id) }}" method="POST">
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
                        <div class="mb-3">
                            <img src="{{ asset('assets/users/' . auth()->user()->image) }}" alt="Imagen actual" class="img-thumbnail" style="max-width: 150px; max-height: 150px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
