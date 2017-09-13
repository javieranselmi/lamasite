<div class="row">
    <div class="col-12 py-3 active-comment">
        <h5><strong>{{ $resource->comments->count() }}
                Comentario{{$resource->comments->count() <> 1 ? "s" : ""}}</strong></h5>
    </div>
    <div class="w-100 mb-2" style="height: 1px; background-color: lightgray;"></div>
</div>

<div class="row py-3">
    <div class="col-auto">
        <i class="fa fa-comments-o" aria-hidden="true" style="font-size: 52px;margin-top: -4px;"></i>
    </div>
    <div class="col pr-0">
        <input id="content" class="form-control form-control-lg" type="text" placeholder="Comentar ...">
    </div>
    <div class="col-auto">
        <button href="{{ route('comment.store',$resource instanceof \App\Post ? ['post_id' => $resource->id] : ['course_id' => $resource->id]) }}" id="comment_button"
                type="button" class="btn btn-primary btn-lg" style="margin-left: 10px;"><i class="fa fa-paper-plane" style="color: #fff" aria-hidden="true"></i>
        </button>
    </div>
</div>

@foreach($resource->comments as $c)
    <div class="row py-3" id="comment_{{ $c->id }}">
        <div class="col-auto">
            <img class="img-fluid" src="{{ asset('img/user.png') }}" width="52">
        </div>
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="row pl-3">
                        <div class="col-auto pr-2">
                            <strong>{{$c->user->name }}</strong>
                        </div>
                        <div class="col-auto text-muted">{{$c->created_at->format('d-m-Y H:i:s') }}</div>
                    </div>
                </div>
                <div class="col-12">{{$c->content }}
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-sm-auto">
                            @if($c->user->id == Auth::user()->id || Auth::user()->hasRole('admin'))
                                <a class="text-muted delete_comment"
                                   href="{{ route('comment.destroy',['comment_id' => $c->id]) }}">Eliminar</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


<script type="text/javascript">

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.delete_comment').click(function (e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
            var tag = $(this);

            if ($(this).data('requestRunning')) {
                return;
            }

            $(this).parent().append('<img style="width: 28px;" id="loading" src={{ asset('img/loading-icon.svg') }} />')
            $(this).data('requestRunning', true);

            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'html',

                success: function (result) {
                    $('#comment-section').html(result);
                    tag.data('requestRunning', false);
                    tag.parent().find('#loading').remove();
                },
                error: function (xhr, status, errorThrown) {
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    tag.data('requestRunning', false);
                    tag.parent().find('#loading').remove();
                }
            });
        });

        $('#comment_button').click(function (e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
            var tag = $(this);
            if ($(this).data('requestRunning')) {
                return;
            }
            $(this).parent().append('<img style="width: 28px;" id="loading" src={{ asset('img/loading-icon.svg') }} />')
            $(this).data('requestRunning', true);
            var url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    'content': $('#content').val()
                },
                dataType: 'html',

                success: function (result) {
                    $('#comment-section').html(result);
                    tag.data('requestRunning', false);
                    tag.parent().find('#loading').remove();
                },
                error: function (xhr, status, errorThrown) {
                    noty({
                        text: 'El cuadro de texto está vacio.',
                        type: 'error',
                        theme: 'metroui',
                        layout: 'topRight',
                        timeout: 2000,
                        progressBar: true,
                        closeWith: ['click'],
                        animation: {
                            open: 'animated fadeInDown',
                            close: 'animated fadeOutUp'
                        }});
                    console.log(xhr.status);
                    console.log(xhr.responseText);
                    tag.data('requestRunning', false);
                    tag.parent().find('#loading').remove();
                }
            })
        });

    });
</script>
