$(document).ready(function () {
    $('[data-bs-target="#edit"]').on("click", function () {
        var idRole = $(this).data("id");
        var namaRole = $(this).data("nama_role");
        var role = $(this).data("role");

        $("#id_role").val(idRole);
        $("#nama_role").val(namaRole);

        if (role == 1) {
            $("#radio_admin").prop("checked", true);
        } else if (role == 2) {
            $("#radio_manager").prop("checked", true);
        } else if (role == 3) {
            $("#radio_kasir").prop("checked", true);
        }
    });
});
