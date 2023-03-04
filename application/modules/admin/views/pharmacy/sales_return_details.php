<form method="POST" action="admin/insert_ret_sale_data">
  <table class="table table-striped table-bordered table-hover  sell_cart">
    <thead>
      <tr>
        <th>S.L</th>
        <th>Product Name</th>
        <th>Qty</th>
        <th>Returnable Qty </th>
        <th>Returned Qty </th>
        <th >Price</th>
        <th >Price*Qty</th>
        <th style="width:40%">Update Qty</th>
      </tr>

    </thead>
    <tbody class="mytable_style" >


      <?php 
      if($return_info == null){

        foreach ($sell_details as $key => $row) { 

          ?>
          <tr>
            <td align="center"><?=$key+1;?></td>

            <input type="hidden" value="<?=$row['p_id']?>" name="p_id[]">

            <input type="hidden" value="<?=$row['sell_id']?>" name="sell_id">

            <input type="hidden" value="<?=$row['sell_price']?>" name="sell_price[]">

            <input type="hidden" value="0" name="prev_ret_qty[]">

            <input type="hidden" name="expire_date[]" value="<?=$row['expire_date']?>">

            <td align="center"><?=$row['p_name'];?></td>
            <td align="center"><?=$row['sell_qty'];?>&nbsp;<?=$row['unit'];?>

            <td align="center"><?=$row['sell_qty'];?>&nbsp;<?=$row['unit'];?>
          </td>

          <td align="right"><?=number_format((0),2);?>&nbsp;৳ 
          </td> 

          <td align="right"><?=number_format($row['sell_price'],2);?>&nbsp;৳ 
          </td>

          <td align="right"><?=number_format(($row['sell_price']*$row['sell_qty']),2);?>&nbsp;৳ 
          </td> 

          <td align="left">
            <input type="number" required="" class="col-md-6  form-control" max="<?=$row['sell_qty']?>" min="0" value="0" name="up_qty[]" id="up_qty">
          </td>
        </tr>
      <?php } } else {
       foreach ($sell_details as $key => $row) {
        ?>


        <tr>
          <td align="center"><?=$key+1;?></td> 

          <input type="hidden" value="<?=$row['p_id']?>" name="p_id[]">

          <input type="hidden" value="<?=$row['sell_id']?>" name="sell_id">

          <input type="hidden" value="<?=$row['sell_price']?>" name="sell_price[]">

          <input type="hidden" name="ret_id" value="<?=$return_info[0]['id']?>">

          <input type="hidden" name="expire_date[]" value="<?=$row['expire_date']?>">

          <td align="center"><?=$row['p_name'];?></td>
          <td align="center"><?=$row['sell_qty']?>&nbsp;<?=$row['unit'];?>
        </td>
        <td align="center"><?=$row['sell_qty']-$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
      </td>

      <td align="center"><?=$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
    </td>

    <td align="right"><?=number_format($row['sell_price'],2);?>&nbsp;৳ 
    </td>
    <td align="right"><?=number_format($row['sell_price']*($return_info[$key]['total_qty']),2);?>&nbsp;৳ 
    </td> 

    <td align="left">
      <input type="number" class="col-md-6  form-control" max="<?=$row['sell_qty']-$return_info[$key]['total_qty']?>" required="" min="0" value="0" name="up_qty[]" id="up_qty">
    </td>
  </tr>

<?php } } ?>

<tr>
  <td colspan="7" align="right">

  </td>
  <td align="left">
    <input type="text" class="form-control col-md-12" name="charge" placeholder="Cancellation Charge">
  </td>
</tr>

<tr>
  <td colspan="7" align="right">

  </td>
  <td align="right">
    <button type="submit" class="offset-md-1 col-md-4 btn btn-success">Update</button>
  </td>
</tr>

<!-- <tr>
  <td colspan="6" align="right">
    <strong>Total:</strong>
  </td>
  <td align="right">
    <?=number_format($row['sell_price']*($return_info[$key]['total_qty']),2);?>&nbsp;৳
  </td>
</tr>

<?php if($return_info !=null ) { ?>
  <tr>
    <td colspan="6" align="right">
      <strong>Total Cancellation Charge:</strong>
    </td>
    <td align="right">
      <?=number_format($total_charge[0]['charge'],2);?>&nbsp;৳
    </td>
  </tr>

<?php } else { ?>

  <tr>
    <td colspan="6" align="right">
      <strong>Total Cancellation Charge:</strong>
    </td>
    <td align="right">
      <?=number_format(0,2);?>&nbsp;৳
    </td>
  </tr>

<?php } ?>

<tr>
  <td colspan="6" align="right">
    <strong>Vat:</strong>
  </td>
  <td align="right">
    <?=number_format($row['vat'],2);?>&nbsp;৳
  </td>

</tr>

<tr>
  <td colspan="6" align="right">
    <strong>Discount:</strong>
  </td>
  <td align="right">
    <?=number_format($row['discount'],2);?>&nbsp;৳
  </td>

</tr>

<tr>
  <td colspan="6" align="right">
    <strong>Net Total:</strong>
  </td>
  <td align="right">
    <?=number_format($row['net_total'],2);?>&nbsp;৳
  </td>

</tr>

<tr>
  <td colspan="6" align="right">
    <strong>Paid:</strong>
  </td>
  <td align="right">
    <?=number_format($row['debit'],2);?>&nbsp;৳
  </td>

</tr>



<tr>
  <td colspan="6" align="right">
    <?php $ad= $row['debit']-$row['net_total'];?>
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
-->



</tbody>                    
</table>
</form>