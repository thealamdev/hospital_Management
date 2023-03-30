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
          <div class="row">


            <div class="col-md-8 offset-md-4" >
             <form action="admin/edit_purchase" method="post">

              <div class="row">

                <div class="col-md-4">
                  <label for="supplier_name" style="float: left;">Purchase Code:</label>
                  <select name="purchase_code" id="purchase_code" class="chosen-select custom-select select2 form-control" required> 
                   <option value=""></option>
                   <?php foreach ($all_purchase_code as $row) {

                    if($buy_id==$row['buy_id'])
                      { ?>
                        <option selected="" value="<?=$row['buy_id'];?>"><?=$row['buy_code'];?></option>
                      <?php } else { ?>

                        <option value="<?=$row['buy_id'];?>"><?=$row['buy_code'];?></option>
                      <?php }

                      ?>

                    <?php } ?>
                  </select> 
                </div>

                <div class="col-md-8">
                  <input class="btn btn-success col-md-3" type="submit" name="purchase_btn" value="Search">
                </div>

              </div>




            </form>
          </div>



          <?php if(count($buy_details) > 0){?>

            <div id="edit_purchase_div">
              <form  action="admin/edit_purchase_post" method="post">
                <br>

                <input type="hidden" value="<?=$buy_details
                [0]['buy_code']?>" name="buy_code" id="buy_code">

                 <input type="hidden" value="<?=$buy_details
                [0]['buy_id']?>" name="buy_id" id="buy_id">

                <div class="col-md-10 offset-md-1">
                  <div class="row">
                    <div class="col-md-4" id="supplier_div">
                      <label for="supplier_name">Supplier Name:</label>
                      <select required id="supplier_name" name="supp_id" class="chosen-select custom-select select2 form-control">  <option value=""></option>
                        <?php foreach ($supplier_list as $row) { 

                          if($row['id']==$buy_details[0]['supp_id']){ ?>
                           <option selected="" value="<?=$row['id'];?>"><?=$row['supp_name'];?></option>

                         <?php } else { ?>

                           <option value="<?=$row['id'];?>"><?=$row['supp_name'];?></option>
                           
                         <?php }

                         ?>
                        
                       <?php } ?>

                       <option value="new_supp">Add New Supplier</option>
                     </select> 
                   </div>  
                   <div class="col-md-4">
                    <label for="product_category">Purchase Date:</label>
                    <div class="input-group focused">
                      <input type="text"  name="purchase_date" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" value="<?=date("d-m-Y", strtotime($buy_details[0]['created_at']));?>" required>
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
                      <input required="" id="bill_no" name="bill_no"  type="text"  class="form-control" value="<?=$buy_details[0]['bill_no'];?>">
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
                    <table class="table table-striped table-bordered mytable_style table-hover sell_cart">
                      <thead>
                        <tr>
                          <th>S.L</th>
                          <th style="width:25%;">Product Name</th>
                          <th style="width:10%;">Unit</th>
                          <th style="width:15%;">Price</th>
                          <th style="width:10%;">Qty</th>
                          <th style="width:20%;">Price*Qty</th>
                          <th style="width:30%;">Expire Date</th>
                          <th style="width:5%;">Action</th>
                        </tr>
                      </thead>
                      <tbody class="mytable_style" id="dynamic_row">

                        <?php foreach ($buy_details as $key => $value) { ?>

                          <tr>
                            <td><?=$key+1?></td>
                            <td>
                              <select required onchange="get_product_data(<?=$key?>)" id="product_id_<?=$key?>" name="p_id[]" class="chosen-select custom-select select2 form-control product_list">
                                <option value=""></option>
                                <?php foreach ($product_list as $row) { 

                                  if($value['p_id']==$row['id'])
                                    { ?>

                                      <option selected="" value="<?=$row['id'];?>"><?=$row['p_name'];?></option>
                                    <?php } else { ?>

                                      <option  value="<?=$row['id'];?>"><?=$row['p_name'];?></option>

                                    <?php }

                                    ?>

                                  <?php } ?>
                                </select> 
                              </td>
                              <td id="product_unit_<?=$key?>" class="align-center"><?=$value['unit']?></td>
                              <td>
                                <div class="input-group icon_tag_input">
                                  <input name="buy_price[]" id="product_price_<?=$key?>" readonly value="<?=$value['p_buy_price']?>" class="form-control align-right" type="text">
                                  <span class="input-group-addon">৳</span>
                                </div>
                              </td>
                              <td><input oninput="qty_update_calculation(0)" name="buy_qty[]" id="product_qty_<?=$key?>" class="form-control sell_cart_input" type="number" value="<?=$value['buy_qty']?>"></td>
                              <td>
                                <div class="input-group icon_tag_input">
                                  <input id="product_price_qty_<?=$key?>" readonly value="<?=$value['buy_price']*$value['buy_qty']?>" class="form-control align-right subtotal" type="text" >
                                  <span class="input-group-addon">৳</span>
                                </div>
                              </td>

                              <td><div class="input-group focused">
                                <input type="text" name="expire_date" class="date-time-picker form-control" value="<?=$value['expire_date']?>" required="" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}">
                                <span class="input-group-append">
                                  <span class="input-group-text add-on white">
                                    <i class="icon-calendar"></i>
                                  </span>
                                </span>
                              </div></td>
                              <td>

                                <?php if($key < 1) {?>
                                  <a class="add_row btn btn-success btn-xs">
                                    <i class="fa fa-plus"></i>
                                  </a >
                                <?php } else {?>

                                  <a onclick="get_product_data(<?=$key?>)" class="rem_row btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>

                                <?php } ?>


                                </td>
                              </tr>


                            <?php } ?>

                          </tbody>


                          <tr>
                            <td colspan="5" align="right"><strong>Total:</strong></td>
                            <td style="width:130px;">
                              <div class="input-group icon_tag_input">
                                <input name="credit" id="total" readonly class="form-control align-right" type="text" value="<?=$buy_details[0]['credit']?>">
                                <span class="input-group-addon">৳</span>
                              </div>
                            </td>

                          </tr>

                          <tr>
                            <td colspan="5" align="right"><strong>Paid:</strong></td>
                            <td>
                              <div class="input-group icon_tag_input">
                                <input name="debit"  onchange="due_advance_calculation()" id="paid" class="form-control align-right" type="text" value="<?=$buy_details[0]['debit']?>">
                                <span class="input-group-addon">৳</span>
                              </div>
                            </td>

                          </tr>



                          <tr>
                            <td colspan="5" align="right"><strong id="remain_label"> Due/Advance:</strong></td>
                            <td>
                              <div class="input-group icon_tag_input">
                                <input id="remain_val" readonly class="form-control align-right" type="text" value="<?=$buy_details[0]['cost_total']-$buy_details[0]['debit']?>">
                                <span class="input-group-addon">৳</span>
                              </div>
                            </td>

                          </tr>


                          <tr>
                            <td colspan="5" align="right"><strong id="remain_label"> Unload Cost:</strong></td>
                            <td >
                              <div class="input-group icon_tag_input">
                                <input  id="unload_cost" name="unload_cost" class="form-control" type="text" value="<?=$buy_details[0]['unload_cost']?>">
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

            <?php } ?>

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



<!--   <script type="text/javascript">



    $(document).on('change','#purchase_code', function(event)
    { 


      var buy_id=$('#purchase_code').val();

      $.ajax({  
        url:"<?=site_url('admin/get_purchase_info_by_id')?>",  
        data: {buy_id:buy_id},
        method:"POST",  
        dataType:"html",  
        success:function(data)  
        { 
          $('#edit_purchase_div').html(data);

          $(".chosen-select").select2();
        }
      });

    });


  </script> -->

  <script>

    $(document).ready(function(){


      $(document).on('change','#supplier_name', function(event)
      {        
        if($(this).find(":selected").val()=='new_supp'){

          window.location="admin/add_supplier";


        }
      });

      var i=$('#dynamic_row tr').length+1;

      $(".add_row").click(function(){

        $(".chosen-select").select2("destroy");

        $("#dynamic_row").append('<tr><td>'+i+'</td><td><select id="product_id_'+i+'" onchange="get_product_data('+i+')" name="p_id[]" class="chosen-select custom-select select2 form-control"><option value=""></option><?php foreach ($product_list as $row) { $name=$row["p_name"];?><option value="<?=$row["id"];?>"><?=str_replace("'","\'",$name)?></option><?php } ?></select> </td><td id="product_unit_'+i+'" class="align-center"></td><td><div class="input-group icon_tag_input"><input name="buy_price[]" id="product_price_'+i+'" readonly value="0.00" class="form-control align-right" type="text" ><span class="input-group-addon">৳</span></div></td><td><input oninput="qty_update_calculation('+i+')" id="product_qty_'+i+'" class="form-control sell_cart_input" name="buy_qty[]" type="number" value="0"></td><td><div class="input-group icon_tag_input"><input id="product_price_qty_'+i+'" readonly value="0.00" class="form-control align-right subtotal" type="text" ><span class="input-group-addon">৳</span></div></td> <td><div class="input-group focused"><input type="text" name="expire_date" class="date-time-picker form-control" id="date_pick_'+i+'" required="" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}"><span class="input-group-append"><span class="input-group-text add-on white"><i class="icon-calendar"></i></span></span></div></td><td><button onclick="get_product_data('+i+')" class="rem_row btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></button></td></tr>');

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



    $('#edit_purchase_div').on('change','#product_id_0',function(){




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