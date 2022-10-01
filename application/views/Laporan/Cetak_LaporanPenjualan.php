<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width-device-width, initial-scale-1.0">
	<title> Laporan Penjualan </title>
	<style>
		body {
			font-family: Tahoma;
			padding: 10px;
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
	LAPORAN PENJUALAN <br>
	TOKO KAWAN BAN <br>
	PERIODE <?php echo $dari; ?> s/d <?php echo $sampai;?> <br>
	Jl. Raya Serang-Jakarta Kilometer (KM) 4 Pakupatan
	</h4>
	</center>
	<table border="1">
		<tr>
			<th>No.</th>
			<th width="200px">No. Faktur</th>
			<th width="200px">Tanggal</th>
			<th width="200px">Customer</th>
			<th width="200px">Kasir</th>
			<th width="200px">Total</th>
			<th width="250px">Metode Transaksi</th>
			
		</tr>
		<?php $no = 1;
		$total_penjualan= 0;
		foreach($row as $key => $data)
		{
		?>
		
		<tr>
			<td> <?php echo $no; ?> </td>
			<td> <?php echo $data->no_faktur; ?> </td>
			<td> <?php echo $data->tanggal; ?> </td>
			<td> <?php echo $data->customer_name; ?> </td>
			<td> <?php echo $data->user_name; ?> </td>
			<td> <?php echo $data->total_bersih; ?> </td>
			<td> <?php echo $data->metode_pembayaran; ?> </td>
			
		</tr>
		
		<?php 
		$total_penjualan += $data->total_bersih; 
		$no++;
		} ?>
		
		<tr>
			<td colspan="5"><b>Total</b></td>
			<td colspan="2"><b><?=indo_currency($total_penjualan)?></b></td>
		</tr>
	</table>
	<script>
	window.print();
	</script>
</body>
</html>