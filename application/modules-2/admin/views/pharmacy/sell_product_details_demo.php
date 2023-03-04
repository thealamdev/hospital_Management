           <!-- else { ?>


            <tr>
              <td colspan="6" align="right">
                <strong>Due:</strong>
              </td>
              <td align="right">
                <?=number_format($total_price+$total_charge[0]['charge']-$vat_ret-$discount_ret-$sell_details[0]['debit'],2);?>&nbsp;৳
              </td>
            </tr>

            <?php if($total_price+$vat_ret-$discount_ret-$sell_details[0]['debit']+$total_charge[0]['charge']-$total_ret_paid[0]['total_paid'] > 0) { ?>


              <tr><td colspan="6"align="right"><button name="due_btn" class="btn-xs btn-success" type="submit">Pay</button></td><td><input  style="text-align: right" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_payment_cust"></td></tr>

            <?php } } ?>   -->