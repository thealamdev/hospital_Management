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
   <CENTER>
    <h3 style="color:green;"><?php echo $message ?></h3>
</CENTER>
<br>
<?php } ?>
<?php echo validation_errors(); ?>
<div class="section-wrapper">
    <div class="container">
     <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">
      <form id="my_form" action="admin/update_edit_info_opd/<?=$flag?>" method="post" enctype="multipart/form-data">
       <div class="row">
         <input type="hidden" value="<?=$patient_info[0]['id']?>" name="p_id">

         <div class="col-md-4">
             <div class="form-group">
              <label for="patient_name" class="col-sm-12 control-label">Patient Name</label>
              <div class="col-sm-10">
               <input class="form-control" value="<?=$patient_info[0]['patient_name']?>" name="patient_name" id="patient_name" required="" placeholder="Patient Name" tabindex="1" type="text">
           </div>
       </div>

       <div class="form-group">
         <label for="patient_mobile_no" class="col-sm-12 control-label">Mobile No</label>
         <div class="col-sm-12">
            <input type="text" class="form-control typeahead" name="patient_mobile_no" value="<?=$patient_info[0]['mobile_no'];?>" id="patient_mobile_no" placeholder="Mobile No" data-provide="typeahead" autocomplete="off">
        </div>
    </div>



    

    <div class="form-group">
     
       <label for="ref_doc_name" class="col-sm-12 control-label">Dr. Name  <a href="admin/add_doc/1" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;"> (ADD NEW)</a></label>
       <div class="col-sm-10">
        <select readonly class="custom-select select2"  name="ref_doc_name">
         
            <option value="self#0">self</option>
            <?php
            foreach ($doctor_list as $key => $value)
            {
                $doctor_id=$value['doctor_id'];
                $doctor_type=$value['doctor_type'];
                $doctor_title=$value['doctor_title'];
                $doctor_degree=$value['doctor_degree'];
                
                if($patient_info[0]['ref_doctor_id']==$doctor_id)
                {
                    
                    echo "<option selected value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";

                }

                else
                {
                 echo "<option  value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";
             }     

         }
         
         
         ?>
     </select>
     
 </div>
</div>


<div class="form-group">
   <label for="ref_doc_name" class="col-sm-12 control-label">Ref Dr. Name  <a href="admin/add_doc/2" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;"> (ADD NEW)</a></label>
   <div class="col-sm-10">
      <select readonly class="custom-select select2"  name="quack_doc_name">
         
       <option value="self#0">self</option>
       <?php
       foreach ($doctor_list as $key => $value)
       {
        $doctor_id=$value['doctor_id'];
        $doctor_type=$value['doctor_type'];
        $doctor_title=$value['doctor_title'];
        $doctor_degree=$value['doctor_degree'];
        if($patient_info[0]['quack_doc_id']==$doctor_id)
        {
            
            echo "<option selected value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";

        }

        else
        {
         echo "<option  value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";
     }           
 }
 
 ?>
</select>  
</div>
</div>

<div class="form-group"  style="opacity: 0 !important;">
   
  <div class="col-sm-10">
   <select class="custom-select select2" id="tab_select" tabindex="10" readonly  name="tab_select">
    
   </select>
</div>
</div>



</div>


<div class="col-md-3">
 <label for="age" class="col-sm-12 control-label">Age</label> 
 <div class="form-group ml-3">
  <div class="form-check-inline">
   <input class="form-control col-sm-4" tabindex="2" id="age_dt" name="Day" type="text" placeholder="D">
   <input class="form-control col-sm-4" tabindex="3" id="age_mn" name="Month" type="text" placeholder="M">
   <input class="form-control col-sm-4" tabindex="4" id="age_yr" name="Year" type="text" placeholder="Y" >
</div>
</div>

          <!--       <div class="form-group" id="reg_div">
                              <label for="already_reg_p" class="col-sm-12 control-label">Reg Patient Name</label>
                              <div class="col-sm-10">
                                 <select  class="custom-select select2" id="already_reg_p" tabindex="7"   name="already_reg_p">
                                    <option value="">Select Patient Name</option>
                                   
                                 </select>
                              </div>
                          </div> -->
                      </div>

                      <div class="col-md-2">
                         
                          <div class="form-group">
                           <label class="col-sm-12 control-label">Gender</label>
                           <div class="form-check-inline">
                            <label for="male" class="form-check-label">
                              <input <?php if($patient_info[0]['gender']=="Male")
                              {echo 'checked' ;}?> type="radio" class="form-check-input  mb-4 ml-3" id="Male" value="Male" name="gender">Male
                          </label>
                      </div>
                      <div for="female" class="form-check-inline ml-3">
                        <label for="female" class="form-check-label">
                          <input  <?php if($patient_info[0]['gender']=="Female")
                          {echo 'checked' ;}?> type="radio" class="form-check-input" id="female" value="Female" name="gender">Female
                      </label>
                  </div>
              </div>
              
          </div>
          

          <!-- second column -->
          <div class="col-md-3">
              


            <div class="form-group">
               <label for="date_of_birth" class="col-sm-12 control-label">Date Of Birth</label>
               <div class="input-group ml-3">
                <input type="text" onchange="comp()" value="<?=$patient_info[0]['date_of_birth']?>" name="date_of_birth" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                <span class="input-group-append">
                    <span class="input-group-text add-on white">
                        <i class="icon-calendar"></i>
                    </span>
                </span>
            </div>
        </div>

        <div class="form-group">
         <label for="patient_address" class="col-sm-12 control-label">Addrees</label>
         <div class="col-sm-10">
          <textarea class="form-control"  name="patient_address" placeholder="Addrees"><?=$patient_info[0]['address']?></textarea>
      </div>
  </div>

  <div class="form-group ml-3">
   <label for="hospital_logo" class="col-sm-12 control-label">Patient Photo</label>
   <div class="fileinput fileinput-new" data-provides="fileinput">
      <div class=" border border-secondary fileinput-new thumbnail" style="width: 170px; height: 100px;">
        <img data-src="holder.js/100%x100%" src='uploads/patient_image/<?=$patient_info[0]['profile_img']?>' alt="...">
    </div>
    <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 170px; max-height: 100px;"></div>
    <div>
        <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="" name="file"></span>
        <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
    </div>
</div>
</div>
<div class="form-group col-sm-10">
  <label for="blood_group" class="">Blood Group</label>
  <select class="custom-select select2" name="blood_group" id="blood_group" required>
      <!-- <option value="">Select Blood Group</option> -->
      <?php 
      foreach ($all_blood_group as $key => $blood){ if($blood['id']==$patient_info[0]['blood_group'])
          { ?>
              <option selected value="<?=$blood['id']?>"><?=$blood['blood_group_title']?></option>
          <?php } else {?>
              <option value="<?=$blood['id']?>"><?=$blood['blood_group_title']?></option>
          <?php } } ?>
      </select>
  </div>
</div>
</div>
<div class="row">
    <div  align="CENTER" class="col-md-12">
     <button id="sub_btn" type="submit" class="btn btn-success">Update</button>
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

<script type="text/javascript">
   
   jQuery('#date_of_birth').datetimepicker({
       
      onShow:function( ct ){
         this.setOptions({
            maxDate:0
        })
     },
     timepicker:false
 });
</script>


<script type="text/javascript">


    $(document).ready(function()
    { 

      comp();
      
      $.ajax({  
          url:"<?=site_url('admin/get_all_mobile_no')?>",  
          method:"POST",  
          dataType:"json",  
          success:function(data)  
          { 
            var mobile_no_data=[];
            $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              mobile_no_data.push(value.mobile_no)
                          });

            $("#patient_mobile_no").typeahead({source:mobile_no_data});

            
        }
    });
      
      



  });


function changeDateFormat(inputDate){  // expects Y-m-d
    var splitDate = inputDate.split('-');

 // alert(splitDate.length);
 if(splitDate.length==1){
   
    return inputDate;
}

var year = splitDate[0];
var month = splitDate[1];
var day = splitDate[2]; 

return month + '/' + day + '/' + year;
}



function comp() {

  var dateString=changeDateFormat(document.getElementById('date_of_birth').value);

  if(dateString!="")
  {
      var now = new Date();
      var today = new Date(now.getYear(),now.getMonth(),now.getDate());

      var yearNow = now.getYear();
      var monthNow = now.getMonth();
      var dateNow = now.getDate();

      var dob = new Date(dateString.substring(6,10),
       dateString.substring(0,2)-1,                   
       dateString.substring(3,5)                  
       );

      var yearDob = dob.getYear();
      var monthDob = dob.getMonth();
      var dateDob = dob.getDate();
      var age = {};
      var ageString = "";
      var yearString = "";
      var monthString = "";
      var dayString = "";


      yearAge = yearNow - yearDob;

      if (monthNow >= monthDob)
        var monthAge = monthNow - monthDob;
    else {
        yearAge--;
        var monthAge = 12 + monthNow -monthDob;
    }

    if (dateNow >= dateDob)
        var dateAge = dateNow - dateDob;
    else {
        monthAge--;
        var dateAge = 31 + dateNow - dateDob;

        if (monthAge < 0) {
          monthAge = 11;
          yearAge--;
      }
  }

  age = {
      years: yearAge,
      months: monthAge,
      days: dateAge
  };

  if ( age.years > 1 ) yearString = " years";
  else yearString = " year";
  if ( age.months> 1 ) monthString = " months";
  else monthString = " month";
  if ( age.days > 1 ) dayString = " days";
  else dayString = " day";


  if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.years + yearString + ", " + age.months + monthString + ", and " + age.days + dayString + " old.";
else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
    ageString = "Only " + age.days + dayString + " old!";
else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
    ageString = age.years + yearString + " old. Happy Birthday!!";
else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.years + yearString + " and " + age.months + monthString + " old.";
else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
    ageString = age.months + monthString + " and " + age.days + dayString + " old.";
else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
    ageString = age.years + yearString + " and " + age.days + dayString + " old.";
else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
    ageString = age.months + monthString + " old.";
else ageString = "Oops! Could not calculate age!";


$('#age_dt').val(age.days+" D");
$('#age_mn').val(age.months+" M");
$('#age_yr').val(age.years+" Y");

}
}


</script>
<script src="back_assets/js/ckeditor.js"></script>
</body>
</html>