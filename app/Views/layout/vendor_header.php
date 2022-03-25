<style>
   body {
        background: #f7f7f7;
    }
  .dropzone {
    min-height: 140px;
    border: 1px dashed #1ab394;
    background: white;
    padding: 20px 20px;
  }
  .az-footer {
      background-color: #5b47fb;
    }
    .az-footer div span {
      color: white;
    }
</style>

<div class="az-header">
      <div class="container">
        <div class="az-header-left">
          <!-- <a href="#" class="az-logo"><span></span> AGRI SUPPLIES</a> -->
          <img src="<?= base_url('public/assets/img/msme.jpg')?>" style="height: 60px;">
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
          <div class="az-header-menu-header">
            <a href="#" class="az-logo"><span></span> MSME</a>
            <a href="" class="close">&times;</a>
          </div><!-- az-header-menu-header -->
          <ul class="nav">
            <li class="nav-item">
              <a href="<?= base_url('Vendor/Dashboard') ?>" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('Vendor/Orders') ?>" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> Orders</a>
            </li>
              <li class="nav-item">
              <a href="" class="nav-link with-sub"><i class="typcn typcn-chart-bar-outline"></i> Products</a>
              <nav class="az-menu-sub">
                <a href="<?= base_url('Vendor/Products') ?>" class="nav-link">Manage Products</a>
                <a href="<?= base_url('Vendor/ProductCategory') ?>" class="nav-link">Producs Category</a>
              </nav>
            </li>
            <!-- <li class="nav-item">
              <a href="<?= base_url('Vendor/userManagement') ?>" class="nav-link"><i class="typcn typcn-chart-bar-outline"></i> User Management</a>
            </li> -->
            <li class="nav-item">
              <a href="<?= base_url('Vendor/chat') ?>" class="nav-link"><i class="typcn typcn-message"></i> Chat Support</a>
            </li>
          </ul>
        </div><!-- az-header-menu -->

        <div class="az-header-right">
        
          <div class="dropdown az-profile-menu">
            <a href="" class="az-img-user">
              <?php if(!empty(session('logo'))) :?>
                <img src="<?= base_url('public/profiles') ?>/<?=session('logo') ?>" class="img_profile" alt="">
              <?php else : ?>
                <img src="<?= base_url('public/assets/img/default_image.png') ?>" class="img_profile" alt="">
              <?php endif; ?>
            </a>
            <div class="dropdown-menu">
              <div class="az-dropdown-header d-sm-none">
                <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
              </div>
              <div class="az-header-profile">
                <div class="az-img-user">
                <?php if(!empty(session('logo'))) :?>
                <img src="<?= base_url('public/profiles') ?>/<?=session('logo') ?>" class="img_profile" alt="">
              <?php else : ?>
                <img src="<?= base_url('public/assets/img/default_image.png') ?>" class="img_profile" alt="">
              <?php endif; ?>
                </div><!-- az-img-user -->
                <h6><?= session('fname') ?></h6>
                <span><?= session('user_type') ?></span>
              </div><!-- az-header-profile -->
              <a href="<?= base_url('Vendor/Settings') ?>" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
              <a href="<?= base_url('Home/Logout') ?>" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->
    