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

    <?= $this->include('layout/user_header') ?>
 
   <div class="az-content az-content-profile">
      <div class="container mn-ht-100p">
        <div class="content-wrapper w-100">
         
          <div class="row mt-2">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="product-nav-wrapper row">
                    <div class="col-lg-4 col-md-5">
                      <ul class="nav product-filter-nav">
                        <li class="active"><a href="">CONTACT US</a></li>
                      </ul>
                    </div>
                    <div class="col-lg-8 col-md-7 product-filter-options">
                      <ul class="account-user-info ml-auto"></ul>
                      <ul class="account-user-link d-none d-lg-block"></ul>
                      
                    </div>
                  </div>
                  <div class="row product-item-wrapper">

                    <div class="col-md-6">
                        <p>Phone: (078) 624 0687</p>
                        <p>Address: Jeremy Building, National Highway, Brgy. Alibagu, Ilagan, Isabela</p>
                        <p>Email: r02.isabela@dti.gov.ph</p>
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-12">
                            <label>Fullname</label>
                            <input type="text" class="form-control" id="fullname">
                          </div>
                          <div class="col-md-12">
                            <label>Email</label>
                            <input type="text" class="form-control" id="email">
                          </div>
                          <div class="col-md-12">
                            <label>Subject</label>
                            <input type="text" class="form-control" id="subject">
                          </div>
                          <div class="col-md-12">
                            <label>Message</label>
                            <textarea class="form-control" id="message"></textarea>
                          </div>

                          <div class="col-md-12 mt-2">
                             <button class="btn btn-block btn-success" id="submit_inquary">SUBMIT</button>
                          </div>

                        </div>

                        <br><br><br><br><br><br><br><br>

                        
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- az-content -->

    <div class="az-footer ht-40">
      <div class="container ht-100p pd-t-0-f">
        <span>© ALRIGHT RESERVED BY OTOP E-SHOP COMPANY</span>
      </div><!-- container -->
    </div>

      
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

  $('#submit_inquary').click(function() {

     if($('#fullname').val() == '' || $('#email').val() == '' || $('#subject').val() == '' || $('#message').val() == '') {
      swal.fire('Please fill out all fields!', '', 'error');
      return false;
     }

     swal.fire('Successfully Submit!', '', 'success');
     $('.form-control').val('');
      
  });

</script>