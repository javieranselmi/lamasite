<div class="col-md-6">
    <div class="widget-box transparent">
        <div class="widget-header widget-header-flat">
            <h4 class="widget-title lighter">
                <i class="ace-icon fa fa-star orange"></i>
                Logins por usuario
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
                                <i class="ace-icon fa fa-caret-right blue"></i>usuario
                            </th>

                            <th>
                                <i class="ace-icon fa fa-caret-right blue"></i>cantidad
                            </th>

                            <th class="hidden-480">
                                <i class="ace-icon fa fa-caret-right blue"></i>ultimo login
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($user_login_metrics as $user_metric)
                                <tr>
                                    <td>
                                        {{ $user_metric->get(0)->user->name }}
                                    </td>
                                    <td>
                                        {{ $user_metric->count() }}
                                    </td>
                                    <td>
                                        {{ $user_metric->get(0)->created_at->format('d-M-Y H:i') }}
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