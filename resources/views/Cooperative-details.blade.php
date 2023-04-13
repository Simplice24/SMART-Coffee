<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CCMS</title>
  <!-- base:css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="/Customized/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/Customized/vendors/feather/feather.css">
  <link rel="stylesheet" href="/Customized/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
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
        <a class="navbar-brand brand-logo" href={{"Home"}}>CCMS</a>
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
            <a class="nav-link" href="<?=url('Home') ;?>">
              <i class="icon-air-play menu-icon"></i>
              <span class="menu-title">{{ __('msg.dashboard') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('viewsystemuser');?>">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">{{ __('msg.system users') }}</span>
            </a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="<?=url('viewcooperatives');?>">
              <i class="icon-disc menu-icon"></i>
              <span class="menu-title">{{ __('msg.cooperatives') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('viewfarmers');?>">
              <i class="icon-pie-graph menu-icon"></i>
              <span class="menu-title">{{ __('msg.farmers') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('viewdiseases');?>">
              <i class="icon-command menu-icon"></i>
              <span class="menu-title">{{ __('msg.diseases') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('analytics');?>">
              <i class="icon-bar-graph-2 menu-icon"></i>
              <span class="menu-title">Analytics</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-share menu-icon"></i>
              <span class="menu-title">Roles | Permissions</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?=url('Allroles')?>"> Roles </a></li>
                <li class="nav-item"> <a class="nav-link" href="<?=url('Allpermissions')?>"> Permissions </a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
           <div class="row">
           <div class="container">
           <div class="main-body">
          <div class="row gutters-sm">
          <div class="col-xl-5 grid-margin-lg-0 grid-margin">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Cooperative ratings</h4>
                    <div class="d-flex">
                      <div>
                          <h4 class="text-dark font-weight-bold mb-2 mr-2">{{$cooperative_farmers}} Farmers</h4>
                      </div>
                    </div>
                    <p class="mb-2 mt-3 mb-3 text-dark font-weight-bold">Gender</p>
                    <div class="row">
                      <div class="col-sm-2 pr-0">
                          <div class="d-flex">
                            <div>
                                <div class="text-dark font-weight-bold mb-2 mr-2">Male</div>
                            </div>
                          </div>
                      </div>
                      <div class="col-sm-9 pl-2">
                          <div class="row">
                            <div class="col-sm-10">
                              <div class="progress progress-lg mt-1">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{$malePercentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-sm-2 p-lg-0">
                              {{$malePercentage}}%
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-sm-2 pr-0">
                          <div class="d-flex">
                            <div>
                                <div class="text-dark font-weight-bold mb-2 mr-2">Female</div>
                            </div>
                          </div>
                      </div>
                      <div class="col-sm-9 pl-2">
                          <div class="row">
                            <div class="col-sm-10">
                              <div class="progress progress-lg mt-1">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{$femalePercentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-sm-2 p-lg-0">
                              {{$femalePercentage}}%
                            </div>
                          </div>
                      </div>
                    </div>
                    <p class="mb-2 mt-3 mb-3 text-dark font-weight-bold">Coffee beans in stock</p>
                    @foreach ($percentages_by_category as $category => $percentage)
                    <div class="row mt-2">
                      <div class="col-sm-2 pr-0">
                          <div class="d-flex">
                            <div>
                                <div class="text-dark font-weight-bold mb-2 mr-2">{{$category}}</div>
                            </div>
                          </div>
                      </div>
                      <div class="col-sm-9 pl-2">
                          <div class="row">
                            <div class="col-sm-10">
                              <div class="progress progress-lg mt-1">
                                <div class="progress-bar bg-warning" role="progressbar" style="width:{{$percentage}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                            <div class="col-sm-2 p-lg-0">
                              {{$percentage}}%
                            </div>
                          </div>
                      </div>
                    </div>
                    @endforeach
                </div>
                <!-- Chart of diseases reported by Single cooperative -->
                <div class="card-body">
                      <div class="d-flex justify-content-between mb-3">
                          <h4 class="card-title">Disease reported</h4>
                      </div>
                      <div class="marketTrends mt-4">
                        <canvas id="Diseasereported"></canvas>
                      </div>
                    </div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.cooperative name')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                      {{$cooperativeinfo->name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.manager')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->manager_name}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.email')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->email}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.status')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->status}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.starting date')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->starting_date}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.Registration date')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->created_at}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.Province')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->province}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.district')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->district}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.sector')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->sector}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">{{__('msg.cell')}}</h6>
                    </div>
                    <div class="col-sm-9 text-dark">
                    {{$cooperativeinfo->cell}}
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-success" href={{"CooperativeUpdate/".$cooperativeinfo->id}}><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;{{__('msg.edit')}}</a>
                    </div>
                  </div>
      
                </div>
              </div>
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
  <script>
  new Chart("Diseasereported", {
  type: "bar",
  data: {
            labels: ['Jan','Feb','Mar','Apr','May'],
            datasets: [
                {
                    label: 'Data Set 1',
                    data: [1,2,3,4,5],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Data Set 2',
                    data: [2,3,4,5,6],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Data Set 3',
                    data: [4,5,6,7,8],
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }
            ]
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

