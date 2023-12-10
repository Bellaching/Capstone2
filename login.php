<?php require_once('./config.php');  ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php');  ?>
<head>
<!-- Montserrat Font (800 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap">

<!-- Julius Sans One Font -->
<link href="https://fonts.googleapis.com/css2?family=Julius+Sans+One&display=swap" rel="stylesheet">

<!-- Montserrat Font (800 weight) and Poppins Font (200 weight) -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Poppins:wght@200;200&display=swap">
<link rel="stylesheet" href="./css/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SYF8M9+8APB7D1D2tLXrp5t5+kjBd5p8JwY8fF" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SYF8M9+8APB7D1D2tLXrp5t5+kjBd5p8JwY8fF" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
  <script>
    start_loader();
  </script>

  <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
  <?php if ($_settings->chk_flashdata('success')) : ?>
    <script>
      alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
  <?php endif; ?>

  <div class="login-container">
    <div class="left-login">
      <h1>FIND YOUR PERFECT FIT</h1>

      <form id="clogin-frm" action="" method="post">
        <div class="login-textfield-container">

        <?php if (isset($resp['msg']) && !empty($resp['msg'])) : ?>
        <div class="error-message">
          <?php echo $resp['msg']; ?>
        </div>
      <?php endif; ?>
          

          <div class="text-field-login">
            <div class="input-area">
              <label class="label" for="email">Email</label>
              <input type="email" name="email" autofocus placeholder="Enter your email" required>
            </div>
          </div>

          <div class="text-field-login label-password-login">
            <div class="input-area">
              <label class="label" for="password">Password</label>
              <input type="password" name="password" placeholder="Enter your password" required>
            </div>
          </div>

          <div class="back_to_shop">
    <a href="<?php echo base_url ?>">
        <i class="back fas fa-arrow-left" style="font-size: 24px;"></i>
    </a>
</div>





          <div id="login-btn">
            <button type="submit">Log in</button>
          </div>
          
          <div id="no-account">No account?
            <a href="<?php echo base_url . 'register.php' ?>"> Signup here.</a>
          </div>
        </div>
      </form>

    </div>
    <div class="right-login">
      <img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo">
    </div>
  </div>
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    $(document).ready(function() {
      end_loader();
    });
  </script>
</body>

</html>