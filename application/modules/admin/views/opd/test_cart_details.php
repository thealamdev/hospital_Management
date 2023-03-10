<div id="" class="col-md-12">

  <?php if (isset($total_additional_test)) { ?>
    <input type="hidden" name="total_additional_test" id="total_additional_test" value="<?= $total_additional_test ?>">
  <?php } else { ?>

    <input type="hidden" name="total_additional_test" id="total_additional_test" value="0">

  <?php } ?>

  <?php if (count($cart = $this->cart->contents()) > 0) { ?>
    <table class="table table-striped" id="test_cart_table">
      <thead class="bg-dark text-white">
        <th>SL</th>
        <th>Test</th>
        <th>Price</th>
        <th>Vat</th>
        <th>Disount</th>
        <th>Net Amount</th>
        <th>C/O</th>
        <th>Sub. C/O </th>
        <th style="width:15%">Doc/Dic %</th>

        <!-- <th style="width:25%">Price*Qty</th> -->
        <th><i class="fa fa-trash-o" aria-hidden="true"></i></th>
      </thead>
      <tbody class="mytable_style" id="cart_content_table">
        <?php $cart = $this->cart->contents(); ?>
        <?php $i = 1;
        $total = 0;
        foreach ($cart as $item) { ?>
          <tr>
            <td><?= $i; ?></td>
            <td><?= $item['name'] ?></td>



            <!-- <td style="display: none"><input type="hidden" value="<?= $item['id'] ?>" name=""></td>
                                <td style="display: none"><input type="hidden" value="<?= $item['options']['sub_test_id'] ?>" name=""></td> -->

            <td><input readonly type="text" style="text-align: right; padding:0;" class="form-control col-md-10" id="test_cart_price_<?= $item['rowid']; ?>" value="<?= number_format($item['price'], 2, '.', ''); ?>"><span style="padding:0">৳</span></td>

            <td><span style="padding:0"><?= number_format(0, 2, '.', ''); ?></span></td>

            <td><span style="padding:0"><?= number_format(0, 2, '.', ''); ?></span></td>

            <td><span style="padding:0"><?= number_format(0, 2, '.', ''); ?></span></td>

            <td><?= $item['options']['quk_ref_com'] ?><span style="padding:0"></span></td>

            <td style=""><?= $item['options']['quk_ref_com'] ?><span style="padding:0"></span></td>
            <td >
                <?=(int) $item['options']['discount_percent']?>
              </td>

            <!--   <td><input style="padding:0" type="number" class="form-control" id="test_cart_qty_<?= $item['rowid']; ?>" value="<?= $item['qty']; ?>" onchange="update_price_qty('<?= $item['rowid']; ?>')"></td> -->

            <!-- <td><span style="padding:0"class="form-control col-md-10"><?= number_format($item['subtotal'], 2); ?></span><span style="padding:0">৳</span></td> -->

            <td><i id="<?= $item["rowid"] ?>" class="fa fa-2x fa-trash-o remove_test text-danger" aria-hidden="true"></i></td>

          </tr>

        <?php $i++;
        } ?>

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
          <td><input readonly style="color:white;background-color:#3E54AC;padding:3px;text-align: center;"  type="text" value="<?= number_format($this->cart->total(), 2, '.', ''); ?>" id="total_amount" name="total_amount" class="form-control col-md-10" /><span style="padding:0">৳</span></td>
          <td><input readonly style="padding:0" type="text" id="total_c_o" name="total_c_o" class="form-control col-md-12" /></td>
          <td><input readonly style="padding:0" type="text" id="sub_c_o" name="sub_c_o" class="form-control col-md-12" /></td>
          <td></td>
        </tr>

        <tr>
          <td colspan="2" align="right">Discount(%)</td>
          <td><input tabindex="14" autocomplete="off" style="padding:0;text-align: right;" type="text" data-total="<?= $this->cart->total(); ?>" id="discount_percent" name="discount_percent" class="form-control col-md-10" /><span style="padding:0">%</span></td>

          <td colspan="2" autocomplete="off" align="right">Discount(৳)</td>
          <td><input tabindex="15" style="padding:0;text-align: right;" type="text" data-total="<?= $this->cart->total(); ?>" name="total_discount" id="discount" class="form-control col-md-10" /><span style="padding:0">৳</span></td>

          <td></td>
          <td></td>

        </tr>

        <tr>
          <td colspan="2" align="right">VAT(%)</td>
          <td><input tabindex="17" autocomplete="off" style="padding:0;text-align: right;" type="text" data-total="<?= $this->cart->total(); ?>" id="vat_percent" name="vat_percent" class="form-control col-md-10" /><span style="padding:0">%</span></td>

          <td colspan="2" align="right">VAT(৳)</td>
          <td><input tabindex="18" autocomplete="off" style="padding:0;text-align: right;" type="text" data-total="<?= $this->cart->total(); ?>" id="vat" name="vat" class="form-control col-md-10" /><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
        </tr>

        <tr>
          <td colspan="2" align="right">Net Total</td>
          <td><input autocomplete="off" readonly style="color:white;background-color:#539165;padding:3px;text-align: center;" type="text" id="net_total" name="net_total" value="<?= number_format($this->cart->total(), 2, '.', ''); ?>" class="form-control col-md-10" /><span style="padding:0">৳</span></td>

          <td></td>
          <td autocomplete="off" align="right">Dis. Limit</td>

          <?php if ($item['options']['discount_amount'] != 0) { ?>
            <td colspan="3"><input readonly tabindex="16" style="padding:0;text-align: right;" type="text" id="discount_limit" value="<?= $item['options']['discount_amount'] ?>" name="discount_amount" class="form-control col-md-12" /></td>

          <?php } elseif ($item['options']['discount_percent'] != 0) { ?>

            <td colspan="3"><input readonly tabindex="16" style="padding:0;text-align: right;" type="text" id="discount_limit" value="<?= $this->cart->total() * ($item['options']['discount_percent'] / 100) ?>" name="discount_percent" class="form-control col-md-12" /></td>

          <?php } else { ?>

            <td colspan="3"><input readonly tabindex="16" style="padding:0;text-align: right;" type="text" id="discount_limit" value="<?= $item['options']['discount_percent'] ?>" name="discount_percent" class="form-control col-md-12" /></td>

          <?php } ?>
        </tr>
        <tr>
          <td colspan="2" align="right">Total Paid</td>
          <td><input tabindex="19" autocomplete="off" style="padding:0;text-align: right;" type="text" id="total_paid" name="paid_amount" class="form-control col-md-10" /><span style="padding:0">৳</span></td>
          <td></td>
          <td autocomplete="off" align="right">Dis. Ref</td>
          <td colspan="3"><input tabindex="16" style="padding:0;text-align: right;" type="text" id="discount_ref" name="discount_ref" class="form-control col-md-12" /></td>
        </tr>
        <tr>
          <td colspan="2" align="right">Due</td>
          <td><input autocomplete="off" readonly style="color:white;background-color:#DF2E38;padding:3px;text-align: center;" type="text" value="<?= number_format($this->cart->total(), 2, '.', ''); ?>" id="due" name="due" class="form-control col-md-10" /><span style="padding:0">৳</span></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tbody>
    </table>
  <?php } else { ?>
    <div class="row">
      <div class="alert alert-block alert-info ml-2">
        <i class="ace-icon fa fa-info-circle bigger-120"></i>
        &nbsp;No Test added in 'Test Order List'
      </div>

    </div>
  <?php } ?>
</div>

<?php if (count($this->cart->contents()) > 0) { ?>
  <div align="right">
    <button tabindex="21" type="submit" id="save_button" class="btn btn-success" target=_blank onFocusOut="document.querySelector('[autofocus]').focus()">Save</button>
  </div>

<?php } ?>