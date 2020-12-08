<?php
  $url_direct = $_GET['url_direct'];
  $file_name = $_GET['filename'];
 ?>
 <?php
      $_REQUEST['level'] = 'H';
      $_REQUEST['size'] = '5';
      $_REQUEST['data'] = $url_direct;
     //set it to writable location, a place for temp generated PNG files
     $PNG_TEMP_DIR = $_SERVER["DOCUMENT_ROOT"].'/kindee_backend/assets/images/qrcode_img/';
     //html PNG location prefix
     $PNG_WEB_DIR = '../../../assets/images/qrcode_img/';

     include "qrlib.php";
     //ofcourse we need rights to create temp dir
     if (!file_exists($PNG_TEMP_DIR))
         mkdir($PNG_TEMP_DIR);

     //processing form input
     //remember to sanitize user input in real-life solution !!!
     $errorCorrectionLevel = 'L';
     if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
         $errorCorrectionLevel = $_REQUEST['level'];

     $matrixPointSize = 4;
     if (isset($_REQUEST['size']))
         $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);


     if (isset($_REQUEST['data'])) {

         //it's very important!
         if (trim($_REQUEST['data']) == '')
             die('data cannot be empty! <a href="?">back</a>');

         // user data
         $filename =  $PNG_TEMP_DIR.$file_name.'.png';
         $filepath = $filename;
         QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);


         // Start DRAWING LOGO IN QRCODE
         // Image (logo) to be drawn
         $logopath = 'logo.jpg';
         $QR = imagecreatefrompng($filepath);

         // START TO DRAW THE IMAGE ON THE QR CODE
         $logo = imagecreatefromstring(file_get_contents($logopath));
         $QR_width = imagesx($QR);
         $QR_height = imagesy($QR);

         $logo_width = imagesx($logo);
         $logo_height = imagesy($logo);

         // Scale logo to fit in the QR Code
         $logo_qr_width = $QR_width/4;
         $scale = $logo_width/$logo_qr_width;
         $logo_qr_height = $logo_height/$scale;

         imagecopyresampled($QR, $logo, $QR_width/2.5, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

         // Save QR code again, but with logo on it
         imagepng($QR,$filepath);
         // outputs image directly into browser, as PNG stream
         // readfile($filepath);


     } else {

         //default data
         echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';
         QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);

     }

     //display generated file
     echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" width="200" />';
