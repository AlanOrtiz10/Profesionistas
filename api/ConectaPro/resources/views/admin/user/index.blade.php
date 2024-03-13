@extends('layouts.panel')
@section('title', 'Users-Admin')

@section('content')

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
                        <h2>Administrador de <b>Usuarios</b></h2>
                    </div>
                    <div class="col-sm-6">
                    <a href="{{ route('users.create.form') }}" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Agregar Nuevo Usuario</span></a>
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
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Password</th>
                        <th>Nivel</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
</tr>
</thead>
<tbody>
    @foreach($users as $user)
        <tr>
            <td>
                <span class="custom-checkbox">
                    <input type="checkbox" id="checkbox{{$user['id']}}" name="options[]" value="{{$user['id']}}">
                    <label for="checkbox{{$user['id']}}"></label>
                </span>
            </td>
            <td>{{$user['id']}}</td>
            <td>{{$user['Nombre']}}</td>
            <td>{{$user['Apellido']}}</td>
            <td>{{$user['Email']}}</td>
            <td>{{$user['Telefono']}}</td>
            <td>********</td>
            <td>{{$user['Nivel']['name']}}</td>
            <td>{{$user['Imagen']}}</td>
            <td>
                <!-- Acciones de edición y eliminación -->
                <a href="{{url('/users/' . $user['id'] . '/edit')}}" class="edit" data-toggle="modal">
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
            <div class="clearfix">
                <div class="hint-text">Mostrando <b>{{count($users)}}</b> resultados</div>
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

@endsection
