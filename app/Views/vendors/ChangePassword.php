<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="initial-scale=1, shrink-to-fit=no, width=device-width" name="viewport">

    <!-- CSS -->
    <!-- Add Material font (Roboto) and Material icon as needed -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i|Roboto+Mono:300,400,700|Roboto+Slab:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Add Material CSS, replace Bootstrap CSS -->
    <link href="<?= base_url('public/assets/css/azia.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/sweetalert2.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/fontawesome-free-5.12.1-web/css/all.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.css" rel="stylesheet">
  </head>
  <body>

  <?php if(session('user_type') == 'admin') : ?>

    <?= $this->include('layout/admin_header') ?>

    <?php endif; ?>

    <?php if(session('user_type') == 'user') : ?>

    <?= $this->include('layout/user_header') ?>

    <?php endif; ?>

    <?php if(session('user_type') == 'vendor') : ?>

    <?= $this->include('layout/vendor_header') ?>

    <?php endif; ?>
 

    <div class="container-fluid">
         <br><br>
          <div class="row">
              <div class="col-md-3 mt-3">
              <ul class="list-group">
                <li class="list-group-item"><a href="<?= base_url('Vendor/Settings') ?>" class="nav-link">Profile</a></li>
                <li class="list-group-item"><a href="<?= base_url('Vendor/ChangePassword') ?>" class="nav-link">Change Password</a></li>
              </ul>
                 
              </div>

               <div class="col-md-9 mt-3">

               <div class="card">
                <div class="card-body">
                  <div class="product-nav-wrapper row">
                    <div class="col-lg-4 col-md-5">
                      <ul class="nav product-filter-nav">
                        <li class="active"><a href="#">SETTINGS</a></li>
                        <!-- <li><a href="#">FEATURED</a></li>
                        <li><a href="#">SALES</a></li> -->
                      </ul>
                    </div>
   
                  </div>


                  
                  <div class="row">
                        <div class="col-md-12">
                             <label>Current password</label>
                             <input type="password" class="form-control userinput" id="current_pass">
                        </div>
                        <div class="col-md-12">
                             <label>New Password</label>
                             <input type="password" class="form-control userinput" id="new_pass">
                        </div>
                        <div class="col-md-12">
                             <label>Confirm Password</label>
                             <input type="password" class="form-control userinput" id="confirm_pass">
                        </div>
                       
                    </div>
                    <button class="btn btn-outline-success mt-2" style="float: right;" id="SavePassword">Save</button>
                  
                    
                </div>
              </div>

               </div>
          </div>

      </div><!-- container -->

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('public/assets/js/jquery-3.3.1.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/azia.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap-4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/sweetalert2.js') ?>"></script>
    
  </body>
</html>

<script>
 

 $(function() {

    $('#SavePassword').click(function() {

        if($('.userinput').val() == '') {
            swal.fire('Please fill out all fields!', '', 'error');
            return false
        }

        if($('#new_pass').val() != $('#confirm_pass').val()) {
            swal.fire('New password and Confirm password not match!', '', 'error');
            return false
        }

        $.post('<?= base_url('Home/UpdatePassword') ?>', {
            current_pass: $('#current_pass').val(),
            new_pass: $('#new_pass').val(),
            confirm_pass: $('#confirm_pass').val(),
        }, function(response) {
            if(response.msg == 'success') {
                swal.fire('Successfully Updated!', '', 'success');
            } else {
                swal.fire(response.msg, '', 'error');
            }
        }, 'json');

    });

 });

 
</script>