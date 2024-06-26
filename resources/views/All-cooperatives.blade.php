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

  <link rel="stylesheet" href="Customized/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="Customized/vendors/feather/feather.css">
  <link rel="stylesheet" href="Customized/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="Customized/vendors/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="Customized/vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="Customized/vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="Customized/vendors/jquery-bar-rating/fontawesome-stars.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="Customized/css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.4.1/css/dataTables.dateTime.min.css">
<!--  End of DataTable CSS --> 
<!-- DataTable report Links -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"/>
<!-- End of DataTable report links -->
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href={{"Dashboard"}}>
            <img src="logo.png" alt="My Logo" class="full-height">
            <span class="logo-text">CCMS</span>
        </a>
        <a class="navbar-brand brand-logo-mini " href={{"Dashboard"}}>CCMS</a>
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
                  <i class="icon-inbox"></i>{{ __('msg.logout') }}
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
          @can('create-disease')
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
                    <a class="nav-link text-white hover-white" href="<?=url('realtimediseases');?>">
                      <span class="menu-title">Realtime Report</span>
                    </a>
                </li>
              </ul>
            </div>
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
              @can('create-cooperative')
              <li class="nav-item dropdown d-lg-flex d-none">
                <a href="<?=url('registerNewCooperative');?>"><button type="button" class="btn btn-info font-weight-bold" style="margin-right: 20px">+{{__('msg.new cooperative')}}</button></a>
              </li>
              @endcan
            </div>
          </div>

           <div class="row">     
           <div class="col-lg-12 grid-margin ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ __('msg.all cooperatives')}}</h4>
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
                    <table class="table table-striped" id="CooperativesTable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>{{ __('msg.cooperative name')}}</th>
                          <th>{{ __('msg.manager')}}</th>
                          <th>{{__('msg.email')}}</th>
                          <th>Status</th>
                          <th>created_at</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $i)
                          <tr>
                            <td>{{  ++$no }}</td>
                            <td>{{  $i->name }}</td>
                            <td>{{  $i->manager_name }}</td>
                            <td>{{  $i->email }}</td>
                            <td>
                            @if($i->status=="Operating")
                            <label class="bg-success text-white rounded p-1 d-flex align-items-stretch justify-content-stretch mt-1">{{ $i->status }}</label>
                            @else
                            <label class="bg-warning text-white rounded p-1 d-flex align-items-stretch justify-content-stretch mt-1">{{ $i->status }}</label>
                            @endif
                            </td>
                            <td>{{ $i->created_at->format('Y-m-d')}}</td>
                            <td>
                              <div class="input-group-prepend">
                                <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">action</button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href={{"updateCooperative/".$i->id}}><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; {{ __('msg.view')}}</a>
                          <a class="dropdown-item" href={{"deletecooperative/".$i->id}}><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; {{ __('msg.delete')}}</a>
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
        var date = new Date( data[5] );
 
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
    var table = $('#CooperativesTable').DataTable({
    dom: 'Bfrtip',
    buttons: [
        {
            extend: 'copy',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] // Include columns 1-5
            }
        },
        {
            extend: 'csv',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] // Include columns 1-5
            }
        },
        {
            extend: 'excel',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] // Include columns 1-5
            }
        },
        {
            extend: 'pdf',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] // Include columns 1-5
            }
        },
        {
            extend: 'print',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5] // Include columns 1-5
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
</body>
</html>

