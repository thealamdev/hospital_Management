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

    <?php if ($this->session->flashdata('error')) {?>
     <CENTER>
      <br>
      <h3 style="color:red;"><?php echo $this->session->flashdata('error') ?></h3>
    </CENTER>
    <br>
  <?php } elseif($this->session->flashdata('date_error')) {?>

   <CENTER>
    <br>
    <h3 style="color:red;"><?php echo $this->session->flashdata('date_error') ?></h3>
  </CENTER>
  <br>

<?php } ?>

<div class="section-wrapper">
  <div class="container-fluid">
   <div class="row pl-5 pr-5 pt-2">
    <div  class="col-md-4">
      <img class="mb-4" style="width: 120px;" src="uploads/hospital_logo/<?=$hospital_info[0]['hospital_logo']?>" alt="">
    </div> 
    <div class="col-md-4">
      <table class="test_table_report">
        <tbody>
          <tr>
            <td class="font-weight-normal"><h4><b><?=$hospital_info[0]['hospital_title']?></b></h4>
              <address class="ml-3">
                Address: <?=$hospital_info[0]['address_1']?><br>
                Telephone: <?=$hospital_info[0]['telephone']?><br>
                Mobile: <?=$hospital_info[0]['mobile_no']?>
              </address>
            </td>
          </tr>
        </tbody>
      </table>
    </div> 
    <div class="col-md-4"></div>
  </div>

  <div class="row pl-5 pr-5">
    <div class="col-md-4"></div>
    <div class="col-md-9">
      <table class="test_table_report">
        <tbody>
          <tr>
            <td>Patient Name: </td>
            <td><?=$patient_info[0]['patient_name']?></td>
          </tr>
          <tr>
            <td>Age: </td>
            <td><?=$patient_info[0]['age']?></td>
          </tr>
          <tr>
            <td>Gender: </td>
            <td><?=$patient_info[0]['gender']?></td>
          </tr>
          <tr>
            <td>Date Of Birth: </td>
            <td><?=date('d M,Y',strtotime($patient_info[0]['date_of_birth']))?></td>
          </tr>
          <tr>
            <td>Mobile No: </td>
            <td><?=$patient_info[0]['mobile_no']?></td>
          </tr>
          <tr>
            <td>Address: </td>
            <td><?=$patient_info[0]['address']?></td>
          </tr>

        </tbody>
      </table>      
    </div>
    <div class="col-md-3">
      <table class="test_table_report">
        <tbody>
         <tr>
          <td>Booked By: </td>
          <td><?=$patient_info[0]['operator_name']?></td>
        </tr>
        <tr>
          <td>Doctor Name: </td>
          <td><?=$patient_info[0]['doc_name']?></td>
        </tr>
        <tr>
          <td>Ref Doctor Name: </td>
          <td><?=$patient_info[0]['ref_doc_name']?></td>
        </tr>
      </tbody>
    </table>

  </div>

</div>

<!-- Table row -->
<form action="admin/edit_ipd_bill_post" method="POST">

  <input type="hidden" name="patient_id" value="<?=$patient_info[0]['id']?>">

  <div class="form-check form-check-inline mt-5 ml-5 mb-3">
    <input class="form-check-input" 
    <?php if ($flag == "release") {  echo "checked"; } ?> type="radio" name="release_unrelease" id="release" value="release">
    <label class="form-check-label" for="release">Released</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="release_unrelease" id="unrelease" <?php if ($flag == "unrelease") {  echo "checked"; } ?> value="unrelease">
    <label class="form-check-label" for="unrelease">Unreleased</label>
  </div>

  <div class="row pl-5 pr-5 my-2">
    <div class="col-12 table-responsive">
      <table class="table table-bordered table-striped test_table_report">
        <tbody>
          <tr><td colspan="4"align="right">Admission Fee</td><td align="right"><input readonly="" style="text-align: right"  value="<?=number_format($patient_info[0]['admission_fee'],2,'.','')?>" class="form-control" type="text"></td></tr>

          <tr><td colspan="4"align="right"></td><td align="right"><input required="" value="<?=number_format($patient_info[0]['admission_fee'],2,'.','')?>" class="col-md-4 form-control" placeholder="Admission Fee" type="text" name="adm_fee"></td></tr>

          <tr><td colspan="4"align="right">Admission Fee Paid</td><td align="right"><input readonly="" style="text-align: right"  value="<?=number_format($patient_info[0]['admission_fee_paid'],2,'.','')?>" class="form-control" type="text"></td></tr>

          <tr><td colspan="4"align="right"></td><td align="right"><input required="" value="<?=number_format($patient_info[0]['admission_fee_paid'],2,'.','')?>" class="col-md-4 form-control" placeholder="Admission Fee Paid" type="text" name="adm_fee_paid"></td></tr>

          <tr><td colspan="4"align="right">Advance Payment</td><td align="right"><input readonly="" style="text-align: right" value="<?=number_format($total_bill_info[0]['advance_payment'],2,'.','')?>" class="form-control" type="text"></td></tr>

          <tr><td colspan="4"align="right"></td><td align="right"><input required="" value="<?=number_format($total_bill_info[0]['advance_payment'],2,'.','')?>" class="col-md-4 form-control" placeholder="Advance Payment" type="text" name="adv_payment"></td></tr>

        </tbody>
      </table>
    </div>
  </div>


  <!-- Table row -->
  <div class="row mt-5 pl-5">
    <h4>Cabin Bill</h4>
  </div>

  <div class="row pl-5 pr-5 my-2">
    <div class="col-12 table-responsive">
     <table class="table table-bordered table-striped test_table_report">
      <thead>
        <th>SL NO</th>
        <th>Admit Date</th>
        <th>Room No</th>
        <th>Room Price</th>
        <th>Day</th>
        <th>Cost</th>
        <th style="width:20%">Total</th>

      </thead>
      <tbody>
        <?php $i=1;
        $days=0;
        $total_cabin=0;
        $total_ser=0;
        $total=0;


        if($flag=="release")
        { 

          foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) {?>

            <tr>
              <td align="center"><?=$i?></td>
              <td align="center"><?=date('d-m-Y',strtotime($value['created_at']))?></td>
              <td align="center"><?=$value['room_title']?></td>
              <td align="center"><?=$value['room_price']?></td>
              <td align="right">
               <?php 
                                 // echo date('Y-m-d',strtotime($value['created_at']));
                                 // echo date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at']));

               $current_date=date_create(date('Y-m-d H:i:s',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
               $next_date=date_create(date('Y-m-d H:i:s',strtotime($patient_timeline[$key+1]['created_at'])));
               $diff=date_diff($next_date,$current_date);
               $hours= $diff->h;
               $days= $diff->d;

               $price_per_hour=$value['room_price']/24;

               $total_cabin= $total_cabin+($days*$value['room_price']+$hours*$price_per_hour);

               echo $days.' days '.$hours.' hours';
               ?>

             </td>
             <td align="right"><?=round($days*$value['room_price']).' + '.round($hours*$price_per_hour)?></td>




             <td align="right"><?=round($days*$value['room_price']+$hours*$price_per_hour)?></td>


           </tr>

           <?php $i++; } } }
           else 
           {


            foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) {?>

              <tr>
                <td align="center"><?=$i?></td>
                  <td align="center"><?=date('d-m-Y',strtotime($value['created_at']))?></td>
                <td align="center"><?=$value['room_title']?></td>
                <td align="center"><?=$value['room_price']?></td>

                <td align="right">
                 <?php 
                                 // echo date('Y-m-d',strtotime($value['created_at']));
                                 // echo date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at']));

                 $current_date=date_create(date('Y-m-d H:i:s',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
                 $next_date=date_create(date('Y-m-d H:i:s',strtotime($patient_timeline[$key+1]['created_at'])));
                 $diff=date_diff($next_date,$current_date);
                 $hours= $diff->h;
                 $days= $diff->d;

                 $price_per_hour=$value['room_price']/24;

                        //  if($days==0)
                        //  {
                        //   $days=1;
                        // }

                 $total_cabin= $total_cabin+($days*$value['room_price']+$hours*$price_per_hour);

                 echo $days.' days '.$hours.' hours';
                 ?>

               </td>
               <td align="right"><?=round($days*$value['room_price']).' + '.round($hours*$price_per_hour)?></td>




               <td align="right"><?=round($days*$value['room_price']+$hours*$price_per_hour)?></td>

             
             </tr>

             <?php $i++;} 

             else { ?>
              <tr>
                <td align="center"><?=$i?></td>
                 <td align="center"><?=date('d-m-Y',strtotime($value['created_at']))?></td>
                <td align="center"><?=$value['room_title']?></td>
                <td align="center"><?=$value['room_price']?></td>
                <td align="right">
                 <?php 
                                 // echo date('Y-m-d',strtotime($value['created_at']));
                                 // echo date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at']));

                 $current_date=date_create(date('Y-m-d H:i:s',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
                 $next_date=date_create(date('Y-m-d H:i:s'));

                 $diff=$next_date->diff($current_date);
                 $hours= $diff->h;
                 $days= $diff->d;

                 $price_per_hour=$value['room_price']/24;

                        //  if($days==0)
                        //  {
                        //   $days=1;
                        // }

                 $total_cabin= $total_cabin+($days*$value['room_price']+$hours*$price_per_hour);

                 echo $days.' days '.$hours.' hours';
                 ?>

               </td>
               <td align="right"><?=round($days*$value['room_price']).' + '.round($hours*$price_per_hour)?></td>




               <td align="right"><?=round($days*$value['room_price']+$hours*$price_per_hour)?></td>

             </tr>

           <?php  }



         }  }?>


       </tbody>
     </table>

     <table class="table table-striped table-bordered mytable_style table-hover sell_cart">
      <thead>
        <tr>
          <th style="width:10%">S.L</th>
          <th style="width:20%;">Room No</th>
          <th style="width:30%;">Admit Date</th>
          <th style="width:5%;">Action</th>
        </tr>
      </thead>
      <tbody class="mytable_style" id="dynamic_row">

        <tr>
          <td>1</td>
          <td>
            <select id="room_no"  name="r_id[]" class="chosen-select custom-select select2 form-control">
              <option value=""></option>
              <?php foreach ($room_info as $row) { 
                if($row['is_busy']==0 || $last_room[0]['cabin_no'] == $row['id'] ){
                  ?>
                  <option value="<?=$row['id'];?>"><?=$row['room_title'];?> (<?=$row['room_price'];?>)</option>
                <?php } }?>
              </select> 
            </td>


            <td><div class="input-group focused">
              <input type="text" name="admit_date[]" autocomplete="off" class="date-time-picker form-control"  data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}">
              <span class="input-group-append">
                <span class="input-group-text add-on white">
                  <i class="icon-calendar"></i>
                </span>
              </span>
            </div></td>
            <td>

              <a class="add_row btn btn-success btn-xs">
                <i class="fa fa-plus"></i>
              </a >
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

  <input type="submit" id="submit-form" style="display: none;" />

</form>

<div class="row  pl-5 mt-5">
  <h4>Service Bill</h4>
</div>
<div class="row mt-3">
  <div class="col-md-12">
    <?php if($service_info!=null) { ?>
      <table class="table table-bordered table-striped test_table_report">
        <thead>
          <th>SL NO</th>
          <th>Date</th>
          <th>Service Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th style="width:20%">Total</th>

        </thead>
        <tbody>
          <?php $i=1;

          $total_ser=0;
                          // $last_date=0;
          foreach ($service_info as $key => $value) { ?>

            <tr>
              <td align="center"><?=$i?></td>
              <td align="center"><?=date('d-M-Y h:i:s', strtotime($value['created_at']))?></td>
              <td align="center"><?=$value['service_name']?> (<?=$value['operated_name']?>)</td>
              <td align="right"><?=$value['price']?></td>
              <td align="right"><?=$value['qty']?></td>
              <td align="right"><?=$value['price']*$value['qty']?></td>

            </tr>

            <?php 
            $i++;}  


            ?>

          </tbody>
        </table>
      <?php } else {?>

        <h4>No Service Added</h4>
      <?php } ?>
    </div>
  </div>


  <div class="row">
    <!-- first COl 1 -->
    <div class="col-md-12">

      <!-- <div class="card-title">Simple usage</div> -->
      <table id="test_info_table" data-page-length="3" class="table table-bordered table-hover data-tables">
        <thead>
          <tr>
            <th>SL NO</th>
            <th>Code</th>
            <th>Service Name</th>
            <th>Op. By</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $i=1;
          foreach ($service_info_edit as $row) { ?> 
            <tr>


              <td><?=$i?></td>
              <td><?=$row['service_code'];?></td>
              <td>
                <?=$row['service_name'];?>
              </td>

              <td>
                <select id="ser_<?=$row['id']?>" class="select2 form-control-xs doc_list" required name="service_type">
                </select>
              </td>

              <!--   <td class="hidden-480"><?=$row['sub_cat_name'];?></td> -->
              <!-- <td><?=$row['unit'];?></td> -->

              <td><?=number_format($row['service_price'],2);?> </td>


              <td>
                <button  class="btn btn-xs btn-primary add_to_bill"  data-service_id="<?=$row['id']?>"  data-service="<?=$row['service_name']?>" data-price="<?=$row['service_price']?>"
                  >
                  <i class="ace-icon fa fa-plus"></i>
                  Add
                  <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                </button>
              </td>
            </tr>
            <?php $i++; } ?>

          </tbody>
        </table>
      </div>

      <!-- Second Col 2 -->

      <div class="col-md-12 mt-4">

        <div id="service_cart">
          <?php $this->load->view('ipd/edit_ipd_bill_cart'); ?>

        </div>

      </div>

    </div>

    <div class="offset-md-4 col-md-4 mt-2 mb-2" align="center">
      <label class="form-control btn-success" for="submit-form" tabindex="0">Save</label>
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

    var i=2;

    $(".add_row").click(function(){

      $(".chosen-select").select2("destroy");

      $("#dynamic_row").append('<tr><td>'+i+'</td><td><select id="r_id_'+i+'"  name="r_id[]" class="chosen-select custom-select select2 form-control"><option value=""></option><?php foreach ($room_info as $row) {  if($row['is_busy']==0 || $last_room[0]['cabin_no'] == $row['id'] ){$name=$row["room_title"];?><option value="<?=$row["id"];?>"><?=str_replace("'","\'",$name)?>(<?=str_replace("'","\'",$row['room_price'])?>)</option><?php } } ?></select> </td><td><div class="input-group focused"><input type="text" autocomplete="off" name="admit_date[]" class="date-time-picker form-control" id="date_pick_'+i+'"  data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}"><span class="input-group-append"><span class="input-group-text add-on white"><i class="icon-calendar"></i></span></span></div></td><td><button class="rem_row btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></button></td></tr>');

        // $("#date_pick_"+i).datepicker();
         // $('.datepicker').datepicker(); 
         // $("#date_pick_"+i).datepicker({ dateFormat: 'dd-M-yy' }, { changeMonth: true }, { changeYear: true });

         jQuery('#date_pick_'+i).datetimepicker({timepicker:false,format:'Y-m-d'});

         i++;

         $(".chosen-select").select2();
    // alert(i);
  });

    $("#dynamic_row").on('click','.rem_row',function(){
      $(this).parent().parent().remove();
      i--;
    });

  </script>




  <script type="text/javascript">
    $(document).ready(function()
    {

     $.ajax({
      url:"<?=site_url("admin/get_all_doc_name")?>",
      method:"POST",
      dataType:"json",
      success:function(data)
      {
        $('.doc_list').empty();

        $(".doc_list").append('<option value="0">self</option>')

        $.each(data, function (key, value) {

          $(".doc_list").append('<option value="' + value.doctor_id + '">' + value.doctor_title + '</option>');


        });

      },
      error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
    });


     $(document).on('click', '.page-link', function()
     {

      $.ajax({
        url:"<?=site_url("admin/get_all_doc_name")?>",
        method:"POST",
        dataType:"json",
        success:function(data)
        {
          $('.doc_list').empty();

          $(".doc_list").append('<option value="0">self</option>');

          $.each(data, function (key, value) {

            $(".doc_list").append('<option value="' + value.doctor_id + '">' + value.doctor_title + '</option>');


          });

        },
        error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
      });
    });



     $(document).on('click', '.add_to_bill', function()
     {

       var s_name=$(this).data('service');
       var s_price=$(this).data('price');
       var s_id=$(this).data('service_id');
       var s_doctor=$("#ser_"+s_id+" option:selected").text();

       var s_doctor_val=$("#ser_"+s_id+" option:selected").val();

        // if(s_doctor_val!=0)
        // {


          var s_name=$(this).data('service');
          var s_price=$(this).data('price');
          var s_id=$(this).data('service_id');
          var s_doctor=$("#ser_"+s_id+" option:selected").text();

          var s_doctor_val=$("#ser_"+s_id+" option:selected").val();       
          var quantity="1";


          $.ajax({
            url:"<?=site_url("admin/edit_ipd_add_service_cart")?>",
            method:"POST",
            dataType:"html",
            data:{s_id:s_id,s_name:s_name,s_price:s_price,quantity:quantity,s_doctor:s_doctor,s_doctor_val:s_doctor_val},
            success:function(data)
            {

              $('#service_cart').html(data);
            },
            error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
          });
          

       // }

       // else
       // {

       //  $("#ser_"+s_id).notify(
       //  "Please Select Doctor List", 
       //  { position:"right"}
       //    );
       // }


     });



     $(document).on('click', '.remove_product', function()
     {
      var row_id = $(this).attr("id");
      alertify.confirm('<b>Delete Confirmation</b>',"Are you sure you want to remove this?",
        function(){
          //alertify.success('Ok');
          $.ajax({
            url:"<?=site_url()?>admin/remove_service_cart",
            method:"POST",
            dataType:"html",
            data:{row_id:row_id},
            success:function(data)
            {
              $('#service_cart').html(data);
            },
            error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
          });
        },
        function(){
          //alertify.error('Cancel');
        });

    });



   }); 



    function update_qty(row_id,id)
    {


      var qty = $('#sell_cart_qty_'+id).val();
      var price = $('#sell_cart_price_'+id).val();

      $.ajax({
        url: "<?php echo site_url('admin/edit_ipd_update_service_cart');?>",
        type: "post",
        data: {row_id:row_id,qty:qty,price:price},
        success: function(data)
        {
          $('#service_cart').html(data);


        }      
      });  


    }



  </script>
</body>
</html>












