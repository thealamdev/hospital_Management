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
          <!-- <div class="card-title">Simple usage</div> -->
          
          <form id="prescription_form" action="admin/edit_prescription_post" method="post">

            <input type="hidden" name="add_by" value="<?php echo $this->session->userdata['logged_in']['id']?>"/>

            <input type="hidden" name="prescription_id" id="prescription_id" value="<?php echo $prescription_info[0]['id'] ?>"/>

            <div class="row">
              <div class="offset-md-1 col-md-3" >
                <label for="patient_name">Indoor Patient Name:</label>
                <select required id="patient_id" name="patient_id" class="chosen-select custom-select select2 form-control patient_id">  
                  <option value="">Select Patient Id</option>
                  <?php foreach ($patient_list as $row) { 
                    if($row['id']==$prescription_info[0]['patient_id']){ ?>

                      <option selected="" value="<?=$row['id'];?>"><?=$row['patient_info_id'];?></option>

                    <?php }else 
                    { ?>
                      <option value="<?=$row['id'];?>"><?=$row['patient_info_id'];?></option>
                    <?php }
                    ?>

                  <?php } ?>

                </select> 
              </div>  

              <div class="col-md-4">
                <label for="product_category">Patient Name</label>
                <div class="input-group focused">
                  <input readonly="" type="text" id="patient_name" name="patient_name" value="<?=$prescription_info[0]['patient_name']?>" class=" form-control">
                  <!-- <span class="input-group-append">
                    <span class="input-group-text add-on white">
                      <i class="icon-calendar"></i>
                    </span>
                  </span> -->
                </div>
              </div>


              <div class="col-md-3">
                <label for="product_category">Reg No:</label>
                <div class="input-group focused">
                  <input readonly="" name="reg_no" id="reg_no" type="text" value="<?=$prescription_info[0]['reg_id']?>"  class="form-control">
                  <span class="input-group-append">
                    <span class="input-group-text add-on white">
                      <i class="ace-icon fa fa-paper-plane"></i>
                    </span>
                  </span>
                </div>

              </div>
            </div>


            <div class="row mt-2">
              <div class="offset-md-1 col-md-3" >
                <label for="doctor_id">Doctor Name:</label>
                <select required id="doctor_id" name="doctor_id" class="chosen-select custom-select select2 form-control doctor_id">  
                  <option value="">Select Doctor</option>   <?php foreach ($doctor_list as $row) { 
                    if($row['doctor_id']==$prescription_info[0]['doctor_id']){ ?>

                      <option selected="" value="<?=$row['doctor_id'];?>"><?=$row['doctor_title'];?></option>

                    <?php }else 
                    { ?>
                      <option value="<?=$row['doctor_id'];?>"><?=$row['doctor_title'];?></option>
                    <?php }
                    ?>

                  <?php } ?>

                </select> 
              </div>  

              <div class="col-md-4">
                <label for="product_category">Notes</label>
                <div class="input-group focused">
                  <textarea  name="note" id="note" class="form-control" rows="1"><?=$prescription_info[0]['note']?></textarea>
                </div>
              </div>


            </div>



            <div class="row mt-3">
              <div class="mr-4 col-md-12">
                <table class="table table-striped table-bordered mytable_style table-hover sell_cart">
                  <thead>
                    <tr>
                      <th>S.L</th>
                      <th style="width:25%;">Medicine Name</th>
                      <th style="width:20%;">Type</th>
                      <th style="width:25%;">Daily Dose</th>
                     <th style="width:20%;">Dose Qty <span style="color:red;">(?+?+?+?)</span></th>
                      <th style="width:15%;">Max Day</th>
                      <th style="width:15%;">Description</th>
                      <th style="width:10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody class="mytable_style" id="dynamic_row">

                    <?php foreach ($prescription_info as $key => $value) { ?>

                      <input type="hidden"  name="p_details_id[]" value="<?=$value['pr_id']?>">

                      <tr id="row_<?=$key?>">
                        <td><?=$key+1?></td>
                        <td>
                          <select onchange="get_type('<?=$key?>')"  id="med_id_<?=$key?>" name="med_id[]" class="chosen-select custom-select select2 form-control med_id">
                            <option value=""></option>

                            <?php foreach ($product_list as $row) { 
                              if($row['id']==$value['medicine_id']){ ?>

                                <option selected="" value="<?=$row['id'];?>#<?=$row['p_name'];?>"><?=$row['p_name'];?></option>

                              <?php }else 
                              { ?>
                                <option value="<?=$row['id'];?>#<?=$row['p_name'];?>"><?=$row['p_name'];?></option>
                              <?php }
                              ?>

                            <?php } ?>

                          </select> 

                          <input type="text" oninput="change_select(<?=$key?>)" id="unknown_medicine_id_<?=$key?>" class="form-control mt-2" name="unknown_medicine_name[]" value="<?php if($value['medicine_id'] == 0) echo $value['medicine_name']?>" >
                        </td>

                        <td>
                          <input value="<?=$value['type']?>" name="type[]" id="type_<?=$key?>" class="form-control type" type="text">
                        </td>

                      <!-- <td>
                        <input readonly="" name="type_id[]" id="type_0" class="form-control type" type="text">
                      </td> -->



                      <td>
                        <select class="custom-select select2 form-control day_dose" multiple="multiple" readonly name="day_dose_0[]" id="day_dose_0" required>

                          <?php foreach ($dose_schedule_list as $key1 => $value1) { ?>

                            <option selected="" value="<?=$value1['id']?>"><?=$value1['schedule']?></option>

                          <?php } ?>
                        </select>
                      </td>


                      <td><input name="dose_qty[]" id="dose_qty_<?=$key?>"  oninput="check_fun(<?=$key?>)" value="<?=$value['dose_qty']?>" class="form-control sell_cart_input" type="text"></td>

                      <td><input name="max_day[]" id="max_day_0" value="<?=$value['max_day']?>" class="form-control sell_cart_input" type="text" value="0"></td>


                      <td>
                        <div class="input-group icon_tag_input">
                          <textarea name="description[]" id="description_<?=$key?>" class="" rows="1"><?=$value['description']?></textarea>

                        </div>
                      </td>

                      <td align="center">
                        <span>

                          <?php if($key==0){?>
                            <a id="add_<?=$key?>" data-id="<?=$key?>" class="add_row btn btn-success btn-xs">
                              <i class="fa fa-plus"></i>
                            </a >

                          <?php }?>

                          <a id="dlt_<?=$key?>" data-id="<?=$key?>" data-prescription_det_id="<?=$value['pr_id']?>" class="dlt_row mt-1 btn btn-danger btn-xs">
                            <i class="fa fa-trash-o"></i>
                          </a >
                        </span>




                      </td>
                    </tr>

                  <?php } ?>

                  <input type="hidden" id="total_row" value="<?=$key?>" name="">


                </tbody>
              </table>
            </div>
          </div>

          <div class="col-md-12" align="center">

            <div class="col-md-offset-4 col-md-4" >
              <button class="btn btn-white btn-primary btn-bold">
                <i class="ace-icon glyphicon glyphicon-list"></i>
                Update Prescription
              </button>
            </div>

          </div>
        </form>

         <input type="hidden" id="save_flag" value="0" name="">



      </div>
    </div> 
    <div class="control-sidebar-bg shadow white fixed"></div>
  </div>
  <style type="text/css">


    .select2-container--default .select2-selection--multiple
    {
      background-color: white !important;
    }

  </style>
  <?php $this->load->view('back/footer_link');?>


  <!-- Select with search bar and datepicker End-->

  <!-- Modal Open for new Customer-->
  <script>

    $(document).ready(function(){


      $('#prescription_form').on('submit', function() {

        if($('#save_flag').val() == "0")
        {
          return true;
        }
        else 
        {
         alertify.alert("Invalid Dose Qty ! (Ex: 2+1+0+1)");
         return false;
       }



     });


      var i=$('#total_row').val();

      var i=parseInt(i)+1;

      // alert(i);

      $(document).on('click', '.dlt_row', function()
      {
        var id=$(this).data('id');
        var p_id=$(this).data('prescription_det_id');

        var prescription_id=$('#prescription_id').val();

        alertify.confirm('<b>Delete Confirmation</b>',"Are you sure you want to remove this?",
          function(){

           $('#row_'+id).remove();

           $.ajax({
            url:"<?=site_url("admin/delete_prescription_individual")?>",
            method:"POST",
            dataType:"json",
            data:{p_id:p_id,prescription_id:prescription_id},
            success:function(val)
            {
              if(val == "")
              {
                window.location="admin/prescription_list";
              }
            }
          });

         },
         function(){

         });



      });

      $(document).on('change', '#patient_id', function()
      {
        var patient_id=$('#patient_id option:selected').val();
          // alert(patient_id);

          $.ajax({
            url:"<?=site_url("admin/get_all_patient_info_by_ipd_id")?>",
            method:"POST",
            dataType:"json",
            data:{patient_id:patient_id},
            success:function(data)
            {
              $('#patient_name').val(data[0]['patient_name']);
              $('#reg_no').val(data[0]['reg_id']);
            }
          });

        });

      $(".add_row").click(function(){

        $(".chosen-select").select2("destroy");
        $(".day_dose").select2("destroy");

        $("#dynamic_row").append('<tr><td>'+parseInt(i+1)+'</td><td><select onchange="get_type('+i+')" id="med_id_'+i+'" name="med_id[]" class="chosen-select custom-select select2 form-control required"><option value=""></option><?php foreach ($product_list as $row) { $name=$row["p_name"];?><option value="<?=$row["id"]?>#<?=str_replace(["'",'"'],["\'",''],$name)?>"> <?=str_replace("'","\'",$name)?></option><?php } ?></select><input type="text" oninput="change_select('+i+')" id="unknown_medicine_id_'+i+'" class="form-control mt-2" name="unknown_medicine_name[]" required></td><td><input name="type[]" id="type_'+i+'" class="form-control type" type="text"></td><td><select class="custom-select select2 form-control day_dose" readonly multiple="multiple" name="day_dose_'+i+'[]" id="day_dose_'+i+'" required><?php foreach ($dose_schedule_list as $key => $value) { ?>
          <option selected value="<?=$value['id']?>"><?=$value['schedule']?></option><?php } ?></select></td><td><input name="dose_qty[]" id="dose_qty_'+i+'" oninput="check_fun('+i+')" class="form-control dose_qty" type="text" required></td><td><input name="max_day[]" id="max_day_'+i+'" class="form-control max_day" type="text" value="" required></td><td><textarea name="description[]" id="description_'+i+'" rows="1"></textarea></td><td align="center"><button" class="rem_row btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></button></td></tr>');

        i++;

        $(".chosen-select").select2();
        $(".day_dose").select2();
          // alert(i);
        });

      $("#dynamic_row").on('click','.rem_row',function(){
        $(this).parent().parent().remove();
        i--;
      });


    });

    function get_type(val) 
    {

      $("#unknown_medicine_id_"+val).removeAttr("required");
      $("#med_id_"+val).attr("required",true);

      var med_id=$('#med_id_'+val).val();  

      $('#unknown_medicine_id_'+val).val("");

      $.ajax({
        url:"<?=site_url("admin/get_product_type")?>",
        method:"POST",
        dataType:"json",
        data:{med_id:med_id},
        success:function(data)
        {
            // alert(data[0]['p_category_name']);
            $('#type_'+val).val(data[0]['p_category_name']);
            
          }
        });
    }



    function check_fun(arg) 
    {
      var dose_qty=$("#dose_qty_"+arg).val();

        // alert(dose_qty.length);

        if(dose_qty.split('+').length-1 < 3 )
        {
          $('#save_flag').val("1");

        }
        else 
        {
          $('#save_flag').val("0");

        }

        if(dose_qty.length < 7)
        {
          $('#save_flag').val("1");

        }
        else 
        {
          $('#save_flag').val("0");

        }

        
      }

      function change_select(arg) {


        $("#med_id_"+arg).removeAttr("required");
        $("#unknown_medicine_id_"+arg).attr("required",true);

        $.ajax({  
          url:"<?=site_url('admin/get_all_medicine')?>",  
          method:"POST",  
          dataType:"json",  
          success:function(data)  
          { 

           $("#med_id_"+arg).empty();

           $("#med_id_"+arg).append('<option value=""></option>')

           $.each(data, function (key, value) {

             $("#med_id_"+arg).append('<option  value="' + value.id+'#'+value.p_name + '">' + value.p_name + '</option>');

           });

         }
       });
      }




    </script>

  </body>
  </html>