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
    <link href="{base_url}assets/themes/sb-admin-bs4/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Require -->
    <link href="{base_url}assets/bootstrap_extras/select2/select2.css" rel="stylesheet">
    <link href="{base_url}assets/css/jquery-ui.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style type="text/css">
        * {
            font-family: 'Sarabun', sans-serif;
        }

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
        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            /* display: flex; */
            padding: 5px 5px 0px 5px;
            position: relative;
            overflow: auto;
        }

        .preview-images-zone>.preview-image:first-child {
            width: 200px;
            height: 200px;
            position: relative;
            margin-right: 5px;
        }

        .preview-images-zone>.preview-image {
            width: 200px;
            height: 200px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }

        .preview-images-zone>.preview-image>.image-zone {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone>.preview-image>.image-zone>img {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone>.preview-image>.tools-edit-image {
            position: absolute;
            z-index: 100;
            color: #fff;
            bottom: 0;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
            display: none;
        }

        .preview-images-zone>.preview-image>.image-cancel {
            font-size: 18px;
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
            display: none;
            z-index: 100;
        }

        .preview-image:hover>.image-zone {
            cursor: move;
            opacity: .5;
        }

        .preview-image:hover>.tools-edit-image,
        .preview-image:hover>.image-cancel {
            display: block;
        }

        .ui-sortable-helper {
            width: 90px !important;
            height: 90px !important;
        }

        .info_user tbody th,
        .info_user tbody td {
            padding: 10px;
            font-size: 14px;
            border: 1px #999 solid;
        }

        form label {
            font-size: 14px !important;
            color: #555556 !important;
            font-weight: bold;
            letter-spacing: .2px;
        }

        .chk {
            font-size: 14px !important;
            font-weight: normal !important;
            margin-left: 3px;
        }
    </style>

    <style>
        div[data-notify="container"] {
            z-index: 3000 !important;
        }

        input,
        textarea {
            //border: 1px #dee2e2 solid !important;
        }

        input:hover,
        textarea:hover {
            //border: 1px #26a9f8 solid !important;
        }

        #exampleAccordion {
            overflow-y: auto;
            overflow-x: hidden;
        }

        .content-wrapper {
            overflow-x: auto;
        }

        .card .bg-primary .card-title {
            color: white;
        }

        div.alert span[data-notify="message"] p {
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
            font: 400 14px/36px 'Roboto', sans-serif;
            color: #666;
            text-decoration: none;
        }

        .upload-box .btn-file {
            position: relative;
            overflow: hidden;
            float: left;
            padding: 2px 10px;
            font: 900 14px/14px 'Roboto', sans-serif;
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

        .navbar-nav .nav-item .nav-link .badge {
            margin-left: -0.3rem;
        }

        .nav-link i.fas.fa-user-circle.fa-fw {
            color: #fff;
        }

        .info tr {
            background-color: #3589fd !important;
            color: #fff !important;
        }

        .info tr td {
            font-size: 13px;
        }

        .info tr th {
            font-size: 13px;
            font-weight: bold;
        }

        .table td {
            font-size: 13px;
        }

        .btn-warning {
            background-color: #E97A2E !important;
            color: #fff !important;
            border: 0 !important;
        }

        .badge.badge-info,
        .badge.badge-default {
            background-color: #fff !important;
            color: #333 !important;
            font-weight: bold !important;
            font-size: 14px !important;
            padding: 0 !important;
        }

        .dataTables_info {
            padding: 4px;
        }

        form[name='formSearch'] .btn,
        .btn-del {
            padding: 15px !important;
        }

        .info {
            text-align: center !important;
        }

        tbody tr td {
            text-align: center !important;
            letter-spacing: .2px;
        }

        .btn-file {
            background-color: #E97A2E !important;
            color: #fff !important;
            padding-top: 5px !important;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container>a.select2-choice {
            line-height: 45px !important;
            height: 45px !important;
        }

        input[type='checkbox'].form-control {
            margin-top: -25px !important;
            width: 20px !important;
            height: 20px !important;
            margin-right: 15px !important;
            margin-bottom: 10px;
        }

        table.preview tbody tr td:nth-child(2) {
            text-align: left !important;
        }

        #imagemodal .modal-header {
            border: 0 !important;
        }

        #imagemodal .modal-body {
            padding-bottom: 50px;
        }

        a.file_link img,
        .div_file_preview img {
            margin-top: 3px;
            //max-width: 255px !important;
            //height: 200px !important;

            height: 30px !important;
            width: 30px !important;
            position: absolute;
            right: 18px;
            top: 38px;

        }

        .formPro input[type='checkbox'] {
            //margin-bottom: 5px !important;
        }

        .formPro input[type='number'] {
            padding: 10px !important;
            margin-bottom: 10px !important;
        }

        .formPro input[type='number']:focus,
        input:focus,
        textarea:focus,
        select:focus {
            border: .5px #7caff8 solid !important;
        }

        input[type='number']:focus,
        input:focus,
        textarea:focus,
        select:focus {
            border: .5px #7caff8 solid !important;
        }

        input,
        textarea {
            border: .5px #eee solid !important;
        }

        .card.col-sm-3 {
            border: 0px;
            margin-bottom: 5px;
        }
    </style>

    <script>
        var baseURL = '{base_url}/';
        var siteURL = '{site_url}/';
        var csrf_token_name = '{csrf_token_name}';
        var csrf_cookie_name = '{csrf_cookie_name}';

        function noimage(image) {
            image.onerror = "";
            image.src = baseURL + 'assets/images/noimage.gif';
            return true;
        }
    </script>

</head>

<body id="page-top">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
                <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                    <a class="navbar-brand brand-logo" href="{site_url}">
                        <img src="{base_url}assets/images/info.kindee.kindee.png" alt="logo" style="width:30px">
                        <span>Inno | Story</span>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{site_url}">
                        <img src="{base_url}assets/images/info.kindee.kindee.png" alt="logo" />
                    </a>
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-sort-variant"></span>
                    </button>
                </div>
            </div>

            {top_navbar}

        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->

            <!-- Sidebar -->
            {left_sidebar}
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    {breadcrumb_list}
                    <!--
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>Welcome back,</h2>
                    <p class="mb-md-0">Your analytics dashboard template.</p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor">Analytics</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  &nbsp;
                </div>
              </div>
            </div>
          </div>
        -->

                    {page_content}


                </div>

                <!--
    <!-- Scroll to Top Button-->
                <!--
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

        <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->

                <!-- partial -->
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://www.urbanui.com/" target="_blank">Jigsaw Innovation</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Power by Jigsaw Innovation <i class="mdi mdi-heart text-danger"></i></span>
        </div>
    </footer>

    <!-- container-scroller -->

    <!-- plugins:js -->
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
    <script src="{base_url}assets/themes/majestic/vendors/base/vendor.bundle.base.js"></script>
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
    <script src="{base_url}assets/themes/sb-admin-bs4/vendor/datatables/jquery.dataTables.js"></script>
    <script src="{base_url}assets/themes/sb-admin-bs4/vendor/datatables/dataTables.bootstrap4.js"></script>

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

    <?php
    if ($this->session->userdata('user_level') == 'super_user' ||$this->session->userdata('user_level')=='nutritionist') {
    ?>
        <script>
            $(document).ready(function() {
                setDropdownList('#user_select');
            });

            $('#user_select').change(function() {
                var fdata = 'user_id=' + $(this).val();
                fdata += '&' + csrf_token_name + '=' + $.cookie(csrf_cookie_name);
                if ($(this).val() != null) {
                    $.ajax({
                        method: 'POST',
                        url: site_url('dashboard_res/user_select'),
                        dataType: 'json',
                        data: fdata,
                        success: function(results) {
                            console.log(results);
                            if (results.is_successful) {
                                alert_type = 'success';
                            } else {
                                alert_type = 'danger';
                            }
                            notify('เลือก', results.message, alert_type, 'center');
                            //loading_on_remove(obj);

                            if (results.is_successful) {
                                location.reload();
                            }
                        },
                        error: function(jqXHR, exception) {
                            ajaxErrorMessage(jqXHR, exception);
                            //loading_on_remove(obj);
                        }
                    });
                }
            });
        </script>
    <?php
    }
    ?>

    <script>
        $(function() {
            $("body").find('input').attr('autocomplete', 'off');
        });
    </script>

</body>

</html>
