
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
  <link rel="stylesheet" href="Customized/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="Customized/vendors/feather/feather.css">
  <link rel="stylesheet" href="Customized/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="Customized/vendors/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="Customized/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="Customized/vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="Customized/vendors/jquery-bar-rating/fontawesome-stars.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="Customized/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="Customized/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href={{"Home"}}><i class="icon-air-play menu-icon"></i>CCMS</a>
        <a class="navbar-brand brand-logo-mini" href={{"Home"}}>CCMS</a>
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
          @role('Super-Admin')
          <li class="nav-item">
            <a class="nav-link" href="<?=url('Home');?>">
              <i class="icon-air-play menu-icon"></i>
              <span class="menu-title">{{ __('msg.dashboard') }}</span>
            </a>
          </li>
          @endrole
          @if(Auth::user()->can('create-user'))
          <li class="nav-item">
            <a class="nav-link" href="<?=url('viewsystemuser');?>">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">{{ __('msg.system users') }}</span>
            </a>
          </li>
          @endif
          @can('create-cooperative')
           <li class="nav-item">
            <a class="nav-link" href="<?=url('viewcooperatives');?>">
              <i class="icon-disc menu-icon"></i>
              <span class="menu-title">{{ __('msg.cooperatives') }}</span>
            </a>
          </li>
          @endcan
          @can('create-farmer')
          <li class="nav-item">
            <a class="nav-link" href="<?=url('viewfarmers');?>">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">{{ __('msg.farmers') }}</span>
            </a>
          </li>
          @endcan
          @role('Manager')
          <li class="nav-item">
            <a class="nav-link" href="<?=url('CooperativeFarmers');?>">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">Members</span>
            </a>
          </li>
          @endrole
          @can('create-disease')
          <li class="nav-item">
            <a class="nav-link" href="<?=url('viewdiseases');?>">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">{{ __('msg.diseases') }}</span>
            </a>
          </li>
          @endcan
          <li class="nav-item">
            <a class="nav-link" href="<?=url('analytics');?>">
              <i class="icon-bar-graph-2 menu-icon"></i>
              <span class="menu-title">Analytics</span>
            </a>
          </li>
          @can('create-role')
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-share menu-icon"></i>
              <span class="menu-title">Roles | Permissions</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=url('Allroles');?>"> Roles </a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=url('Allpermissions');?>"> Permissions </a></li>
              </ul>
            </div>
          </li>
          @endcan
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
                  <a href="<?=url('viewsystemuser');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                  <img src="Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{ __('msg.system users')}}<i class="icon-head menu-icon float-right"></i>
                    </h4>
                    <h1 class="mb-5">{{$rows}}</h1>
                  </div>
                  </a>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                <a href="<?=url('viewfarmers');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                    <img src="Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">{{ __('msg.farmers')}}<i class="icon-head menu-icon float-right"></i>
                    </h4>
                    <h1 class="mb-5">{{$farmer}}</h1>
                  </div>
                </a>
                </div>
              </div>
              <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-primary card-img-holder text-white">
                <a href="<?=url('viewcooperatives');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                    <img src="Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> {{ __('msg.cooperatives')}}<i class="icon-disc menu-icon float-right"></i>
                    </h4>
                    <h1 class="mb-5">{{$cooperative}}</h1>
                  </div>
                  </a>
                </div>
              </div>
               <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                <a href="<?=url('viewdiseases');?>" style="text-decoration:none; color:white;">
                  <div class="card-body">
                    <img src="Customized/assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3"> {{ __('msg.diseases')}}<i class="icon-command menu-icon float-right"></i>
                    <h1 class="mb-5">{{$disease}}</h1>
                  </div>
                 </a> 
                </div>
              </div>
           </div>

           <!-- starting point -->

           <div class="row ">
              <div class="col-md-3  grid-margin">
                <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Male users</h4>
                          <p>23% increase in conversion</p>
                          <h4 class="text-dark font-weight-bold mb-2">{{$CountingMale}}</h4>
                          <canvas id="MaleUsers"></canvas>
                      </div>
                      <div class="card-body">
                          <h4 class="card-title">Female users</h4>
                          <p>23% increase in conversion</p>
                          <h4 class="text-dark font-weight-bold mb-2">{{$CountingFemale}}</h4>
                          <canvas id="FemaleUsers"></canvas>
                      </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin">
                <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Male farmers</h4>
                          <p>23% increase in conversion</p>
                          <h4 class="text-dark font-weight-bold mb-2">{{$CountingMaleFarmers}}</h4>
                          <canvas id="MaleFarmers"></canvas>
                      </div>
                      <div class="card-body">
                          <h4 class="card-title">Female farmers</h4>
                          <p>23% increase in conversion</p>
                          <h4 class="text-dark font-weight-bold mb-2">{{$CountingFemaleFarmers}}</h4>
                          <canvas id="FemaleFarmers"></canvas>
                      </div>
                </div>
              </div>
              <div class="col-md-3 grid-margin">
              <div class="card">
                      <div class="card-body">
                          <h4 class="card-title">Active cooperatives</h4>
                          <p>23% increase in conversion</p>
                          <h4 class="text-dark font-weight-bold mb-2">{{$activeCount}}</h4>
                          <canvas id="ActiveCooperatives"></canvas>
                      </div>
                      <div class="card-body">
                          <h4 class="card-title">Inactive cooperatives</h4>
                          <p>23% increase in conversion</p>
                          <h4 class="text-dark font-weight-bold mb-2">{{$inactiveCount}}</h4>
                          <canvas id="InactiveCooperatives"></canvas>
                      </div>
              </div>      
               
              </div>
               <div class="col-md-3 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title mb-3">Diseases</h4>
                    <div class="row">
                      <div class="col-sm-20">
                        <div class="text-dark">
                          <div class="d-flex pb-3 border-bottom justify-content-between">
                            <div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4">
                              <div>Deposit has updated to Paid</div>
                              <div class="text-muted font-weight-normal mt-1">32 Minutes Ago</div>
                            </div>
                            <div><h6 class="font-weight-bold text-danger ml-sm-2">$325</h6></div>
                          </div>
                          <div class="d-flex pb-3 pt-3 border-bottom justify-content-between">
                            <div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4">
                              <div>Your Withdrawal Proceeded</div>
                              <div class="text-muted font-weight-normal mt-1">45 Minutes Ago</div>
                            </div>
                            <div><h6 class="font-weight-bold text-danger ml-sm-2">$4987</h6></div>
                          </div>
                          <div class="d-flex pb-3 pt-3 border-bottom justify-content-between">
                            <div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4">
                              <div>Deposit has updated to Paid                              </div>
                              <div class="text-muted font-weight-normal mt-1">1 Days Ago</div>
                            </div>
                            <div><h6 class="font-weight-bold text-danger ml-sm-2">$5391</h6></div>
                          </div>
                          <div class="d-flex pt-3 justify-content-between">
                            <div class="mr-3"><i class="mdi mdi-signal-cellular-outline icon-md"></i></div>
                            <div class="font-weight-bold mr-sm-4">
                              <div>Deposit has updated to Paid</div>
                              <div class="text-muted font-weight-normal mt-1">3 weeks Ago</div>
                            </div>
                            <div><h6 class="font-weight-bold text-info ml-sm-2">$264</h6></div>
                          </div> 
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

  <script>
var MalexValues=@json($MaleMonth);
var MaleyValues=@json($Malecount);
var FemalexValues=@json($FemaleMonth);
var FemaleyValues=@json($Femalecount);
var MalefarmerxValues=@json($MalefarmerMonth);
var MalefarmeryValues=@json($Malefarmercount);
var FemalefarmerxValues=@json($FemalefarmerMonth);
var FemalefarmeryValues=@json($Femalefarmercount);
var ActivecoopxValues=@json($ActiveCoopMonth);
var ActivecoopyValues=@json($ActiveCoopCount);
var InactivecoopxValues=@json($InactiveCoopMonth);
var InactivecoopyValues=@json($InactiveCoopCount);


new Chart("MaleUsers", {
  type: "bar",
  data: {
    labels: MalexValues,
    datasets: [{
        label: 'Male Users',
        data: MaleyValues,
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

new Chart("FemaleUsers", {
  type: "bar",
  data: {
    labels: FemalexValues,
    datasets: [{
        label: 'Male Users',
        data: FemalexValues,
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

new Chart("ActiveCooperatives", {
  type: "bar",
  data: {
    labels: ActivecoopxValues,
    datasets: [{
        label: 'Male Users',
        data: ActivecoopyValues,
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
  
  <!-- base:js -->
  <script src="Customized/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="Customized/js/off-canvas.js"></script>
  <script src="Customized/js/hoverable-collapse.js"></script>
  <script src="Customized/js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="Customized/vendors/chart.js/Chart.min.js"></script>
  <script src="Customized/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="Customized/js/dashboard.js"></script>
  <!-- End custom js for this page-->

</body>

</html>

