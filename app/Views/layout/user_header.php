<!-- <style>
   body {
        background-image: linear-gradient(to bottom, #00b09b, #96c93d) !important;
    }
</style> -->

<style>
   body {
        background: #f7f7f7;
    }
    .az-footer {
      background-color: #5b47fb;
    }
    .az-footer div span {
      color: white;
    }
</style>
<div class="az-header" style="background-color: #f7f7f7;">
      <div class="container">
        <div class="az-header-left">
          <img src="<?= base_url('public/assets/img/otop.jpg')?>" style="height: 50px;border-radius: 50%">&nbsp;&nbsp;
          <img src="<?= base_url('public/assets/img/DTI.jpg')?>" style="height: 50px;border-radius: 50%">&nbsp;&nbsp;
          <img src="<?= base_url('public/assets/img/msme.jpg')?>" style="height: 50px;border-radius: 50%">
          <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div><!-- az-header-left -->
        <div class="az-header-menu">
          <div class="az-header-menu-header">
            <a href="#" class="az-logo"><span></span> OTOP E-SHOP</a>
            <a href="" class="close">&times;</a>
          </div><!-- az-header-menu-header -->
          <ul class="nav">
            <li class="nav-item">
              <a href="<?=base_url('Home') ?>" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Home</a>
            </li>

            <?php if(empty(session('u_id'))) :?>


              <?php else : ?>
                <li class="nav-item">
                  <a href="" class="nav-link with-sub"><i class="typcn typcn-chart-bar-outline"></i> My purchases</a>
                  <nav class="az-menu-sub">
                    <a href="<?=base_url('Home/Pending') ?>" class="nav-link">Pending</a>
                    <a href="<?=base_url('Home/Canceled') ?>" class="nav-link">Canceled</a>
                    <a href="<?=base_url('Home/ToReceive') ?>" class="nav-link">To Receive</a>
                    <a href="<?=base_url('Home/Completed') ?>" class="nav-link">Completed</a>
                  </nav>
                </li>

              <?php endif; ?>
           
          

            <li class="nav-item">
              <a href="<?=base_url('Home/ChatSupport') ?>" class="nav-link"><i class="typcn typcn-message"></i> Chat Support</a>
            </li>

            <li class="nav-item">
              <a href="<?=base_url('Home/AboutUs') ?>" class="nav-link"><i class="typcn typcn-info"></i> About us</a>
            </li>

            <li class="nav-item">
              <a href="<?=base_url('Home/ContactUs') ?>" class="nav-link"><i class="typcn typcn-phone"></i> Contact us</a>
            </li>
          </ul>
        </div><!-- az-header-menu -->

        <div class="az-header-right">
        
          <div class="dropdown az-profile-menu">
            <a href="#" class="az-img-user">
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
             

              <?php if(empty(session('u_id'))) :?>
                <a href="<?= base_url('Home/register') ?>" class="dropdown-item"><i class="typcn typcn-user"></i> Create Account</a>
                <a href="<?= base_url('Home/loginpage') ?>" class="dropdown-item" onclick="Logout()"><i class="typcn typcn-power-outline"></i> Sign In</a>

              <?php else : ?>
                <a href="<?= base_url('Home/Profile') ?>" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                <a href="<?= base_url('Home/Logout') ?>" class="dropdown-item" onclick="Logout()"><i class="typcn typcn-power-outline"></i> Sign Out</a>

              <?php endif; ?>
             
            </div><!-- dropdown-menu -->
          </div>
        </div><!-- az-header-right -->
      </div><!-- container -->
    </div><!-- az-header -->

<script>

  function Logout() {
    var user_id = "<?= session('u_id') ?>";

    database.ref('users').child(user_id).update({
        isLogin: 0
    });

     setTimeout(() => {
        window.location.href = "<?= base_url('Home/Logout') ?>";
     },2000);

  }
      
</script>
