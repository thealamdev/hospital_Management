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
          <form method="post" action="admin/ambulance_add_post" enctype="multipart/form-data">
            <div class="row">


              <div class="col-md-3">

                <div class="form-group">
                 <label for="user_name" class="col-sm-5 control-label">Trip No(*)</label>
                 <div class="col-sm-7">
                   <input class="form-control" name="trip_no" id="trip_no" placeholder="Trip No" value="<?php echo $max_trip_no;?>" type="text" readonly>
                 </div>
               </div>  
             </div>
             <div class="col-md-3">
               <div class="form-group">
                 <label for="email" class="col-sm-12 control-label">Date(*)</label>
                 <div class="col-sm-10">
                   <div class="form-group">                       
                    <div class="input-group">
                     <input type="text" placeholder="Date" name="date" id="date" class="col-sm-8 date-time-picker form-control date_of_birth"
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
                      <select class="col-sm-9 custom-select select2" id="sex" name="sex">
                        <option value="">--Select--</option>
                        <?php foreach($sexAll as $key=> $sexes):?>
                          <option value="<?php echo $key;?>"><?php echo $sexes?></option>
                        <?php endforeach;?>
                      </select> 
                    </div>
                  </div>
                </div> 
              </div>
            </div>
          </div>

          <div class="col-md-3">

            <label class="radio-inline"> <input id="opd" name="patient_type" class = "radiocheked" type="radio" value="1" checked="checked"/>OPD</label>&#160;<label class="radio-inline"><input id="ipd" class = "radiocheked"  value="2" name="patient_type" type="radio"/>IPD</label>&#160;<label class="radio-inline"><input id="oth" class = "radiocheked" name="patient_type" value="3" type="radio"/>Other</label>&#160;<label class="radio-inline"><input id="uhid" class = "radiocheked" name="patient_type" value="4" type="radio"/>UHID</label>
            <div class="form-group" id="opd_patient">
              <label for="user_name" class="col-sm-3 control-label">Patient Name</label>
              <div class="col-sm-9" id="opdpatient_id">
               <select class="custom-select select2" onchange="get_opd_patient_info()" id="opd_patient_id_select" name="opd_patient_id_select">
                <option value="">--Select--</option>
                <?php
                foreach ($opd_patient_list as $key => $opdval)
                  {?>


                    <option value="<?=$opdval['id']?>"><?=$opdval['patient_info_id']?></option>;

                  <?php }

                  ?>
                </select> 
              </div>

              <div class="col-sm-9" style="display:none" id="ipdpatient_id">
                <select class="custom-select select2" id="ipd_patient_id_select" onchange="get_ipd_patient_info()"  name="ipd_patient_id_select">
                <option value="">--Select--</option>
                <?php
                foreach ($ipd_patient_list as $key => $ipdval)
                  {?>


                    <option value="<?=$ipdval['id']?>"><?=$ipdval['patient_info_id']?></option>;

                  <?php }

                  ?>
                </select> 
              </div>

              <div class="col-sm-9" style="display:none" id="uhid_patient_id">
               <select class="custom-select select2"  id="uhid_patient_id_select" onchange="get_uhid_patient_info()"  name="uhid_patient_id_select">
                <option value="">--Select--</option>
                <?php
                foreach ($uhid_patient_list as $key => $val)
                  {?>


                    <option value="<?=$val['id']?>"><?=$val['gen_id']?></option>;

                  <?php }

                  ?>
                </select> 
              </div>



              <div class="col-sm-9" id="otherpatient_id">
                <input class="form-control" readonly name="patient_name" id="patient_name" placeholder="Name" type="text">
              </div>
            </div>
          </div>		
          <div class="col-md-3">
           <div class="form-group">
            <label for="user_name" class="col-sm-3 control-label">Ambulance No</label>
            <div class="col-sm-9">
             <select class="custom-select select2"  name="ambulance_no" >
              <option value="">--Select--</option>
              <?php
              foreach ($ambulance_list as $key => $value)
                {?>


                  <option value="<?=$value['ambulance_id']?>"><?=$value['ambulance_no']?> (<?=$value['gen_id']?>)</option>;

                <?php }

                ?>
              </select> 
            </div>

            <div class="col-sm-12" id="age_id">
              <div class="row" >
                <label for="age_id" class="col-sm-3 control-label">Age</label>
                <input class="form-control" name="age" id="age" placeholder="Age 30 Years" type="text">
              </div>
            </div>
          </div> 
        </div>			

        <div class="col-md-3">
          <div class="form-group">
            <label for="mobile_no" class="col-sm-12 control-label">Gardian Name</label>
            <div class="col-sm-10">
              <input class="form-control" name="gardian_name" id="gardian_name" placeholder="Gardian Name" type="text">
            </div>
          </div>
        </div>
        <div class="col-md-3">
         <div class="form-group">
           <label for="patient_mobile_no" class="col-sm-12 control-label">Mobile No</label>
           <div class="col-sm-10">
             <input class="form-control" name="patient_mobile_no" id="patient_mobile_no" placeholder="Mobile No" type="text">
           </div>
         </div>
       </div>


       <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Road Name</label>
           <div class="col-sm-10">
             <input class="form-control" name="road_name" id="road_name" placeholder="Road Name" type="text">
           </div>
         </div>
       </div>

       <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Distance (Km)</label>
           <div class="col-sm-10">
             <input class="form-control" name="distance" id="distance" placeholder="Distance" type="text">
           </div>
         </div>
       </div>

<!--        <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Total Recieve</label>
           <div class="col-sm-10">
             <input class="form-control" name="total_recieve" id="total_recieve" placeholder="Total Recieve" type="text">
           </div>
         </div>
       </div> -->


       <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Fuel Cost</label>
           <div class="col-sm-10">
             <input class="form-control" name="fuel_cost" id="fuel_cost" placeholder="Fuel Cost" type="text">
           </div>
         </div>
       </div>
       <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Road Cost</label>
           <div class="col-sm-10">
             <input class="form-control" name="road_cost" id="road_cost" placeholder="Road Cost" type="text">
           </div>
         </div>
       </div>
       <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Service & Maintanance Cost</label>
           <div class="col-sm-10">
             <input class="form-control" name="service_maintance_cost" id="service_maintance_cost" placeholder="Service & Maintanance Cost" type="text">
           </div>
         </div>
       </div>
       <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Comments</label>
           <div class="col-sm-10">
             <input class="form-control" name="comments" id="comments" placeholder="comments" type="text">
           </div>
         </div>
       </div>
       <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Driver Name</label>
           <div class="col-sm-10">
             <input class="form-control" name="driver_name" id="driver_name" placeholder="Driver Name" type="text">
           </div>
         </div>
       </div>
       <div class="col-md-3">
         <div class="form-group">
           <label for="mobile_no" class="col-sm-12 control-label">Driver Mobile No</label>
           <div class="col-sm-10">
             <input class="form-control" name="driver_mobile_no" id="driver_mobile_no" placeholder="Driver Mobile No" type="text">
           </div>
         </div>
       </div>


     </div>
   </div>
   <div class="row">
    <div class="col-md-5"></div>
    <div class="col-md-5">
     <button type="submit" class="btn btn-success">Submit & Full Pay</button>
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
         $("#uhid_patient_id").hide();
         $("#patient_name").val("");
         $('#patient_name').prop('readonly', true);


       }else if(getchecked == 2){
         $("#ipdpatient_id").show();
         $("#opdpatient_id").hide();
         $("#uhid_patient_id").hide();
         $("#patient_name").val("");
         $('#patient_name').prop('readonly', true);

       }else if(getchecked == 4){
         $("#uhid_patient_id").show();
         $("#ipdpatient_id").hide();
         $("#opdpatient_id").hide();
         $("#patient_name").val("");
         $('#patient_name').prop('readonly', true);
       }
       else{		 

         $("#opdpatient_id").hide();
         $("#ipdpatient_id").hide();
         $("#uhid_patient_id").hide();
         $("#patient_name").val("");
         $('#patient_name').prop('readonly', false);
       }
     });

   </script>

   <script type="text/javascript">
     function get_uhid_patient_info(argument) {

      var uhid=$("#uhid_patient_id_select option:selected").val();

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
          $('#patient_mobile_no').val(value.mobile_no);
          $("#sex").select2().val(value.gender).trigger("change");

        });

       }

     });

    }


    function get_ipd_patient_info() {

      var patient_id=$("#ipd_patient_id_select option:selected").val();

      $.ajax({  
        url:"<?=site_url('admin/get_all_ipd_info')?>",  
        method:"POST",
        data:{patient_id:patient_id},  
        dataType:"json",  
        success:function(data)  
        { 
         $.each(data, function (key, value) 
         {

          $('#patient_name').val(value.patient_name);
          $('#patient_mobile_no').val(value.mobile_no);
          $("#sex").select2().val(value.gender).trigger("change");

        });

       }
     });
    }

    function get_opd_patient_info() {

  // var patient_mobile_no=$("#mobile_no").val();
  var opd_patient_id=$("#opd_patient_id_select option:selected").val();

  $.ajax({  
    url:"<?=site_url('admin/get_all_opd_by_patient_id')?>",  
    method:"POST",
    data:{opd_patient_id:opd_patient_id},  
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
      $("#sex").select2().val(value.gender).trigger("change");
      $('#patient_mobile_no').val(value.mobile_no);

    });

   }
 });
}
</script>

</body>
</html>