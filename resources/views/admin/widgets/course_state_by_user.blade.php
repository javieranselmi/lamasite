<div class="col-md-6">
    <div class="widget-box transparent">
        <div class="widget-header widget-header-flat">
            <h4 class="widget-title lighter">
                <i class="ace-icon fa fa-star orange"></i>
                Estados de cursos por usuario
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
                                <i class="ace-icon fa fa-caret-right blue"></i>curso
                            </th>

                            <th class="hidden-480">
                                <i class="ace-icon fa fa-caret-right blue"></i>estado
                            </th>
                        </tr>
                        </thead>

                        <tbody>
                            @foreach($users as $user)
                                @foreach($user->getFinishedCourses() as $finishedCourse)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $finishedCourse->name }}
                                        </td>
                                        <td>
                                            <span class="label label-success arrowed-in arrowed-in-right">completado</span>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($user->getPendingCourses() as $pendingCourse)
                                    <tr>
                                        <td>
                                            {{ $user->name }}
                                        </td>
                                        <td>
                                            {{ $pendingCourse->name }}
                                        </td>
                                        <td>
                                            <span class="label label-danger arrowed">pendiente</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!-- /.widget-main -->
        </div><!-- /.widget-body -->
    </div><!-- /.widget-box -->
</div><!-- /.col -->