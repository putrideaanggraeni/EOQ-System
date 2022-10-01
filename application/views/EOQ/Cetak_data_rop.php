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
	DATA RE ORDER BARANG <br>
	TOKO KAWAN BAN <br>
	<?php
		foreach ($row as $data) { 
		$dari = $data->dari;
		$sampai = $data->sampai; 
	}?>
	PERIODE <?=$dari ?> s/d <?=$sampai?> <br>
	Jl. Raya Serang-Jakarta Kilometer (KM) 4 Pakupatan
	</h4>
	</center>
	<table border="1">
		<tr>
			<th>No.</th>
			<th width="550">Nama Barang</th>
			<th width="350">Harga Beli</th>
			<th width="350">Jumlah Pembelian Barang</th>
		</tr>
			<?php 
							$no = 1;
							$total_harga_beli= 0;
							$total_rop= 0;
							foreach ($row as $data) { 
							$stock = $data->stock;
							$jml = $data->jml;	
							$eoq = $data->eoq;	
							$leadtime = $data->leadtime;
							$pmax = $data->pmax;
							$tgl1 = $data->dari;
							$tgl2 = $data->sampai;
															
							$tanggal1 = new DateTime($tgl1);
							$tanggal2 = new DateTime($tgl2);
															
							$difference = $tanggal1->diff($tanggal2);
							$f = $jml/number_format($eoq,'0','','.');
							$t = ($difference->days+1)/$f;
							$d = number_format($eoq,'0','','.')/number_format($t,'0','','.');
							//$ss = (number_format($eoq,'0','','.')-$d)*$leadtime;
							$total= 0;
							$y = $data->y;
							$yy = $data-> yy;
							$std = SQRT((($yy)-($y)/($difference->days+1))/($difference->days+1));

							$ss = $std*2.33*(SQRT($leadtime));
							//$ss= ($pmax-$d)*$leadtime;
							$rop = ($d*$leadtime)+$ss;
							
							$jml_rop = (number_format($ss,'0','','.')-$stock)+number_format($eoq,'0','','.');
							
							if ($stock <= number_format($rop,'0','','.')) { ?>
							
							<?php
							if ($jml_rop > 0) { 
							$a = $jml_rop + 0;
							} else if ($jml_rop <= 0) {
							$a = $jml_rop + number_format($eoq,'0','','.');	
							}
							?>							
							<tr>
								<td><center><?=$no++?></center></td>
								<td><?=$data->nama?></td>
								<td><?=indo_currency($data->harga_pembelian)?></td>
								<td><?=number_format($a,'0','','.')?> Unit</td>
							</tr>
							
							<?php 
							$total_rop += $a; 	
							$total_harga_beli += $data->harga_pembelian*$a;
							} 
							}?>	
							
							<tr>
								<td colspan="2"><b>Total</b></td>
								<td colspan="1"><b><?=indo_currency($total_harga_beli)?></b></td>
								<td colspan="1"><b><?=number_format($total_rop,'0','','.')?> Unit</b></td>
							</tr>
	</table>
	<script>
	window.print();
	</script>
</body>
</html>