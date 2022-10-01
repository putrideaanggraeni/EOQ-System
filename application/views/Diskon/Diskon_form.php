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
	<div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class ="box-title">  Kelola Diskon </h5> 
                </div>
					<div class="card-body">
						<a href="<?=site_url('diskon/edit')?>"><button type="submit" class="btn btn-primary">
							<i class=""></i>Setting Diskon</button> <br>
						</a>
						<div class="form">
							<?php foreach($row->result() as $key => $data) { ?>
							<div class="form-group">
								<label><b>Diskon %</b></label>
									<input type="hidden" class="form-control" value="<?=$data->diskon_id?>" name="diskon_id" id="diskon_id" readonly>
									<input type="number" class="form-control" value="<?=$data->diskon?>" name="diskon" id="diskon" readonly>
							</div>
							<div class="form-group">
								<label><b>Keterangan Diskon</b></label>
									<input type="text" class="form-control" value="<?=$data->ket_diskon?>" name="ket_diskon" id="ket_diskon" readonly>
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