@extends('layouts.panel')
@section('title', 'Especialidades-Admin')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<div class="container-xl">
    <div class="mt-3">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrador de <b>Especialidades</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSpecialityModal">
                            <i class="material-icons">&#xE147;</i> <span>Agregar Nueva Especialidad</span>
                        </button>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($specialities as $speciality)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{ $speciality->id }}" name="options[]" value="{{ $speciality->id }}">
                                    <label for="checkbox{{ $speciality->id }}"></label>
                                </span>
                            </td>
                            <td>{{ $speciality->id }}</td>      
                            <td>{{ $speciality->name }}</td>
                            <td>{{ $speciality->description }}</td>
                            <td class="d-flex align-items-center">

                                <a href="#" class="edit" data-toggle="modal" data-target="#editSpecialityModal{{$speciality['id']}}" data-id="{{$speciality['id']}}" data-name="{{$speciality['Nombre']}}" data-description="{{$speciality['Descripcion']}}">
                                    <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i>
                                </a>
                                <!-- Icono de eliminación -->
                            <form action="{{ route('admin.speciality.destroy', $speciality->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría?')">
                                    <i class="material-icons text-danger" data-toggle="tooltip" title="Eliminar" style="font-size: 25px;">delete</i>
                                </button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="clearfix">
                <div class="hint-text">Mostrando <b>{{ $specialities->count() }}</b> resultados</div>
                <ul class="pagination">
                    @if ($specialities->lastPage() > 1)
                        @for ($i = 1; $i <= $specialities->lastPage(); $i++)
                            <li class="page-item {{ ($specialities->currentPage() == $i) ? 'active' : '' }}">
                                <a href="{{ $specialities->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endfor
                    @endif
                </ul>
            </div>
        </div>
    </div>        
</div>

<!-- The Modal -->
<div class="modal" id="addSpecialityModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nueva Especialidad</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body (Your Form Goes Here) -->
            <div class="modal-body">
                <!-- Your Form Code Goes Here -->
                <!-- For example, you can create a form using Laravel's form helpers -->
                <form action="{{ route('admin.speciality.create') }}" method="POST">
                    @csrf
                    <!-- Your Form Fields Goes Here -->
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($specialities as $speciality)
    <!-- Modal para editar especialidad -->
    <div class="modal fade" id="editSpecialityModal{{$speciality->id}}" tabindex="-1" role="dialog" aria-labelledby="editSpecialityModal{{$speciality->id}}Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editSpecialityModal{{$speciality->id}}Label">Editar Especialidad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.speciality.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{$speciality->id}}">
                        <div class="form-group">
                            <label for="edit-name">Nombre:</label>
                            <input type="text" class="form-control" id="edit-name" name="name" value="{{$speciality->name}}" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-description">Descripción:</label>
                            <textarea class="form-control" id="edit-description" name="description" required>{{$speciality->description}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach






@endsection
