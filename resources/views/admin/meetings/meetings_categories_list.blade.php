@extends('admin.layouts.admin_layout')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('admin_assets/js/themes/default/style.min.css') }}" />
@endsection

@section('title', 'Reuniones de ciclo - Categorias')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Reuniones de Ciclo</a>
            </li>

            <li class="active">
                <a href="#">Administrar Categorias</a>
            </li>
            <!--<li class="active">Blank Page</li>-->
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="header smaller lighter blue">Categorias - Reuniones de Ciclo</h3>

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>


                <!-- div.table-responsive -->

                <!-- div.dataTables_borderWrap -->
                <div>
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th>Nombre</th>
                                <th>
                                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                    Fecha Creacion
                                </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($meetings_root_folder->folders as $category)
                                <tr category_id="{{ $category->id }}">
                                    <td class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>

                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->created_at }}</td>

                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <span data-toggle="modal" data-target="#administerSubcategoriesModal" data-subcategories='{!! json_encode($category->folders) !!}' data-category_folder_name="{{ $category->name }}" data-category_folder_id="{{ $category->id }}">
                                                <a class="blue" href="#" data-toggle="tooltip" data-placement="bottom" title="Administrar Subcategorias">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>
                                            </span>

                                            <a class="green" href="#" data-toggle="modal" data-target="#editCategoryModal" data-category_folder_id="{{ $category->id }}" data-category_folder_name="{{ $category->name }}">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                            </a>

                                            <a class="red delete_category" href="{{ route('admin_meetings_categories_delete', ['category_folder_id' => $category->id]) }}">
                                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- /.page-content -->


    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCategoryModalLabel">Agregar Categoria</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="createCategoryError" style="display: none;">
                        <span id="createCategoryErrorMessage">
                            Hubo errores en la creacion. Por favor intente nuevamente.
                        </span>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="meetings_category_name" class="control-label">Nombre Categoria:</label>
                            <input type="text" class="form-control" id="meetings_category_name" name="meetings_category_name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="createCategory">Crear Categoria</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editCategoryModalLabel">Editar Categoria</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="editCategoryError" style="display: none;">
                        <span id="editCategoryErrorMessage">
                            Hubo errores en la creacion. Por favor intente nuevamente.
                        </span>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="meetings_category_name" class="control-label">Nombre Categoria:</label>
                            <input type="text" class="form-control" id="meetings_category_name" name="meetings_category_name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="editCategory">Editar Categoria</button>
                </div>
            </div>
        </div>
    </div>

    <div id="administerSubcategoriesModal" style="z-index:1050" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header no-padding">
                    <div class="table-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <span class="white">&times;</span>
                        </button>
                        Administrar Subcategorias de <span id="category_name"></span>
                    </div>
                </div>

                <div class="modal-body no-padding">
                    <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha Creacion</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>

                        <tbody id="subcategories_tbody">
                            <tr>
                                <td>
                                    No hay subcategorias creadas.
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer no-margin-top">
                    <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cerrar
                    </button>
                    <button class="btn btn-sm btn-success pull-left" id="createSubcategory">
                        <i class="ace-icon fa fa-plus"></i>
                        Crear Subcategoria
                    </button>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade" style="z-index:1051" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="createFolderModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="createFolderModalLabel">Crear</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="createFolderError" style="display: none;">
                    <span id="createFolderErrorMessage">
                        Hubo errores en la creacion. Por favor intente nuevamente.
                    </span>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="meetings_folder_name" class="control-label">Nombre:</label>
                            <input type="text" class="form-control" id="meetings_folder_name" name="meetings_folder_name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="createFolder">Crear</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" style="z-index:1051" id="updateFolderModal" tabindex="-1" role="dialog" aria-labelledby="updateFolderModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="updateFolderModalLabel">Editar</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="updateFolderError" style="display: none;">
                    <span id="updateFolderErrorMessage">
                        Hubo errores en la edicion. Por favor intente nuevamente.
                    </span>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                    <form>
                        <div class="form-group">
                            <label for="meetings_folder_name" class="control-label">Nombre:</label>
                            <input type="text" class="form-control" id="meetings_folder_name" name="meetings_folder_name" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="updateFolder">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" style="z-index:1051" id="administerSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="administerSubCategoryModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="administerSubCategoryModalLabel">Administrar Subcategoria</h4>
                </div>
                <div class="modal-body" style="overflow-y: auto;max-height: 70vh;">
                    <div class="alert alert-danger" id="administerSubCategoryError" style="display: none;">
                    <span id="administerSubCategoryErrorMessage">
                        Hubo errores en la edicion. Por favor intente nuevamente.
                    </span>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                    <div id="jstree_demo_div"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" style="z-index:1052" id="uploadFileToFolderModal" tabindex="-1" role="dialog" aria-labelledby="uploadFileToFolderModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="uploadFileToFolderModalLabel">Subir Archivo</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="uploadFileToFolderError" style="display: none;">
                    <span id="uploadFileToFolderErrorMessage">
                        Hubo errores al subir. Por favor intente nuevamente.
                    </span>
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    </div>
                    {!! Form::open(['route' => 'admin_meetings_file_post', 'files' => true]) !!}
                        <div class="form-group">
                            <label for="meetings_folder_name" class="control-label">Archivo</label>
                            <input type="file" class="form-control" id="meetings_file" name="meetings_file" required>
                            <input type="hidden" name="meetings_parent_folder_id" id="meetings_parent_folder_id" />
                        </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="uploadFileToFolder">Subir</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_script')
    <script src="{{ asset('admin_assets/js/jstree.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.blockUI.js') }}"></script>


    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var myTable = dynamicTable.getInstance({
                        bAutoWidth: false,
                        "aoColumns": [
                            {"bSortable": false},
                            null, null,
                            {"bSortable": false}
                        ],
                        "aaSorting": [],

                        select: {
                            style: 'multi'
                        }
                    });

            $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

            new $.fn.dataTable.Buttons(myTable, {
                buttons: [
                    {
                        "text": "<i class='fa fa-plus bigger-110 green'></i> <span class='hidden'>Agregar Categoria</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)',
                        action: function ( e, dt, node, conf ) {
                            $('#addCategoryModal form')[0].reset();
                            $('#addCategoryModal').modal('show');
                        }
                    },
                    {
                        "extend": "colvis",
                        "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Mostrar/Esconder Columnas</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)'
                    },
                    {
                        "extend": "copy",
                        "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copiar al clipboard</span>",
                        "className": "btn btn-white btn-primary btn-bold"
                    },
                    {
                        "extend": "print",
                        "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Imprimir</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        autoPrint: false,
                        message: ''
                    }
                ]
            });
            myTable.buttons().container().appendTo($('.tableTools-container'));

            //style the message box
            var defaultCopyAction = myTable.button(1).action();
            myTable.button(1).action(function (e, dt, button, config) {
                defaultCopyAction(e, dt, button, config);
                $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
            });


            var defaultColvisAction = myTable.button(0).action();
            myTable.button(0).action(function (e, dt, button, config) {

                defaultColvisAction(e, dt, button, config);


                if ($('.dt-button-collection > .dropdown-menu').length == 0) {
                    $('.dt-button-collection')
                        .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                        .find('a').attr('href', '#').wrap("<li />")
                }
                $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
            });

            ////

            setTimeout(function () {
                $($('.tableTools-container')).find('a.dt-button').each(function () {
                    var div = $(this).find(' > div').first();
                    if (div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
                    else $(this).tooltip({container: 'body', title: $(this).text()});
                });
            }, 500);


            myTable.on('select', function (e, dt, type, index) {
                if (type === 'row') {
                    $(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
                }
            });
            myTable.on('deselect', function (e, dt, type, index) {
                if (type === 'row') {
                    $(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
                }
            });


            /////////////////////////////////
            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

            //select/deselect all rows according to table header checkbox
            $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function () {
                var th_checked = this.checked;//checkbox inside "TH" table header

                $('#dynamic-table').find('tbody > tr').each(function () {
                    var row = this;
                    if (th_checked) myTable.row(row).select();
                    else  myTable.row(row).deselect();
                });
            });

            //select/deselect a row when the checkbox is checked/unchecked
            $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
                var row = $(this).closest('tr').get(0);
                if (this.checked) myTable.row(row).deselect();
                else myTable.row(row).select();
            });


            $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });

            $(document).ready(function(){

                $('[data-toggle="tooltip"]').tooltip();

                @if (isset($message) && isset($status))
                    notification('{{ $status }}', '{{ $message }}');
                @endif

                $('#createCategory').click(function(e){
                    if($('#meetings_category_name')[0].checkValidity()){
                        $.post("{{ route('admin_meetings_categories_post') }}", {meetings_category_name: $('#meetings_category_name').val()},function(data){
                            if(data.status == 'success'){
                                console.log(data.category_folder);
                                $('#addCategoryModal').modal('hide');
                                notification(data.status, data.message);
                                $('#createCategoryError').hide();
                                var node = myTable.row.add(['<label class="pos-rel">\
                                                    <input type="checkbox" class="ace" /> \
                                                    <span class="lbl"></span> \
                                                  </label>',
                                    data.category_folder.name,
                                    data.category_folder.created_at,
                                    '<div class="hidden-sm hidden-xs action-buttons"> \
                                        <span data-toggle="modal" data-target="#administerSubcategoriesModal">\
                                            <a class="blue" href="#" data-toggle="tooltip" data-placement="bottom" title="Administrar Subcategorias"> \
                                                <i class="ace-icon fa fa-search-plus bigger-130"></i> \
                                            </a> \
                                        </span>\
                                        <a class="green" href="#" data-toggle="modal" data-target="#editCategoryModal" data-category_folder_id="'+data.category_folder.id+'" data-category_folder_name="'+data.category_folder.name+'"> \
                                            <i class="ace-icon fa fa-pencil bigger-130"></i> \
                                        </a> \
                                        <a class="red delete_category" href="'+laroute.route('admin_meetings_categories_delete', {category_folder_id: data.category_folder.id})+'"> \
                                            <i class="ace-icon fa fa-trash-o bigger-130"></i> \
                                        </a> \
                                    </div>'
                                ]).draw().node();
                                $(node).children().first().addClass('center');

                                $('.delete_category').unbind('click');
                                $('.delete_category').click(deleteResource);

                            }else{
                                $('#createCategoryErrorMessage').html('Hubo errores en la creacion. Por favor intente nuevamente.');
                                $('#createCategoryError').show();
                            }
                        });
                    }else{
                        $('#createCategoryErrorMessage').html('Ingrese un nombre para la categoria');
                        $('#createCategoryError').show();
                    }

                });

                var appendSubcategory = function(entry){
                    $('#subcategories_tbody').append('<tr subcategory_id="'+entry.id+'">\
                        <td>'+entry.name+'</td> \
                        <td>'+entry.created_at+'</td> \
                        <td>\
                            <a class="blue" href="#" data-toggle="modal" data-target="#administerSubCategoryModal" data-root_id="'+entry.id+'" data-root_name="'+entry.name+'"> \
                                <i class="ace-icon fa fa-search-plus bigger-130"></i> \
                            </a> \
                            <a class="green" href="#" data-toggle="modal" data-target="#updateFolderModal" data-folder_id="'+entry.id+'" data-folder_name="'+entry.name+'"> \
                                <i class="ace-icon fa fa-pencil bigger-130"></i> \
                            </a> \
                            <a class="red delete_folder" href="#" data-folder_id="'+entry.id+'"> \
                                <i class="ace-icon fa fa-trash-o bigger-130"></i> \
                            </a> \
                        </td></tr> \
                    ');
                };

                var removeSubcategory = function(id){
                    $("tr[subcategory_id="+id+"]").remove();
                    if($("tr[subcategory_id]").length == 0){
                        $('#subcategories_tbody').append('<tr><td>No hay subcategorias creadas. </td> <td></td> <td></td></tr>');
                    }
                };

                $('#administerSubcategoriesModal').on('show.bs.modal', function(e){
                    var relatedTarget = $(e.relatedTarget);
                    var subcategories = relatedTarget.data('subcategories');
                    var category_folder_name = relatedTarget.data('category_folder_name');
                    var category_folder_id = relatedTarget.data('category_folder_id');
                    $('#administerSubcategoriesModal #category_name').html(category_folder_name);

                    $('#subcategories_tbody').attr('category_id', category_folder_id);

                    if(subcategories.length > 0) {
                        $('#subcategories_tbody').html('');
                        subcategories.forEach(function (entry) {
                            appendSubcategory(entry);
                        });

                        setFolderDeleteClick(function(id){
                            removeSubcategory(id);
                            for(var i = 0; i < subcategories.length; i++){
                                if(subcategories[i].id == id){
                                    subcategories.splice(i);
                                }
                            }
                            $('span[data-category_folder_id='+category_folder_id+']').data('subcategories', subcategories);
                        });
                    }

                    $('#createSubcategory').unbind('click');
                    $('#createSubcategory').click(function(){
                        $("#createFolderModal").modal('show');
                        setFolderCreateClick(category_folder_id, function(folder){
                            if($("tr[subcategory_id]").length == 0){
                                $('#subcategories_tbody').html('');
                            }
                            appendSubcategory(folder);
                            setFolderDeleteClick(function(id){
                                removeSubcategory(id);
                                for(var i = 0; i < subcategories.length; i++){
                                    if(subcategories[i].id == id){
                                        subcategories.splice(i);
                                    }
                                }
                                $('span[data-category_folder_id='+category_folder_id+']').data('subcategories', subcategories);
                            });
                            subcategories.push(folder);
                            $('span[data-category_folder_id='+category_folder_id+']').data('subcategories', subcategories);
                        });
                    });

                });

                $('#editCategoryModal').on('show.bs.modal', function(e) {
                    //get data-id attribute of the clicked element
                    var relatedTarget = $(e.relatedTarget);
                    $('#editCategoryModal form')[0].reset();
                    var category_folder_id = relatedTarget.data('category_folder_id');
                    var category_folder_name = relatedTarget.data('category_folder_name');

                    $("#editCategoryModal #meetings_category_name").val(category_folder_name);
                    $('#editCategory').unbind('click');
                    $('#editCategory').click(function(e){
                        if($("#editCategoryModal #meetings_category_name").val() == category_folder_name){
                            $('#editCategoryErrorMessage').html('Tiene que ingresar un nombre diferente.');
                            $('#editCategoryError').show();
                            return;
                        }
                        $.ajax({
                            url: laroute.route('admin_meetings_categories_edit', {category_folder_id: category_folder_id}),
                            data: {meetings_category_name: $("#editCategoryModal #meetings_category_name").val()},
                            type: 'PUT',
                            dataType: 'json',
                            success: function(result) {
                                notification(result.status, result.message);
                                var rowData = myTable.row($("tr[category_id="+category_folder_id+"]")).data();
                                rowData[1] = $("#editCategoryModal #meetings_category_name").val();
                                myTable.row($("tr[category_id="+category_folder_id+"]")).data(rowData).draw();
                                $('#editCategoryModal').modal('hide');
                            },
                            error: function (xhr, status, errorThrown) {
                                notification('error', 'Hubo un error inesperado. Por favor intente mas tarde.');
                            }
                        });
                    });
                });

                $("#createFolderModal").on("show.bs.modal", function(e){
                    $('#createFolderError').hide();
                    $('#createFolderModal form')[0].reset();
                });

                $("#updateFolderModal").on("show.bs.modal", function(e){
                    $('#updateFolderError').hide();
                    $('#updateFolderModal form')[0].reset();
                    var relatedTarget = $(e.relatedTarget);
                    var folder_id = relatedTarget.data('folder_id');
                    var folder_name = relatedTarget.data('folder_name');

                    $('#updateFolderModal #meetings_folder_name').val(folder_name);

                    $('#updateFolder').unbind('click');
                    $('#updateFolder').click(function(e){
                        if($('#updateFolderModal #meetings_folder_name')[0].checkValidity()){
                            updateFolder(folder_id, $('#updateFolderModal #meetings_folder_name').val(), function(updatedFolder){

                                $('tr[subcategory_id='+folder_id+'] td').first().html($('#updateFolderModal #meetings_folder_name').val());
                                var category_folder_id = $('#subcategories_tbody').attr('category_id');
                                var subcategories = $('span[data-category_folder_id='+category_folder_id+']').data('subcategories');
                                for(var i = 0; i < subcategories.length; i++){
                                    if(subcategories[i].id == updatedFolder.id){
                                        subcategories[i].name = $('#updateFolderModal #meetings_folder_name').val();
                                    }
                                }
                                $('span[data-category_folder_id='+category_folder_id+']').data('subcategories', subcategories);
                            });
                            $("#updateFolderModal").modal('hide');
                            return;
                        }
                        $('#updateFolderError').show();
                    });

                });

                $("#administerSubCategoryModal").on("show.bs.modal", function(e){
                    var relatedTarget = $(e.relatedTarget);
                    var root_folder_id = relatedTarget.data('root_id');

                    $('#jstree_demo_div').jstree({
                        'core' : {
                            "check_callback" : true,
                            'data' : {
                                'url': laroute.route('admin_meetings_get_folder_contents'),
                                'data': function (node){
                                    console.log(node);
                                    var data = { 'folder_id': node.id.split("folder_")[1], children_only: true };
                                    if(node.id === "#"){
                                        data = { 'folder_id': root_folder_id };
                                    }
                                    //console.log(data);
                                    return data;
                                }
                            },
                            'worker': false
                        },
                        "types" : {
                            "#" : { "icon" : "fa fa-tree", "valid_children" : ["root"] },
                            "root" : {
                                "icon" : "fa fa-tree",
                                "valid_children" : ["default", "file", "folder"]
                            },
                            "default" : {
                                "icon" : "fa fa-folder",
                                "valid_children" : ["default","file", "folder"]
                            },
                            "file" : {
                                "icon" : "fa fa-file",
                                "valid_children" : []
                            },
                            "folder" : {
                                "icon" : "fa fa-folder",
                                "valid_children" : ['file', 'folder']
                            }
                        },
                        "plugins": ['types', 'contextmenu'],
                        'contextmenu' : {
                            'items' : function(node) {
                                var tmp = $.jstree.defaults.contextmenu.items();
                                delete tmp.ccp;
                                delete tmp.create.action;
                                tmp.create.label = "Nuevo";
                                tmp.create.submenu = {
                                    "create_folder" : {
                                        "separator_after"   : true,
                                        "label"             : "Carpeta",
                                        "action"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);

                                            console.log(obj);


                                            inst.create_node(obj, { type : "folder", id: "folder_" + ((0|Math.random()*9e6).toString(9)) }, "last", function (new_node) {
                                                setTimeout(function () { inst.edit(new_node); },0);
                                            });
                                        }
                                    },
                                    "create_file" : {
                                        "separator_after"   : true,
                                        "label"             : "Archivo",
                                        "action"            : function (data) {
                                            var inst = $.jstree.reference(data.reference),
                                                obj = inst.get_node(data.reference);
                                            $("#meetings_parent_folder_id").val(obj.id.split("folder_")[1]);
                                            $("#uploadFileToFolderModal").modal('show');
                                            $('#uploadFileToFolderError').hide();
                                            $('#uploadFileToFolderModal form').unbind('submit');
                                            $('#uploadFileToFolderModal form').submit(function(){
                                                $.blockUI({ message: '<h1><img src="{{ asset('img/loading-icon.svg') }}" /> Subiendo...</h1>', baseZ: 1060 });
                                                $('#uploadFileToFolderError').hide();
                                                $(this).ajaxSubmit({
                                                    dataType: 'json',
                                                    success: function(data){
                                                        console.log(data);
                                                        if(data.status == 'success'){
                                                            inst.create_node(obj, { type : "file",  id: "file_" + data.file.id, text: data.file.file_name_original, url: data.file.url}, "last", function(new_node){
                                                                setTimeout(function () {
                                                                    $("#uploadFileToFolderModal").modal('hide');
                                                                    $('#uploadFileToFolderModal form')[0].reset();
                                                                },0);
                                                            });
                                                        }else{
                                                            $('#uploadFileToFolderError').show();
                                                        }
                                                        $.unblockUI();
                                                    },
                                                    error: function(data){
                                                        $.unblockUI();
                                                        $('#uploadFileToFolderError').show();
                                                    }
                                                });
                                                return false;
                                            });
                                            $('#uploadFileToFolder').unbind('click');
                                            $('#uploadFileToFolder').click(function(){
                                                $('#uploadFileToFolderModal form').submit();
                                            });
                                            /*


                                            inst.create_node(obj, { type : "folder" }, "last", function (new_node) {
                                                setTimeout(function () { inst.edit(new_node); },0);
                                            });*/
                                        }
                                    }
                                };
                                tmp.rename.label = "Renombrar";
                                tmp.remove.label = "Borrar";
                                if(this.get_type(node) === "file") {
                                    delete tmp.create;
                                    delete tmp.rename;
                                }
                                return tmp;
                            }
                        }
                    }).on('create_node.jstree', function (e, data) {
                        if(data.node.type == 'folder'){
                            console.log(data);
                            $.post(laroute.route('admin_meetings_folder_post'), { 'meetings_parent_folder_id' : data.node.parent.split("folder_")[1], 'meetings_folder_name' : data.node.text })
                                .done(function (d) {
                                    data.instance.set_id(data.node, "folder_" + d.folder.id);
                                })
                                .fail(function () {
                                    data.instance.refresh();
                                });
                        }
                    }).on('rename_node.jstree', function (e, data) {
                        if(data.node.type == 'folder') {
                            $.ajax({
                                url: laroute.route('admin_meetings_folder_edit', {folder_id: data.node.id.split("folder_")[1]}),
                                data: {meetings_folder_name: data.text},
                                type: 'PUT',
                                dataType: 'json',
                                success: function (result) {
                                    data.instance.set_id(data.node, "folder_" + result.folder.id);
                                },
                                error: function (xhr, status, errorThrown) {
                                    data.instance.refresh();
                                }
                            });
                        }
                    }).on('delete_node.jstree', function (e, data) {
                        if(data.node.type == 'folder'){
                            $.ajax({
                                url: laroute.route('admin_meetings_folder_delete', {folder_id: data.node.id.split('folder_')[1]}),
                                type: 'DELETE',
                                dataType: 'json',
                                success: function(result) {
                                },
                                error: function (xhr, status, errorThrown) {
                                    data.instance.refresh();
                                }
                            });
                        }else if(data.node.type == 'file'){
                            $.ajax({
                                url: laroute.route('admin_meetings_file_delete', {file_id: data.node.id.split('file_')[1]}),
                                type: 'DELETE',
                                dataType: 'json',
                                success: function(result) {
                                },
                                error: function (xhr, status, errorThrown) {
                                    console.log(errorThrown);
                                    data.instance.refresh();
                                }
                            });
                        }
                    });

                    $("#administerSubCategoryModal").unbind('hide.bs.modal');
                    $("#administerSubCategoryModal").on("hide.bs.modal", function(e){
                        $('#jstree_demo_div').jstree().destroy();
                    });
                });

                $('#dynamic-table').on('click', '.delete_category', deleteResource);



            });
        });
    </script>
@endsection