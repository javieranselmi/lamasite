<div class="col-md-6">
    <div class="widget-box transparent">
        <div class="widget-header widget-header-flat">
            <h4 class="widget-title lighter">
                <i class="ace-icon fa fa-star orange"></i>
                {{ $name }} mas comentados
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
                                <i class="ace-icon fa fa-caret-right blue"></i>{{ strtolower($name) }}
                            </th>

                            <th>
                                <i class="ace-icon fa fa-caret-right blue"></i>comentarios
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($resources as $resource)
                                <tr>
                                    <td>
                                        {{ $resource->name }}
                                    </td>
                                    <td>
                                        {{ $resource->comments_count }}
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