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
      <form action="admin/add_doc_schedule_post" id="day_form" method="post">
        <div class="row mt-3">
          <div class="col-md-4">



            <div class="form-group">
              <div class="row">
                <input type="hidden" value="<?=$doc_id?>" id="pass_doc_id" name="">


                <label for="" class="ml-2 col-md-4 text-right">Doctor Name</label>
                <div class="col-md-7">
                  <select class="custom-select select2" onchange="get_dr_info()" name="doc_id" id="doc_id" required>
                    <option value="">Select Doctor Name</option>

                    <?php foreach ($doc_info as $key => $value) { ?>

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
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                  </select>
                </div>
              </div>
            </div>




<!-- 
            <div class="form-group">
              <div class="row">
                <label for="" class="ml-2 col-md-4 text-right">Time Per Patient</label>


                <div class="col-md-7">
                  <div class="input-group focused">
                    <input type="number" required="" id="time_per_patient" name="time_per_patient"  class="form-control datetimepicker-input" />
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
                  <input type="number" 
                  id="dr_fee_new" name="dr_fee_new"  class="form-control datetimepicker-input" />
                  <div class="input-group-append">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label for="dr_fee_old" class="ml-2 col-md-4 text-right">Doctor Fee (Old Patient)</label>
                <div class="col-md-7">
                  <input type="number"  id="dr_fee_old" name="dr_fee_old"  class="form-control datetimepicker-input" />
                  <div class="input-group-append">
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <label for="" class="ml-2 col-md-4 text-right">Doctor Fee (Only Report)</label>
                <div class="col-md-7">
                  <input type="number"  id="dr_fee_report" name="dr_fee_report"  class="form-control datetimepicker-input" />
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
                    <input type="text"  name="global_from" id="global_from" class="form-control datetimepicker-input" data-target="#global_time_from"/>
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
                    <input  id="global_to" type="text" name="global_to" class="form-control datetimepicker-input" data-target="#global_time_to"/>
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

          <div class="col-md-8" >


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

                      if($ro['is_busy']==0) {?>

                        <option value="<?=$ro['id']?>"><?=$ro['room_title']?></option>
                      <?php } ?>



                    <?php }
                    ?>
                  </select>

                <!-- <span id="result"></span> -->
              </div>
            </div>



<!--                 <?php for($i=1;$i<=7;$i++) { ?>

                  <div class="col-md-6 day" style="display: none;" id="day_<?=$i?>">
                    <div class="card mb-3">
                      <div class="card-body">

                        <div class="row">

                          <?php if($i==1)
                          {
                            $day="Saturday";
                          }
                          else if($i==2)
                          {
                            $day="Sunday";
                          }
                          else if($i==3)
                          {
                            $day="Monday";
                          }
                          else if($i==4)
                          {
                            $day="Tuesday";
                          }
                          else if($i==5)
                          {
                            $day="Wednesday";
                          }
                          else if($i==6)
                          {
                            $day="Thursday";
                          } 
                          else if($i==7)
                          {
                            $day="Friday";
                          }?>

                          <input type="hidden" value="<?=$day?>" name="day[]">

                          <h2><span class="badge badge-primary"><?=$day?></span></h2>


                          <div class="form-group" >
                            <div class="row" >
                              <label for="from_time_<?=$i?>" class="col-md-3 text-right">From</label>


                              <div class="col-md-8">
                                <div class="input-group focused from_time" id="from_time_<?=$i?>"data-target-input="nearest">
                                  <input value="00:00" type="text" id="input_from_time_<?=$i?>" name="from_time[]" disabled class="form-control datetimepicker-input from_time" data-target="#from_time_<?=$i?>"/>
                                  <div class="input-group-append" data-target="#from_time_<?=$i?>" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>



                          <div class="form-group">
                            <div class="row">
                              <label style="margin-left:2px;" for="to_time_<?=$i?>" class=" col-md-3 text-right">To</label>


                              <div class="col-md-8">
                                <div class="input-group focused to_time" id="to_time_<?=$i?>"data-target-input="nearest">
                                  <input disabled value="00:00" type="text" class="form-control datetimepicker-input to_time" id="input_to_time_<?=$i?>" name="to_time[]" data-target="#to_time_<?=$i?>"/>
                                  <div class="input-group-append" data-target="#to_time_<?=$i?>" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                                  </div>
                                </div>
                              </div>
                            </div>

                          </div>



                        </div>

                        <div id="error_div_<?=$i?>" style="display: none;" role="alert" class="alert alert-danger"><strong>From time must be lower than To time!</strong>
                        </div>

                        <div id="error_div1_<?=$i?>" style="display: none;" role="alert" class="alert alert-danger"><strong>Time differnce cant lower than time per patient !</strong>
                        </div>

                      </div>

                    </div>



                  </div>
                -->

                <!-- <?php } ?> -->

   


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

   <style type="text/css">
     .select2-container--default .select2-selection--multiple
     {
      background-color: white !important;
    }
  </style>


  <?php $this->load->view('back/footer_link');?>

  <script src="back_assets/js/moment.min.js"></script>
  <script src="back_assets/js/tempusdominus-bootstrap-4.min.js"></script>


  <link rel="stylesheet" href="back_assets/css/tempusdominus-bootstrap-4.min.css">

  <script type="text/javascript">

    $( document ).ready(function()
    {

     //  var val1=0;

     //  $.ajax({
     //    url: "<?php echo site_url('admin/select_test_name_selected_appointment');?>",
     //    type: "post",
     //    data: {val1:val1},
     //    success: function(msg)
     //    {


     //   }      
     // }); 

     $('#day_form').on('submit', function() 
     {

        // var week_day= $('#week_day').val();

        var from = convertTo24Hour($('#global_from').val().toLowerCase());
        var to = convertTo24Hour($('#global_to').val().toLowerCase());   

        var flag=0;

        var f=from.split(":");
        var t=to.split(":");

        if(f[0] > t[0])
        {
          $('#error_div_global').show();

          return false;

        }

        return true;

        // for (var i = 0; i < week_day.length; i++) 
        // {
        //   var num = week_day[i].split("_");

        //   $('#error_div_'+num[1]).hide();
        //   $('#error_div1_'+num[1]).hide();

        // // alert(num[1]);


        // var from = convertTo24Hour($('#input_from_time_'+num[1]).val().toLowerCase());
        // var to = convertTo24Hour($('#input_to_time_'+num[1]).val().toLowerCase());

        

        // var f=from.split(":");
        // var t=to.split(":");

        // alert(timeDiff(to,from));
        // alert($('#time_per_patient').val());

      //   if(f[0] > t[0])
      //   {
      //     $('#error_div_'+num[1]).show();

      //     flag=1;

      //   }
      //   else if(timeDiff(to,from) < $('#time_per_patient').val())
      //   {
      //     $('#error_div1_'+num[1]).show();
      //     flag=1;

      //   }

      // }


      // if (flag==1) 
      // {
      //   return false;
      // }

    });

      // $(document).on('change','#week_day', function(event)
      // {
      //   $('.day').hide();
      //   var week_day= $('#week_day').val();



      //   // $('#input_to_time_'+num[1]).prop('disabled',false);

      //   for (var i = 0; i < week_day.length; i++) 
      //   {
      //     $('#'+week_day[i]).show();

      //     var num = week_day[i].split("_");

      //     $('#input_from_time_'+num[1]).prop('disabled',false);

      //     $('#input_to_time_'+num[1]).prop('disabled',false);
      //   }

      // });

      // $(document).on('change','#doc_id', function(event)
      // {

      //   $('#pass_doc_id').val("");
      //   change_dr();

      // });



    });

    // function change_dr(argument) {

    //   if($('#pass_doc_id').val() != "")
    //   {
    //     var doc_id=$('#pass_doc_id').val();

    //     $("#doc_id").select2("destroy");

    //     $("#doc_id option[value='6']").prop('selected',true);

    //     $("#doc_id").select2();
    //   }
    //   else
    //   {
    //     var doc_id=$("#doc_id option:selected").val();
    //   }



    //   $('.day').hide();

    //   $('#time_per_patient').val("");



    //   $.ajax({  

    //     url:"<?=site_url('admin/get_all_schedule_by_doc_id')?>",  
    //     method:"POST",  
    //     data:{doc_id:doc_id},
    //     dataType:"json",  
    //     success:function(data)  
    //     { 


    //      $("#week_day").html(data['options']);

    //      $('#time_per_patient').val(data['all_schedule_info'][0]['time_per_patient']);


    //      $.each(data['all_schedule_info'], function (key, value) {



    //        $("#week_day").select2("destroy");

    //        if(value.schedule_day=="Saturday")
    //        {
    //         $("#week_day option[value='day_1']").prop('selected',true);
    //         $("#day_1").show();

    //         $('#input_from_time_1').prop('disabled',false);
    //         $('#input_to_time_1').prop('disabled',false);

    //         $('#input_from_time_1').val(value.start_time);
    //         $('#input_to_time_1').val(value.end_time);

    //       }

    //       if(value.schedule_day=="Sunday")
    //       {
    //         $("#week_day option[value='day_2']").prop('selected',true);
    //         $("#day_2").show();
    //         $('#input_from_time_2').prop('disabled',false);
    //         $('#input_to_time_2').prop('disabled',false);

    //         $('#input_from_time_2').val(value.start_time);
    //         $('#input_to_time_2').val(value.end_time);
    //       }
    //       if(value.schedule_day=="Monday")
    //       {
    //         $("#week_day option[value='day_3']").prop('selected',true);
    //         $("#day_3").show();
    //         $('#input_from_time_3').prop('disabled',false);
    //         $('#input_to_time_3').prop('disabled',false);

    //         $('#input_from_time_3').val(value.start_time);
    //         $('#input_to_time_3').val(value.end_time);
    //       }
    //       if(value.schedule_day=="Tuesday")
    //       {
    //         $("#week_day option[value='day_4']").prop('selected',true);
    //         $("#day_4").show();
    //         $('#input_from_time_4').prop('disabled',false);
    //         $('#input_to_time_4').prop('disabled',false);

    //         $('#input_from_time_4').val(value.start_time);
    //         $('#input_to_time_4').val(value.end_time);
    //       }
    //       if(value.schedule_day=="Wednesday")
    //       {
    //         $("#week_day option[value='day_5']").prop('selected',true);
    //         $("#day_5").show();
    //         $('#input_from_time_5').prop('disabled',false);
    //         $('#input_to_time_5').prop('disabled',false);

    //         $('#input_from_time_5').val(value.start_time);
    //         $('#input_to_time_5').val(value.end_time);
    //       }
    //       if(value.schedule_day=="Thursday")
    //       {
    //         $("#week_day option[value='day_6']").prop('selected',true);
    //         $("#day_6").show();
    //         $('#input_from_time_6').prop('disabled',false);
    //         $('#input_to_time_6').prop('disabled',false);

    //         $('#input_from_time_6').val(value.start_time);
    //         $('#input_to_time_6').val(value.end_time);
    //       }
    //       if(value.schedule_day=="Friday")
    //       {
    //         $("#week_day option[value='day_7']").prop('selected',true);
    //         $("#day_7").show();
    //         $('#input_from_time_7').prop('disabled',false);
    //         $('#input_to_time_7').prop('disabled',false);

    //         $('#input_from_time_7').val(value.start_time);
    //         $('#input_to_time_7').val(value.end_time);
    //       }

    //       $("#week_day").select2();


    //     }); 
    //    },
    //    error: function (e) {

    //    }   
    //  });
    // }

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

<!--   <script>




    function global_from_fun() {

      $('.from_time').val($('#global_from').val());

    }
    function global_to_fun() {
      $('.to_time').val($('#global_to').val());
    }
  </script> -->

</body>
</html>