<?php
// require_once('sess_auth.php');

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $_settings->info('systitle') ?></title>
  <link rel="icon" href="<?= validate_image($_settings->info('logo')) ?>" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Add other stylesheets as needed -->

  <!-- External CSS Files -->
  <link rel="stylesheet" href="<?= base_url ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css">

  <!-- External Scripts -->
  <script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?= base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url ?>plugins/toastr/toastr.min.js"></script>
  <script src="<?= base_url ?>dist/js/script.js"></script>
  <script src="<?= base_url ?>assets/js/scripts.js"></script>

  <script>
    var _base_url_ = '<?= base_url ?>';
  </script>
  <style type="text/css">
    /* Firefox */
    * {
      scrollbar-width: thin;
      scrollbar-color: #004399 #DFE9EB;
    }

    /* Chrome, Edge and Safari */
    *::-webkit-scrollbar {
      height: 5px;
      width: 5px;
    }

    *::-webkit-scrollbar-track {
      border-radius: 5px;
      background-color: #DFE9EB;
    }

    *::-webkit-scrollbar-track:hover {
      background-color: #B8C0C2;
    }

    *::-webkit-scrollbar-track:active {
      background-color: #B8C0C2;
    }

    *::-webkit-scrollbar-thumb {
      border-radius: 2px;
      background-color: #004399;
    }

    *::-webkit-scrollbar-thumb:hover {
      background-color: #005BD0;
    }

    *::-webkit-scrollbar-thumb:active {
      background-color: #003578;
    }

    /* Chart.js */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0
    }
  </style>

  <!-- jQuery -->
  <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
  <script>
    var _base_url_ = '<?php echo base_url ?>';
  </script>
  <script src="<?php echo base_url ?>dist/js/script.js"></script>
  <script src="<?php echo base_url ?>assets/js/scripts.js"></script>
  <style>
  

    html
    body {
      height: 80%;
      width: 100%;
      font-family: 'Poppins', sans-serif;
      text-decoration: none;
     
      overflow-x: hidden;
      margin: 0;
      font-weight: 600;
    }

    #main-header {
      position: relative;
      background: rgb(0, 0, 0) !important;
      background: none !important;
      height: 30vh;
      /* Set the height of the header */
    }

    #main-header:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 30vh; /* You can adjust this as needed */
    max-height: 600px; /* Set a maximum height for smaller screens */
    background-image: url(<?php echo base_url . $_settings->info('cover') ?>);
    background-repeat: no-repeat;
    background-position: center; /* Center the background image */
    background-size: cover;
    filter: drop-shadow(0 0 49px 0 #879090); /* Fix typo: 49px instead of 49x */
    z-index: -1;
}
  </style>
</head>