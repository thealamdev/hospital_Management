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
          <form method="post" action="
          admin/opd_file_tag_print_selective_print">
            <div class="row">
              <div class="col-md-6">

               <div class="form-group">
                 <label for="country" class="col-sm-12 control-label">OPD Invoice ID</label>
                 <div class="col-sm-10">
                  <select class="custom-select select2 form-control" multiple="multiple" name="id_list[]" id="role" required>
                    <?php foreach ($opd_test_order_info as $key => $value) { ?>

                      <option value="<?=$value['id']?>"><?=$value['test_order_id']?></option>

                    <?php } ?>
                  </select>
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



  });
</script>

</body>
</html>