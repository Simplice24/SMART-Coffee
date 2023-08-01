<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CCMS</title>
  <!-- base:css -->
  <link rel="stylesheet" href="/Customized/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/Customized/vendors/feather/feather.css">
  <link rel="stylesheet" href="/Customized/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

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
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
              <span class="menu-title">Stock</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=url('CooperativeSales');?>">
              <i class="mdi mdi-chart-line menu-icon"></i>
              <span class="menu-title">Sales tracking</span>
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
            <li class="nav-item dropdown d-lg-flex d-none">
            @can('register-disease')<a href="<?=url('registerNewDisease');?>"><button type="button" class="btn btn-info font-weight-bold">+ {{__('msg.new disease')}}</button></a>@endcan
            </li>
            </div>
          </div>
          
           <div class="row">

           <!-- Popup card -->
          <div id="popupCard" class="popup-card container card shadow">
            <!-- Select dropdown list -->
            <div class="row">
              <div class="col-md-6">
              <form id="predictForm" action="{{ url('/predict') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                      <label for="modelSelect">{{ __('msg.Select model') }}:</label>
                      <select class="form-control custom-select" id="modelSelect" name="selected_model">
                          <option value="" disabled selected>{{ __('msg.Select ml model to use') }}</option>
                          <option value="inception_v3">INCEPTION_V3</option>
                          <option value="resnet">RESNET</option>
                          <option value="vgg16">VGG16</option>
                          <option value="xception">XCEPTION</option>
                      </select>
                  </div>
                  <p id="diseaseName">{{ __('msg.Disease') }}:</p>
                  <p id="predictionConfidence">{{ __('msg.Confident') }}:</p>
                  <p id="imagePath" style="display: none;">Image Path:</p>

                  <div class="popup-card-buttons">
                      <input type="file" id="imageInput" style="display: none;" accept="image/*" name="image_file">
                      <button type="button" class="btn btn-block btn-success" onclick="document.getElementById('imageInput').click()">{{ __('msg.Browse')}}</button>
                      <button type="submit" class="btn btn-success" id="predictButton" style="display: none;">{{ __('msg.Predict')}}</button>
                      <button type="button" class="btn btn-danger" id="reportButton" style="display: none;" 
                      onclick="reportPrediction()" data-predicted-class="" data-confidence="">{{ __('msg.Report')}}</button>
                      <div id="loadingIndicator" style="display: none;">{{ __('Loading...')}}</div>
                  </div>
              </form>

              </div>
              <div class="col-md-6">
                <div id="imagePreview" style="display: none;">
                  <img id="uploadedImage" class="img-fluid" alt="Uploaded Image">
                </div>
              </div>
            </div>

          </div>
             
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  @if(session('success'))
                    <div class="alert alert-success" id="successMessage">
                        {{ session('success') }}
                    </div>
                  @endif
                  <button type="button" class="btn btn-info font-weight-bold mb-3" onclick="showPopupCard()">{{ __('msg.Browse an image')}}</button>
                  <h4 class="card-title">{{__('msg.coffee diseases')}}</h4>
                  <div class="table-responsive">
                    <table class="table table-striped" id="Diseases">
                      <thead>
                        <tr>
                          <th>
                            {{__('msg.Disease name')}}
                          </th>
                          <th>
                            {{__('msg.Disease category')}}
                          </th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        @foreach($disease as $i)
                          <td>
                            {{$i->disease_name}}
                          </td>
                          <td>
                            {{$i->category}}
                          </td>
                          <td>
                          <div class="input-group-prepend">
                          <button class="btn btn-sm btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">action</button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" href={{"CooperativeDiseaseDetails/".$i->id}}><i class="fa fa-eye" aria-hidden="true"></i>&nbsp; {{__('msg.view')}}</a>
                          @can('delete-disease')<a class="dropdown-item" href={{"deletedisease/".$i->id}}><i class="fa fa-trash" aria-hidden="true"></i>&nbsp; {{ __('msg.delete')}}</a>@endcan
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
  <script src="//Customized/js/dashboard.js"></script>
  <!-- End custom js for this page-->
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready(function() {
    $('#Diseases').DataTable({
      "paging": true,
      "ordering": false,
      "searching": true
    });
  });
</script>
<script>
    var reportingConfidence = '{{ $reportingConfidence }}'
    // Function to update the disease name, prediction confidence, image path, and selected model
    function updatePredictionData(predictedClass, confidence, imagePath, selectedModel, reportingConfidence) {
        if (confidence >= reportingConfidence) {
        document.getElementById('diseaseName').innerText = '{{ __('msg.Disease')}}: ' + predictedClass;
        } else {
        document.getElementById('diseaseName').innerText = '{{ __('msg.Disease')}}: ' + 'Unknown';
        }
        document.getElementById('predictionConfidence').innerText = '{{ __('msg.Confident')}}: ' + confidence.toFixed(5);
        document.getElementById('imagePath').innerText = 'Image Path: ' + imagePath;
        

        // Show the report button if the predicted disease is not "Healthy"
        var reportButton = document.getElementById('reportButton');
        if (predictedClass !== 'Healthy' && confidence >= reportingConfidence) {
            reportButton.style.display = 'block';
            reportButton.dataset.predictedClass = predictedClass; // Set the data attribute for predicted class
            reportButton.dataset.confidence = confidence.toFixed(5);
            reportButton.dataset.imagePath = imagePath; // Set the data attribute for confidence
        } else {
            reportButton.style.display = 'none';
        }
    }

    // Function to handle the report button click
    function reportPrediction() {
    var predictedClass = document.getElementById('reportButton').dataset.predictedClass;
    var confidence = document.getElementById('reportButton').dataset.confidence;
    var imagePath = document.getElementById('reportButton').dataset.imagePath;

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
        var latitude = position.coords.latitude.toFixed(15);
        var longitude = position.coords.longitude.toFixed(15);
        var url = "/report?predictedClass=" + predictedClass + "&confidence=" + confidence + "&latitude=" + latitude + "&longitude=" + longitude + "&imagePath=" + imagePath;
        window.location.href = url;
      });
    } else {
      alert("Geolocation is not supported by this browser.");
    }
  }



    // Function to show the loading indicator
    function showLoadingIndicator() {
        document.getElementById('loadingIndicator').style.display = 'block';
    }

    // Function to hide the loading indicator
    function hideLoadingIndicator() {
        document.getElementById('loadingIndicator').style.display = 'none';
    }

    // Event listener for the form submission
    document.getElementById('predictForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        var form = event.target;
        var formData = new FormData(form);

        // Show the loading indicator
        showLoadingIndicator();

        // Disable the predict button
        document.getElementById('predictButton').disabled = true;

        // Perform the form submission using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open(form.method, form.action);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                // Hide the loading indicator
                hideLoadingIndicator();

                // Enable the predict button
                document.getElementById('predictButton').disabled = false;

                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    updatePredictionData(
                        response.predicted_class,
                        response.confidence,
                        response.image_path,
                        response.selected_model,
                        response.reportingConfidence
                    ); // Update the prediction data in the form
                } else {
                    // Handle the error case
                }
            }
        };
        xhr.send(formData);
    });
</script>


<script>
  // Function to show the popup card
  function showPopupCard() {
    var popupCard = document.getElementById("popupCard");
    popupCard.style.display = "block";
  }

  // Function to handle the browse button click
  function browseImage() {
    // Add your code here to handle the browse button click
    console.log("Browse button clicked");
  }

  // Function to handle the predict button click
  function predictImage() {
    // Add your code here to handle the predict button click
    console.log("Predict button clicked");

    // Display the report button
    var reportButton = document.getElementById("reportButton");
    reportButton.style.display = "block";
  }

  // Function to handle the report button click
  function reportImage() {
    // Add your code here to handle the report button click
    console.log("Report button clicked");
  }

  function handleImageUpload(event) {
    var uploadedImage = document.getElementById("uploadedImage");
    var imagePreview = document.getElementById("imagePreview");
    var predictButton = document.getElementById("predictButton");

    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
      uploadedImage.src = e.target.result;
      imagePreview.style.display = "block";
      predictButton.style.display = "block";
    };
    reader.readAsDataURL(file);
  }

  // Attach the event listener to the file input element
  document.getElementById("imageInput").addEventListener("change", handleImageUpload);

  // Hide the report button initially
  var reportButton = document.getElementById("reportButton");
  reportButton.style.display = "none";
</script>
<script>
    // Wait for the document to be fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        // Get the success message element
        const successMessage = document.getElementById('successMessage');

        // Check if the element exists and if it has the "alert" class
        if (successMessage && successMessage.classList.contains('alert')) {
            // Set a timeout to hide the element after 5000ms (5 seconds)
            setTimeout(function() {
                // Hide the element by adding the "d-none" class
                successMessage.classList.add('d-none');
            }, 3000);
        }
    });
</script>
</body>
</html>

