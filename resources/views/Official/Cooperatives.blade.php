
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
          <li class="nav-item">
            <a class="nav-link" href="<?=url('Official/Analytics');?>">
              <i class="icon-bar-graph-2 menu-icon"></i>
              <span class="menu-title">{{ __('msg.Analytics')}}</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="row">
             
           <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('msg.Cooperatives') }}</h4>
                  <div class="table-responsive">
                  <table class="table table-striped" id="CooperativesTable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>{{__('msg.Name')}}</th>
                          <th>{{ __('msg.Manager')}}</th>
                          <th>{{__('msg.Status')}}</th>
                          <th>{{ __('msg.Email')}}</th>
                          <th>{{ __('msg.Started')}}</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($cooperatives as $cooperative)
                          <tr>
                            <td>{{++$no}}</td>
                            <td>{{$cooperative->name}}</td>
                            <td>{{$cooperative->manager_name}}</td>
                            <td>
                            @if($cooperative->status=="Operating")
                            <label class="bg-success text-white rounded p-1 d-flex align-items-stretch justify-content-stretch mt-1">{{ $cooperative->status }}</label>
                            @else
                            <label class="bg-warning text-white rounded p-1 d-flex align-items-stretch justify-content-stretch mt-1">{{ $cooperative->status }}</label>
                            @endif
                            </td>
                            <td>{{$cooperative->email}}</td>
                            <td>{{$cooperative->starting_date}}</td>
                            <td>
                              <div class="input-group-prepend">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">action</button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href=""><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; {{__('msg.view')}}</a>
                                </div>
                              </div> <!-- add this closing tag -->
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
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
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function() {
    $('#CooperativesTable').DataTable({
      "paging": true,
      "ordering": false,
      "searching": true
    });
  });
</script>
</body>
</html>

