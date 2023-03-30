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
                    <!-- <th>Batch</th> -->
                    <th>Product Name</th>
                    <!-- <th>Unit</th> -->
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Expire</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  foreach ($product_list as $row) { ?> 
                    <tr>
                      <input type="hidden" name="" id="p_c_stock<?=$row['id']?>" value="<?=$row['current_stock']?>">

                      <td><?=$i?></td>
                      <td><?=$row['p_code'];?></td>
                      <!-- <td><?=$row['batch_id'];?></td> -->
                      <td>
                        <a href="#" target="_blank" class="hide-option" title="Click to see the Product details"><?=$row['p_name'];?></a>
                      </td>

                      <!--   <td class="hidden-480"><?=$row['sub_cat_name'];?></td> -->
                      <!-- <td><?=$row['unit'];?></td> -->

                      <td><?=number_format($row['p_sell_price'],2);?> ৳</td>

                      <td class="hidden-480">
                        <div class="badge <?php if($row['current_stock']>$row['p_reorder_qty']){ echo "badge-success";}else{echo "badge-danger";}?>">
                          <?=$row['current_stock'];?>&nbsp;
                          <i class="ace-icon fa <?php if($row['current_stock']>$row['p_reorder_qty']){ echo "fa-arrow-up";}else{echo "fa-arrow-down";}?>"></i>
                        </div>
                      </td>
                      <td><?=date('d-m-Y', strtotime($row['expire_date']));?></td>
                      <td>
                        <button  class="btn btn-xs btn-primary add_to_bill"  data-expire_date="<?=$row['expire_date']?>" data-batch_id="<?=$row['batch_id']?>"  data-product_id="<?=$row['id']?>"  data-p_current_stock="<?=$row['current_stock']?>" data-product="<?=$row['p_name']?>" data-price="<?=$row['p_sell_price']?>"
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

          <div class="col-md-7">
            <table class="table table-striped table-bordered table-hover sell_cart test_table_report">
                    <thead>
                      <tr>
                        <th>S.L</th>
                        <th >Product Name</th>

                        <th >Expire</th>
                        <th >Qty</th>
                        <th >Price</th>
                        
                        <th >Price*Qty</th>
                        <th >Date</th>
                      </tr>
                    </thead>
                    <tbody class="mytable_style" >

                      <tr>
                        <?php foreach ($sell_details as $key => $row) { ?>

                          <td align="center"><?=$key+1;?></td>
                          <td align="center"><?=$row['p_name'];?></td>

                          <td align="center"><?=$row['expire_date'];?></td>
                          <td align="center"><?=$row['sell_qty'];?>&nbsp;<?=$row['unit'];?>
                        </td>
                        <td align="right"><?=number_format($row['sell_price'],2);?>&nbsp;৳ 
                        </td>
                        <td align="right"><?=number_format(($row['sell_price']*$row['sell_qty']),2);?>&nbsp;৳ 
                        </td> 
                        <td align="right"><?=date('d M Y h:i:s', strtotime($row['c_date']))?>
                      </td> 
                    </tr>
                  <?php } ?>

                  <tr>
                    <td colspan="5" align="right">
                      <strong>Total:</strong>
                    </td>
                    <td align="right">
                      <?=number_format($row['credit'],2);?>&nbsp;৳
                    </td>
                  </tr>

                  <input type="hidden" value="<?=$row['net_total']-$row['debit'];?>" name="due">

                  <tr>
                    <td colspan="5" align="right">
                      <strong>Discount:</strong>
                    </td>
                    <td align="right">
                      <?=number_format($row['discount'],2);?>&nbsp;৳
                    </td>

                  </tr>

                  <tr>
                    <td colspan="5" align="right">
                      <strong>VAT:</strong>
                    </td>
                    <td align="right">
                      <?=number_format($row['vat'],2);?>&nbsp;৳
                    </td>

                  </tr>

                  <tr>
                    <td colspan="5" align="right">
                      <strong>Net Total:</strong>
                    </td>
                    <td align="right">
                      <?=number_format($row['net_total'],2);?>&nbsp;৳
                    </td>

                  </tr>

                  <tr>
                    <td colspan="5" align="right">
                      <strong>Paid:</strong>
                    </td>
                    <td align="right">
                      <?=number_format($row['debit'],2);?>&nbsp;৳
                    </td>

                  </tr>

                  <input type="hidden" value="<?=$row['net_total']-$row['debit'];?>" name="due" id="due">

                  <tr>
                    <td colspan="5" align="right">
                      <?php $ad= $row['debit']-$row['net_total'];?>
                      <?php if($ad>0){ ?>
                        <strong class="text-success">Advance</strong>
                      <?php } else if($ad<0){  ?>

                        <strong class="text-danger">Due</strong>
                      <?php }  else {?>
                        <strong class="text-default">Due/Advance</strong>
                      <?php } ?>

                    </td>
                    <td align="right">
                      <?php if($ad>=0){ ?>
                        <?=number_format($ad,2);?>&nbsp;৳
                      <?php } if($ad<0){ ?>
                        <?=number_format(($ad*(-1)),2);?>&nbsp;৳
                      <?php }  ?>                   
                    </td>   
                  </tr>

                </tbody>                    
              </table>
          </div>


          <!-- Second Col 2 -->

          <div class="col-md-5" style="margin-top: -250px !important;">
            <form action="admin/insert_sell_data_edit/<?=$sell_details[0]['id']?>/<?=$sell_details[0]['sell_code']?>" method="post">
              <div class="card my-3 no-b">
                <div class="card-body">

                 <div class="form-check-inline ml-2 mt-4 ml-4">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="1" <?= $sell_details[0]['type']==1 ? "checked":"" ?>  onclick="pass_radio_val_opd()" name="optradio">opd patient
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="2" <?= $sell_details[0]['type']==2 ? "checked":"" ; ?> onclick="pass_radio_val_ipd()" name="optradio">ipd patient
                  </label>
                </div>
                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input  type="radio" class="form-check-input mb-4" value="3" <?= $sell_details[0]['type']==3 ? "checked":"" ; ?> onclick="pass_radio_val_phar_cust()" name="optradio">Phar Customer
                  </label>
                </div>

                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input  type="radio" class="form-check-input mb-4" value="4" onclick="pass_radio_val_new()" name="optradio">New
                  </label>
                </div>

                <div class="form-check-inline">
                  <label class="form-check-label">
                    <input <?= $sell_details[0]['type']==4 ? "checked" :"" ;?> type="radio" class="form-check-input mb-4 ml-4" value="5" onclick="pass_radio_val_phar_uhid()" name="optradio">UHID
                  </label>
                </div>

                <div class="row" style="padding:15px;">
                  <div class="col-md-6 mb-4" id="customer_list_div" style="<?= $sell_details[0]['type']==3 ? "display: block" :"" ;?>display: none;">
                    <label for="customer_name">Customer Name:</label>
                    <select id="customer_name" onchange="get_customer()"  name="cust_id" class="chosen-select custom-select select2 form-control" >
                      <option value=""></option>
                      <?php foreach ($customer_list as $row) { ?>
                        <option <?= $sell_details[0]['type']==3 && $sell_details[0]['cust_id'] == $row['id']? "selected" :"" ;?>  value="<?=$row['id'];?>"><?=$row['cust_gen_id'];?> (<?=$row['cust_name'];?>)</option>
                      <?php } ?> 

                      <option value="new_cust">Add New Customer</option>
                    </select> 
                  </div>

                  <div class="col-md-6 mb-4" id="opd_customer_list_div" style="<?= $sell_details[0]['type']==1 ? "display: block" :"" ;?>display: none;">
                    <label for="opd_customer_name">Opd Customer Name:</label>
                    <select id="opd_customer_name" onchange="get_customer_opd()"  name="opd_cust_id" class="chosen-select custom-select select2 form-control" >
                      <option value=""></option>
                      <?php foreach ($opd_customer_list as $row) { ?>
                        <option <?= $sell_details[0]['type']==1 && $sell_details[0]['p_id'] == $row['id']? "selected" :"" ;?> value="<?=$row['id'];?>"><?=$row['patient_info_id'];?> (<?=$row['patient_name'];?>)</option>
                      <?php } ?> 
                    </select> 
                  </div>


                  <div class="col-md-6 mb-4" id="ipd_customer_list_div" style="<?= $sell_details[0]['type']==2 ? "display: block" :"" ;?>display: none;">
                    <label for="ipd_customer_name">IPD Customer Name:</label>
                    <select id="ipd_customer_name" onchange="get_customer_ipd()"   name="ipd_cust_id" class="chosen-select custom-select select2 form-control" >
                      <option <?= $sell_details[0]['type']==2 && $sell_details[0]['p_id'] == $row['id']? "selected" :"" ;?> value=""></option>
                      <?php foreach ($ipd_customer_list as $row) { ?>
                        <option value="<?=$row['id'];?>"><?=$row['patient_info_id'];?> (<?=$row['patient_name'];?>)</option>
                      <?php } ?> 
                    </select> 
                  </div>

                  <div class="col-md-6 mb-4" id="uhid_customer_list_div" style="<?= $sell_details[0]['type']==4 ? "display: block" :"" ;?>display: none;">
                    <label for="uhid_customer_name">UHID Customer Name:</label>
                    <select id="uhid_customer_name" onchange="get_customer_uhid()"   name="uhid_customer_id" class="chosen-select custom-select select2 form-control" >
                      <option value=""></option>
                      <?php foreach ($uhid_customer_list as $row) { ?>
                        <option <?= $sell_details[0]['type']==4 && $sell_details[0]['p_id'] == $row['id']? "selected" :"" ;?> value="<?=$row['id'];?>"><?=$row['gen_id'];?> (<?=$row['patient_name'];?>)</option>
                      <?php } ?> 
                    </select> 
                  </div>


                  <div class="col-md-6 mb-4" id="address_div" style="display: none">

                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="Address"  class="form-control">
                  </div>

                  <div class="col-md-6 mb-2">
                    <i class="" aria-hidden="true"></i>
                    <label data-error="wrong" data-success="right" for="customer_phone">Director Ref</label>

                    <select class="custom-select select2 form-control" name="ref_dir_id" id="ref_dir_id" required>
                      <option value="0#self">self</option>
                      <!-- <option value="all">All</option> -->

                      <?php 
                      foreach ($director_list as $key => $value) { ?>
                       <option <?=$sell_details[0]['ref_dir_id'] == $value['id']? "selected" :"" ;?> value="<?=$value['id']?>#<?=$value['director_name']?>"><?=$value['director_name']?></option>
                     <?php }
                     ?>
                   </select>
                 </div>


                 <div class="col-md-6">
                  <input type="text" readonly id="patient_name" name="patient_name"   placeholder="Patient Name" required="" value="<?=$sell_details[0]['cust_name']?>"  class="form-control">
                </div>

                <div class="col-md-6">
                  <input type="text" readonly  id="mobile_no" name="mobile_no" value="<?=$sell_details[0]['cust_phone']?>" placeholder="Mobile No"  class="form-control">
                </div>



              <!--     
                  <div class="col-md-6 align-right">
                    <input type="text" name="export_no" id="chalan_no" placeholder="Chalan No" class="form-control">
                  </div>
                -->
              </div>
            </div>
          </div>
          <div class="card my-3 no-b">
            <div class="card-body" >
              <div id="sell_cart_details">
                <?php $this->load->view('pharmacy/sell_cart_details'); ?>

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

    // $("#address_div").show();

    $(document).on('change','#customer_name', function(event)
    {        


     if($(this).find(":selected").val()=='new_cust'){
                  // alert($(this).find(":selected").val());
                  window.location="admin/add_customer";


                }
              });

    $(document).on('click', '.add_to_bill', function()
    {

      var p_name=$(this).data('product');
      var p_price=$(this).data('price');
      var p_id=$(this).data('product_id');
      var batch_id=$(this).data('batch_id');
      var expire_date=$(this).data('expire_date');
      var quantity="1";


      $.ajax({
        url:"<?=site_url("admin/add_sell_cart")?>",
        method:"POST",
        dataType:"html",
        data:{p_id:p_id,p_name:p_name,p_price:p_price,quantity:quantity,batch_id:batch_id,expire_date:expire_date},
        success:function(data)
        {
              //console.log(data);
              $('#sell_cart_details').html(data);

            },
            error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
          });

    });



    $(document).on('click', '.remove_product', function()
    {
      var row_id = $(this).attr("id");
      alertify.confirm('<b>Delete Confirmation</b>',"Are you sure you want to remove this?",
        function(){
          //alertify.success('Ok');
          $.ajax({
            url:"<?=site_url()?>admin/remove_sell_cart",
            method:"POST",
            dataType:"html",
            data:{row_id:row_id},
            success:function(data)
            {
              $('#sell_cart_details').html(data);
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
      if($('#discount').val()=="")
      {
        discount="0";
      }
      else
      {
        discount=$('#discount').val();
        discount=parseFloat(discount);
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
      

      var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

      $('#net_total').val(net_total.toFixed(2));
      total_paid();



    });

    $(document).on('input', '#vat', function()
    {
      var discount;
      var vat;
      var total=$(this).data('total');
      if($('#discount').val()=="")
      {
        discount="0";
      }
      else
      {
        discount=$('#discount').val();
        discount=parseFloat(discount);
        
      }
      if($('#vat').val()=="")
      {
        vat="0";
      }
      else
      {
        vat=$('#vat').val();
        vat=parseFloat(vat);
      }
      
      
      // alert(discount);

      var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

      $('#net_total').val(net_total.toFixed(2));
      total_paid();


    });

    $(document).on('input', '#total_paid', function()
    {
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

  function update_qty(row_id,p_id)
  {

    var qty = $('#sell_cart_qty_'+p_id).val();
    var price = $('#sell_cart_price_'+p_id).val();
    var expire_date = $('#sell_cart_expire_'+p_id).val();

    // alert(price);

    $.ajax({
      url: "<?php echo site_url('admin/update_sell_cart');?>",
      type: "post",
      data: {row_id:row_id,qty:qty,p_id:p_id,price:price,expire_date:expire_date},
      success: function(data)
      {
        $('#sell_cart_details').html(data);

      }      
    });  

  }

</script>


<script type="text/javascript">

  function pass_radio_val_opd()
  {
    $('#opd_customer_list_div').show();
    $('#ipd_customer_list_div').hide();
    $('#customer_list_div').hide();
    $('#address_div').hide();
    $('#uhid_customer_list_div').hide();
    $("#opd_customer_name").prop('required',true);

    $("#patient_name").prop('required',false);
    $("#ipd_customer_name").prop('required',false);
    $("#customer_name").prop('required',false);
    $("#uhid_customer_name").prop('required',false);

    $("#patient_name").prop('readonly',true);
    $("#mobile_no").prop('readonly',true);

    $('#opd_customer_name').val("").trigger('change');

    $("#patient_name").val('');
    $("#mobile_no").val('');
  }

  function pass_radio_val_ipd()
  {
    $('#ipd_customer_list_div').show();
    $('#opd_customer_list_div').hide();
    $('#customer_list_div').hide();
    $('#address_div').hide();
    $('#uhid_customer_list_div').hide();
    $("#ipd_customer_name").prop('required',true);


    $("#patient_name").prop('required',false);
    $("#opd_customer_name").prop('required',false);
    $("#customer_name").prop('required',false);
    $("#uhid_customer_name").prop('required',false);

    $("#patient_name").prop('readonly',true);
    $("#mobile_no").prop('readonly',true);

    $('#ipd_customer_name').val("").trigger('change');

    $("#patient_name").val('');
    $("#mobile_no").val('');
  }

  function pass_radio_val_phar_cust()
  {
    $('#customer_list_div').show();
    $('#opd_customer_list_div').hide();
    $('#ipd_customer_list_div').hide();
    $('#uhid_customer_list_div').hide();
    $('#address_div').hide();
    $("#customer_name").prop('required',true);


    $("#patient_name").prop('required',false);
    $("#opd_customer_name").prop('required',false);
    $("#ipd_customer_name").prop('required',false);
    $("#uhid_customer_name").prop('required',false);

    $("#patient_name").prop('readonly',true);
    $("#mobile_no").prop('readonly',true);

    $('#customer_name').val("").trigger('change');

    $("#patient_name").val('');
    $("#mobile_no").val('');

  }

  function pass_radio_val_phar_uhid()
  {
    $('#uhid_customer_list_div').show();
    $('customer_list_div').hide();
    $('#opd_customer_list_div').hide();
    $('#ipd_customer_list_div').hide();
    $('#address_div').hide();
    $("#uhid_customer_name").prop('required',true);


    $("#patient_name").prop('required',false);
    $("#opd_customer_name").prop('required',false);
    $("#ipd_customer_name").prop('required',false);
    $("#customer_name").prop('required',false);

    $("#patient_name").prop('readonly',true);
    $("#mobile_no").prop('readonly',true);

    $('#uhid_customer_name').val("").trigger('change');

    $("#patient_name").val('');
    $("#mobile_no").val('');

  }

  function pass_radio_val_new()
  {
    $('#customer_list_div').hide();
    $('#opd_customer_list_div').hide();
    $('#ipd_customer_list_div').hide();
    $('#uhid_customer_list_div').hide();
    $('#address_div').show();
    $('#patient_name').prop('required', 'required');

    
    $("#customer_name").prop('required',false);
    $("#ipd_customer_name").prop('required',false);
    $("#opd_customer_name").prop('required',false);
    $("#uhid_customer_name").prop('required',false);

    $("#patient_name").prop('readonly',false);
    $("#mobile_no").prop('readonly',false);

    $("#patient_name").val('');
    $("#mobile_no").val('');
  }

  function get_customer(argument) {

    var phar_cust_id=$("#customer_name").val();

    $.ajax({
      url: "<?php echo site_url('admin/get_all_phar_info_by_cust_id');?>",
      method:"POST",
      dataType:"JSON",
      data: {phar_cust_id:phar_cust_id},
      success: function(data)
      {
        $('#patient_name').val(data[0]['cust_name']);
        $('#mobile_no').val(data[0]['cust_phone']);

        $('#ref_dir_id').val(data[0]['ref_dir_id']+'#'+data[0]['ref_dir_name']).trigger('change');


      }      
    }); 

  }

  function get_customer_opd(argument) {

   var opd_id=$("#opd_customer_name").val();

   $.ajax({
    url: "<?php echo site_url('admin/get_all_opd_by_patient_id');?>",
    method:"POST",
    dataType:"JSON",
    data: {opd_patient_id:opd_id},
    success: function(data)
    { 
      $('#patient_name').val(data[0]['patient_name']);
      $('#mobile_no').val(data[0]['mobile_no']);

    }      
  }); 

 }

 function get_customer_ipd(argument) {

  var ipd_id=$("#ipd_customer_name").val();

  $.ajax({
    url: "<?php echo site_url('admin/get_all_ipd_info_by_ipd_id');?>",
    method:"POST",
    dataType:"JSON",
    data: {ipd_patient_id:ipd_id},
    success: function(data)
    {
      $('#patient_name').val(data[0]['patient_name']);
      $('#mobile_no').val(data[0]['mobile_no']);

    }      
  }); 

}

function get_customer_uhid(argument) {

  var uhid=$("#uhid_customer_name").val();

  $.ajax({
    url: "<?php echo site_url('admin/get_uhid_info_by_id');?>",
    method:"POST",
    dataType:"JSON",
    data: {uhid:uhid},
    success: function(data)
    {
      $('#patient_name').val(data[0]['patient_name']);
      $('#mobile_no').val(data[0]['mobile_no']);

    }      
  }); 

}
</script>

</body>
</html>