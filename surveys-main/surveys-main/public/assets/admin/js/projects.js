$(function () {
    var base_url = $("#base_url").val();
    var mode = $("#mode").val();
    loadVendorList();

    $("#client_id").change(function () {
        if (mode == "Edit") {
            var selectedClientId = $("#client_id_temp").val();
            $("#client_id option").prop("disabled", false);
            $('#client_id option[value="' + selectedClientId + '"]')
                .siblings()
                .prop("disabled", true);
        }
    });
    if (mode == "Edit") {
        $("#client_id").change();
    }

    $("#project-status").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var icon = $(this).find("i");
        var urlpath = base_url + "/admin/project/status";
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            type: "POST",
            url: urlpath,
            data: { id: id },
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                if (response.status === "Live") {
                    icon.removeClass("fa-play").addClass("fa-pause");
                    $("#status")
                        .removeClass("Pause-status")
                        .addClass("Live-status")
                        .text("Live");
                } else {
                    icon.removeClass("fa-pause").addClass("fa-play");
                    $("#status")
                        .removeClass("Live-status")
                        .addClass("Pause-status")
                        .text("Pause");
                }
                showToast("success", response.message);
            },
            error: function (xhr, status, error) {
                console.error("Error updating question status:", error);
            },
        });
    });

    $("#duplicate").click(function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        var urlpath = base_url + "/admin/project/duplicate";
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        swal({
            title: "Are you sure?",
            text: "Do you really want to duplicate this project?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDuplicate) => {
            if (willDuplicate) {
                $("#duplicate").text("Processing...");
                $("#duplicate").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: urlpath,
                    data: { id: id },
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        if (response.status) {
                            window.location.href = `${base_url}/admin/project/addedit/${response.insertedid}`;
                        }
                        $("#duplicate").text("Duplicate");
                        $("#duplicate").prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        console.error("Error duplicating project:", error);
                        $("#duplicate").text("Duplicate");
                        $("#duplicate").prop("disabled", false);
                    },
                });
            }
        });
    });

    $(document).on("submit", "#projectForm", function (e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]);
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        var type = "POST";
        var urlpath = base_url + "/admin/projectaddeditajax";

        $("#successmsg").text("");
        $("#errormsg").text("");

        enableButton(true);
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

                if (response.msg_status == 1) {
                    if (mode == "Add") {
                        $("#projectForm")[0].reset();
                        showToast("success", "Data successfully inserted.");
                        enableButton(false, mode);
                        setTimeout(function () {
                            window.location.href = `${base_url}/admin/project/view/${response.data}`;
                        }, 1000);
                    } else {
                        showToast("success", "Data successfully updated.");
                    }
                }
                enableButton(false, mode);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });

    $("#assignVendorModel").on("hidden.bs.modal", function () {
        $("#assign_vendor_id").empty();
    });

    $("#assignbtn").click(function () {
        var urlpath = base_url + "/admin/vendordropdownajax";
        enableAssignButton("#assignbtn", true);
        $.ajax({
            url: urlpath,
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response && response.vendorList) {
                    $.each(response.vendorList, function (index, vendor) {
                        $("#assign_vendor_id").append(
                            '<option value="' +
                                vendor.id +
                                '">' +
                                vendor.name +
                                "</option>"
                        );
                    });

                    enableAssignButton("#assignbtn", false);

                    $("#assign_vendor_id").selectpicker("refresh");
                    $("#assignVendorModel").modal("show");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching vendor list:", error);
            },
        });
    });

    $(document).on("submit", "#vendorAssignForm", function (e) {
        e.preventDefault();

        var formData = new FormData($(this)[0]);
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        var type = "POST";
        var urlpath = base_url + "/admin/vendorassignajax";

        $("#successmsg").text("");
        $("#errormsg").text("");
        enableAssignButton("#assignVendorButton", true);

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

                if (response.status) {
                    loadVendorList();
                    showToast("success", "Vendors successfully assigned.");
                    $("#assignVendorModel").modal("hide");
                }

                enableAssignButton("#assignVendorButton", false);
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
});

function enableAssignButton(btn, status) {
    var text = status == true ? "Processing..." : "Assign Vendor";
    $(btn)
        .html(`${text} <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
    <path clip-rule="evenodd"
        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
        fill-rule="evenodd"></path>
    </svg>`);
    $(btn).prop("disabled", status);
}

function loadVendorList() {
    $("#vendor_list").html("");
    $("#loader").show();

    var base_url = $("#base_url").val();
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    var project_id = $("#project_id").val();

    $.ajax({
        type: "POST",
        data: { project_id: project_id },
        url: base_url + "/admin/loadvendorlistajax",
        datatype: "html",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        success: function (response) {
            $("#loader").hide();
            $("#vendor_list").html(response);
            $(".dataTable").DataTable({
                paging: false,
            });
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        },
    });
}
