<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link"> UNIT BARANG </a>
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
                  <h5 class ="box-title"> <?=ucfirst($page)?> Unit Barang </h5> 
                </div>
					<div class="card-body">
						<a href="<?=site_url('unit/index')?>"><button type="submit" class="btn btn-primary">
							<i class=""></i> Back</button> <br>
						</a>
						<div class="form">
							<form action="<?=site_url('unit/proses')?>" method="post">
								<div class="form-group">
									<label>Unit</label>
										<input type="hidden" name="unit_id" value="<?=$row->unit_id?>">
										<input type="text" class="form-control" value="<?=$row->unit?>" name="unit" >
								</div>
								
								<div class="form-group">
									<button type="submit" name="<?=$page?>" class="btn btn-primary"><i class="fa fa-save"></i> Simpan </button> 
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