import $ from "jquery";
import "bootstrap";
import * as bootstrap from "bootstrap";

function loadPasien() {
    $.get("/pasien", function (data) {
        $("#pasienTableBody").html(data);
    });
}

$("#createPasienForm").on("submit", function (e) {
    e.preventDefault();
    $.post("/pasien", $(this).serialize())
        .done(function () {
            alert("Pasien created!");
            const createModal = document.getElementById("createModal");
            const modalInstance =
                bootstrap.Modal.getInstance(createModal) ||
                new bootstrap.Modal(createModal);
            document.activeElement.blur();
            modalInstance.hide();
            $("#createPasienForm")[0].reset();
            loadPasien();
        })
        .fail(function (xhr) {
            alert(xhr.responseJSON?.message || "Error creating Pasien");
        });
});

$(document).on("click", ".btn-edit", function () {
    const id = $(this).data("id");
    $.get(`/pasien/${id}/edit`, function (data) {
        $("#editPasienId").val(data.id);
        $("#edit_nama_pasien").val(data.nama_pasien);
        $("#edit_alamat").val(data.alamat);
        $("#edit_no_telpon").val(data.no_telpon);
        $("#edit_rumah_sakit_id").val(data.rumah_sakit_id);
        const editModal = document.getElementById("editModal");
        const modalInstance =
            bootstrap.Modal.getInstance(editModal) ||
            new bootstrap.Modal(editModal);
        modalInstance.show();
    });
});

$(document).on("submit", "#editPasienForm", function (e) {
    e.preventDefault();
    const id = $("#editPasienId").val();
    $.ajax({
        url: `/pasien/${id}`,
        type: "POST",
        data: $(this).serialize(),
        success: function () {
            alert("Pasien updated!");
            const editModal = document.getElementById("editModal");
            const modalInstance =
                bootstrap.Modal.getInstance(editModal) ||
                new bootstrap.Modal(editModal);
            document.activeElement.blur();
            modalInstance.hide();
            loadPasien();
        },
        error: function (xhr) {
            alert(xhr.responseJSON?.message || "Update failed");
        },
    });
});

$(document).on("click", ".btn-delete", function () {
    const id = $(this).data("id");
    if (confirm("Are you sure? This will delete the Pasien.")) {
        $.ajax({
            url: `/pasien/${id}`,
            type: "POST",
            data: {
                _method: "DELETE",
                _token: $("meta[name='csrf-token']").attr("content"),
            },
            success: function () {
                alert("Pasien deleted.");
                loadPasien();
            },
            error: function (xhr) {
                alert(xhr.responseJSON?.message || "Delete failed");
            },
        });
    }
});

$(document).ready(function () {
    loadPasien();
});
