@php
function formatRupiah($angka)
{
return 'Rp ' . number_format($angka, 2, ',', '.');
}
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan PDF</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

  </style>
</head>
<body>
  @if ($tanggal_awal && $tanggal_akhir)
  <h1>Laporan dari {{ $tanggal_awal }} sampai {{ $tanggal_akhir }}</h1>
  @else
  <h1>Laporan {{ $tanggal_akhir }}</h1>
  @endif

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Total Penjualan</th>
        <th>Total Pengeluaran</th>
        <th>Total Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $row)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::parse($row['tanggal'])->format('d-m-Y') }}</td>
        <td>{{ formatRupiah($row['total_penjualan']) }}</td>
        <td>{{ formatRupiah($row['total_pengeluaran']) }}</td>
        <td>{{ formatRupiah($row['total_penjualan'] - $row['total_pengeluaran']) }}</td> <!-- Menghitung total pendapatan -->
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
