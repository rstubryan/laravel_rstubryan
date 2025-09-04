import $ from "jquery";
import "bootstrap";
import * as bootstrap from "bootstrap";

function loadRumahSakit() {
    $.get("/rumah-sakit", function (data) {
        $("#rumahSakitTableBody").html(data);
    });
}

$("#createRumahSakitForm").on("submit", function (e) {
    e.preventDefault();
    $.post("/rumah-sakit", $(this).serialize())
        .done(function () {
            alert("Rumah Sakit created!");
            const createModal = document.getElementById("createModal");
            const modalInstance =
                bootstrap.Modal.getInstance(createModal) ||
                new bootstrap.Modal(createModal);
            document.activeElement.blur();
            modalInstance.hide();
            $("#createRumahSakitForm")[0].reset();
            loadRumahSakit();
        })
        .fail(function (xhr) {
            alert(xhr.responseJSON?.message || "Error creating Rumah Sakit");
        });
});

$(document).on("click", ".btn-edit", function () {
    const id = $(this).data("id");
    $.get(`/rumah-sakit/${id}/edit`, function (data) {
        $("#editRumahSakitId").val(data.id);
        $("#edit_nama_rumah_sakit").val(data.nama_rumah_sakit);
        $("#edit_alamat").val(data.alamat);
        $("#edit_email").val(data.email);
        $("#edit_telepon").val(data.telepon);
        const editModal = document.getElementById("editModal");
        const modalInstance =
            bootstrap.Modal.getInstance(editModal) ||
            new bootstrap.Modal(editModal);
        modalInstance.show();
    });
});

$(document).on("submit", "#editRumahSakitForm", function (e) {
    e.preventDefault();
    const id = $("#editRumahSakitId").val();
    $.ajax({
        url: `/rumah-sakit/${id}`,
        type: "POST",
        data: $(this).serialize(),
        success: function () {
            alert("Rumah Sakit updated!");
            const editModal = document.getElementById("editModal");
            const modalInstance =
                bootstrap.Modal.getInstance(editModal) ||
                new bootstrap.Modal(editModal);
            document.activeElement.blur();
            modalInstance.hide();
            loadRumahSakit();
        },
        error: function (xhr) {
            alert(xhr.responseJSON?.message || "Update failed");
        },
    });
});

$(document).on("click", ".btn-delete", function () {
    const id = $(this).data("id");
    if (confirm("Are you sure? This will delete the Rumah Sakit.")) {
        $.ajax({
            url: `/rumah-sakit/${id}`,
            type: "POST",
            data: {
                _method: "DELETE",
                _token: $("meta[name='csrf-token']").attr("content"),
            },
            success: function () {
                alert("Rumah Sakit deleted.");
                loadRumahSakit();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || "Delete failed");
            },
        });
    }
});

$(document).ready(function () {
    loadRumahSakit();
});
