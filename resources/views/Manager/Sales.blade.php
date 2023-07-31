
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
              <h4 class="font-weight-bold text-dark">Sales tracking</h4>
              <!-- <p class="font-weight-normal mb-2 text-muted">APRIL 1, 2019</p> -->
            </div>
          </div>

          <div class="row">

        <!-- Starting sales tracking  -->

        <div class="col-md-8 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sales recording</h4>
                  <form class="forms-sample" action="SalesRecording" method="POST">
                    @csrf
                  <div class="row">
                  <div class="col-md-6">
                  <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Customer</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="exampleInputUsername2" name="customer" placeholder="Customer name" required>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Product</label>
                      <div class="col-sm-8">
                        <select class="form-control" style="height:46px;" name="product" required>
                              <option disable selected>Select type of Coffee beans</option>
                                <option>Arabica beans</option>
                                <option>Robusta beans</option>
                              </select>
                      </div>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Quantity</label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control" id="exampleInputEmail2" name="quantity" placeholder="Quantity" required>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Price</label>
                      <div class="col-sm-8">
                        <input type="number" class="form-control" id="exampleInputUsername2" name="price" placeholder="Price" required>
                      </div>
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Payment method</label>
                      <div class="col-sm-8">
                      <select class="form-control" style="height:46px;" name="payment" required>
                              <option disable selected>Select Payment way</option>
                              <option>Cash</option>
                              <option>MoMo Pay</option>
                              <option>Airtel Money</option>
                      </select>
                      </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group row">
                      <label  class="col-sm-4 col-form-label">Year</label>
                      <div class="col-sm-8">
                      <input type="date" class="form-control" id="exampleInputEmail2" name="year" placeholder="Harvest year" required>
                      </div>
                    </div>
                    </div>
                    </div>
                     
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-success mr-2">Submit</button><hr>
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <!-- <button class="btn btn-light">Cancel</button> -->
                  </form>
                </div>
              </div>
            </div>

        <!-- ending sales tracking  -->

        <!-- start of Selling table -->

        

            <div class="col-xl-4 grid-margin ">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between mb-3">
                          <h4 class="card-title">Market Analysis</h4>
                          <!-- <div class="dropdown">
                              <button class="btn btn-sm dropdown-toggle text-dark pt-0 pr-0" type="button" id="dropdownMenuSizeButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  This week
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                <h6 class="dropdown-header">This week</h6>
                                <h6 class="dropdown-header">This month</h6>
                              </div>
                            </div> -->
                      </div>
                      <!-- <div class="row mt-2 mb-2">
                        <div class="col-6">
                          <div class="text-small"><span class="text-success">18.2%</span> higher </div>
                        </div>
                        <div class="col-6">
                          <div class="text-small"><span class="text-danger">0.7%</span> higher </div>
                        </div>
                      </div> -->
                      <!-- <div class="marketTrends mt-4">
                        <canvas id="marketTrendssatacked"></canvas>
                      </div> -->
                      <div class="row mt-2 mb-2">
                      <div class="col-6">
                        <h5><b>Arabica beans</b></h5>
                        <h5><b>{{$ArabicatotalRevenue}} Frw</b></h5>
                        <h6>Total revenue</h6>
                          <!-- <div class="text-small"><span class="text-success">18.2%</span> higher </div> -->
                      </div>
                      <div class="col-6">
                      <h5><b>Robusta beans</b></h5>                  
                      <h5><b>{{$RobustatotalRevenue}} Frw</b></h5>
                      <h6>Total revenue</h6>
                          <!-- <div class="text-small"><span class="text-success">18.2%</span> higher </div> -->
                      </div>
                      </div> 

              <div class="col-xl-12 grid-margin-lg-0 grid-margin ">
              <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-header-bg">
                        <thead>
                          <tr>
                            <th>
                                Coffee beans
                            </th>
                            <th>
                                Amount received
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            @foreach ($SalesByPayment as $payment)
                            <td>
                              {{$payment->payment}}
                            </td>
                            <td>
                              {{$payment->total_amount}}
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
              </div>


        </div>

        <div class="row">

        <!-- starting selling table -->

        <div class="col-lg-8 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Sales</h4>
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
                    <table class="table table-striped" id="SalesTable">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Customer
                          </th>
                          <th>
                            Coffee beans
                          </th>
                          <th>
                            Qty
                          </th>
                          <th>
                            Price
                          </th>
                          <th>
                            Payment way
                          </th>
                          <th>
                            Year
                          </th>
                          <th>
                            Recorded
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($CooperativeSales as $Cooperativesale)
                        <tr>
                          <td>
                            {{++$i}}
                          </td>
                          <td>
                            {{$Cooperativesale->customer}}
                          </td>
                          <td>
                          {{$Cooperativesale->product}}
                          </td>
                          <td>
                          {{$Cooperativesale->quantity}}
                          </td>
                          <td>
                          {{$Cooperativesale->price}}
                          </td>
                          <td>
                          {{$Cooperativesale->payment}}
                          </td>
                          <td>
                          {{$Cooperativesale->year}}
                          </td>
                          <td>
                          {{$Cooperativesale->created_at->format('Y-m-d')}}
                          </td>
                          <td>
                          <div class="input-group-prepend">
                          <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href={{"updateCooperativeSales/".$Cooperativesale->id}}><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Edit</a>
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

        <!-- ending selling table -->

        <div class="col-xl-4 grid-margin-lg-0 grid-margin ">
              <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Monthly top sellers</h4>
                    <div class="table-responsive mt-3">
                      <table class="table table-header-bg">
                        <thead>
                          <tr>
                            <th>
                                Coffee beans
                            </th>
                            <th>
                                Revenue
                            </th>
                            <th>
                                Vs Last Month
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            @foreach($revenueByCategory as $category)
                            <td>
                              {{$category->product}}
                            </td>
                            <td>
                              {{$category->current_month_revenue}}
                            </td>
          
                            @if($category->percentageIncrease>=0)
                            <td>
                              <div class="text-success"><i class="icon-arrow-up mr-2"></i>{{$category->percentageIncrease}}%</div>
                            </td>
                            @else
                            <td>
                              <div class="text-danger"><i class="icon-arrow-down mr-2"></i>{{$category->percentageIncrease}}%</div>
                            </td>
                            @endif
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
        var date = new Date( data[7] );
 
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
    var table = $('#SalesTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'copy',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7] // Include columns 1-5
            }
        },
        {
            extend: 'csv',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7] // Include columns 1-5
            }
        },
        {
            extend: 'excel',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7] // Include columns 1-5
            }
        },
        {
            extend: 'pdf',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7] // Include columns 1-5
            }
        },
        {
            extend: 'print',
            exportOptions: {
                columns: [0, 1, 2, 3, 4, 5, 6, 7] // Include columns 1-5
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

