<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=List Kebutuhan.xls");
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
				<th>No</th>
				<th>Kode Kebutuhan</th>
				<th>Nama Kebutuhan</th>
				<th>Deskripsi</th>
				<th>Kategori</th>
				<th>Stok</th>
				<th>Satuan</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
if (!empty($kebutuhan)) {
    $no = 1;
    foreach ($kebutuhan as $data) {
        ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $data['kode_kebutuhan']; ?></td>
				<td><?php echo $data['nama_kebutuhan']; ?></td>
				<td><?php echo $data['deskripsi']; ?></td>
				<td><?php echo $data['nama_kategori']; ?></td>
				<td><?php echo $data['stok']; ?></td>
				<td><?php echo $data['satuan']; ?></td>
				<td><?php echo $data['status']; ?></td>
			</tr>
			<?php }} else {
    echo "<td style='text-align:center;' colspan='8'>Data Kosong</td>";
}?>
		</tbody>
	</table>
</body>
</html>