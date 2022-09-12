// const { inProduction } = require("laravel-mix");

const { then } = require("laravel-mix");

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




$(document).on("submit", "#form", function (e) {
    //Some code 1

    e.preventDefault();

    var action = $(this).attr("action");
    var token = $("meta[name='csrf-token']").attr("content");
    var data = $("input[name='file']").val();

    var type = $(this).attr("method");
    let form = $(this);

            $.ajax({
                url: action,
                type: type,
                data:{data,_token:token},
                dataType: "json",
                success:function (results) {
                    if (results.success === true) {
                        swal.fire(results.title,results.message,results.status
                            ).then((result) => {
                                // Reload the Page
                                $(".example").DataTable().ajax.reload();
                            });
                    } else {
                        swal.fire("Error!", "you select wrong file", "error");
                    }

                },
                error: function (jqXhr,textStatus, errorMessage ) {
                    if (jqXhr.readyState == 0) {
                         return false;
                     } else if (jqXhr.status == 422) {
                         $.each(jqXhr.responseJSON.errors, function (key, val) {
                             key = key.split('.');
                             if (key.length > 1) {
                                 form.find(`input[name*='${key[0]}[${key[1]}][${key[2]}]']`).parent().next('span.error').text(val).fadeIn(300);
                             } else {
                                 form.find(`#${key}-error`).text(val).fadeIn(300);
                             }
                         });
                     } else {
                         if (jqXhr.responseJSON.line) {
                             toast('File: ' + jqXhr.responseJSON.file + ' (Line: ' + jqXhr.responseJSON.line + ')', jqXhr.responseJSON.message)
                         } else {
                             toast(jqXhr.responseJSON, title = null);
                         }
                     }
                 },
            })



});
// $(document).on("click", "#upload_link", function (e) {

//     e.preventDefault();

//     var input= $('input[type=file]').val();
//     alert(input);

// });

