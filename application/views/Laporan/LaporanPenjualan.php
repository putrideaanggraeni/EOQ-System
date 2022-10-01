<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">LAPORAN PENJUALAN</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
	
<div class="content">
	<div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h5 class ="box-title"> Laporan Penjualan </h5> <hr>
                </div>
					<div class="card-body">
						<form action="<?=site_url('laporan/cetaklaporanpenjualan')?>" method="post">
						<div class="row">
								<div class="col-md">
									<div class="row">
										<div class="col-md-6">
										<div class="form-group">
											<label for="dari">Mulai Tanggal</label>
											<input type="date" class="form-control" name="dari" id="dari" value="<?php echo $dari;?>">
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group">
											<label for="sampai">Sampai Tanggal</label>
											<input type="date" class="form-control" name="sampai" id="sampai" value="<?php echo $sampai;?>">
										</div>
										</div>
									</div>
								
							</div>	
						</div>
						<button type="submit" id="print" name="print" class="btn btn-primary"><i class=""></i> Print</button>
						<button type="submit" id="export" name="export"  class="btn btn-primary"><i class=""></i> Export as Excel</button>
						</form>	
						</div>
					</div>
				</div>
            </div>
        </div>
		<div class="row">
            <div class="col">
              <div class="card shadow mb-4">
					<div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover table-striped table-bordered" id="example">
						<thead>
							<tr align="center">	
								<th scope="col">No.</th>
								<th scope="col">No. Faktur</th>
								<th scope="col">Tanggal</th>
								<th scope="col">Customer</th>
								<th scope="col">Total</th>
								<th scope="col">Metode Transaksi</th>
								<th scope="col">Kasir</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1 ;
								foreach($row->result()  as $key => $data) { ?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><?=$data->no_faktur?></td>
									<td><?=indo_date($data->tanggal)?></td>
									<td><?=$data->customer_name?></td>
									<td><?=indo_currency($data->total_bersih)?></td>
									<td><?=$data->metode_pembayaran?></td>
									<td><?=$data->user_name?></td>
									<td class="text-center">
										<a href="<?=site_url('laporan/detail/'.$data->no_faktur)?>">
										<button type="submit" class="btn btn-primary btn-xs">
										<i class="fa fa-eye"> </i>										
										</button></a>
					
										<a href="<?=site_url('laporan/del/'.$data->no_faktur)?>" id="btn-hapus" class="btn text-white btn-xs" style="background:#87CEEB!important">
										<i class="fa fa-trash-alt"></i>										
										</button></a>
										
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


