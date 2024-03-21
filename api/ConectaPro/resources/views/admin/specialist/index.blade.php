@extends('layouts.panel')
@section('title', 'Especialistas-Admin')

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
                            <td class="d-flex align-items-center">
                            <!-- Botón para abrir el modal de edición -->
                            <!-- Botón para abrir el modal de edición -->
                            <a href="#" class="edit mr-3" data-toggle="modal" data-target="#editEmployeeModal" data-id="{{ $specialist['id'] }}" data-name="{{ $specialist['ID_Usuario']['name'] }} {{ $specialist['ID_Usuario']['surname'] }}" data-category="{{ $specialist['ID_Categoria'] }}" data-speciality="{{ $specialist['ID_Especialidades'] }}" data-description="{{ $specialist['Descripcion'] }}" data-image="{{ $specialist['Imagen'] }}">
                                <i class="material-icons" data-toggle="tooltip" title="Editar">edit</i>
                            </a>
                            <form action="{{ route('admin.specialist.destroy', $specialist['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este especialista?')">
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

<!-- Modal de edición -->
<div class="modal" id="editEmployeeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Especialista</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="updateForm" action="{{ route('admin.specialist.update', ['id' => ':id']) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label for="edit_name">Nombre:</label>
                        <select class="form-control" id="edit_name" name="user_id" required>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_category">Categoría:</label>
                        <select class="form-control" id="edit_category" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_speciality">Especialidad:</label>
                        <select class="form-control" id="edit_speciality" name="specialities_id" required>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Descripción:</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="4" maxlength="190" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_image">Imagen:</label>
                        <input type="file" class="form-control-file" id="edit_image" name="image">
                        <small id="edit_image_help" class="form-text text-muted">Deja en blanco para mantener la imagen actual.</small>
                        <div id="current_image_placeholder"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $('#editEmployeeModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var category = button.data('category');
        var speciality = button.data('speciality');
        var description = button.data('description');
        var image = button.data('image');

        var modal = $(this);
        modal.find('#edit_id').val(id);
        modal.find('#edit_description').val(description);

        // Mostrar la imagen actual o el placeholder según corresponda
        if (image !== 'placeholder.jpg') {
            modal.find('#current_image_placeholder').html('<img src="{{ asset("assets/specialists") }}/' + image + '" alt="Imagen Actual" class="img-thumbnail">');
        } else {
            modal.find('#current_image_placeholder').html('<img src="{{ asset("assets/specialists/placeholder.jpg") }}" alt="Imagen Placeholder" class="img-thumbnail">');
        }

        // Establecer la acción del formulario con el ID en la ruta
        var form = modal.find('#updateForm');
        form.attr('action', "{{ route('admin.specialist.update', ['id' => ':id']) }}".replace(':id', id));

        // Establecer el nombre del especialista seleccionado
        modal.find('#edit_name option').filter(function() {
            return $(this).text() == name;
        }).prop('selected', true);

        // Establecer la categoría seleccionada
        modal.find('#edit_category option').filter(function() {
            return $(this).text() == category;
        }).prop('selected', true);

        // Establecer la especialidad seleccionada
        modal.find('#edit_speciality option').filter(function() {
            return $(this).text() == speciality;
        }).prop('selected', true);

        // Manejador de evento para el envío del formulario de actualización
        // Manejador de evento para el envío del formulario de actualización
form.submit(function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    // Obtener la URL de la acción del formulario
    var url = $(this).attr('action');

    // Obtener los datos del formulario
    var formData = new FormData($(this)[0]);

    // Agregar el campo oculto _method con el valor 'PUT'
    formData.append('_method', 'PUT');

    // Enviar la solicitud POST al controlador
   // Enviar la solicitud POST al controlador
$.ajax({
    type: 'POST',
    url: url,
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
        // Mostrar un mensaje de éxito
        alert('Especialista actualizado correctamente.');

        // Redirigir a la página de índice de especialistas
        window.location.href = "{{ route('admin.specialist.index') }}";
    },
    error: function(xhr, status, error) {
        // Manejar errores, por ejemplo, mostrar un mensaje de error
        alert('Error al actualizar el especialista');
        console.error(xhr.responseText);
    }
});

});

    });
</script>


@endsection
