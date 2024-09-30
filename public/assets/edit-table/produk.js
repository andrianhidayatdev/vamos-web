$(document).ready(function () {
    $('[data-bs-target="#edit"]').on("click", function () {
        var id_produk = $(this).data("id_produk");
        var nama_produk = $(this).data("nama_produk");
        var merk = $(this).data("merk");
        var harga_beli = $(this).data("harga_beli");
        var harga_jual = $(this).data("harga_jual");
        var diskon = $(this).data("diskon");
        var stok = $(this).data("stok");
        var id_kategori = $(this).data("id_kategori");

        $("#id_produk").val(id_produk);
        $("#nama_produk").val(nama_produk);
        $("#merk").val(merk);
        $("#harga_beli").val(harga_beli);
        $("#harga_jual").val(harga_jual);
        $("#diskon").val(diskon);
        $("#stok").val(stok);
        $("#id_kategori").val(id_kategori);
    });
});
