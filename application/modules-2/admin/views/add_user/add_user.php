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
          <form method="post" id="my_form">
            <div class="row">
              <div class="col-md-6">


                <div class="form-group">
                 <label for="hospital" class="col-sm-12 control-label">Hospital</label>
                 <div class="col-sm-10">
                   <select class="custom-select select2 form-control" name="hospital" id="hospital" required>

                   </select>
                 </div>
               </div>



               <div class="form-group">
                 <label for="country" class="col-sm-12 control-label">Role</label>
                 <div class="col-sm-10">
                  <select class="custom-select select2 form-control" multiple="multiple" name="role[]" id="role" required>
                    <?php foreach ($role_info as $key => $value) { ?>

                      <option value="<?=$value['id']?>#<?=$value['name']?>"><?=$value['name']?></option>

                    <?php } ?>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label for="mobile_no" class="col-sm-12 control-label">Discount (%)</label>
                <div class="col-sm-10">
                 <input class="form-control" name="discount_percent" id="discount_percent" placeholder="Discount (%)" type="text">
               </div>
             </div>

             <div class="form-group">
               <label for="mobile_no" class="col-sm-12 control-label">Discount (Amount)</label>
               <div class="col-sm-10">
                 <input class="form-control" name="discount_amount" id="discount_amount" placeholder="Discount (Amount)" type="text">
               </div>
             </div>

             <div class="form-group">
               <label for="inputEmail4" class="col-sm-12 control-label">Doctor List</label>
               <div class="col-sm-10">
                 <select class="custom-select select2" name="doc_id">
                  <option value="0">Select Doctor</option>
                  <?php foreach ($dr_info as $key => $value) { ?>

                    <option value="<?=$value['doctor_id']?>"><?=$value['doctor_title']?></option>
                  <?php }?>  
                </select> 
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
             <label for="user_name" class="col-sm-12 control-label">User Name</label>
             <div class="col-sm-10">
               <input class="form-control" name="user_name" id="user_name" required="" placeholder="User Name" type="text">
             </div>
           </div>   
           <div class="form-group">
             <label  for="email" class="col-sm-12 control-label">Email</label>
             <div class="col-sm-10">
               <input class="form-control" name="email" id="email" placeholder="Email" type="email">
             </div>
           </div>
           <div class="form-group">
             <label for="password" class="col-sm-12 control-label">Password</label>
             <div class="col-sm-10">
               <input required="" class="form-control" name="password" id="password" placeholder="Password" type="password">
             </div>
           </div>
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Mobile No</label>
             <div class="col-sm-10">
               <input class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No" type="text">
             </div>
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

<style type="text/css">
 .select2-container--default .select2-selection--multiple
 {
  background-color: white !important;
}
</style>
<?php $this->load->view('back/footer_link');?>

<script type="text/javascript">


  $(document).ready(function(){ 

    $("#hospital").empty();
    
    $("#hospital").append('<option value="0">Select Hospital</option>');


    $.ajax({  
      url:"<?=site_url('admin/get_all_hospital_title')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
       $.each(data["hospital_name"], function (key, value) {

        $("#hospital").append('<option selected  value="' + value.hospital_id + '">' + value.hospital_title + '</option>');

      });

     }
   });

    $("#my_form").submit(function(e){

      var discount_percent=$('#discount_percent').val();

      var discount_amount=$('#discount_amount').val();

      if(discount_percent != "" && discount_amount != "")
      {
        alertify.alert("<b>Only Discount percent or Discount Amount is Valid</b>");
        return false;
      }
      return true;
    });

  });
</script>

</body>
</html>