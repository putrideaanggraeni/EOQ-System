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
                 <h5 class ="box-title"> Data EOQ dan ROP </h5>
                </div>
					<div class="card-body">
						<a href="<?=site_url('eoq/listrop')?>">
						<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> List ROP</button>
						</a><br><br>
						<div class="table-responsive">
						<table class="table table-hover table-striped table-bordered" id="example">
						<thead>
							<tr align="center">	
								<th scope="col">No.</th>
								<th scope="col">Kode Barang</th>
								<th scope="col">Nama Barang</th>
								<th scope="col">Stock Terjual</th>
								<th scope="col">Stock Saat Ini</th>
								<th scope="col">Periode</th>
								<th scope="col">Frekuensi</th>
								<th scope="col">Jarak</th>
								<th scope="col">Rata-Rata Kebutuhan Harian</th>
								<th scope="col">EOQ</th>
								<th scope="col">Safety Stock</th>
								<th scope="col">ROP</th>
								<th scope="col">Status</th>
								
							</tr>
							
						</thead>
						<tbody>
						<?php $no = 1;
							foreach ($jmlbrg as $data) {
							$stock = $data->stock;	
							$jml = $data->jml;	
							$eoq = $data->eoq;	
							$leadtime = $data->leadtime;
							$tgl1 = $data->dari;
							$tgl2 = $data->sampai;
							$pmax = $data->pmax;
							
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
							
							if ($stock <= number_format($rop,'0','','.')) {
							$ket = "WARNING";
							$font = "text-danger";
							} else {
								$ket = "SAFETY";
								$font = "text-success";
							}
							?>
							
								<tr>
									<td><center><?=$no++?></center></td>
									<td><?=$data->barcode?></td>
									<td><?=$data->nama?></td>
									<td><?=$jml?></td>
									<td><?=$stock?></td>
									<td><?=$difference->days?> hari</td>
									<td><?=number_format($f,'0','','.')?> x</td>
									<td><?=number_format($t,'0','','.')?> hari</td>
									<td><?=number_format($d,'2',',','.')?></td>
									<td><?=number_format($eoq,'0','','.')?> pcs</td>
									<td><?=number_format($ss,'0','','.')?> pcs</td>
									<td><?=number_format($rop,'0','','.')?> pcs</td>
									<td align="center"><span class="badge <?=$font;?>"> <?=$ket;?> </span></td>
									
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