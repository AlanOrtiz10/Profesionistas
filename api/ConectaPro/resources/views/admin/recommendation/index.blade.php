@extends('layouts.panel')
@section('title', 'Recomendaciones-Admin')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

<script>
    $(document).ready(function(){
        $('#specialist_id').change(function(){
            var specialistId = $(this).val();
            // Realizar una solicitud AJAX para obtener los servicios relacionados con el especialista seleccionado
            $.ajax({
                url: '/get-services/' + specialistId, // Ruta para obtener los servicios relacionados con el especialista
                type: 'GET',
                success: function(data) {
                    // Limpiar y actualizar el campo de selección de servicios
                    $('#service_id').empty();
                    // Verificar si se recibió una respuesta válida y si hay servicios disponibles
                    if (data.length > 0) {
                        // Agregar cada servicio al campo de selección
                        $.each(data, function(index, service) {
                            $('#service_id').append('<option value="' + service.id + '">' + service.name + '</option>');
                        });
                    } else {
                        // Si no hay servicios disponibles, mostrar un mensaje o realizar otra acción
                        $('#service_id').append('<option value="">No hay servicios disponibles</option>');
                    }
                },
                error: function(xhr, status, error) {
                    // Manejar el error de la solicitud AJAX
                    console.error(error);
                }
            });
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
            <form action="{{ route('admin.recommendation.store') }}" method="POST">
                @csrf
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
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                            @endforeach
                        </select>
                    </div>
<!-- Campo Especialista -->
<div class="form-group">
    <label for="specialist_id">Especialista:</label>
    <select class="form-control" id="specialist_id" name="specialist_id" required>
        @foreach($specialists as $specialist)
            <option value="{{ $specialist->id }}">{{ $specialist->user->name }} {{ $specialist->user->surname }}</option>
        @endforeach
    </select>
</div>


                    <!-- Campo Comentario -->
                    <div class="form-group">
                        <label for="comment">Comentario:</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                    </div>
                    <!-- Campo Calificación -->
                    <div class="form-group">
                        <label for="rating">Calificación:</label>
                        <input type="number" class="form-control" id="rating" name="rating" min="1" max="5" required>
                    </div>
<!-- Campo Servicio -->
<div class="form-group">
    <label for="service_id">Servicio:</label>
    <select class="form-control" id="service_id" name="service_id" required>
        <!-- Las opciones de servicio se generarán dinámicamente con JavaScript -->
    </select>
</div>

</div>


                <!-- Pie del modal -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
