<html>
<head>
<title>Faktur Pembayaran</title>
<style>
 
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
<center><table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
<b>KAWAN BAN</b></br>Jl. Raya Serang-Jakarta Kilometer (KM) 4 Pakupatan</span></br>
 
 
<span style='font-size:12pt'><?php echo $tanggal?></span></br>
</td>
</table>
<style>
hr { 
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
} 
</style>
<table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
 
<tr align='center'>
<td width='45%'>Item</td>
<td width='13%'>Price</td>
<td width='8%'>Qty</td>
<td width='13%'>Total</td><tr>
<td colspan='5'><hr></td></tr>
</tr>
<?php $no = 1;
	$total_harga= 0;
	foreach ($row as $i) {
?>
<tr><td style='vertical-align:top'><?php echo $i->item_name; ?></td>
<td style='vertical-align:top; text-align:right; padding-right:10px'><?php echo $i->harga_penjualan; ?></td>
<td style='vertical-align:top; text-align:right; padding-right:10px'><?php echo $i->qty; ?></td>
<td style='text-align:right; vertical-align:top'><?php echo $i->total; ?></tr>
<tr>
<?php	
	$total_harga += $i->total;
	}
?>
<td colspan='5'><hr></td>
</tr>
<tr>
<td colspan = '4'><div style='text-align:right'>Discount :</div></td>
<td style='text-align:right; font-size:16pt;'><?php echo $discount?></td>
</tr>
<tr>
<td colspan = '4'><div style='text-align:right; color:black'>Total : </div></td>
<td style='text-align:right; font-size:16pt; color:black'><?php echo $total_bersih?></td>
</tr>
<tr>
<td colspan = '4'><div style='text-align:right; color:black'>Bayar : </div></td>
<td style='text-align:right; font-size:16pt; color:black'><?php echo $bayar?></td>
</tr>
<tr>
<td colspan = '4'><div style='text-align:right; color:black'>Sisa : </div></td>
<td style='text-align:right; font-size:16pt; color:black'><?php echo $sisa?></td>
</tr>
</table>
<table style='width:350; font-size:12pt;' cellspacing='2'><tr></br>
<td align='center'>****** TERIMAKASIH ******</br></td></tr></table></center></body>
</html>

<script>
	window.print();
</script>