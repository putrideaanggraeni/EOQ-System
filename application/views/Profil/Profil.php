<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">PROFILE </a>
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
                  <h5 class ="box-title"> Profile </h5> 
                </div>
					<div class="card-body">
					<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img src="assets/images/<?= $this->fungsi->user_login()->gambar?>" class="img-responsive avatar-view" alt="Avatar" title="Change the avatar">
                        </div>
                    </div>
            
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <td>ID</td>
                          <td><?= $this->fungsi->user_login()->nama?></td>
                        </tr>
                        <tr>
                          <td>Nama Admin</td>
                          <td><?= $this->fungsi->user_login()->username?></td>
                        </tr>
                      </tbody>
                    </table>
					</div>
                  </div>
				  <br>
				  <a href="<?=site_url('profile/edit/'.$this->fungsi->user_login()->user_id)?>"  class="btn btn-primary btn-xs"> 
					<i class="fa fa-edit"></i>Ubah Profil</a>
					</div>
				</div>
            </div>
        </div>	
	</div>
</div>