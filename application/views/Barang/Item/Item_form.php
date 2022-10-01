<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">ITEMS </a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
<?php $this->view('message')?>
	<div class="content">
	<div class="row">
            <div class="col">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					<h5 class ="box-title"> <?=ucfirst($page)?> Data Barang </h5>  
                </div>
					<div class="card-body">
						<a href="<?=site_url('item/index')?>"><button type="submit" class="btn btn-primary">
						<i class=""></i> Back</button> <br>
					</a>
						<div class="form">
							<form action="<?=site_url('item/proses')?>" method="post">
								<div class="form-group">
									<label>Kode Barang</label>
										<input type="hidden" name="item_id" value="<?=$row->item_id?>">
										<input type="hidden" name="kriteria_id" value="1">
										<input type="text" class="form-control" value="<?=$row->barcode?>" name="barcode" required>
								</div>
								<div class="form-group">
									<label>Nama Barang</label>
										<input type="text" class="form-control" value="<?=$row->nama?>" name="nama" required>
								</div>
								<div class="form-group">
									<label>Kategori Barang</label>
									<select name="kategori" class="form-control" required>
										<option value="">--</option>
										<?php foreach($kategori->result()as $key => $data) { ?> 
											<option value="<?=$data->kategori_id?>" <?=$data->kategori_id == $row->kategori_id ? "selected" : null?>> <?=$data->nama?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label>Brand</label>
									<select name="brand" class="form-control" required>
										<option value="">--</option>
										<?php foreach($brand->result()as $key => $data) { ?> 
											<option value="<?=$data->brand_id?>" <?=$data->brand_id == $row->brand_id ? "selected" : null?>> <?=$data->nama?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label>Unit</label>
									<select name="unit" class="form-control" required>
										<option value="">--</option>
										<?php foreach($unit->result()as $key => $data) { ?> 
											<option value="<?=$data->unit_id?>" <?=$data->unit_id == $row->unit_id ? "selected" : null?>> <?=$data->unit?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label>Harga Pembelian Barang</label>
										<input type="text" class="form-control" value="<?=$row->harga_pembelian?>" name="harga_pembelian" required>
								</div>
								<div class="form-group">
									<label>Harga Penjualan Barang</label>
										<input type="text" class="form-control" value="<?=$row->harga_penjualan?>" name="harga_penjualan" required>
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
	