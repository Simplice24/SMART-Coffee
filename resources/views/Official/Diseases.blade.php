
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
   <!-- Datatable -->
   <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
  <!-- End of datatable -->
    <!-- Leaflet Map -->
    <link rel="stylesheet" href="{{ asset('leaflet/leaflet.css') }}" />
  <script src="{{ asset('leaflet/leaflet.js') }}"></script>
  <!-- End of LeafletMap -->
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href={{"Official/Home"}}><i class="icon-air-play menu-icon"></i>CCMS</a>
        <a class="navbar-brand brand-logo-mini" href={{"Official/Home"}}>CCMS</a>
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
              <a class="dropdown-item preview-item" href="">               
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
            <a class="nav-link" href="<?=url('Official/Home');?>">
              <i class="icon-air-play menu-icon"></i>
              <span class="menu-title">{{ __('msg.dashboard') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('Official/Managers');?>">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">{{ __('msg.Managers') }}</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?=url('Official/Cooperatives');?>">
              <i class="icon-disc menu-icon"></i>
              <span class="menu-title">{{ __('msg.cooperatives') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('Official/Farmers');?>">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">{{ __('msg.farmers') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('Official/Diseases');?>">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">{{ __('msg.diseases') }}</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="<?=url('Official/Analytics');?>">
              <i class="icon-bar-graph-2 menu-icon"></i>
              <span class="menu-title">{{ __('msg.Analytics')}}</span>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <!-- Leaflet Map -->
        <div class="col-md-7">
          <div id="map" style="height: 650px; margin-bottom:20px;"></div>
        </div>
        <!-- End of Leaflet Map -->
          <div class="row">
            <div class="col-sm-12 mb-4 mb-xl-0">
            @can('create-disease')
            <li class="nav-item dropdown d-lg-flex d-none">
            <a href="<?=url('registerNewDisease');?>"><button type="button" class="btn btn-info font-weight-bold">+ {{__('msg.new disease')}}</button></a>
            </li>
            @endcan
            </div>
          </div>
          
           <div class="row">
           <div class="col-lg-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{__('msg.coffee diseases')}}</h4>
                  <div class="table-responsive">
                  <table class="table table-striped" id="DiseasesTable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>{{__('msg.Disease name')}}</th>
                        <th>{{__('msg.Disease category')}}</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($diseases as $i)
                      <tr>
                        <td>{{++$no}}</td>
                        <td>{{$i->disease_name}}</td>
                        <td>{{$i->category}}</td>
                        <td>
                          <div class="input-group-prepend">
                            <button class="btn btn-sm btn-outline-primary" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href=""><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; {{__('msg.view')}}</a>
                              @can('delete-disease')
                              <a class="dropdown-item" href=""><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; {{__('msg.delete')}}</a>
                              @endcan
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin">
              <div class="card">
  <div class="card-header">
    <div class="dropdown">
      <h6 class="float-left mt-2">Reported disease</h6>
      <button class="btn btn-secondary dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        This Month
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#" id="this-month-link">This Month</a>
        <a class="dropdown-item" href="#" id="yearly-link">This Year</a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div id="this-month-content">
      <canvas id="MonthlyChart"></canvas>
    </div>
    <div id="yearly-content" style="display:none">
      <canvas id="YearlyChart"></canvas>
    </div>
  </div>
</div>


            </div>
           </div>
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
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function() {
    $('#DiseasesTable').DataTable({
      "paging": true,
      "ordering": false,
      "searching": true
    });
  });
</script>
<script>
  document.getElementById("this-month-link").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior
    document.getElementById("this-month-content").style.display = "block";
    document.getElementById("yearly-content").style.display = "none";
    document.getElementById("dropdownMenuButton").textContent = "This Month"; // Change button text to "This Month"
  });
  
  document.getElementById("yearly-link").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior
    document.getElementById("this-month-content").style.display = "none";
    document.getElementById("yearly-content").style.display = "block";
    document.getElementById("dropdownMenuButton").textContent = "This Year"; // Change button text to "This Year"
  });
</script>

<script>
var monthlyCounts = @json($monthlyCounts);
var yearlyCounts = @json($yearlyCounts);

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

var monthlyLabels = [];
var monthlyCountsByDisease = {};

monthlyCounts.forEach(function(item) {
    if (!monthlyLabels.includes(item.month)) {
        monthlyLabels.push(item.month);
    }
    
    if (!monthlyCountsByDisease[item.disease_name]) {
        monthlyCountsByDisease[item.disease_name] = [];
    }

    monthlyCountsByDisease[item.disease_name].push(item.count);
});

var monthlyDatasets = [];

for (var diseaseName in monthlyCountsByDisease) {
    var data = monthlyCountsByDisease[diseaseName];

    monthlyDatasets.push({
        label: diseaseName,
        data: data,
        fill: false,
        borderColor: getRandomColor(),
        borderWidth: 3
    });
}

var monthlyCtx = document.getElementById('MonthlyChart').getContext('2d');
var monthlyChart = new Chart(monthlyCtx, {
    type: 'bar',
    data: {
        labels: monthlyLabels,
        datasets: monthlyDatasets
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize:1
                }
            }]
        }
    }
});

var yearlyLabels = [];
var yearlyCountsByDisease = {};

yearlyCounts.forEach(function(item) {
    if (!yearlyLabels.includes(item.year)) {
        yearlyLabels.push(item.year);
    }
    
    if (!yearlyCountsByDisease[item.disease_name]) {
        yearlyCountsByDisease[item.disease_name] = [];
    }

    yearlyCountsByDisease[item.disease_name].push(item.count);
});

var yearlyDatasets = [];

for (var diseaseName in yearlyCountsByDisease) {
    var data = yearlyCountsByDisease[diseaseName];

    yearlyDatasets.push({
        label: diseaseName,
        data: data,
        fill: false,
        borderColor: getRandomColor(),
        borderWidth: 3
    });
}

var yearlyCtx = document.getElementById('YearlyChart').getContext('2d');
var yearlyChart = new Chart(yearlyCtx, {
    type: 'bar',
    data: {
        labels: yearlyLabels,
        datasets: yearlyDatasets
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize:1
                }
            }]
        }
    }
});
</script>
<script>
  // Initialize the Leaflet map
  var map = L.map('map', {
    minZoom: 9,
    maxZoom: 14
  }).setView([-1.9403, 29.8739], 9);

  // Add a tile layer from OpenStreetMap
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
  }).addTo(map);

  // Load the Rwanda GeoJSON file and add it to the map as a layer
  $.getJSON("{{ url('geojson/RWA.geo.json') }}", function(data) {
    var districts = L.geoJSON(data, {
      filter: function(feature, layer) {
        return feature.properties.type === "District";
      }
    }).addTo(map);

    var provinces = L.geoJSON(data, {
      filter: function(feature, layer) {
        return feature.properties.type === "Province";
      }
    }).addTo(map);

  });
</script>
</body>
</html>
