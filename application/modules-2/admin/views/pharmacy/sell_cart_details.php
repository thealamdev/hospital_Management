<div id="" class="col-md-12">

  <?php if($flag=="No Stock"){?>
   <div class="alert alert-block alert-danger">
    <i class="ace-icon fa fa-info-circle bigger-120"></i>
    &nbsp;Stock not available
  </div>
<?php } ?>

  <?php if($flag=="Not possible"){?>
   <div class="alert alert-block alert-danger">
    <i class="ace-icon fa fa-info-circle bigger-120"></i>
    &nbsp; Same Product But  Different Expire Date Not allowed 
  </div>
<?php } ?>


<?php if(count($cart= $this->cart->contents())>0){ ?>
  <table class="table table-striped table-bordered table-hover test_cart" id="sell_cart_table">
    <thead>
      <tr>
        <th>SL</th>
        <th style="width:30%">Test</th>
        <!-- <th style="width:10%">Batch</th> -->
        <th style="width:10%">Expire</th>
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
          <!-- <td><?=$item['options']['batch_id'];?></td> -->
          <td><?=date('d-m-Y', strtotime($item['options']['expire_date']));?></td>

                              <!-- <td style="display: none"><input type="hidden" value="<?= $item['id']?>" name=""></td>
                                <td style="display: none"><input type="hidden" value="<?= $item['options']['sub_test_id']?>" name=""></td> -->

                                <input type="hidden" name="p_id[]" value="<?=$item['id'];?>">

                                <input type="hidden" id="s_qty_<?=$item['id'];?>" name="" value="<?=$item['qty'];?>">



                                <input type="hidden" name="sell_price[]" value="<?=$item['price'];?>">

                                <input type="hidden" name="sell_qty[]" value="<?=$item['qty'];?>">

                                <input type="hidden" id="sell_cart_expire_<?=$item['id'];?>" name="expire_date[]" value="<?=$item['options']['expire_date'];?>">

                             

                                <td><input  type="text" style="padding:0" class="form-control col-md-10" id="sell_cart_price_<?=$item['id'];?>" value="<?=number_format($item['price'],0,'.', '');?>" onchange="update_qty('<?=$item['rowid'];?>','<?=$item['id'];?>')"><span style="padding:0">৳</span></td>

                                <td><input style="padding:0" type="number" class="form-control" id="sell_cart_qty_<?=$item['id'];?>" value="<?=$item['qty'];?>" onchange="update_qty('<?=$item['rowid'];?>','<?=$item['id'];?>')"></td>

                                <td><span style="padding:0"class="form-control col-md-10"><?=number_format($item['subtotal'],0);?></span><span style="padding:0">৳</span></td> 

                                <td align="middle"><i id="<?=$item["rowid"]?>"  class="fa fa-trash-o remove_product text-danger" aria-hidden="true"></i></td>

                              </tr>

                              <?php $i++;} ?>
                              <tr>
                                <td colspan="5"align="right">Total</td>
                                <td><input readonly style="padding:0" type="text"   value="<?=number_format($this->cart->total(),0,'.', '');?>" id="total_amount" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td colspan="5" align="right">Discount</td>
                                <td><input style="padding:0" type="text" data-total="<?=$this->cart->total();?>" value="<?=number_format(0,0);?>" name="discount" id="discount" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td colspan="5" align="right">VAT</td>
                                <td><input  style="padding:0" type="text" data-total="<?=$this->cart->total();?>" id="vat" name="vat" value="<?=number_format(0,0);?>" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td colspan="5" align="right">Net Total</td>
                                <td><input name="net_total" readonly style="padding:0" type="text" id="net_total" value="<?=number_format($this->cart->total(),0,'.', '');?>" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td colspan="5" align="right">Total Paid</td>
                                <td><input style="padding:0" value="<?=number_format(0,0);?>" type="text" id="total_paid" name="total_paid" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td colspan="5" align="right">Due</td>
                                <td><input readonly style="padding:0" type="text" value="<?=number_format($this->cart->total(),0,'.', '');?>" name="due" id="due" class="form-control col-md-10"/><span style="padding:0">৳</span></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>

                          <div align="right">
                            <button type="submit" id="save_button" class="btn btn-success">Save</button>
                          </div>
                        <?php } else {?>
                          <div class="row">
                            <div class="alert alert-block alert-info">
                              <i class="ace-icon fa fa-info-circle bigger-120"></i>
                              &nbsp;No Test added in 'Test Order List'
                            </div>

                          </div>
                        <?php } ?>
                      </div>
