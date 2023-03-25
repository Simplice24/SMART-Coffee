<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CCMS</title>
  <!-- base:css -->
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
  <!-- endinject -->
  <link rel="shortcut icon" href="Customized/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href={{"/"}}><i class="icon-air-play menu-icon"></i>CCMS</a>
        <a class="navbar-brand brand-logo-mini" href={{"/"}}>CCMS</a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-lg-flex d-none">
                <a href="<?=url('login');?>"><button type="button" class="btn btn-info font-weight-bold">{{ __('msg.login')}}</button></a>
            </li> 
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
        
      </div>
    </nav>


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

</body>
</html>