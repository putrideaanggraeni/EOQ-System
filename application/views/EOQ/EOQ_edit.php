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
<div id="flash" data-flash="<?=$this->session->flashdata('success');?>"> 
</div>
	<div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h5 class ="box-title">  Setting Kriteria </h5> 
                </div>
					<div class="card-body">
						<div class="form">
						<form action="<?=site_url('EOQ/proses')?>" method="post">
							<label><b>Periode Penjualan</b></label>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>dari</label>
											<input type="hidden" name="kriteria_id" value="<?=$row->kriteria_id?>">
											<input type="date" class="form-control" value="<?=$row->dari?>" name="dari" id="dari">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>sampai</label>
											<input type="date" class="form-control" value="<?=$row->sampai?>" name="sampai" id="sampai">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label><b>Biaya Pemesanan</b></label>
									<input type="number" class="form-control" value="<?=$row->biayapemesanan?>" name="biayapemesanan" id="biayapemesanan">
							</div>
							<div class="form-group">
								<label><b>Biaya Penyimpanan %</b></label>
									<input type="number" class="form-control" value="<?=$row->biayapenyimpanan?>" name="biayapenyimpanan" id="biayapenyimpanan">
							</div>
							<div class="form-group">
								<label><b>Lead Time</b></label>
									<input type="number" class="form-control" value="<?=$row->leadtime?>" name="leadtime" id="leadtime">
							</div>
							
							
							<div class="form-group">
								<button type="submit" name="<?=$page?>" class="btn btn-primary"><i class="fa fa-save"></i> Simpan </button> 
								<button type="Reset" class="btn btn-dark"><i class="fa fa-eraser"></i> Batal </button>
							</div>
						</form>	
						</div>
					</div>
				</div>
            </div>
        </div>	
	</div>
</div>	