$(document).ready(function () {
    $('[data-bs-target="#edit"]').on("click", function () {
        var idPerusahaan = $(this).data("id");
        var namaPerusahaan = $(this).data("nama_cabang");

        $("#id_cabang").val(idPerusahaan);
        $("#nama_cabang").val(namaPerusahaan);
    });
});
