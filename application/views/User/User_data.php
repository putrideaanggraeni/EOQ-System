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
<div id="flash" data-flash="<?=$this->session->flashdata('success');?>"> 
</div>
	<div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h5 class ="box-title"> Data User </h5> <hr>
                </div>
					<div class="card-body">
						<a href="<?=site_url('user/add')?>">
						<button type="submit" class="btn btn-primary"><i class="fa fa-user-plus"></i> Add</button>
						</a><br><br>
						<div class="table-responsive">
						<table class="table table-hover table-striped table-bordered" id="example">
						<thead>
							<tr align="center">	
								<th scope="col">No.</th>
								<th scope="col">Nama</th>
								<th scope="col">Username</th>
								<th scope="col">Password</th>
								<th scope="col">Level</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
								foreach($row->result() as $key => $data) { ?>
								<tr>
									<td><center><?=$no++?></center></td>
									<td><?=$data->nama?></td>
									<td><?=$data->username?></td>
									<td><?=$data->password?> </td>
									<td><?=$data->level == 1 ? "Admin": ""?> <?=$data->level == 2 ? "Kasir": ""?> <?=$data->level == 3 ? "Pemilik": ""?> </td>
									<td class="text-center">
										<a href="<?=site_url('user/edit/'.$data->user_id)?>">
										<button type="submit" class="btn btn-primary btn-xs"> 
										<i class="fa fa-edit"></i>
										</button></a>
										
										<a href="<?=site_url('user/del/'.$data->user_id)?>" id="btn-hapus" class="btn text-white btn-xs" style="background:#87CEEB!important"> 
										<i class="fa fa-trash-alt" style="text-white"></i>				
										</a>
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
	</div>
</div>	