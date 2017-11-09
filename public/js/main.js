$("body").delegate("#form-refer-client", "submit", function (event) {
    event.preventDefault();
    var form = this;
    var url = $(this).attr('action');
    $.ajax({
        type: $(form).attr('method'),
        url: url,
        data: $('form').serialize(),
        dataType: "json",
        success: function (data, status, object) {
            if (data.status == 'success') {
                $(form).find('.response-msg').html('<div class="alert alert-success">'+ data.message +'</div>');
                setTimeout(function() {
                    $('#refer-model').modal('hide')
                }, 1000);
            } else {
                $(form).find('.response-msg').html('<div class="alert alert-danger">'+ data.message +'</div>');
            }
        }
    });
});