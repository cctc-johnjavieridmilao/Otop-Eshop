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
    <link href="<?= base_url('public/assets/dropzone/dropzone.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.css" rel="stylesheet">
  </head>
  <body>

    <?= $this->include('layout/vendor_header') ?>

    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
      <div class="container">
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">

          <!-- <h2 class="az-content-title">Products</h2> -->

          <div class=" card">
              <div class=" card-body">
                    <button class="btn btn-outline-success" id="btn_add_product">Add Products <span class="fas fa-plus"></span></button>
                    <br><br>

                    <table class="table table-bordered table-hover table-striped mg-b-0" id="product_table">
                    <thead>
                      <tr>
                        <th>PRODUCT CODE</th>
                        <th>NAME</th>
                        <th>CATEGORY</th>
                        <th>STOCKS</th>
                        <th>PRIZE</th>
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
    <script src="<?= base_url('public/assets/dropzone/dropzone.js') ?>"></script>
    
  </body>
</html>


<div id="AddProductModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">ADD PRODUCT</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                     <label>Product Name</label>
                     <input type="text" class="form-control" id="p_name">
                </div>
                <div class="col-md-6">
                     <label>Category</label>
                     <select id="p_cat" class="form-control">
                        <option value=""> - </option>
                     </select>
                </div>
                <div class="col-md-6">
                     <label>Prize</label>
                     <input type="text" class="form-control" onblur="FormatAmount(this)" onkeypress="return NumnbersOnly(event)" id="p_prize">
                </div>
                <div class="col-md-6">
                     <label>Stocks</label>
                     <input type="text" class="form-control" onkeypress="return NumnbersOnly(event)" id="p_stocks">
                </div>
                <div class="col-md-12">
                     <label>Description</label>
                     <textarea id="p_description" class="form-control" cols="4" rows="4"></textarea>
                </div>

                <div class="col-md-12">
                     <label>Image</label>
                     <div id="myDropzone" class="dropzone"></div>
                </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-light" id="SaveProduct">Save</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="UpdateProductModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">UPDATE PRODUCT</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                     <label>Product Name</label>
                     <input type="text" class="form-control" id="u_p_name">
                     <input type="hidden" class="form-control" id="u_produc_id">
                </div>
                <div class="col-md-6">
                     <label>Category</label>
                     <select id="u_p_cat" class="form-control">
                        <option value=""> - </option>
                     </select>
                </div>
                <div class="col-md-6">
                     <label>Prize</label>
                     <input type="text" class="form-control" onblur="FormatAmount(this)" onkeypress="return NumnbersOnly(event)" id="u_p_prize">
                </div>
                <div class="col-md-6">
                     <label>Stocks</label>
                     <input type="text" class="form-control" onkeypress="return NumnbersOnly(event)" id="u_p_stocks">
                </div>
                <div class="col-md-12">
                     <label>Description</label>
                     <textarea id="u_p_description" class="form-control" cols="4" rows="4"></textarea>
                </div>

                <div class="col-md-12">
                     <label>Image</label>
                     <div id="UmyDropzone" class="dropzone"></div>
                </div>
            </div>

            <div class="card mt-2">
               <div class="card-body">
                  <div class="row" id="images">
                      
                  </div>
               </div>
            </div>
          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-light" id="UpdateProduct">Save</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

<script>

var product_table = $('#product_table').DataTable();

Dropzone.autoDiscover = false;

function GetProductImage(product_id) {
  $('#images').empty();
  $.post('<?= base_url('Vendor/GetProductImage') ?>', {product_id: product_id}, function(response) {
    response.forEach(function(row) {
       $('#images').append(`
       <div class="col-md-3">
       <a href="<?= base_url() ?>/public/uploads/${row.FileName}" target="_blank">
         <img src="<?= base_url() ?>/public/uploads/${row.FileName}" class="img-thumbnail wd-100p wd-sm-200" alt="Responsive image">
        </a>
      </div>
       `);
    })
  }, 'json');
}

function UpdateProduct(product_id) {
  $.post('<?= base_url('Vendor/GetProductById') ?>', {product_id: product_id}, function(response) {
      $('#u_p_name').val(response[0].Name);
      $('#u_p_cat').val(response[0].CategoryID);
      $('#u_p_prize').val(response[0].Prize);
      $('#u_p_description').val(response[0].Description);
      $('#u_p_stocks').val(response[0].stocks);
  }, 'json');
   
  GetProductImage(product_id);
  $('#u_produc_id').val(product_id);
  $('#UpdateProductModal').modal('show');
}

function DeleteProducts(product_id) {
  if(confirm('Are you sure you want to delete this product ?') == false) {
        return false;
      }

    $.post('<?= base_url('Vendor/DeleteProduct') ?>', {product_id: product_id}, function(result) {
           if(result.msg == 'success') {
            Swal.fire('Successfully Deleted','','success');
           } else {
            Swal.fire(res.msg,'','error');
           }
           GetProducts();
      }, 'json');
}

function GetProducts() {
      $.get('<?= base_url('Vendor/GetProductAll') ?>',(result) => {

        product_table.clear().draw();

          result.forEach((row) => {
              var tr = $(`
                <tr>
                    <td>${row.ProducCode}</td>
                    <td>${row.Name}</td>
                    <td>${row.Catname}</td>
                    <td>${row.stocks}</td>
                    <td>${row.Prize}</td>
                    <td>${row.Created_at}</td>
                    <td align="center" width="15%">
                        <button class="btn btn-outline-primary" onclick="UpdateProduct(${row.ProducID})"><span class="fas fa-pencil-alt"></span></button>
                       <button class="btn btn-outline-danger" onclick="DeleteProducts(${row.ProducID})"><span class="fas fa-trash"></span></button>
                    </td>
                </tr>
              `);
              product_table.row.add(tr);
          });

          product_table.draw();
        },'json');
    }

  function FormatAmount(elem) {

      const value = elem.value.replace(/,/g, '');

      elem.value = parseFloat(value).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 2
      });

      if (elem.value == 'NaN') {
          elem.value = '';
      }
}


function NumnbersOnly(event) {

  var chartCode = event.charCode;

  isNumeric = ((chartCode >= 48 && chartCode <= 57) || chartCode == 46);

  //symbols = (event.key == '-');

  return isNumeric;

}

function GetCategory() {
  $('#p_cat,#u_p_cat').html('<option value=""> - </option>');

    $.get('<?= base_url('Vendor/GetProductsCategory') ?>',(result) => {

      result.forEach((row) => {
        $('#p_cat,#u_p_cat').append(`<option value="${row.CategoryID}">${row.Name}</option>`);
      });

  },'json');

}

function UpdateProductData() {

  $.post('<?= base_url('Vendor/UpdateProductsData') ?>', {
          p_name: $('#u_p_name').val(),
          p_cat:  $('#u_p_cat').val(),
          p_prize: $('#u_p_prize').val().replace(/,/,''),
          p_description: $('#u_p_description').val(),
          product_id: $('#u_produc_id').val(),
          p_stocks: $('#u_p_stocks').val(),
    }, function(response) {

      if(response.msg == 'success') {
        Swal.fire('Product Successfully Updated!','','success');
      } else {
        Swal.fire(response.msg,'','error');
      }

      $('#UpdateProduct').removeAttr('disabled').html('Save');
      GetProducts();

    }, 'json');
}

    $(function() {

      $('#btn_add_product').click(function() {
        $('#AddProductModal').modal('show');
      });

      var myDropzone = new Dropzone("#myDropzone", {
          url: '<?= base_url('Vendor/AddProducts') ?>',
          method: 'POST',
          paramName: "images",
          autoProcessQueue: false,
          uploadMultiple: true, // uplaod files in a single request
          parallelUploads: 100, // use it with uploadMultiple
          maxFilesize: 10, // MB
          maxFiles: 10,
          resizeWidth: 500,
          resizeHeight: 500,
          addRemoveLinks: true,
          dictFileTooBig: "File is to big",
          dictInvalidFileType: "Invalid File Type",
          dictCancelUpload: "Cancel",
          dictRemoveFile: "Remove",
          dictMaxFilesExceeded: "Max files Exceeded",
          dictDefaultMessage: "Click or Drop Files here to upload",
          acceptedFiles: "image/jpeg,image/png,image/gif",
          init: function () {
              var myDropzone = this;
              $("#SaveProduct").on("click", function (e) {

                 if ($('#p_name').val() == '' || $('#p_cat').val() == '' || $('#p_prize').val() == '') {
                    Swal.fire('Please fill out all fields','','error');
                    return false;
                 }

                 if(myDropzone.files == '') {
                    Swal.fire('Image is required','','error');
                    return false;
                 }

                 $('#SaveProduct').html('Please wait...');
                 $('#SaveProduct').attr('disabled', 'disabled');

                 myDropzone.processQueue();
            
              });

              this.on("sending", function (file, xhr, formData) {
                    formData.append('p_name', $('#p_name').val());
                    formData.append('p_cat', $('#p_cat').val());
                    formData.append('p_prize', $('#p_prize').val().replace(/,/,''));
                    formData.append('p_description', $('#p_description').val());
                    formData.append('p_stocks', $('#p_stocks').val());
                    
              });
              // on success
              this.on("successmultiple", function (file, data) {

                   if(data.msg == 'success') {
                      Swal.fire('Product Successfully Created!','','success');
                   } else {
                      Swal.fire(response.msg,'','error');
                   }

                   $('#SaveProduct').removeAttr('disabled').html('Save');
                   $('.form-control').val('');
                   GetProducts();
                  
                   myDropzone.removeAllFiles(file);
              });
            }
        });

        var UmyDropzone = new Dropzone("#UmyDropzone", {
          url: '<?= base_url('Vendor/UpdateProducts') ?>',
          method: 'POST',
          paramName: "images",
          autoProcessQueue: false,
          uploadMultiple: true, // uplaod files in a single request
          parallelUploads: 100, // use it with uploadMultiple
          maxFilesize: 10, // MB
          maxFiles: 10,
          resizeWidth: 500,
          resizeHeight: 500,
          addRemoveLinks: true,
          dictFileTooBig: "File is to big",
          dictInvalidFileType: "Invalid File Type",
          dictCancelUpload: "Cancel",
          dictRemoveFile: "Remove",
          dictMaxFilesExceeded: "Max files Exceeded",
          dictDefaultMessage: "Click or Drop Files here to upload",
          acceptedFiles: "image/jpeg,image/png,image/gif",
          init: function () {
              var UmyDropzone = this;

              $("#UpdateProduct").on("click", function (e) {

                 if ($('#u_p_name').val() == '' || $('#u_p_cat').val() == '' || $('#u_p_prize').val() == '') {
                    Swal.fire('Please fill out all fields','','error');
                    return false;
                 }

                 $('#UpdateProduct').html('Please wait...');
                 $('#UpdateProduct').attr('disabled', 'disabled');
                 

                  if (UmyDropzone.files != '') {
                     UmyDropzone.processQueue();
                  } else {
                     UpdateProductData();
                  }
            
              });

              this.on("sending", function (file, xhr, formData) {
                    formData.append('p_name', $('#u_p_name').val());
                    formData.append('p_cat', $('#u_p_cat').val());
                    formData.append('p_prize', $('#u_p_prize').val().replace(/,/,''));
                    formData.append('p_description', $('#u_p_description').val());
                    formData.append('product_id', $('#u_produc_id').val());
                    formData.append('p_stocks', $('#u_p_stocks').val());
              });
              // on success
              this.on("successmultiple", function (file, data) {

                   if(data.msg == 'success') {
                      Swal.fire('Product Successfully Updated!','','success');
                   } else {
                      Swal.fire(response.msg,'','error');
                   }

                   $('#UpdateProduct').removeAttr('disabled').html('Save');
                   GetProducts();
                   GetProductImage($('#u_produc_id').val());
                  
                   UmyDropzone.removeAllFiles(file);
              });
            }
        });

      GetProducts();

      GetCategory();
    });
</script>