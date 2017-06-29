@extends('admin.layouts.admin_layout')

@section('title', 'Administrar Preguntas')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Preguntas</a>
            </li>

            <li class="active">
                <a href="#">Administrar Preguntas</a>
            </li>
            <!--<li class="active">Blank Page</li>-->
        </ul><!-- /.breadcrumb -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <h3 class="header smaller lighter blue">Preguntas</h3>

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
                                <th>Etapa de Curso</th>
                                <th>
                                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                    Ultima Actualizacion
                                </th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>

                                    <td>{{ $question->title }}</td>
                                    <td>{{ !is_null($question->course_stage) ? ($question->course_stage->course->name . " - " . $question->course_stage->name) : "Aun no relacionada" }}</td>
                                    <td>{{ $question->updated_at }}</td>

                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="blue" href="#">
                                                <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                            </a>

                                            <a class="green" href="{{ route("admin_questions_edit", ["question_id" => $question->id]) }}">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                            </a>

                                            <a class="red delete_question" href="{{ route('admin_questions_delete', ['question_id' => $question->id]) }}">
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
@endsection

@section('custom_script')
    

    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var myTable = dynamicTable.getInstance({
                        bAutoWidth: false,
                        "aoColumns": [
                            {"bSortable": false},
                            null, null, null,
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
                        "text": "<i class='fa fa-plus bigger-110 green'></i> <span class='hidden'>Agregar Pregunta</span>",
                        "className": "btn btn-white btn-primary btn-bold",
                        columns: ':not(:first):not(:last)',
                        action: function ( e, dt, node, conf ) {
                            window.open("{{ route('admin_questions_add') }}", "_self");
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

                @if (isset($message) && isset($status))
                    notification('{{ $status }}', '{{ $message }}');
                @endif

                $('#dynamic-table').on('click', '.delete_question', deleteResource);
            });
        });
    </script>
@endsection