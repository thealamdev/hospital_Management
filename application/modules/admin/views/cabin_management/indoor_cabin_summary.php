<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>

  <div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
     <?php $this->load->view('back/sidebar'); ?> 
   </aside>
   <!--Sidebar End-->
   <div class="has-sidebar-left">
     <?php $this->load->view('back/navbar'); ?>   
   </div> 
   <div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
      <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
          <div class="col">
            <h4>
              <i class="icon-box"></i>
              <?= $page_title ?>
            </h4>
          </div>
        </div>
      </div>
    </header>

    <div class="section-wrapper">

      <div class="card my-3 no-b">
        <div class="card-body">
          <?php
          foreach ($cabin_class as $key => $val1) {

            ?>

            <div class="row" style="font-weight: bold; font-size:18px; color:black"><?=$val1['cabin_class_title']?>
            <?php foreach ($sub_cabin as $key => $val2) { 
              if($val1['id']==$val2['cabin_class_id']){
                ?>

                <div class="col-md-12" style="font-weight: bold; font-size:18px; color:black;  margin-left: 10px; margin-bottom: 15px;">


                  <?=$val2['cabin_sub_class_title']?> 

                  <br>

                  <?php foreach ($room as $key => $val3) {
                    if($val2['id']==$val3['cabin_sub_class_id']){
                      ?>

                      <div class="row" style=" height:100px; width:240px; border:2px solid #e32b2b; float:left; margin-left: 25px; border-radius:20px;text-align:center; font-weight: bold; font-size:15px; color:black; margin-bottom: 10px;">

                        <div class="" style="margin-left:5px; margin-top: 5px; padding-top: 0px;  width:65px; height: 65px; text-align: center;"><img style="max-width:135%" src="uploads/ipd_patient_image/<?=$val3['patient_image']?>"></i></div>
                        <div class="col-md-8" style="margin-top: 6px;"><?=$val3['room_title']?><br><?=$val3['seat_capacity']?> Bed <br> BDT- <?=$val3['room_price']?>/= <br>

                          <?php if($val3['is_busy']==0) {?>

                            <span style="color: green;">Free</span>

                          <?php } else{ ?>

                            <span style="color: red;">Busy</span>


                         <?php }
                          ?>

                        </div>
                      </div>

                    <?php } }?>

                  </div>

                <?php } }?>

              </div>

            <?php }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
     <div class="control-sidebar-bg shadow white fixed"></div>
   </div>

   <?php $this->load->view('back/footer_link');?>


 </body>
 </html>