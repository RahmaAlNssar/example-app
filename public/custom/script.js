// const { inProduction } = require("laravel-mix");

function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source) checkboxes[i].checked = source.checked;
    }
}

//alert delete
$(document).on("click", "#warning", function (e) {
    //Some code 1

    e.preventDefault();
    var id = $(this).data("id");
    var href = $(this).attr("href");
    var token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        title: "Do You Want To Continue ?",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: href,
                type: "DELETE",
                data: { id: id, _token: token },
                dataType: "json",

            })
                .done(function (response) {
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        $(".example").DataTable().ajax.reload();
                    });
                })
                .fail(function() {

                    swal.fire("Oops...","some thing wrong","error");

                });
                // .error(function( data ) {
                //     // uh oh, something went wrong a 4xx response was returned (could be 400, 422 etc)
                //     // backend - return response()->json(['message' => 'Email is not in the proper format!'], 422);
                //     swal("Oops...", data.responseJSON.message, "error");
                // });
        }
    });
});

//alert submit

$(document).on("submit", ".submit", function (e) {
    //Some code 1
    e.preventDefault();

    var action = $(this).attr("action");
    var token = $("meta[name='csrf-token']").attr("content");
    var data = $(this).serialize();
    var type = $(this).attr("method");
    let form = $(this);
    $.ajax({
        type: type,
        url: action,
        data: data,
        dataType: "json",
        success: function (response) {
            swal.fire(response.title, response.message, response.status);
            form.trigger("reset");
        },
        error: function (err) {
            $.each(err.responseJSON.errors, function (key, value) {
                $("#" + key)
                    .next()
                    .html(value[0]);
                $("#" + key)
                    .next()
                    .removeClass("d-none");
            });
        },
    });
});
$(document).on("click", ".toggle-class", function (e) {
    e.preventDefault();
    var token = $("meta[name='csrf-token']").attr("content");
    var id = $(this).data("id");
    var href = $(this).attr("href");
    Swal.fire({
        title:"Do You Want To Continue?",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: href,
                type: "post",
                data: { _token: token },
                dataType: "json",
            })
                .done(function (response, dataResult) {
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        $(".example").DataTable().ajax.reload();
                    });
                    // $(".example").location.reload();
                })
                .fail(function () {
                    swal.fire("Oops...","Some Thing Wrong", "error");
                });
        }
    });
});

$(document).on("click", ".multi-delete", function (e) {
    e.preventDefault();
    var id = [];
    var token = $("meta[name='csrf-token']").attr("content");
    var href = $(this).attr("href");
    $(".checkbox:checked").each(function () {
        id.push($(this).val());
    });
    Swal.fire({
        title: "Do You Want To Continue ?",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {

        if (id.length > 0 && result.value) {
            $.ajax({
                type: "delete",
                url: href,
                data: { id: id, _token: token },
                dataType: "json",
                success: function (response) {
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        $(".example").DataTable().ajax.reload();
                    });
                },
                error: function (data) {

                   swal.fire("Oops...", data.responseJSON.message, "error");
                },
            });
        } else {

            swal.fire("Oops...","Some Thing Wrong", "error");
        }
    });
});


