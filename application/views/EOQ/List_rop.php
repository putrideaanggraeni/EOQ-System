<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">KELOLA EOQ - ROP </a>
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
                 	<h5 class ="box-title"> Data ROP </h5>
                </div>
					<div class="card-body">
						<a href="<?=site_url('eoq/index')?>">
						<button type="submit" class="btn btn-primary"><i class=""></i>Back</button>
						</a>
						<a href="<?=site_url('eoq/cetak')?>">
						<button type="submit" class="btn btn-primary"><i class=""></i> Print</button>
						</a>
						<a href="<?=site_url('eoq/export')?>">
						<button type="submit" class="btn btn-primary"><i class=""></i> Export as Excel</button>
						</a><br><br>
						<table class="table table-hover table-striped table-bordered" id="example">
						<form action="<?=site_url('eoq/pesan')?>" method="post">
							<thead>
								<tr align="center">	
									<th scope="col">No.</th>
									<th scope="col">Kode Barang</th>
									<th scope="col">Nama Barang</th>
									<th scope="col">Harga Beli</th>
									<th scope="col">Jumlah Pembelian Stock</th>
									<th scope="col">Action</th>
									<th scope="col">Status</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$no = 1;
							foreach ($row as $data) { 
							$id =$data->item_id;
							$status = $data-> status;
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
							
							?>
							
							<?php
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
								<td><?=$data->barcode?></td>
								<td><?=$data->nama?></td>
								<td><?=indo_currency($data->harga_pembelian)?></td>
								<td><?=number_format($a,'0','','.')?> Unit</td></td>
								<td>
								<center>
								<a href="<?=site_url('eoq/pesan/'.$data->item_id)?>" id="pesan" class="btn btn-primary"> Pesan</a>
								</center>
								<td align="center"> <b> <?=$status?> <b></td>
								
								</td>
							</tr>
							<?php } ?>
							<?php } ?>	
							</tbody>	
									
							</table>
						</div>
						</form>
					</div>
				</div>
            </div>
        </div>	
	</div>
</div>
	
			