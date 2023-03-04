<div id="" class="col-md-12">

  <?php if(isset($main_test)){?>
    <input type="hidden" name="main_test" id="main_test" value="<?=(int)$main_test?>">
  <?php } ?>


  <?php if(count($cart= $this->cart->contents())>0){ ?>
    <table class="table table-striped table-bordered table-hover test_cart" id="test_cart_table">
      <thead>
        <th>SL</th> 
        <th style="width:15%"> Test</th>
        <th style="width:25%">Price</th>
        <th style="width:15%">Vat</th>
        <th style="">Disount</th>
        <th style="width:15%">Net Amount</th>
        <th style="width:15%">C/O</th>
        <th style="width:15%">Sub. C/O </th>

        <!-- <th style="width:25%">Price*Qty</th> -->
        <th><i class="fa fa-trash-o" aria-hidden="true"></i></th>
      </thead>
      <tbody class="mytable_style" id="cart_content_table">
        <?php $cart= $this->cart->contents(); ?>

        <?php $i=1;$total=0;foreach ($cart as $item){ ?>
          <tr>
            <td><?=$i;?></td>
            <td align="center"><?=$item['name']?></td>

            <td><input readonly type="text" style="text-align: right; padding:0;" class="form-control col-md-10" id="test_cart_price_<?=$item['rowid'];?>" value="<?=number_format($item['price'],2,'.', '');?>"><span style="padding:0">৳</span></td>

            <td align="right"><?php if($item['options']['type']==1){echo round($item['options']['vat']/$main_test,2);} else {echo 0.00;}?></td>

            <td align="right"><?php if($item['options']['type']==1){echo round($item['options']['discount']/$main_test,2);} else {echo 0.00;}?></td>

            <td align="right"><?=number_format($item['options']['net_amount'],2);?></td>

            <td align="right"><?=number_format($item['options']['quk_ref_com'],2);?></td>

            <td align="right"><?=number_format($item['options']['sub_com'],2);?></td>

            <td align="middle"><i t_id="<?=$item["id"]?>" row_id="<?=$item["rowid"]?>"   class="fa fa-trash-o remove_test text-danger" aria-hidden="true"></i></td>

            <td style="display: none"><?= $item['id']?></td>
            <td style="display: none"><?= $item['rowid']?></td>
            <td style="display: none"><?= $item['options']['type']?></td>

          </tr>

          <?php $i++;} ?>

          <tr>
           <td></td>
         </tr>
         <tr>
           <td></td>
         </tr>
         <tr>
           <td></td>
         </tr>





         <tr>
          <td colspan="2" align="right">Total</td>
          <td><input autocomplete="off" readonly style="color:white;background-color:blue;padding:0;text-align: right;" type="text"  value="<?=number_format($this->cart->total(),2,'.', '');?>" id="total_amount" name="total" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
          <td></td>
          <td><input readonly style="padding:0" type="text" id="total_c_o" name="total_c_o" class="form-control col-md-12"/></td>

          <td><input readonly style="padding:0" type="text" id="sub_c_o" name="sub_c_o" class="form-control col-md-12"/></td> 

          <td></td>

        </tr>



        <tr>
          <td colspan="2" align="right">Discount(%)</td>
          <td><input autocomplete="off" style="padding:0;text-align: right;" type="text" data-total="<?=$this->cart->total();?>"  id="discount_percent"  class="form-control col-md-10"/><span style="padding:0">%</span></td>

          <td colspan="2" align="right">Discount(৳)</td>
          <td><input autocomplete="off" style="padding:0" type="text" data-total="<?=$this->cart->total();?>" name="discount" value="<?=$item['options']["discount"];?>" id="discount" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
        </tr>





        <tr>
          <td colspan="2" align="right">VAT(%)</td>
          <td><input autocomplete="off"  style="padding:0;text-align: right;" type="text" data-total="<?=$this->cart->total();?>" id="vat_percent"  class="form-control col-md-10"/><span style="padding:0">%</span></td>

          <td colspan="2" align="right">VAT(৳)</td>
          <td><input autocomplete="off" style="padding:0" type="text" name="vat" data-total="<?=$this->cart->total();?>" id="vat" value="<?=$item['options']["vat"];?>" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
        </tr>


        <tr>
          <td colspan="2" align="right">Net Total</td>
          <td><input autocomplete="off" readonly style="color:white;background-color:green;padding:0;text-align: right;" name="net_total" type="text" id="net_total" value="<?=number_format($this->cart->total(),2,'.', '');?>" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" align="right">Total Paid</td>
          <td><input autocomplete="off" style="padding:0;text-align: right;" value="<?=number_format($item['options']['paid_amount'],2,'.', '');?>" name="total_paid"  type="text" id="total_paid" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" align="right">Due</td>
          <td><input autocomplete="off" readonly style="color:white;background-color:red; padding:0;text-align: right;" type="text" value="<?=number_format($this->cart->total(),2,'.', '');?>" id="due" name="due" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  <?php } else {?>
    <div class="row">
      <div class="alert alert-block alert-info ml-2">
        <i class="ace-icon fa fa-info-circle bigger-120"></i>
        &nbsp;No Test added in 'Test Order List'
      </div>

    </div>
  <?php } ?>
</div>