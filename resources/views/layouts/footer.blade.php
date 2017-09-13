<!-- Indice de secciones con sus circulos -->
<div class="container-fluid" id="indice-circulos">
    <div class="card-group">
        <div class="card" onclick="window.location.href='{{ route('courses') }}'">
            <div class="card-block text-center">
                <img class="card-img-top" src="{{ asset('img/circle1.png') }}" height="150" width="150">
                <h4 class="card-title my-3">Cursos</h4>
                <p class="card-text text-muted">{!! $texts->where('name', 'menu-cursos')->first()->content !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-block text-center" onclick="window.location.href='{{ route('product_categories') }}'">
                <img class="card-img-top" src="{{ asset('img/circle2.png') }}" height="150" width="150">
                <h4 class="card-title my-3">Productos</h4>
                <p class="card-text text-muted">{!! $texts->where('name', 'menu-productos')->first()->content !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-block text-center" onclick="window.location.href='{{ route('library') }}'">
                <img class="card-img-top" src="{{ asset('img/circle3.png') }}" height="150" width="150">
                <h4 class="card-title my-3">Biblioteca</h4>
                <p class="card-text text-muted">{!! $texts->where('name', 'menu-biblioteca')->first()->content !!}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-block text-center" onclick="window.location.href='{{ route('meetings') }}'">
                <img class="card-img-top" src="{{ asset('img/circle4.png') }}" height="150" width="150">
                <h4 class="card-title my-3">Ciclos</h4>
                <p class="card-text text-muted">{!! $texts->where('name', 'menu-ciclos')->first()->content !!}</p>
            </div>
        </div>
    </div>
</div>

<!-- Agemda -->
<div class="container-fluid agenda py-5">
    <div class="row">
        <div class="col-md-3 offset-md-1">
            <div class="card">
                <div class="card-block">
                    <h2 class="card-title">AGENDA</h2>
                    <p class="card-text text-muted">
                        {!! $texts->where('name', 'agenda')->first()->content !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-auto mx-2 text-center align-self-center calendario-arrow" id="calendario-anterior">
                    <img src="{{ asset('img/left-calendar-arrow.png') }}" height="40" width="40">
                </div>
                <div class="col-md-9 p-2 text-center align-self-center container-calendario">
                    <div class="container-fluid px-2 px-md-0">
                        <div class="row justify-content-center">

                            <div class="col-12 col-lg py-lg-0 py-2 calendario calendario-current mb-2 mb-sm-0">
                                <div class="row no-gutters" style="background-color: whitesmoke; height: 230px;">
                                    <div class="col-12 text-left pl-4">
                                        <h2 class="mb-2 mt-3" id="current-month-name">Enero</h2>
                                    </div>
                                    <div class="col-12 ">
                                        <div class="row no-gutters w-75 mx-auto month-days">
                                            <div class="col" style="margin-left: 1px;">D</div>
                                            <div class="col">L</div>
                                            <div class="col">M</div>
                                            <div class="col">X</div>
                                            <div class="col">J</div>
                                            <div class="col">V</div>
                                            <div class="col">S</div>
                                            <div class="w-100"></div>

                                        </div>
                                    </div>
                                    <span class="col-12 py-2 mt-1 mb-3"></span>
                                </div>
                            </div>
                            <div class="col-12 col-lg calendario calendario-next">
                                <div class="row no-gutters" style="background-color: whitesmoke; height: 230px;">
                                    <div class="col-12 text-left pl-4"><h2 class="mb-2 mt-3" id="next-month-name">Enero</h2></div>
                                    <div class="col-12 ">
                                        <div class="row no-gutters w-75 mx-auto month-days">
                                            <div class="col" style="margin-left: 1px;">D</div>
                                            <div class="col">L</div>
                                            <div class="col">M</div>
                                            <div class="col">X</div>
                                            <div class="col">J</div>
                                            <div class="col">V</div>
                                            <div class="col">S</div>
                                            <div class="w-100"></div>
                                        </div>
                                    </div>

                                    <span class="col-12 py-2 mt-1 mb-3"></span>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-auto mx-2 text-center align-self-center calendario-arrow" id="calendario-posterior">
                    <img class="img-fluid" src="{{ asset('img/left-calendar-arrow.png') }}" style="transform: rotate(180deg); margin: 0 auto;" height="40" width="40">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel1">Modal title</h4>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Formulario de contacto -->
<div class="container-fluid pr-0" id="contact-form">
    <div class="row pl-md-2 mr-0">
        <div class="col-md-4 my-1 p-4">
            <form name="contact_form">
                <h1>CONTACTÁNOS</h1>
                <div class="form-group">
                    <input class="form-control" placeholder="NOMBRE" type="text" value="" id="contact_name">
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="E-MAIL" type="email" id="contact_email">
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="MENSAJE" id="contact_message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">ENVIAR</button>
            </form>
        </div>
        <div style="background: linear-gradient(270deg, #eceeef 4%, transparent 4%);" class="col-md-4 py-5">
            <div class="row py-3 no-gutters align-items-center">
                <div class="col-xl-2 text-center">
                    <img class="mx-auto" src="{{ asset('img/mail-button.png') }}" height="46" width="46">
                </div>
                <div class="col-xl-10 text-center text-xl-left">
                    <h4 class="m-0" >{{ !is_null($contact) ? strtoupper($contact->email) : "MAIL@NUTRICIA.COM.AR" }}</h4>
                </div>
            </div>
            <div class="row py-3 no-gutters align-items-center">
                <div class="col-xl-2 text-center">
                    <img class="mx-auto" src="{{ asset('img/phone-button.png') }}" height="46" width="46">
                </div>
                <div class="col-xl-10 text-center text-xl-left">
                    <h4 class="m-0" >{{ !is_null($contact) ? $contact->phone_one : "0800 333 1111" }}</h4>
                </div>
            </div>
            <div class="row py-3 no-gutters align-items-center">
                <div class="col-xl-2 text-center">
                    <img class="mx-auto" src="{{ asset('img/mobile-button.png') }}" height="46" width="46">
                </div>
                <div class="col-xl-10 text-center text-xl-left">
                    <h4 class="m-0" >{{ !is_null($contact) ? $contact->phone_two : "+54 11 5 555 1213" }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4" id="acerca-de" data-toggle="modal" data-target="#acercaDeNutriste" style="cursor: pointer;">
            <h2 class="w-100 pr-2 mb-0 py-2 text-right" style="background: linear-gradient(90deg, transparent 30%, rgb(150,129,176))">Acerca de Nutrisite</h2>
        </div>
    </div>
</div>

<!---->

<div class="jumbotron" >
    <div class="row" style="padding-bottom: 20px;">
        <div class="col-12">
            <div class="vertical-line" style="height: 25px;" ></div>
            <a href="{{ route('sitemap') }}" style="padding-left: 5px; color: #636c72!important">Mapa de Sitio</a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <p class="text-muted">Desarrollado por FOUR Estrategia y Comunicacion</p>
        </div>
        <div class="col-12 text-center">
            <img class="img-fluid h-50" src="{{ asset('img/NutriciaActivaLogoFooter.png') }}">
        </div>
    </div>
</div>


<div class="modal" id="eventModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="eventsOfDay">Eventos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul id="eventList">
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="acercaDeNutriste" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="eventsOfDay">Acerca de Nutrisite</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $texts->where('name', 'acerca-de-nutrisite')->first()->content !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    var events = JSON.parse('{!! $events !!}');

    var daysMonth = function(y, m){
        return m===2?y&3||!(y%25)&&y&15?28:29:30|(m+(m>>3));
    };

    var renderCalendar = function(year, month, monthDays){
        monthDays.html('<div class="col" style="margin-left: 1px;">D</div><div class="col">L</div><div class="col">M</div><div class="col">X</div><div class="col">J</div><div class="col">V</div><div class="col">S</div><div class="w-100"></div>');

        var daysInMonth = daysMonth(year, month+1);
        var startDay = new Date(year, month, 1);
        var first = true;
        startDay = startDay.getDay();
        var i;
        for(i = 0; i < (daysInMonth+startDay); i++){
            if(i < startDay){
                if (first) {
                    monthDays.append('<div class="col" style="margin-left: 1px;"></div>');
                    first = false;
                } else {
                    monthDays.append('<div class="col"></div>');
                }
                continue;
            }
            if((i % 7) == 0){ //Salto de linea cuando llego a los 7.
                monthDays.append('<div class="w-100"></div>');
                first = true;
            }
            var eventsOfTheDay = events.filter((e) => {
                var eventDate = new Date(e.event_at.replace(/-/g, "/"));
                return eventDate.getFullYear() == year && eventDate.getMonth() == month && eventDate.getDate() == (i-startDay+1);
            });

            var isEventClass = (eventsOfTheDay.length > 0 ? " event" : "");
            var append = '';

            if (first) {
                append = '<div style="margin-left: 1px;" class="col'+isEventClass+'" '+(eventsOfTheDay.length > 0 ? 'data-events=\''+JSON.stringify(eventsOfTheDay)+'\' data-toggle="modal" data-target="#eventModal"' : '')+'>'+(i-startDay+1)+'</div>';
                first = false;
            } else {
                append = '<div class="col'+isEventClass+'" '+(eventsOfTheDay.length > 0 ? 'data-events=\''+JSON.stringify(eventsOfTheDay)+'\' data-toggle="modal" data-target="#eventModal"' : '')+'>'+(i-startDay+1)+'</div>';
            }

            monthDays.append(append);
        }

        /*var maxAmount = daysInMonth > 28 && startDay > 5 ? 42 : 35;
        for(i = 0; i < maxAmount - (daysInMonth + startDay); i++){
            monthDays.append('<div class="col"></div>');
        }*/

        var cantDivs = (42 - (startDay + daysInMonth)) % 7;
        for(i = 0; i < cantDivs; i++){
            monthDays.append('<div class="col"></div>');
        }



    };

    $(document).ready(function(){
        var months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        var currentMonth = new Date();
        var nextMonth = new Date(currentMonth.getFullYear(), currentMonth.getMonth() == 11 ? 0 : currentMonth.getMonth()+1, 1);


        $('#current-month-name').html(months[currentMonth.getMonth()] + " " + currentMonth.getFullYear());
        $('#next-month-name').html(months[nextMonth.getMonth()] + " " + nextMonth.getFullYear());

        renderCalendar(currentMonth.getFullYear(), currentMonth.getMonth(), $($(".month-days")[0]));
        renderCalendar(currentMonth.getFullYear(), nextMonth.getMonth(), $($(".month-days")[1]));

        $('#eventModal').on('show.bs.modal', function(e) {
            //get data-id attribute of the clicked element
            var relatedTarget = $(e.relatedTarget);
            $('#eventList').html('');
            var eventsOfTheDay = relatedTarget.data('events');
            eventsOfTheDay.forEach(function(event){
                $('#eventList').append('<li>'+event.title+' - '+event.event_at+' <br> <span>'+event.description+'</span></li>')
            });
        });

        $('#calendario-anterior').click(function(){
            var today = new Date();
            if(currentMonth.getMonth() == today.getMonth() && today.getFullYear() == currentMonth.getFullYear()){
                return false;
            }

            currentMonth = new Date(currentMonth.getMonth() == 0 ? currentMonth.getFullYear()-1 : currentMonth.getFullYear(), currentMonth.getMonth() == 0 ? 11 : currentMonth.getMonth()-1, 1);
            nextMonth = new Date(currentMonth.getMonth() == 11 ? currentMonth.getFullYear()+1 : currentMonth.getFullYear(), currentMonth.getMonth() == 11 ? 0 : currentMonth.getMonth()+1, 1);

            $('#current-month-name').html(months[currentMonth.getMonth()] + " " + currentMonth.getFullYear());
            $('#next-month-name').html(months[nextMonth.getMonth()] + " " + nextMonth.getFullYear());

            renderCalendar(currentMonth.getFullYear(), currentMonth.getMonth(), $($(".month-days")[0]));
            renderCalendar(nextMonth.getFullYear(), nextMonth.getMonth(), $($(".month-days")[1]));

        });

        $('#calendario-posterior').click(function(){

            nextMonth = new Date(nextMonth.getMonth() == 11 ? nextMonth.getFullYear()+1 : nextMonth.getFullYear(), nextMonth.getMonth() == 11 ? 0 : nextMonth.getMonth()+1, 1);
            currentMonth = new Date(nextMonth.getMonth() == 0 ? nextMonth.getFullYear()-1 : nextMonth.getFullYear(), nextMonth.getMonth() == 0 ? 11 : nextMonth.getMonth()-1, 1);

            $('#current-month-name').html(months[currentMonth.getMonth()] + " " + currentMonth.getFullYear());
            $('#next-month-name').html(months[nextMonth.getMonth()] + " " + nextMonth.getFullYear());

            renderCalendar(currentMonth.getFullYear(), currentMonth.getMonth(), $($(".month-days")[0]));
            renderCalendar(nextMonth.getFullYear(), nextMonth.getMonth(), $($(".month-days")[1]));
        });



        $("form[name=contact_form]").submit(function(){
            var name = $('#contact_name').val();
            var email = $('#contact_email').val();
            var message = $('#contact_message').val();

            if(name != "" && email != "" && message != ""){
                $.ajax({
                    url: "{{ route('contact_post') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {name: name, email: email, message: message},
                    success: function(result) {
                        alert('Su mensaje ha sido enviado. Nos comunicaremos a la brevedad.');
                        $("form[name=contact_form]")[0].reset();
                    },
                    error: function (xhr, status, errorThrown) {
                        alert('Hubo un error inesperado. Por favor intente mas tarde.');
                    }
                });
                return false;
            }else{
                alert('Por favor complete todos los campos');
            }
        });
    });
</script>