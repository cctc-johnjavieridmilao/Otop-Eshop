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
 

    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
      <div class="container">
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">

          <!-- <h2 class="az-content-title">Dashboard</h2> -->

          <div class="az-content az-content-profile">
      <div class="container mn-ht-100p">
        <div class="content-wrapper w-100">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="product-nav-wrapper row">
                    <div class="col-lg-4 col-md-5">
                      <ul class="nav product-filter-nav">
                        <li class="active"><a href="#">COMPLETED</a></li>
                        <!-- <li><a href="#">FEATURED</a></li>
                        <li><a href="#">SALES</a></li> -->
                      </ul>
                    </div>
   
                  </div>

                  <table class="table table-bordered" id="order_table">
                      <thead>
                          <tr>
                              <th>Order Code</th>
                              <th>Product Name</th>
                              <th>Payment Method</th>
                              <th>Unit Price</th>
                              <th>Quantity</th>
                              <th>Total Price</th>
                              <th>Delivery Address</th>
                              <th>Status</th>
                              <th>Date</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- az-content -->
          
     
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
    <script src="<?= base_url('public/assets/js/printThis.js') ?>"></script>
    
  </body>
</html>

<div id="SummaryOrderModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">ORDER SUMMARY</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="print_div">
            <div class="row" >

            <div class="col-md-6">
               <label>ORDER CODE</label>
               <input id="order_code" class="form-control" readonly>
            </div>

            <div class="col-md-12 mt-2">
            <div class="card">
                  <div class="card-body">
                    <h5 class=" card-title">Delivery Address</h5>
                    <table class="table table-striped">
                      
                      <tbody id="load_address">
                            
                      </tbody>
                  </table>
                  </div>
              </div>

            </div>

            <div class="col-md-12">

            <div class="card">
                  <div class="card-body">
                    <h5 class=" card-title">Payment Method</h5>
                    <table class="table table-striped">
                      
                      <tbody id="load_payment_method">
                           
                      </tbody>
                  </table>
                  </div>
              </div>

            </div>

            <div class="col-md-12">

            <div class="card">
                     <div class="card-body">
                       <h5 class=" card-title">Products Ordered</h5>
                       <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>Product</th>
                                  <th>Unit Price</th>
                                  <th>Quantity</th>
                                  <th>Total Price</th>
                              </tr>
                          </thead>
                          <tbody id="load_cart_checkout_data">

                          </tbody>
                      </table>
                     </div>
                 </div>

             </div>

            </div>
            <br><br>
            <h5 style="float: right;">TOTAL PAYMENT:  <span>&#8369;</span> <span id="total_payment_checkout"></span></a></h5>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-warning" id="Print">Print</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

<script>

var order_table = $('#order_table').DataTable();



function ViewOrder(order_id) {

  $('#load_address').empty();
  $('#load_payment_method').empty();
  $('#load_cart_checkout_data').empty();

  $.post('<?=base_url('Home/GetOrderCompletedById') ?>', {order_id: order_id}, function(response) {

    response.forEach(function(row) {

      $('#load_address').append(`
          <tr>
                <td><input type="radio" checked class="address_check"></td>
                <td>${row.CustomerName} (${row.PhoneNumber}) ${row.Full_Address}</td>
            </tr>
      `);

      $('#load_payment_method').append(`
      <tr>
        <td><input type="radio" value="COD" checked></td>
        <td>${row.PaymentMethod == 'COD' ? 'Cash On Delivery' : row.PaymentMethod}</td>
     </tr>`);

      $('#load_cart_checkout_data').append(`
          <tr>
          <td>${row.Name}</td>
          <td>${row.Prize}</td>
          <td>${row.Quantity}</td>
          <td>${row.Total_price}</td>
      </tr>
    `);

    $('#total_payment_checkout').text(row.Total_price);
    $('#order_code').val(row.OrderCode)

    })

  })

  $('#SummaryOrderModal').modal('show');
}

function GetOrders() {
      $.post('<?= base_url('Home/GetOrders') ?>',{status: 'Completed'},(result) => {

        order_table.clear().draw();

          result.forEach((row) => {
              var tr = $(`
                <tr>
                    <td>${row.OrderCode}</td>
                    <td>${row.Name}</td>
                    <td>${row.PaymentMethod}</td>
                    <td>${row.Prize}</td>
                    <td>${row.Quantity}</td>
                    <td>${row.Total_price}</td>
                    <td  width="20%">${row.Full_Address}</td>
                    <td>${row.Status}</td>
                    <td width="15%">${row.Created_at}</td>
                    <td align="center"><button class="btn btn-outline-success" onclick="ViewOrder(${row.OrderID})"><span class="fas fa-search"></span></button></td>
                </tr>
              `);
              order_table.row.add(tr);
          });

          order_table.draw();
        },'json');
    }

    $(function() {

        $('#Print').click(function() {
          $('#print_div').printThis({
            header: "<h1>ORDER SUMMARY</h1>"
          });
        })

        GetOrders();
    })

 
</script>