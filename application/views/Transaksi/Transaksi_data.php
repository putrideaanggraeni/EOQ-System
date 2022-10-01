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
	<?php $this->view('message')?> 
	<div class="content">
	<div class="card card-default color-palette-box">
		<div class="card-header">
			<h5 class="card-title">
			<i class="fa fa-cart-plus"> </i>
			/ Transaksi Penjualan
			</h5>
		</div>
		<form action="<?=site_url('transaksi/proses')?>" method="post">
		<div class="row md-2">
			<div class="card-body">
				<div class="row pl-4 pt-4 pr-4">
					<div class="col-md-4">
						<div class="form-group">
							<label for="no_faktur">No. Faktur</label>
							<input type="text" class="form-control form-control-sm" style="color:blue;font-weight:bold;"
								 value="<?php echo $no_faktur;?>" name="no_faktur" id="no_faktur" readonly>
								
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="user_id">Kasir</label>
							<input type="hidden" class="form-control form-control-sm" style="font-weight:bold;"
								value="<?= $this->fungsi->user_login()->user_id?>" name="user_id" id="user_id" readonly>
							<input type="text" class="form-control form-control-sm" style="font-weight:bold;"
								value="<?= $this->fungsi->user_login()->nama?>" name="user_name" id="user_name" readonly>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="tanggal">Tanggal</label>
							<input type="date" style="font-weight:bold;" class="form-control form-control-sm" name="tanggal" id="tanggal" readonly
								value="<?= date('Y-m-d'); ?>">
						</div>
					</div>
				</div>
			</div>
		</div> <hr>
		
		<div class="row md-2 pl-4 pr-4">
			<div class="card-body">
				<div class="row">
					<div class="col-md-5">
						<div class="form-group">
							<label for="barcode">Pilih Barang</label>
								<div class="form-group input-group mb-4">
									<input type="hidden" class="form-control" name="item_id"  id="item_id">
									<input type="text" class="form-control form-control-sm" name="barcode" id="barcode" 
									readonly>
								<div class="input-group-append">
									<button class="btn btn-sm btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-item">
										<i class="fa fa-search"></i>
									</button>
								</div>
								</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="item_name">Nama Barang</label>
							<input type="text" class="form-control form-control-sm" name="item_name" id="item_name" 
								readonly>
						</div>
					</div>
				</div>
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label for="harga_penjualan">Harga</label>
						<input type="text" class="form-control form-control-sm" name="harga_penjualan" id="harga_penjualan" 
							readonly>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="qty">Qty</label>
						<input type="hidden" class="form-control form-control-sm" name="stock" id="stock" readonly>
						<input type="number" min="1" class="form-control form-control-sm" name="qty" id="qty">
						<input type="hidden"  class="form-control form-control-sm" name="diskon_id" id="diskon_id">
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-4 pt-4">
			<div class="form-group">
				<label for="total_harga">Total Bayar</label>
				<?php 
				$total_harga= 0;
				foreach($row->result() as $key => $data) { ?>
				<?php 
				$total_harga += $data->total-($data->total*$data->diskon/100) ;
				} 
				?>
				<input type="hidden" class="form-control form-control-sm" name="total_harga" id="total_harga" value="<?=$total_harga?>" readonly>
				<input type="number" step="any" min="0" class="form-control form-control-lg" name="total_bersih" id="total_bersih"
				style="text-align: right; color:blue; font-weight: bold;  font-size:20pt;" value="<?=$total_harga?>" readonly>
			</div>
			<div class="form-group">
				<button type="submit" name="add" class="btn btn-primary">
						<i class="fa fa-cart-plus"> </i>  Add to Cart
				</button>&nbsp;
			</div>
		
			
        </div>
		</div>

	<div class="card-body">
		<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-striped">
				<thead>
					<tr align="center">
						<th> No </th>
						<th> Barcode </th>
						<th> Nama Barang </th>
						<th> Harga </th>
						<th> Qty </th>
						<th> Total </th>
						<th> Action </th>
					</tr>
				</thead>
				<tbody>
				<?php $no = 1;
				$total_harga= 0;
				foreach($row->result() as $key => $data) { ?>
				<tr>
					<td><center><?=$no++?></center></td>
					<td><?=$data->barcode?></td>
					<td><?=$data->item_name?></td>
					<td><?=indo_currency($data->harga_penjualan)?></td>
					<td><?=$data->qty?></td>
					<td><?=indo_currency($data->total)?></td>
					<td align="center">
					<a href="<?=site_url('transaksi/del/'.$data->id.'/'.$data->item_id)?>" id="btn-hapus" class="btn btn-danger btn-xs">
					<i class="fa fa-trash-alt"></i>										
					</a>
					</td>
				</tr>
				<?php 
				$total_harga += $data->total-($data->total*$data->diskon/100) ;
				
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
	</div>
	
	<div class="card-body">
		<div class="col">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="metode_pembayaran">Metode Pembayaran</label>
						<select name="metode_pembayaran" class="form-control">
							<option value="">--</option>
							<option value="Tunai"> Tunai </option>
							<option value="Non Tunai">Non Tunai</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="nama">Pelanggan</label>
						<div class="form-group input-group mb-4">
							<input type="hidden" value="1" class="form-control" name="customer_id"  id="customer_id">
							<input type="text" value="Umum" class="form-control form-control-sm" name="nama"  id="nama"
							readonly>
							<div class="input-group-append">
							<button class="btn btn-sm btn-info btn-flat" type="button" data-toggle="modal" data-target="#modal-pelanggan">
								<i class="fa fa-search"></i>
							</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="discount">Disc %</label>
						<?php foreach($diskon->result()as $key => $data) { ?> 
						<input type="number" step="any" min="0" name="discount" id="discount" class="form-control" value="<?=$data->diskon?>" readonly>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
			<div class="col-md-8"> </div>	
				
				<div class="col-md-8"> </div>	
				<div class="col-md-4">
					<div class="form-group">
						<label for="bayar">Bayar</label>
						<input type="number" step="any" min="0" name="bayar" id="bayar" class="form-control" value="0" >
					</div>
				</div>	
				<div class="col-md-8"> </div>	
				<div class="col-md-4">
					<div class="form-group">
						<label for="sisa">Kembali</label>
						<input type="text" name="sisa" id="sisa" class="form-control" value="0" readonly >
					</div>
					
					<div class="form-group">
					<button type="submit" name="simpan" class="btn btn-primary">
						<i class="fa fa-save"> </i> Bayar
					</button>&nbsp;
					<button type="submit" name="print" class="btn btn-primary">
						<i class="fa fa-save"> </i> Bayar / Print
					</button>&nbsp;
					</div>
					
				</div>	
			</div>
		</div>
	</div>
	</div>
	</div>
	</form>
</div>


<div class="modal fade" id="modal-pelanggan">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"> Select Data Pelanggan </h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body table-responsive">
					<table class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th> customer ID</th>
								<th> Nama </th>
								<th> Alamat </th>
								<th> No. HP </th>
								<th> Action </th>
							</tr>
						</thead>
					<tbody>
						<?php foreach($customer as $i => $data) { ?>
							<tr>
								<td><?=$data->customer_id?></td>
								<td><?=$data->nama?></td>
								<td><?=$data->alamat?></td>
								<td class="text-center"><?=$data->nohp?></td>
								<td class="text-right">
									<button class="btn btn-xs btn-info" id="select_plg"
										data-id="<?=$data->customer_id?>"
										data-nama="<?=$data->nama?>"
										data-alamat="<?=$data->alamat?>"
										data-nohp="<?=$data->nohp?>">
										<i class="fa fa-check"></i> Select </button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-item">
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"> Select Product Item </h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body table-responsive">
					<table class="table table-striped table-bordered" id="example2">
						<thead>
							<tr>
								<th> Barcode </th>
								<th width="250px"> Nama </th>
								<th> Price </th>
								<th> Stock </th>
								<th> Action </th>
							</tr>
						</thead>
					<tbody>
						<?php foreach($item as $i => $data) { ?>
							<tr>
								<td><?=$data->barcode?></td>
								<td><?=$data->nama?></td>
								<td class="text-right"><?=$data->harga_penjualan?></td>
								<td class="text-right"><?=$data->stock?></td>
								<td class="text-right">
									<button class="btn btn-xs btn-info" id="select"
										data-id="<?=$data->item_id?>"
										data-barcode="<?=$data->barcode?>"
										data-nama="<?=$data->nama?>"
										data-diskonid="1"
										data-hargapenjualan="<?=$data->harga_penjualan?>"
										data-stock="<?=$data->stock?>">
										<i class="fa fa-check"></i> Select </button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="assets/js/jquery.js"></script>
<script>
$(document).ready(function() {
	$(document).on('click', '#select_plg', function(){
		var customer_id = $(this).data('id');
		var nama = $(this).data('nama');
		var alamat = $(this).data('alamat');
		var discount =$(this).data('discount');
		$('#customer_id').val(customer_id);
		$('#nama').val(nama);
		$('#alamat').val(alamat);
		$('#nohp').val(nohp);
		$('#modal-pelanggan').modal('hide');
	});
	
	$(document).on('click', '#select', function(){
		var item_id = $(this).data('id');
		var barcode = $(this).data('barcode');
		var nama = $(this).data('nama');
		var unit_name = $(this).data('unit');
		var diskon_id = $(this).data('diskonid');
		var harga_penjualan = $(this).data('hargapenjualan');
		var stock =$(this).data('stock');
		$('#item_id').val(item_id);
		$('#barcode').val(barcode);
		$('#item_name').val(nama);
		$('#diskon_id').val(diskon_id);
		$('#unit_name').val(unit_name);
		$('#harga_penjualan').val(harga_penjualan);
		$('#stock').val(stock);
		$('#modal-item').modal('hide');
	});
});
</script>		


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
 $("#total_bersih").keyup(function(){
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