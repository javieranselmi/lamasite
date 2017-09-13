function notification(status, message){
    noty({
        text: message,
        type: status,
        theme: 'metroui',
        layout: 'topRight',
        timeout: 4000,
        progressBar: true,
        closeWith: ['click'],
        animation: {
            open: 'animated fadeInDown',
            close: 'animated fadeOutUp'
        }
    });
}

var dynamicTable = (function () {
    var instance;

    function createInstance(opts) {
        return $('#dynamic-table').DataTable(opts);
    }

    return {
        getInstance: function (opts) {
            opts = opts || {
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
            };
            if (!instance) {
                instance = createInstance(opts);
            }
            return instance;
        }
    };
})();

var createFolder = function(parent_folder_id, name, callback){
    $.post(laroute.route('admin_meetings_folder_post'), {meetings_folder_name: name, meetings_parent_folder_id: parent_folder_id}, function(data){
        if(data.status == 'success'){
            $("#createFolderModal").modal('hide');
            callback(data.folder);
        }
        notification(data.status, data.message);
    });
};

var deleteFolder = function(folder_id, callback){
    $.ajax({
        url: laroute.route('admin_meetings_folder_delete', {folder_id: folder_id}),
        type: 'DELETE',
        dataType: 'json',
        success: function(result) {
            notification(result.status, result.message);
            callback(folder_id);
        },
        error: function (xhr, status, errorThrown) {
            notification('error', 'Hubo un error inesperado. Por favor intente mas tarde.');
        }
    });
};

var updateFolder = function(folder_id, name, callback){
    $.ajax({
        url: laroute.route('admin_meetings_folder_edit', {folder_id: folder_id}),
        data: {meetings_folder_name: name},
        type: 'PUT',
        dataType: 'json',
        success: function(result) {
            notification(result.status, result.message);
            callback(result.folder);
        },
        error: function (xhr, status, errorThrown) {
            notification('error', 'Hubo un error inesperado. Por favor intente mas tarde.');
        }
    });
};

var setFolderCreateClick = function(parent_id, callback){
    $('#createFolder').unbind('click');
    $('#createFolder').click(function(){
       if($('#meetings_folder_name')[0].checkValidity()){
           createFolder(parent_id, $('#meetings_folder_name').val(), callback);
           return;
       }
       $('#createFolderError').show();
    });
};

var setFolderDeleteClick = function(callback){
    $('.delete_folder').unbind('click');
    $('.delete_folder').click(function(e){
        var folder_id = $(this).data('folder_id');
        deleteFolder(folder_id, callback);
    });
};

var deleteResource = function(e){
    e.stopImmediatePropagation();
    e.stopPropagation();
    e.preventDefault();

    var myTable = dynamicTable.getInstance();

    var url = $(this).attr('href');
    var row = myTable.row($(this).parents('tr'));
    $.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'json',
        success: function(result) {
            notification(result.status, result.message);
            row.remove().draw();
        },
        error: function (xhr, status, errorThrown) {
            notification('error', 'Hubo un error inesperado. Por favor intente mas tarde.');
        }
    });
};