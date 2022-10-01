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
<div class="content">
<div id="flash" data-flash="<?=$this->session->flashdata('success');?>"> 
</div>
	<div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class ="box-title"> Data Stock-In </h5> <hr>
                </div>
					<div class="card-body">
						<a href="<?=site_url('stock/in/add')?>">
						<button type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add</button>
						</a><br><br>
						<div class="table-responsive">
						<table class="table table-hover table-striped table-bordered" id="example">
						<thead>
							<tr align="center">	
								<th scope="col">No.</th>
								<th scope="col">Kode Barang</th>
								<th scope="col">Barang</th>
								<th scope="col">Qty</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
								foreach($row as $key => $data) { ?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><?=$data->barcode?></td>
									<td><?=$data->item_name?></td>
									<td class="text-right"><?=$data->qty?></td>
									<td class="text-center">
										<button class="btn btn-xs btn-primary" id="set_dtl"
											data-toggle="modal" data-target="#modal-detail"
											data-barcode="<?=$data->barcode?>"
											data-itemname="<?=$data->item_name?>"
											data-qty="<?=$data->qty?>"
											data-detail="<?=$data->detail?>"
											data-username="<?=$data->user_name?>"
											data-date="<?=indo_date($data->date)?>">
											<i class="fa fa-eye"> </i>
										</button>
										<a href="<?=site_url('stock/in/del/'.$data->stock_id.'/'.$data->item_id)?>" id="btn-hapus" class="btn text-white btn-xs" style="background:#87CEEB!important">
										<i class="fa fa-trash-alt"></i>
										</a>
										
									</td>
								</tr>
							<?php } ?>
						</tbody>	
						</table>
						</div>
						</div>
					</div>
				</div>
            </div>
        </div>	
	</div>
</div>	

<div class="modal fade" id="modal-detail">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"> Detail Stock-In </h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body table-responsive">
					<table class="table table-striped table-bordered no-margin">
						<tbody>
							<tr>
								<th style="width:35%"> Barcode </th>
								<td><span id="barcode"></span></td>
							</tr>
							<tr>
								<th> Nama Barang</th>
								<td><span id="item_name"></span></td>
							</tr>
							<tr>
								<th> Qty </th>
								<td><span id="qty"></span></td>
							</tr>
							<tr>
								<th> Detail </th>
								<td><span id="detail"></span></td>
							</tr>
							<tr>
								<th> User </th>
								<td><span id="user_name"></span></td>
							</tr>
							<tr>
								<th> Tanggal </th>
								<td><span id="date"></span></td>
							</tr>
						<tbody>
					</table>	
				</div>
			</div>
		</div>	
	</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
<script>
$(document).ready(function() {
	$(document).on('click', '#set_dtl', function() {
		var barcode = $(this).data('barcode');
		var itemname = $(this).data('itemname');
		var qty = $(this).data('qty');
		var detail = $(this).data('detail');
		var username = $(this).data('username');
		var date = $(this).data('date');
		$('#barcode').text(barcode);
		$('#item_name').text(itemname);
		$('#qty').text(qty);
		$('#detail').text(detail);
		$('#user_name').text(username);
		$('#date').text(date);
	})
})
</script>
