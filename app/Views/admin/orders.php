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
          <div class="row">
              <div class="col-md-4">
                  <label>FILTER STATUS</label>
                  <select class="form-control" id="filter_status">
                      <option value="All"> All </option>
                      <option value="Pending"> Pending </option>
                      <option value="Canceled"> Canceled </option>
                      <option value="Completed"> Completed </option>
                      <option value="Approved"> Approved </option>
                  </select>
              </div>
          </div><br>
          <div class=" card">
              <div class=" card-body">
              <table class="table table-bordered" id="order_table">
                      <thead>
                          <tr>
                              <th>Vendor</th>
                              <th>Customer</th>
                              <th>Product Name</th>
                              <th>Payment Method</th>
                              <th>Unit Price</th>
                              <th>Quantity</th>
                              <th>Total Price</th>
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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXFAxSgXP7b5D25WEtjxkYqoWM2PjxaLg&callback=initMap&libraries=places"async defer></script>
      <!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBs11H9DodY0H-KqMH4DhA1HLxRRQs-j28&libraries=geometry,places,maps&v=weekly"
      defer
    ></script> -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    
  </body>
</html>

<div id="CancelOrderModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">CANCEL ORDER</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <label>Reason</label>
                    <textarea class="form-control" id="cancel_remarks" cols="5" rows="5"></textarea>
                    <input type="hidden" id="order_id">
                </div>
            </div>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-success" id="btn_cancel">Cancel Order</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="ViewOrDerModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">VIEW ORDER</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="print_div">
            <div class="row">
                <div class="col-md-12">
                    <label>Customer Name</label>
                    <input type="text" id="p_cust_name" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Product Code</label>
                    <input type="text" id="p_code" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Product Name</label>
                    <input type="text" id="p_name" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Payment Method</label>
                    <input type="text" id="p_method" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Unit price</label>
                    <input type="text" id="p_unit_price" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Quantity</label>
                    <input type="text" id="p_quantity" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Total Price</label>
                    <input type="text" id="p_total_price" class="form-control" readonly>
                </div>
                <div class="col-md-12">
                    <label>Deleivery Address</label>
                    <input type="text" id="p_address" class="form-control" readonly>
                </div>
                <div class="col-md-12">
                    <label>Cancel Reason <small>(this is for order that canceled)</small></label>
                    <input type="text" id="p_cancel_reason" class="form-control" readonly>
                </div>
            </div>

            <div class="row mt-3" style="display: none;">
              <div class="col-md-12">
                 <label>CUSTOMER LOCATION</label>
                  <div id="map" style="height: 300px;width: 100%;"></div>
              </div>
            </div>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-success" id="Print">Print</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->


    <div id="ApproveModal" class="modal">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">VERIFY ORDER</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <label>Customer Name</label>
                    <input type="text" id="v_p_cust_name" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Product Code</label>
                    <input type="text" id="v_p_code" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Product Name</label>
                    <input type="text" id="v_p_name" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Payment Method</label>
                    <input type="text" id="v_p_method" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Unit price</label>
                    <input type="text" id="v_p_unit_price" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Quantity</label>
                    <input type="text" id="v_p_quantity" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Total Price</label>
                    <input type="text" id="v_p_total_price" class="form-control" readonly>
                </div>
                <div class="col-md-12">
                    <label>Deleivery Address</label>
                    <input type="text" id="v_p_address" class="form-control" readonly>
                    <input type="hidden" id="v_order_id" class="form-control">
                </div>
            </div>

            <div class="row mt-3" style="display: none;">
              <div class="col-md-12">
              <label>CUSTOMER LOCATION</label>
                  <div id="Amap" style="height: 300px;width: 100%;"></div>
              </div>
            </div>

          </div><!-- modal-body -->
          <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
            <button type="button" class="btn btn-outline-success" id="btn_approved_order">Approved Order</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->


<script>

var order_table = $('#order_table').DataTable();
let map;

function Cancel(order_id) {
  $('#CancelOrderModal').modal('show');
  $('#order_id').val(order_id);
}

function ViewMap(lats, lang, elem, address = '') {

map = new google.maps.Map(elem, {
  center: { lat: lats, lng: lang },
  zoom: 10,
  disableDefaultUI: true
});

//     var icon = {
//     path: "M512.9 192c-14.9-.1-29.1 2.3-42.4 6.9L437.6 144H520c13.3 0 24-10.7 24-24V88c0-13.3-10.7-24-24-24h-45.3c-6.8 0-13.3 2.9-17.8 7.9l-37.5 41.7-22.8-38C392.2 68.4 384.4 64 376 64h-80c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h66.4l19.2 32H227.9c-17.7-23.1-44.9-40-99.9-40H72.5C59 104 47.7 115 48 128.5c.2 13 10.9 23.5 24 23.5h56c24.5 0 38.7 10.9 47.8 24.8l-11.3 20.5c-13-3.9-26.9-5.7-41.3-5.2C55.9 194.5 1.6 249.6 0 317c-1.6 72.1 56.3 131 128 131 59.6 0 109.7-40.8 124-96h84.2c13.7 0 24.6-11.4 24-25.1-2.1-47.1 17.5-93.7 56.2-125l12.5 20.8c-27.6 23.7-45.1 58.9-44.8 98.2.5 69.6 57.2 126.5 126.8 127.1 71.6.7 129.8-57.5 129.2-129.1-.7-69.6-57.6-126.4-127.2-126.9zM128 400c-44.1 0-80-35.9-80-80s35.9-80 80-80c4.2 0 8.4.3 12.5 1L99 316.4c-8.8 16 2.8 35.6 21 35.6h81.3c-12.4 28.2-40.6 48-73.3 48zm463.9-75.6c-2.2 40.6-35 73.4-75.5 75.5-46.1 2.5-84.4-34.3-84.4-79.9 0-21.4 8.4-40.8 22.1-55.1l49.4 82.4c4.5 7.6 14.4 10 22 5.5l13.7-8.2c7.6-4.5 10-14.4 5.5-22l-48.6-80.9c5.2-1.1 10.5-1.6 15.9-1.6 45.6-.1 82.3 38.2 79.9 84.3z",
//     fillColor: '#E32831',
//     fillOpacity: 1,
//     strokeWeight: 0,
//     scale: 0.04
// }

var marker = new google.maps.Marker({
    position:{ lat: lats, lng: lang },
    map: map,
    icon: '',
})

var infoWindow = new google.maps.InfoWindow({
    content: '<h5>'+address+'</h5>'
})

marker.addListener('click', function() {
    infoWindow.open(map, marker);
})

}

function ViewLocation(lat, lang, id) {
  var elem = document.getElementById(id);

  var apikey = '859be3b454774226ad7d6350ae390cf8';
  var Apiendpoint = 'https://api.opencagedata.com/geocode/v1/json';

  $.get(Apiendpoint+'?q='+lat+'%2C%20'+lang+'&key='+apikey+'&language=en&pretty=1', (response) => {
      var address = response.results[0].formatted;

      ViewMap(lat,lang,elem,address);
  }, 'json');
}

function ApprovedOrder(order_id) {

  $.post('<?= base_url('Admin/GetUserOrdersById') ?>',{order_id: order_id},(result) => {
    result.forEach((row) => {
        $('#v_p_cust_name').val(row.Customer);
        $('#v_p_code').val(row.OrderCode);
        $('#v_p_name').val(row.Name);
        $('#v_p_method').val(row.PaymentMethod);
        $('#v_p_unit_price').val(row.Prize);
        $('#v_p_quantity').val(row.Quantity);
        $('#v_p_total_price').val(row.Total_price);
        $('#v_p_address').val(row.Full_Address);

        ViewLocation(parseFloat(row.lat),parseFloat(row.lang),'Amap');
    }); 
  },'json');

  $('#v_order_id').val(order_id);

  $('#ApproveModal').modal('show');

}

function ViewOrder(order_id) {
  $.post('<?= base_url('Admin/GetUserOrdersById') ?>',{order_id: order_id},(result) => {
    result.forEach((row) => {
        $('#p_cust_name').val(row.Customer);
        $('#p_code').val(row.OrderCode);
        $('#p_name').val(row.Name);
        $('#p_method').val(row.PaymentMethod);
        $('#p_unit_price').val(row.Prize);
        $('#p_quantity').val(row.Quantity);
        $('#p_total_price').val(row.Total_price);
        $('#p_address').val(row.Full_Address);
        $('#p_cancel_reason').val(row.CancelRemarks);

        ViewLocation(parseFloat(row.lat),parseFloat(row.lang),'map');
        
    }); 
  },'json');
  
   $('#ViewOrDerModal').modal('show');
}

function GetOrders(status = 'All') {
      $.post('<?= base_url('Admin/GetUserOrders') ?>',{status: status},(result) => {

        order_table.clear().draw();

          result.forEach((row) => {
              var tr = $(`
                <tr>
                    <td>${row.company_name}</td>
                    <td>${row.Customer}</td>
                    <td>${row.Name}</td>
                    <td>${row.PaymentMethod}</td>
                    <td>${row.Prize}</td>
                    <td>${row.Quantity}</td>
                    <td>${row.Total_price}</td>
                    <td>${row.Status}</td>
                    <td width="10%">${row.Created_at}</td>
                    <td align="center">
                      <button class="btn btn-outline-primary" onclick="ViewOrder(${row.OrderID})"><span class="fas fa-search"></span></button>
                       
                    </td>
                </tr>
              `);
              order_table.row.add(tr);
          });

          order_table.draw();
        },'json');
    }



 $(function() {

   $('#filter_status').change(function() {
      var status = $(this).val();

      GetOrders(status);
   })

   $('#Print').click(function() {
          $('#print_div').printThis({
            header: "<h1>ORDER SUMMARY</h1>"
          });
        })

  $('#btn_approved_order').click(function() {
    $.post('<?= base_url('Admin/ApprovedOrder') ?>',{order_id: $('#v_order_id').val()},(response) => {
        if(response.msg == 'success') {
          swal.fire('Order Successfully Approved!', '', 'success');
          GetOrders();
        } else {
          swal.fire(response.msg, '', 'error');
        }
      },'json');
  })

  $('#btn_cancel').click(function() {
          if($('#cancel_remarks').val() == '') {
             swal.fire('Please fill out all fields', '', 'error');
             return false;
          }

          $.post('<?= base_url('Home/CacelOrder') ?>',{reason: $('#cancel_remarks').val(), order_id: $('#order_id').val()},(response) => {
            if(response.msg == 'success') {
              swal.fire('Orders Successfully Canceled!', '', 'success');
              GetOrders();
            } else {
              swal.fire(response.msg, '', 'error');
            }
          },'json');
      })
   
  GetOrders();
 
 })
 
</script>