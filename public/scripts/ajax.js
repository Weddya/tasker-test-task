function printMessage(status, message) {
    $('#ajax-message div.alert').remove();
    let ajax_status = status ? status : 'info';
    let ajax_message = message ? message : '';
    $('#ajax-message').append(
            `<div class="alert alert-` + ajax_status + ` alert-dismissible fade show" role="alert">
                        ` + ajax_message + `
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);
}

$(document).ready(function () {
    $('form').submit(function (event) {
        var el = $(this);
        var json;
        event.preventDefault();
        $.ajax({
            type: el.attr('method'),
            url: el.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            error: function (err) {
                if (err.status == 403) {
                    $('#ajax-message div.alert').remove();
                    $('#ajax-message').append(
                            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Ошибка:</strong> Требуется авторизация!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`);
                }
            },
            success: function (result) {
                json = jQuery.parseJSON(result);
                if (el.attr('id') == 'add-form' && json.status == 'success') {
                    el[0].reset();
                }

                if (json.url) {
                    window.location.href = json.url;
                } else {
                    printMessage(json.status, json.message);
                }
            },
        });
    });
    
    $('.change-status').click(function () {
        var el = $(this);
        var status = parseInt($(this).attr('data-status'));
        var id = parseInt($(this).attr('data-id'));
        var new_status = (status === 0) ? 1 : 0;
        var json;
        $.ajax({
            type: 'POST',
            url: '/',
            data: {
                id: id,
                status: new_status,
            },
            success: function(result) {
                json = jQuery.parseJSON(result);
                if (json.success) {
                    if (status === 1) {
                        el.text('Не выполнена');
                        el.attr('data-status', 0);
                        el.parents('tr').removeClass('table-success');
                    } else if (status === 0) {
                        el.text('Выполнена');
                        el.attr('data-status', 1);
                        el.parents('tr').addClass('table-success');
                    }
                } else {
                    printMessage(json.status, json.message);
                }
            },
        });
    });
});