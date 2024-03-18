@extends('layouts.panel')
@section('title', 'Especialidades-Admin')

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
                        <h2>Administrador de <b>Especialidades</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSpecialityModal">
                            <i class="material-icons">&#xE147;</i> <span>Agregar Nueva Especialidad</span>
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
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    @foreach($specialities as $speciality)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{$speciality['id']}}" name="options[]" value="{{$speciality['id']}}">
                                    <label for="checkbox{{$speciality['id']}}"></label>
                                </span>
                            </td>
                            <td>{{$speciality['id']}}</td>      
                            <td>{{$speciality['Nombre']}}</td>
                            <td>{{$speciality['Descripcion']}}</td>
                            <td>
                                <!-- Acciones de edición y eliminación -->
                                <a href="{{url('/users/' . $speciality['id'] . '/edit')}}" class="edit" data-toggle="modal">
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
                <div class="hint-text">Mostrando <b>{{count($speciality)}}</b> resultados</div>
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




@endsection
