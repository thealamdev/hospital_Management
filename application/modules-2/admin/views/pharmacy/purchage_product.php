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
    <form id="myForm">
      <div class="modal fade" id="add_supplier_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Supplier</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="supplier_phone">Supplier Phone</label>
                <input type="text" name="supplier_phone" id="supplier_phone" required class="form-control ">
              </div>

              <div class="md-form mb-2">
                <i class="fa fa-h-square" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="supplier_name">Supplier Name</label>

                <input type="text" id="supplier_name" name="supplier_name" required class="form-control ">


              </div>
              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="supplier_address">Supplier Address</label>
                <input type="text" id="supplier_address" name="supplier_address" required class="form-control ">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-outline-primary btn-sm"  id="add_supplier_name_button">Add<i class="fa fa-plus ml-1"></i></button>
              <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>

    <div class="section-wrapper">

      <div class="card my-3 no-b">
        <div class="card-body">
          <!-- <div class="card-title">Simple usage</div> -->
          <div class="row">
            <form  action="admin/insert_purchage_product" method="post">

              <div class="col-md-10 offset-md-1">
                <div class="row">
                  <div class="col-md-4" id="supplier_div">
                    <label for="supplier_name">Supplier Name:</label>
                    <select required id="supplier_name" name="supp_id" class="chosen-select custom-select select2 form-control">  <option value=""></option>
                      <?php foreach ($supplier_list as $row) { ?>
                        <option value="<?=$row['id'];?>"><?=$row['supp_name'];?></option>
                      <?php } ?>

                      <option value="new_supp">Add New Supplier</option>
                    </select> 
                  </div>  
                  <div class="col-md-4">
                    <label for="product_category">Purchase Date:</label>
                    <div class="input-group focused">
                      <input type="text" readonly="" name="purchase_date" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" value="<?=date('d-m-Y');?>" required>
                      <span class="input-group-append">
                        <span class="input-group-text add-on white">
                          <i class="icon-calendar"></i>
                        </span>
                      </span>
                    </div>
                  </div>


                  <div class="col-md-4">
                    <label for="product_category">Bill No:</label>
                    <div class="input-group focused">
                      <input required="" id="bill_no" name="bill_no"  type="text"  class="form-control">
                      <span class="input-group-append">
                        <span class="input-group-text add-on white">
                          <i class="ace-icon fa fa-paper-plane"></i>
                        </span>
                      </span>
                    </div>
                    
                  </div>
                </div>


                <div class="space-6"></div>
                <div class="row mt-3">
                  <div class="col-md-12">
                    <table style="max-width: ;" class="table table-striped table-bordered mytable_style table-hover sell_cart">
                      <thead>
                        <tr>
                          <th>S.L</th>
                          <th style="width:20%;">Product Name</th>
                        
                          <th style="width:5%;">Unit</th>
                          <th style="width:15%;">Price</th>
                          <th style="width:10%;">Qty</th>
                          <th style="width:15%;">Price*Qty</th>
                          <th style="width:30%;">Expire Date</th>
                          <th style="width:5%;">Action</th>
                        </tr>
                      </thead>
                      <tbody class="mytable_style" id="dynamic_row">

                        <tr>
                          <td>1</td>
                          <td>
                            <select required onchange="get_product_data(0)" id="product_id_0" name="p_id[]" class="chosen-select custom-select select2 form-control">
                              <option value=""></option>
                              <?php foreach ($product_list as $row) { ?>
                                <option value="<?=$row['id'];?>"><?=$row['p_name'];?></option>
                              <?php } ?>
                            </select> 
                          </td>
                     
                          

                          <td id="product_unit_0" class="align-center"></td>
                          <td>
                            <div class="input-group icon_tag_input">
                              <input name="buy_price[]" id="product_price_0" readonly value="0.00" class="form-control align-right" type="text">
                              <!-- <span class="input-group-addon">৳</span> -->
                            </div>
                          </td>
                          <td><input oninput="qty_update_calculation(0)" name="buy_qty[]" id="product_qty_0" class="form-control sell_cart_input" type="number" value="0"></td>
                          <td>
                            <div class="input-group icon_tag_input">
                              <input id="product_price_qty_0" readonly value="0.00" class="form-control align-right subtotal" type="text" >
                              <!-- <span class="input-group-addon">৳</span> -->
                            </div>
                          </td>

                          <td><div class="input-group focused">
                            <input type="text" name="expire_date[]" class="date-time-picker form-control" required="" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}">
                   
                          </div></td>
                          <td>

                            <a class="add_row btn btn-success btn-xs">
                              <i class="fa fa-plus"></i>
                            </a >

                            
                          </td>
                        </tr>
                      </tbody>
                      <tr>
                        <td colspan="6" align="right"><strong>Total:</strong></td>
                        <td style="width:130px;">
                          <div class="input-group icon_tag_input">
                            <input name="credit" id="total" readonly value="<?=number_format(0,2);?>" class="form-control align-right" type="text">
                            <span class="input-group-addon">৳</span>
                          </div>
                        </td>

                      </tr>

                      <tr>
                        <td colspan="6" align="right"><strong>Paid:</strong></td>
                        <td>
                          <div class="input-group icon_tag_input">
                            <input name="debit" value="0.00" onchange="due_advance_calculation()" id="paid" class="form-control align-right" type="text">
                            <span class="input-group-addon">৳</span>
                          </div>
                        </td>

                      </tr>



                      <tr>
                        <td colspan="6" align="right"><strong id="remain_label"> Due/Advance:</strong></td>
                        <td>
                          <div class="input-group icon_tag_input">
                            <input id="remain_val" readonly class="form-control align-right" type="text">
                            <span class="input-group-addon">৳</span>
                          </div>
                        </td>

                      </tr>


                      <tr>
                        <td colspan="6" align="right"><strong id="remain_label"> Unload Cost:</strong></td>
                        <td >
                          <div class="input-group icon_tag_input">
                            <input value="0.00" id="unload_cost" name="unload_cost" class="form-control" type="text">
                            <span class="input-group-addon">৳</span>
                          </div>
                        </td>

                      </tr>
                    </table>
                  </div>
                  
                </div>

                <div class="row" id="validation_err_msg">


                </div>

                <div class="col-md-12" align="center">

                  <div class="col-md-offset-4 col-md-4" >
                    <button class="btn btn-white btn-primary btn-bold">
                      <i class="ace-icon glyphicon glyphicon-list"></i>
                      Purchase Products
                    </button>
                  </div>
                </div>
              </div>

            </form>

          </div>
        </div>
      </div> 
      <div class="control-sidebar-bg shadow white fixed"></div>
    </div>
    <style type="text/css">
      .mytable_style tr td{
        padding: 2px !important;
        color:#000 !important;

        vertical-align: middle !important;
      }
      .mytable_style tr td input{
        color:#000 !important;
      }
      .sell_cart thead th{
        text-align: center !important;
        background: #EFF3F8;
        color: #0f0808;
        font-weight: 600;
      }
      .sell_cart_input{
        padding: 5px 0px !important;
        margin: 0 auto !important;
        height: auto !important;
        width: 100% !important;
        text-align: center !important;
      }
      .icon_tag_input{
        width: 100% !important;
        float: right;
      }
      .input-group-addon {
        padding: 6px 6px !important;
      }

    </style>
    <?php $this->load->view('back/footer_link');?>


    <!-- Select with search bar and datepicker End-->

    <!-- Modal Open for new Customer-->
<!--     <script type="text/javascript">

     $.ajax({  
      url:"<?=site_url('admin/get_last_pharmacy_bill_no')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        if(data == '')
        {
          $('#bill_no').val(1001);
        }
        else{
          $('#bill_no').val(parseInt(data[0]['bill_no'])+1);
        }

      }
    });
  </script> -->

  <script>

    $(document).ready(function(){


      $(document).on('change','#supplier_name', function(event)
      {        
        if($(this).find(":selected").val()=='new_supp'){
                  //alert($(this).find(":selected").val());
                  // $('#add_supplier_modal').modal({
                  //     show: true
                  // });

                  window.location="admin/add_supplier";


                }
              });

      var i=2;

      $(".add_row").click(function(){

        $(".chosen-select").select2("destroy");

        $("#dynamic_row").append('<tr><td>'+i+'</td><td><select id="product_id_'+i+'" onchange="get_product_data('+i+')" name="p_id[]" class="chosen-select custom-select select2 form-control"><option value=""></option><?php foreach ($product_list as $row) { $name=$row["p_name"];?><option value="<?=$row["id"];?>"><?=str_replace("'","\'",$name)?></option><?php } ?></select> </td><td id="product_unit_'+i+'" class="align-center"></td><td><div class="input-group icon_tag_input"><input name="buy_price[]" id="product_price_'+i+'" readonly value="0.00" class="form-control align-right" type="text" ><span class="input-group-addon">৳</span></div></td><td><input oninput="qty_update_calculation('+i+')" id="product_qty_'+i+'" class="form-control sell_cart_input" name="buy_qty[]" type="number" value="0"></td><td><div class="input-group icon_tag_input"><input id="product_price_qty_'+i+'" readonly value="0.00" class="form-control align-right subtotal" type="text" ><span class="input-group-addon">৳</span></div></td> <td><div class="input-group focused"><input type="text" name="expire_date[]" class="date-time-picker form-control" id="date_pick_'+i+'" required="" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}"></div></td><td><button onclick="get_product_data('+i+')" class="rem_row btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></button></td></tr>');

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

      $(document).on('input', '#unload_cost', function()
      {
        var due=0;
        var due=parseFloat($("#total").val())+parseFloat($("#unload_cost").val())-parseFloat($("#paid").val());

        $("#remain_val").val(due.toFixed(2));

      });

      $(document).on('input', '#paid', function()
      {
        var bill=$("#total").val();
        bill=parseFloat(bill);
        var paid=$("#paid").val();
        paid=parseFloat(paid);
        var remain=0;

        remain=(bill+parseFloat($("#unload_cost").val()))-paid;
    if(remain>0) //due
    {
      $("#remain_label").html('<span style="color:red">Due:</span>');
      $("#remain_val").val(remain.toFixed(2));
    }
    else if(remain<0) //advance
    {
      $("#remain_label").html('<span style="color:green">Advance: </span>');
      $("#remain_val").val((remain*(-1)).toFixed(2));

    }
    else{
      $("#remain_label").html('<span>Due/Advance: </span>');
      $("#remain_val").val(remain.toFixed(2));
    }


  });

    });




    function get_product_data(id)
    {
      var p_id=$("#product_id_"+id).val();

      $.ajax({
        type: 'POST',
        url: "<?=base_url();?>admin/get_product_details_ajax",
        data: {p_id: p_id},
        dataType: 'json',
        success: function (data) 
        {
              //alert(data[0].p_name);
              $("#product_unit_"+id).html(data[0].unit.replace("'","\'"));
              var price=parseFloat(data[0].p_buy_price);
              price=price.toFixed(2);
              $("#product_price_"+id).val(price);
              $("#product_qty_"+id).val(1);
              var subtotal=price*1;
              $("#product_price_qty_"+id).val(subtotal.toFixed(2));

              var sum = 0;
          // iterate through each td based on class and add the values
          $(".subtotal").each(function() {

            var value = $(this).val();
              // alert(value);
              // add only if the value is number
              if(!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
              }
            });
          $("#total").val(sum.toFixed(2));

        }   
      });

      setTimeout(function(){
       due_advance_calculation();
     }, 500);


    }

    function qty_update_calculation(id) {
      var qty=$("#product_qty_"+id).val();
      var price=$("#product_price_"+id).val();
      qty=parseFloat(qty);
      price=parseFloat(price);

      var subtotal=price*qty;

      $("#product_price_qty_"+id).val(subtotal.toFixed(2));

      var sum = 0;
          // iterate through each td based on class and add the values
          $(".subtotal").each(function() {

            var value = $(this).val();
              // add only if the value is number
              if(!isNaN(value) && value.length != 0) {
                sum += parseFloat(value);
              }
            });
          $("#total").val(sum.toFixed(2));



          setTimeout(function(){
           due_advance_calculation();
         }, 500);


        }

        function due_advance_calculation() {
          var bill=$("#total").val();
          bill=parseFloat(bill);
          var paid=$("#paid").val();
          paid=parseFloat(paid);
          var remain=0;

          remain=(bill+parseFloat($("#unload_cost").val()))-paid;
    if(remain>0) //due
    {
      $("#remain_label").html('<span style="color:red">Due:</span>');
      $("#remain_val").val(remain.toFixed(2));
    }
    else if(remain<0) //advance
    {
      $("#remain_label").html('<span style="color:green">Advance: </span>');
      $("#remain_val").val((remain*(-1)).toFixed(2));

    }
    else{
      $("#remain_label").html('<span>Due/Advance: </span>');
      $("#remain_val").val(remain.toFixed(2));
    }
  }





</script>

</body>
</html>