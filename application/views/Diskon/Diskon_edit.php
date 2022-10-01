<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">Kelola Diskon </a>
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
					<h5 class ="box-title">  Setting Diskon </h5> 
                </div>
					<div class="card-body">
						<div class="form">
						<form action="<?=site_url('diskon/proses')?>" method="post">
							<div class="form-group">
								<label><b>Diskon %</b></label>
									<input type="hidden" class="form-control" value="<?=$row->diskon_id?>" name="diskon_id" id="diskon_id" readonly>
									<input type="number" class="form-control" value="<?=$row->diskon?>" name="diskon" id="diskon">
							</div>
							<div class="form-group">
								<label><b>Keterangan</b></label>
									<input type="text" class="form-control" value="<?=$row->ket_diskon?>" name="ket_diskon" id="ket_diskon">
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