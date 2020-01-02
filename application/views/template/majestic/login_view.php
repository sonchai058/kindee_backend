<!DOCTYPE html>
<html lang="th">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kindee | Inno Story</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{base_url}assets/themes/majestic/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{base_url}assets/themes/majestic/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css"> -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{base_url}assets/themes/majestic/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{base_url}assets/images/K-dot-5.png" />
  <link rel="icon" href="{base_url}assets/images/K-dot-5.png" type="image/png" sizes="16x16">
  <link rel="stylesheet" href="{base_url}assets/images/K-dot-5.png">


  <!-- Custom fonts for this template-->
  <link href="{base_url}assets/themes/sb-admin-bs4/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
 <!-- <link href="{base_url}assets/themes/sb-admin-bs4/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">-->
   <!-- Require -->
  <link href="{base_url}assets/bootstrap_extras/select2/select2.css" rel="stylesheet">
  <link href="{base_url}assets/css/jquery-ui.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
  <style type="text/css">
     *{font-family: 'Sarabun', sans-serif;} 
   /* .bg-warning {
        background-color: #9fec9e!important;
    }
    .info tr{
      background-color: #43DEB4 !important;
    }
    */
  </style>
  {another_css}
  
  <style>
  div[data-notify="container"]{
    z-index : 3000!important;
  }

  #exampleAccordion{
    overflow-y: auto;
    overflow-x: hidden;
  }

  .content-wrapper{
    overflow-x: auto;
  }

  .card .bg-primary .card-title {
    color: white;
  }

  div.alert span[data-notify="message"] p{
    margin-bottom: 0px !important;
  }

  .upload-box .btn-file {
          background-color: #22b5c0;
  }
  .upload-box .hold {
      float: left;
      width: 100%;
      position: relative;
      border: 1px solid #ccc;
      border-radius: 3px;
      padding: 4px;
  }
  .upload-box .hold span {
      font: 400 14px/36px 'Roboto',sans-serif;
      color: #666;
      text-decoration: none;
  }

  .upload-box .btn-file {
      position: relative;
      overflow: hidden;
      float: left;
      padding: 2px 10px;
      font: 900 14px/14px 'Roboto',sans-serif;
      color: #fff !important;
      margin: 0 10px 0 0;
      text-transform: uppercase;
      border-radius: 3px;
      cursor: pointer;
  }
  .upload-box .btn-file input[type=file] {
      position: absolute;
      top: 0;
      right: 0;
      min-width: 100%;
      min-height: 100%;
      font-size: 100px;
      text-align: right;
      opacity: 0;
      outline: none;
      background: #fd0707;
      cursor: inherit;
      display: block;
  }
  
  .div_file_preview {
    background-color: #fefcfc;
    border: 1px dashed #ccc;
  }
  
  .navbar-nav .nav-item .nav-link .badge{
    margin-left: -0.3rem; 
  }
  .nav-link i.fas.fa-user-circle.fa-fw{
    color: #fff;
  }
  .btn-warning {
    background-color: #E97A2E !important;
    color: #fff !important; 
  }
  </style>

  <script>
    var baseURL = '{base_url}';
    var siteURL = '{site_url}';
    var csrf_token_name = '{csrf_token_name}';
    var csrf_cookie_name = '{csrf_cookie_name}';

    function noimage(image) {
      image.onerror = "";
      image.src = baseURL+'assets/images/noimage.gif';
      return true;
    }

  </script>

</head>
<body id="page-top">
        
  {page_content}

  <!-- plugins:js -->
  <script src="{base_url}assets/themes/majestic/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- <script src="vendors/chart.js/Chart.min.js"></script> -->
  <!--
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  -->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
<!--  
  <script src="{base_url}assets/themes/majestic/js/off-canvas.js"></script>
  
  <script src="{base_url}assets/themes/majestic/js/hoverable-collapse.js"></script>
-->
  <script src="{base_url}assets/themes/majestic/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!--<script src="{base_url}assets/themes/majestic/js/dashboard.js"></script>-->
  <!--
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
-->
  <!-- End custom js for this page-->

    <!-- Bootstrap core JavaScript-->
    <script src="{base_url}assets/themes/sb-admin-bs4/vendor/jquery/jquery.min.js"></script>
    <script src="{base_url}assets/themes/sb-admin-bs4/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{base_url}assets/themes/sb-admin-bs4/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <!--
    <script src="{base_url}assets/themes/sb-admin-bs4/vendor/datatables/jquery.dataTables.js"></script>
    <script src="{base_url}assets/themes/sb-admin-bs4/vendor/datatables/dataTables.bootstrap4.js"></script>
    -->
    <!-- Custom scripts for all pages-->
     <script src="{base_url}assets/themes/sb-admin-bs4/js/sb-admin.min.js"></script> 

    <!-- Require -->
    <script src="{base_url}assets/js/jquery-ui.min.js"></script>
    <script src="{base_url}assets/bootstrap_extras/bootstrap-notify.min.js"></script>
    <script src="{base_url}assets/bootstrap_extras/select2/select2.min.js"></script>
    <script src="{base_url}assets/js/jquery.cookie.min.js"></script>
    <script src="{base_url}assets/js/ci_utilities.js?ver=1541805506"></script>

  <script src="{base_url}assets/js/member_reset_pass.js"></script>

  {another_js}

</body>

</html>

