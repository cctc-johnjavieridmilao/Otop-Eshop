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

    <?= $this->include('layout/vendor_header') ?>
 

    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
      <div class="container">
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">

          <!-- <h4 class="az-content-title">User Management</h4> -->

          <!-- <div class="az-content-label mg-b-5">Bordered Table</div> -->

          <div class=" card">
              <div class=" card-body">
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

<script>

  var users_table = $('#users_table').DataTable();

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

      $.post('<?= base_url('Vendor/DeleteUser') ?>', {id: id}, function(result) {
           if(result.msg == 'success') {
            Swal.fire('Successfully Deleted','','success');
           } else {
            Swal.fire(result.msg,'','error');
           }
           GetUsersData();
      }, 'json');
  }

  function GetUsersData() {
      $.get('<?= base_url('Vendor/GetUsers') ?>',(result) => {

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
      GetUsersData();
    });
</script>