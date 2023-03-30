<?=date("d-m-Y", strtotime($row['expire_date']))?>

      $('#my_from').submit(function() {
        if (parseInt($('#grand_due').val()) < parseInt($('#total_paid').val())) {
         
          alertify.alert("<b>Amount can not be greater than Grand Due</b>");
          return false;
        }

        if (parseInt($('#discount').val()) > 0 && $('#discount_ref').val()=="") {
         
          alertify.alert("<b>Discount Reference can not be empty</b>");
          return false;
        }


      });



                <?php else { ?>


                  <tr>
                    <td colspan="6" align="right">
                      <strong>Due:</strong>
                    </td>
                    <td align="right">
                      <?=number_format($total_price-$total_charge[0]['charge']-$buy_details[0]['debit'],2);?>&nbsp;৳
                    </td>
                  </tr>

                  <?php if($total_price-$buy_details[0]['debit']+$total_charge[0]['charge']-$total_ret_paid[0]['total_paid'] > 0) { ?>


                    <tr><td colspan="6"align="right"><button name="due_btn" class="btn-xs btn-success" type="submit">Pay</button></td><td><input  style="text-align: right" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_payment_cust"></td></tr>

                  <?php } } ?>  


                     $.ajax({  
    url:"<?=site_url('admin/get_all_purchage_bill')?>",  
    method:"POST",  
    dataType:"json",  
    success:function(data)  
    { 
      var buy_code=[];

      $.each(data, function (key, value) {

        buy_code.push(value.buy_code);
      });

      $("#buy_code").typeahead({source:buy_code});


    }
  });