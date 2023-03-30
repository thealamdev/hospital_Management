<div id="" class="col-md-12">
                        <?php if(count($cart= $this->cart->contents())>0){ ?>
                          <table class="table table-striped table-bordered table-hover test_cart id="sell_cart_table">
                          <thead>
                            <tr>
                            <th>SL</th>
                            <th style="width:30%">Test</th>
                            <th style="width:30%">Price</th>
                            <th style="width:15%">Qty</th>
                            <th style="width:35%">Price*Qty</th>
                            <th><i class="fa fa-trash-o" aria-hidden="true"></i></th>
                            </tr>
                          </thead>
                          <tbody class="mytable_style" id="cart_content_table">
                            <?php $cart= $this->cart->contents(); ?>
                           <?php $i=1;$total=0;foreach ($cart as $item){ ?>
                            <tr>
                              <td><?=$i;?></td>
                              <td align="center"><?=$item['name']?></td>
                              
                              <!-- <td style="display: none"><input type="hidden" value="<?= $item['id']?>" name=""></td>
                              <td style="display: none"><input type="hidden" value="<?= $item['options']['sub_test_id']?>" name=""></td> -->

                              
                              <input type="hidden" id="p_id_cart<?=$item['id'];?>" class="p_id_cart" name="p_id[]" value="<?=$item['id'];?>">

                              <input type="hidden"  value="<?=$item['price'];?>">

                               <input type="hidden"  id="s_qty_<?=$item['id'];?>" class="s_qty" value="<?=$item['qty'];?>">

                              <td><input readonly type="text" name="sell_price[]" style="padding:0" class="form-control col-md-10"  id="sell_cart_price_<?=$item['id'];?>" value="<?=number_format($item['price'],2,'.', '');?>"><span style="padding:0">৳</span></td>

                          <td><input style="padding:0" type="number" class="form-control"  name="sell_qty[]" id="sell_cart_qty_<?=$item['id'];?>" value="<?=$item['qty'];?>" onchange="update_qty('<?=$item['rowid'];?>','<?=$item['id'];?>')"></td>

                          <td><span style="padding:0"class="form-control col-md-10"><?=number_format($item['subtotal'],2,'.', '');?></span><span style="padding:0">৳</span></td> 

                              <td align="middle"><i p_id="<?=$item["id"]?>" row_id="<?=$item["rowid"]?>"  class="fa fa-trash-o remove_product text-danger" aria-hidden="true"></i></td>
                             
                            </tr>

                          <?php $i++;} ?>
                           <tr>
                                <td colspan="4"align="right">Total</td>
                                 <td><input readonly style="padding:0" type="text"   value="<?=number_format($this->cart->total(),2,'.', '');?>" id="total_amount" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                                 <td></td>
                           </tr>
                          <tr>
                          <td colspan="4" align="right">Discount</td>
                          <td><input style="padding:0" type="text" data-total="<?=$this->cart->total();?>" value="<?=number_format(0,2);?>" name="discount" id="discount" class="form-control col-md-10"/><span style="padding:0">%</span></td>
                          <td></td>
                         </tr>
                         <tr>
                          <td colspan="4" align="right">VAT</td>
                          <td><input  style="padding:0" type="text" data-total="<?=$this->cart->total();?>" id="vat" name="vat" value="<?=number_format(0,2);?>" class="form-control col-md-10"/><span style="padding:0">%</span></td>
                          <td></td>
                         </tr>
                         <tr>
                          <td colspan="4" align="right">Net Total</td>
                          <td><input readonly style="padding:0" type="text" id="net_total" value="<?=number_format($this->cart->total(),2,'.', '');?>" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                          <td></td>
                         </tr>
                         <tr>
                          <td colspan="4" align="right">Total Paid</td>
                          <td><input style="padding:0" value="<?=number_format(0,2);?>" type="text" id="total_paid" name="total_paid" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                          <td></td>
                         </tr>
                         <tr>
                          <td colspan="4" align="right">Due</td>
                          <td><input readonly style="padding:0" type="text" value="<?=number_format($this->cart->total(),2,'.', '');?>" name="due" id="due" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                          <td></td>
                         </tr>
                    </tbody>
                </table>
      <?php } else {?>
      <div class="row">
      <div class="alert alert-block alert-info">
        <i class="ace-icon fa fa-info-circle bigger-120"></i>
        &nbsp;No Test added in 'Test Order List'
      </div>

    </div>
  <?php } ?>
</div>
