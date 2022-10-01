<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">Kelola Kriteria </a>
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
                  <h5 class ="box-title">  Kelola Kriteria </h5> 
                </div>
					<div class="card-body">
						<a href="<?=site_url('eoq/edit')?>"><button type="submit" class="btn btn-primary">
							<i class=""></i>Setting Kriteria</button> <br>
						</a>
						<div class="form">
							<?php foreach($row->result() as $key => $data) { ?>
							<label><b>Periode Penjualan</b></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>dari</label>
											<input type="hidden" name="kriteria_id" id="kriteria_id" value="<?=$data->kriteria_id?>">
											<input type="date" class="form-control" value="<?=$data->dari?>" name="dari" id="dari" readonly>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>sampai</label>
											<input type="hidden" name="kriteria_id" value="">
											<input type="date" class="form-control" value="<?=$data->sampai?>" name="sampai" id="sampai" readonly>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><b>Biaya Pemesanan </b></label>
									<input type="number" class="form-control" value="<?=$data->biayapemesanan?>" name="biayapemesanan" id="biayapemesanan" readonly>
							</div>
							<div class="form-group">
								<label><b>Biaya Penyimpanan %</b></label>
									<input type="number" class="form-control" value="<?=$data->biayapenyimpanan?>" name="biayapenyimpanan" id="biayapenyimpanan" readonly>
							</div>
							<div class="form-group">
								<label><b>Lead Time</b></label>
									<input type="number" class="form-control" value="<?=$data->leadtime?>" name="leadtime" id="leadtime" readonly>
							</div>
							<?php } ?>
						</form>	
						</div>
					</div>
				</div>
            </div>
        </div>	
	</div>
</div>	