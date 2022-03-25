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
 
    <div class="container-fluid">
         <br><br>
          <div class="row">
              <div class="col-md-3 mt-3">
              <ul class="list-group">
                <li class="list-group-item"><a href="<?= base_url('Home/Profile') ?>" class="nav-link">Profile</a></li>
                <li class="list-group-item"><a href="<?= base_url('Home/Addresses') ?>" class="nav-link">Addresses</a></li>
                <li class="list-group-item"><a href="<?= base_url('Home/ChangePassword') ?>" class="nav-link">Change Password</a></li>
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


                  <button class="btn btn-outline-success" id="add_new_address">Add New Address</button><br><br>
  
                    <table class="table table-bordered" id="load_address">
                        <thead>
                            <tr>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Postal Code</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>
                  
                    
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


<div id="NewAddressModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">ADD NEW ADDRESS</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                 <div class="col-md-6">
                      <label>Phone Number</label>
                      <input type="text" maxlength="11" class="form-control userinput" id="phone_number">
                 </div>

                 <div class="col-md-6">
                      <label>Postal Code</label>
                      <input type="text" class="form-control userinput" id="postal_code">
                 </div>

                 <div class="col-md-12">
                      <label>Address</label>
                      <input type="text" class="form-control userinput" id="address">
                 </div>
            </div>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-warning" id="save_address">Save</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="EditAddressModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">EDIT ADDRESS</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                 <div class="col-md-6">
                      <label>Phone Number</label>
                      <input type="text" maxlength="11" class="form-control" id="u_phone_number">
                 </div>

                 <div class="col-md-6">
                      <label>Postal Code</label>
                      <input type="text" class="form-control" id="u_postal_code">
                 </div>

                 <div class="col-md-12">
                      <label>Address</label>
                      <input type="text" class="form-control" id="u_address">
                      <input type="hidden" class="form-control" id="u_address_id">
                 </div>
            </div>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-warning" id="update_address">Save</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

<script>
 var load_address = $('#load_address').DataTable();

 function EditAddress(phone_num,address,postal_code,addres_id) {
    $('#u_phone_number').val(phone_num);
    $('#u_postal_code').val(postal_code);
    $('#u_address').val(address);
    $('#u_address_id').val(addres_id);

    $('#EditAddressModal').modal('show')
 }

 function SetDefaultAddress(addres_id) {

    if(confirm('Are you sure you want set this to default address ?') == false) {
         return false;
     }

     $.post('<?= base_url('Home/SetDefaultAddress') ?>', {
            addres_id: addres_id,
        }, function(response) {
            if(response.msg == 'success') {
                swal.fire('Successfully Set Default Address!', '', 'success');
                GetAddress();
            } else {
                swal.fire(response.msg, '', 'error');
            }
            
        }, 'json');
 }

 function DeleteAddress(addres_id) {
     if(confirm('Are you sure you want to delete this data?') == false) {
         return false;
     }

     $.post('<?= base_url('Home/DeleteAddress') ?>', {
            addres_id: addres_id,
        }, function(response) {
            if(response.msg == 'success') {
                swal.fire('Successfully Added!', '', 'success');
                GetAddress();
            } else {
                swal.fire(response.msg, '', 'error');
            }
            
        }, 'json');
 }

function GetAddress() {

  $.get('<?= base_url('Home/GetUserAddress') ?>', function(response) {
    load_address.clear().draw();

    response.forEach((row) => {
            var tr = $(`
            <tr>
                <td>${row.Full_Address}</td>
                <td>${row.PhoneNumber}</td>
                <td>${row.PostalCode}</td>
                <td>${row.Created_at}</td>
                <td align="center" width="33%">
                  ${row.IsDefault == 1 ? `<button class="btn btn-warning" disabled>Default</button>` : 
                    `<button class="btn btn-warning" onclick="SetDefaultAddress(${row.AddresID})">Set Default</button>`}

                    <button class="btn btn-outline-primary" onclick="EditAddress('${row.PhoneNumber}','${row.Full_Address}','${row.PostalCode}',${row.AddresID})">Edit</button>
                    <button class="btn btn-outline-danger" onclick="DeleteAddress(${row.AddresID})">Trash</button>
                </td>
            </tr>
            `);
            load_address.row.add(tr);
        });

        load_address.draw();
  }, 'json');

}

 $(function() {

    $('#add_new_address').click(function() {
        $('#NewAddressModal').modal('show');
    });

    $('#save_address').click(function() {
        if($('.userinput').val() == '') {
            swal.fire('Please fill out all fields', '', 'error');
            return false;
        }

        $.post('<?= base_url('Home/AddNewAddress') ?>', {
            phone_number: $('#phone_number').val(),
            postal_code: $('#postal_code').val(),
            address: $('#address').val(),
        }, function(response) {
            if(response.msg == 'success') {
                swal.fire('Successfully Added!', '', 'success');
                GetAddress();
                $('.userinput').val('');
            } else {
                swal.fire(response.msg, '', 'error');
            }
            
        }, 'json');
    });

    $('#update_address').click(function() {
        $.post('<?= base_url('Home/UpdateAddress') ?>', {
            phone_number: $('#u_phone_number').val(),
            postal_code: $('#u_postal_code').val(),
            address: $('#u_address').val(),
            address_id: $('#u_address_id').val(),
        }, function(response) {
            if(response.msg == 'success') {
                swal.fire('Successfully Updated!', '', 'success');
                GetAddress();
                $('.userinput').val('');
            } else {
                swal.fire(response.msg, '', 'error');
            }
            
        }, 'json');
    });

    
  
    GetAddress();

 });

 
</script>