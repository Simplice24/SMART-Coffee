
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
<!--  End of DataTable CSS --> 
<!-- DataTable report Links -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
<!-- End of DataTable report links -->
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
        <a class="navbar-brand brand-logo" href={{"Official/Home"}}>
            <img src="/logo.png" alt="My Logo" class="full-height">
            <span class="logo-text">CCMS</span>
        </a>
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
          <div class="row">
        <!-- Leaflet Map -->
        <div class="col-md-7">
          <div id="map" style="height: 650px; margin-bottom:20px;"></div>
        </div>
        <!-- End of Leaflet Map -->
        <div class="col-md-5">
        <div class="card">
            <div class="card-header">
              <div class="dropdown">
                <h6 class="float-left mt-2">Reported disease</h6>
              </div>
            </div>
            <div class="card-body">
              <div>
                <canvas id="ReportedDiseases"></canvas>
              </div>
            </div>
        </div>
        </div> 
</div>
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
                  <div class="form-inline">
                      <div class="form-group mr-2">
                          <label for="min">Minimum date: </label>
                          <input type="text" class="form-control" id="min" name="min">
                      </div>
                      <div class="form-group mr-2">
                          <label for="max">Maximum date: </label>
                          <input type="text" class="form-control" id="max" name="max">
                      </div>
                  </div>
                  <br>
                  <div class="table-responsive">
                  <table class="table table-striped" id="DiseasesTable">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>{{__('msg.Disease name')}}</th>
                        <th>{{__('msg.Disease category')}}</th>
                        <th>Registered</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($diseases as $i)
                      <tr>
                        <td>{{++$no}}</td>
                        <td>{{$i->disease_name}}</td>
                        <td>{{$i->category}}</td>
                        <td>{{$i->created_at->format('Y-m-d')}}</td>
                        <td>
                          <div class="input-group-prepend">
                          <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{"diseaseDetails/".$i->id}}"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; {{__('msg.view')}}</a>
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
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/datetime/1.4.1/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.5/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.8/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script>
        var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[3] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });
 
    // DataTables initialisation with Buttons extension
    var table = $('#DiseasesTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'copy',
            exportOptions: {
                columns: [0, 1, 2, 3] // Include columns 1-5
            }
        },
        {
            extend: 'csv',
            exportOptions: {
                columns: [0, 1, 2, 3] // Include columns 1-5
            }
        },
        {
            extend: 'excel',
            exportOptions: {
                columns: [0, 1, 2, 3] // Include columns 1-5
            }
        },
        {
            extend: 'pdf',
            exportOptions: {
                columns: [0, 1, 2, 3] // Include columns 1-5
            }
        },
        {
            extend: 'print',
            exportOptions: {
                columns: [0, 1, 2, 3] // Include columns 1-5
            }
        }
    ]
    });
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
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

    // Add markers for each district
    var pinIcon = L.icon({
      iconUrl: '/Images/pin-icon.png',
      iconSize: [15, 25],
      iconAnchor: [15, 50],
    });

    @foreach ($districts as $district)
    var marker = L.marker([{{ $district['latitude'] }}, {{ $district['longitude'] }}], { icon: pinIcon }).addTo(map);
    marker.bindPopup("{{ $district['name'] }}");
    @endforeach
  });
</script>
<script>
var DiseaseCounts = @json($DiseaseReported);

function getRandomColor() {
    var letters = '0123456789ABCDEF';
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

var YearMonthLabels = [];
var YearMonthlyCountsByDisease = {};

DiseaseCounts.forEach(function(item) {
    var YearMonth = item.YearMonth;
    var diseaseName = item.disease_name;
    var count = item.count;

    if (!YearMonthLabels.includes(YearMonth)) {
        YearMonthLabels.push(YearMonth);
    }

    if (!YearMonthlyCountsByDisease[diseaseName]) {
        YearMonthlyCountsByDisease[diseaseName] = {};
    }

    if (!YearMonthlyCountsByDisease[diseaseName][YearMonth]) {
        YearMonthlyCountsByDisease[diseaseName][YearMonth] = 0;
    }

    YearMonthlyCountsByDisease[diseaseName][YearMonth] += count;
});

var YearMonthlyDatasets = [];

for (var diseaseName in YearMonthlyCountsByDisease) {
    var data = [];

    for (var i = 0; i < YearMonthLabels.length; i++) {
        var YearMonth = YearMonthLabels[i];
        var count = YearMonthlyCountsByDisease[diseaseName][YearMonth] || 0;
        data.push(count);
    }

    YearMonthlyDatasets.push({
        label: diseaseName,
        data: data,
        fill: false,
        borderColor: getRandomColor(),
        borderWidth: 3
    });
}

var YearMonthlyCtx = document.getElementById('ReportedDiseases').getContext('2d');
var YearMonthlyChart = new Chart(YearMonthlyCtx, {
    type: 'bar',
    data: {
        labels: YearMonthLabels,
        datasets: YearMonthlyDatasets
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
</body>
</html>

