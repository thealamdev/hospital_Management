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
      <div class="container-fluid">
        <div class="row">
          <!-- first COl 1 -->
          <div class="col-md-7">
            <div class="card my-3 no-b">
              <div class="card-body">
                <!-- <div class="card-title">Simple usage</div> -->
                <table id="test_info_table" class="table table-bordered table-hover data-tables"
                data-options='{ "paging": false; "searching":false}'>
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Code</th>
                    <th>Service Name</th>
                    <th style="width: 30%;">Op. By</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  foreach ($service_info as $row) { ?> 
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

                      <td><?=number_format($row['service_price'],2);?> ৳</td>


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
            </div>
          </div>
          <!-- Second Col 2 -->

          <div class="col-md-5">

            <form action="admin/insert_outdoor_service_data" method="post">

              <div class="card my-3 no-b">
                <div class="card-body">
                  <div class="row" style="padding:15px;">

                    <div class="col-md-12 mb-3">
                      <input type="text" id="reg_no" name="reg_no"  placeholder="Reg No" value="<?=$reg_id?>" readonly  class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                      <input type="text" id="patient_name" name="patient_name"  placeholder="Patient Name" required class="form-control">
                    </div>

                     <div class="col-md-12 mb-3">
                      <input type="text" id="mobile_no" name="mobile_no"  placeholder="Mobile No"  class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                      <input type="text" id="address" name="address"  placeholder="Address"  class="form-control">
                    </div>

<!--                     <div class="col-md-12 mb-3">
                     <select class="custom-select select2" name="b_cabin_no" id="cabin_no" required>
                      <option value="">Select Cabin No</option>

                      <?php
                      foreach ($room as $key => $ro) {
                        $count=0;

                        foreach ($cabin_available_info as $key1 => $value) {

                          if($ro['id']==$value['cabin_no']){ 
                           $count=1; ?>

                         <?php   } 

                       } if($count==0) {?>

                        <option value="<?=$ro['id']?>"><?=$ro['room_title']?></option>
                      <?php } ?>



                    <?php }
                    ?>
                  </select>

                </div> -->

            <!-- <div class="col-md-6 ">
              <input type="text" id="bill_no" name="bill_no" placeholder="Bill No" required class="form-control">
            </div> -->
            

          </div>
        </div>
      </div>
      <div class="card my-3 no-b">
        <div class="card-body" >
             <!--  <div class="" id="zero_stock_div">
                <div class="alert alert-block alert-danger">
                  <i class="ace-icon fa fa-info-circle bigger-120"></i>
                  &nbsp;Stock not available
                </div>
              </div> -->

              <div id="service_cart">
                <?php $this->load->view('ipd/outdoor_service_cart'); ?>

              </div>

              
            

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
    padding-top: 10px !important;
    padding-bottom: 10px !important;
    padding-left: 0px !important;
    padding-right:0px !important;
  }
</style>
<?php $this->load->view('back/footer_link');?>
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


   $(document).on('change','#patient_id', function(event)
   {        


     if($(this).find(":selected").val()=='new_patient'){
                  // alert($(this).find(":selected").val());
                  window.location="admin/ipd_registration";


                }
                else
                {
                  var p_info_id=$(this).find(":selected").text();

                  $.ajax({
                    url:"<?=site_url("admin/get_all_ipd_info_by_patient_info_id")?>",
                    method:"POST",
                    dataType:"json",
                    data:{p_info_id:p_info_id},
                    success:function(data)
                    {

                      $("#patient_name").val(data[0]['patient_name']);


                    },
                    error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
                  });

                }
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
            url:"<?=site_url("admin/outdoor_add_service_cart")?>",
            method:"POST",
            dataType:"html",
            data:{s_id:s_id,s_name:s_name,s_price:s_price,quantity:quantity,s_doctor:s_doctor,s_doctor_val:s_doctor_val},
            success:function(data)
            {

              $('#service_cart').html(data);
            },
            error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
          });
          



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
            url:"<?=site_url()?>admin/outdoor_remove_service_cart",
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


   $(document).on('input', '#discount', function()
   {

    total_discount_vat();


  });

   $(document).on('input', '#vat', function()
   {
     total_discount_vat();


   });

   $(document).on('input', '#total_paid', function()
   {
    total_paid();
  });




 }); 



  function update_qty(row_id,id)
  {


    var qty = $('#sell_cart_qty_'+id).val();
    var price = $('#sell_cart_price_'+id).val();

        // alert(prev_qty);
        // alert(current_stock);
        // alert(qty);

        
        $.ajax({
          url: "<?php echo site_url('admin/update_outdoor_service_cart');?>",
          type: "post",
          data: {row_id:row_id,qty:qty,price:price},
          success: function(data)
          {
            $('#service_cart').html(data);


          }      
        });  

        

        // alert(prev_qty);
        // alert(current_stock);


        



        // var price = $('#price_'+row_id).val();


      }

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

          // alert(net_total +':'+ total_paid );
          

          var due=parseFloat(net_total)-parseFloat(total_paid);
          // alert(due);

          $('#due').val(due.toFixed(2));
        }

        function total_discount_vat()
        {
          var discount;
          var vat;
          var total=$('#discount').data('total');
          if($('#discount').val()=="")
          {
            discount="0";
          }
          else
          {
            discount=$('#discount').val();
            discount=discount;
          }
          if($('#vat').val()=="")
          {
            vat="0";
          }
          else
          {
            vat=$('#vat').val();
            vat=parseFloat(vat);
            // vat=vat.toFixed(2);


          }
          
          
          // alert(total+':'+vat+":"+discount);

          var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

          $('#net_total').val(net_total.toFixed(2));

          total_paid();



        }


      </script>

    </body>
    </html>