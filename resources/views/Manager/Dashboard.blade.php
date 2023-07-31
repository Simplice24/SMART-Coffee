
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CCMS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <!-- base:css -->
  <link rel="stylesheet" href="/Customized/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/Customized/vendors/feather/feather.css">
  <link rel="stylesheet" href="/Customized/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="/Customized/vendors/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="/Customized/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/Customized/vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="/Customized/vendors/jquery-bar-rating/fontawesome-stars.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/Customized/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/Customized/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href={{"Manager/Home"}}>
            <img src="/logo.png" alt="My Logo" class="full-height">
            <span class="logo-text">CCMS</span>
        </a>
        <a class="navbar-brand brand-logo-mini" href={{"Manager/Home"}}>CCMS</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <!-- <li class="nav-item dropdown d-lg-flex d-none">
                <button type="button" class="btn btn-info font-weight-bold">+ Create New</button>
            </li> -->
          <li class="nav-item dropdown d-flex">
          <div class="dropdown">
  <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    {{ __('msg.languages') }}
  </a>

  <ul class="dropdown-menu">
    <a class="dropdown-item preview-item" href="<?=url('locale/en');?>">               
    {{ __('msg.english') }}
    </a>
    <a class="dropdown-item preview-item" href="<?=url('locale/fr');?>">               
    {{ __('msg.francais') }}
    </a>
    <a class="dropdown-item " href="<?=url('locale/kiny');?>">               
         Ikinyarwanda
    </a>
  </ul>
</div>
          </li>
          <li class="nav-item dropdown d-flex mr-4 ">
            <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-cog"></i>
            </a>
            
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">{{ __('msg.settings') }}</p>
              <a class="dropdown-item preview-item" href="<?=url('userProfile');?>">               
                  <i class="icon-head"></i> {{ __('msg.profile') }}
              </a>
              <!-- <a class="dropdown-item preview-item" href="">               
                  <i class="icon-head"></i> French
              </a>
              <a class="dropdown-item preview-item" href="">               
                  <i class="icon-head"></i> English
              </a> -->
              <a class="dropdown-item preview-item" href="<?=url('logout');?>">
                  <i class="icon-inbox"></i> {{ __('msg.logout') }}
              </a>
            </div>
          </li>
          
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="user-profile">
          <div class="user-image">
          <img src="{{asset('/storage/images/users/'.$profileImg->image)}}">
          </div>
          <div class="user-name">
          {{session('user')}}
          </div>
          <div class="user-designation">
          {{$profileImg->role}}
          </div>
        </div>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?=url('Manager/Home');?>">
              <i class="icon-air-play menu-icon"></i>
              <span class="menu-title">{{ __('msg.dashboard') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('CooperativeFarmers');?>">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">{{ __('msg.farmers') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('StockDetails');?>">
              <i class="mdi mdi-stocking menu-icon"></i>
              <span class="menu-title">{{ __('msg.Stock') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('CooperativeSales');?>">
              <i class="mdi mdi-chart-line menu-icon"></i>
              <span class="menu-title">{{ __('msg.Sales tracking') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('CooperativeDiseases');?>">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">{{ __('msg.diseases') }}</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
              <h4 class="font-weight-bold text-dark">{{ __('msg.hi, welcome back!')}}</h4>
              <!-- <p class="font-weight-normal mb-2 text-muted">APRIL 1, 2019</p> -->
            </div>
          </div>
           <!-- Second row -->

           <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <a href="<?=url('CooperativeFarmers');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                  <img src="/Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{ __('msg.farmers')}}<i class="icon-head menu-icon float-right"></i>
                    </h4>
                    <h1 class="mb-5">{{$totalFarmers}}</h1>
                    @if ($increasedPercentage > 0)
                    <h6 class="card-text"><b></b></h6>
                    @elseif($increasedPercentage < 0)
                    <h6 class="card-text"><b></b></h6>
                    @else
                    <h6 class="card-text"><b></b></h6>
                    @endif
                  </div>
                  </a>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-warning card-img-holder text-white">
                <a href="" style="text-decoration:none; color:white;">
                  <div class="card-body">
                    <img src="/Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Coffee trees<i class="mdi mdi-barley menu-icon float-right"></i>
                    </h4>
                    <h1 class="mb-5">{{$total_trees}}</h1>
                    @if($increaseInTrees > 0)
                    <h6 class="card-text"><b></b></h6> 
                    @elseif($increaseInTrees < 0)
                    <h6 class="card-text"><b></b></h6> 
                    @else
                    <h6 class="card-text"><b></b></h6>
                    @endif
                  </div>
                </a>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                <a href="<?=url('CooperativeSales')?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                    <img src="/Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Monthly Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    <h1 class="mb-5">{{$currentMonthSalesTotal}}</h1>
                    @if($increaseInSales > 0)
                    <h6 class="card-text"><b></b></h6>
                    @elseif($increaseInSales < 0)
                    <h6 class="card-text"><b></b></h6>
                    @else
                    <h6 class="card-text"><b>No change in sales</b></h6>
                    @endif
                  </div>
                  </a>
                </div>
              </div>
               <div class="col-md-3 stretch-card grid-margin">
               <div class="card bg-gradient-secondary card-img-holder text-white">
                <a href="<?=url('StockDetails');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                  <img src="/Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />  
                  <h4 class="font-weight-normal mb-3">Available Stock<i class="mdi mdi-stocking menu-icon float-right"></i>
                    @foreach($CooperativeStockInventoryByCategory as $product)
                    <h2>{{$product->total_quantity}} Kgs</h2>
                    <h6>{{$product->product_category}}</h6>
                    @endforeach
                  </div> 
                 </a> 
                </div>
              </div>
           </div>
              
           <!-- End of second row -->
           <div class="row ">
              <div class="col-md-3">
                <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Male farmers<i class="mdi mdi-gender-male menu-icon float-right"></i></h4>
                          <!-- <p>{{$CoopMaleFarmerspercentIncrease}}% increase this month</p> -->
                          <h4 class="text-dark font-weight-bold mb-2">{{$male_farmers}}</h4>
                          <div class="col-sm-10">
                              <div class="progress progress-lg mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{($male_farmers/$totalFarmers *100)}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{Round(($male_farmers/$totalFarmers *100),2)}}%</div>
                              </div>
                          </div>
                      </div>
                      </div>
                      <div class="card mt-2">
                      <div class="card-body">
                          <h4 class="card-title">Female farmers<i class="mdi mdi-gender-male-female menu-icon float-right"></i></h4>
                          <!-- <p>{{$CoopFemaleFarmerspercentIncrease}}% increase in month</p> -->
                          <h4 class="text-dark font-weight-bold mb-2">{{$female_farmers}}</h4>
                          <div class="col-sm-10">
                              <div class="progress progress-lg mt-1">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{($female_farmers/$totalFarmers *100)}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{Round(($female_farmers/$totalFarmers *100),2)}}%</div>
                              </div>
                          </div>
                      </div>
                      </div>                   
                </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <div class="dropdown">
                    <h6 class="float-left mt-2">Farmers and Coffee trees</h6>
                    <button class="btn btn-secondary dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Farmers
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="#" id="this-month-link">Farmers</a>
                      <a class="dropdown-item" href="#" id="yearly-link">Coffee trees</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <div id="this-month-content">
                    <canvas id="FarmersChart"></canvas>
                  </div>
                  <div id="yearly-content" style="display:none">
                    <canvas id="TreesChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="card">
                <div class="card-body">
                  <h6 class="float-left">Stock and Sales</h6>
                  <div id="this-month-content">
                    <canvas id="StockSalesChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
           </div>
        </div>

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © CCMS 2023</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="/Customized/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="/Customized/js/off-canvas.js"></script>
  <script src="/Customized/js/hoverable-collapse.js"></script>
  <script src="/Customized/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="/Customized/vendors/chart.js/Chart.min.js"></script>
  <script src="/Customized/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="/Customized/js/dashboard.js"></script>
  <!-- End custom js for this page-->  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('FarmersChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($farmerCounts as $count)
                '{{ $count->ym }}',
            @endforeach
        ],
        datasets: [{
            label: 'Number of farmers registered',
            data: [
                @foreach($farmerCounts as $count)
                    {{ $count->count }},
                @endforeach
            ],
            backgroundColor: 'rgba(40, 167, 69, 1)',
            borderColor: 'rgba(40, 167, 69, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize: 1
                }
            }]
        }
    }
});
</script>
<script>
    var ctx = document.getElementById('TreesChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            @foreach($treeCounts as $count)
                '{{ $count->ym }}',
            @endforeach
        ],
        datasets: [{
            label: 'Number of trees',
            data: [
                @foreach($treeCounts as $count)
                    {{ $count->total_trees }},
                @endforeach
            ],
            backgroundColor: 'rgba(255, 193, 7, 1)',
            borderColor: 'rgba(255, 193, 7, 3)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                }
            }]
        }
    }
});
</script>
<script>
  document.getElementById("this-month-link").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior
    document.getElementById("this-month-content").style.display = "block";
    document.getElementById("yearly-content").style.display = "none";
    document.getElementById("dropdownMenuButton").textContent = "Farmers"; // Change button text to "This Month"
  });
  
  document.getElementById("yearly-link").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior
    document.getElementById("this-month-content").style.display = "none";
    document.getElementById("yearly-content").style.display = "block";
    document.getElementById("dropdownMenuButton").textContent = "Coffee trees"; // Change button text to "This Year"
  });
</script>
<script>
var ctx = document.getElementById('StockSalesChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar', // default chart type
    data: {
        labels: [
            @foreach($labels as $count)
                '{{ $count->ym }}',
            @endforeach
        ],
        datasets: [{
            label: 'Stock',
            data: [
                @foreach($stocks as $count)
                    {{ $count->total_stocks }},
                @endforeach
            ],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }, {
            type: 'line', // chart type for second dataset
            label: 'Sales',
            data: [
                @foreach($sales as $count)
                    {{ $count->total_sales }} ,
                @endforeach
            ],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
</body>
</html>

