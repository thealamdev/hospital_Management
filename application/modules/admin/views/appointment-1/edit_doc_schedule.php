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
      <form action="admin/add_doc_schedule_post" method="post">
        <div class="row mt-3">
          <div class="col-md-4">



            <div class="form-group">
              <div class="row">
                <label for="" class="ml-2 col-md-4 text-right">Doctor Name</label>
                <div class="col-md-7">
                  <select class="custom-select select2" name="doc_id" id="doc_id" onchange="get_dr_info()" required>
                    <option value="">Select Doctor Name</option>

                    <?php foreach ($doc_info as $key => $value) { 
                      if($value['doctor_id']==$all_schedule_info[0]['doc_id'])
                        {?>
                          <option selected="" value="<?=$value['doctor_id']?>"><?=$value['doctor_title']?></option>
                        <?php       } ?>

                        <option value="<?=$value['doctor_id']?>"><?=$value['doctor_title']?></option>

                      <?php }
                      ?>

                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="row">
                  <label for="" class="ml-2 col-md-4 text-right">Add Day</label>
                  <div class="col-md-7">
                    <select onchange="set_all_day()" class="select2" id="week_day" name="week_day[]" multiple="multiple">
                      <option value="All">All</option>

                      <?php

                      $day_arr=['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];
                      foreach ($day_arr as $key => $value) { 
                        $day=$value;
                        $selected="";

                        foreach ($all_schedule_info as $key1 => $value1) {

                          if($value1['schedule_day']==$value)
                          {
                           $selected="selected";
                         }

                       } ?>

                       <option <?=$selected?> value="<?=$day?>"><?=$day?></option>

                     <?php      }
                     ?>
                   </select>
                 </div>
               </div>
             </div>

<!--             <div class="form-group">
              <div class="row">
                <label for="" class="ml-2 col-md-4 text-right">Time Per Patient</label>
              

                 <div class="col-md-7">
                  <div class="input-group focused">
                    <input type="text" id="time_per_patient" name="time_per_patient"  class="form-control datetimepicker-input" />
                    <div class="input-group-append">
                      <div class="input-group-text"><p style="margin: 0 !important;padding: 0px !important; font-size:12px;font-weight: bold;">Minutes</p></div>
                    </div>
                  </div>
            
              </div>
            </div>
          </div> -->

          <div class="form-group">
            <div class="row">
              <label for="dr_fee_new" class="ml-2 col-md-4 text-right">Doctor Fee (New Patient)</label>
              <div class="col-md-7">
                <input type="number" value="<?=$all_schedule_info[0]['doc_fee_new']?>" id="dr_fee_new" name="dr_fee_new"  class="form-control datetimepicker-input" />
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label for="dr_fee_old" class="ml-2 col-md-4 text-right">Doctor Fee (Old Patient)</label>
              <div class="col-md-7">
                <input type="number"  id="dr_fee_old" value="<?=$all_schedule_info[0]['doc_fee_old']?>" name="dr_fee_old"  class="form-control datetimepicker-input" />
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <label for="" class="ml-2 col-md-4 text-right">Doctor Fee (Only Report)</label>
              <div class="col-md-7">
                <input type="number" value="<?=$all_schedule_info[0]['doc_fee_report']?>"  id="dr_fee_report" name="dr_fee_report"  class="form-control datetimepicker-input" />
                <div class="input-group-append">
                </div>
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="row">
              <label for="global_time" class="ml-2 col-md-4 text-right">Start Time</label>

              <div class="col-md-7">
                <div class="input-group focused global_time_from" id="global_time_from" data-target-input="nearest">
                  <input type="text" value="<?=$all_schedule_info[0]['start_time']?>"  name="global_from" id="global_from" class="form-control datetimepicker-input" data-target="#global_time_from"/>
                  <div class="input-group-append" data-target="#global_time_from" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="form-group">
            <div class="row">
              <label for="global_time_to" class="ml-2 col-md-4 text-right">End Time</label>

              <div class="col-md-7">
                <div class="input-group focused global_time" id="global_time_to"data-target-input="nearest">
                  <input value="<?=$all_schedule_info[0]['end_time']?>" id="global_to" type="text" name="global_to" class="form-control datetimepicker-input" data-target="#global_time_to"/>
                  <div class="input-group-append" data-target="#global_time_to" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div id="error_div_global" style="display: none;" role="alert" class="alert alert-danger"><strong>From time must be lower than To time!</strong>
          </div>



          <div align="center">
            <button  class="btn btn-success" type="submit">Save</button>
          </div>


        </div>

        <div class="col-md-8">
            <div class="form-group">
              <label for="user_name" class="col-md-4 control-label">Doctor Category</label>
              <div class="col-md-4">
                <input type="text" readonly  id="doc_cat" name="doc_cat"  class="form-control datetimepicker-input" />
              </div>
            </div> 


            <div class="form-group">

              <label for="" class="col-md-4">Room No</label>
              <div class="col-md-4">
                <select class="custom-select select2" name="cabin_no" id="cabin_no" required>
                  <option value="">Select Room</option>

                  <?php
                  foreach ($room as $key => $ro) {

                    if($ro['is_busy']==0) {

                      if($ro['id']==$all_schedule_info[0]['room_id'])
                        {?>
                      ?>

                      <option  value="<?=$ro['id']?>" selected><?=$ro['room_title']?></option>


                    <?php } else {?>

                      <option  value="<?=$ro['id']?>"><?=$ro['room_title']?></option>

                  <?php } } }
                  ?>
                </select>

                <!-- <span id="result"></span> -->
              </div>
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

   <script type="text/javascript">

    $(function () {

      $('#global_time_from').datetimepicker({
        format: 'LT'
      });

      $('#global_time_to').datetimepicker({
        format: 'LT'
      });

      // for (var i =1; i <=7 ; i++) 
      // {
      //   $('#from_time_'+i).datetimepicker({
      //     format: 'LT'
      //   });

      //   $('#to_time_'+i).datetimepicker({
      //     format: 'LT'
      //   });
      // }
    });

  </script>

<!--   <script>
    function global_from_fun() {

      $('.from_time').val($('#global_from').val());

    }
    function global_to_fun() {
      $('.to_time').val($('#global_to').val());
    }
  </script>
-->

<script type="text/javascript">

  function set_all_day(argument) {

    var val=$("#week_day").val();
    
    // alert(val);
    if($.inArray("All", val) != -1)
    {

     $("#week_day").empty();
     $("#week_day").html('<option value="All">All</option> <option selected value="Saturday">Saturday</option><option selected value="Sunday">Sunday</option><option selected value="Monday">Monday</option><option selected value="Tuesday">Tuesday</option><option selected value="Wednesday">Wednesday</option><option selected value="Thursday">Thursday</option><option selected value="Friday">Friday</option>');
   }


 }

  function get_dr_info(argument) {
      var doc_id= $("#doc_id option:selected").val();

      $.ajax({  
      url:"<?=site_url('admin/get_all_doc_info_by_doc_id')?>",  
      method:"POST", 
      data:{doc_id:doc_id},  
      dataType:"json",  
      success:function(data)  
      { 
        $('#doc_cat').val(data[0]['doc_cat']);
      }

     })
 }
</script>

</body>
</html>