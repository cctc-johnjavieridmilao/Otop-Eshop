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
                      <div class="col-md-4">
                           <label>Firstname</label>
                           <input type="text" class="form-control" id="firstname">
                      </div>
                      <div class="col-md-4">
                           <label>Lastname</label>
                           <input type="text" class="form-control" id="lastname">
                      </div>
                      <div class="col-md-4">
                           <label>Middlename</label>
                           <input type="text" class="form-control" id="middlename">
                           <br>
                      </div>
                      <div class="col-md-6">
                           <label>Email</label>
                           <input type="text" class="form-control" id="email">
                      </div>
                      <div class="col-md-6">
                           <label>Username</label>
                           <input type="text" class="form-control" id="username" readonly>
                           <br>
                      </div>

                      <div class="col-md-6">
                           <label>Upload Profile</label>
                           <input type="file" class="form-control" id="file">
                      </div>
                     
                  </div>
                  <button class="btn btn-outline-success mt-2" style="float: right;" id="SaveProfile">Save</button>
                  
                    
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

     $.get('<?=base_url('Home/GetProfile') ?>', function(response) {
         $('#firstname').val(response[0].firtname);
         $('#lastname').val(response[0].lastname);
         $('#middlename').val(response[0].middlename);
         $('#email').val(response[0].email);
         $('#username').val(response[0].username);
     }, 'json');

     $('#SaveProfile').click(function() {
       var formdata = new FormData();

       formdata.append('firstname', $('#firstname').val());
       formdata.append('lastname', $('#lastname').val());
       formdata.append('middlename', $('#middlename').val());
       formdata.append('email', $('#email').val());
       formdata.append('username', $('#username').val());
       formdata.append('file', $('#file').prop('files')[0]);

       $.ajax({
            type:'POST',
            url: '<?=base_url('Home/UpdateProfile') ?>',
            data: formdata,
            processData: false,
            contentType: false,
            dataType: 'json',
            success:function(response){
              if(response.msg == 'success') {
                swal.fire('Successfully Updated!', '', 'success');
            } else {
                swal.fire(response.msg, '', 'error');
            }
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });
      
     });

 });

 
</script>