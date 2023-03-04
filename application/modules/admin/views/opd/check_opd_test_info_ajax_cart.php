<div id="" class="col-md-12"> 
  <?php if(count($cart= $this->cart->contents())>0){ ?>
    <table class="table table-striped table-bordered table-hover test_cart test_table_report" id="test_cart_table">
      <thead>
        <th>SL</th>
        <th>Test</th>
        <th>Price</th>
      </thead>
      <tbody class="mytable_style" id="cart_content_table">
        <?php $cart= $this->cart->contents(); ?>
        <?php $i=1;$total=0;foreach ($cart as $item){ ?>
          <tr>
            <td><?=$i;?></td>
            <td align="center"><?=$item['name']?></td>


            <td><input readonly type="text" style="text-align: right; padding:0;" class="form-control col-md-10" id="test_cart_price_<?=$item['rowid'];?>" value="<?=number_format($item['price'],2,'.', '');?>"><span style="padding:0">৳</span></td>

            <td align="middle"><i id="<?=$item["rowid"]?>"  class="fa fa-trash-o remove_test text-danger" aria-hidden="true"></i></td>

          </tr>

          <?php $i++;} ?>




         <tr>
          <td colspan="2" align="right">Total</td>
          <td><input readonly style="color:white;background-color:blue;padding:0;text-align: right;" type="text"  value="<?=number_format($this->cart->total(),2,'.', '');?>" id="total_amount" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
        </tr>



        <tr>
          <td colspan="2" align="right">Discount(%)</td>
          <td><input autocomplete="off" style="padding:0;text-align: right;" type="text" data-total="<?=$this->cart->total();?>"  id="discount_percent"  class="form-control col-md-10"/><span style="padding:0">%</span></td>

          <td colspan="2" autocomplete="off" align="right">Discount(৳)</td>
          <td><input style="padding:0;text-align: right;" type="text" data-total="<?=$this->cart->total();?>"  id="discount" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
        </tr>





        <tr>
          <td colspan="2" align="right">VAT(%)</td>
          <td><input autocomplete="off"  style="padding:0;text-align: right;" type="text" data-total="<?=$this->cart->total();?>" id="vat_percent"  class="form-control col-md-10"/><span style="padding:0">%</span></td>
          <td colspan="2"  align="right">VAT(৳)</td>
          <td><input autocomplete="off" style="padding:0;text-align: right;" type="text" data-total="<?=$this->cart->total();?>" id="vat"  class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
        </tr>


        <tr>
          <td colspan="2" align="right">Net Total</td>
          <td><input autocomplete="off" readonly style="color:white;background-color:green;padding:0;text-align: right;" type="text" id="net_total" value="<?=number_format($this->cart->total(),2,'.', '');?>" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" align="right">Total Paid</td>
          <td><input autocomplete="off" style="padding:0;text-align: right;"  type="text" id="total_paid" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2" align="right">Due</td>
          <td><input autocomplete="off" readonly style="color:white;background-color:red;padding:0;text-align: right;" type="text" value="<?=number_format($this->cart->total(),2,'.', '');?>" id="due" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
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

<?php if(count($this->cart->contents()) > 0){ ?>
  <div align="right">
    <button type="button" id="save_button" class="btn btn-success">Save</button>
  </div>

  <?php } ?> 