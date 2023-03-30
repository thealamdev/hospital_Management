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
    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>


    <div class="section-wrapper">
      <div class="container">
        <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">  
          <form method="post" action="admin/save_expire_date/<?=$hospital_id?>">

            <div class="row">
             <div class="form-group col-md-4">
              <label for="warning_date_1" class="col-sm-12 control-label">Warning Date 1</label>
              <div class="input-group ml-3 ">
               <input placeholder="dd/mm/yy" autocomplete="off" type="text" onchange="comp()" name="warning_date_1" id="warning_date_1" class="col-sm-7 date-time-picker form-control warning_date_1"
               data-options='{"timepicker":false,"format":"Y-m-d"}' value="<?=empty($expire_date_info) ? "" : openssl_decrypt(base64_decode($expire_date_info[0]['msg_date_1']),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?>" tabindex="-1"/>
               <span class="input-group-append">
                 <span class="input-group-text add-on white">
                   <i class="icon-calendar"></i>
                 </span>
               </span>
             </div>
           </div>

           <div class="form-group  col-md-4">
            <label for="warning_date_2" class="col-sm-12 control-label">Warning Date 2</label>
            <div class="input-group ml-3">
             <input placeholder="dd/mm/yy" autocomplete="off" type="text" onchange="comp()" name="warning_date_2" id="warning_date_2" class="col-sm-7 date-time-picker form-control warning_date_2"
             data-options='{"timepicker":false,"format":"Y-m-d"}' value="<?=empty($expire_date_info) ? "" : openssl_decrypt(base64_decode($expire_date_info[0]['msg_date_2']),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?>" tabindex="-1"/>
             <span class="input-group-append">
               <span class="input-group-text add-on white">
                 <i class="icon-calendar"></i>
               </span>
             </span>
           </div>
         </div>

         <div class="form-group  col-md-4">
          <label for="warning_date_3" class="col-sm-12 control-label">Warning Date 3</label>
          <div class="input-group ml-3">
           <input placeholder="dd/mm/yy" autocomplete="off" type="text" onchange="comp()" name="warning_date_3" id="warning_date_3" class="col-sm-7 date-time-picker form-control warning_date_3"
           data-options='{"timepicker":false,"format":"Y-m-d"}' value="<?=empty($expire_date_info) ? "" : openssl_decrypt(base64_decode($expire_date_info[0]['msg_date_3']),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?>" tabindex="-1"/>
           <span class="input-group-append">
             <span class="input-group-text add-on white">
               <i class="icon-calendar"></i>
             </span>
           </span>
         </div>
       </div>

       <div class="form-group  col-md-4">
        <label for="expire_date" class="col-sm-12 control-label" style="color: red;">Expire Date</label>
        <div class="input-group ml-3">
         <input placeholder="dd/mm/yy" autocomplete="off" type="text" onchange="comp()" name="expire_date" id="expire_date" class="col-sm-7 date-time-picker form-control expire_date"
         data-options='{"timepicker":false,"format":"Y-m-d"}' value="<?=empty($expire_date_info) ? "" : openssl_decrypt(base64_decode($expire_date_info[0]['expire_date']),"AES-256-CBC",  hash('sha256',"encryptedexpiredaterecently"), 0, substr(hash('sha256','This is my secret iv'), 0, 16));?>" tabindex="-1"/>
         <span class="input-group-append">
           <span class="input-group-text add-on white">
             <i class="icon-calendar"></i>
           </span>
         </span>
       </div>
     </div>

   </div>

   <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-5">
     <button type="submit" class="btn btn-success">Submit</button>
   </div>
 </div>
</form>
</div>
</div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>
<script src="back_assets/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script src="back_assets/js/ckeditor.js"></script>
</body>
</html>