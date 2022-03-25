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
        <h5>ORDERS</h5>
        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <div class="card card-dashboard-twentytwo">
              <div class="media">
                <div class="media-icon bg-success"><i class="typcn typcn-chart-line-outline"></i></div>
                <div class="media-body">
                  <h6 id="completed"></h6>
                  <span>Completed</span>
                </div>
              </div>
            </div><!-- card -->
          </div><!-- col -->

          <div class="col-sm-6 col-xl-3">
            <div class="card card-dashboard-twentytwo">
              <div class="media">
                <div class="media-icon bg-danger"><i class="typcn typcn-chart-line-outline"></i></div>
                <div class="media-body">
                <h6 id="cancelled"></h6>
                  <span>Cancelled</span>
                </div>
              </div>
            </div><!-- card -->
          </div><!-- col -->

          <div class="col-sm-6 col-xl-3">
            <div class="card card-dashboard-twentytwo">
              <div class="media">
                <div class="media-icon bg-warning"><i class="typcn typcn-chart-line-outline"></i></div>
                <div class="media-body">
                <h6 id="pending"></h6>
                  <span>Pending</span>
                </div>
              </div>
            </div><!-- card -->
          </div><!-- col -->

          <div class="col-sm-6 col-xl-3">
            <div class="card card-dashboard-twentytwo">
              <div class="media">
                <div class="media-icon bg-purple"><i class="typcn typcn-chart-line-outline"></i></div>
                <div class="media-body">
                <h6 id="delivery"></h6>
                  <span>For Delivery</span>
                </div>
              </div>
            </div><!-- card -->
          </div><!-- col -->

          <div class="col-sm-6 col-xl-3 mt-3">
            <div class="card card-dashboard-twentytwo">
              <div class="media">
                <div class="media-icon bg-purple"><i class="typcn typcn-chart-pie"></i></div>
                <div class="media-body">
                <h6 id="total_sales"></h6>
                  <span>Total Sales</span>
                </div>
              </div>
            </div><!-- card -->
          </div><!-- col -->

          <div class="col-sm-6 col-xl-3 mt-3">
            <div class="card card-dashboard-twentytwo">
              <div class="media">
                <div class="media-icon bg-purple"><i class="typcn typcn-chart-pie"></i></div>
                <div class="media-body">
                <h6 id="daily_sales"></h6>
                  <span>Daily Sales</span>
                </div>
              </div>
            </div><!-- card -->
          </div><!-- col -->

          <div class="col-sm-6 col-xl-3 mt-3">
            <div class="card card-dashboard-twentytwo">
              <div class="media">
                <div class="media-icon bg-info"><i class="typcn typcn-user"></i></div>
                <div class="media-body">
                <h6 id="total_followers"></h6>
                  <span>Total Followers</span>
                </div>
              </div>
            </div><!-- card -->
          </div><!-- col -->

          <div class="col-sm-6 col-xl-3 mt-3">
            <div class="card card-dashboard-twentytwo">
              <div class="media">
                <div class="media-icon bg-success"><i class="typcn typcn-star"></i></div>
                <div class="media-body">
                <h6 id="rate_ave"></h6>
                  <span>Rating Average</span>
                </div>
              </div>
            </div><!-- card -->
          </div><!-- col -->



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

<script>
  $(function() {
      $.get('<?= base_url('Vendor/CountOrders') ?>', function(response) {

        $('#completed').text(response[0].Completed == undefined ? 0 : response[0].Completed);
        $('#cancelled').text(response[0].Canceled == undefined ? 0 : response[0].Canceled);
        $('#pending').text(response[0].Pending == undefined ? 0 : response[0].Pending);
        $('#delivery').text(response[0].Approved == undefined ? 0 : response[0].Approved);
        $('#total_sales').html(response[0].total_sales == undefined ? '&#8369; ' + 0 : '&#8369; ' + response[0].total_sales);
        $('#daily_sales').html(response[0].daily_sales == null ? '&#8369; ' + 0 : '&#8369; ' + response[0].daily_sales);
        $('#total_followers').text(response[0].count_followers);
        $('#rate_ave').text(response[0].rate_average == null ? 0 : response[0].rate_average);
      }, 'json')
      
  });
 
</script>