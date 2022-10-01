<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale-1.0">
	<title> Laporan Penjualan </title>
	<style>
		body {
			font-family: Tahoma;
			padding: 30px;
		}
		table {
			border-collapse: collapse;
		}
		table,
		th,
		td {
			padding: 10px;
		}
		
		th {
			background-color: #2973ba ;
			color : white;
		}
	
		
	</style>
</head>

<body>
	<center>
	<h4> 
	DATA BARANG <br>
	TOKO KAWAN BAN <br>
	Jl. Raya Serang-Jakarta Kilometer (KM) 4 Pakupatan
	</h4>
	</center>
	<table border="1">
		<tr>
			<th>No.</th>
			<th width="150">Kode Barang</th>
			<th width="450">Nama</th>
			<th width="100">Kategori</th>
			<th width="100">Brand</th>
			<th width="100">Unit</th>
			<th width="150">Harga</th>
			<th scope="col">Stock</th>
		</tr>
		
		<?php $no = 1;
		foreach($row->result() as $key => $data) { ?>
		
		<tr>
			<td><center><?=$no++?></center></td>
			<td><?=$data->barcode?></td>
			<td><?=$data->nama?></td>
			<td><?=$data->kategori_name?></td>
			<td><?=$data->brand_name?></td>
			<td><?=$data->unit_name?></td>
			<td><?=$data->harga_penjualan?></td>
			<td><?=$data->stock?></td>
		</tr>
		<?php } ?>
	</table>
	<script>
	window.print();
	</script>
</body>
</html>