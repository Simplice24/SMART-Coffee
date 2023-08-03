
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
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">{{ __('msg.diseases') }}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                    <a class="nav-link text-white hover-white" href="<?=url('viewdiseases');?>">
                      <span class="menu-title">Normal Report</span>
                    </a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link text-white hover-white" href="<?=url('Official/realtimediseases');?>">
                      <span class="menu-title">Realtime Report</span>
                    </a>
                </li>
              </ul>
            </div>
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

          <div class="row">
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <a href="<?=url('Official/Managers');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                  <img src="/Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{ __('msg.Managers')}}<i class="icon-head menu-icon float-right"></i>
                    </h4>
                    <h1 class="mb-5">{{$numberOfManagers}}</h1>
                    @if($ManagersPercentage>0)
                    <h6 class="card-text"><b>{{$ManagersPercentage}}% increase this Year</b></h6>
                    @elseif($ManagersPercentage==0){
                      <h6 class="card-text"><b>No increase this Year</b></h6>  
                    }
                    @else
                    <h6 class="card-text"><b>{{$ManagersPercentage}}% decrease this Year</b></h6>
                    @endif
                  </div>
                  </a>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                <a href="<?=url('Official/Farmers');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                    <img src="/Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{ __('msg.farmers')}}<i class="icon-head menu-icon float-right"></i>
                    </h4>
                    <h1 class="mb-5">{{$numberOfFarmers}}</h1>
                    @if($FarmersPercentage>0)
                    <h6 class="card-text"><b>{{$FarmersPercentage}}% increase this Year</b></h6>
                    @elseif($FarmersPercentage==0)
                    <h6 class="card-text"><b>No increase this Year</b></h6>
                    @else
                    <h6 class="card-text"><b>{{$FarmersPercentage}}% decrease this Year</b></h6>
                    @endif
                  </div>
                </a>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                <a href="<?=url('Official/Cooperatives');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                    <img src="/Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> {{ __('msg.cooperatives')}}<i class="icon-disc menu-icon float-right"></i>
                    </h4>
                    <h1 class="mb-5">{{$numberOfCooperatives}}</h1>
                    @if($coopPercentage>0)
                    <h6 class="card-text"><b>{{$coopPercentage}}% increase this Year</b></h6>
                    @elseif($coopPercentage==0)
                    <h6 class="card-text"><b>No increase this Year</b></h6>
                    @else
                    <h6 class="card-text"><b>{{$coopPercentage}}% decrease this Year</b></h6>
                    @endif
                  </div>
                  </a>
                </div>
              </div>
               <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                <a href="<?=url('Official/Diseases');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                    <img src="/Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> {{ __('msg.diseases')}}<i class="icon-command menu-icon float-right"></i>
                    <h1 class="mb-5">{{$diseases}}</h1>
                    <h6 class="card-text"><b>Increased by 23% this month</b></h6>
                  </div> 
                 </a> 
                </div>
              </div>
           </div>

           <!-- starting point -->

           <div class="row">
              <div class="col-md-3  grid-margin">
                <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Male managers<i class="mdi mdi-gender-male menu-icon float-right"></i></h4>
                          
                          <h4 class="text-dark font-weight-bold mb-2">{{ $MaleManagersCount }}</h4>
                          <canvas id="MaleManagers"></canvas>
                      </div>
                      </div>
                      <div class="card mt-2">
                      <div class="card-body">
                          <h4 class="card-title">Female managers<i class="mdi mdi-gender-female menu-icon float-right"></i></h4>
                          
                          <h4 class="text-dark font-weight-bold mb-2">{{ $FemaleManagersCount}}</h4>
                          <canvas id="FemaleManagers"></canvas>
                      </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin">
                <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Male farmers<i class="mdi mdi-gender-male menu-icon float-right"></i></h4>
                          
                          <h4 class="text-dark font-weight-bold mb-2">{{ $MaleFarmersCount }}</h4>
                          <canvas id="MaleFarmers"></canvas>
                      </div>
                      </div>
                      <div class="card mt-2">
                      <div class="card-body">
                          <h4 class="card-title">Female farmers<i class="mdi mdi-gender-female menu-icon float-right"></i></h4>
                          
                          <h4 class="text-dark font-weight-bold mb-2">{{ $FemaleFarmersCount }}</h4>
                          <canvas id="FemaleFarmers"></canvas>
                      </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin">
              <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Active cooperatives</h4>
                          
                          <h4 class="text-dark font-weight-bold mb-2">{{ $ActiveCooperativesCount }}</h4>
                          <canvas id="ActiveCooperatives"></canvas>
                      </div>
                      </div>
                      <div class="card mt-2">
                      <div class="card-body">
                          <h4 class="card-title">Inactive cooperatives</h4>
                          
                          <h4 class="text-dark font-weight-bold mb-2">{{ $InactiveCooperativesCount }}</h4>
                          <canvas id="InactiveCooperatives"></canvas>
                      </div>
              </div>      
               
              </div>
               <div class="col-md-3 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title mb-2">Diseases</h4>
                    <div class="row">
                      <div class="col-sm-20">
                        <div class="text-dark">
                         @foreach ($Totaldiseases as $disease)
                          <div class="d-flex pb-3 border-bottom justify-content-between">
                            <div class="mr-3 mt-2"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4 mt-2">
                              <div>{{ $disease->category}}</div>
                              <div class="text-muted font-weight-normal mt-1"></div>
                            </div>
                            <div><h6 class="font-weight-bold text-danger ml-sm-2 mt-2">{{$disease->current_month_total}}</h6></div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
                <div class="card mt-2">
                  <div class="card-body">
                    <h4 class="card-title">Reported diseases</h4>
                    <div class="row">
                      <div class="col-sm-12">
                          <div class="d-flex justify-content-between mt-2 text-dark mb-2">
                              <div><span class="font-weight-bold">{{$TotalReportedDiseases}}</span> Reported diseases</div>
                              
                            </div>
                       
                      </div>
                      <div class="col-sm-12">
                        <div class="traffic-source-legend">
                          <div class="d-flex justify-content-between mb-1 mt-2">
                            <div class="font-weight-bold">DISEASES</div>
                            <div class="font-weight-bold">TOTAL</div>
                          </div>
                          @foreach($percentByDiseaseCategory as $diseasepercentage)
                          <div class="d-flex justify-content-between legend-label">
                            <div><span class="bg-danger"></span>
                            {{$diseasepercentage->disease_name}}
                            </div>
                            <div>{{$diseasepercentage->percentage}}%</div>
                          </div>
                          @endforeach
                          <div class="d-flex justify-content-between mb-1 mt-2">
                            <div class="font-weight-bold">CATEGORY</div>
                            <div class="font-weight-bold">TOTAL</div>
                          </div>
                          @foreach($DiseaseCategoryPercentage as $categorypercentage)
                          <div class="d-flex justify-content-between legend-label">
                            <div><span class="bg-danger"></span>
                            {{$categorypercentage->disease_category}}
                            </div>
                            <div>{{$categorypercentage->percentage}}%</div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>
           </div>

           <!-- ending point -->

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
  <script>
    var MaleManagersxValues=@json($MaleManagerMonthYear);
    var MaleManagersyValues=@json($MaleManagercount);
  new Chart("MaleManagers", {
  type: "bar",
  data: {
    labels: MaleManagersxValues,
    datasets: [{
        label: 'Male Managers',
        data: MaleManagersyValues,
        backgroundColor: "rgb(111,168,220)",
        borderWidth: 1,
        fill: false
      }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
            
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      },
      tooltips: {
        enabled: false
      }
  }
});
</script>
<script>
  var FemaleManagersxValues=@json($FemaleManagerMonthYear);
  var FemaleManagersyValues=@json($FemaleManagercount);
  new Chart("FemaleManagers", {
  type: "bar",
  data: {
    labels: FemaleManagersxValues,
    datasets: [{
        label: 'Male Users',
        data: FemaleManagersyValues,
        backgroundColor: "rgb(213,166,189)",
        borderWidth: 1,
        fill: false
      }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
            
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      },
      tooltips: {
        enabled: false
      }
  }
});
</script>  
<script>
  var MalefarmerxValues=@json($MaleFarmerMonthYear);
  var MalefarmeryValues=@json($MaleFarmercount);
  new Chart("MaleFarmers", {
  type: "bar",
  data: {
    labels: MalefarmerxValues,
    datasets: [{
        label: 'Male Users',
        data: MalefarmeryValues,
        backgroundColor: "rgb(111,168,220)",
        borderWidth: 1,
        fill: false
      }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
            
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      },
      tooltips: {
        enabled: false
      }
  }
});
</script> 
<script>
var FemalefarmerxValues=@json($FemaleFarmerMonthYear);
var FemalefarmeryValues=@json($FemaleFarmercount);
new Chart("FemaleFarmers", {
  type: "bar",
  data: {
    labels: FemalefarmerxValues,
    datasets: [{
        label: 'Male Users',
        data: FemalefarmeryValues,
        backgroundColor: "rgb(213,166,189)",
        borderWidth: 1,
        fill: false
      }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
            
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      },
      tooltips: {
        enabled: false
      }
  }
});
</script>
<script>
  var activexValues=@json($ActiveCoopMonthYear);
  var activeyValues=@json($ActiveCoopcount);

  new Chart("ActiveCooperatives", {
  type: "bar",
  data: {
    labels: activexValues,
    datasets: [{
        label: 'Male Users',
        data: activeyValues,
        backgroundColor: "rgb(84, 214, 139)",
        borderWidth: 1,
        fill: false
      }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
            
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      },
      tooltips: {
        enabled: false
      }
  }
});
</script> 
<script>
  var InactivecoopxValues=@json($InactiveCoopMonthYear);
  var InactivecoopyValues=@json($InactiveCoopcount);
  new Chart("InactiveCooperatives", {
  type: "bar",
  data: {
    labels: InactivecoopxValues,
    datasets: [{
        label: 'Male Users',
        data: InactivecoopyValues,
        backgroundColor: "rgb(234, 199, 44)",
        borderWidth: 1,
        fill: false
      }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
    },
    scales: {
        yAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
            
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }],
        xAxes: [{
          ticks: {
            beginAtZero: true,
            display: true,
          },
          gridLines: {
            display: false,
            drawBorder: false
          }
        }]
      },
      legend: {
        display: false
      },
      elements: {
        point: {
          radius: 0
        }
      },
      tooltips: {
        enabled: false
      }
  }
});
</script>  
</body>
</html>

