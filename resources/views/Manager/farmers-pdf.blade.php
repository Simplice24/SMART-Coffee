
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<style>
    table {
      border-collapse: collapse;
      margin: 0 auto; /* centers the table horizontally */
    }
    th, td {
        border: none; /* removes all borders */
        padding: 8px;
        border-bottom: 1px solid black;
    }
    th {
      text-align: left;
    }
    tr:nth-child(even) {
  background-color: #f2f2f2;
    }

    tr:nth-child(odd) {
    background-color: #ffffff;
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
                  <h4 class="card-title">Farmers records</h4>
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
                            Names
                          </th>
                          <th>
                            Gender
                          </th>
                          <th>
                            ID No
                          </th>
                          <th>
                            No of trees
                          </th>
                          <th>
                            Fertilizer
                          </th>
                          <th>
                            Phone
                          </th>
                          <th>
                            Recorded 
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($farmers as $record)
                        <tr>
                          <td>
                            {{++$no}}
                          </td> 
                          <td>
                            {{$record['name']}}
                          </td>
                          <td>
                            {{$record['gender']}}
                          </td>
                          <td>
                            {{$record['idn']}} 
                          </td>
                          <td>
                            {{$record['number_of_trees']}}
                          </td>
                          <td>
                            {{$record['fertilizer']}}
                          </td>
                          <td>
                            {{$record['phone']}}
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

