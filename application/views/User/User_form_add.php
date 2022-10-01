<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">USER </a>
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
                  <h5 class ="box-title"> Tambah Data User </h5> 
                </div>
					<div class="card-body">
						<a href="<?=site_url('user/index')?>"><button type="submit" class="btn btn-primary">
							<i class=""></i> Back</button> <br>
						</a>
						<div class="form">
						<?php echo form_open_multipart('user/add') ?>
							<div class="form-group <?=form_error('fullname') ? 'has-error' : null?>">
								<label>Nama</label>
									<input type="text" class="form-control" value="<?=set_value('fullname')?>" name="fullname" >
									<?=form_error('fullname')?>
							</div>
							<div class="form-group <?=form_error('username') ? 'has-error' : null?>">
								<label>Username</label>
									<input type="text" class="form-control" value="<?=set_value('username')?>" name="username">
									<?=form_error('username')?>
							</div>
							<div class="form-group <?=form_error('password') ? 'has-error' : null?>">
								<label>Password</label>
									<input type="password" class="form-control" value="<?=set_value('password')?>" name="password">
									<?=form_error('password')?>
							</div>
							<div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
								<label>Konfirmasi Password</label>
									<input type="password" class="form-control" value="<?=set_value('passconf')?>" name="passconf">
									<?=form_error('passconf')?>
							</div>
							<div class="form-group <?=form_error('level') ? 'has-error' : null?>">
								<label>Level</label>
									<select name="level" class="form-control">
										<option value=""> -- </option>
										<option value="1" <?=set_value('level') == 1 ? "selected" : null?>> Admin </option>
										<option value="2" <?=set_value('level') == 2 ? "selected" : null?>> Kasir </option>
										<option value="2" <?=set_value('level') == 3 ? "selected" : null?>> Pemilik </option>
									</select>
									<?=form_error('level')?>
							</div>
							<div class="form-group">
							<label>Choose Image</label>
							<div class="row">
									<div class="col-sm">
									<div class="custom-file">
									<input type="file" class="custom-file-input" id="gambar" name="gambar">
									<label class="custom-file-label" for="gambar"> Choose File </label>
									</div>
									</div>
							</div>
							</div>							
							<br>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan </button> 
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