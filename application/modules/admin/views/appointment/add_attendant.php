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
          <form method="post" action="admin/add_attendant_post">
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                 <label for="country" class="col-sm-12 control-label">User List</label>
                 <div class="col-sm-10">
                   <select class="custom-select select2 form-control" multiple="multiple" name="user_list[]" id="user_list" required>

                     <?php foreach ($user_list as $key => $value) { ?>

                      <option value="<?=$value['id']?>"><?=$value['username']?></option>

                    <?php } ?>
                  </select>
                </div>
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
<?php $this->load->view('back/footer_link');?>

<style type="text/css">
 .select2-container--default .select2-selection--multiple
 {
  background-color: white !important;
}
</style>

<script type="text/javascript">


  $(document).ready(function(){ 

    $("#hospital").empty();
  // $("#hospital").append('<option value="">Select Hospital</option>');
    // alert('hi');
    $.ajax({  
      url:"<?=site_url('admin/get_all_hospital_title')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
       $.each(data["hospital_name"], function (key, value) {
                            // $.each(value, function (key, value) {

                              $("#hospital").append('<option value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
                              
                            });
                        // });
                      }
                    });

    //   $("#role").empty();
    // // $("#role").append('<option value="">Select Admin Role</option>');
    // // alert('hi');
    //   $.ajax({  
    //               url:"<?=site_url('admin/get_all_admin')?>",  
    //               method:"POST",  
    //               dataType:"json",  
    //               success:function(data)  
    //               { 
    //                $.each(data, function (key, value) {
    //                         // $.each(value, function (key, value) {

    //                             $("#role").append('<option value="' + value.id + '">' + value.admin_type + '</option>');

    //                         });
    //                     // });
    //               },
    //               error: function(e) 
    //               {
    //                 alert(e);
    //               }
    //           });

    //   $('#user_name').bind('input', function() {
    //   $.ajax({  
    //               url:"<?=site_url('admin/get_last_user_id')?>",  
    //               method:"POST",  
    //               dataType:"json",  
    //               success:function(data)  
    //               { 
    //                $.each(data, function (key, value) {
    //                         // $.each(value, function (key, value) {
    //                           // alert(value.id);

    //                           var user_name=$('#user_name').val();
    //                           if(user_name=="")
    //                           {
    //                               $('#generated_user_id').val("");
    //                           }
    //                           else
    //                           {
    //                              var gen_name=user_name.replace(' ','_');
    //                               var val=parseInt(value.id)+1;
    //                              $('#generated_user_id').val(gen_name+'_'+val);
    //                           }


    //                         });


    //                     // alert(data[value.id]);
    //               },
    //               error: function(e) 
    //               {
    //                 alert(e);
    //               }
    //           });
    // });



  });
</script>

</body>
</html>