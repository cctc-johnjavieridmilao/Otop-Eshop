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
    <link href="<?= base_url('public/assets/css/lightslider.min.js') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.css" rel="stylesheet">
  </head>

  <style>

    #azChatBodyHide {
      display: none;
    }

    @media (max-width: 767.98px) {
      #azChatBodyHide {
          display: block;
      }
    }
</style>

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

   <div class="az-content az-content-profile">
      <div class="container mn-ht-100p">
        <div class="content-wrapper w-100">
        <div class="az-content az-content-app pd-b-0">
      <div class="container">
        <div class="az-content-left az-content-left-chat">

          <div class="az-chat-contacts-wrapper">
            <label class="az-content-label az-content-label-sm">PEOPLE</label>
            <input type="text" class="form-control" id="search_people" placeholder="Search People">
            
          </div><!-- az-chat-active-contacts -->

          <div id="azChatList" class="az-chat-list">
            


          </div><!-- az-chat-list -->

        </div><!-- az-content-left -->
        <div class="az-content-body az-content-body-chat">
          <div class="az-chat-header">
            <div class="az-img-user"> <img src="<?= base_url('public/assets/img/default_image.png') ?>" alt=""></div>
            <div class="az-chat-msg-name">
              <h6 id="user_header">None</h6>
              <!-- <small>Last seen: 2 minutes ago</small> -->
            </div>

            <button id="azChatBodyHide" style="float: right;" class="btn btn-default">Close</button>
          </div><!-- az-chat-header -->
          <div id="azChatBody" class="az-chat-body">
            <div class="content-inner" id="chat_body">

                
            </div><!-- content-inner -->
          </div><!-- az-chat-body -->

          <div class="az-chat-footer">
            <input type="text" class="form-control" placeholder="Type your message here..." id="chat_msg">
             <input type="file" accept="image/*" style="display: none;" id="file">
             <a href="javascript:void(0)" id="choose_file" class="az-msg-send"><i class="far fa-file"></i></a>
             <a href="javascript:void(0)" id="save_to_fire_base" class="az-msg-send ml-2"><i class="far fa-paper-plane"></i></a>
          </div>
        </div>
      </div><!-- container -->
    </div><!-- az-content -->

    <input id="user_id" type="hidden">

      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('public/assets/js/jquery-3.3.1.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/azia.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/bootstrap-4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/sweetalert2.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/perfect-scrollbar.min.js') ?>"></script>
    <script src="<?= base_url('public/assets/js/lightslider.min.js') ?>"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
        https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js"></script>
    
    
  </body>
</html>

<script>

function uniqueID() {
    return Math.floor(Math.random() * Date.now())
}

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  // var firebaseConfig = {
  //   apiKey: "AIzaSyDNONyY-kENbRs6Zm9w_Rnatw2YaA9E-T4",
  //   authDomain: "messanging-app-b86eb.firebaseapp.com",
  //   databaseURL: "https://messanging-app-b86eb-default-rtdb.asia-southeast1.firebasedatabase.app",
  //   projectId: "messanging-app-b86eb",
  //   storageBucket: "messanging-app-b86eb.appspot.com",
  //   messagingSenderId: "435495229801",
  //   appId: "1:435495229801:web:37d11bfbcf8e8e3f3cc5f8",
  //   measurementId: "G-PBVRL2YG2M"
  // };

  const firebaseConfig = {
    apiKey: "AIzaSyAEhCo0j2_jlPMU6yBMCTFC_JnkRwkPmkU",
    authDomain: "otopeshop-360c7.firebaseapp.com",
    databaseURL: "https://otopeshop-360c7-default-rtdb.asia-southeast1.firebasedatabase.app/",
    projectId: "otopeshop-360c7",
    storageBucket: "otopeshop-360c7.appspot.com",
    messagingSenderId: "927011315173",
    appId: "1:927011315173:web:a0d293ea084e869d4ce30c",
    measurementId: "G-YXZZYZS1R8"
 };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  const database = firebase.database();



  $('#save_to_fire_base').click(function() {
     var to_user = $('#user_id').val();
     var chat_msg = $('#chat_msg').val();
     var random_id = uniqueID();
    
  
     if($('#chat_msg').val() == '') {
         return false;
     }

    database.ref('/message/'+random_id).set({
        receive_by: to_user,
        username: $('#user_header').text(),
        send_by: '<?= session('u_id') ?>',
        send_by_fullname: '<?= session('fname') ?> ' +'  '+ ' <?= session('lastname') ?>',
        chat_msg: chat_msg,
        date: Date.now(),
        isView: 0,
    });

    // database.ref('message').orderByChild('send_by').equalTo(to_user).on('value', (snap) => {
    //   var count = 0;
    
    //   snap.forEach(function(elem) {
    //      if(elem.val().isView == 0) {
    //        count++;
    //      }
    //   })

    //   database.ref('users').child(to_user).update({
    //       Messages: count,
    //       NewMessage: chat_msg
    //   });
    
    // });


    $('#chat_msg').val('');
  });

    function ViewChat(user_id,name) {

      var messages = database.ref('message').orderByChild('date');

        messages.on("value", function(snapshot) {

            $('#chat_body').empty();
            //var count_unseen = 0;


                snapshot.forEach(function(element) {

                    var chat_pos = '';

                    if(element.val().send_by == '<?=session('u_id') ?>') {
                        chat_pos = 'flex-row-reverse';
                    } else {
                        chat_pos = '';
                    }
        
                    if((element.val().receive_by == user_id || element.val().receive_by == '<?=session('u_id') ?>') 
                    && (element.val().send_by == user_id || element.val().send_by == '<?=session('u_id') ?>')) {

                        //$('#chat_body').empty()

                        $('#chat_body').append(`
                            <div class="media ${chat_pos}">
                                <div class="az-img-user"><img src="<?= base_url('public/assets/img/default_image.png') ?>"></div>
                                <div class="media-body">
                                <div class="az-msg-wrapper">
                                    ${element.val().chat_msg == 'Image' ? `<a href="<?= base_url('public/message_uploads') ?>/${element.val().file}" target="_blank"><img class="img-thumbnail" width="250px" height="180px"  src="<?= base_url('public/message_uploads') ?>/${element.val().file}"></a>` : element.val().chat_msg}
                                </div><!-- az-msg-wrapper -->
                                <div><span>${new Date(element.val().date).toUTCString()}</span> <a href=""><i class="icon ion-android-more-horizontal"></i></a></div>
                                </div><!-- media-body -->
                            </div><!-- media -->
                        `);   
                      
                                  
                    } 

                });

        });

        messages.once("value", function(snapshot) {

            snapshot.forEach(function(element) {

              if((element.val().receive_by == user_id || element.val().receive_by == '<?=session('u_id') ?>') 
                    && (element.val().send_by == user_id || element.val().send_by == '<?=session('u_id') ?>')) {

                    database.ref('message').child(element.key).update({
                      isView: 1
                    });
                              
                } 
            });

        });

        messages.limitToLast(1).once("value", function(snapshot) {

          snapshot.forEach(function(element) {

            if((element.val().receive_by == user_id || element.val().receive_by == '<?=session('u_id') ?>') 
                    && (element.val().send_by == user_id || element.val().send_by == '<?=session('u_id') ?>')) {

              database.ref('users').child('<?=session('u_id') ?>').update({
                  Messages: 0,
                  NewMessage: element.val().chat_msg
              });
                        
            } 
          });

        })

        $('#azChatBody').scrollTop(0); // RESET

        setTimeout(() => {
          $('#azChatBody').scrollTop($('#chat_body').prop('scrollHeight'));
        },500)

        $('#user_id').val(user_id);
        $('#user_header').html(name);
    }


    $(function() {

      $('#search_people').keyup(function() {
         var filter = $(this).val().toUpperCase();
         var lists = document.querySelector('#azChatList');
         var media_class = lists.getElementsByClassName('media');


         // Loop through all list items, and hide those who don't match the search query
          for (i = 0; i < media_class.length; i++) {
            span = media_class[i].getElementsByTagName("span")[0];
            txtValue = span.textContent || span.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              media_class[i].style.display = "";
            } else {
              media_class[i].style.display = "none";
            }
          }
      });

      var users = database.ref('users').orderByChild('date');

      users.on("value", function(snapshot) {

        $('#azChatList').empty();

          snapshot.forEach(function(element) {

            var key = element.key;

              if(element.val().user_type != 'user' && element.val().name != undefined) {
                $('#azChatList').append(`
                        <div class="media ${element.val().Messages == 0 ? '' : 'new'}" onclick="ViewChat(${key},'${element.val().name}')">
                            <div class="az-img-user ${element.val().isLogin == 1 ? 'online' : ''}">
                                <img src="<?= base_url('public/assets/img/default_image.png') ?>" alt="">
                               ${element.val().Messages == 0 ? '' : `<span>${element.val().Messages}</span>`}
                            </div>
                            
                            <div class="media-body">
                                <div class="media-contact-name">
                                    <span>${element.val().name}</span>
                                </div>
                                <p>${element.val().NewMessage}</p>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    `);
                 }
          });

      });

      var messages = database.ref('message').orderByChild('date');

          messages.on("value", function(snapshot) {

              snapshot.forEach(function(element) {

                  var chat_pos = '';

                  if(element.val().receive_by == '<?=session('u_id') ?>' && element.val().isView == 0) {

                      database.ref('message').child(element.key).update({
                        isView: 1
                      });

                         const Toast = Swal.mixin({
                              toast: true,
                              position: 'top-end',
                              showConfirmButton: false,
                              timer: 3000,
                              timerProgressBar: true,
                          })

                      Toast.fire({
                        icon: 'info',
                        title: '<p>From: '+element.val().send_by_fullname+'<p>' + '<span>Message: </span>' + element.val().chat_msg
                      })
                  } 

              });

      });


      $('#choose_file').click(function() {
         $('#file').click();
      });

      $('#file').change(function() {
         var fordData = new FormData();

         fordData.append('file', $('#file').prop('files')[0]);

         $.ajax({
           type: 'POST',
           url: '<?= base_url('Home/UploadMessageFile') ?>',
           data: fordData,
           processData: false,
           contentType: false,
           success: function(response) {
              var to_user = $('#user_id').val();
              var chat_msg = 'Image';
              var random_id = uniqueID();

              database.ref('/message/'+random_id).set({
                  receive_by: to_user,
                  username: $('#user_header').text(),
                  send_by: 'Admin',
                  send_by_fullname: '<?= session('fname') ?> ' +'  '+ ' <?= session('lastname') ?>',
                  chat_msg: chat_msg,
                  date: Date.now(),
                  file: response,
                  isView: 0,
              });
           }
         })
      });

        // $.get('<?= base_url('Admin/GetUsers') ?>', function(response) {
        //     response.forEach(function(row) {
        //         if(row.user_type == 'user') {
        //             $('#azChatList').append(`
        //                 <div class="media new" onclick="ViewChat(${row.RecID},'${row.firtname}','${row.lastname}')">
        //                     <div class="az-img-user">
        //                         <img src="<?= base_url('public/assets/img/default_image.png') ?>" alt="">
        //                     </div>
        //                     <div class="media-body">
        //                         <div class="media-contact-name">
        //                             <span>${row.firtname} ${row.lastname}</span>
        //                         </div>
        //                         <p>-</p>
        //                     </div><!-- media-body -->
        //                 </div><!-- media -->
        //             `);
        //         }
        //     })
        // },'json');

        $('#chatActiveContacts').lightSlider({
          autoWidth: true,
          controls: false,
          pager: false,
          slideMargin: 12
        });

        if(window.matchMedia('(min-width: 992px)').matches) {
          new PerfectScrollbar('#azChatList', {
            suppressScrollX: true
          });

          const azChatBody = new PerfectScrollbar('#azChatBody', {
            suppressScrollX: true
          });

         // $('#azChatBody').scrollTop($('#azChatBody').prop('scrollHeight'));
        }

        $(document).on('click touch', '.az-chat-list .media', function() {
          $(this).addClass('selected').removeClass('new');
          $(this).siblings().removeClass('selected');

          if(window.matchMedia('(max-width: 991px)').matches) {
            $('body').addClass('az-content-body-show');
            $('html body').scrollTop($('html body').prop('scrollHeight'));
          }
        });

        $(document).on('click touch', '#azChatBodyHide', function(e) {
          e.preventDefault();
          $('body').removeClass('az-content-body-show');
        });


    })
</script>