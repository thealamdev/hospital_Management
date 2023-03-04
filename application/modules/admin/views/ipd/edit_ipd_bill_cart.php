<div id="" class="col-md-12">
  <?php if(count($cart= $this->cart->contents())>0){ ?>
    <table class="table table-striped table-bordered table-hover test_cart" id="sell_cart_table">
      <thead>
        <tr>
          <th>SL</th>
          <th style="width:20%">Service</th>
          <th style="width:20%">Op. By</th>
          <th style="width:30%">Price</th>
          <th style="width:15%">Qty</th>
          <th style="width:20%">Price*Qty</th>
          <th><i class="fa fa-trash-o" aria-hidden="true"></i></th>
        </tr>
      </thead>
      <tbody class="mytable_style" id="cart_content_table">
        <?php $cart= $this->cart->contents(); ?>
        <?php $i=1;$total=0;foreach ($cart as $item){ ?>
          <tr>
            <td><?=$i;?></td>
            <td align="center"><?=$item['name']?></td>
            <td align="center"><?=$item['options']['s_doctor_name']?></td>

                              <!-- <td style="display: none"><input type="hidden" value="<?= $item['id']?>" name=""></td>
                                <td style="display: none"><input type="hidden" value="<?= $item['options']['sub_test_id']?>" name=""></td> -->

                                <input type="hidden" name="p_id[]" value="<?=$item['id'];?>">

                                <input type="hidden" name="doctor_id[]" value="<?=$item['options']['s_doctor_id'];?>">

                                <input type="hidden" id="s_qty_<?=$item['id'];?>" name="" value="<?=$item['qty'];?>">



                                <input type="hidden" name="sell_price[]" value="<?=$item['price'];?>">

                                <input type="hidden" name="sell_qty[]" value="<?=$item['qty'];?>">

                                <td><input  type="text" style="padding:0" class="form-control col-md-10" id="sell_cart_price_<?=$item['id'];?>" value="<?=number_format($item['price'],2,'.', '');?>" onchange="update_qty('<?=$item['rowid'];?>','<?=$item['id'];?>')"></td>

                                <td><input style="padding:0" type="number" class="form-control" id="sell_cart_qty_<?=$item['id'];?>" value="<?=$item['qty'];?>" onchange="update_qty('<?=$item['rowid'];?>','<?=$item['id'];?>')"></td>

                                <td><span style="padding:0"class="form-control col-md-10"><?=number_format($item['subtotal'],2,'.', '');?></span></td> 



                                <td align="middle"><i id="<?=$item["rowid"]?>"  class="fa fa-trash-o remove_product text-danger" aria-hidden="true"></i></td>

                              </tr>

                              <?php $i++;} ?>
                              <tr>
                                <td colspan="5"align="right">Total</td>
                                <td><input readonly style="padding:0" type="text"   value="<?=number_format($this->cart->total(),2,'.', '');?>" id="total_amount" class="form-control col-md-10"/></td>
                                <td></td>
                              </tr>


                            </tbody>
                          </table>

                      
                        <?php } else {?>
                          <div class="row">
                            <div class="alert alert-block alert-info">
                              <i class="ace-icon fa fa-info-circle bigger-120"></i>
                              &nbsp;No Service added in 'Service Order List'
                            </div>

                          </div>
                        <?php } ?>
                      </div>
