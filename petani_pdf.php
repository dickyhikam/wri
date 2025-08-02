<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/phpqrcode/qrlib.php';

use Mpdf\Mpdf;

// Dummy data
$farmerId = 'KMJ.14.08.06.2006.0001';
$location = 'Desa ABC, Kab XYZ, Provinsi Jaya';
$kelompokTani = 'Kelompok Tani Makmur';
$ics = 'Siakad';
$kebun = [
    ['plot_id' => 'KMJ.0001.A.14.08.06.2006', 'luas' => '1.2', 'produksi' => '900'],
    ['plot_id' => 'KMJ.0001.B.14.08.06.2006', 'luas' => '0.8', 'produksi' => '640'],
];

// Generate QR code as base64 image (no temp file)
ob_start();
QRcode::png($farmerId, null, QR_ECLEVEL_L, 4);
$imageData = ob_get_clean();
$qrBase64 = 'data:image/png;base64,' . base64_encode($imageData);

// HTML template
$html = '
<style>
  body { font-family: sans-serif; font-size: 12pt; }
  table.layout { width: 100%; margin-bottom: 20px; }
  table.layout td { vertical-align: top; padding: 4px; }
  .qr { text-align: center; }
  table.kebun { width: 100%; border-collapse: collapse; margin-top: 10px; }
  table.kebun th, table.kebun td { border: 1px solid #000; padding: 6px; text-align: center; }
  table.kebun th { background: #f0f0f0; }
</style>

<table class="layout">
  <tr>
    <td width="130" class="qr">
      <img src="' . $qrBase64 . '" width="100"><br>
    </td>
    <td>
        <table class="layout">
            <tr>
                <td><strong>ID Petani</strong></td>
                <td>:</td>
                <td>' . $farmerId . '</td>
            </tr>
            <tr>
                <td><strong>Location</strong></td>
                <td>:</td>
                <td>' . $location . '</td>
            </tr>
            <tr>
                <td><strong>Kelompok Tani</strong></td>
                <td>:</td>
                <td>' . $kelompokTani . '</td>
            </tr>
            <tr>
                <td><strong>ICS</strong></td>
                <td>:</td>
                <td>' . $ics . '</td>
            </tr>
        </table>
    </td>
  </tr>
</table>

<h3>Kebun</h3>
<table class="kebun">
  <thead>
    <tr>
      <th>No</th>
      <th>Plot ID</th>
      <th>Luas (ha)</th>
      <th>Produksi (kg)</th>
    </tr>
  </thead>
  <tbody>';

foreach ($kebun as $i => $row) {
    $html .= '<tr>
      <td>' . ($i + 1) . '</td>
      <td>' . $row['plot_id'] . '</td>
      <td>' . $row['luas'] . '</td>
      <td>' . $row['produksi'] . '</td>
    </tr>';
}

$html .= '</tbody></table>';

// Output PDF
$mpdf = new Mpdf(['format' => 'A4']);
$mpdf->WriteHTML($html);
$mpdf->Output("kartu-petani-{$farmerId}.pdf", 'I');
