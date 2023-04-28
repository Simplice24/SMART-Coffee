
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<style>

.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #666666;
}

.table th,
.table td {
  padding: 1rem 1rem;
  vertical-align: top;
  border-top: 1px solid #e4e6f6;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #e4e6f6;
}

.table tbody + tbody {
  border-top: 2px solid #e4e6f6;
}

.table-sm th,
.table-sm td {
  padding: 0.3rem;
}

.table-bordered {
  border: 1px solid #e4e6f6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #e4e6f6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}

.table-borderless th,
.table-borderless td,
.table-borderless thead th,
.table-borderless tbody + tbody {
  border: 0;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: #f4f7fa;
}

.table-hover tbody tr:hover {
  color: #212529;
  background-color: #eaeaf1;
}

.table-primary,
.table-primary > th,
.table-primary > td {
  background-color: #fac7fe;
}

.table-primary th,
.table-primary td,
.table-primary thead th,
.table-primary tbody + tbody {
  border-color: #f597fd;
}

.table-hover .table-primary:hover {
  background-color: #8EDC6D;
}

.table-hover .table-primary:hover > td,
.table-hover .table-primary:hover > th {
  background-color: #8EDC6D;
}

.table-secondary,
.table-secondary > th,
.table-secondary > td {
  background-color: #f7f8fc;
}

.table-secondary th,
.table-secondary td,
.table-secondary thead th,
.table-secondary tbody + tbody {
  border-color: #f1f2fa;
}

.table-hover .table-secondary:hover {
  background-color: #e4e8f5;
}

.table-hover .table-secondary:hover > td,
.table-hover .table-secondary:hover > th {
  background-color: #e4e8f5;
}

.table-success,
.table-success > th,
.table-success > td {
  background-color: #cef0bf;
}

.table-success th,
.table-success td,
.table-success thead th,
.table-success tbody + tbody {
  border-color: #a5e289;
}

.table-hover .table-success:hover {
  background-color: #beebaa;
}

.table-hover .table-success:hover > td,
.table-hover .table-success:hover > th {
  background-color: #beebaa;
}

.table-info,
.table-info > th,
.table-info > td {
  background-color: #c7e1fe;
}

.table-info th,
.table-info td,
.table-info thead th,
.table-info tbody + tbody {
  border-color: #97c7fd;
}

.table-hover .table-info:hover {
  background-color: #aed4fe;
}

.table-hover .table-info:hover > td,
.table-hover .table-info:hover > th {
  background-color: #aed4fe;
}

.table-warning,
.table-warning > th,
.table-warning > td {
  background-color: #feeac0;
}

.table-warning th,
.table-warning td,
.table-warning thead th,
.table-warning tbody + tbody {
  border-color: #fdd889;
}

.table-hover .table-warning:hover {
  background-color: #fee2a7;
}

.table-hover .table-warning:hover > td,
.table-hover .table-warning:hover > th {
  background-color: #fee2a7;
}

.table-danger,
.table-danger > th,
.table-danger > td {
  background-color: #fec7c0;
}

.table-danger th,
.table-danger td,
.table-danger thead th,
.table-danger tbody + tbody {
  border-color: #fd9889;
}

.table-hover .table-danger:hover {
  background-color: #feb1a7;
}

.table-hover .table-danger:hover > td,
.table-hover .table-danger:hover > th {
  background-color: #feb1a7;
}

.table-light,
.table-light > th,
.table-light > td {
  background-color: #f6f8fb;
}

.table-light th,
.table-light td,
.table-light thead th,
.table-light tbody + tbody {
  border-color: #eef1f7;
}

.table-hover .table-light:hover {
  background-color: #e4eaf3;
}

.table-hover .table-light:hover > td,
.table-hover .table-light:hover > th {
  background-color: #e4eaf3;
}

.table-dark,
.table-dark > th,
.table-dark > td {
  background-color: #b8bec7;
}

.table-dark th,
.table-dark td,
.table-dark thead th,
.table-dark tbody + tbody {
  border-color: #7a8697;
}

.table-hover .table-dark:hover {
  background-color: #aab1bc;
}

.table-hover .table-dark:hover > td,
.table-hover .table-dark:hover > th {
  background-color: #aab1bc;
}

.table-active,
.table-active > th,
.table-active > td {
  background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover {
  background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover > td,
.table-hover .table-active:hover > th {
  background-color: rgba(0, 0, 0, 0.075);
}

.table .thead-dark th {
  color: #fff;
  background-color: #343a40;
  border-color: #454d55;
}

.table .thead-light th {
  color: #495057;
  background-color: #e9ecef;
  border-color: #e4e6f6;
}

.table-dark {
  color: #fff;
  background-color: #343a40;
}

.table-dark th,
.table-dark td,
.table-dark thead th {
  border-color: #454d55;
}

.table-dark.table-bordered {
  border: 0;
}

.table-dark.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(255, 255, 255, 0.05);
}

.table-dark.table-hover tbody tr:hover {
  color: #fff;
  background-color: rgba(255, 255, 255, 0.075);
}

.table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

.table-responsive > .table-bordered {
  border: 0;
}

</style> 
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper">
      <div class="main-panel">
        <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Stock records</h4>
                  <p class="card-description">
                    From: <b>{{$start}}</b>
                  </p>
                  <p class="card-description">
                    To: <b>{{$end}}</b>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped" id="records">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            Coffee beans
                          </th>
                          <th>
                            Quantity
                          </th>
                          <th>
                            Season
                          </th>
                          <th>
                            Year
                          </th>
                          <th>
                            Recorded 
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($stocks as $record)
                        <tr>
                          <td>
                            {{++$no}}
                          </td> 
                          <td>
                            {{$record['product']}}
                          </td>
                          <td>
                            {{$record['quantity']}} Kgs
                          </td>
                          <td>
                            {{$record['season']}} 
                          </td>
                          <td>
                            {{$record['year']}}
                          </td>
                          <td>
                            {{$record['created_at']}}
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
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        
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
</body>
</html>

