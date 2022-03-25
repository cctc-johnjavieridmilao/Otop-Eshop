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
    <link href="<?= base_url('public/assets/css/custom.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/sweetalert2.css') ?>" rel="stylesheet">
  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
        <div class="az-card-signin">
            <!-- <h1 class="az-logo" style="text-transform: uppercase">
            OTOP E-SHOP
        </h1> -->
        <a href="<?=base_url('/') ?>"><img src="<?= base_url('public/assets/img/otop.jpg')?>" style="height: 150px;margin-left: -10px;"></a>
            <div class="az-signin-header">
            <h2 style="color: #df785d">Welcome</h2>

           
                <div class="form-group">
                <label>Email/Username</label>
                <input type="text" class="form-control userinput" id="u_email" placeholder="Enter your Email/Username" value="">
                </div><!-- form-group -->
                <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control userinput" id="u_pass" placeholder="Enter your password" value="">
                </div><!-- form-group -->
                <button class="btn btn-outline-indigo btn-block" id="sign_in">Sign In</button>
            
            </div><!-- az-signin-header -->
            <div class="az-signin-footer">
            <!-- <p><a href="">Forgot password?</a></p> -->
            <p>Don't have an account? <a href="<?= base_url('Home/register') ?>">Create an Account</a></p>
            </div><!-- az-signin-footer -->
        </div><!-- az-card-signin -->
        </div><!-- az-signin-wrapper -->
 

    <input type="hidden" id="lat">
    <input type="hidden" id="lang">

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('public/assets/js/jquery-3.3.1.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/azia.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/sweetalert2.js') ?>"></script>
       <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js"></script>
    
  </body>
</html>

<script>

function showPosition(position) {
    $('#lat').val(position.coords.latitude);
    $('#lang').val(position.coords.longitude);
}

 // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
//   var firebaseConfig = {
//     apiKey: "AIzaSyDNONyY-kENbRs6Zm9w_Rnatw2YaA9E-T4",
//     authDomain: "messanging-app-b86eb.firebaseapp.com",
//     databaseURL: "https://messanging-app-b86eb-default-rtdb.asia-southeast1.firebasedatabase.app",
//     projectId: "messanging-app-b86eb",
//     storageBucket: "messanging-app-b86eb.appspot.com",
//     messagingSenderId: "435495229801",
//     appId: "1:435495229801:web:37d11bfbcf8e8e3f3cc5f8",
//     measurementId: "G-PBVRL2YG2M"
//   };

const firebaseConfig = {
    apiKey: "AIzaSyAEhCo0j2_jlPMU6yBMCTFC_JnkRwkPmkU",
    authDomain: "otopeshop-360c7.firebaseapp.com",
    databaseURL: "https://otopeshop-360c7-default-rtdb.asia-southeast1.firebasedatabase.app/",
    projectId: "otopeshop-360c7",
    storageBucket: "otopeshop-360c7.appspot.com",
    messagingSenderId: "927011315173",
    appId: "1:927011315173:web:a0d293ea084e869d4ce30c",
    measurementId: "G-YXZZYZS1R8"
 };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  const database = firebase.database();

  $(function() {

    if (navigator.geolocation) {
       navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
      alert('Geolocation is not supported by this browser.');
    }

    $('#sign_in').click(function() {

        //var reg_exp_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        var cart = JSON.parse(localStorage.getItem('cart')) || [];

        if($('.userinput').val() == '') {
            Swal.fire('Please fill out all fields!','','warning');
            return false;
        }

        $('#sign_in').attr('disabled','disabled').html('Please wait...');

            $.ajax({
                type: 'POST',
                url: '<?=base_url('Home/Login') ?>',
                data: {
                    u_email: $('#u_email').val(),
                    u_pass: $('#u_pass').val(),
                    lat: $('#lat').val(),
                    lang: $('#lang').val(),
                    cart: JSON.stringify(cart)
                },
                dataType: 'json',
                success: function(result) {
                    if(result.msg == 'success') {
                        $('.userinput').val('');
                        Swal.fire('Welcome ' + result.fname,'','success');

                        database.ref('users').child(result.user_id).update({
                            isLogin: 1
                        });

                        setTimeout(() => {
                            if(result.user_type == 'user') {
                                window.location = '<?= base_url('Home/') ?>'
                            } else if(result.user_type == 'admin') {
                                window.location = '<?= base_url('Admin/Dashboard') ?>'
                            } else if(result.user_type == 'vendor') {
                                window.location = '<?= base_url('Vendor/Dashboard') ?>'
                            }
                        },2000);
                        
                    } else {
                        Swal.fire(result.msg,'','warning');
                    }

                    $('#sign_in').removeAttr('disabled').html('Sign In');
                }
            })

        });
  });
</script>