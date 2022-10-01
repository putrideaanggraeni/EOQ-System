<div id="content">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
            </button>
                   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item disabled">
                    <a class="nav-link">DASHBOARD</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
	<div class="content">

	<div class="row">
            

            <div class="col-xl-3 col-md-6 mb-4 ">
              <div class="card border-left-success shadow h-100 py-2" style="background: #4682B4!important" >
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                        User</div>
                      <div class="h5 mb-0 font-weight-bold text-white text-gray-800"> <?=$this->fungsi->count_user()?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-4x text-white text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2" style="background: #4682B4!important">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                        Customer</div>
                      <div class="h5 mb-0 font-weight-bold text-white text-gray-800"><?=$this->fungsi->count_customer()?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-friends fa-4x text-white text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
			
			<div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2" style="background: #4682B4!important">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
                        Product</div>
                      <div class="h5 mb-0 font-weight-bold text-white text-gray-800"><?=$this->fungsi->count_item()?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-shopping-bag fa-4x text-white text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2" style="background: #4682B4!important">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
					<center>
                      <div class="text-xs font-weight-bold text-white text-uppercase mb-3">
                        Pendapatan Anda <br> Bulan Ini</div> <b> <i>
                      <div class="h5 mb-0 font-weight-bold text-white text-gray-800">
						<?php 
						$total_penjualan= 0;
						foreach($pendapatan as $key => $data)
						{
						?>
					  
						<?php 
						$total_penjualan += $data->totalpenjualan; 
						} ?>
						<?=indo_currency($total_penjualan)?>
					  </div>
					  </b></i>
					  </center>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
		
          <div class="row">
            <div class="col-sm-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Total Penjualan</h6>
                </div>
                <div class="card-body">
				<?php foreach ($penjualanreport as $data) {
					$bulan[] = $data->nama_bulan;
					$totalpenjualan[] = $data->totalpenjualan;
				}
				?>
				 <div class="col-12">
				 <div id="chart-tasks-overview"></div>
                 
                </div>
				</div>
              </div>
            </div>
			
			<div class="col-sm-12 mb-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3 ">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Penjualan Barang</h6>
                </div>
                <div class="card-body">
				<?php foreach ($brg as $data) {
					$nama[] = $data->nama;
					$jml[] = $data->jml;
				}
				?>
				<div class="col-12">
				<div id="chart-tasks-overview2"></div>
                 
                </div>
				</div>
              </div>
            </div>
		</div>
	</div>
</div>

<script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart-tasks-overview'), {
      		chart: {
      			type: "bar",
      			fontFamily: 'inherit',
      			height: 320,
      			parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			},
      			animations: {
      				enabled: true
      			},
      		},
      		plotOptions: {
      			bar: {
      				columnWidth: '50%',
      			}
      		},
      		dataLabels: {
      			enabled: true,
      		},
      		fill: {
      			opacity: 1,
      		},
      		series: [{
      			name: "A",
      			data: <?php  echo json_encode($totalpenjualan);?>
      		}],
      		grid: {
      			padding: {
      				top: -20,
      				right: 0,
      				left: -4,
      				bottom: -4
      			},
      			strokeDashArray: 4,
      		},
      		xaxis: {
      			labels: {
      				padding: 0
      			},
      			tooltip: {
      				enabled: true
      			},
      			axisBorder: {
      				show: true,
      			},
      			categories: <?php  echo json_encode($bulan);?>
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
      		colors: ["#ADD8E6"],
      		legend: {
      			show: true,
      		},
      	})).render();
      });
      // @formatter:on
    </script>
	
	<script>
      // @formatter:off
      document.addEventListener("DOMContentLoaded", function () {
      	window.ApexCharts && (new ApexCharts(document.getElementById('chart-tasks-overview2'), {
      		chart: {
      			type: "bar",
      			fontFamily: 'inherit',
      			height: 320,
      			parentHeightOffset: 0,
      			toolbar: {
      				show: false,
      			},
      			animations: {
      				enabled: true
      			},
      		},
      		plotOptions: {
      			bar: {
      				columnWidth: '50%',
      			}
      		},
      		dataLabels: {
      			enabled: true,
      		},
      		fill: {
      			opacity: 1,
      		},
      		series: [{
      			name: "A",
      			data: <?php  echo json_encode($jml);?>
      		}],
      		grid: {
      			padding: {
      				top: -20,
      				right: 0,
      				left: -4,
      				bottom: -4
      			},
      			strokeDashArray: 4,
      		},
      		xaxis: {
      			labels: {
      				padding: 0
      			},
      			tooltip: {
      				enabled: true
      			},
      			axisBorder: {
      				show: true,
      			},
      			categories: <?php  echo json_encode($nama);?>
      		},
      		yaxis: {
      			labels: {
      				padding: 4
      			},
      		},
      		colors: ["#206bc4"],
      		legend: {
      			show: true,
      		},
      	})).render();
      });
      // @formatter:on
    </script>
