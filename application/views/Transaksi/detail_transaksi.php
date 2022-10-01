<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">TRANSKASI PENJUALAN </a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
	
	<div class="content">

	<div class="card card-default color-palette-box">
		<div class="card-header">
			<h5 class="card-title">
			Detail Transaksi Penjualan
			</h5>
		</div>
	
		<div class="row md-2">
			<div class="card-body">
				<div class="row pl-4 pt-4 pr-4">
				<div class="col-md-4">
				<a href="<?=site_url('laporan')?>"><button type="submit" class="btn btn-primary">Back</button></a> 
				</div>
				</div>
				<div class="row pl-4 pt-4 pr-4">
					<div class="col-md-4">
						<div class="form-group">
							<label for="no_faktur">No. Faktur</label>
							<input type="text" class="form-control form-control-sm" style="font-weight:bold;" value="<?php echo $row['no_faktur']?>"
							 name="no_faktur" id="no_faktur" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="user_id">Kasir</label>
							<input type="hidden" class="form-control form-control-sm" style="font-weight:bold;"
								name="user_id" id="user_id" value="<?php echo $row['user_id']?>"readonly>
							<input type="text" class="form-control form-control-sm" style="font-weight:bold;"
								name="user_name" id="user_name" value="<?php echo $row['user_name']?>"readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="tanggal">Tanggal</label>
							<input type="date" style="font-weight:bold;" value="<?php echo $row['tanggal']?>" class="form-control form-control-sm" name="tanggal" id="tanggal" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="customer_id">Nama Pelanggan</label>
							<input type="hidden" class="form-control form-control-sm" style="font-weight:bold;" 
								name="customer_id" id="customer_id" value="<?php echo $row['customer_id']?>" readonly>
							<input type="text" class="form-control form-control-sm" style="font-weight:bold;"
								name="customer_name" id="customer_name" value="<?php echo $row['customer_name']?>" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="metode_pembayaran">Metode Pembayaran</label>
							<input type="text" class="form-control form-control-sm" style="font-weight:bold;"
							 name="metode_pembayaran" id="metode_pembayaran" value="<?php echo $row['metode_pembayaran']?>" readonly>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="total_bersih">Total</label>
							<input type="text" class="form-control form-control-sm" style="font-weight:bold;" name="total_bersih" id="total_bersih" value="<?php echo indo_currency($row['total_bersih'])?>" readonly>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="discount">Disc%</label>
							<input type="text" class="form-control form-control-sm" style="font-weight:bold;" name="discount" id="discount" value="<?php echo $row['discount']?>" readonly>
						</div>
					</div>
				</div>
			</div>
		</div> <hr>
	<div class="card-body">
		<div class="col-md-12">
			<table class="table table-bordered table-striped">
				<thead>
					<tr align="center">
						<th> No </th>
						<th> Kode Barang </th>
						<th> Nama Barang </th>
						<th> Harga </th>
						<th> Qty </th>
						<th> Total </th>
					</tr>
				</thead>
				
				<tbody>
					<?php $no = 1;
					$total_harga= 0;
					foreach ($detail as $i) {
					?>
					<tr>
						<td> <?php echo $no; ?></td>
						<td> <?php echo $i->barcode; ?></td>
						<td> <?php echo $i->nama; ?></td>
						<td> <?php echo $i->harga_penjualan; ?></td>
						<td> <?php echo $i->qty; ?></td>
						<td> <?php echo $i->total; ?></td>
					</tr>
					<?php	
					$total_harga += $i->total;
					}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="5">Grand Total</th>
						<td align="center" colspan="2"><b><?=indo_currency($total_harga)?></b></td>
					</tr>
				</tfoot>
				
			</table>
		</div>
	</div>
	

<script type="text/javascript">
 $("#total_harga").keyup(function(){   
   var a = parseFloat($("#total_harga").val());
   var b = parseFloat($("#discount").val());
   var c = a-(a*b/100);
   $("#total_bersih").val(c);
 });
 $("#discount").keyup(function(){
   var a = parseFloat($("#total_harga").val());
   var b = parseFloat($("#discount").val());
   var c = a-(a*b/100);
   $("#total_bersih").val(c);
 });
 $("#bayar").keyup(function(){
   var a = parseFloat($("#total_bersih").val());
   var b = parseFloat($("#bayar").val());
   var c = b-a;
   $("#sisa").val(c); 
 });
 </script>