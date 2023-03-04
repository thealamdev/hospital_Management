<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>

  <div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
      <?php $this->load->view('back/sidebar'); ?> 
    </aside>
    <!--Sidebar End-->
    <div class="has-sidebar-left">
     <?php $this->load->view('back/navbar'); ?>   
   </div> 
   <div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
      <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
          <div class="col">
            <h4>
              <i class="icon-box"></i>
              <?= $page_title ?>
            </h4>
          </div>
        </div>
      </div>
    </header>

    <div align="right" class="mt-3 mr-3">
      <a href="javascript:void(0)" onclick="window.open('<?=base_url();?>admin/outdoor_service_details_pdf/'+<?=$outdoor_service_order_info[0]['id']?>,'','width=560,height=340,toolbar=0,menubar=0,location=0')" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a>
    </div>  

    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>

    <div class="section-wrapper">
      <div class="card no-b">
        <div class="card-body">

          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="row">
                <div class="col-md-6">
                  <h2 style="margin-top:0px;" class="">Reg-No: <?=$outdoor_service_order_info[0]['reg_id'];?></h2>
                </div>

                 <!--  <div class="col-md-6">
                    <h2 style="margin-top:0px;" class="">Bill-No: <?=$sell_details[0]['bill_no'];?></h2>
                  </div> -->
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label><strong>Patient Name:</strong></label> &nbsp;<?=$outdoor_service_order_info[0]['patient_name'];?>
                  </div>  
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <label><strong>Order Date:</strong></label> &nbsp;
                    <?php $only_date_array=explode(' ', $outdoor_service_order_info[0]['created_at']);
                    $only_date=$only_date_array[0];
                    echo date('d M Y', strtotime($only_date));
                    // echo " ".date('h:i:a', strtotime($only_date_array[1]));
                    ?>                    
                  </div>  
                  
                </div>
                <div class="space-6"></div>
                <div class="row mt-4">
                  <div class="col-md-10 offset-md-2">
                   <form action="admin/update_outdoor_payment/<?=$outdoor_service_order_info[0]['id']?>" method="POST" id="my_form">
                    <table class="table table-striped table-bordered table-hover sell_cart">
                      <thead>
                        <tr>
                          <th>S.L</th>
                          <th >Service Name</th>
                          <th >Qty</th>
                          <th >Price</th>
                          <th >Price*Qty</th>
                        </tr>
                      </thead>
                      <tbody class="mytable_style" >

                        <tr>
                          <?php foreach ($outdoor_service_order_info as $key => $row) { ?>

                            <td align="center"><?=$key+1;?></td>
                            <td align="center"><?=$row['service_name'];?></td>
                            <td align="center"><?=$row['qty'];?>
                          </td>
                          <td align="right"><?=number_format($row['price'],2);?>&nbsp;৳ 
                          </td>
                          <td align="right"><?=number_format(($row['price']*$row['qty']),2);?>&nbsp;৳ 
                          </td> 
                        </tr>
                      <?php } ?>

                      <tr>
                        <td colspan="4" align="right">
                          <strong>Total:</strong>
                        </td>
                        <td align="right">
                          <?=number_format($row['total_amount'],2);?>&nbsp;৳
                        </td>
                      </tr>



                      <tr>
                        <td colspan="4" align="right">
                          <strong>Discount:</strong>
                        </td>
                        <td align="right">
                          <?=number_format($row['total_discount'],2);?>&nbsp;৳
                        </td>

                      </tr>

                      <tr>
                        <td colspan="4" align="right">
                          <strong>VAT:</strong>
                        </td>
                        <td align="right">
                          <?=number_format($row['total_vat'],2);?>&nbsp;৳
                        </td>

                      </tr>

                      <tr>
                        <td colspan="4" align="right">
                          <strong>Net Total:</strong>
                        </td>

                        <?php $net_total=$row['total_amount']-$row['total_discount']+$row['total_vat'] ?>
                        <td align="right">
                          <?=number_format($net_total,2);?>&nbsp;৳
                        </td>

                      </tr>

                      <tr>
                        <td colspan="4" align="right">
                          <strong>Paid:</strong>
                        </td>
                        <td align="right">
                          <?=number_format($row['total_paid'],2);?>&nbsp;৳
                        </td>

                      </tr>

                      <tr>
                        <td colspan="4" align="right">
                          <?php $ad= $net_total-$row['total_paid'];?>
                          

                          <strong class="text-danger">Due</strong>


                        </td>
                        <td align="right">
                         <input  style="text-align: right" readonly="" value="<?=number_format($ad,2,'.','')?>" id="due" class="form-control" type="text" name="due">              
                       </td>

                     </tr>

                     <tr><td colspan="4"align="right">Discount</td><td align="right"><input data-total="<?=number_format($row['total_amount'],2,'.','')?>"  style="text-align: right" id="discount" name="discount" value="<?=number_format(0,2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>

                     <tr><td colspan="4" align="right">VAT</td><td align="right"><input style="text-align: right" data-total="<?=number_format($row['total_amount'],2,'.','')?>" id ="vat" name="vat" value="<?=number_format(0,2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>

                     <tr><td colspan="4" align="right">Grand Due</td><td align="right"><input style="text-align: right" readonly="" data-total="<?=number_format($row['total_amount'],2,'.','')?>" id ="grand_due" name="grand_due" value="<?=number_format($net_total-$row['total_paid'],2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>

                     <?php if($row['total_paid'] < $net_total) {?>


                      <tr><td colspan="4"align="right"><button class="btn-xs btn-success" type="submit">Pay</button></td><td><input id="pay_input" style="text-align: right" value="<?=number_format(0,0,'.','')?>" class="form-control" type="text" name="update_payment_outdoor"></td></tr>

                    <?php } ?>   

                    
                  </tbody>                    
                </table>
              </form>
            </div>


          </div>
        </div>
      </div><!-- /.row --> 

      <!-- history table div -->




    </div>
  </div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>

<script type="text/javascript">
  $(document).ready(function()
  {

    $('#my_form').submit(function() {
      if (parseInt($('#grand_due').val()) < parseInt($('#pay_input').val())) {

        alertify.alert("<b>Amount can not be greater than Grand Due</b>");
        return false;
      }
    });
    $(document).on('input', '#discount', function()
    {
      var discount;
      var vat;
      
      var total=$(this).data('total');
      if($('#discount').val()=="")
      {
        discount="0";
      }
      else
      {
        discount=$('#discount').val();
        
      }
      if($('#vat').val()=="")
      {
        vat="0";
      }
      else
      {
        vat=$('#vat').val();
        
        // vat=vat.toFixed(2);


      }
      
      
      // alert(delivary_cost);

      var net_total=(parseFloat($('#due').val())+parseFloat(vat))-(parseFloat(discount));

      $('#grand_due').val(net_total.toFixed(2));
      total_paid();



    });

    $(document).on('input', '#vat', function()
    {
      var discount;
      var vat;
      
      var total=$(this).data('total');
      if($('#discount').val()=="")
      {
        discount="0";
      }
      else
      {
        discount=$('#discount').val();
        
        
      }
      if($('#vat').val()=="")
      {
        vat="0";
      }
      else
      {
        vat=$('#vat').val();
        
      }
      
      
      // alert(discount);

      var net_total=(parseFloat($('#due').val())+parseFloat(vat))-(parseFloat(discount));

      $('#grand_due').val(net_total.toFixed(2));
      total_paid();


    });

  });





</script>