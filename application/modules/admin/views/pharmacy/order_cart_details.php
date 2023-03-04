<div id="" class="col-md-12">

  <?php if(count($cart= $this->cart->contents())>0){ ?>
    <table class="table table-striped table-bordered table-hover test_cart" id="sell_cart_table">
      <thead>
        <tr>
          <th>SL</th>
          <th style="width:30%">Product</th>
          <th style="width:30%">Company</th>
          <th style="width:20%">Unit</th>
          <th style="width:25%">Qty</th>
          <th><i class="fa fa-trash-o" aria-hidden="true"></i></th>
        </tr>
      </thead>
      <tbody class="mytable_style" id="cart_content_table">
        <?php $cart= $this->cart->contents(); ?>
        <?php $i=1;$total=0;foreach ($cart as $item){ ?>
          <tr>
            <td><?=$i;?></td>
            <td align="center"><?=$item['name']?></td>



            <input type="hidden" name="p_id[]" value="<?=$item['id'];?>">

  

            <input type="hidden" name="sell_qty[]" value="<?=$item['qty'];?>">

            <td><?=$item['options']["comp_name"]?></td>
            <td><?=$item['options']["unit"]?></td>

            <td><input style="padding:0" type="number" class="form-control" id="order_cart_qty_<?=$item['id'];?>" value="<?=$item['qty'];?>" onchange="update_qty('<?=$item['rowid'];?>','<?=$item['id'];?>')"></td>

            <td align="middle"><i id="<?=$item["rowid"]?>"  class="fa fa-trash-o remove_product text-danger" aria-hidden="true"></i></td>

          </tr>

          <?php $i++;} ?>

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
