<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">STOCK-IN</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
<?php $this->view('message')?>
<div class="content">
	<div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h5 class ="box-title"> Add Stock In </h5> 
                </div>
					<div class="card-body">
						<a href="<?=site_url('stock/in')?>"><button type="submit" class="btn btn-primary">
							<i class=""></i> Back</button> <br>
						</a>
						<div class="form">
						<form action="<?=site_url('stock/proses')?>" method="post">
							<div class="form-group">
								<label>Tanggal </label>
									<input type="date" class="form-control" value="<?=date('Y-m-d')?>" name="date" required>
							</div>
							<div>
								<label for="barcode">Kode Barang</label>
							</div>
							<div class="form-group input-group">
									<input type="hidden" class="form-control" name="item_id"  id="item_id">
									<input type="text" class="form-control" name="barcode"  id="barcode" required autofocus>
									<span class="input-group-btn">
										<button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
											<i class="fa fa-search"></i>
										</button>
									</span>
							</div>
							<div class="form-group">
								<label>Nama Barang</label>
									<input type="text" class="form-control" name="item_name" id="item_name" readonly>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-8">
										<label for="unit_name"> Item Unit </label>
										<input type="text" name="unit_name" id="unit_name" value="" class="form-control" readonly>
									</div>
									<div class="col-md-4">
										<label for="stock"> Stock </label>
										<input type="text" name="stock" id="stock" value="" class="form-control" readonly>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Qty</label>
									<input type="number" class="form-control" name="qty" required>
							</div>
							<div class="form-group">
								<label>Detail</label>
									<input type="text" class="form-control" name="detail" placeholder="baru/tambahan/etc">
							</div>
							
							
							<div class="form-group">
								<button type="submit" name="in_add" class="btn btn-primary"><i class="fa fa-save"></i> Simpan </button> 
								<button type="Reset" class="btn text-white" style="background:#6495ED!important"><i class="fa fa-eraser"></i> Batal </button>
							</div>
						</form>	
						</div>
					</div>
				</div>
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
					<table class="table table-striped table-bordered" id="example">
						<thead>
							<tr>
								<th> Kode Barang </th>
								<th> Nama </th>
								<th> Price </th>
								<th> Unit </th>
								<th> Stock </th>
								<th> Action </th>
							</tr>
						</thead>
					<tbody>
						<?php foreach($item as $i => $data) { ?>
							<tr>
								<td><?=$data->barcode?></td>
								<td><?=$data->nama?></td>
								<td><?=$data->unit_name?></td>
								<td class="text-right"><?=$data->harga_penjualan?></td>
								<td class="text-right"><?=$data->stock?></td>
								<td class="text-right">
									<button class="btn btn-xs btn-info" id="select"
										data-id="<?=$data->item_id?>"
										data-barcode="<?=$data->barcode?>"
										data-nama="<?=$data->nama?>"
										data-unit="<?=$data->unit_name?>"
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
<script>
$(document).ready(function() {
	$(document).on('click', '#select', function(){
		var item_id = $(this).data('id');
		var barcode = $(this).data('barcode');
		var nama = $(this).data('nama');
		var unit_name = $(this).data('unit');
		var stock =$(this).data('stock');
		$('#item_id').val(item_id);
		$('#barcode').val(barcode);
		$('#item_name').val(nama);
		$('#unit_name').val(unit_name);
		$('#stock').val(stock);
		$('#modal-item').modal('hide');
	})
})
</script>					
</div>
								
				