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
                        <th>Product Name</th>
                        <th>Unit</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                     <tbody>
                        <?php 
                        $i=1;
                         foreach ($product_list as $row) { ?> 
                          <tr>
                            <input type="hidden" name="" id="p_c_stock<?=$row['id']?>" value="<?=$row['p_current_stock']?>">

                            <td><?=$i?></td>
                            <td><?=$row['p_code'];?></td>
                            <td>
                              <a href="#" target="_blank" class="hide-option" title="Click to see the Product details"><?=$row['p_name'];?></a>
                            </td>
                            
                          <!--   <td class="hidden-480"><?=$row['sub_cat_name'];?></td> -->
                          <td><?=$row['unit'];?></td>

                            <td><?=number_format($row['p_sell_price'],2);?> ৳</td>

                            <td class="hidden-480">
                              <div class="badge <?php if($row['p_current_stock']>$row['p_reorder_qty']){ echo "badge-success";}else{echo "badge-danger";}?>">
                                <?=$row['p_current_stock'];?>&nbsp;
                                <i class="ace-icon fa <?php if($row['p_current_stock']>$row['p_reorder_qty']){ echo "fa-arrow-up";}else{echo "fa-arrow-down";}?>"></i>
                              </div>
                            </td>
                            <td>
                              <button  class="btn btn-xs btn-primary add_to_bill"  data-product_id="<?=$row['id']?>"  data-p_current_stock="<?=$row['p_current_stock']?>" data-product="<?=$row['p_name']?>" data-price="<?=$row['p_sell_price']?>"
                                >
                                <i class="ace-icon fa fa-plus"></i>
                                Add to Bill
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
        <form action="admin/update_sell_data" method="post">
        <div class="card my-3 no-b">
            <div class="card-body">
        <div class="row" style="padding:15px;">
          
          <div class="col-md-12 mb-4" id="customer_list_div">
            <label for="customer_name">Bill No:</label>
                  <select id="bill_no"  name="bill_no" class="chosen-select custom-select select2 form-control" required>
                    <option value=""></option>
                    <?php foreach ($sell_info as $row) { ?>
                      <option value="<?=$row['sell_id'];?>"><?=$row['sell_code'];?></option>
                    <?php } ?>

                    
                  </select> 
          </div>
                
          <input type="hidden" name="sell_id" id="sell_id">

          <div class="col-md-12 mb-3">
              <input type="text" id="customer_name" name="customer_name" placeholder="Customer Name" required class="form-control">
          </div>
       
            <!-- <div class="col-md-6 ">
              <input type="text" id="bill_no" name="bill_no" placeholder="Bill No" required class="form-control">
            </div> -->
            <div class="col-md-6 align-right">
              <input type="text" name="export_no" id="chalan_no" placeholder="Chalan No" class="form-control">
            </div>

            <input type="hidden" value="" id="delete_p_id_list" name="delete_p_id_list">

        
            </div>
        </div>
      </div>
      <div class="card my-3 no-b">
            <div class="card-body" >
              <div class="" id="zero_stock_div">
                <div class="alert alert-block alert-danger">
                  <i class="ace-icon fa fa-info-circle bigger-120"></i>
                  &nbsp;Stock not available
                </div>
              </div>

              <div id="sell_cart_details">
                <?php $this->load->view('pharmacy/invoice_cart_details'); ?>

              </div>
              <div align="right">
                  <button type="submit" id="save_button" class="btn btn-success">Update</button>
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

      // $(document).on('change','.se_qty', function(event)
      // {
      //     alert("hi");

      // });



      $("#zero_stock_div").hide();
   
    //   $(document).on('click','#add_customer_name_button', function(event)
    // {

    //    window.location="admin/add_customer";
    // });
   
     $(document).on('change','#bill_no', function(event)
    {        
          

           if($(this).find(":selected").val()=='new_cust'){
                  // alert($(this).find(":selected").val());
                   window.location="admin/add_customer";


              }
            else
            {
              var bill_no=$(this).find(":selected").text();

            $.ajax({
            url:"<?=site_url("admin/get_info_by_invoice")?>",
            method:"POST",
            dataType:"html",
            data:{bill_no:bill_no},
            success:function(data)
            {
              $('#sell_cart_details').html(data);

              $.ajax({
            url:"<?=site_url("admin/get_cust_info_by_bill")?>",
            method:"POST",
            dataType:"json",
            data:{bill_no:bill_no},
            success:function(val)
            {
                $("#customer_name").val(val[0]['cust_name']);
                $("#chalan_no").val(val[0]['export_no']);
                $("#sell_id").val(val[0]['sell_id']);

            }
             });
            },
            error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
           });
              
            }
    });
      
      var click=0;

      $(document).on('click', '.add_to_bill', function()
      {
        $("#zero_stock_div").hide();
        var p_name=$(this).data('product');
        var p_price=$(this).data('price');
        var p_id=$(this).data('product_id');
        var p_current_stock=$(this).data('p_current_stock');
        var quantity="1";

        
        
        var prev_qty=$('#s_qty_'+p_id).val();
        var current_stock=$('#p_c_stock'+p_id).val();
        var qty = $('#sell_cart_qty_'+p_id).val();
          // var row_id=$(this).data('row_id');

        

        // alert(prev_qty);
        // alert(current_stock);
        // alert(qty);

        //  && (parseInt(prev_qty)-click+parseInt(current_stock)) >= parseInt(qty)
        

        if(p_current_stock>0)
        {

          $.ajax({
            url:"<?=site_url("admin/add_invoice_cart")?>",
            method:"POST",
            dataType:"html",
            data:{p_id:p_id,p_name:p_name,p_price:p_price,quantity:quantity},
            success:function(data)
            {
              //console.log(data);
              $('#sell_cart_details').html(data);
              // click=parseInt(click)+1;
              

          },
              error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
             });
          }

        else
        {
          $("#zero_stock_div").show();
          $('#sell_cart_qty_'+p_id).val("");
          click=0;
          qty=0;

        }
        
        
      });

   

    $(document).on('click', '.remove_product', function()
      {
        
        var row_id = $(this).attr("row_id");

        var p_id = $(this).attr("p_id");

        var delete_val=$("#delete_p_id_list").val();

        // alert(delete_val);
        delete_val=delete_val+'_'+p_id;
        
         // alert(delete_val);

        alertify.confirm('<b>Delete Confirmation</b>',"Are you sure you want to remove this?",
        function(){
          //alertify.success('Ok');
          $("#delete_p_id_list").val(delete_val);



          $.ajax({
              url:"<?=site_url()?>admin/edit_remove_sell_cart",
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
      
      
      // alert(delivary_cost);

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

    function update_qty(row_id,id)
    {
        // alert(id1);
        // alert(row_id);

        var prev_qty=$('#s_qty_'+id).val();
        var current_stock=$('#p_c_stock'+id).val();
        var qty = $('#sell_cart_qty_'+id).val();

        // alert(prev_qty);
        // alert(current_stock);
        // alert(qty);

        if(parseInt(prev_qty)+parseInt(current_stock) >= parseInt(qty))
        {
           $.ajax({
            url: "<?php echo site_url('admin/update_invoice_cart');?>",
            type: "post",
            data: {row_id:row_id,qty:qty},
            success: function(data)
            {
              $('#sell_cart_details').html(data);
              $('#s_qty_'+id).val(prev_qty);

            }      
        });  
        }
        else
        {
           $('#sell_cart_qty_'+id).val("");
            $("#zero_stock_div").show();
        }

        // alert(prev_qty);
        // alert(current_stock);


        



        // var price = $('#price_'+row_id).val();

      
    }

</script>

</body>
</html>