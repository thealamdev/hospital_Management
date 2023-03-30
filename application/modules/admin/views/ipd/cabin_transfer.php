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
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <form action="" method="post" class="ipd_form">
             <input type="hidden" id="hidden_ipd_id" name="hidden_ipd_id">
             <div class="row">
               <div class="col-md-6">
                <h4>Basic Info</h4>

                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Patient Code</label>
                    <div class="col-md-8"><input class="form-control form-control-sm" id="patient_code" type="text" placeholder="" required></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Patient Name</label>
                    <div class="col-md-8"><input class="form-control form-control-sm" id="patient_name" type="text" placeholder="" required></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Phone No</label>
                    <div class="col-md-8">
                      <span style="position: absolute; width: 70px;"><select class="custom-select select2" name="country_code" id="country_code" required>
                        <option value="880" selected>880</option>
                      </select></span>
                      <input style="padding-left: 75px;" class="form-control form-control-sm" id="cabin_transfer_phone_no" name="cabin_transfer_phone_no" type="number" placeholder="" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Age</label>
                    <div class="col-md-8"><input class="form-control form-control-sm" id="age" type="number" placeholder="" required></div>
                  </div>
                </div>



                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Gender</label>
                    <div class="col-md-8">

                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="male" name="gender" class="custom-control-input" required>
                        <label class="custom-control-label m-0" for="male">Male</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="female" name="gender" class="custom-control-input" required>
                        <label class="custom-control-label m-0" for="female">Female</label>
                      </div>
                    </div>


                  </div>
                </div>



                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Cabin No</label>
                    <div class="col-md-8">
                      <select class="custom-select select2" name="cabin_no" id="cabin_no" required>
                        <option value="">Select Cabin No</option>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="form-group">
                 <div class="row">
                  <label for="blood_group" class="col-md-4 text-right">Blood Group</label>
                  <div class="col-md-8">
                    <select class="custom-select select2" name="blood_group" id="blood_group" required>
                      <option value="">Select Blood Group</option>
                    </select>
                  </div>
                </div>
              </div>

            </div>


            <div class="col-md-6">

             <h4>Cabin Transfer Info</h4>

             <div class="form-group">
              <div class="row">
                <label for="" class="col-md-4 text-right">New Cabin No</label>
                <div class="col-md-8">
                 <select class="custom-select select2" name="update_cabin_no" id="update_cabin_no" required>
                  <option value="">Select Cabin No</option>
                  <?php
                  foreach ($room as $key => $ro) {

                    if($ro['is_busy']==0) {?>

                      <option value="<?=$ro['id']?>"><?=$ro['room_title']?></option>
                    <?php } ?>



                  <?php }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label for="" class="col-md-4 text-right">Cabin Price</label>
              <div class="col-md-8"><input class="form-control form-control-sm" id="cabin_price" type="number" placeholder="" required readonly></div>
            </div>
          </div>


          <div class="form-group">
            <div class="row">
              <label for="" class="col-md-4 text-right">Cabin Class</label>
              <div class="col-md-8"><input class="form-control form-control-sm" id="cabin_class" type="text" placeholder="" required readonly></div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label for="" class="col-md-4 text-right">Cabin Sub Class</label>
              <div class="col-md-8"><input class="form-control form-control-sm" id="cabin_sub_class" type="text" placeholder="" required readonly></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 text-right"> 
       <input type="submit" value="submit" class="btn btn-primary m-2">
     </div>
   </form>
 </div>
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
   <script type="text/javascript">

    $(document).ready(function()
    {

      //bootstrap typeahead
      $.ajax({  
        url:"<?=site_url('admin/get_all_info_by_unrelease_patient_id_ipd')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 
          var mobile_no_data=[];
          $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              mobile_no_data.push(value.patient_info_id);
                            });

          $("#patient_code").typeahead({source:mobile_no_data});


        }
      });

      $(document).on('change','#update_cabin_no', function(event)
      {
        var update_cabin_no_id=$( "#update_cabin_no option:selected" ).val();
        // alert(hospital_id_sub);
        $.ajax({  
          url:"<?=site_url('admin/get_all_room_info_by_cabin_room_id')?>",  
          method:"POST",
          data:{update_cabin_no_id:update_cabin_no_id},  
          dataType:"json",  
          success:function(data)  
          { 
            $('#cabin_price').val(data[0]['room_price']);
            $('#cabin_class').val(data[0]['cabin_class_title']);
            $('#cabin_sub_class').val(data[0]['cabin_sub_class_title']);

          }
        });
        
      });


      $(document).on('click','#opd_patient_ul>li', function(event)
      {
        get_ipd_patient_info();
        
      });
    });

    function get_ipd_patient_info() {

      var patient_info_id=$("#patient_code").val();
      var blood_group_id;
      $.ajax({  
        url:"<?=site_url('admin/get_all_info_by_patient_code_ipd')?>",  
        method:"POST",
        data:{patient_info_id:patient_info_id},  
        dataType:"json",  
        success:function(data)  
        { 
         $.each(data, function (key, value) 
         {
          blood_group_id=value.blood_group;
          cabin_no_id=value.cabin_no;

          $('#hidden_ipd_id').val(value.id);
          $('#patient_name').val(value.patient_name);
          $('#age').val(value.age);
          $('#cabin_transfer_phone_no').val(value.mobile_no);

          if(value.gender=="male")
          {
            $("#male").prop("checked", true);
          }
          else
          {
            $('#female').prop("checked", true);
          }

        });

         $.ajax({  
          url:"<?=site_url('admin/get_all_blood_group')?>",  
          method:"POST",  
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              if(blood_group_id==value.id)
                              {
                                $("#blood_group").empty();
                                $("#blood_group").append('<option selected value="' + value.id + '">' + value.blood_group_title + '</option>');
                              }
                              
                            });
                        // });
                      }
                    });

         $.ajax({  
          url:"<?=site_url('admin/get_all_cabin_room_no')?>",  
          method:"POST",  
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              if(cabin_no_id==value.id)
                              {
                                $("#cabin_no").empty();
                                $("#cabin_no").append('<option selected value="' + value.id + '">' + value.room_title + '</option>');
                              }
                              
                            });
                        // });
                      }
                    });
       }
     });
    }   


  </script>


</body>
</html>