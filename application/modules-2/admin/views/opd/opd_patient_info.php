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

    <input type="hidden" value="<?=$order_id?>" name="order_id" id="order_id">
    <input type="hidden" value="<?=$patient_id?>" name="patient_id" id="patient_id">
    <input type="hidden" value="<?=$is_ipd_patient?>" name="is_ipd_patient" id="is_ipd_patient">

    <form id="my_form" action="admin/save_test_order_info" method="post">
     <div class="row" tabindex="0">
      <div class="col-md-3">
       <div class="form-group">
        <label for="patient_name" class="col-sm-12 control-label">Patient Name</label>
        <div class="col-sm-12">
         <input class="form-control" name="patient_name" id="patient_name" required="" placeholder="Patient Name" autocomplete="off" tabindex="1" type="text" autofocus="">
       </div>
     </div>
   </div>

   <div class="col-md-3">
     <div class="form-group">
      <label for="patient_name" class="col-sm-12 control-label">Mobile No</label>
      <div class="col-sm-12">
       <input autocomplete="off" class="form-control" name="mobile_no" id="mobile_no"  tabindex="2" placeholder="Mobile No" type="text">
     </div>
   </div>
 </div>

 <div class="col-md-3">
   <label for="age" class="col-sm-12 control-label">Age</label> 
   <div class="form-group ml-3">
    <div class="form-check-inline">
     <input class="form-control col-sm-4" tabindex="3" autocomplete="off" id="age_dt" name="Day" type="text" placeholder="D">
     <input class="form-control col-sm-4" tabindex="4" autocomplete="off" onchange="month_to_year()" id="age_mn" name="Month" type="text" placeholder="M">
     <input class="form-control col-sm-4" tabindex="5" autocomplete="off" id="age_yr" name="Year" type="text" placeholder="Y" >
   </div>
 </div>
</div>

<div class="col-md-3">
 <div class="form-group">
  <label for="date_of_birth" class="col-sm-12 control-label">Date Of Birth</label>
  <div class="input-group ml-3">
   <input placeholder="dd/mm/yy" value="0000-00-00" autocomplete="off" type="text" onchange="comp()" name="date_of_birth" id="date_of_birth" class="col-sm-7 date-time-picker form-control date_of_birth"
   data-options='{"timepicker":false,"format":"Y-m-d"}' value="" tabindex="6"/>
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
    <label for="ref_doc_name" class="col-sm-12 control-label">Dr. Name  <a href="admin/add_doc/1" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;"> (ADD NEW)</a></label>
    <div class="col-sm-12">
     <select  class="custom-select select2" id="ref_doc_name" tabindex="7"  required="" name="ref_doc_name">
      <option value="">--Select--</option>
      <option value="self#0">self</option>
      <?php
      foreach ($doctor_list as $key => $value)
      {
        $doctor_id=$value['doctor_id'];
        $doctor_type=$value['doctor_type'];
        $doctor_title=$value['doctor_title'];
        $doctor_degree=$value['doctor_degree'];
        $doctor_profile=$value['profile_img'];

        echo "<option value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";

      }


      ?>
    </select>
  </div>
</div>

</div>

<div class="col-md-3">
  <div class="form-group">
    <label for="quack_doc_name" class="col-sm-12 control-label">Ref Dr. Name  <a href="admin/add_doc/2" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;"> (ADD NEW)</a></label>

    <div class="col-sm-12">
     <select class="custom-select select2" id="quack_doc_name" name="quack_doc_name" required="" tabindex="8">
      <option value="">--Select--</option>
      <option value="self#0">self</option>
      <?php
      foreach ($doctor_list as $key => $value)
      {
        $doctor_id=$value['doctor_id'];
        $doctor_type=$value['doctor_type'];
        $doctor_title=$value['doctor_title'];
        $doctor_degree=$value['doctor_degree'];
        $doctor_profile=$value['profile_img'];

        echo "<option value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";    
      }

      ?>
    </select>
  </div>
</div>
</div>

<div class="col-md-3">
  <div class="form-group">
   <label class="col-sm-12 control-label">Gender</label>
   <select class="custom-select select2" id="gender" name="gender" tabindex="9">
    <option value="Male">Male</option>
    <option value="Female">Female</option>
    <option value="Others">Others</option>

  </select>

</div>
</div>

<div class="form-group ml-2">
 <label class="col-sm-12 control-label">Ipd Patient</label>
 <div class="form-check-inline">
  <label for="male" class="form-check-label">
    <input onchange="get_ipd_patient_id()"  type="radio" class="form-check-input  mb-4 ml-3" id="yes" tabindex="10" value="1" name="ipd_patient">Yes
  </label>
</div>
<div for="female" class="form-check-inline">
  <label for="no" class="form-check-label">
    <input onchange="clear_all_data()" checked type="radio" tabindex="10" class="form-check-input mb-4 ml-3" id="no" value="0" name="ipd_patient">No
  </label>
</div>
</div>


<div class="form-group ml-2">
 <label class="col-sm-12 control-label">Appointment Patient</label>
 <div class="form-check-inline">
  <label for="male" class="form-check-label">
    <input  onchange="get_appointment_patient_id()" type="radio" class="form-check-input  mb-4 ml-3" id="yes" tabindex="10" value="1" name="appointment_patient">Yes
  </label>
</div>
<div class="form-check-inline">
  <label for="no" class="form-check-label">
    <input onchange="clear_all_data()" checked type="radio" tabindex="10" class="form-check-input mb-4 ml-3" id="no" value="0" name="appointment_patient">No
  </label>
</div>
</div>

<div class="form-group" id="appointment_patient_id_div">
  <label for="appointment_patient_id" class="col-sm-12 control-label">Appointment Patient ID</label>
  <div class="col-sm-12">
   <select onchange="get_appointment_patient_info()" class="custom-select select2" id="appointment_patient_id" tabindex="13"   name="appointment_patient_id">
   </select>
 </div>
</div>


<div class="form-group ml-2">
 <label class="col-sm-12 control-label">UHID Patient</label>
 <div class="form-check-inline">
  <label for="male" class="form-check-label">
    <input  onchange="get_uhid_patient_id()" type="radio" class="form-check-input  mb-4 ml-3" id="yes" tabindex="10" value="1" name="uhid_patient">Yes
  </label>
</div>
<div class="form-check-inline">
  <label for="no" class="form-check-label">
    <input onchange="clear_all_data()" checked type="radio" tabindex="10" class="form-check-input mb-4 ml-3" id="no" value="0" name="uhid_patient">No
  </label>
</div>
</div>

<div class="form-group" id="uhid_patient_id_div">
  <label for="uhid_patient_id" class="col-sm-12 control-label">UHID Patient ID</label>
  <div class="col-sm-12">
   <select onchange="get_uhid_patient_info()" class="custom-select select2" id="uhid_patient_id" tabindex="13"   name="uhid_patient_id">
   </select>
 </div>
</div>






<div class="form-group" id="reg_div">
  <label for="already_reg_p" class="col-sm-12 control-label">Reg Patient Name</label>
  <div class="col-sm-10">
   <select  class="custom-select select2" id="already_reg_p" tabindex="11"   name="already_reg_p">
    <option value="">Select Patient Name</option>

  </select>
</div>
</div>



<div class="col-md-3">
  <div class="form-group" id="ipd_patient_id_div">
    <label for="ipd_patient_id" class="col-sm-12 control-label">Ipd Patient ID</label>
    <div class="col-sm-12">
     <select  class="custom-select select2" id="ipd_patient_id" tabindex="12"   name="ipd_patient_id">
     </select>
   </div>
 </div>
</div>

<div class="col-md-3">
  <div class="form-group" id="cabin_no_div">
    <label for="cabin_no" class="col-sm-12 control-label">Cabin No</label>
    <input autocomplete="off" readonly="" class="form-control" name="cabin_no" id="cabin_no"   placeholder="Cabin No" type="text">
  </div>
</div>



<!-- <div class="col-md-5" id="d_img_div">
  <img id="d_img" src='' style="width:150px;height:100px"/>
  <img id="r_d_img" src='' style="margin-top: 15px; width:150px;height:100px"/>
</div> -->


<!-- second column -->

<!-- <div class="form-group">
  <label for="address" class="col-sm-12 control-label">Address</label>
  <div class="col-sm-10">
   <textarea tabindex="-1" autocomplete="off" class="form-control" id="address" name="patient_address" placeholder="Addrees"></textarea>
 </div>
</div> -->

<!-- <div class="form-group">
  <label for="patient_name" class="col-sm-12 control-label">Patient Photo</label>

  <div class="col-sm-10">

    <img id="p_img" src='' style="display:none; width:150px;height:100px"/>

    <input type="hidden" id="img_hidden" name="img_hidden">

    <input tabindex="-1" class="form-control" name="file" id="patient_photo"  placeholder="Patient Name" type="file">
  </div>
</div> -->


<!-- <div class="form-group col-sm-10">
  <label for="blood_group" class="">Blood Group</label>
  <select tabindex="-1" class="custom-select select2" name="blood_group" id="blood_group">

 </select>
</div> -->

</div>

<br>
<div class="all_test_cart_info" id="all_test_cart_info">
  <?php $this->load->view('opd/all_test_cart_info'); ?>
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

   var order_id=$('#order_id').val();
   var patient_id=$('#patient_id').val();
   var is_ipd_patient=$('#is_ipd_patient').val();

   if(order_id != "" && patient_id && is_ipd_patient)
   {
    window.open('<?=base_url();?>admin/patient_ordered_test_info/'+order_id+'/'+patient_id+'/'+ is_ipd_patient,'_blank','width=560,height=340,toolbar=0,menubar=0,location=0');

  }



  $('#my_form').submit(function() {

    $("#save_button").prop("disabled",true);

    if(parseInt($("#discount").val()) > parseInt($("#discount_limit").val()))
    {
      alertify.alert("<b>Discount must be less or equal than Discount Limit</b>");
      $("#save_button").prop("disabled",false);
  
      return false;
    }

    if($("#discount").val() != "" && $("#discount_ref").val() == "")
    {
      alertify.alert("<b>Discount Reference can not be empty</b>");
      $("#save_button").prop("disabled",false);
  
      return false;

    }

    if(parseInt($("#total_paid").val()) > parseInt($("#net_total").val()))
    {
      alertify.alert("<b>Total Paid Cant Be Greater Than Net Total</b>");
      $("#save_button").prop("disabled",false);

      return false;
    }

  });

  $("#test_info_table_filter").find("input").attr('tabindex', 13);

  $("#reg_div").hide();
  $("#ipd_patient_id_div").hide();
  $("#cabin_no_div").hide();
  $('#appointment_patient_id_div').hide();
  $('#uhid_patient_id_div').hide();

  var mobile_no_data=[];

  $.ajax({  
    url:"<?=site_url('admin/get_all_mobile_no')?>",  
    method:"POST",  
    dataType:"json",  
    success:function(data)  
    { 
                        // var mobile_no_data=[];
                        $.each(data, function (key, value) {
                                // $.each(value, function (key, value) {

                                  mobile_no_data.push(value.mobile_no)
                                });

                        $("#mobile_no").typeahead({source:mobile_no_data});


                      }
                    });


  $('#patient_name').focus();

  $("#quack_doc_name").select2();
  $("#quack_doc_name").next(".select2").find(".select2-selection").focus(function() {
   $("#quack_doc_name").select2("open");


 });

  $("#ref_doc_name").select2();
  $("#ref_doc_name").next(".select2").find(".select2-selection").focus(function() {
   $("#ref_doc_name").select2("open");

 });

  $("#tab_select").select2();
  $("#tab_select").next(".select2").find(".select2-selection").focus(function() {

   $('#patient_name').focus();
 });




    // $("#blood_group").empty();
    // $("#blood_group").append('<option value="0">Select Blood Group</option>');
    

    // $.ajax({  
    //   url:"<?=site_url('admin/get_all_blood_group')?>",  
    //   method:"POST",  
    //   dataType:"json",  
    //   success:function(data)  
    //   { 
    //    $.each(data, function (key, value) {
    //                             // $.each(value, function (key, value) {
    //                               $("#blood_group").append('<option  value="' + value.id + '">' + value.blood_group_title + '</option>');
    //                             });
    //                         // });
    //                       }
    //                     });


    $(document).on('input','#mobile_no', function(event)
    {

     $("#reg_div").hide();

   });



    // $(document).on('focusout','#mobile_no', function(event)
    // {




    // });


    // $(document).on('change','#ref_doc_name', function(event)
    // {

    //   // $("#d_img").attr("src","uploads/doctor_image/");


    //   var doc_id=$("#ref_doc_name option:selected").val();

    //   var doc_id=doc_id.split('#');

    //   $.ajax({  
    //     url:"<?=site_url('admin/get_doc_img')?>",  
    //     method:"POST", 
    //     data:{doc_id:doc_id[1]},  
    //     dataType:"json",  
    //     success:function(data)  
    //     { 
    //       $("#d_img").attr("src","uploads/doctor_image/"+data[0].profile_img);
    //     }

    //   });

    // });

    $(document).on('change','#quack_doc_name', function(event)
    {
      $('.add_this_test').prop("disabled",true);

      // $("#r_d_img").attr("src","uploads/doctor_image/");

      var doc_id=$("#quack_doc_name option:selected").val();

      doc_id=doc_id.split('#');

      $.ajax({  
        url:"<?=site_url('admin/get_doc_img')?>",  
        method:"POST", 
        data:{doc_id:doc_id[1]},  
        dataType:"json",  
        success:function(data)  
        { 

          $.ajax({  
            url:"<?=site_url('admin/all_test_cart_info')?>",  
            method:"POST", 
            data:{doc_id:doc_id[1]},  
            dataType:"html",  
            success:function(data)  
            { 
             $('#all_test_cart_info').html(data);

             if ($.fn.DataTable.isDataTable("#test_info_table")) {
              $('#test_info_table').DataTable().clear().destroy();
            }

            $("#test_info_table").dataTable({});

            $('.add_this_test').prop("disabled",false);
          }

        });

          // $("#r_d_img").attr("src","uploads/doctor_image/"+data[0].profile_img);
        }

      });

    });



    $(document).on('click','#opd_patient_ul>li', function(event)
    {

      get_all_opd_existing_data(mobile_no_data);

    });

    $("#mobile_no").keyup(function(){

     get_all_opd_existing_data(mobile_no_data);

   });





    $(document).on('change','#already_reg_p', function(event)
    {

              // $('#mobile_no').focus();

              $("#ipd_patient_id_div").hide();
              $("#cabin_no_div").hide();
              $("#appointment_patient_id_div").hide();

              if($("#already_reg_p option:selected").val()!="")
              {

                $('.add_this_test').prop("disabled",true);
                get_opd_patient_info();
              }
              else
              {
                clear_all_data(); // clear all data
              }
              

            });


  });



$(document).on('change','#ipd_patient_id', function(event)
{


 if($("#ipd_patient_id option:selected").val()!="0")
 {


  $('.add_this_test').prop("disabled",true);

  get_ipd_patient_info();
}




});



function get_opd_patient_info() {

  var patient_mobile_no=$("#mobile_no").val();
  var patient_id=$("#already_reg_p option:selected").val();



  var blood_group_id;
  var ref_doc_id;
  var quack_doc_id;




  $.ajax({  
    url:"<?=site_url('admin/get_all_info_by_mobile_no_p_id')?>",  
    method:"POST",
    data:{patient_mobile_no:patient_mobile_no,patient_id:patient_id},  
    dataType:"json",  
    success:function(data)  
    { 
     $.each(data, function (key, value) 
     {
      blood_group_id=value.blood_group;
      quack_doc_id=value.quack_doc_id;
      ref_doc_id=value.ref_doctor_id;

      $('#patient_name').val(value.patient_name);

      $('#date_of_birth').val(value.date_of_birth);
      // $('#address').val(value.address);
      $('#operator_name').val(value.operator_name);

                        // // alert(value.profile_img);
                        // $('#patient_photo').val(value.profile_img);

                       //  if(value.profile_img!="")
                       //  {
                       //    $('#patient_photo').hide();

                       //    $("#p_img").css("display", "block");

                       //    $("#p_img").attr("src","uploads/patient_image/"+value.profile_img);

                       //    $("#img_hidden").val(value.profile_img);
                       //  }
                       //  else
                       //  {
                       //   $('#patient_photo').show();
                       //   $("#p_img").css("display", "none");
                       //   $("#img_hidden").val("");
                       // }

                       $("#gender").select2().val(value.gender).trigger("change");
                     });

     $.ajax({  
      url:"<?=site_url('admin/all_test_cart_info')?>",  
      method:"POST",
      data:{doc_id:quack_doc_id},  
      dataType:"html",  
      success:function(data)  
      {
       $('#all_test_cart_info').html(data);
       if ($.fn.DataTable.isDataTable("#test_info_table")) {
        $('#test_info_table').DataTable().clear().destroy();
      }

      $("#test_info_table").dataTable({});

      $('.add_this_test').prop("disabled",false);

    }

  });



     $.ajax({  
      url:"<?=site_url('admin/get_all_doc_name')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 

       $("#ref_doc_name").empty();
       $("#ref_doc_name").append('<option  value="self#0">self</option>');
       $.each(data, function (key, value) {
                                // $.each(value, function (key, value) {

                                  if(ref_doc_id==value.doctor_id)
                                  {

                                    $("#ref_doc_name").append('<option selected value="' + value.doctor_title+'#'+value.doctor_id + '">' + value.doctor_title + '</option>');
                                  }
                                  else
                                  {
                                    $("#ref_doc_name").append('<option  value="' + value.doctor_title+'#'+value.doctor_id + '">' + value.doctor_title + '</option>');
                                  }

                                  
                                });
                            // });
                          }
                        });


     $.ajax({  
      url:"<?=site_url('admin/get_all_doc_name')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        $("#quack_doc_name").empty();
        $("#quack_doc_name").append('<option  value="self#0">self</option>');
        $.each(data, function (key, value) {
                                // $.each(value, function (key, value) {

                                 if(quack_doc_id==value.doctor_id)
                                 {

                                  $("#quack_doc_name").append('<option selected value="' + value.doctor_title+'#'+value.doctor_id + '">' + value.doctor_title + '</option>');
                                }
                                else
                                {
                                 $("#quack_doc_name").append('<option  value="' + value.doctor_title+'#'+value.doctor_id + '">' + value.doctor_title + '</option>');
                               }

                             });

      }
    });



     comp();

   }   
 });
}

function get_ipd_patient_info() {

  // var patient_mobile_no=$("#mobile_no").val();
  var patient_id=$("#ipd_patient_id option:selected").val();



  var blood_group_id;
  var ref_doc_id;
  var quack_doc_id;


  $.ajax({  
    url:"<?=site_url('admin/get_all_ipd_info')?>",  
    method:"POST",
    data:{patient_id:patient_id},  
    dataType:"json",  
    success:function(data)  
    { 
     $.each(data, function (key, value) 
     {
      blood_group_id=value.blood_group;
      ref_doc_id=value.doc_id;
      quack_doc_id=value.ref_doc_id;

      // alert(quack_doc_id);
      

      $('#patient_name').val(value.patient_name);
      $('#cabin_no').val(value.room_title);
      $('#mobile_no').val(value.mobile_no);

      // alert($('#date_of_birth').val());

      if(value.date_of_birth=="0000-00-00")
      {
        $("#age_yr").val(value.age);
      }
      else 
      {
        $('#date_of_birth').val(value.date_of_birth);
        comp();
      }


      
      // $('#address').val(value.address);
      $('#operator_name').val(value.operator_name);

                        // // alert(value.profile_img);
                        // $('#patient_photo').val(value.profile_img);

                       //  if(value.profile_img!="")
                       //  {
                       //    $('#patient_photo').hide();

                       //    $("#p_img").css("display", "block");

                       //    $("#p_img").attr("src","uploads/patient_image/"+value.profile_img);

                       //    $("#img_hidden").val(value.profile_img);
                       //  }
                       //  else
                       //  {
                       //   $('#patient_photo').show();
                       //   $("#p_img").css("display", "none");
                       //   $("#img_hidden").val("");
                       // }

                       $("#gender").select2().val(value.gender.substr(0,1).toUpperCase()+value.gender.substr(1)).trigger("change");


                      //  $.ajax({  
                      //   url:"<?=site_url('admin/get_doc_img')?>",  
                      //   method:"POST", 
                      //   data:{doc_id:ref_doc_id},  
                      //   dataType:"json",  
                      //   success:function(data)  
                      //   { 
                      //     $("#d_img").attr("src","uploads/doctor_image/"+data[0].profile_img);
                      //   }

                      // });

                      //  $.ajax({  
                      //   url:"<?=site_url('admin/get_doc_img')?>",  
                      //   method:"POST", 
                      //   data:{doc_id:quack_doc_id},  
                      //   dataType:"json",  
                      //   success:function(data1)  
                      //   { 
                      //     $("#r_d_img").attr("src","uploads/doctor_image/"+data1[0].profile_img);
                      //   }

                      // });




                    });


     $.ajax({  
      url:"<?=site_url('admin/all_test_cart_info')?>",  
      method:"POST",
      data:{doc_id:quack_doc_id},  
      dataType:"html",  
      success:function(data)  
      {
       $('#all_test_cart_info').html(data);
       if ($.fn.DataTable.isDataTable("#test_info_table")) {
        $('#test_info_table').DataTable().clear().destroy();
      }

      $("#test_info_table").dataTable({});

      $('.add_this_test').prop("disabled",false);

    }

  });


     // $.ajax({  
     //  url:"<?=site_url('admin/get_all_blood_group')?>",  
     //  method:"POST",  
     //  dataType:"json",  
     //  success:function(data)  
     //  {
     //    $("#blood_group").empty(); 
     //    $.each(data, function (key, value) {
     //                            // $.each(value, function (key, value) {

     //                              if(blood_group_id==value.id)
     //                              {

     //                                $("#blood_group").append('<option selected value="' + value.id + '">' + value.blood_group_title + '</option>');
     //                              }
     //                              else
     //                              {

     //                                $("#blood_group").append('<option  value="' + value.id + '">' + value.blood_group_title + '</option>');
     //                              }

     //                            });
     //                        // });
     //                      }
     //                    });

     $.ajax({  
      url:"<?=site_url('admin/get_all_doc_name')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 

       $("#ref_doc_name").empty();
       $("#ref_doc_name").append('<option  value="self#0">self</option>');
       $.each(data, function (key, value) {
                                // $.each(value, function (key, value) {

                                  if(ref_doc_id==value.doctor_id)
                                  {

                                    $("#ref_doc_name").append('<option selected value="' + value.doctor_title+'#'+value.doctor_id + '">' + value.doctor_title + '</option>');
                                  }
                                  else
                                  {
                                    $("#ref_doc_name").append('<option  value="' + value.doctor_title+'#'+value.doctor_id + '">' + value.doctor_title + '</option>');
                                  }

                                  
                                });
                            // });
                          }
                        });


     $.ajax({  
      url:"<?=site_url('admin/get_all_doc_name')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        $("#quack_doc_name").empty();
        $("#quack_doc_name").append('<option  value="self#0">self</option>');
        $.each(data, function (key, value) {
                                // $.each(value, function (key, value) {

                                 if(quack_doc_id==value.doctor_id)
                                 {

                                  $("#quack_doc_name").append('<option selected value="' + value.doctor_title+'#'+value.doctor_id + '">' + value.doctor_title + '</option>');
                                }
                                else
                                {
                                 $("#quack_doc_name").append('<option  value="' + value.doctor_title+'#'+value.doctor_id + '">' + value.doctor_title + '</option>');
                               }

                             });
                            // });
                          }
                        });


     // comp();

   }   
 });
}


function get_appointment_patient_info(argument) {

  var appointment_patient_id=$("#appointment_patient_id option:selected").val();



  $.ajax({  
    url:"<?=site_url('admin/get_all_appointment_id_info_selected')?>",  
    method:"POST",
    data:{appointment_patient_id:appointment_patient_id},  
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
      $("#gender").select2().val(value.gender).trigger("change");

      var quack_doc_id=value.ref_doc_id;

      $.ajax({  
        url:"<?=site_url('admin/all_test_cart_info')?>",  
        method:"POST",
        data:{doc_id:quack_doc_id},  
        dataType:"html",  
        success:function(data)  
        {
         $('#all_test_cart_info').html(data);
         if ($.fn.DataTable.isDataTable("#test_info_table")) {
          $('#test_info_table').DataTable().clear().destroy();
        }

        $("#test_info_table").dataTable({});

        $('.add_this_test').prop("disabled",false);

      }

    });


      $.ajax({  
        url:"<?=site_url('admin/get_all_doc_name')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 

         $("#ref_doc_name").empty();
         $("#ref_doc_name").append('<option  value="self#0">self</option>');
         $.each(data, function (key, value1) {


          if(value.doc_id==value1.doctor_id)
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


      $.ajax({  
        url:"<?=site_url('admin/get_all_doc_name')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 
          $("#quack_doc_name").empty();
          $("#quack_doc_name").append('<option  value="self#0">self</option>');
          $.each(data, function (key, value1) {


            if(value.ref_doc_id==value1.doctor_id)
            {

              $("#quack_doc_name").append('<option selected value="' + value1.doctor_title+'#'+value1.doctor_id + '">' + value1.doctor_title + '</option>');
            }
            else
            {
             $("#quack_doc_name").append('<option  value="' + value1.doctor_title+'#'+value1.doctor_id + '">' + value1.doctor_title + '</option>');
           }

         });

        }
      });


    });

}

});
}


function get_uhid_patient_info(argument) {

  var uhid=$("#uhid_patient_id option:selected").val();



  $.ajax({  
    url:"<?=site_url('admin/get_uhid_info_by_id')?>",  
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
      $("#gender").select2().val(value.gender).trigger("change");

      var quack_doc_id=value.ref_doc_id;

      $.ajax({  
        url:"<?=site_url('admin/all_test_cart_info')?>",  
        method:"POST",
        data:{doc_id:quack_doc_id},  
        dataType:"html",  
        success:function(data)  
        {
         $('#all_test_cart_info').html(data);
         if ($.fn.DataTable.isDataTable("#test_info_table")) {
          $('#test_info_table').DataTable().clear().destroy();
        }

        $("#test_info_table").dataTable({});

        $('.add_this_test').prop("disabled",false);

      }

    });


      $.ajax({  
        url:"<?=site_url('admin/get_all_doc_name')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 

         $("#ref_doc_name").empty();
         $("#ref_doc_name").append('<option  value="self#0">self</option>');
         $.each(data, function (key, value1) {


          if(value.doc_id==value1.doctor_id)
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


      $.ajax({  
        url:"<?=site_url('admin/get_all_doc_name')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 
          $("#quack_doc_name").empty();
          $("#quack_doc_name").append('<option  value="self#0">self</option>');
          $.each(data, function (key, value1) {


            if(value.ref_doc_id==value1.doctor_id)
            {

              $("#quack_doc_name").append('<option selected value="' + value1.doctor_title+'#'+value1.doctor_id + '">' + value1.doctor_title + '</option>');
            }
            else
            {
             $("#quack_doc_name").append('<option  value="' + value1.doctor_title+'#'+value1.doctor_id + '">' + value1.doctor_title + '</option>');
           }

         });

        }
      });


    });

}

});
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

 // // alert(splitDate.length);
    // if(splitDate1.length!=1){


    //       var year = splitDate1[0];
    //       var month = splitDate1[1];
    //       var day = splitDate1[2]; 

    //     return month + '/' + day + '/' + year;
    // }

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

function get_ipd_patient_id(argument) {


  if($("input[name=ipd_patient]").val()==1)
  {
     // alert('hi');
     $('#ipd_patient_id_div').show();
     $('#cabin_no_div').show();
     $('#reg_div').hide();
     $('#appointment_patient_id_div').hide();

     $.ajax({  
      url:"<?=site_url('admin/get_all_ipd_id')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        $("#ipd_patient_id").empty();
        $("#ipd_patient_id").append('<option  value="">--Select--</option>');
        $.each(data, function (key, value) {


          $("#ipd_patient_id").append('<option  value="'+value.id + '">' + value.patient_info_id + '</option>');


        });
      }
    });

   }


 }


 function get_appointment_patient_id(argument) 
 {

  if($("input[name=appointment_patient]").val()==1)
  {
     // alert('hi');
     $('#appointment_patient_id_div').show();
     $('#ipd_patient_id_div').hide();
     $('#cabin_no_div').hide();
     $('#reg_div').hide();

     $.ajax({  
      url:"<?=site_url('admin/get_all_appointment_id_info')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        $("#appointment_patient_id").empty();
        $("#appointment_patient_id").append('<option  value="">--Select--</option>');
        $.each(data, function (key, value) {


          $("#appointment_patient_id").append('<option  value="'+value.id + '">' + value.appointment_gen_id + '</option>');


        });
      }
    });

   }
 }

  function get_uhid_patient_id(argument) 
 {

  if($("input[name=appointment_patient]").val()==1)
  {
     // alert('hi');
     $('#uhid_patient_id_div').show();
     $('#appointment_patient_id_div').hide();
     $('#ipd_patient_id_div').hide();
     $('#cabin_no_div').hide();
     $('#reg_div').hide();

     $.ajax({  
      url:"<?=site_url('admin/get_uhid_info_all')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        $("#uhid_patient_id").empty();
        $("#uhid_patient_id").append('<option  value="">--Select--</option>');
        $.each(data, function (key, value) {


          $("#uhid_patient_id").append('<option  value="'+value.id + '">' + value.gen_id + '</option>');


        });
      }
    });

   }
 }


 function clear_all_data(argument) {

  $('#ipd_patient_id_div').hide();
  $('#appointment_patient_id_div').hide();
  $('#uhid_patient_id_div').hide();
  $('#cabin_no_div').hide();

  $('#patient_name').val('');
  $('#mobile_no').val('');

  $('#already_reg_p').empty();


  $('#cabin_no').val('');
  $('#date_of_birth').val(changeDateFormat1(''));
  // $('#address').val('');
  $('#age_dt').val('');
  $('#age_mn').val('');
  $('#age_yr').val('');
  $("#Male").prop("checked", true);


  // $("#blood_group").append('<option selected value="">--Select--</option>');
  $("#ref_doc_name").append('<option selected value="">--Select--</option>');
  $("#quack_doc_name").append('<option selected value="">--Select--</option>');

  // $("#d_img").attr("src","uploads/doctor_image/");
  // $("#r_d_img").attr("src","uploads/doctor_image/");
  // $("#p_img").attr("src","uploads/doctor_image/");
  

}

</script>

<script type="text/javascript">

  $(document).ready(function()
  {
    var sum=0;
    var rowCount =$('#test_cart_table tr').length;
    var table = document.getElementById('test_cart_table');



    $(document).on('click', '.add_this_test', function()
    {

      var sum=0;
      var sum_sub=0;
      var test_name=$(this).data('test');
      var sub_test_id=$(this).data('sub_test_id');
      var test_price=$(this).data('price');
      var test_id=$(this).data('test_id');
      var type=$(this).data('type');
      var quk_ref_com=$("#quack_"+sub_test_id).val();
      var quantity="1";


      $.ajax({
        url:"<?=site_url("admin/add")?>",
        method:"POST",
        dataType:"html",
        data:{test_id:test_id,sub_test_id:sub_test_id, test_name:test_name, test_price:test_price,quk_ref_com:quk_ref_com,quantity:quantity,type:type},
        success:function(data)
        {

          $('#test_cart_details').html(data);

          $('input[type=search]').val('').change();


              // discount

              var dis=$("#discount_store").val();

              var dis_per=$("#discount_store_per").val();

              $("#discount_percent").val(dis_per);

              var total=$('#total_amount').val();

              if(dis_per!="")
              {
                dis=parseFloat(total)*parseFloat(dis_per)/100;
              }


              

              $("#discount").val(dis);




              var discount=dis;

              var rowCount=$('#test_cart_table tr').length;
              var table = document.getElementById('test_cart_table');
                 // alert(rowCount);

                 if(discount=="")
                 {
                  discount=0;
                }


                // vat ....

                var va=$("#vat_store").val();

                var vat_per=$("#vat_store_per").val();

                $("#vat_percent").val(vat_per);



                if(vat_per!="")
                {
                  va=parseFloat(total)*parseFloat(vat_per)/100;
                }


                $("#vat").val(va);

                
                var vat=va;

                var rowCount =$('#test_cart_table tr').length;
                var table = document.getElementById('test_cart_table');

                var total_additional_test=parseInt($('#total_additional_test').val());
                 // alert(rowCount);

                 if(vat=="")
                 {
                  vat=0;
                }

                for(var i=1;i<rowCount-total_additional_test-9;i++)
                {

                 table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(rowCount-total_additional_test-10)).toFixed(2));

                  // table.rows[i].cells[5].innerHTML=parseFloat(parseFloat(table.rows[i].cells[2].children[0].value)-((parseFloat(discount)/(rowCount-10)))).toFixed(2);

                  table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(rowCount-10)).toFixed(2));

                  table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat(table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

                  // sub com

                  if( $('#discount_commission_type').val() == 1)
                  {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
                 }
                 else 
                 {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
                 }


                 if(table.rows[i].cells[7].innerHTML < 0)
                 {
                  table.rows[i].cells[7].innerHTML=0;
                }


              }


              if(vat=="")
              {
                vat=0;
              }

              if(discount=="")
              {
                discount=0;
              }


              var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

              $('#net_total').val(net_total.toFixed(2));
              total_paid();

              var rowCount =$('#test_cart_table tr').length;
              var table = document.getElementById('test_cart_table');
              

              for(var i=1;i<rowCount-total_additional_test-9;i++)
              {
                sum=parseFloat(sum)+parseFloat(table.rows[i].cells[6].innerHTML);
                sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
             }

             $("#total_c_o").val(sum.toFixed(2));
             $("#sub_c_o").val(sum_sub.toFixed(2));


             sum=0;
             sum_sub=0;

           },
           error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
         });
});

$(document).on('click', '.remove_test', function()
{
  var row_id = $(this).attr("id");
  var sum=0;
  var sum_sub=0;
  alertify.confirm('<b>Delete Confirmation</b>',"Are you sure you want to remove this?",
    function(){
          //alertify.success('Ok');
          $.ajax({
            url:"<?=site_url()?>admin/remove",
            method:"POST",
            dataType:"html",
            data:{row_id:row_id},
            success:function(data)
            {
              $('#test_cart_details').html(data);

                 // discount

                 var dis=$("#discount_store").val();

                 var dis_per=$("#discount_store_per").val();
                 $("#discount_percent").val(dis_per);
                 var total=$('#total_amount').val();

                 if(dis_per!="")
                 {
                  dis=parseFloat(total)*parseFloat(dis_per)/100;
                }

                


                $("#discount").val(dis);


                

                var discount=dis;

                var rowCount=$('#test_cart_table tr').length;
                var table = document.getElementById('test_cart_table');
                 // alert(rowCount);

                 if(discount=="")
                 {
                  discount=0;
                }


                // vat ....

                var va=$("#vat_store").val();

                var vat_per=$("#vat_store_per").val();
                
                var total_additional_test=parseInt($('#total_additional_test').val());

                $("#vat_percent").val(vat_per);



                if(vat_per!="")
                {
                  va=parseFloat(total)*parseFloat(vat_per)/100;
                }


                $("#vat").val(va);

                
                var vat=va;

                var rowCount =$('#test_cart_table tr').length;
                var table = document.getElementById('test_cart_table');
                 // alert(rowCount);

                 if(vat=="")
                 {
                  vat=0;
                }

                for(var i=1;i<rowCount-total_additional_test-9;i++)
                {

                 table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(rowCount-total_additional_test-10)).toFixed(2));

                  // table.rows[i].cells[5].innerHTML=parseFloat(parseFloat(table.rows[i].cells[2].children[0].value)-((parseFloat(discount)/(rowCount-10)))).toFixed(2);

                  table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(rowCount-10)).toFixed(2));

                  table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

                  // sub com

                  if( $('#discount_commission_type').val() == 1)
                  {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
                 }
                 else 
                 {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
                 }


                 if(table.rows[i].cells[7].innerHTML < 0)
                 {
                  table.rows[i].cells[7].innerHTML=0;
                }


              }


              if(vat=="")
              {
                vat=0;
              }

              if(discount=="")
              {
                discount=0;
              }


              var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

              $('#net_total').val(net_total.toFixed(2));
              total_paid();



              var rowCount =$('#test_cart_table tr').length;
              var table = document.getElementById('test_cart_table');

              for(var i=1;i<rowCount-total_additional_test-9;i++)
              {
                sum=parseFloat(sum)+parseFloat(table.rows[i].cells[6].innerHTML);
                sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
             }

             $("#total_c_o").val(sum.toFixed(2));
             $("#sub_c_o").val(sum_sub.toFixed(2));
             sum=0;
             sum_sub=0;

           },
           error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
         });
},
function(){
          //alertify.error('Cancel');
        });

});


$(document).on('input', '#discount', function()
{
  var discount;
  var vat;
  var total=$(this).data('total');

  var sum_sub=0;

  $('#discount_percent').val("");

  $('#discount_store_per').val("");


  if($('#discount').val()=="")
  {
    discount=0;
    $('#discount_store').val("");
  }
  else
  {
    discount=$('#discount').val();
    $('#discount_store').val(discount);


  }
  if($('#vat').val()=="")
  {
    vat=0;
  }
  else
  {
    vat=$('#vat').val();

  }

  var total_additional_test=parseInt($('#total_additional_test').val());

  var rowCount =$('#test_cart_table tr').length;
  var table = document.getElementById('test_cart_table');
     // alert(rowCount);

     for(var i=1;i<rowCount-total_additional_test-9;i++)
     {
      // divide discount for all

      table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(rowCount-total_additional_test-10)).toFixed(2));

      // net amount

      table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

       // sub com

       if( $('#discount_commission_type').val() == 1)
       {
         table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
       }
       else 
       {
         table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
       }


       if(table.rows[i].cells[7].innerHTML < 0)
       {
        table.rows[i].cells[7].innerHTML=0;
      }



    }

    var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

    $('#net_total').val(net_total.toFixed(2));
    total_paid();


    for(var i=1;i<rowCount-total_additional_test-9;i++)
    {

      sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
             }


             $("#sub_c_o").val(sum_sub.toFixed(2));

             sum_sub=0;



           });

$(document).on('input', '#vat', function()
{
  var discount;
  var vat;
  var total=$(this).data('total');

  $('#vat_percent').val("");
  $('#vat_store_per').val("");


  if($('#discount').val()=="")
  {
    discount=0;
  }
  else
  {
    discount=$('#discount').val();


  }
  if($('#vat').val()=="")
  {
    vat=0;
    $('#vat_store').val("");
  }
  else
  {
    vat=$('#vat').val();
    $('#vat_store').val(vat);


  }

  var total_additional_test=parseInt($('#total_additional_test').val());


  var rowCount =$('#test_cart_table tr').length;
  var table = document.getElementById('test_cart_table');
     // alert(rowCount);

     for(var i=1;i<rowCount-total_additional_test-9;i++)
     {

      table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(rowCount-total_additional_test-10)).toFixed(2));

      table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);
      
    }

    var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

    $('#net_total').val(net_total.toFixed(2));
    total_paid();

    
  });

$(document).on('input', '#total_paid', function()
{
  total_paid();
});


$(document).on('input', '#discount_percent', function()
{

 var total=$(this).data('total');
 var discount;
 var vat;
 var sum_sub=0;

 var discount_percent;
 $('#discount_store_per').val("");

 if($('#discount_percent').val()=="")
 {
  discount=0;
  $("#discount").val("");
  $("#discount_store").val("");
}
else
{
  discount_percent=$('#discount_percent').val();
  $('#discount_store_per').val(discount_percent);

  discount=parseFloat((parseFloat(total)*parseFloat(discount_percent)/100));
  $("#discount").val(discount);
  $("#discount_store").val(discount);

}

if($('#vat').val()=="")
{
  vat=0;
}
else
{
  vat=$('#vat').val();

}

var total_additional_test=parseInt($('#total_additional_test').val());

var rowCount =$('#test_cart_table tr').length;
var table = document.getElementById('test_cart_table');
     // alert(rowCount);

     for(var i=1;i<rowCount-total_additional_test-9;i++)
     {

      table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(rowCount-total_additional_test-10)).toFixed(2));

      table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

     // sub com

     if( $('#discount_commission_type').val() == 1)
     {
       table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
     }
     else 
     {
       table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
     }


     if(table.rows[i].cells[7].innerHTML < 0)
     {
      table.rows[i].cells[7].innerHTML=0;
    }


  }


  var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

  $('#net_total').val(net_total.toFixed(2));

  total_paid();

  for(var i=1;i<rowCount-total_additional_test-9;i++)
  {

    sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
             }


             $("#sub_c_o").val(sum_sub.toFixed(2));

             sum_sub=0;


           });



$(document).on('input', '#vat_percent', function()
{

 var total=$(this).data('total');
         // var discount_percent;
         var vat_percent;

         var vat;
         
         $('#vat_store_per').val("");

         if($('#vat_percent').val()=="")
         {
          vat=0;

          $("#vat_store").val("");
          $("#vat").val("");

        }
        else
        {
          vat_percent=$('#vat_percent').val();
          $('#vat_store_per').val(vat_percent);
          var vat=parseFloat((parseFloat(total)*parseFloat(vat_percent)/100));

          $("#vat").val(vat);
          $("#vat_store").val(vat);

        }

        if($('#discount').val()=="")
        {
          discount=0;
        }
        else
        {
          discount=$('#discount').val();

        }


        var total_additional_test=parseInt($('#total_additional_test').val());

        
        var rowCount =$('#test_cart_table tr').length;
        var table = document.getElementById('test_cart_table');
     // alert(rowCount);

     for(var i=1;i<rowCount-total_additional_test-9;i++)
     {

      table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(rowCount-total_additional_test-10)).toFixed(2));

      table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);
      
    }

    var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

    $('#net_total').val(net_total.toFixed(2));
    total_paid();




  });

});

function total_paid(argument) { 
  var net_total;
  var total_paid;
  if($('#net_total').val()=="")
  {
    net_total="0";
  }
  else
  {
    net_total=$('#net_total').val();
  }
  if($('#total_paid').val()=="")
  {
    total_paid="0";
  }
  else
  {
    total_paid=$('#total_paid').val();
  }



  var due=parseFloat(net_total)-parseFloat(total_paid);

  $('#due').val(due.toFixed(2));
}

</script>


<script type="text/javascript">

  function get_all_opd_existing_data(mobile_no_data)
  {
    // alert("hi");

    var mobile_no_data=mobile_no_data;
    $("#reg_div").show();
     // $("#already_reg_p").focus();

     if($("#mobile_no").val()=="")
     {
      var patient_mobile_no="none";

    }
    else
    {
      var patient_mobile_no=$("#mobile_no").val();
    }
          // alert(patient_mobile_no);
          var isInArray = mobile_no_data.includes(patient_mobile_no);
           // alert(isInArray);

           if(isInArray==true)
           {
             $("#reg_div").show();
             // $("#already_reg_p").focus();

             $("#already_reg_p").empty();
             $("#already_reg_p").append('<option value="">Select Patient Name</option>');


             $.ajax({  
              url:"<?=site_url('admin/get_all_info_by_mobile_no')?>",  
              method:"POST", 
              data:{patient_mobile_no:patient_mobile_no},  
              dataType:"json",  
              success:function(patient_data)  
              { 

               $.each(patient_data, function (key, value) {

                $("#already_reg_p").append('<option  value="' + value.id + '">' + value.patient_name + '</option>');

              });

               var optionValues =[];
               $('#already_reg_p option').each(function(){
                 if($.inArray(this.value, optionValues) >-1){
                  $(this).remove();
                }else{
                  optionValues.push(this.value);
                }
              });

             }
           });

           }

         }
       </script>
     </body>
     </html>