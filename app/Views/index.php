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
    <link href="<?= base_url('public/assets/star-rating-svg-master/src/css/star-rating-svg.css') ?>" rel="stylesheet">
  </head>
  <style>
    .product-item-wrapper .product-item .card-body .product-img-outer .product_image {
       height: 150px !important;
    }
  </style>


  <body>

    <?= $this->include('layout/user_header') ?>
 
   <div class="az-content az-content-profile">
      <div class="container-fluid mn-ht-100p">
        <div class="content-wrapper w-100">
          <div class="row">
              <div class="col-md-8">
                 <div class="input-group">
                    <input type="text" class="form-control" id="SearchKey" placeholder="Search Products and Category">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" onclick="SearchItems()" type="button"><i class="fa fa-search"></i></button>
                    </span>
                 </div>
              </div>
              <div class="col-md-4">
                 <button class="btn btn-primary btn-block">DATE: <?=date('Y-m-d H:i:s') ?></button>
              </div>
          </div>
         
          <div class="row mt-2">
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <div class="product-nav-wrapper row">
                    <div class="col-lg-4 col-md-5">
                      <ul class="nav product-filter-nav">
                        <li class="active"><a href="">PRODUCTS</a></li>
                      </ul>
                    </div>
                    <div class="col-lg-8 col-md-7 product-filter-options">
                      <ul class="account-user-info ml-auto"></ul>
                      <ul class="account-user-link d-none d-lg-block"></ul>
                      <ul class="account-user-actions">
                        
                        <li>
                          <a href="#" onclick="ViewCart()"><i class="typcn icon typcn-shopping-cart"></i>
                            <div class="badge badge-pill badge-primary" id="card_count">0</div>
                          </a>
                        </li>
                        <li><a href="#" id="cart_total"><span>&#8369;</span> 0.00</a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="row product-item-wrapper" id="load_products">



                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                  <div class="product-nav-wrapper row">
                    <div class="col-lg-4 col-md-5">
                      <ul class="nav product-filter-nav">
                        <li class="active"><a href="">VENDORS</a></li>
                      </ul>
                    </div>
                    <div class="col-lg-8 col-md-7 product-filter-options">
                      <ul class="account-user-info ml-auto"></ul>
                      <ul class="account-user-link d-none d-lg-block"></ul>
                    </div>
                  </div>
                  <div class="row product-item-wrapper" id="load_vendors">

                    

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
      </div>
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('public/assets/js/jquery-3.3.1.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/azia.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap-4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/sweetalert2.js') ?>"></script>
    <script src="<?= base_url('public/assets/star-rating-svg-master/src/jquery.star-rating-svg.js') ?>"></script>
    
    
  </body>
</html>



    <div id="ViewCartModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">VIEW CART</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                 <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     <tbody id="load_cart_data">

                    </tbody>
                    <tfoot>
                      <tr>
                          <td colspan="4" id="total_checkout"></td>
                      </tr>
                    </tfoot>
                 </table>
            </div>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-warning" id="btn_check_out">Check Out</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="CheckOutModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">CHECK OUT</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">

            <div class="col-md-12">

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
                      
                      <tbody id="load_address">
                            <tr>
                                <td><input type="radio" value="COD" id="payment_type_check_id" class="payment_type_check"></td>
                                <td>Cash On Delivery</td>
                            </tr>
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
            <button type="button" class="btn btn-outline-warning" id="PlaceOrder">Place Order</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->


    <div id="ViewProductModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">VIEW PRODUCT</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                     <label>Product Name</label>
                     <input type="text" class="form-control" id="u_p_name" readonly>
                </div>
                <div class="col-md-6">
                     <label>Category</label>
                     <input type="text" class="form-control" id="u_p_cat" readonly>
                </div>
                <div class="col-md-6">
                     <label>Prize</label>
                     <input type="text" class="form-control" id="u_p_prize" readonly>
                </div>
                <div class="col-md-6">
                     <label>Stocks</label>
                     <input type="text" class="form-control" readonly id="u_p_stocks">
                </div>
                <div class="col-md-12">
                     <label>Description</label>
                     <textarea id="u_p_description" class="form-control" cols="4" rows="4" readonly></textarea>
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
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="ViewVendorProfile" class="modal">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">VIEW VENDOR DETAILS</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <center>
               <img src="<?= base_url('public/assets/img/default_image.png') ?>" id="vendor_logo" class="product_image" style="height: 150px;border-radiusL 50%;" />
            </center>
            <div class="row">
                <div class="col-md-12">
                      <div id="col-md-12">
                          <label>Business Name: </label>
                          <input type="text" readonly id="business_name" class="form-control">
                      </div>

                      <div id="col-md-12">
                          <label>Owner Name: </label>
                          <input type="text" readonly id="owner_name" class="form-control">
                      </div>

                      <div id="col-md-12">
                          <label>Location: </label>
                          <input type="text" readonly id="business_location" class="form-control">
                      </div>
                </div>
            </div>
  
          </div><!-- modal-body -->
          <!-- <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
          </div> -->
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
<script>

function GetProductImage(product_id) {
  $('#images').empty();
  $.post('<?= base_url('Admin/GetProductImage') ?>', {product_id: product_id}, function(response) {
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

function ViewProduct(product_id) {
  $.post('<?= base_url('Admin/GetProductById') ?>', {product_id: product_id}, function(response) {
      $('#u_p_name').val(response[0].Name);
      $('#u_p_cat').val(response[0].Catname);
      $('#u_p_prize').val(response[0].Prize);
      $('#u_p_description').val(response[0].Description);
      $('#u_p_stocks').val(response[0].stocks);
  }, 'json');
   
  GetProductImage(product_id);
  $('#ViewProductModal').modal('show');
}

var quantity = 1;

function AddQuantity(id) {

  quantity++;

  $('#load_products').find('#quantity_'+id).val(quantity);

}

function Lessquantity(id) {

    if(quantity <= 1) {
      quantity = 1;
      return false;
    }

    quantity--;

    $('#load_products').find('#quantity_'+id).val(quantity);

}
function DeleteCartItem(i) {

  var cart_items = JSON.parse(localStorage.getItem('cart')) || [];

  if(confirm('Are you sure you want to delete this item?') == false) {
     return false;
  }

  cart_items.splice(i,1);

  localStorage.setItem('cart', JSON.stringify(cart_items));

  ViewCart();
  GetCart();
}

function ViewCart() {

  var cart_items = JSON.parse(localStorage.getItem('cart')) || [];


  $('#load_cart_data,#load_cart_checkout_data').empty();

  cart_items.forEach(function(row, index) {

  var i = index + 1;

    $('#load_cart_data').append(`
            <tr id="tr_${i}">
                <td>${row.name}</td>
                <td>${row.prize}</td>
                <td>${row.quantity}</td>
              <td id="total_price_row_${i}">${row.total_prize}</td>
              <td>
                <button class="btn btn-outline-danger" onclick="DeleteCartItem(${index})"> Trash </button>
                <button class="btn btn-outline-primary" onclick="ViewProduct(${row.product_id})"> View </button>
              </td>
            </tr>
      `);
     
  });



  //  $.get('<?= base_url('Home/GetCartData') ?>', function(response) {
  //       response.forEach(function(row) {
  //         $('#load_cart_data').append(`
  //           <tr id="tr_${row.CartID}">
  //               <td>${row.Name}</td>
  //               <td>${row.Prize}</td>
  //               <td><div class="input-group mb-3">
  //               <div class="input-group-prepend">
  //                 <button class="btn btn-outline-danger" onclick="Lessquantity(${row.CartID},${row.Prize},${row.ProductID})"> - </button>
  //               </div>
  //               <input type="text" class="form-control" id="quantity_${row.CartID}" value="${row.Quantity}" readonly>
  //               <div class="input-group-append">
  //               <button class="btn btn-outline-success" onclick="Addquantity(${row.CartID},${row.Prize},${row.ProductID})"> + </button>
  //               </div>
  //             </div></td>
  //             <td id="total_price_row_${row.CartID}">${row.Total_price}</td>
  //             <td>
  //               <button class="btn btn-outline-danger" onclick="DeleteCartItem(${row.CartID})"> Trash </button>
  //               <button class="btn btn-outline-primary" onclick="ViewProduct(${row.ProductID})"> View </button>
  //             </td>
  //           </tr>
  //         `);

  //         $('#load_cart_checkout_data').append(`
  //              <tr>
  //               <td>${row.Name}</td>
  //               <td>${row.Prize}</td>
  //               <td>${row.Quantity}</td>
  //               <td>${row.Total_price}</td>
  //           </tr>
  //         `);
  //       })
  //  }, 'json');

   $('#ViewCartModal').modal('show');
}

function GetCart() {

  var cart_items = JSON.parse(localStorage.getItem('cart')) || [];
  var total_prize = 0.00;
  var total_quantity = 0;


  cart_items.forEach(function(row) {
      total_prize += parseFloat(row.total_prize);
      total_quantity += parseInt(row.quantity);
  });

  $('#cart_total').html('<span>&#8369;</span> ' + total_prize);
  $('#card_count').text(cart_items.length);
  $('#total_checkout').html(`Total (Items: ${total_quantity}): ${total_prize}`);
  $('#total_payment_checkout').text(total_prize);

  // $.get('<?= base_url('Home/GetCart') ?>', function(response) {

  //     $('#cart_total').html('<span>&#8369;</span> ' + response.total_prize);
  //     $('#card_count').text(response.total_cart)
  //     $('#total_checkout').html(`Total (Items: ${response.totalQuantity}): ${response.total_prize}`);
  //     $('#total_payment_checkout').text(response.total_prize);
  // }, 'json');
    
}

function AddToCart(product_id, prize, name) {

  var items = JSON.parse(localStorage.getItem('cart')) || [];

  var product_id = product_id;
  var prize = prize;
  var quantity = parseInt($('#load_products').find('#quantity_'+product_id).val());
  var total_prize = (prize * quantity);

  if(JSON.stringify(items).includes(product_id)) {

    items.map(function(val, i) {
      var old_quntity = val.quantity;
      var new_quantity = (old_quntity + quantity);
      if(val.product_id == product_id) {
          items[i].prize = prize;
          items[i].quantity = new_quantity;
          items[i].total_prize = (prize * new_quantity);
      }
    });

  } else {

    items.push({
        name: name,
        product_id: product_id,
        prize: prize,
        quantity: quantity,
        total_prize: total_prize
    });

  }

  console.log(items);

  swal.fire('Successfully Added To Cart!','','success');

  localStorage.setItem('cart', JSON.stringify(items));

  setTimeout(() => {
    GetCart();
  }, 500);
 
}

function GetAddress() {
  $('#load_address').empty();
  $.get('<?= base_url('Home/GetUserAddress') ?>', function(response) {
    var counter = 0;
      response.forEach(function(row) {
        counter++;
         $('#load_address').append(`
            <tr>
                <td><input type="radio" id="address_check_${counter}" ${row.IsDefault == 1 ? 'checked' : ''} class="address_check" value="${row.AddresID}"></td>
                <td>${row.CustomerName} (${row.PhoneNumber}) ${row.Full_Address}</td>
                <td>${row.IsDefault == 1 ? 'Default' : ''}</td>
            </tr>
         `);
      });
  }, 'json');
}

  function GetProducts(key = '') {
    $('#load_products').empty();

    $.post('<?= base_url('Home/GetProducts') ?>',{key: key},(result) => {

      if(result.length > 0) {

        result.forEach((row) => {
          $('#load_products').append(`
          <div class="col-lg-4 col-md-6 col-sm-6 col-12 product-item">
              <div class="card">
                <div class="card-body">
                  <div class="action-holder">
                  <!-- <div class="sale-badge bg-success"></div>  -->
                    <!-- <span class="favorite-button"><i class="typcn icon typcn-heart-outline"></i></span> -->
                  </div>
                  <div class="product-img-outer">
                      <img class="product_image" src="<?= base_url() ?>/public/uploads/${row.FileName}" alt="prduct image">
                  </div>
                  <p class="product-title">${row.Name}</p>
                  <p class="product-price" style="font-size: 13px;"><span>&#8369;</span> ${row.Prize}</p>
                  <p style="font-weight: bold;">Category: ${row.Catname}</p><br>
                  <p style="font-weight: bold;">Stocks: ${row.stocks == 0 ? '<span class="badge badge-danger">No Available stocks</span>' : `<span class="badge badge-success">${row.stocks}</span>`}</p><br>
                  <button class="btn btn-outline-success" ${row.stocks == 0 ? 'disabled' : ''} onclick="AddToCart(${row.ProducID},${row.Prize},'${row.Name}')"><i class="typcn icon typcn-shopping-cart"></i> Add to cart</button>
                  <button class="btn btn-outline-primary" onclick="ViewProduct(${row.ProducID})"><i class="typcn icon typcn-zoom"></i> View</button>
   
                </div>

                <center>
                    <div class="input-group" style="width: 85%">
                      <div class="input-group-prepend">
                          <button class="btn btn-outline-danger" onclick="Lessquantity(${row.ProducID})"> - </button>
                      </div>
                      <input type="text" class="form-control" id="quantity_${row.ProducID}" value="1" readonly>
                      <div class="input-group-append">
                      <button class="btn btn-outline-success" onclick="AddQuantity(${row.ProducID})"> + </button>
                      </div>
                  </div>
                  </center>

                  <br>
                  <center><div class="my-rating-7" style="display: flex;width: 150px;"></div></center>
               
              </div>
              
            </div>
          `).promise().done(function() {
            $(".my-rating-7").starRating({
               readOnly: true,
               initialRating: row.avg_rates,
            });
          })
      });

      } else {
        $('#load_products').append(`
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 product-item">
                    <div class="card">
                      <div class="card-body">
                         <h4>No products found!</h4>
                        </div>
                    </div>
                    
                  </div>
                `)
      }

    },'json');
  }

  function SearchItems() {  
       var SearchKey = $('#SearchKey').val();
      
       GetProducts(SearchKey);

  }

  function followVendor(id) {

    var user = '<?=session('u_id') ?>';

    if(user == '' || user == null) {
      window.location.href = '<?=base_url('Home/loginpage') ?>';
    }
  

    $.post('<?=base_url('Home/FollowVendor') ?>', {vendor: id}, function(result) {
        if(result.msg == 'success') {
          GetVendors();
        }
    });
     
  }

  function loadproducts(id) {
    $('#load_products').empty();

      $.post('<?= base_url('Home/GetProductsByVendor') ?>',{vendor: id},(result) => {

        if(result.length > 0) {

              result.forEach((row) => {
                $('#load_products').append(`
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 product-item">
                    <div class="card">
                      <div class="card-body">
                        <div class="action-holder">
                        <!-- <div class="sale-badge bg-success"></div>  -->
                          <!-- <span class="favorite-button"><i class="typcn icon typcn-heart-outline"></i></span> -->
                        </div>
                        <div class="product-img-outer">
                            <img class="product_image" src="<?= base_url() ?>/public/uploads/${row.FileName}" alt="prduct image">
                        </div>
                        <p class="product-title">${row.Name}</p>
                        <p class="product-price" style="font-size: 13px;"><span>&#8369;</span> ${row.Prize}</p>
                        <p style="font-weight: bold;">Category: ${row.Catname}</p><br>
                        <p style="font-weight: bold;">Stocks: ${row.stocks == 0 ? '<span class="badge badge-danger">No Available stocks</span>' : `<span class="badge badge-success">${row.stocks}</span>`}</p><br>
                        <button class="btn btn-outline-success" ${row.stocks == 0 ? 'disabled' : ''} onclick="AddToCart(${row.ProducID},${row.Prize})"><i class="typcn icon typcn-shopping-cart"></i> Add to cart</button>
                        <button class="btn btn-outline-primary" onclick="ViewProduct(${row.ProducID})"><i class="typcn icon typcn-zoom"></i> View</button>
                        
                      </div>

                      <center>
                        <div class="input-group" style="width: 85%">
                          <div class="input-group-prepend">
                              <button class="btn btn-outline-danger" onclick="Lessquantity(${row.ProducID})"> - </button>
                          </div>
                          <input type="text" class="form-control" id="quantity_${row.ProducID}" value="1" readonly>
                          <div class="input-group-append">
                          <button class="btn btn-outline-success" onclick="AddQuantity(${row.ProducID})"> + </button>
                          </div>
                      </div>
                      </center>

                      <br>
                      <center><div class="my-rating-7" style="display: flex;width: 150px;"></div></center>
                    
                    </div>
                    
                  </div>
                `).promise().done(function() {
                  $(".my-rating-7").starRating({
                    readOnly: true,
                    initialRating: row.avg_rates,
                  });
                })
            });
                
        } else {

          $('#load_products').append(`
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 product-item">
                    <div class="card">
                      <div class="card-body">
                         <h4>No products found!</h4>
                        </div>
                    </div>
                    
                  </div>
                `)

        }

      },'json');
  }

  function ViewVendorDetails(id) {

    $.post('<?=base_url('Home/GetVendorsById') ?>', {id: id}, function(result) {

      console.log(result);
      
      var row = result[0];

      $('#business_name').val(row.company_name);
      $('#owner_name').val(row.owner_name);
      $('#business_location').val(row.company_address);

      if(row.logo == null) {
        $('#vendor_logo').attr('src', '<?= base_url('public/assets/img/default_image.png') ?>');
      } else {
        $('#vendor_logo').attr('src', '<?= base_url('public/profiles') ?>/'+row.logo);
      }


    }, 'json');

    // vendor_logo

    $('#ViewVendorProfile').modal('show');
}


  function GetVendors() {

    $('#load_vendors').empty();

    $.get('<?=base_url('Home/GetVendors') ?>').then(function(result) {
        if(result.length > 0) {
           result.forEach(function(row) {

            $('#load_vendors').append(`
              <div class="col-md-12">

                <div class="az-list-item">
                <div>
                <h6>${row.company_name}</h6>
                    <a href="#" class="" onclick="followVendor(${row.RecID})" id="follow_unfollow">${row.isfollowed == 0 ? '<span class="badge badge-pill badge-primary" style="color: white;">Follow</span>' : '<span class="badge badge-pill badge-success" style="color: white;">Followed <span style="color: white;" class="fas fa-check"></span></spa></span>'}</a>  
                    <span class="badge badge-pill badge-primary" style="color: white;">Followers (${row.followers_count})</span>
                    <span class="badge badge-pill badge-warning" onclick="loadproducts(${row.RecID})" style="color: white;cursor: pointer">View Products</span>
                   
                </div>
                <div>
                <a href="#" class="az-img-user" onclick="ViewVendorDetails(${row.RecID})"> 

                ${row.logo == null ? `<img src="<?= base_url('public/assets/img/default_image.png') ?>"  class="img_profile" alt="">` 
                  : `<img src="<?= base_url('public/profiles') ?>/${row.logo}"  class="img_profile" alt="">`}
                    
                    
                </a>
                </div>
                </div>

                </div>`);

           });
        }
    });

    
  }

 $(function() {

  GetVendors();

  $(document).on('change', '.address_check', function() {
     $('.address_check').not(this).prop('checked', false);
  });

    $('#btn_check_out').click(function() {

      window.location.href = '<?=base_url('Home/loginpage') ?>';

      //  if($('#card_count').text() == 0) {
      //      swal.fire('Empty Cart!', '', 'error');
      //      return false;
      //  }

      //  $('#btn_check_out').attr('disabled','disabled').html('Please wait...');

      //  setTimeout(() => {
      //    $('#ViewCartModal').modal('hide');
      //    $('#CheckOutModal').modal('show');
      //    GetAddress();
         
      //   $('#btn_check_out').removeAttr('disabled').html('Check Out');
      //  },2000);
    });

    $('#PlaceOrder').click(function() {

        if($('#payment_type_check_id').prop('checked') == false) {
           swal.fire('Please select payment method!', '', 'error');
           return false;
        }
        if($('#load_address').find('.address_check:checked').length == 0) {
           swal.fire('Please select your delivery address!', '', 'error');
           return false;
        }

        $('#PlaceOrder').attr('disabled','disabled').html('Please wait...');

        $.post('<?= base_url('Home/CheckOut') ?>', {
          paymentMethod: $('#payment_type_check_id').val(),
          addressID: $('#load_address').find('.address_check:checked').val()
        }, function(response) {
            if(response.msg == 'success') {
              swal.fire('Orders Successfully Purchased!', '', 'success');
              
              setTimeout(() => {
                 window.location.href = 'Home/Pending';
              },2000);
            } else {
              swal.fire(response.msg, '', 'error');
            }
            $('#PlaceOrder').removeAttr('disabled').html('Place Order');
            GetCart();
             
        }, 'json');

       
    });

    GetProducts();
    GetCart()
 });
</script>