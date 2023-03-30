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
      <form action="admin/add_appointment_post" method="post" enctype="multipart/form-data" id="day_form">
        <div class="row mt-3">
          <div class="col-md-5 ml-4">

            <div class="row"> 

              <div class="form-group col-md-6">
                <label for="user_name" class="col-sm-12 control-label">UHID</label>
                <div class="col-sm-10">
                  <select class="custom-select select2" onchange="get_uhid_info()" id="uhid"  name="uhid" >
                    <option value="">--Select--</option>
                    <?php
                    foreach ($uhid as $key => $value)
                      {?>

                        <option value='<?=$value['gen_id']?>#<?=$value['id']?>'><?=$value['gen_id']?></option>

                      <?php }

                      ?>
                    </select> 
                  </div>
                </div> 


                <div class="form-group col-md-6">
                 <label for="hospital_title" class="col-sm-12 control-label">Patient Name</label>
                 <div class="col-sm-12">
                   <input class="form-control" name="patient_name" id="patient_name" required="" placeholder="Patient Name" type="text">
                 </div>
               </div>

               <div class="form-group col-md-6">
                 <label for="hospital_title" class="col-sm-12 control-label">Mobile No</label>
                 <div class="col-sm-12">
                   <input required class="form-control" name="mobile_no" id="mobile_no"  type="number" placeholder="Ex: 01671235789">
                 </div>
               </div>

               <div class="form-group col-md-6">
                <label for="user_name" class="col-sm-12 control-label">Blood Group</label>
                <div class="col-sm-10">
                  <select class="custom-select select2" id="blood_group"  name="blood_group" >
                    <option value="">--Select--</option>
                    <?php
                    foreach ($all_blood_group as $key => $value)
                      {?>

                        <option value='<?=$value['id']?>'><?=$value['blood_group_title']?></option>

                      <?php }

                      ?>
                    </select> 
                  </div>
                </div> 

                <div class="col-md-7">
                  <label for="age" class="col-sm-12 control-label">Age</label> 
                  <div class="form-group ml-3">
                    <div class="form-check-inline">
                     <input class="form-control col-sm-4" tabindex="3" autocomplete="off" id="age_dt" name="Day" type="text" placeholder="D">
                     <input class="form-control col-sm-4" tabindex="4" autocomplete="off" onchange="month_to_year()" id="age_mn" name="Month" type="text" placeholder="M">
                     <input class="form-control col-sm-4" tabindex="5" autocomplete="off" id="age_yr" name="Year" type="text" placeholder="Y" >
                   </div>
                 </div>
               </div>


               <div class="form-group col-md-5">  
                <label class="col-sm-12 control-label">Gender</label>
                <select class="custom-select select2 ml-3" id="gender" name="gender" required="" tabindex="9">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Others">Others</option>

                </select>

              </div>

              <div class="form-group col-md-6">  
                <label class="col-sm-12 control-label">New/Old/Report</label>
                <select class="custom-select select2 ml-3" onchange="get_dr_time()" id="patient_type" name="patient_type" required="" tabindex="9">
                  <option value="New">New</option>
                  <option value="Old">Old</option>
                  <option value="Report">Report</option>
                </select>
              </div>

              <div class="form-group col-md-6">
               <label for="patient_address" class="col-sm-12 control-label">Address</label>
               <div class="col-sm-12">
                <textarea  class="form-control" id="patient_address" name="patient_address" placeholder="Addrees"></textarea>
              </div>
            </div>

            <div class="form-group col-md-6">

             <label for="ref_doc_name" class="col-sm-12 control-label">Doctor Name</label>
             <div class="col-sm-12">
              <select class="custom-select select2" onchange="get_dr_time()" required="" id="doc_name" name="doc_name">
                <option value="">Select Doctor Title</option>

                <?php
                foreach ($doc_info as $key => $value)
                {
                  $doctor_id=$value['doctor_id'];
                  $doctor_type=$value['doctor_type'];
                  $doctor_title=$value['doctor_title'];
                  $doctor_degree=$value['doctor_degree'];

                  echo "<option value='$doctor_id#$doctor_title#$doctor_degree'>$doctor_title ($doctor_degree)</option>";

                }


                ?>
              </select>

            </div>
          </div>



          <div class="form-group col-md-6">

            <label for="ref_doc_name" class="col-sm-12 control-label">Ref Doctor Name</label>
            <div class="col-sm-12">
              <select class="custom-select select2"  required="" id="ref_doc_name" name="ref_doc_name">
                <option value="">Select Doctor Title</option>
                <option  value="self#0">self</option>

                <?php
                foreach ($doc_info as $key => $value)
                {
                  $doctor_id=$value['doctor_id'];
                  $doctor_type=$value['doctor_type'];
                  $doctor_title=$value['doctor_title'];
                  $doctor_degree=$value['doctor_degree'];

                  echo "<option value='$doctor_id#$doctor_title#$doctor_degree'>$doctor_title ($doctor_degree)</option>";

                }


                ?>
              </select>

            </div>
          </div>

          <div class="form-group col-md-6">
            <label for="dr_available" class="col-sm-12 control-label">Dr. Available</label>
            <div class="col-sm-12">
              <!-- <span class="form-control" id="schedule"></span> -->
              <input type="text" readonly="" required="" id="dr_available"  class="form-control" name="dr_available">
            </div>
          </div>

          <div class="form-group col-md-6">
            <label for="col-sm-12 control-label" class="col-sm-12 control-label">Appointment Time</label>

            <div class="col-sm-12">
              <div class="input-group focused appointment_time" id="appointment_time"data-target-input="nearest">
                <input required  id="appointment_time_to" type="text" name="appointment_time_to" class="form-control datetimepicker-input" data-target="#appointment_time_to"/>
                <div class="input-group-append" data-target="#appointment_time_to" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group col-md-6">
            <label for="serial_no" class="col-sm-12 control-label">Serial No</label>
            <div class="col-sm-12">
              <!-- <span class="form-control" id="schedule"></span> -->
              <input type="text"  readonly="" id="serial_no"  class="form-control" name="serial_no">
            </div>

          </div>

          <div class="form-group col-md-6">
            <label for="hospital_title" class="col-sm-12 control-label">Total Amount</label>
            <div class="col-sm-12">
             <input class="form-control" name="total_amount" readonly="" id="total_amount"  type="text">
           </div>
         </div>

         <div class="form-group col-md-6">
           <label for="hospital_title" class="col-sm-12 control-label">Discount</label>
           <div class="col-sm-12">
             <input class="form-control" name="discount" id="discount" oninput="discount_effect()" type="text">
           </div>
         </div>

         <div class="form-group col-md-6">
          <label for="hospital_title" class="col-sm-12 control-label">Net Amount</label>
          <div class="col-sm-12">
           <input class="form-control" name="net_amount" id="net_amount" readonly="" type="text">
         </div>
       </div>

       <div class="form-group col-md-6">
         <label for="hospital_title" class="col-sm-12 control-label">Total Paid</label>
         <div class="col-sm-12">
           <input class="form-control" name="total_paid" oninput="total_paid_effect()" id="total_paid" type="text">
         </div>
       </div>

       <div class="form-group col-md-6">
        <label for="hospital_title" class="col-sm-12 control-label">Due</label>
        <div class="col-sm-12">
         <input class="form-control" name="due" id="due" readonly=""  type="text">
       </div>
     </div>


   </div>
 </div>

 <div class="col-md-6" style="margin-left:40px;">
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



<div class="form-group mt-3 ml-4" id="upload_image">
 <!-- <label for="" class="col-md-12 control-label">Patient Image</label> -->
 <div class="fileinput fileinput-new" data-provides="fileinput">
  <div class=" border border-secondary fileinput-new thumbnail" style="width: 150px; height: 100px; padding:  0 !important">
    <img height="100%" width="150%" src="back_assets/img/default-thumbnail.jpg" alt="...">
  </div>
  <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="width: 150px; height: 100px;padding:  0 !important"></div>
  <div>
    <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="hospital_logo" name="file"></span>
    <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
</div>
</div>

<div class="form-group" style="z-index: 0;">
  <div class="input-group">
    <input type="text" id="dp"  class="date-time-picker form-control col-sm-12"
    data-options='{"inline":true,"timepicker":false, "format":"Y-m-d"}'/>
    <span style="padding: 0px !important" class="ml-2 col-sm-5 border border-primary">
      <div class="anyclass" style="overflow-y: scroll;height:200px;text-align: center;display:none;" id="anyclass">
        <p style="color: red; font-size: 20px;">No Schedule</p>
      </div>
    </span>
  </div>
</div>

<div class="col-md-4 mt-5">
 <button class="btn btn-success form-control" id="save_btn_id">Save</button>
</div>

<input type="hidden" id="save_day" name="save_day">
<input type="hidden" id="event_date" name="event_date">
<input type="hidden" id="event_date1" name="event_date1">
<input type="hidden" id="save_time" name="save_time">
<input type="hidden" id="app_save_time" name="app_save_time">
<input type="hidden" id="schedule_id" name="schedule_id">

</div>

</div>

</form>

</div>


</div>
</div>


</form>
</div>


</div>

<!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
     <div class="control-sidebar-bg shadow white fixed"></div>
   </div>

   <?php $this->load->view('back/footer_link');?>

   <script src="back_assets/js/moment.min.js"></script>
   <script src="back_assets/js/tempusdominus-bootstrap-4.min.js"></script>


   <link rel="stylesheet" href="back_assets/css/tempusdominus-bootstrap-4.min.css">


   <script src="back_assets/js/webcam.min.js"></script>


   <!-- Configure a few settings and attach camera -->
   <script language="JavaScript">



    $(document).ready(function()
    { 

      var d = new Date();

      var month = d.getMonth()+1;
      var day = d.getDate();

      var output = 
      ((''+day).length<2 ? '0' : '') + day + '-' +
      ((''+month).length<2 ? '0' : '') + month + '-' + d.getFullYear();

      
      var eventDate = output;

      var output1 = 
      d.getFullYear() + '-' +
      ((''+month).length<2 ? '0' : '') + month + '-' +((''+day).length<2 ? '0' : '') + day;

      var eventDate1 = output1;

      var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

      var dateElement = eventDate.split("-");
      var dateFormat = dateElement[2]+'-'+dateElement[1]+'-'+dateElement[0];
        var date = new Date(dateFormat+'T10:00:00Z'); //To avoid timezone issues
        var day = weekday[date.getDay()];

        $("#save_day").val(day);
        $("#event_date").val(eventDate);
        $("#event_date1").val(eventDate1);


        Webcam.set({
          width: 200,
          height: 200,
          image_format: 'jpeg',
          jpeg_quality: 90
        });


        $('#day_form').on('submit', function() 
        {

          $('#app_save_time').val(convertTo24Hour($('#appointment_time_to').val().toLowerCase()));

          var dr_schedule = $('#dr_available').val().toLowerCase();

          var app_time = convertTo24Hour($('#appointment_time_to').val().toLowerCase());   

          var dr_f=dr_schedule.split('-');
          var f=convertTo24Hour(dr_f[0]);
          var t=convertTo24Hour(dr_f[1]);

          var stt = new Date("November 13, 2013 " + f);
          stt = stt.getTime();

          var endt = new Date("November 13, 2013 " + t);
          endt = endt.getTime();

          var appt = new Date("November 13, 2013 " + app_time);
          appt = appt.getTime();

          // alert(dr_schedule);
          // alert(endt);
          // alert(appt);

          if(stt <= appt && endt >= appt )
          {
            return true;
          }

          alertify.alert("<b>Appointement Time must be in between the Dr. Available Time</b>");
          return false;

        });



      });


    function get_uhid_info() {

      var uhid= $("#uhid option:selected").val();

      $.ajax({  
        url:"<?=site_url('admin/get_uhid_info')?>",  
        method:"POST", 
        data:{uhid:uhid},  
        dataType:"json",  
        success:function(data)  
        { 

          $.each(data, function (key, value) 
          {

            if(value.age != "")
            {
              var age_dt=value.age.split("D");
              var age_mn=value.age.split("M");
              var age_yr=value.age.split("Y");

        // alert(age_dt.length);
        // alert(age_mn.length);
        // alert(age_yr.length);

        // D-M-Y
        if(age_dt.length == 2 && age_mn.length == 2 )
        {

          var age_dt1=value.age.split("D");
          var age_mn1=age_dt1[1].split("M");

          $("#age_dt").val(age_dt[0]);
          $("#age_mn").val(age_mn1[0]);
          $("#age_yr").val(age_mn[1].split('Y')[0]);

          // alert("D-M-Y");
        }
        // // D-M
        else if(age_dt.length == 2 && age_mn.length == 2 && age_yr.length == 1)
        {
          var age_dt1=value.age.split("D");
          var age_mn1=age_dt1[1].split("M");

          $("#age_dt").val(age_dt1[0]);
          $("#age_mn").val(age_mn1[0]);
          $("#age_yr").val("");
        }
        // // // M-Y
        else if(age_dt.length == 1 && age_mn.length == 2 && age_yr.length == 2)
        {
          var age_mn1=value.age.split("M");
          var age_yr1=age_mn1[1].split("Y");

          $("#age_dt").val("");
          $("#age_mn").val(age_mn1[0]);
          $("#age_yr").val(age_yr1[0]);

          // alert("M-Y");
        }
        // // // D-Y
        else if(age_dt.length == 2 && age_mn.length == 1 && age_yr.length == 2)
        {
          var age_dt1=value.age.split("D");
          var age_yr1=age_dt1[1].split("Y");

          $("#age_mn").val("");
          $("#age_dt").val(age_dt1[0]);
          $("#age_yr").val(age_yr1[0]);

          // alert("D-Y");
        }

        // // D
        else if(age_dt.length == 2 && age_mn.length == 1 && age_yr.length == 1)
        {

          $("#age_mn").val("");
          $("#age_dt").val(age_dt[0]);
          $("#age_yr").val("");

          // alert(age_dt.length);
        }

         // M
         else if(age_mn.length == 2 && age_dt.length == 1 && age_yr.length == 1)
         {

          $("#age_mn").val(age_mn[0]);
          $("#age_dt").val("");
          $("#age_yr").val("");

          // alert("M");
        }
        
          // Y
          else if(age_yr.length == 2 && age_mn.length == 1 && age_dt.length == 1)
          {
            $("#age_mn").val("");
            $("#age_dt").val("");
            $("#age_yr").val(age_yr[0]);

          // alert("Y");
        }
      }


      $('#patient_name').val(value.patient_name);
      $('#mobile_no').val(value.mobile_no);
      $('#patient_address').val(value.address);
      $("#gender").select2().val(value.gender).trigger("change");
      $("#blood_group").select2().val(value.blood_group).trigger("change");

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


    function get_dr_time()
    {


      var event_date1 =$("#event_date1").val();
      get_av_schedule(event_date1);

    }

    function get_av_schedule(eventDate) {

      var doc_id=$("#doc_name option:selected").val();
      var day =$("#save_day").val();


      $.ajax({  
        url:"<?=site_url('admin/get_available_schedule')?>",  
        method:"POST",
        data:{doc_id:doc_id,day:day,event_date1:eventDate},  
        dataType:"json",  
        success:function(data)  
        { 

          if(data['schedule_info'] != "" || data['appointment_info'] != "")
          {

            // $("#anyclass").show();

            $("#anyclass").show();
            var app_data="";

            $.each(data['appointment_info'], function (key, value) {

              app_data +='<div style="color: blue; font-size: 18px;">'+convertTo12Hour(value['appointment_time'])+' (Serial: '+value['serial_no']+')</div>';
            });

            $("#anyclass").html(app_data);

            

            $("#dr_available").val(convertTo12Hour(data['schedule_info'][0]['start_time'])+' - '+convertTo12Hour(data['schedule_info'][0]['end_time']));

            if($("#patient_type").val()=="New")
            {
              $("#total_amount").val(data['schedule_info'][0]['doc_fee_new']);
              $("#net_amount").val(data['schedule_info'][0]['doc_fee_new']);
              $("#due").val(data['schedule_info'][0]['doc_fee_new']);
            }
            else if($("#patient_type").val()=="Old")
            {
              $("#total_amount").val(data['schedule_info'][0]['doc_fee_old']);
              $("#net_amount").val(data['schedule_info'][0]['doc_fee_old']);
              $("#due").val(data['schedule_info'][0]['doc_fee_old']);
            }
            else
            {
              $("#total_amount").val(data['schedule_info'][0]['doc_fee_report']);
              $("#net_amount").val(data['schedule_info'][0]['doc_fee_report']);
              $("#due").val(data['schedule_info'][0]['doc_fee_report']);
            }

            $('#serial_no').val(data['serial']);
            // $('#schedule_id').val(data['id']);
            $('#schedule_id').val(data['schedule_info'][0]['id']);
            $("#save_time").val(data['schedule_info'][0]['start_time']+'-'+data['schedule_info'][0]['end_time']);
            
            $("#save_btn_id").prop("disabled",false);
          }
          else
          {
           $("#anyclass").hide();
           $("#dr_available").val("");
           $("#total_amount").val("");
           $("#net_amount").val("");
           $("#due").val("");
           $("#discount").val("");
           $("#total_paid").val("");
           $("#serial_no").val("");
           $("#save_time").val("");
           $("#save_btn_id").attr("disabled","disabled");
         }         

       }
     });
    }

    function set_schedule(s_time,e_time,serial_no) 
    {
      // alert(s_time);
      // alert(e_time);
      var date=$("#event_date").val();
      var day=$("#save_day").val();

      $("#save_time").val(s_time+'-'+e_time);

      $('#serial_no').val(serial_no+1);
      
      var s_time=convertTo12Hour(s_time);

      $("#schedule").val(day+'  '+date+'  '+s_time+'-'+convertTo12Hour(e_time));
    }

    function convertTo12Hour(oldFormatTime) {
      console.log("oldFormatTime: " + oldFormatTime);
      var oldFormatTimeArray = oldFormatTime.split(":");

      var HH = parseInt(oldFormatTimeArray[0]);
      var min = oldFormatTimeArray[1];

      var AMPM = HH >= 12 ? "PM" : "AM";
      var hours;
      if(HH == 0){
        hours = HH + 12;
      } else if (HH > 12) {
        hours = HH - 12;
      } else {
        hours = HH;
      }

      if(hours.length < 2)
      {
        hours='0'+hours;
      }

      if(min.length < 2)
      {
        min='0'+min;
      }

      var newFormatTime = hours + ":" + min + " " + AMPM;

      // alert(newFormatTime);
      return newFormatTime;
    }


    $('#dp').change(function () { //Your date picker input

      var weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

      var eventDate = $(this).val();

      var dateElement = eventDate.split("-");
      var dateFormat = dateElement[0]+'-'+dateElement[1]+'-'+dateElement[2];
        var date = new Date(dateFormat+'T10:00:00Z'); //To avoid timezone issues
        var day = weekday[date.getDay()];

        $("#save_day").val(day);
        $("#event_date").val(eventDate);
        $("#event_date1").val(eventDate);

        get_av_schedule(eventDate);

      });


    // function addMinutesToTime(time, minsAdd) {
    //   function z(n){ return (n<10? '0':'') + n;};
    //   var bits = time.split(':');
    //   var mins = bits[0]*60 + +bits[1] + +minsAdd;
    //   return z(mins%(24*60)/60 | 0) + ':' + z(mins%60);  
    // } 


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

    function timeDiff(a,b)
    {

      var first = a.split(":")
      var second = b.split(":")

      var xx;
      var yy;

      if(parseInt(first[0]) < parseInt(second[0])){          

        if(parseInt(first[1]) < parseInt(second[1])){

          yy = parseInt(first[1]) + 60 - parseInt(second[1]);
          xx = parseInt(first[0]) + 24 - 1 - parseInt(second[0])

        }else{
          yy = parseInt(first[1]) - parseInt(second[1]);
          xx = parseInt(first[0]) + 24 - parseInt(second[0])
        }

        
        
      }else if(parseInt(first[0]) == parseInt(second[0])){

        if(parseInt(first[1]) < parseInt(second[1])){

          yy = parseInt(first[1]) + 60 - parseInt(second[1]);
          xx = parseInt(first[0]) + 24 - 1 - parseInt(second[0])

        }else{
          yy = parseInt(first[1]) - parseInt(second[1]);
          xx = parseInt(first[0]) - parseInt(second[0])
        }
        
      }else{


        if(parseInt(first[1]) < parseInt(second[1])){

          yy = parseInt(first[1]) + 60 - parseInt(second[1]);
          xx = parseInt(first[0]) - 1 - parseInt(second[0])

        }else{
          yy = parseInt(first[1]) - parseInt(second[1]);
          xx = parseInt(first[0]) - parseInt(second[0])
        }
        
        
      }

      var total_time=(xx*60)+yy;

      return total_time;  
    }


    function discount_effect(argument) {

      // alert("hi");

      var discount=$('#discount').val();
      var total_amount=$('#total_amount').val();

      if(discount=="")
      {
        discount=0;
      }

      if(total_amount=="")
      {
        total_amount=0;
      }

      var net_amount=parseInt(total_amount)-parseInt(discount);

      $('#net_amount').val(net_amount);

      total_paid_effect();


    }

    function total_paid_effect(argument) {

      // alert("hi");

      var net_amount=$('#net_amount').val();
      var total_paid=$('#total_paid').val();

      if(net_amount=="")
      {
        net_amount=0;
      }

      if(total_paid=="")
      {
        total_paid=0;
      }


      var due=parseInt(net_amount)-parseInt(total_paid);

      $('#due').val(due);


    }

    $(function () {

      $('#appointment_time_to').datetimepicker({
        format: 'LT'
      });
    });

    function convertTo24Hour(time) {
      var hours = parseInt(time.substr(0, 2));
      if(time.indexOf('am') != -1 && hours == 12) {
        time = time.replace('12', '0');
      }
      if(time.indexOf('pm')  != -1 && hours < 12) {
        time = time.replace(hours, (hours + 12));
      }
      return time.replace(/(am|pm)/, '');
    }



  </script>



</body>
</html>