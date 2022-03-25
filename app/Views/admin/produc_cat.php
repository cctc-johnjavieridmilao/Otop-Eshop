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

          <!-- <h2 class="az-content-title">Product Category</h2> -->

          <div class=" card">
              <div class=" card-body">
                    <button class="btn btn-outline-success" style="display: none;" id="AddCategory">Add Category <span class="fas fa-plus"></span></button>
                    <br><br>

                    <table class="table table-bordered table-hover table-striped mg-b-0" id="category_table">
                    <thead>
                      <tr>
                        <th>VENDOR</th>
                        <th>CATEGORY CODE</th>
                        <th>NAME</th>
                        <th>CREATE_AT</th>
                        <th>ACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                  </table>
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

<div id="AddCategoryModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">ADD CATEGORY</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                     <label>Category Name</label>
                     <input type="text" class="form-control" id="cat_name">
                </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-light" id="SaveCategory">Save</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="UpdateCategoryModal" class="modal">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">VIEW CATEGORY</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                     <label>Category Name</label>
                     <input type="text" class="form-control" id="u_cat_name" readonly>
                     <input type="hidden" class="form-control" id="u_cat_id">
                </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <!-- <button type="button" class="btn btn-outline-light" id="UpdateCategory">Save</button> -->
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

<script>

 var category_table = $('#category_table').DataTable();

 function DeleteCategory(CategoryID) {

    if(confirm('Are you sure you want to delete this category ?') == false) {
        return false;
      }

    $.post('<?= base_url('Admin/DeleteCategory') ?>', {CategoryID: CategoryID}, function(result) {
           if(result.msg == 'success') {
            Swal.fire('Successfully Deleted','','success');
           } else {
            Swal.fire(res.msg,'','error');
           }
           GetCategory();
      }, 'json');
 }

 function UpdateCategory(name, id) {
     $('#u_cat_name').val(name);
     $('#u_cat_id').val(id);
     $('#UpdateCategoryModal').modal('show');
 }

 function GetCategory() {
      $.get('<?= base_url('Admin/GetProductsCategory') ?>',(result) => {

        category_table.clear().draw();

          result.forEach((row) => {
              var tr = $(`
                <tr>
                    <td>${row.company_name}</td>
                    <td>${row.CategoryCode}</td>
                    <td>${row.Name}</td>
                    <td>${row.Created_at}</td>
                    <td align="center" width="15%">
                        <button class="btn btn-outline-primary" onclick="UpdateCategory('${row.Name}',${row.CategoryID})"><span class="fas fa-search"></span></button>
  
                    </td>
                </tr>
              `);
              category_table.row.add(tr);
          });

          category_table.draw();
        },'json');
    }

 $(function() {

    GetCategory();

     $('#AddCategory').click(function() {
        $('#AddCategoryModal').modal('show');
     });

     $('#SaveCategory').click(function() {

         if($("#cat_name").val() == '') {
            Swal.fire('Category name is mandatory','','error');
            return false;
         }

         $.post('<?= base_url('Admin/AddCategory') ?>', {cat_name: $("#cat_name").val()}, function(result) {
           if(result.msg == 'success') {
            Swal.fire('Successfully Added','','success');
            $("#cat_name").val('');
           } else {
            Swal.fire(res.msg,'','error');
           }
           GetCategory();
      }, 'json');

     });

     $('#UpdateCategory').click(function() {

        if($("#u_cat_name").val() == '') {
            Swal.fire('Category name is mandatory','','error');
            return false;
         }

         $.post('<?= base_url('Admin/UpdateCategory') ?>', {cat_name: $("#u_cat_name").val(), cat_id: $('#u_cat_id').val()}, function(result) {
           if(result.msg == 'success') {
            Swal.fire('Successfully Updated','','success');
           } else {
            Swal.fire(res.msg,'','error');
           }
           GetCategory();
      }, 'json');

     })
 })
 
</script>