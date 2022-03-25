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

    <?= $this->include('layout/admin_header') ?>
 

    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
      <div class="container">
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">

          <!-- <h4 class="az-content-title">User Management</h4> -->

          <!-- <div class="az-content-label mg-b-5">Bordered Table</div> -->

          <div class=" card">
              <div class=" card-body">
              <button class="btn btn-outline-success" id="Addusers">Add Users <span class="fas fa-plus"></span></button>
                <br><br>
              <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped mg-b-0" id="users_table">
                    <thead>
                      <tr>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>MIDDLENAME</th>
                        <th>USERNAME</th>
                        <th>ROLE</th>
                        <th>EMAIL</th>
                        <th>CREATE_AT</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
          
     
        </div><!-- az-content-body -->
      </div><!-- container -->
    </div><!-- az-content -->

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('public/assets/js/jquery-3.3.1.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/azia.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap-4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/sweetalert2.js') ?>"></script>
     <!-- The core Firebase JS SDK is always required and must be listed first -->
     <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>

  <!-- TODO: Add SDKs for Firebase products that you want to use
      https://firebase.google.com/docs/web/setup#available-libraries -->
  <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js"></script>
    
  </body>
</html>

<!-- LARGE MODAL -->
<div id="ViewUserModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">View</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                     <label>Firstname</label>
                     <input type="text" class="form-control" id="fname" readonly>
                </div>
                <div class="col-md-12">
                     <label>Lastname</label>
                     <input type="text" class="form-control" id="lname" readonly>
                </div>
                <div class="col-md-12">
                     <label>Middlename</label>
                     <input type="text" class="form-control" id="mname" readonly>
                </div>
                <div class="col-md-12">
                     <label>Username</label>
                     <input type="text" class="form-control" id="username" readonly>
                </div>
                <div class="col-md-12">
                     <label>Email</label>
                     <input type="text" class="form-control" id="email" readonly>
                </div>
                <div class="col-md-12">
                     <label>Role</label>
                     <input type="text" class="form-control" id="role" readonly>
                </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->


    <div id="CreateUser" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">CREATE USER</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="#">
            <div class="form-group">
              <label>Firstname</label>
              <input type="text" class="form-control userinput" id="cfname" placeholder="Enter your firstname">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Middlename</label>
              <input type="text" class="form-control userinput" id="cmname" placeholder="Enter your Middlename">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Lastname</label>
              <input type="text" class="form-control userinput" id="clname" placeholder="Enter your Lastname">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control userinput" id="cusername" placeholder="Enter your Username">
            </div><!-- form-group -->
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control userinput" id="cemail" placeholder="Enter your email">
            </div><!-- form-group -->

            <div class="form-group">
              <label>Role</label>
              <select class="form-control userinput" id="crole">
                  <option value=""> - </option>
                  <option value="vendor">vendor</option>
                  <option value="user">user</option>
              </select>
            </div><!-- form-group -->

            <div class="form-group">
              <label>Company name</label>
              <input type="text" class="form-control userinput" id="cname" placeholder="Enter company name">
            </div><!-- form-group -->

            <div class="form-group">
              <label>Company address</label>
              <input type="text" class="form-control userinput" id="caddress" placeholder="Enter company address">
            </div><!-- form-group -->

            <div class="form-group">
              <label>Password (<small>auto generated</small>)</label>
              <input type="text" class="form-control" id="cpassword" readonly>
            </div><!-- form-group -->
            <!-- row -->
          </form>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-primary" id="submit_users">Submit</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

<script>

  var users_table = $('#users_table').DataTable();

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

  function viewUser(fname,lname,mname,username,email,role) {
     $('#fname').val(fname);
     $('#lname').val(lname);
     $('#mname').val(mname);
     $('#username').val(username);
     $('#email').val(email);
     $('#role').val(role);
     $('#ViewUserModal').modal('show');
  }

  function DeleteUser(id) {
      if(confirm('Are you sure you want to delete this user?') == false) {
        return false;
      }

      $.post('<?= base_url('Admin/DeleteUser') ?>', {id: id}, function(result) {
           if(result.msg == 'success') {
            Swal.fire('Successfully Deleted','','success');
           } else {
            Swal.fire(result.msg,'','error');
           }
           GetUsersData();
      }, 'json');
  }

  function GetUsersData() {
      $.get('<?= base_url('Admin/GetUsers') ?>',(result) => {

        users_table.clear().draw();

          result.forEach((row) => {
              var tr = $(`
                <tr>
                    <td>${row.firtname}</td>
                    <td>${row.lastname}</td>
                    <td>${row.middlename}</td>
                    <td>${row.username}</td>
                    <td>${row.user_type}</td>
                    <td>${row.email}</td>
                    <td>${row.created_at}</td>
                    <td align="center" width="12%">
                      <button class="btn btn-outline-danger btn-sm" onclick="DeleteUser(${row.RecID})"><span class="fas fa-trash"></span></button>
                      <button class="btn btn-outline-success btn-sm" onclick="viewUser('${row.firtname}','${row.lastname}','${row.middlename}','${row.username}','${row.email}','${row.user_type}')"><span class="fas fa-search"></span></button>
                    </td>
                   
                </tr>
              `);
              users_table.row.add(tr);
          });

          users_table.draw();
        },'json');
    }

    $(function() {


      $('#Addusers').click(function() {
          $('#CreateUser').modal('show');
      });

      $('#submit_users').click(function() {

        var data = {
           fname: $('#cfname').val(),
           mname: $('#cmname').val(),
           lname: $('#clname').val(),
           username: $('#cusername').val(),
           email: $('#cemail').val(),
           role: $('#crole').val(),
           cname: $('#cname').val(),
           caddress: $('#caddress').val(),
           password: $('#cpassword').val(),
           cpassword: $('#ccpassword').val()
        };

        if(data.fname == '' || data.mname == '' || data.lname == '' || data.username == '') {
          Swal.fire('Please fill out all fields!','','error');
          return false;
        }

        // if(data.cpassword != data.password) {
        //   Swal.fire('Password and Confirm password do not match','error');
        //   return false;
        // }

        $('#submit_users').attr('disabled','disabled').html('Please wait...');

        $.post('<?= base_url('Admin/CreateUser') ?>', data, function(result) {
           if(result.msg == 'success') {
            Swal.fire('Successfully Created','','success');

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

            $('.userinput').val('');

            $('#cpassword').val(result.password);

            //$('#CreateUser').modal('hide');
            
           } else {
            Swal.fire(result.msg,'','error');
           }
           GetUsersData();
           $('#submit_users').removeAttr('disabled').html('Submit');
      }, 'json');
          
      });

      GetUsersData();

    });
</script>