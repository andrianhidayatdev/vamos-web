$(document).ready(function () {
    $('[data-bs-target="#edit"]').on("click", function () {
        var idKategori = $(this).data("id");
        var namaKategori = $(this).data("nama_kategori");

        $("#id_kategori").val(idKategori);
        $("#nama_kategori").val(namaKategori);
    });
});
