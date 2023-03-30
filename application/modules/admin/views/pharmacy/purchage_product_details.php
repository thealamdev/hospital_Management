<?php $this->load->view('back/header_link'); ?>
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
    <div align="right" class="mt-3 mr-3">
      <a href="javascript:void(0)" target="" onclick="window.open('<?=base_url();?>admin/purchage_product_details_pdf/'+<?=$buy_details[0]['buy_id']?>,'','width=560,height=340,toolbar=0,menubar=0,location=0')" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a>
    </div>  
    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>

    <div class="section-wrapper">
      <div class="card no-b">
        <div class="card-body">

          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="row">
                <div class="col-md-6">
                  <h2 style="margin-top:0px;" class="">Purchase-Code: <?=$buy_details[0]['buy_code'];?></h2>
                </div>
                <div class="col-md-6">
                  <h2 style="margin-top:0px;" class="">Bill-No: <?=$buy_details[0]['bill_no'];?></h2>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label><strong>Supplier Name:</strong></label> &nbsp;<?=$buy_details[0]['supp_name'];?>
                </div>  
              </div>

              <div class="row">
                <div class="col-md-6">
                  <label><strong>Purchase Date:</strong></label> &nbsp;
                  <?php $only_date_array=explode(' ', $buy_details[0]['created_at']);
                  $only_date=$only_date_array[0];
                  echo date('d M Y', strtotime($only_date));
                    // echo " ".date('h:i:a', strtotime($only_date_array[1]));
                  ?>                    
                </div>  
                
              </div>
              <div class="space-6"></div>
              <div class="row mt-4">
                <div class="col-md-10 offset-md-2">

                 <form action="admin/update_supp_payment/<?=$buy_details[0]['buy_id']?>/<?=$buy_details[0]['supp_id']?>" id="my_form" method="POST">

                  <table class="table table-striped table-bordered table-hover sell_cart">
                    <thead>
                      <tr>
                        <th>S.L</th>
                        <th >Product Name</th>
                        <th >Qty</th>
                        <th >Price</th>
                        <th >Price*Qty</th>
                        <th >Expire Date</th>
                      </tr>
                    </thead>
                    <tbody class="mytable_style" >

                      <tr>
                        <?php foreach ($buy_details as $key => $row) { ?>

                          <td align="center"><?=$key+1;?></td>
                          <td align="center"><?=$row['p_name'];?></td>
                          <td align="center"><?=$row['buy_qty'];?>&nbsp;<?=$row['unit'];?>
                        </td>
                        <td align="right"><?=number_format($row['buy_price'],2);?>&nbsp;৳ 
                        </td>
                        <td align="right"><?=number_format(($row['buy_price']*$row['buy_qty']),2);?>&nbsp;৳ 
                        </td> 
                        <td align="center"><?=date("d-m-Y", strtotime($row['expire_date']));?></td>
                      </tr>
                    <?php } ?>
                    
                    <tr>
                      <td colspan="4" align="right">
                        <strong>Total:</strong>
                      </td>
                      <td align="right">
                        <?=number_format($row['credit'],2);?>&nbsp;৳
                      </td>
                    </tr>

                    <tr>
                      <td colspan="4" align="right">
                        <strong>Unload Cost:</strong>
                      </td>
                      <td align="right">
                        <?=number_format($row['unload_cost'],2);?>&nbsp;৳
                      </td>

                    </tr>

                    <tr>
                      <td colspan="4" align="right">
                        <strong>Net Total:</strong>
                      </td>
                      <td align="right">
                        <?=number_format($row['cost_total'],2);?>&nbsp;৳
                      </td>

                    </tr>
                    
                    <tr>
                      <td colspan="4" align="right">
                        <strong>Paid:</strong>
                      </td>
                      <td align="right">
                        <?=number_format($row['debit'],2);?>&nbsp;৳
                      </td>

                    </tr>

                    <input type="hidden" value="<?=$row['cost_total']-$row['debit'];?>" name="due" id="due">
                    
                    <tr>
                      <td colspan="4" align="right">
                        <?php $ad= $row['debit']-$row['cost_total'];?>
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

                    
                    <?php if($row['debit'] < $row['cost_total']) {?>


                      <tr><td colspan="4"align="right"><button class="btn-xs btn-success" type="submit">Pay</button></td><td><input  style="text-align: right" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_payment_supp" id="update_payment_supp"></td></tr>
                      
                    <?php } ?>        
                  </tbody>                    
                </table>
              </form>

              <?php if($return_info != null) { ?>

                <form action="admin/update_return_info_purchase/<?=$buy_details[0]['buy_code']?>" id="my_form1" method="POST">

                  <br><h3 style="text-align: center;">After Purchase Return</h3><br>

                  <table class="table table-striped table-bordered table-hover sell_cart">
                    <thead>
                      <tr>
                        <th>S.L</th>
                        <th >Product Name</th>
                        <th >Qty</th>
                        <th>Returned Qty </th>
                        <th>Current Qty </th>
                        <th >Price</th>
                        <th >Price*Qty</th>

                      </tr>

                    </thead>
                    <tbody class="mytable_style" >


                     <?php 

                     $total_price=0;
                     $total_ret_qty=0;
                     $total_sell_qty=0;
                     $discount_ret=0;
                     $discount_per=0;

                     foreach ($buy_details as $key => $row) {

                      $total_price=$total_price+($row['buy_qty']-$return_info[$key]['total_qty'])*$row['buy_price'];
                      $total_ret_qty+=$return_info[$key]['total_qty'];
                      $total_sell_qty+=$row['buy_qty'];


                      ?>


                      <tr>
                        <td align="center"><?=$key+1;?></td>

                        <input type="hidden" value="<?=$row['p_id']?>" name="p_id[]">

                        <input type="hidden" value="<?=$row['buy_id']?>" name="sell_id">

                        <input type="hidden" value="<?=$row['buy_price']?>" name="sell_price[]">

                        <td align="center"><?=$row['p_name'];?></td>
                        <td align="center"><?=$row['buy_qty']?>&nbsp;<?=$row['unit'];?>
                      </td>

                      <td align="center"><?=$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
                    </td>
                    
                    <td align="center"><?=$row['buy_qty']-$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
                  </td>



                  <td align="right"><?=number_format($row['buy_price'],2);?>&nbsp;৳ 
                  </td>
                  <td align="right"><?=number_format(($row['buy_price']*($row['buy_qty']-$return_info[$key]['total_qty'])),2);?>&nbsp;৳ 
                  </td> 

                </tr>

              <?php } 
              ?>

              <tr>
                <td colspan="6" align="right">
                  <strong>Total:</strong>
                </td>
                <td align="right">
                  <?=number_format($total_price,2);?>&nbsp;৳
                </td>
              </tr>


              <tr>
                <td colspan="6" align="right">
                  <strong>Total Cancellation Charge:</strong>
                </td>
                <td align="right">
                  <?=number_format($total_charge[0]['charge'],2);?>&nbsp;৳
                </td>
              </tr>

              <tr>
                <td colspan="6" align="right">
                  <strong>Net Total:</strong>
                </td>
                <td align="right">
                  <?=number_format($total_price+$total_charge[0]['charge'],2);?>&nbsp;৳
                </td>
              </tr>

              <tr>
                <td colspan="6" align="right">
                  <strong>Total Paid (Old):</strong>
                </td>
                <td align="right">
                  <?=number_format($buy_details[0]['debit']+$total_ret_paid[0]['total_paid'],2);?>&nbsp;৳
                </td>
              </tr>


              <?php if($total_price+$total_charge[0]['charge'] < $buy_details[0]['debit'])
              { ?>


                <tr>
                  <td colspan="6" align="right">
                    <strong>Refundable:</strong>
                  </td>
                  <td align="right">
                    <?=number_format($buy_details[0]['debit']-($total_price+$total_charge[0]['charge']),2);?>&nbsp;৳
                  </td>
                  
                </tr>

                <tr>
                  <td colspan="6" align="right">
                    <strong>Total Refunded:</strong>
                  </td>
                  <td align="right">
                    <?=number_format($total_ret_paid[0]['total_paid'],2);?>&nbsp;৳
                  </td>
                </tr>

                <tr>
                  <td colspan="6" align="right">
                    <strong>Due:</strong>
                  </td>
                  <td align="right">
                    <?=number_format($buy_details[0]['debit']-($total_price+$total_charge[0]['charge'])-$total_ret_paid[0]['total_paid'],2);?>&nbsp;৳
                  </td>

                  <input type="hidden" name="refund_due" value="<?=number_format($buy_details[0]['debit']-($total_price+$total_charge[0]['charge'])-$total_ret_paid[0]['total_paid'],2);?>" id="refund_due">
                </tr>

                <?php if($buy_details[0]['debit']-($total_price+$total_charge[0]['charge']) > $total_ret_paid[0]['total_paid']) { ?>


                  <tr><td colspan="6"align="right"><button  name="refund_btn" class="btn-xs btn-success" type="submit">Pay</button></td><td><input  style="text-align: right" value="" class="form-control" type="text" name="update_return" id="update_return"></td></tr>


                <?php } } else { ?>

                  <tr>
                    <td colspan="6" align="right">
                      <strong>Due:</strong>
                    </td>
                    <td align="right">
                      <?=number_format(($total_price+$total_charge[0]['charge']-$total_ret_paid[0]['total_paid'])-$buy_details[0]['debit'],2);?>&nbsp;৳
                    </td>
                  </tr>

                  <?php if($total_price+$total_charge[0]['charge']-$total_ret_paid[0]['total_paid'] > $buy_details[0]['debit']) { ?>


                    <tr><td colspan="6"align="right"><button  name="refund_btn" class="btn-xs btn-success" type="submit">Pay</button></td><td><input  style="text-align: right" value="" class="form-control" type="text" name="update_return" id="update_return"></td></tr>


                  <?php }  } ?>

                </tbody>                    
              </table>
            </form>
          <?php }  ?>
        </div>


      </div>
    </div>
  </div><!-- /.row --> 
</div>
</div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>

<script type="text/javascript">

  $('#my_form1').submit(function () {

    var update_return = parseFloat($("#update_return").val());
    var refund_due = parseFloat($("#refund_due").val());

    if( update_return >  refund_due)
    {
      alertify.alert("<b>Total Paid Cant Be Greater Than Net Total</b>");

      return false;
    }

  });

    $('#my_form').submit(function () {

    var update_payment_supp = parseFloat($("#update_payment_supp").val());
    var due = parseFloat($("#due").val());

    if(update_payment_supp > due)
    {
      alertify.alert("<b>Total Paid Cant Be Greater Than Net Total</b>");

      return false;
    }

  });
</script>