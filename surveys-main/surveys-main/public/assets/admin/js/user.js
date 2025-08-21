$(function () {
    var base_url = $("#base_url").val();

    $(document).on("submit", "#userForm", function (e) {
        e.preventDefault();

        if (1) {
            var formData = new FormData($(this)[0]);
            var csrfToken = $('input[name="_token"]').val();
            var mode = $("#mode").val();

            $("#savebtn").css("display", "none");
            $("#loaderbtn").css("display", "block");

            var type = "POST";
            var urlpath = base_url + "/admin/user/addeditaction";

            $("#successmsg").text("");
            $("#errormsg").text("");

            $.ajax({
                url: urlpath,
                type: type,
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                success: function (response) {
                    if (!$.isEmptyObject(response.errors)) {
                        $.each(response.errors, function (key, value) {
                            $("#" + key + "_error").text(value);
                            $("#" + key).css("border", "1px solid red");
                            $("#" + key)
                                .siblings(".select2-container")
                                .find(".select2-selection")
                                .css("border", "1px solid red");
                        });
                    }
                    if (response.msg_status == 2) {
                        $("#errormsg").text(response.msg_data);
                    }

                    if (response.msg_status == 1) {
                        if (mode == "Add") {
                            $("#userForm")[0].reset();
                            $("#role_id").val("").change();
                        } else {
                            $("#successmsg").text(response.msg_data);
                        }
                        $("#commonModal").modal("hide");
                        refreshData(base_url + "/admin/user");
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function (field, messages) {
                            var errorHtml = '<ul class="list-unstyled">';
                            $.each(messages, function (index, message) {
                                errorHtml += "<li>" + message + "</li>";
                            });
                            errorHtml += "</ul>";
                            $("#my-form")
                                .find('[name="' + field + '"]')
                                .after(errorHtml);
                        });
                    }
                },
            });
        }
    });

    $(".activeInactive").click(function () {
        var memberId = $(this).data("id");
        var urlpath = base_url + "/admin/close/accountclose";
        var type = "POST";

        $.ajax({
            url: urlpath,
            type: type,
            data: {
                memberId: memberId,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },

            success: function (response) {
                $("#activeinactiveview").html(response);
                var dueAmount = $("#totaldueamount").val();

                if (dueAmount != 0) {
                    $("#remarksDiv").css("display", "none");
                    $("#closesavebtn").prop("disabled", true);
                    $("#inactive_msg").text("Before close this account clear the members due amount");
                } else {
                    $("#inactive_msg").text("");

                    submitForCloseAccount(base_url);
                }

                $("#activeInactiveModal").modal("show");
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
});

function openUserloginLogoutDetailModal(userid) {
    $("#bodyContent").html("");

    var base_url = $("#base_url").val();
    $.ajax({
        type: "POST",
        url: base_url + "/admin/user/getloginLogoutDetailByUserId",
        datatype: "html",
        data: {
            userid: userid,
        },
        success: function (response) {
            $("#commonModal").modal("show");
            $("#bodyContent").html(response);
            $("#loginLogoutTable").DataTable({
                order: [[0, "desc"]],
            });

            $("#header_title").text("User Login Details");
        },
        error: function (xhr) {
            console.log(xhr.responseText);
            var errors = xhr.responseJSON.errors;
            if (errors) {
                $.each(errors, function (field, messages) {
                    var errorHtml = '<ul class="list-unstyled">';
                    $.each(messages, function (index, message) {
                        errorHtml += "<li>" + message + "</li>";
                    });
                    errorHtml += "</ul>";
                    $("#my-form")
                        .find('[name="' + field + '"]')
                        .after(errorHtml);
                });
            }
        },
    });
}
