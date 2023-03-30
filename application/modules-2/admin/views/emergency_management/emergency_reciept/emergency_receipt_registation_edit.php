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
      <div class="container">
        <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">  
          <form method="post" action="admin/emergency_receipt_edit_post" enctype="multipart/form-data">
            <div class="row">


            <input type="hidden" name="emergency_reciept_id" value="<?php echo $emergency_reciept_id?>"/>
              <div class="col-md-3">

            <div class="form-group">
             <label for="user_name" class="col-sm-5 control-label">Emergency No(*)</label>
             <div class="col-sm-7">
               <input class="form-control" name="emergency_no" id="emergency_no" placeholder="Emergency No" value="<?php echo $emergency_no;?>" type="text" readonly>
             </div>
           </div>  
		   </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="email" class="col-sm-12 control-label">Date(*)</label>
             <div class="col-sm-10">
              <div class="form-group">                       
                  <div class="input-group">
                    <input type="text" placeholder="Date" name="date" id="date" value="<?php echo $date;?>" class="col-sm-8 date-time-picker form-control date_of_birth"
                    data-options='{"timepicker":false, "format":"Y-m-d"}' value="" autocomplete="off" required="" />
                    <span class="input-group-append">
                      <span class="input-group-text add-on white">
                        <i class="icon-calendar"></i>
                      </span>
                    </span>
                  </div>                     
                      <div class="col-sm-12" id="sex_id">
                      <div class="row" >
                      <label for="sex_id" class="col-sm-3 control-label">Sex</label>
                        <select class="col-sm-9 custom-select select2" name="sex">
                          <option value="">--Select--</option>
                          <?php foreach($sexAll as $key=> $sexes):?>
                          <option value="<?php echo $key;?>" <?php if($key==$sex){echo "selected";}?>><?php echo $sexes?></option>
                          <?php endforeach;?>
                        </select> 
                    </div>
                    </div>
              </div> 
             </div>
           </div>
           </div>
		   
		   <?php 
			   $checkedOPD = "";
			   $checkedIPD = "";
			   $checkedOther = "";
		   if($patient_type == 1){
			   $checkedOPD = "checked";
			   $checkedIPD = "";
			   $checkedOther = "";
		   }else if($patient_type == 2){
			   $checkedIPD = "checked";
			   $checkedOPD = "";
			   $checkedOther = "";
		   }else{
			   $checkedOther = "checked";
			   $checkedOPD = "";
			   $checkedIPD = "";
		   }?>
		   
              <div class="col-md-3">
			 
              <label class="radio-inline"> <input id="opd" name="patient_type" class = "radiocheked" type="radio" value="1" <?php echo $checkedOPD?>/>OPD</label><label class="radio-inline"><input id="ipd" class = "radiocheked"  value="2" name="patient_type" type="radio" <?php echo $checkedIPD?>/>IPD</label><label class="radio-inline"><input id="oth" class = "radiocheked" name="patient_type" value="3" type="radio" <?php echo $checkedOther?>/>Other</label>
               <div class="form-group" id="opd_patient">
                <label for="user_name" class="col-sm-3 control-label">Patient Name</label>
				
                <div class="col-sm-9" id="opdpatient_id">
                 <select class="custom-select select2" name="patient_name1">
                  <option value="">--Select--</option>
                  <?php
                  foreach ($opd_patient_list as $key => $opdval)
                  {?>

                    
                    <option value="<?=$opdval['patient_info_id']?>" <?php if($patient_type == 1 && $opdval['patient_info_id'] == $patient_name){echo "selected";}?>><?=$opdval['patient_name']?></option>;

                  <?php }

                  ?>
                </select> 
              </div>
                <div class="col-sm-9" style="display:none" id="ipdpatient_id">
                 <select class="custom-select select2"  name="patient_name2">
                  <option value="">--Select--</option>
                  <?php
                  foreach ($ipd_patient_list as $key => $ipdval)
                  {?>

                    
                    <option value="<?=$ipdval['id']?>"<?php if($patient_type == 2 && $opdval['patient_info_id'] == $patient_name){echo "selected";}?>><?=$ipdval['patient_name']?></option>;

                  <?php }

                  ?>
                </select> 
              </div>
                <div class="col-sm-9"  style="display:none"  id="otherpatient_id">
                  <input class="form-control" name="patient_name3" id="patient_id" value="<?php if($patient_type == 3){echo $patient_name;}?>" placeholder="Name" type="text">
              </div>
			  
            </div>
           </div>	

            <div class="col-md-3">
              <div class="form-group">
                <label for="mobile_no" class="col-sm-12 control-label">Relation Of Patient</label>
                <div class="col-sm-10">
                  <input class="form-control" name="relation_patient" id="relation_patient" value="<?php echo $relation_patient;?>" placeholder="Relation Of Patient" type="text">
                
               <div class="col-sm-12" id="age_id">
                      <div class="row" >
                      <label for="age_id" class="col-sm-3 control-label">Age</label>
                      <input class="form-control" name="age" id="age" value="<?php echo $age;?>" placeholder="Age 30 Years" type="text">
                    </div>
                    </div>
                </div>
              </div>
           </div>

              <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Diagnosis</label>
             <div class="col-sm-10">
               <input class="form-control" name="diagnosis" id="diagnosis" value="<?php echo $diagnosis;?>" placeholder="Diagnosis" type="text">
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Service Doctor</label>
             <div class="col-sm-10">
              
                 <select class="custom-select select2"  name="service_doctor">
                  <option value="">--Select--</option>
                  <?php
                  foreach ($doctor_list as $key => $servdoctorval)
                  {?>

                    
                    <option value="<?=$servdoctorval['doctor_id']?>"  <?php if($servdoctorval['doctor_id'] == $service_doctor){ echo "selected";}?>><?=$servdoctorval['doctor_title']?></option>;

                  <?php }

                  ?>
                </select> 
             </div>
           </div>
           </div>

           <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Gardian Name</label>
             <div class="col-sm-10">
               <input class="form-control" name="gardian_name" value="<?php echo $gardian_name;?>" id="gardian_name" placeholder="Gardian Name" type="text">
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Doctor Fee</label>
             <div class="col-sm-10">
               <input class="form-control" name="doctor_fee" id="doctor_fee" value="<?php echo $doctor_fee;?>" placeholder="Doctor Fee" type="text">
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Other Cost</label>
             <div class="col-sm-10">
               <input class="form-control" name="other_cost" value="<?php echo $other_cost?>" id="other_cost" value="<?php echo $other_cost;?>" placeholder="Other Cost" type="text">
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Mobile No</label>
             <div class="col-sm-10">
               <input class="form-control" name="mobile_no" value="<?php echo $mobile_no?>" id="mobile_no"  placeholder="Mobile No" type="text">
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Service Fee</label>
             <div class="col-sm-10">
               <input class="form-control" name="hospital_amount" id="hospital_amount" value="<?php echo $hospital_amount;?>" placeholder="Hospital Cost" type="text">
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Referred Doctor</label>
             <div class="col-sm-10">
              
                 <select class="custom-select select2"  name="refered_doctor">
                  <option value="">--Select--</option>
                  <?php
                  foreach ($doctor_list as $key => $refdoctorval)
                  {?>

                    
                    <option value="<?=$refdoctorval['doctor_id']?>" <?php if($refdoctorval['doctor_id'] == $refered_doctor){ echo "selected";}?>><?=$refdoctorval['doctor_title']?></option>;

                  <?php }

                  ?>
                </select> 
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="mobile_no" class="col-sm-12 control-label">Add & Test Service</label>
             <div class="col-sm-10">
              
              
                 <select class="custom-select select2"  name="department">
                  <option value="">--Select--</option>
                  <?php
                  foreach ($department_list as $key => $depval)
                  {?>

                    
                    <option value="<?=$depval['id']?>"<?php if($depval['id'] == $department){ echo "selected";}?>><?=$depval['dept_name']?></option>;

                  <?php }

                  ?>
                </select>  
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="comments" class="col-sm-12 control-label">Discount</label>
             <div class="col-sm-10">
               <input class="form-control" name="discount_amount" id="discount_amount" value="<?php echo $discount_amount;?>" placeholder="Discount" type="text">
             </div>
           </div>
           </div>
              <div class="col-md-3">
           <div class="form-group">
             <label for="comments" class="col-sm-12 control-label">Comments</label>
             <div class="col-sm-10">
               <input class="form-control" name="comments" id="comments"  value="<?php echo $comments;?>"placeholder="comments" type="text">
             </div>
           </div>
           </div>
		  

        </div>
      </div>
      <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-5">
         <button type="submit" class="btn btn-success">Update</button>
       </div>
     </div>
   </form>
 </div>
</div>
</div>
</div>

<!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
     <div class="control-sidebar-bg shadow white fixed"></div>

   <?php $this->load->view('back/footer_link');?>

<script>
$('.radiocheked').click(function(){

     var getchecked=$(this).val();
	 if(getchecked == 1){
		 $("#opdpatient_id").show();
		 $("#ipdpatient_id").hide();
		 $("#otherpatient_id").hide();
	 }else if(getchecked == 2){
		 $("#ipdpatient_id").show();
		 $("#opdpatient_id").hide();
		 $("#otherpatient_id").hide();
		 
	 }else{		 
		 $("#otherpatient_id").show();
		 $("#opdpatient_id").hide();
		 $("#ipdpatient_id").hide();
	 }
	});
	
</script>

 </body>
 </html>