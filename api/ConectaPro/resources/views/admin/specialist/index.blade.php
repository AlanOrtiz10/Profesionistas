@extends('layouts.panel')
@section('title', 'Especialistas-Admin')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();
        
        // Select/Deselect checkboxes
        var checkbox = $('table tbody input[type="checkbox"]');
        $("#selectAll").click(function(){
            if(this.checked){
                checkbox.each(function(){
                    this.checked = true;                        
                });
            } else{
                checkbox.each(function(){
                    this.checked = false;                        
                });
            } 
        });
        checkbox.click(function(){
            if(!this.checked){
                $("#selectAll").prop("checked", false);
            }
        });
    });
</script>

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrador de <b>Especialistas</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEmployeeModal">
                            <i class="material-icons">&#xE147;</i> <span>Agregar Nuevo Usuario</span>
                        </button>
                        <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Eliminar</span></a>                        
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <!-- Table Header -->
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
                        <th>Categoria</th>
                        <th>Especialidad</th>
                        <th>Descripcion</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    @foreach($specialists as $specialist)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{$specialist['id']}}" name="options[]" value="{{$specialist['id']}}">
                                    <label for="checkbox{{$specialist['id']}}"></label>
                                </span>
                            </td>
                            <td>{{$specialist['id']}}</td>
                            <td>{{$specialist['ID_Usuario']['name']}} {{$specialist['ID_Usuario']['surname']}}</td>
                            <td>{{$specialist['ID_Categoria']}}</td>
                            <td>{{$specialist['ID_Especialidades']}}</td>
                            <td>{{$specialist['Descripcion']}}</td>
                            <td>{{$specialist['Imagen']}}</td>
                            <td>
                                <!-- Acciones de edición y eliminación -->
                                <a href="{{url('/users/' . $specialist['id'] . '/edit')}}" class="edit" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i>
                                </a>
                                <a href="#" class="delete" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip" title="Eliminar">&#xE872;</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination and Other Elements -->
            <div class="clearfix">
                <div class="hint-text">Mostrando <b>{{count($specialist)}}</b> resultados</div>
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">2</a></li>
                    <li class="page-item active"><a href="#" class="page-link">3</a></li>
                    <li class="page-item"><a href="#" class="page-link">4</a></li>
                    <li class="page-item"><a href="#" class="page-link">5</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>        
</div>

<!-- The Modal -->
<div class="modal" id="addEmployeeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nuevo Especialista</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body (Your Form Goes Here) -->
            <div class="modal-body">
            <form action="{{ route('admin.specialist.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="user_id">Nombre del especialista:</label>
                        <select class="form-control" id="user_id" name="user_id" required>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Categoría:</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="specialities_id">Especialidad:</label>
                        <select class="form-control" id="specialities_id" name="specialities_id" required>
                        @foreach($specialties as $specialty)
                    <option value="{{ $specialty->id }}">{{ $specialty->description }}</option>
                @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea class="form-control" id="description" name="description" rows="4" maxlength="190" required></textarea>
                    </div>
                    <div class="form-group">
            <label for="image">Imagen:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
