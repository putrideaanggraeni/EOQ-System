<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">CUSTOMER </a>
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
					<h5 class ="box-title"> <?=ucfirst($page)?> Customer </h5> 
                </div>
					<div class="card-body">
						<a href="<?=site_url('customer/index')?>"><button type="submit" class="btn btn-primary">
							<i class=""></i> Back</button> <br>
						</a>
						<div class="form">
						<form action="<?=site_url('customer/proses')?>" method="post">
							<div class="form-group">
								<label>Nama</label>
									<input type="hidden" name="id" value="<?=$row->customer_id?>">
									<input type="text" class="form-control" value="<?=$row->nama?>" name="customer_name" required>
							</div>
							<div class="form-group">
								<label>Alamat</label>
									<textarea class="form-control" name="alamat" required><?=$row->alamat?></textarea>
							</div>
							<div class="form-group">
								<label>No HP</label>
									<input type="text" class="form-control" value="<?=$row->nohp?>" name="nohp" required>
							</div>
							<div class="form-group">
								<button type="submit" name="<?=$page?>" class="btn btn-primary"><i class="fa fa-save"></i> Simpan </button> 
								<button type="Reset" class="btn text-white" style=" background: #6495ED!important"><i class="fa fa-eraser"></i> Batal </button>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>	
	</div>
</div>	