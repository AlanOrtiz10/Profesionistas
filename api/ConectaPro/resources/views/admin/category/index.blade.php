@extends('layouts.panel')
@section('title', 'Categorias-Admin')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Administrador de <b>Categorias</b></h2>
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
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <!-- Table Body -->
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <span class="custom-checkbox">
                                    <input type="checkbox" id="checkbox{{ $category->id }}" name="options[]" value="{{ $category->id }}">
                                    <label for="checkbox{{ $category->id }}"></label>
                                </span>
                            </td>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->image }}</td>
    <td class="d-flex align-items-center">
    <!-- Acciones de edición y eliminación -->
    <a href="#" class="edit" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $category->id }}" data-image="{{ $category->image }}">
        <i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i>
    </a>
    <!-- Formulario para enviar solicitud de eliminación -->
    <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría?')">
            <i class="material-icons" data-toggle="tooltip" title="Editar"style="color: red;">delete</i>
        </button>
    </form>
</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination and Other Elements -->
            <div class="clearfix">
                <div class="hint-text">Se encontraron <b>{{ $categories->total() }}</b> resultados</div>
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($categories->onFirstPage())
                        <li class="page-item disabled" style="width: auto;"><span class="page-link">Anterior</span></li>
                    @else
                        <li class="page-item" style="width: auto;"><a class="page-link btn btn-sm btn-secondary" href="{{ $categories->previousPageUrl() }}" rel="prev">Anterior</a></li>
                    @endif
                    {{-- Next Page Link --}}
                    @if ($categories->hasMorePages())
                        <li class="page-item" style="width: auto;"><a class="page-link btn btn-sm btn-secondary" href="{{ $categories->nextPageUrl() }}" rel="next">Siguiente</a></li>
                    @else
                        <li class="page-item disabled" style="width: auto;"><span class="page-link btn btn-sm btn-secondary">Siguiente</span></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal de CREATE -->
<div class="modal" id="addEmployeeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Agregar Nueva Categoría</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Formulario para agregar nueva categoría -->
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <!-- Campo Nombre -->
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <!-- Campo Descripción -->
                    <div class="form-group">
                        <label for="description">Descripción:</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <!-- Campo Imagen -->
                    <div class="form-group">
                        <label for="image">Imagen:</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                    </div>
                    <!-- Footer del Modal -->
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
<div class="modal" id="editCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Editar Categoría</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Formulario para editar categoría -->
                <form id="editCategoryForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Campo ID -->
                    <input type="hidden" id="edit_category_id" name="id">

                    <!-- Campo Nombre -->
                    <div class="form-group">
                        <label for="edit_name">Nombre:</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <!-- Campo Descripción -->
                    <div class="form-group">
                        <label for="edit_description">Descripción:</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>
                    <!-- Campo Imagen -->
                    <div class="form-group">
                        <label for="edit_image">Imagen:</label>
                        <!-- Mostrar la imagen actual -->
                        <img id="edit_image_preview" src="" alt="Imagen actual" class="img-thumbnail">
                        <input type="file" class="form-control-file" id="edit_image" name="image">
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" id="updateCategoryBtn" class="btn btn-success">Actualizar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        // Abrir modal de edición al hacer clic en el botón de editar
        $('.edit').on('click', function() {
            var category_id = $(this).data('id');
            var image_name = $(this).data('image');
            var category_name = $(this).closest('tr').find('td:nth-child(3)').text();
            var category_description = $(this).closest('tr').find('td:nth-child(4)').text();
            $('#edit_category_id').val(category_id);
            $('#edit_name').val(category_name);
            $('#edit_description').val(category_description);
            // Mostrar la imagen actual en el modal
            $('#edit_image_preview').attr('src', '/assets/categories/' + image_name);
        });

        // Actualizar categoría al hacer clic en el botón de actualizar
        // Actualizar categoría al hacer clic en el botón de actualizar
$(document).on('click', '#updateCategoryBtn', function() {
    var categoryId = $('#edit_category_id').val();
    var formData = new FormData($('#editCategoryForm')[0]);
    $.ajax({
        type: 'POST',
        url: '/admi/Category/' + categoryId, // URL corregida
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
    console.log(response);
    // Cerrar el modal
    $('#editCategoryModal').modal('hide');
    // Redirigir a la página de índice de categorías
    window.location.href = "{{ route('admin.category.index') }}";
},


        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Aquí puedes manejar el error, mostrar un mensaje al usuario, etc.
        }
    });
});

    });
</script>


@endsection