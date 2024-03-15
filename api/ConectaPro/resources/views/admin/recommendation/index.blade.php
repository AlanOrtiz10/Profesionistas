@extends('layouts.panel')
@section('title', 'Recomendaciones-Admin')

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
                        <h2>Administrador de <b>Recomendaciones</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addRecommendationModal">
                            <i class="material-icons">&#xE147;</i> <span>Agregar Nueva Recomendación</span>
                        </button>                     
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
                        <th>Cliente</th>
                        <th>Especialista</th>
                        <th>Comentario</th>
                        <th>Calificación</th>
                        <th>Servicio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    @foreach($recommendations as $recommendation)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{$recommendation['id']}}" name="options[]" value="{{$recommendation['id']}}">
                                    <label for="checkbox{{$recommendation['id']}}"></label>
                                </span>
                            </td>
                            <td>{{$recommendation['id']}}</td>
                            <td>{{$recommendation['ID_Usuario']['name']}} {{$recommendation['ID_Usuario']['surname']}}</td>
                            <td>{{$recommendation['ID_Especialista']['name']}} {{$recommendation['ID_Especialista']['surname']}}</td>
                            <td>{{$recommendation['Comentario']}}</td>
                            <td>{{$recommendation['Calificacion']}}</td>
                            <td>{{$recommendation['ID_Servicio']}}</td>
                            <td>
                                <!-- Acciones de edición y eliminación -->
                                <a href="{{url('/users/' . $recommendation['id'] . '/edit')}}" class="edit" data-toggle="modal">
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
                <div class="hint-text">Mostrando <b>{{count($recommendations)}}</b> resultados</div>
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

<!-- Modal de creación -->
<div class="modal" id="addRecommendationModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del modal -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nueva Recomendación</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Cuerpo del modal -->
            <div class="modal-body">
                <!-- Contenido del modal -->
                <!-- Campo Cliente -->
                <div class="form-group">
                    <label for="user_id">Cliente:</label>
                    <select class="form-control" id="user_id" name="user_id" required>
                            <option value=""></option>
                    </select>
                </div>
                <!-- Campo Especialista -->
                <div class="form-group">
                    <label for="specialist_id">Especialista:</label>
                    <select class="form-control" id="specialist_id" name="specialist_id" required>
                    <option value=""></option>

                    </select>
                </div>
                <!-- Campo Comentario -->
                <div class="form-group">
                    <label for="comment">Comentario:</label>
                    <input type="text" class="form-control" id="comment" name="comment" required>
                </div>
                <!-- Campo Calificación -->
                <div class="form-group">
                    <label for="rating">Calificación:</label>
                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" step="0.5" required>
                </div>
                <!-- Campo Servicio -->
                <div class="form-group">
                    <label for="service_id">Servicio:</label>
                    <select class="form-control" id="service_id" name="service_id" required>
                    <option value=""></option>
                    </select>
                </div>  
                <!-- Footer del Modal -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Guardar</button>

            </div>
            </div>
        </div>
    </div>
</div>




@endsection

