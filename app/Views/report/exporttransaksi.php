 <?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=List Transaksi.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reqapp - Export Transaksi</title>
</head>
<body>
	<table border="2" class="">
		<thead>
			<tr>
				<th>No</th>
				<th>Order ID</th>
				<th>Tanggal</th>
				<th>User</th>
				<th>Barang</th>
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
				<td><?php echo $data['order_id']; ?></td>
				<td><?php echo $data['created_at']; ?></td>
				<td><?php echo $data['nama_dinas']; ?></td>
				<td>
					<?php if (!empty($data['many'])) {
            foreach ($data['many'] as $manydata) {?>
					- <?php echo $manydata['nama_kebutuhan'] ?> (<?php echo $manydata['jumlah_transaksi']; ?> <?php echo $manydata['satuan']; ?>) <br>
					<?php }}?>
				</td>
				<td><?php echo $data['status']; ?></td>
			</tr>
			<?php }} else {
    echo "<td style='text-align:center;' colspan='8'>Data Kosong</td>";
}?>
		</tbody>
	</table>
</body>
</html>
