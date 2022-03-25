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
    <link href="<?= base_url('public/assets/css/custom.css') ?>" rel="stylesheet">
  </head>
  <body class="az-body">

  <div class="az-signup-wrapper">
      <div class="az-column-signup-left">
        <div>
        <a href="<?=base_url('/') ?>"> <img src="<?= base_url('public/assets/img/otop.jpg')?>" style="height: 150px;margin-left: -30px;"></a>
          <h1 class="az-logo"  style="text-transform: uppercase; color: #df785d">OTOP E-SHOP</h1>
          <p>- OTOP Philippines is a priority stimulus program for Micro and Small and
              Medium-scale enterprises (MSMEs) as the government’s customized
              intervention to drive inclusive local economic growth. The program enables
              localities and communities to determine, develop, support, and promote
              culturally-rooted products or services where they can be the best at or best
              renowned for</p>
          <a href="<?=base_url('Home/AboutUs') ?>" class="btn btn-outline-indigo">CLICK FOR MORE</a>
        </div>
      </div><!-- az-column-signup-left -->
      <div class="az-column-signup">
        <!-- <h1 class="az-logo">AGRI SUPPLY</h1> -->
        <div class="az-signup-header">
          <h2 style="color: #df785d">Get Started</h2>

         
            <div class="form-group">
              <label>Firstname</label>
              <input type="text" class="form-control userinput" id="fname" placeholder="Enter your firstname">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Middlename</label>
              <input type="text" class="form-control userinput" id="mname" placeholder="Enter your Middlename">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Lastname</label>
              <input type="text" class="form-control userinput" id="lname" placeholder="Enter your Lastname">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control userinput" id="username" placeholder="Enter your Username">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control userinput" id="email" placeholder="Enter your email">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control userinput" id="password" placeholder="Enter your password">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" class="form-control userinput" id="cpassword" placeholder="Enter your password">
            </div><!-- form-group -->
            <button class="btn btn-outline-indigo btn-block" id="CreateAccount">Create Account</button>
            <!-- row -->
          
        </div><!-- az-signup-header -->
        <div class="az-signup-footer">
          <p>Already have an account? <a href="<?= base_url('Home/loginpage') ?>">Sign In</a></p>
        </div><!-- az-signin-footer -->
      </div><!-- az-column-signup -->
    </div><!-- az-signup-wrapper -->
 

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
  // var firebaseConfig = {
  //   apiKey: "AIzaSyDNONyY-kENbRs6Zm9w_Rnatw2YaA9E-T4",
  //   authDomain: "messanging-app-b86eb.firebaseapp.com",
  //   databaseURL: "https://messanging-app-b86eb-default-rtdb.asia-southeast1.firebasedatabase.app",
  //   projectId: "messanging-app-b86eb",
  //   storageBucket: "messanging-app-b86eb.appspot.com",
  //   messagingSenderId: "435495229801",
  //   appId: "1:435495229801:web:37d11bfbcf8e8e3f3cc5f8",
  //   measurementId: "G-PBVRL2YG2M"
  // };

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

    $('#CreateAccount').click(function() {

      var reg_exp_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if($('#fname').val() == '' || $('#mname').val() == '' 
        || $('#lname').val() == '' || $('#username').val() == '' ||
        $('#email').val() == '' || $('#password').val() == '') {
            Swal.fire('Please fill out all fields!','','warning');
            return false;
      }

      if(reg_exp_email.test($('#email').val()) == false) {
           Swal.fire('Please enter valid email!','','warning');
            return false;
      }

      if($('#password').val() != $('#cpassword').val()) {
            Swal.fire('Password and Confirm Password do not match!','','warning');
            return false;
        }

        $('#CreateAccount').attr('disabled','disabled').html('Please wait...');

        $.ajax({
            type: 'POST',
            url: '<?=base_url('Home/RegisterAccount') ?>',
            data: {
                fname: $('#fname').val(),
                mname: $('#mname').val(),
                lname: $('#lname').val(),
                username: $('#username').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                lat: $('#lat').val(),
                lang: $('#lang').val(),
            },
            dataType: 'json',
            success: function(result) {
               if(result.msg == 'success') {

                   $('.form-control').val('');
                   Swal.fire('Account Successfully Created!','','success');

                   database.ref('/users/'+result.user_id).set({
                        username: result.username,
                        name: result.name,
                        email: result.email,
                        user_type: result.user_type,
                        date: new Date().toUTCString(),
                        isLogin: 0,
                        Messages: 0,
                        NewMessage: ''
                    });

                   //setTimeout(() => window.location = '<?= base_url('/') ?>',1500);
                   
               } else {
                   console.log(result);
               }

               $('#CreateAccount').removeAttr('disabled').html('Create Account');
            }
        })

    });
  });
</script>