 <form method="POST" action="admin/insert_ret_lab_in_data">
  <table class="table table-striped table-bordered table-hover sell_cart">
    <thead>
      <tr>
        <th>S.L</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Returnable Qty </th>
        <th>Returned Qty </th>

        <!-- <th>Price*Qty</th> -->
        <th style="width:40%">Update Qty</th>
      </tr>

    </thead>
    <tbody class="mytable_style" >

      <tr>
        <?php 
        if($return_info == null){
          foreach ($buy_details as $key => $row) { ?>

           <input type="hidden" name="p_id[]" value="<?=$row['p_id']?>" >

           <input type="hidden" name="buy_id" value="<?=$row['buy_id']?>" >

           <input type="hidden" name="buy_price[]" value="<?=$row['buy_price']?>">

           <td align="right"><?=$key+1;?></td>
           <td align="right"><?=$row['p_name'];?></td>
           <td align="right"><?=number_format($row['buy_price'],2);?>&nbsp;৳ 
           </td>

           <td align="right"><?=$row['buy_qty'];?>&nbsp;<?=$row['unit'];?>
         </td>
         <td align="right"><?=$row['buy_qty'];?>&nbsp;<?=$row['unit'];?>
       </td>

       <td align="right">0&nbsp;<?=$row['unit'];?>
     </td>



<!-- 

     <td align="right"><?=number_format(($row['buy_price']*$row['buy_qty']),2);?>&nbsp;৳ 
     </td>  -->

     <td align="right">
      <input type="number" class="col-md-6  form-control" max="<?=$row['buy_qty']?>" min="0" name="up_qty[]" id="up_qty">
    </td>
  </tr>
<?php } } else {
 foreach ($buy_details as $key => $row) { ?>

   <input type="hidden" name="p_id[]" value="<?=$row['p_id']?>" >

   <input type="hidden" name="buy_id" value="<?=$row['buy_id']?>" >

   <input type="hidden" name="buy_price[]" value="<?=$row['buy_price']?>">

   <tr>
    <td align="right"><?=$key+1;?></td>
    <td align="right"><?=$row['p_name'];?></td>
    <td align="right"><?=number_format($row['buy_price'],2);?>&nbsp;৳ 
    </td>
    <td align="right"><?=$row['buy_qty']?>&nbsp;<?=$row['unit'];?>
  </td>

  <td align="right"><?=$row['buy_qty']-$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
</td>

<td align="right"><?=$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
</td>

<!-- 
<td align="right"><?=number_format($row['buy_price']*($return_info[$key]['total_qty']),2);?>&nbsp;৳ 
</td>  -->

<td align="right">
  <input type="number" class="col-md-6  form-control" max="<?=$row['buy_qty']-$return_info[$key]['total_qty']?>" min="0" value="0" name="up_qty[]" id="up_qty">
</td>
</tr>

<?php } } ?>

<tr>
  <td colspan="6" align="right">

  </td>
  <td align="left">
    <input type="text" class="form-control col-md-12" name="charge" placeholder="Cancellation Charge">
  </td>
</tr>

<tr>
  <td colspan="6" align="right">

  </td>
  <td align="left">
    <input type="text" class="form-control col-md-12" name="note" placeholder="Note">
  </td>
</tr>

<tr>
  <td colspan="6" align="right">

  </td>
  <td align="right">
    <button type="submit" class="offset-md-1 col-md-4 btn btn-success">Update</button>
  </td>
</tr>




</tbody>                    
</table>
</form>