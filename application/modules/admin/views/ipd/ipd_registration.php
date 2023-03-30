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
            <input type="hidden" id="ipd_patient_id"  value="<?=$ipd_patient_id?>" name="">
            <form action="" method="POST" id="ipd_form" class="ipd_form" enctype="multipart/form-data">

              <div class="row">
               <div class="col-md-6">
                <h4>Basic Info</h4>

                <div class="form-group">

                 <div class="row">
                  <label for="" class="col-md-4 text-right">UHID:</label>
                  <div class="col-md-8">
                   <select class="custom-select select2" onchange="get_uhid_info()" id="uhid"  name="uhid" >
                    <option value=0>--Select--</option>
                    <?php
                    foreach ($uhid as $key => $value)
                      {?>

                        <option value='<?=$value['gen_id']?>#<?=$value['id']?>'><?=$value['gen_id']?></option>

                      <?php }

                      ?>
                    </select> 

                  </div>
                </div>
              </div>


              <div class="form-group">
                <div class="row">
                  <label for="" class="col-md-4 text-right">Patient Name</label>
                  <div class="col-md-8"><input class="form-control form-control-sm" id="patient_name" type="text" name="patient_name" placeholder="" autocomplete="off" required ></div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label for="" class="col-md-4 text-right">Registration No:</label>
                  <div class="col-md-8"><input class="form-control form-control-sm" id="reg_no" type="text" name="reg_no"  readonly="" ></div>
                </div>
              </div>




              <div class="form-group">
                <div class="row">
                  <label for="" class="col-md-4 text-right">Phone No</label>
                  <div class="col-md-8">
                    <input class="form-control form-control-sm" id="phone_no" name="phone_no" autocomplete="off" type="number" placeholder="" required >
                  </div>
                </div>
              </div>


              <div class="form-group">
                <div class="row">
                  <label for="" class="col-md-4 text-right">Age</label>
                  <div class="col-md-8"><input class="form-control form-control-sm" type="text" id="age" name="age" placeholder="" required ></div>
                </div>
              </div>


              <div class="form-group">
                <div class="row">
                  <label for="" class="col-md-4 text-right">Gender</label>
                  <div class="col-md-8">

                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="male" name="gender" value="Male" class="custom-control-input" required>
                      <label class="custom-control-label m-0" for="male">Male</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="female" name="gender" value="Female" class="custom-control-input" required>
                      <label class="custom-control-label m-0" for="female">Female</label>
                    </div>

                     <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="others" name="gender" value="Others" class="custom-control-input" required>
                      <label class="custom-control-label m-0" for="others">Others</label>
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

                      <?php
                      foreach ($room as $key => $ro) {

                        if($ro['is_busy']==0) {?>

                          <option value="<?=$ro['id']?>"><?=$ro['room_title']?></option>
                        <?php } ?>



                      <?php }
                      ?>
                    </select>

                  </div>
                  <!-- <span id="result"></span> -->
                </div>
              </div>


              <div class="form-group">
               <div class="row">
                <label for="blood_group" class="col-md-4 text-right">Blood Group</label>
                <div class="col-md-8">
                  <select class="custom-select select2" name="blood_group" id="blood_group">
                    <option value="">Select Blood Group</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label for="" class="col-md-4 text-right">Advance Payment:</label>
                <div class="col-md-8"><input class="form-control form-control-sm" id="adv_pay" type="text" name="adv_pay" placeholder="Advance Payment" ></div>
              </div>
            </div>


            <div class="form-group">
              <div class="row">
                <label for="" class="col-md-4 text-right">Admission Fee:</label>
                <div class="col-md-8"><input class="form-control form-control-sm" id="adm_fee" type="text" name="adm_fee" placeholder="Admission Fee"></div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label for="" class="col-md-4 text-right">Admission Fee Paid:</label>
                <div class="col-md-8"><input class="form-control form-control-sm" id="adm_fee_paid" type="text" name="adm_fee_paid" placeholder="" ></div>
                <div class="col-md-8 offset-md-4 pt-1" id="adm_fee_level_div"><p style="color: red;">Adm Fee Paid Must be Less than Adm Fee</p></div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label for="" class="col-md-4 text-right">Type of Description</label>
                <div class="col-md-8"><textarea class="form-control" rows="2" id="" name="description"></textarea></div>

              </div>
            </div>

          </div>

          <div class="col-md-6">

           <h4>Other Info</h4>

           <div class="form-group">
             <label for="hospital_logo" class="col-sm-12 control-label">Patient Image</label>
             <div class="fileinput fileinput-new" data-provides="fileinput">
              <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 100px;">
                <img data-src="holder.js/100%x100%" alt="...">
              </div>
              <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
              <div>
                <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="patient_image" name="patient_image"></span>
                <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label for="" class="col-md-4 text-right">Doctor Name <a href="admin/add_doc" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;" style="font-size:10px"> (ADD NEW)</a></label>
              <div class="col-md-8">

                <select class="custom-select select2"  name="doc_name" required>
                  <option value="">Select Doctor Title</option>
                  <?php
                  foreach ($doctor_list as $key => $value)
                  {
                    $doctor_id=$value['doctor_id'];
                    $doctor_type=$value['doctor_type'];
                    $doctor_title=$value['doctor_title'];
                    $doctor_degree=$value['doctor_degree'];

                    echo "<option value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";
                  }

                  ?>
                </select> 
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label for="" class="col-md-4 text-right">Ref Doctor Name <a href="admin/add_doc" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;" style="font-size:10px"> (ADD NEW)</a></label>
              <div class="col-md-8">

               <select class="custom-select select2" id="ref_doc_name"  name="ref_doc_name" required>
                <option value="">Select Doctor Title</option>
                <?php
                foreach ($doctor_list as $key => $value)
                {
                  $doctor_id=$value['doctor_id'];
                  $doctor_type=$value['doctor_type'];
                  $doctor_title=$value['doctor_title'];
                  $doctor_degree=$value['doctor_degree'];

                  echo "<option value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";

                }

                ?>
              </select>   
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="" class="col-md-4 text-right">Date Of Birth</label>
            <div class="col-md-8">
              <div class="input-group focused">
                <input type="text" name="date_of_birth" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}">
                <span class="input-group-append">
                  <span class="input-group-text add-on white">
                    <i class="icon-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="" class="col-md-4 text-right">Email</label>
            <div class="col-md-8"><input class="form-control form-control-sm" type="email" name="email" placeholder="" ></div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="" class="col-md-4 text-right">Disease Name</label>
            <div class="col-md-8"><input class="form-control form-control-sm" type="text" name="disease_name" placeholder="" ></div>
          </div>
        </div>


        <div class="form-group">
          <div class="row">
            <label for="" class="col-md-4 text-right">Guardian Name</label>
            <div class="col-md-8"><input class="form-control form-control-sm" type="text" name="guardian_name" placeholder="" ></div>
          </div>
        </div>

        <div class="form-group">
          <label for="" class="col-md-4 text-right" style="font-weight: bold;">Address:</label><br>
          <div class="row">
            <label for="" class="col-md-4 text-right">Village</label>
            <div class="col-md-8 mb-2"><input class="form-control form-control-sm" type="text" name="village" placeholder="" ></div>
            <label for="" class="col-md-4 text-right">Post Office</label>
            <div class="col-md-8  mb-2"><input class="form-control form-control-sm" type="text" name="post_office" placeholder="" ></div>
            <label for="" class="col-md-4 text-right">Police Station</label>
            <div class="col-md-8  mb-2"><input class="form-control form-control-sm" type="text" name="police_station" placeholder="" ></div>
            <label for="" class="col-md-4 text-right">District</label>
            <div class="col-md-8  mb-2"><input class="form-control form-control-sm" type="text" name="district" placeholder="" ></div>

            <!--      <div class="col-md-8"><textarea class="form-control" rows="2" id="address" name="address"></textarea></div> -->
          </div>
        </div>

        <!-- <div class="form-group">
          <div class="row">
            <label for="" class="col-md-4 text-right">Blood Pressure</label>
            <div class="col-md-8"><input class="form-control form-control-sm" type="text" name="blood_pressure" placeholder="" ></div>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <label for="" class="col-md-4 text-right">Pulse Rate</label>
            <div class="col-md-8"><input class="form-control form-control-sm" type="text" name="pulse_rate" placeholder="" ></div>
          </div>
        </div> -->

        <div class="form-group">
          <div class="row">
            <label for="" class="col-md-4 text-right">Operator Name</label>
            <div class="col-md-8"><input class="form-control form-control-sm" type="text" name="operator" value="<?php echo $this->session->userdata['logged_in']['username'];?>" readonly placeholder="" required></div>
          </div>
        </div>  

        <div class="text-right"> 
         <input type="submit" value="submit" class="btn btn-primary m-2">
       </div>
     </div>

   </div>

 </form>
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

     $.ajax({  
      url:"<?=site_url('admin/get_last_ipd_reg_no')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        if(data == '')
        {
          $('#reg_no').val(1001);
        }
        else{
          $('#reg_no').val(parseInt(data[0]['reg_id'])+1);
        }

      }
    });
  </script>

  <script type="text/javascript">

    $(document).ready(function()
    { 

    //bootstrap typeahead
    $.ajax({  
      url:"<?=site_url('admin/get_all_ipd_phone_no')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        var all_ipd_phone_num=[];

        $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              all_ipd_phone_num.push(value.mobile_no)
                            });

        $("#phone_no").typeahead({source:all_ipd_phone_num});


      }
    });

    $("#blood_group").empty();
    $("#blood_group").append('<option value="">Select Blood Group</option>');
    $.ajax({  
      url:"<?=site_url('admin/get_all_blood_group')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
       $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              $("#blood_group").append('<option  value="' + value.id + '">' + value.blood_group_title + '</option>');
                            });
                        // });
                      }
                    });


    var ipd_patient_id=$('#ipd_patient_id').val();

    if(ipd_patient_id != "")
    {
      // alert(ipd_patient_id);

      window.open('<?=base_url();?>admin/ipd_reg_form/'+ipd_patient_id,'_blank','width=560,height=340,toolbar=0,menubar=0,location=0');


    }

  });


    function get_opd_patient_info() {

      var patient_mobile_no=$("#patient_mobile_no").val();
      var blood_group_id;
      $.ajax({  
        url:"<?=site_url('admin/get_all_info_by_mobile_no')?>",  
        method:"POST",
        data:{patient_mobile_no:patient_mobile_no},  
        dataType:"json",  
        success:function(data)  
        { 
         $.each(data, function (key, value) 
         {
          blood_group_id=value.blood_group;
          $('#patient_name').val(value.patient_name);
          $('#ref_doc_name').val(value.ref_doctor_name);
          $('#patient_address').val(value.address);
          $('#age').val(value.age);
          $('#date_of_birth').val(value.date_of_birth);
          $('#operator_name').val(value.operator_name);

          if(value.gender=="Male")
          {
            $("#Male").prop("checked", true);
          }
          else
          {
            $('#Female').prop("checked", true);
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


       }   
     });
    }

  </script>
  <script type="text/javascript">
    $(document).ready(function()
    {    
     $("#cabin_no").keyup(function()
     {		
      var name = $(this).val();	

      if(name.length > 3)
      {		
       $("#result").html('checking...');

			/*$.post("username-check.php", $("#reg-form").serialize())
				.done(function(data){
				$("#result").html(data);
			});*/
			
			$.ajax({
				
				type : 'POST',
				url  : 'admin/ajax_ipd_cabin_chk',
				data : $(this).serialize(),
				success : function(data)
        {
          $("#result").html(data);
        }
      });
      return false;

    }
    else
    {
     $("#result").html('');
   }
 });

   });
 </script>

 <script type="text/javascript">
  $('#adm_fee_level_div').hide();
  $('#ipd_form').on('submit', function() {

   var adm_fee=$('#adm_fee').val();
   var adm_fee_paid=$('#adm_fee_paid').val();

   

   if(parseFloat(adm_fee) < parseFloat(adm_fee_paid))
   {
    $('#adm_fee_level_div').show();
    return false;

  }

});


  function get_uhid_info(argument) {
    var uhid=$("#uhid option:selected").val();

  $.ajax({  
    url:"<?=site_url('admin/get_uhid_info_by_id')?>",  
    method:"POST",
    data:{uhid:uhid},  
    dataType:"json",  
    success:function(data)  
    { 
     $.each(data, function (key, value) 
     {

      $('#patient_name').val(value.patient_name);
      $('#phone_no').val(value.mobile_no);

      $.ajax({  
        url:"<?=site_url('admin/get_all_doc_name')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 
          $("#ref_doc_name").empty();
          $("#ref_doc_name").append('<option  value="self#0">self</option>');
          $.each(data, function (key, value1) {


            if(value.ref_doc_id==value1.doctor_id)
            {

              $("#ref_doc_name").append('<option selected value="' + value1.doctor_title+'#'+value1.doctor_id + '">' + value1.doctor_title + '</option>');
            }
            else
            {
             $("#ref_doc_name").append('<option  value="' + value1.doctor_title+'#'+value1.doctor_id + '">' + value1.doctor_title + '</option>');
           }

         });

        }
      });


    });

}

});
  }
</script>


</body>
</html>