<div class="col-md-6">
    <div class="widget-box transparent">
        <div class="widget-header widget-header-flat">
            <h4 class="widget-title lighter">
                <i class="ace-icon fa fa-star orange"></i>
                Palabras mas buscadas
            </h4>

            <div class="widget-toolbar">
                <a href="#" data-action="collapse">
                    <i class="ace-icon fa fa-chevron-up"></i>
                </a>
            </div>
        </div>

        <div class="widget-body">
            <div class="widget-main no-padding">
                <div class="dialogs">
                    <table class="table table-bordered table-striped">
                        <thead class="thin-border-bottom">
                        <tr>
                            <th>
                                <i class="ace-icon fa fa-caret-right blue"></i>palabra
                            </th>

                            <th>
                                <i class="ace-icon fa fa-caret-right blue"></i>cantidad
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($most_searched as $value => $query)
                                <tr>
                                    <td>
                                        {{ $value }}
                                    </td>
                                    <td>
                                        {{ $query->count() }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- /.widget-main -->
        </div><!-- /.widget-body -->
    </div><!-- /.widget-box -->
</div><!-- /.col -->