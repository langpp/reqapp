 <?php
 header("Content-type: application/vnd-ms-excel");
 header("Content-Disposition: attachment; filename=Main Template.xlsx");
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
 				<th>Nama Kebutuhan</th>
 				<th>Kategori</th>
 				<th>Deskripsi</th>
 				<th>Stok</th>
 				<th>Satuan</th>
 				<th>Harga</th>
 				<th>Tanggal</th>
 			</tr>
 		</thead>
 		<tbody>
 			<?php
 			if (!empty($kebutuhan)) {
 				$no = 1;
 				foreach ($kebutuhan as $data) {
 					$arraySplit = explode('-', $data['kode_kebutuhan']);
 					?>
 					<tr>
 						<td style="background: #ff5b57; color: #fff;"><?php echo $data['kebutuhan_id']; ?></td>
 						<td style="background: #ff5b57; color: #fff;"><?php echo $data['nama_kebutuhan']; ?></td>
 						<td style="background: #ff5b57; color: #fff;"><?php echo $arraySplit[0]; ?></td>
 						<td></td>
 						<td></td>
 						<td></td>
 						<td></td>
 						<td><?php echo date('Y-m-d H:i:s') ?></td>
 					</tr>
 				<?php }} else {?>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td></td>
 					<td><?php echo date('Y-m-d H:i:s') ?></td>
 				<?php }?>
 			</tbody>
 		</table>
 	</body>
 	</html>
