@extends('layouts.panel')
@section('title', 'Users-Admin')

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
    <!-- Alertas de notificación -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 20px;"> <!-- Añadido estilo para margen superior -->
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 20px;"> <!-- Añadido estilo para margen superior -->
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrador de <b>Usuarios</b></h2>
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
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Nivel</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Table Body -->
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
                            <td>{{$user['Nivel']['name']}}</td>
                            <td>{{$user['Imagen']}}</td>
                            <td class="d-flex align-items-center">
                                <!-- Acciones de edición y eliminación -->
                                <a href="{{url('/users/' . $user['id'] . '/edit')}}" class="edit mr-3" data-toggle="modal">
                                    <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                                    <i class="material-icons text-danger" data-toggle="tooltip" title="Eliminar" style="font-size: 25px;">delete</i>
                                </button>
                            </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination and Other Elements -->
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

<!-- The Modal -->
<div class="modal" id="addEmployeeModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nuevo Usuario</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body (Your Form Goes Here) -->
            <div class="modal-body">
                <!-- Your Form Code Goes Here -->
                <!-- For example, you can create a form using Laravel's form helpers -->
                <form action="{{ route('admin.users.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Your Form Fields Goes Here -->
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Apellido:</label>
                        <input type="text" class="form-control" id="surname" name="surname" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono:</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Nivel:</label>
                        <select class="form-control" id="level" name="level" required>
                            @foreach($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Imagen:</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
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


@endsection
