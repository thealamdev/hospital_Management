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
     <div class="row p-t-b-2">
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
    <form id="my_form" action="admin/edit_birth_certificate_post/<?=$birth_info[0]['id']?>" enctype="multipart/form-data" method="post">
     <div class="row" tabindex="0">
      <div class="col-md-3">
       <div class="form-group">
        <label for="patient_name" class="col-sm-12 control-label">Patient Name</label>
        <div class="col-sm-12">
         <input class="form-control" name="patient_name" id="patient_name" required="" value="<?=$birth_info[0]['patient_name']?>" placeholder="Patient Name" autocomplete="off" tabindex="1" type="text" autofocus="">
       </div>
     </div>
   </div>

   <div class="col-md-3">
     <div class="form-group">
      <label for="patient_name" class="col-sm-12 control-label">Mother Name</label>
      <div class="col-sm-12">
       <input class="form-control" name="mother_name" id="mother_name" required="" value="<?=$birth_info[0]['mother_name']?>" placeholder="Mother Name" autocomplete="off" tabindex="1" type="text" autofocus="">
     </div>
   </div>
 </div>

 <div class="col-md-3">
   <div class="form-group">
    <label for="patient_name" class="col-sm-12 control-label">Father Name</label>
    <div class="col-sm-12">
     <input class="form-control" name="father_name" id="father_name" required="" placeholder="Father Name" value="<?=$birth_info[0]['father_name']?>" autocomplete="off" tabindex="1" type="text" autofocus="">
   </div>
 </div>
</div>

<div class="col-md-3">
 <div class="form-group">
  <label for="patient_name" class="col-sm-12 control-label">Mobile No</label>
  <div class="col-sm-12">
   <input autocomplete="off" class="form-control" name="mobile_no" id="mobile_no"  tabindex="2" value="<?=$birth_info[0]['mobile_no']?>" placeholder="Mobile No" type="text">
 </div>
</div>
</div>

<div class="col-md-3">
 <div class="form-group">
  <label for="date_of_birth" class="col-sm-12 control-label">Date Of Birth</label>
  <div class="input-group ml-3">
   <input placeholder="dd/mm/yy" autocomplete="off" type="text"  name="date_of_birth" id="date_of_birth" class="col-sm-7 date-time-picker form-control date_of_birth"
   data-options='{"timepicker":false,"format":"Y-m-d"}'  tabindex="6"/>
   <input autocomplete="off" class="form-control"  value="<?=$birth_info[0]['date_of_birth']?>"  tabindex="2"  readonly type="text">
   <span class="input-group-append">
     <span class="input-group-text add-on white">
       <i class="icon-calendar"></i>
     </span>
   </span>
 </div>
</div>
</div>

<div class="col-md-3">
 <div class="form-group">
  <label for="place_of_birth" class="col-sm-12 control-label">Place of Birth</label>
  <div class="col-sm-12">
   <input autocomplete="off" class="form-control" name="place_of_birth" id="place_of_birth" value="<?=$birth_info[0]['place_of_birth']?>"  tabindex="2" placeholder="Place of Birth" type="text">
 </div>
</div>
</div>

<div class="col-md-3">
  <div class="form-group">
   <label class="col-sm-12 control-label">Gender</label>
   <select class="custom-select select2" id="gender" name="gender" tabindex="9">
    <option <?php if ($birth_info[0]['gender']=="Male"){ echo 'selected';}?> value="Male">Male</option>
    <option <?php if ($birth_info[0]['gender']=="Female"){ echo 'selected';}?>  value="Female">Female</option>
    <option <?php if ($birth_info[0]['gender']=="Others"){ echo 'selected';}?>  value="Others">Others</option>

  </select>
</div>
</div>

<div class="col-md-3">
  <div class="form-group">
    <label for="heigth" class="col-md-4">Height</label>
    <div class="col-md-12"><input class="form-control form-control-sm" type="text" name="height" value="<?=$birth_info[0]['height']?>" id="heigth" placeholder="" ></div>
  </div>
</div>

<div class="col-md-3">
  <div class="form-group">
    <label for="" class="col-md-4">Weight</label>
    <div class="col-md-12"><input class="form-control form-control-sm" type="text" name="weight" value="<?=$birth_info[0]['weight']?>" placeholder="" ></div>
  </div>
</div>



<div class="col-md-3">
  <div class="form-group">
    <label for="" class="col-md-4">Email</label>
    <div class="col-md-12"><input class="form-control form-control-sm" type="email" name="email" value="<?=$birth_info[0]['email']?>" placeholder="" ></div>
  </div>
</div>

<div class="col-md-3">
  <div class="form-group">
    <label for="" class="col-md-4 text-right">Cabin No</label>
    <div class="col-md-12">
      <select class="custom-select select2" name="cabin_no" id="cabin_no" required>
        <option value="">Select Cabin No</option>

        <?php 
        foreach ($room as $key => $r){ if($r['id']==$birth_info[0]['cabin_no'])
          { ?>
            <option selected value="<?=$r['id']?>"><?=$r['room_title']?></option>
          <?php } else {?>
            <option value="<?=$r['id']?>"><?=$r['room_title']?></option>
          <?php } } ?>
        </select> 
      </div>
    </div>
  </div>

  <div class="col-md-3">
    <div class="form-group">
      <label for="quack_doc_name" class="col-sm-12 control-label">Ref Dr. Name  <a href="admin/add_doc/2" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;"> (ADD NEW)</a></label>

      <div class="col-sm-12">
       <select class="custom-select select2"  name="ref_doc" required>
        <option value="">Select Doctor Title</option>
        <?php
        foreach ($doctor_list as $key => $value)
        {
          $doctor_id=$value['doctor_id'];
          $doctor_type=$value['doctor_type'];
          $doctor_title=$value['doctor_title'];
          $doctor_degree=$value['doctor_degree'];


          if($doctor_id==$birth_info[0]['ref_doc_id'])
          {
           echo "<option selected value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";
         }
         else{
           echo "<option value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";

         }



       }

       ?>
     </select> 
   </div>
 </div>
</div>



<div class="col-md-6">
  <div  id="start_webcam" class="ml-4">
    <a onclick="load_webcam()"  href="javascript:void(0)" class="btn btn-default">Start Webcam</a>
  </div>

  <div class="ml-3" id="cancel_webcam" style="display: none;">
    <a onclick="cancel_webcam()"  href="javascript:void(0)" class="btn btn-default">Cancel Webcam</a>

    <a onClick="take_snapshot()"  href="javascript:void(0)" class="btn btn-default">Take Snapshot</a>
    <input type="hidden" name="image" class="image-tag">
  </div>

  <div class="row ml-4">
   <div class="col-sm-5" id="my_camera"></div>

   <div class="col-sm-5" id="results" style="display: none;">
    <img height="153px" width="200px;" style="margin-top:23px;margin-left:30px; border: 1px solid black" src="back_assets/img/default-thumbnail.jpg">
  </div>
</div>

<div class="form-group" id="upload_image">
 <!-- <label for="" class="col-md-12 control-label">Patient Image</label> -->
 <div class="fileinput fileinput-new" data-provides="fileinput">
  <div class=" border border-secondary fileinput-new thumbnail" style="width: 150px; height: 100px; padding:  0 !important">
    <img height="100%" width="150%" src="uploads/birth_death_certificate/<?=$birth_info[0]['patient_image']?>" alt="...">
  </div>
  <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 100px;padding:  0 !important"></div>
  <div>
    <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="hospital_logo" name="file"></span>
    <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
</div>
</div>
</div>

</div>
<div class="row">
  <div  align="CENTER" class="col-md-12">
    <button id="sub_btn" type="submit" class="btn btn-success">Save</button>
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
  .card-body
  {
    padding-top: 5px !important;
    padding-bottom:5px !important;
    padding-left: 5px !important;
    padding-right:5px !important;

  }

  .col-md-12{
   padding-top: 5px !important;
   padding-bottom: 5px !important;

   padding-left: 5px !important;
   padding-right:5px !important;

 }

 .col-md-5{


   padding-left: 5px !important;
   padding-right:5px !important;

 }

 .col-md-7{

   padding-bottom: 0px !important;


 }

 .form-group{

   margin-bottom: 5px !important;


 }

 .col-md-8{

   padding-bottom: 0px !important;


 }

 .col-md-6{
  padding-left: 5px !important;
  padding-right:5px !important;


}

.col-md-4{
  padding-left: 5px !important;
  padding-right:5px !important;
  padding-bottom: 0px !important;

}

.col-md-3{
  padding-left: 5px !important;
  padding-right:5px !important;

}

</style>
<?php $this->load->view('back/footer_link');?>


<script src="back_assets/js/moment.min.js"></script>
<script src="back_assets/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="back_assets/css/tempusdominus-bootstrap-4.min.css">
<script src="back_assets/js/webcam.min.js"></script>


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

   Webcam.set({
    width: 200,
    height: 200,
    image_format: 'jpeg',
    jpeg_quality: 90
  });


 });


 function load_webcam()
 {
  Webcam.attach('#my_camera');

  $("#start_webcam").hide();
  $("#upload_image").hide();
  $("#cancel_webcam").show();
  $("#my_camera").show();
  $("#results").show();


}

function cancel_webcam()
{
  Webcam.reset();

  $("#start_webcam").show();
  $("#upload_image").show();
  $("#cancel_webcam").hide();
  $("#my_camera").hide();
  $("#results").hide();

}



function take_snapshot() {
  Webcam.snap( function(data_uri) {
    $(".image-tag").val(data_uri);
    document.getElementById('results').innerHTML = '<img height="153px" width="200px" style="margin-top:23px;margin-left:30px; border:1px solid black" src="'+data_uri+'"/>';
  } );
}
function changeDateFormat1(inputDate){  // expects Y-m-d
  var splitDate= inputDate.split('-');

 // alert(splitDate.length);
 if(splitDate.length==1){

  return inputDate;
}
else
{
  var year = splitDate[0];
  var month = splitDate[1];
  var day = splitDate[2]; 

  return day + '/' + month + '/' + year;
}



}



function changeDateFormat(inputDate){  // expects Y-m-d
    // var splitDate1 = inputDate.split('-');

    var splitDate2 = inputDate.split('-');
    if(splitDate2.length!=1){


      var year = splitDate2[0];
      var month = splitDate2[1];
      var day = splitDate2[2]; 

      return month + '/' + day + '/' + year;
    }


  }



  function comp() {

    var dateString=changeDateFormat(document.getElementById('date_of_birth').value);
    // alert(dateString);

  // mm/dd/yy

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


    $('#age_dt').val(age.days);
    $('#age_mn').val(age.months);
    $('#age_yr').val(age.years);

  }
}


function month_to_year(argument) {

  var months=$("#age_mn").val();
  var years = Math.floor(months/12);
  var months = months % 12;

  $("#age_mn").val(months);

  $("#age_yr").val(years);
}


</script>
</body>
</html>