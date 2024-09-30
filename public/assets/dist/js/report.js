$(document).ready(function () {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0");
    var yyyy = today.getFullYear();

    var formattedToday = yyyy + "-" + mm + "-" + dd;

    $("#tanggalAwal").datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
    });

    $("#tanggalAkhir")
        .datepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            todayHighlight: true,
        })
        .datepicker("setDate", today);
});
