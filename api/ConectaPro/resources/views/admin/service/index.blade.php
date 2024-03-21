@extends('layouts.panel')
@section('title', 'Servicios-Admin')

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
                        <h2>Administrador de <b>Servicios</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <!-- Button to Open the Modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addServiceModal">
                            <i class="material-icons">&#xE147;</i> <span>Agregar Nuevo Servicio</span>
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
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                        <th>Imagen</th>
                        <th>Disponibilidad</th>
                        <th>Especialista</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                @foreach($services as $service)
<tr>
    <td>
        <span class="custom-checkbox">
            <input type="checkbox" id="checkbox{{$service['id']}}" name="options[]" value="{{$service['id']}}">
            <label for="checkbox{{$service['id']}}"></label>
        </span>
    </td>
    
    <td>{{$service['id']}}</td>
    <td>{{$service['Nombre']}}</td>
    <td>{{$service['Descripcion']}}</td>
    <td>{{$service['ID_Categoria']['name']}}</td>
    <td>{{$service['Imagen']}}</td>
    <td>{{$service['Disponibilidad']}}</td>
    <td>{{$service['ID_Especialista']['name']}} {{$service['ID_Especialista']['surname']}}</td>
    <td class="d-flex align-items-center">
        <a href="#" class="edit mr-3" data-toggle="modal" data-target="#editServiceModal" data-id="{{ $service['id'] }}" data-name="{{ $service['Nombre'] }}" data-description="{{ $service['Descripcion'] }}" data-category-id="{{ $service['ID_Categoria']['id'] }}" data-specialist-id="{{ $service['ID_Especialista']['id'] }}" data-image="{{ $service['Imagen'] }}" data-availability="{{ $service['Disponibilidad'] }}" data-specialist="{{ $service['ID_Especialista']['name'] }} {{ $service['ID_Especialista']['surname'] }}">
            <i class="material-icons" data-toggle="tooltip" title="Editar" style="font-size: 25px;">&#xE254;</i>
        </a>
        @auth
        @if(auth()->user()->level_id == 1)
        <form action="{{ route('admin.service.destroy', $service['id']) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este servicio?')">
                <i class="material-icons text-danger" data-toggle="tooltip" title="Eliminar" style="font-size: 25px;">delete</i>
            </button>
        </form>
        @endif
            @endauth
    </td>
</tr>
@endforeach


                </tbody>
            </table>
            <!-- Pagination and Other Elements -->
            <div class="clearfix">
                <div class="hint-text">Mostrando <b>{{count($services)}}</b> resultados</div>
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

<!-- Modal de creación de servicios -->
<!-- Modal de creación de servicios -->
<div class="modal" id="addServiceModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nuevo Servicio</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
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
                        <label for="image">Imagen:</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                    </div>
                    <div class="form-group">
                        <label for="availability">Disponibilidad:</label>
                        <select class="form-control" id="availability" name="availability" required>
                            <option value="Disponible">Disponible</option>
                            <option value="Fuera de servicio">Fuera de servicio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="specialist_id">Especialista:</label>
                        <select class="form-control" id="specialist_id" name="specialist_id" required>
                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}">{{ $specialist->user->name }} {{ $specialist->user->surname }}</option>
                            @endforeach
                        </select>
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

<!-- Modal de Edición -->
<div class="modal" id="editServiceModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Editar Servicio</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
            <form action="{{ route('admin.service.update', ['id' => '__service_id']) }}" method="POST" enctype="multipart/form-data" id="editServiceForm">
                    @csrf
                    @method('PUT')
                   
                    <input type="hidden" id="edit_id" name="id">
                    <div class="form-group">
                        <label for="edit_name">Nombre:</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_description">Descripción:</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_category_id">Categoría:</label>
                        <select class="form-control" id="edit_category_id" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
    <label for="edit_image">Imagen:</label>
    @if($service['Imagen'] != 'placeholder.jpg')
        <img id="edit_image_preview" src="{{ asset('assets/services/'.$service['Imagen']) }}" alt="Imagen Actual" class="img-thumbnail">
    @else
        <img id="edit_image_preview" src="{{ asset('assets/services/placeholder.jpg') }}" alt="Imagen Placeholder" class="img-thumbnail">
    @endif
    <input type="file" class="form-control-file" id="edit_image" name="image">
</div>

                    <div class="form-group">
                        <label for="edit_availability">Disponibilidad:</label>
                        <select class="form-control" id="edit_availability" name="availability" required>
                            <option value="Disponible">Disponible</option>
                            <option value="Fuera de servicio">Fuera de servicio</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_specialist_id">Especialista:</label>
                        <select class="form-control" id="edit_specialist_id" name="specialist_id" required>
                            @foreach($specialists as $specialist)
                                <option value="{{ $specialist->id }}">{{ $specialist->user->name }} {{ $specialist->user->surname }}</option>
                            @endforeach
                        </select>
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



<script>
$('#editServiceModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var name = button.data('name');
    var description = button.data('description');
    var category_id = button.data('category-id');
    var specialist_id = button.data('specialist-id');
    var availability = button.data('availability');
    var image = button.data('image');

    var modal = $(this);
    modal.find('#edit_id').val(id);
    modal.find('#edit_name').val(name);
    modal.find('#edit_description').val(description);
    modal.find('#edit_category_id').val(category_id);
    modal.find('#edit_specialist_id').val(specialist_id);
    modal.find('#edit_availability').val(availability);

    // Mostrar la imagen actual o el placeholder según corresponda
    if (image != 'placeholder.jpg') {
        modal.find('#edit_image_preview').attr('src', "{{ asset('assets/services') }}/" + image);
    } else {
        modal.find('#edit_image_preview').attr('src', "{{ asset('assets/services/placeholder.jpg') }}");
    }

    // Establecer la acción del formulario con el ID correcto del servicio
    var form = modal.find('#editServiceForm');
    form.attr('action', form.attr('action').replace('__service_id', id));
});



</script>

@endsection
