@extends('layouts.panel')

@section('title', 'Panel Admin')

@section('content')
<main>
        <div class="container-fluid px-4">
            <h1 class="mt-5" style="color: #212529"><strong>Bienvenido
            @auth
                {{ auth()->user()->name }}
            @endauth
            </strong>
        </h1>

        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">{{auth()->user()->level->name }}</li>
        </ol>
        <div class="row">
        @auth
        @if(auth()->user()->level_id == 1)

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-primary text-white shadow-lg h-100 card-lg">
                    <div class="card-body">
                        <h5 class="card-title">Categorías</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link fs-7" href="{{ route('admin.category.index') }}">Ver Categorías</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-warning text-white shadow-lg h-100 card-lg">
                    <div class="card-body">
                        <h5 class="card-title">Recomendaciones</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link fs-7" href="{{ route('admin.recommendation.index') }}">Ver Recomendaciones</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            @endif
            @endauth
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-success text-white shadow-lg h-100 card-lg">
                    <div class="card-body">
                        <h5 class="card-title">Servicios</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link fs-7" href="{{ route('admin.service.index') }}">Ver Servicios</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        @auth
        @if(auth()->user()->level_id == 1)
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-primary text-white shadow-lg h-100 card-lg">
                    <div class="card-body">
                        <h5 class="card-title">Especialistas</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link fs-7" href="{{ route('admin.specialist.index') }}">Ver Especialistas</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-warning text-white shadow-lg h-100 card-lg">
                    <div class="card-body">
                        <h5 class="card-title">Usuarios</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link fs-7" href="{{ route('admin.users.index') }}">Ver Usuarios</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card bg-success text-white shadow-lg h-100 card-lg">
                    <div class="card-body">
                        <h5 class="card-title">Especialidades</h5>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link fs-7" href="{{ route('admin.speciality.index') }}">Ver Especialidades</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        @endif
            @endauth
    </div>
</main>

@endsection
