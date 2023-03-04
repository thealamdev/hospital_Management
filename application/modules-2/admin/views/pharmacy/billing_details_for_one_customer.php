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
        <div align="right" class="mt-3">

        </div>
        <div class="card  no-b">
          <div class="card-body">



            <?php if($sell_details != null){ ?>

              <div class="row">


               <div class="col-md-4">
                <div class="form-horizontal">
                  <label >Customer Name:</label>
                  <label id="patient_name"><?=$sell_details[0]['cust_name']?></label>
                </div>

                <div class="form-horizontal">
                  <label >Customer Id:</label>
                  <label id="patient_name"><?=$sell_details[0]['cust_gen_id']?></label>
                </div>

                <div class="form-horizontal">
                  <label for="phone_no">Mobile No:</label>
                  <label id="phone_no"><?=$sell_details[0]['cust_phone']?></label>
                </div>
              </div>


              <div class="col-md-8">
                <div class="form-horizontal">
                  <label for="booked_by"><b>Customer Type:</b></label>
                  <label id="booked_by">
                    <?php if($sell_details[0]['type']==1)
                    {

                      echo "Opd";

                    } else if ($sell_details[0]['type']==2){

                      echo "Ipd";

                    } 
                    else 
                    {
                      echo "Others";
                    }
                  ?></label>
                </div>

                <?php if ($sell_details[0]['type']==2){ ?>

                  <div class="form-horizontal">
                    <label for="printed_by">Ipd Id:</label>
                    <label id="printed_by"><?=$ipd_info[0]['patient_info_id']?></label>
                  </div>

                  <div class="form-horizontal">
                    <label for="printed_by">Cabin No:</label>
                    <label id="printed_by"><?=$ipd_info[0]['room_title']?></label>
                  </div>

                <?php } ?>

                <?php if ($sell_details[0]['type']==1){ ?>


                  <div class="form-horizontal">
                    <label for="printed_by">Opd Id:</label>
                    <label id="printed_by"><?=$opd_info[0]['patient_info_id']?></label>
                  </div>


                <?php } ?>

                <div class="form-horizontal">
                  <label for="printed_by">Date:</label>
                  <label id="printed_by"><?=$sell_details[0]['created_at']?></label>
                </div>
              </div>

            </div>

          <?php } ?>


          <div class="row mt-3" >
           <div class="col-md-4">
            <table class="table table-striped table-bordered table-hover">
              <tr>
                <td>Net Total:</td>
                <td><?=$sell_info_sum[0]['net_total']?></td>
              </tr>

              <tr>
                <td>Total Paid:</td>
                <td><?=$sell_info_sum[0]['debit']?></td>
              </tr>

              <tr>
                <td>Total Due:</td>
                <td><?=$sell_info_sum[0]['net_total']-$sell_info_sum[0]['debit']?></td>
              </tr>
            </table>
          </div>

          <div class="col-md-8">
            <?php 
            foreach ($sell_info as $key => $value) { ?>

              <div id="accordion">
                <div class="card">
                  <div class="card-header">

                   <a class="card-link" data-toggle="collapse" href="#collapseOne<?=$value['sell_id']?>">
                    <?=$value['sell_code']?>
                  </a>


                  <a style="float: right;" href="admin/sell_product_details_pdf/<?=$value['sell_id']?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i>Print</a>
                </div>
                <div id="collapseOne<?=$value['sell_id']?>" class="collapse show" data-parent="#accordion">

                  <!-- is_return =1 -- no return -->

                  <?php if($value['is_return'] == 1){ ?>

                    <div class="card-body">
                     <form action="admin/update_cust_payment/<?=$value['sell_id']?>/<?=$value['cust_id']?>/bill_info" method="POST">
                      <table class="table table-striped table-bordered table-hover sell_cart test_table_report">
                        <thead>
                          <tr>
                            <th>S.L</th>
                            <th >Product Name</th>
                            <!-- <th >Batch</th> -->
                            <th >Expire</th>
                            <th >Qty</th>
                            <th >Price</th>
                            <th >Price*Qty</th>
                            <th >Date</th>
                          </tr>
                        </thead>
                        <tbody class="mytable_style" >

                          <tr>
                            <?php foreach ($sell_details as $key => $row) { 

                              if($value['sell_id']==$row['sell_id']){

                                ?>

                                <td align="center"><?=$key+1;?></td>
                                <td align="center"><?=$row['p_name'];?></td>
                                <!-- <td align="center"><?=$row['batch_id'];?></td> -->
                                <td align="center"><?=$row['expire_date'];?></td>
                                <td align="center"><?=$row['sell_qty'];?>&nbsp;<?=$row['unit'];?>
                              </td>
                              <td align="right"><?=number_format($row['sell_price'],2);?>&nbsp;৳ 
                              </td>
                              <td align="right"><?=number_format(($row['sell_price']*$row['sell_qty']),2);?>&nbsp;৳ 
                              </td> 
                              <td align="right"><?=date('d-m-Y h:i a', strtotime($row['c_date']))?>
                            </td> 
                          </tr>
                        <?php } } ?>

                        <tr>
                          <td colspan="5" align="right">
                            <strong>Total:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($value['credit'],2);?>&nbsp;৳
                          </td>
                        </tr>

                        <input type="hidden" value="<?=$row['net_total']-$row['debit'];?>" name="due">

                        <tr>
                          <td colspan="5" align="right">
                            <strong>Discount:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($value['discount'],2);?>&nbsp;৳
                          </td>

                        </tr>

                        <tr>
                          <td colspan="5" align="right">
                            <strong>VAT:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($value['vat'],2);?>&nbsp;৳
                          </td>

                        </tr>

                        <tr>
                          <td colspan="5" align="right">
                            <strong>Net Total:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($value['net_total'],2);?>&nbsp;৳
                          </td>

                        </tr>

                        <tr>
                          <td colspan="5" align="right">
                            <strong>Paid:</strong>
                          </td>
                          <td align="right">
                            <?=number_format($value['debit'],2);?>&nbsp;৳
                          </td>

                        </tr>

                        <tr>
                          <td colspan="5" align="right">
                            <?php $ad= $value['debit']-$value['net_total'];?>
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

                        <?php if($value['debit'] < $value['net_total'] && $value['is_return'] == 1) { ?>


                          <tr><td colspan="5"align="right"><button class="btn-xs btn-success" type="submit">Pay</button></td><td><input  style="text-align: right" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_payment_cust"></td></tr>

                        <?php } ?>   


                      </tbody>                    
                    </table>
                  </form>
                </div>

              <?php } else { ?>


                <div class="card-body">
                  <form action="admin/update_return_info/<?=$value['sell_code']?>/bill_info" method="POST">

                    <br><h3 style="text-align: center;">After Sales Return</h3><br>

                    <table class="table table-striped table-bordered table-hover sell_cart test_table_report">
                      <thead>
                        <tr>
                          <th>S.L</th>
                          <th >Product Name</th>

                          <th >Expire</th>
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

                       foreach ($return_info as $key => $row) {

                        if($value['sell_code']==$row['buy_sell_code']){

                          $total_price=$total_price+($row['sell_qty']-$row['total_qty'])*$row['sell_price'];
                          $total_ret_qty+=$row['total_qty'];
                          $total_sell_qty+=$row['sell_qty'];


                          ?>


                          <tr>
                            <td align="center"><?=$key+1;?></td>

                            <input type="hidden" value="<?=$row['p_id']?>" name="p_id[]">

                            <input type="hidden" value="<?=$row['sell_id']?>" name="sell_id">

                            <input type="hidden" value="<?=$row['sell_price']?>" name="sell_price[]">

                            <td align="center"><?=$row['p_name'];?></td>
                            <!-- <td align="center"><?=$row['batch_id'];?></td> -->
                            <td align="center"><?=$row['expire_date'];?></td>
                            <td align="center"><?=$row['sell_qty']?>&nbsp;<?=$row['unit'];?>
                          </td>

                          <td align="center"><?=$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
                        </td>

                        <td align="center"><?=$row['sell_qty']-$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
                      </td>



                      <td align="right"><?=number_format($row['sell_price'],2);?>&nbsp;৳ 
                      </td>
                      <td align="right"><?=number_format(($row['sell_price']*($row['sell_qty']-$return_info[$key]['total_qty'])),2);?>&nbsp;৳ 
                      </td> 

                    </tr>

                  <?php } }

                  $discount_per=$sell_details[0]['discount']/$total_sell_qty;
                  $discount_ret=($total_sell_qty-$total_ret_qty)*$discount_per;

                  $vat_per=$sell_details[0]['vat']/$total_sell_qty;
                  $vat_ret=($total_sell_qty-$total_ret_qty)*$vat_per;

                  ?>

                  <tr>
                    <td colspan="7" align="right">
                      <strong>Total:</strong>
                    </td>
                    <td align="right">
                      <?=number_format($total_price,2);?>&nbsp;৳
                    </td>
                  </tr>

                  <tr>
                    <td colspan="7" align="right">
                      <strong>Discount:</strong>
                    </td>
                    <td align="right">
                     <input readonly="" style="text-align: right" class="form-control col-md-10" type="text" value="<?=number_format($discount_ret,2);?>" name="discount">&nbsp;৳
                   </td>
                 </tr>

                 <tr>
                  <td colspan="7" align="right">
                    <strong>Vat:</strong>
                  </td>
                  <td align="right">
                   <input readonly="" style="text-align: right" class="form-control col-md-10" type="text" value="<?=number_format($vat_ret,2);?>" name="discount">&nbsp;৳
                 </td>
               </td>
             </tr>

             <tr>
              <td colspan="7" align="right">
                <strong>Total Cancellation Charge:</strong>
              </td>
              <td align="right">
                <?=number_format($total_charge[0]['charge'],2);?>&nbsp;৳
              </td>
            </tr>

            <tr>
              <td colspan="7" align="right">
                <strong>Net Total:</strong>
              </td>
              <td align="right">
                <?=number_format($total_price+$vat_ret-$discount_ret-$total_charge[0]['charge'],2);?>&nbsp;৳
              </td>
            </tr>

            <tr>
              <td colspan="7" align="right">
                <strong>Total Paid (Old):</strong>
              </td>
              <td align="right">
                <?=number_format($sell_details[0]['debit'],2);?>&nbsp;৳
              </td>
            </tr>


            <tr><td colspan="7"align="right"><a class="btn-xs btn-success" href="admin/sell_product_details/<?=$value['sell_id']?>" style="text-align: right">Adjust Refund</a></td></tr>


          </tbody>                    
        </table>
      </form>
    </div>


  <?php } ?>


</div>
</div>
</div>
<?php } 
?>

</div>
<div class="col-md-3"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>
</body>
</html>