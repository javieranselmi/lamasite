(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home","action":"App\Http\Controllers\HomeController@index"},{"host":null,"methods":["POST"],"uri":"contacto","name":"contact_post","action":"App\Http\Controllers\ContactController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"buscar","name":"search","action":"App\Http\Controllers\SearchController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"reuniones_de_ciclo","name":"meetings","action":"App\Http\Controllers\MeetingsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"reuniones_de_ciclo\/descargar\/{file_id}","name":"meetings_download_file","action":"App\Http\Controllers\MeetingsController@download_file"},{"host":null,"methods":["GET","HEAD"],"uri":"reuniones_de_ciclo\/listar\/{folder_id}","name":"meetings_list_folder","action":"App\Http\Controllers\MeetingsController@get_folder_contents"},{"host":null,"methods":["GET","HEAD"],"uri":"cursos","name":"courses","action":"App\Http\Controllers\CoursesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"cursos\/{course_id}","name":"course","action":"App\Http\Controllers\CoursesController@getCourse"},{"host":null,"methods":["GET","HEAD"],"uri":"cursos\/{course_id}\/etapas\/{course_stage_id}","name":"course_stage","action":"App\Http\Controllers\CourseStagesController@getCourseStage"},{"host":null,"methods":["GET","HEAD"],"uri":"biblioteca","name":"library","action":"App\Http\Controllers\LibraryController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"biblioteca\/articulo\/{post_id}","name":"library_post","action":"App\Http\Controllers\LibraryController@getPost"},{"host":null,"methods":["POST"],"uri":"biblioteca\/articulo\/share","name":"library.share","action":"App\Http\Controllers\LibraryController@share"},{"host":null,"methods":["GET","HEAD"],"uri":"categorias_producto","name":"product_categories","action":"App\Http\Controllers\ProductCategoriesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"categorias_producto\/{product_category_id}","name":"product_categories_detail","action":"App\Http\Controllers\ProductCategoriesController@getCategory"},{"host":null,"methods":["GET","HEAD"],"uri":"categorias_producto\/{product_category_id}\/subcategorias\/{product_subcategories_id}","name":"product_subcategories_detail","action":"App\Http\Controllers\ProductSubcategoriesController@getSubcategory"},{"host":null,"methods":["GET","HEAD"],"uri":"sitemap","name":"sitemap","action":"App\Http\Controllers\SitemapController@index"},{"host":null,"methods":["POST"],"uri":"producto\/compartir","name":"share_product","action":"App\Http\Controllers\ProductCategoriesController@share"},{"host":null,"methods":["POST"],"uri":"metricas","name":"metric_post","action":"App\Http\Controllers\MetricController@send_metric"},{"host":null,"methods":["GET","HEAD"],"uri":"reset\/{token}","name":"reset_form","action":"App\Http\Controllers\ResetPasswordController@show_reset_password_form"},{"host":null,"methods":["POST"],"uri":"reset\/{token}","name":"reset_password","action":"App\Http\Controllers\ResetPasswordController@reset_password"},{"host":null,"methods":["GET","HEAD"],"uri":"recover","name":"recover","action":"App\Http\Controllers\ResetPasswordController@index"},{"host":null,"methods":["POST"],"uri":"recover","name":"recover_post","action":"App\Http\Controllers\ResetPasswordController@recover"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"logout","action":"App\Http\Controllers\AuthenticationController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\AuthenticationController@index"},{"host":null,"methods":["POST"],"uri":"login","name":"login_post","action":"App\Http\Controllers\AuthenticationController@authenticate"},{"host":null,"methods":["GET","HEAD"],"uri":"ping","name":"ping","action":"App\Http\Controllers\PingController@index"},{"host":null,"methods":["POST"],"uri":"like","name":"like.store","action":"App\Http\Controllers\LikesController@store"},{"host":null,"methods":["DELETE"],"uri":"like\/{like}","name":"like.destroy","action":"App\Http\Controllers\LikesController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"comment","name":"comment.index","action":"App\Http\Controllers\CommentsController@index"},{"host":null,"methods":["POST"],"uri":"comment","name":"comment.store","action":"App\Http\Controllers\CommentsController@store"},{"host":null,"methods":["DELETE"],"uri":"comment\/{comment}","name":"comment.destroy","action":"App\Http\Controllers\CommentsController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin","name":null,"action":"App\Http\Controllers\Admin\AuthenticationController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/login","name":"admin_login","action":"App\Http\Controllers\Admin\AuthenticationController@index"},{"host":null,"methods":["POST"],"uri":"admin\/login","name":"admin_login_post","action":"App\Http\Controllers\Admin\AuthenticationController@authenticate"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/dashboard","name":"admin_dashboard","action":"App\Http\Controllers\Admin\DashboardController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/productos","name":"admin_products","action":"App\Http\Controllers\Admin\ProductsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/productos\/add","name":"admin_products_add","action":"App\Http\Controllers\Admin\ProductsController@add_form"},{"host":null,"methods":["POST"],"uri":"admin\/productos\/add","name":"admin_products_add_post","action":"App\Http\Controllers\Admin\ProductsController@create_product"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/productos\/edit\/{product_id}","name":"admin_products_edit","action":"App\Http\Controllers\Admin\ProductsController@edit_form"},{"host":null,"methods":["POST"],"uri":"admin\/productos\/edit\/{product_id}","name":"admin_products_edit_post","action":"App\Http\Controllers\Admin\ProductsController@edit_product"},{"host":null,"methods":["DELETE"],"uri":"admin\/products\/delete\/{product_id}","name":"admin_products_delete","action":"App\Http\Controllers\Admin\ProductsController@delete_product"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/preguntas","name":"admin_questions","action":"App\Http\Controllers\Admin\QuestionsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/preguntas\/add","name":"admin_questions_add","action":"App\Http\Controllers\Admin\QuestionsController@add_form"},{"host":null,"methods":["POST"],"uri":"admin\/preguntas\/add","name":"admin_questions_add_post","action":"App\Http\Controllers\Admin\QuestionsController@create_question"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/preguntas\/edit\/{question_id}","name":"admin_questions_edit","action":"App\Http\Controllers\Admin\QuestionsController@edit_form"},{"host":null,"methods":["POST"],"uri":"admin\/preguntas\/edit\/{question_id}","name":"admin_questions_edit_post","action":"App\Http\Controllers\Admin\QuestionsController@edit_question"},{"host":null,"methods":["DELETE"],"uri":"admin\/preguntas\/delete\/{question_id}","name":"admin_questions_delete","action":"App\Http\Controllers\Admin\QuestionsController@delete_question"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/cursos","name":"admin_courses","action":"App\Http\Controllers\Admin\CoursesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/cursos\/add","name":"admin_courses_add","action":"App\Http\Controllers\Admin\CoursesController@add_form"},{"host":null,"methods":["POST"],"uri":"admin\/cursos\/add","name":"admin_courses_add_post","action":"App\Http\Controllers\Admin\CoursesController@create_course"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/cursos\/edit\/{course_id}","name":"admin_courses_edit","action":"App\Http\Controllers\Admin\CoursesController@edit_form"},{"host":null,"methods":["POST"],"uri":"admin\/cursos\/edit\/{course_id}","name":"admin_courses_edit_post","action":"App\Http\Controllers\Admin\CoursesController@edit_course"},{"host":null,"methods":["DELETE"],"uri":"admin\/cursos\/delete\/{course_id}","name":"admin_courses_delete","action":"App\Http\Controllers\Admin\CoursesController@delete_course"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/etapas_curso","name":"admin_course_stages","action":"App\Http\Controllers\Admin\CourseStagesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/etapas_curso\/add","name":"admin_course_stages_add","action":"App\Http\Controllers\Admin\CourseStagesController@add_form"},{"host":null,"methods":["POST"],"uri":"admin\/etapas_curso\/add","name":"admin_course_stages_add_post","action":"App\Http\Controllers\Admin\CourseStagesController@create_course_stage"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/etapas_curso\/edit\/{course_stage_id}","name":"admin_course_stages_edit","action":"App\Http\Controllers\Admin\CourseStagesController@edit_form"},{"host":null,"methods":["POST"],"uri":"admin\/etapas_curso\/edit\/{course_stage_id}","name":"admin_course_stages_edit_post","action":"App\Http\Controllers\Admin\CourseStagesController@edit_course_stage"},{"host":null,"methods":["DELETE"],"uri":"admin\/etapas_curso\/delete\/{course_stage_id}","name":"admin_course_stages_delete","action":"App\Http\Controllers\Admin\CourseStagesController@delete_course_stage"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/contacto","name":"admin_contact_edit","action":"App\Http\Controllers\Admin\ContactController@index"},{"host":null,"methods":["POST"],"uri":"admin\/contacto","name":"admin_contact_edit_post","action":"App\Http\Controllers\Admin\ContactController@edit_contact"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/notificaciones","name":"admin_notification_configuration_edit","action":"App\Http\Controllers\Admin\NotificationConfigurationsController@index"},{"host":null,"methods":["POST"],"uri":"admin\/notificaciones","name":"admin_notification_configuration_edit_post","action":"App\Http\Controllers\Admin\NotificationConfigurationsController@edit_configurations"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/novedad","name":"admin_news_edit","action":"App\Http\Controllers\Admin\NewsController@index"},{"host":null,"methods":["POST"],"uri":"admin\/novedad","name":"admin_news_edit_post","action":"App\Http\Controllers\Admin\NewsController@edit_news"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/reuniones_de_ciclo\/categorias","name":"admin_meetings_categories_list","action":"App\Http\Controllers\Admin\MeetingsController@index"},{"host":null,"methods":["POST"],"uri":"admin\/reuniones_de_ciclo\/categorias","name":"admin_meetings_categories_post","action":"App\Http\Controllers\Admin\MeetingsController@create_category"},{"host":null,"methods":["DELETE"],"uri":"admin\/reuniones_de_ciclo\/categorias\/{category_folder_id}","name":"admin_meetings_categories_delete","action":"App\Http\Controllers\Admin\MeetingsController@delete_category"},{"host":null,"methods":["PUT"],"uri":"admin\/reuniones_de_ciclo\/categorias\/{category_folder_id}","name":"admin_meetings_categories_edit","action":"App\Http\Controllers\Admin\MeetingsController@edit_category"},{"host":null,"methods":["DELETE"],"uri":"admin\/reuniones_de_ciclo\/carpetas\/{folder_id}","name":"admin_meetings_folder_delete","action":"App\Http\Controllers\Admin\MeetingsController@delete_folder"},{"host":null,"methods":["POST"],"uri":"admin\/reuniones_de_ciclo\/carpetas","name":"admin_meetings_folder_post","action":"App\Http\Controllers\Admin\MeetingsController@create_folder"},{"host":null,"methods":["PUT"],"uri":"admin\/reuniones_de_ciclo\/carpetas\/{folder_id}","name":"admin_meetings_folder_edit","action":"App\Http\Controllers\Admin\MeetingsController@edit_folder"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/reuniones_de_ciclo\/carpetas","name":"admin_meetings_get_folder_contents","action":"App\Http\Controllers\Admin\MeetingsController@get_contents"},{"host":null,"methods":["DELETE"],"uri":"admin\/reuniones_de_ciclo\/archivos\/{file_id}","name":"admin_meetings_file_delete","action":"App\Http\Controllers\Admin\MeetingsController@delete_file"},{"host":null,"methods":["POST"],"uri":"admin\/reuniones_de_ciclo\/archivos","name":"admin_meetings_file_post","action":"App\Http\Controllers\Admin\MeetingsController@create_file"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/textos","name":"admin_texts","action":"App\Http\Controllers\Admin\TextsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/textos\/edit\/{text_id}","name":"admin_texts_edit","action":"App\Http\Controllers\Admin\TextsController@edit_form"},{"host":null,"methods":["POST"],"uri":"admin\/textos\/edit\/{text_id}","name":"admin_texts_edit_post","action":"App\Http\Controllers\Admin\TextsController@edit_text"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/categorias_producto","name":"admin_product_categories","action":"App\Http\Controllers\Admin\ProductCategoriesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/categorias_producto\/add","name":"admin_product_categories_add","action":"App\Http\Controllers\Admin\ProductCategoriesController@add_form"},{"host":null,"methods":["POST"],"uri":"admin\/categorias_producto\/add","name":"admin_product_categories_add_post","action":"App\Http\Controllers\Admin\ProductCategoriesController@create_category"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/categorias_producto\/edit\/{product_category_id}","name":"admin_product_categories_edit","action":"App\Http\Controllers\Admin\ProductCategoriesController@edit_form"},{"host":null,"methods":["POST"],"uri":"admin\/categorias_producto\/edit\/{product_category_id}","name":"admin_product_categories_edit_post","action":"App\Http\Controllers\Admin\ProductCategoriesController@edit_category"},{"host":null,"methods":["DELETE"],"uri":"admin\/categorias_producto\/delete\/{product_category_id}","name":"admin_product_categories_delete","action":"App\Http\Controllers\Admin\ProductCategoriesController@delete_category"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/subcategorias_producto","name":"admin_product_subcategories","action":"App\Http\Controllers\Admin\ProductSubcategoriesController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/subcategorias_producto\/add","name":"admin_product_subcategories_add","action":"App\Http\Controllers\Admin\ProductSubcategoriesController@add_form"},{"host":null,"methods":["POST"],"uri":"admin\/subcategorias_producto\/add","name":"admin_product_subcategories_add_post","action":"App\Http\Controllers\Admin\ProductSubcategoriesController@create_subcategory"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/subcategorias_producto\/edit\/{product_category_id}","name":"admin_product_subcategories_edit","action":"App\Http\Controllers\Admin\ProductSubcategoriesController@edit_form"},{"host":null,"methods":["POST"],"uri":"admin\/subcategorias_producto\/edit\/{product_category_id}","name":"admin_product_subcategories_edit_post","action":"App\Http\Controllers\Admin\ProductSubcategoriesController@edit_subcategory"},{"host":null,"methods":["DELETE"],"uri":"admin\/subcategorias_producto\/delete\/{product_category_id}","name":"admin_product_subcategories_delete","action":"App\Http\Controllers\Admin\ProductSubcategoriesController@delete_subcategory"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/subcategorias_producto\/json","name":"admin_product_subcategories_get_json","action":"App\Http\Controllers\Admin\ProductSubcategoriesController@get_subcategories_from_category"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/events","name":"events.index","action":"App\Http\Controllers\Admin\EventsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/events\/create","name":"events.create","action":"App\Http\Controllers\Admin\EventsController@create"},{"host":null,"methods":["POST"],"uri":"admin\/events","name":"events.store","action":"App\Http\Controllers\Admin\EventsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/events\/{event}","name":"events.show","action":"App\Http\Controllers\Admin\EventsController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/events\/{event}\/edit","name":"events.edit","action":"App\Http\Controllers\Admin\EventsController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/events\/{event}","name":"events.update","action":"App\Http\Controllers\Admin\EventsController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/events\/{event}","name":"events.destroy","action":"App\Http\Controllers\Admin\EventsController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/posts","name":"posts.index","action":"App\Http\Controllers\Admin\PostsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/posts\/create","name":"posts.create","action":"App\Http\Controllers\Admin\PostsController@create"},{"host":null,"methods":["POST"],"uri":"admin\/posts","name":"posts.store","action":"App\Http\Controllers\Admin\PostsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/posts\/{post}","name":"posts.show","action":"App\Http\Controllers\Admin\PostsController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/posts\/{post}\/edit","name":"posts.edit","action":"App\Http\Controllers\Admin\PostsController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/posts\/{post}","name":"posts.update","action":"App\Http\Controllers\Admin\PostsController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/posts\/{post}","name":"posts.destroy","action":"App\Http\Controllers\Admin\PostsController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users","name":"users.index","action":"App\Http\Controllers\Admin\UserController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/create","name":"users.create","action":"App\Http\Controllers\Admin\UserController@create"},{"host":null,"methods":["POST"],"uri":"admin\/users","name":"users.store","action":"App\Http\Controllers\Admin\UserController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/{user}","name":"users.show","action":"App\Http\Controllers\Admin\UserController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/{user}\/edit","name":"users.edit","action":"App\Http\Controllers\Admin\UserController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/users\/{user}","name":"users.update","action":"App\Http\Controllers\Admin\UserController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/users\/{user}","name":"users.destroy","action":"App\Http\Controllers\Admin\UserController@destroy"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

