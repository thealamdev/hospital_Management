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

    <!-- Add Customer Modal Starts -->
<!-- 
        <div class="modal fade" id="add_customer_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <div class="modal-body">
                    <input type="hidden" name="hidden_field" id="hidden_field">
                     <input type="hidden" name="patient_id" id="patient_id">
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="1"  onclick="pass_radio_val()" name="optradio">opd patient
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" value="2" onclick="pass_radio_val()" name="optradio">ipd patient
                      </label>
                    </div>
                    <div class="form-check-inline">
                      <label class="form-check-label">
                        <input checked type="radio" class="form-check-input mb-4" value="3" onclick="pass_radio_val()" name="optradio">others
                      </label>
                    </div>
                    

                      

                      <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="customer_phone">Customer Phone</label>
                        <input type="text" name="customer_phone" id="customer_phone" class="form-control validate">
                    </div>

                    <div class="md-form mb-2">
                        <i class="fa fa-h-square" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="customer_name">Customer Name</label>
                        
                         <input type="text" id="customer_name" name="customer_name" class="form-control validate" required="">
                          
                        
                    </div>
                    <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="customer_address">Customer Address</label>
                        <input type="text" id="customer_address" name="customer_address" class="form-control validate">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary btn-sm"  id="add_customer_name_button">Add<i class="fa fa-plus ml-1"></i></button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
                  </div>
                </div>
              </div>
            </div> -->
            <!-- Add Customer Modal Ends -->


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
                            <th style="width: 30%">Op. By</th>
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
                    </div>
                  </div>
                  <!-- Second Col 2 -->

                  <div class="col-md-5">
                    <form action="admin/insert_service_data" method="post">
                      <div class="card my-3 no-b">
                        <div class="card-body">
                          <div class="row" style="padding:15px;">

                            <div class="col-md-12 mb-4" id="customer_list_div">
                              <label for="patient_id">Patient Id:</label>
                              <select id="patient_id"  <?php if($p_id!=0){
                                echo "readonly" ;}?>
                                name="patient_id" class="chosen-select custom-select select2 form-control" required>
                                <option value=""></option>
                                <?php foreach ($ipd_all_patient as $row) { 
                                  if($p_id==$row['id']){?>

                                    <option selected value="<?=$row['id'];?>"><?=$row['patient_info_id'];?></option>
                                  <?php } else { ?>

                                    <option value="<?=$row['id'];?>"><?=$row['patient_info_id'];?></option>
                                  <?php } } ?>

                                  <option value="new_patient">Add New Patient</option>


                                </select> 
                              </div>



                              <div class="col-md-12 mb-3">
                                <input type="text" id="patient_name" name="patient_name" <?php if($p_name!=null){
                                  echo "value='$p_name'" ;}?> placeholder="Patient Name" required class="form-control" readonly>
                                </div>

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
                <?php $this->load->view('ipd/service_cart_details'); ?>

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
            url:"<?=site_url("admin/add_service_cart")?>",
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

        // alert(prev_qty);
        // alert(current_stock);
        // alert(qty);

        
        $.ajax({
          url: "<?php echo site_url('admin/update_service_cart');?>",
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