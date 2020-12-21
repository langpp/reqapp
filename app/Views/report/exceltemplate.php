 <?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Main Template.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reqapp - Export Kebutuhan</title>
</head>
<body>
	<table border="2" class="">
		<thead>
			<tr>
				<th>ID Kebutuhan</th>
				<th>Kode Kebutuhan</th>
				<th>Nama Kebutuhan</th>
				<th>Kategori</th>
				<th>Deskripsi</th>
				<th>Stok</th>
				<th>Satuan</th>
				<th>Status</th>
				<th>Harga</th>
			</tr>
		</thead>
		<tbody>
			<?php
if (!empty($kebutuhan)) {
    $no = 1;
    foreach ($kebutuhan as $data) {
        ?>
			<tr>
				<td style="background: #ddd"><?php echo $data['kebutuhan_id']; ?></td>
				<td style="background: #ddd"><?php echo $data['kode_kebutuhan']; ?></td>
				<td style="background: #ddd"><?php echo $data['nama_kebutuhan']; ?></td>
				<td style="background: #ddd"><?php echo $data['kategori_kebutuhan_id']; ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php }} else {
    echo "<td style='text-align:center;' colspan='8'>Data Kosong</td>";
}?>
		</tbody>
	</table>
</body>
</html>
