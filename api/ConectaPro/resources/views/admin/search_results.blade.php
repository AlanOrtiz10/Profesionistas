@extends('layouts.panel')

@section('title', 'Resultados de búsqueda')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-5" style="color: #212529">Resultados de búsqueda para: <strong>{{ $query }}</strong></h1>
        
        <!-- Mostrar mensaje de no hay resultados -->
        @if (empty($results))
            <div class="alert alert-warning" role="alert">
                No se encontraron resultados para "{{ $query }}".
            </div>
        @endif

        <!-- Mostrar resultados encontrados -->
        <div class="row">
            @foreach ($results as $card => $route)
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card bg-primary text-white shadow-lg h-100 card-lg">
                        <div class="card-body">
                            <h5 class="card-title">{{ $card }}</h5>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link fs-7" href="{{ $route }}">Ver {{ $card }}</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection