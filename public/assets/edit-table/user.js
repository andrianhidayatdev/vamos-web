$(document).ready(function () {
    $('[data-bs-target="#edit"]').on("click", function () {
        var id = $(this).data("id");
        var nama = $(this).data("nama");
        var email = $(this).data("email");
        var id_cabang = $(this).data("id_cabang");
        var idRole = $(this).data("id_role");

        $("#id").val(id);
        $("#name").val(nama);
        $("#email").val(email);
        $("#id_role").val(idRole);
        $("#id_cabang").val(id_cabang);
    });
});
