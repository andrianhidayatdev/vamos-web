$(document).ready(function () {
    $('[data-bs-target="#edit"]').on("click", function () {
        var id_member = $(this).data("id_member");
        var nama = $(this).data("nama");
        var alamat = $(this).data("alamat");
        var telepon = $(this).data("telepon");

        $("#id_member").val(id_member);
        $("#nama").val(nama);
        $("#alamat").val(alamat);
        $("#telepon").val(telepon);
    });
});
