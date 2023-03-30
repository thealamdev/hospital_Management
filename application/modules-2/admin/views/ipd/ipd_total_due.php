<form action="admin/insert_ipd_patient_order_info/<?=$order_id?>/<?=$patient_info[0]['id']?>" method="POST" >
                                  
                                  <tr><td colspan="4"align="right">Total</td><td  align="right"> <input style="text-align: right" class="form-control" readonly type="text" name="total" value="<?=number_format($total,2,'.','')?>"></td></tr>


                                    <tr><td colspan="4"align="right">VAT</td><td align="right"><input style="text-align: right" data-total="<?=$order_info[0]['total_amount']?>" id ="vat" name="vat" value="<?=number_format($order_info[0]['vat'],2,'.','')?>" class="form-control col-md-10" type="text">%</td></tr>

                                  <tr><td colspan="4"align="right">Total Discount</td><td align="right"><input data-total="<?=$order_info[0]['total_amount']?>"  style="text-align: right" id ="discount" name="discount" value="<?=number_format($order_info[0]['total_discount'],2,'.','')?>" class="form-control col-md-10" type="text">%</td></tr>

                                  <tr><td colspan="4"align="right">Net Total</td><td align="right"><input readonly style="text-align: right" id="net_total" name="net_total" value="<?=number_format($total+($total*$order_info[0]['vat']/100)-(($total*$order_info[0]['total_discount']/100)+$order_info[0]['total_paid']),2,'.','')?>" class="form-control" type="text"></td></tr>

                                  <tr><td colspan="4"align="right">Due</td><td align="right"><input style="text-align: right" readonly id="due" name="due" value="<?=number_format($total+($total*$order_info[0]['vat']/100)-(($total*$order_info[0]['total_discount']/100)+$order_info[0]['total_paid']),2,'.','')?>" class="form-control" type="text"></td></tr>

      
                                  <tr><td colspan="4"align="right"> Already Paid</td><td align="right"><input readonly style="text-align: right" id="already_paid" name="already_paid" value="<?=number_format($order_info[0]['total_paid'],2,'.','')?>" class="form-control" type="text"></td></tr>
                              <?php if($order_info[0]['payment_status']!="paid"){

                                    ?>                             
                                    <tr><td colspan="4"align="right"><button class="btn-xs btn-success" type="submit">Pay</button></td><td><input style="text-align: right" id="total_paid" name="total_paid" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_payment"></td></tr>

                                    <?php } ?>
                                  </form>