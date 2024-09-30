$(document).ready(function () {
    $('[data-bs-target="#edit"]').on("click", function () {
        var id_supplier = $(this).data("id_supplier");
        var nama = $(this).data("nama");
        var alamat = $(this).data("alamat");
        var telepon = $(this).data("telepon");

        $("#id_supplier").val(id_supplier);
        $("#nama").val(nama);
        $("#alamat").val(alamat);
        $("#telepon").val(telepon);
    });
});
