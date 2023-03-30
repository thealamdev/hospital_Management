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

    <?php if($flag=="release"){ ?>
      <div align="right" class="mt-3 mr-3">
        <a href="admin/get_ipd_patient_billing_info_pdf1/<?=$patient_info[0]['id']?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a>
      </div>
    <?php } ?> 

    <div class="section-wrapper">
      <div class="card  no-b">
        <div class="card-body">
          <div class="container">
            <div class="invoice white shadow">
             <div class="row pl-5 pr-5 pt-2">
              <div  class="col-md-4">
                <img class="mb-4" style="width: 120px;" src="uploads/hospital_logo/<?=$hospital_info[0]['hospital_logo']?>" alt="">
              </div> 
              <div class="col-md-4">
                <table class="test_table_report">
                  <tbody>
                    <tr>
                      <td class="font-weight-normal"><h4><b><?=$hospital_info[0]['hospital_title']?></b></h4>
                        <address class="ml-3">
                          Address: <?=$hospital_info[0]['address_1']?><br>
                          Telephone: <?=$hospital_info[0]['telephone']?><br>
                          Mobile: <?=$hospital_info[0]['mobile_no']?>
                        </address>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div> 
              <div class="col-md-4"></div>
            </div>

            <div class="row pl-5 pr-5">
              <div class="col-md-4"></div>
              <div class="col-md-9">
                <table class="test_table_report">
                  <tbody>
                    <tr>
                      <td>Patient Name: </td>
                      <td><?=$patient_info[0]['patient_name']?></td>
                    </tr>
                    <tr>
                      <td>Age: </td>
                      <td><?=$patient_info[0]['age']?></td>
                    </tr>
                    <tr>
                      <td>Gender: </td>
                      <td><?=$patient_info[0]['gender']?></td>
                    </tr>
                    <tr>
                      <td>Date Of Birth: </td>
                      <td><?=date('d M,Y',strtotime($patient_info[0]['date_of_birth']))?></td>
                    </tr>
                    <tr>
                      <td>Mobile No: </td>
                      <td><?=$patient_info[0]['mobile_no']?></td>
                    </tr>
                    <tr>
                      <td>Address: </td>
                      <td><?=$patient_info[0]['address']?></td>
                    </tr>
                    
                  </tbody>
                </table>      
              </div>
              <div class="col-md-3">
                <table class="test_table_report">
                  <tbody>
                   <tr>
                    <td>Booked By: </td>
                    <td><?=$patient_info[0]['operator_name']?></td>
                  </tr>
                  <tr>
                    <td>Doctor Name: </td>
                    <td><?=$patient_info[0]['doc_name']?></td>
                  </tr>
                  <tr>
                    <td>Ref Doctor Name: </td>
                    <td><?=$patient_info[0]['ref_doc_name']?></td>
                  </tr>
                </tbody>
              </table>

            </div>

          </div>

          <!-- Table row -->
          <div class="row mt-5 pl-5">
            <h4>Admission Fee</h4>
          </div>

          <form id="my_from" action="admin/ipd_update_payment/<?=$patient_info[0]['id']?>/release" method="POST">

            <div class="row pl-5 pr-5 my-2">
              <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped test_table_report">

                  <thead>
                    <th>Admission Fee</th>
                  </thead>
                  <tbody>
                    <tr><td align="right"><?=number_format($patient_info[0]['admission_fee'],2,'.','')?></td></tr>

                  </tbody>
                </table>
              </div>
            </div>

            
            <!-- Table row -->
            <div class="row mt-5 pl-5">
              <h4>Cabin Bill</h4>
            </div>


            <div class="row pl-5 pr-5 my-2">
              <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped test_table_report">
                  <thead>
                    <th>SL NO</th>
                     <th>Admit Date</th>
                    <th>Room No</th>
                    <th>Room Price</th>
                    <th>Day</th>
                    <th>Cost</th>
                   
                    <th style="width:20%">Total</th>
                    
                  </thead>
                  <tbody>
                    <?php $i=1;
                    $days=0;
                    $total_cabin=0;
                    $total_ser=0;
                    $total=0;


                    if($flag=="release")
                    { 

                      foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) {?>

                        <tr>
                          <td align="center"><?=$i?></td>
                            <td align="center"><?=date('d-m-Y',strtotime($value['created_at']))?></td>
                          <td align="center"><?=$value['room_title']?></td>

                          <td align="center"><?=$value['room_price']?></td>
                          <td align="right">
                           <?php 
                                 // echo date('Y-m-d',strtotime($value['created_at']));
                                 // echo date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at']));

                           $current_date=date_create(date('Y-m-d H:i:s',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
                           $next_date=date_create(date('Y-m-d H:i:s',strtotime($patient_timeline[$key+1]['created_at'])));
                           $diff=date_diff($next_date,$current_date);
                           $hours= $diff->h;
                           $days= $diff->d;

                           $price_per_hour=$value['room_price']/24;

                           $total_cabin= $total_cabin+($days*$value['room_price']+$hours*$price_per_hour);

                           echo $days.' days '.$hours.' hours';
                           ?>

                         </td>
                         <td align="right"><?=round($days*$value['room_price']).' + '.round($hours*$price_per_hour)?></td>




                         <td align="right"><?=round($days*$value['room_price']+$hours*$price_per_hour)?></td>
                        
                       </tr>

                       <?php $i++; } } }
                       else 
                       {


                        foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) {?>

                          <tr>
                            <td align="center"><?=$i?></td>
                            <td align="center"><?=date('d-m-Y',strtotime($value['created_at']))?></td>
                            <td align="center"><?=$value['room_title']?></td>
                            <td align="center"><?=$value['room_price']?></td>
                            <td align="right">
                             <?php 
                                 // echo date('Y-m-d',strtotime($value['created_at']));
                                 // echo date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at']));

                             $current_date=date_create(date('Y-m-d H:i:s',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
                             $next_date=date_create(date('Y-m-d H:i:s',strtotime($patient_timeline[$key+1]['created_at'])));
                             $diff=date_diff($next_date,$current_date);
                             $hours= $diff->h;
                             $days= $diff->d;

                             $price_per_hour=$value['room_price']/24;

                        //  if($days==0)
                        //  {
                        //   $days=1;
                        // }

                             $total_cabin= $total_cabin+($days*$value['room_price']+$hours*$price_per_hour);

                             echo $days.' days '.$hours.' hours';
                             ?>

                           </td>
                           <td align="right"><?=round($days*$value['room_price']).' + '.round($hours*$price_per_hour)?></td>




                           <td align="right"><?=round($days*$value['room_price']+$hours*$price_per_hour)?></td>
                           
                         </tr>

                         <?php $i++;} 

                         else { ?>
                          <tr>
                            <td align="center"><?=$i?></td>
                            <td align="center"><?=date('d-m-Y',strtotime($value['created_at']))?></td>
                            <td align="center"><?=$value['room_title']?></td>
                            <td align="center"><?=$value['room_price']?></td>
                            <td align="right">
                             <?php 
                                 // echo date('Y-m-d',strtotime($value['created_at']));
                                 // echo date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at']));

                             $current_date=date_create(date('Y-m-d H:i:s',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
                             $next_date=date_create(date('Y-m-d H:i:s'));

                             $diff=$next_date->diff($current_date);
                             $hours= $diff->h;
                             $days= $diff->d;

                             $price_per_hour=$value['room_price']/24;

                        //  if($days==0)
                        //  {
                        //   $days=1;
                        // }

                             $total_cabin= $total_cabin+($days*$value['room_price']+$hours*$price_per_hour);

                             echo $days.' days '.$hours.' hours';
                             ?>

                           </td>
                           <td align="right"><?=round($days*$value['room_price']).' + '.round($hours*$price_per_hour)?></td>




                           <td align="right"><?=round($days*$value['room_price']+$hours*$price_per_hour)?></td>
                           
                         </tr>

                       <?php  }



                     }  }?>


                   </tbody>
                 </table>
               </div>
               <!-- /.col -->

             </div>

             <?php if($service_info!=null) { ?>

              <div class="row  pl-5">
                <h4>Service Bill</h4>
              </div>

              <div class="row pl-5 pr-5 my-3">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered table-striped test_table_report">
                    <thead>
                      <th>SL NO</th>
                      <th>Date</th>
                      <th>Service Name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th style="width:20%">Total</th>
                      
                    </thead>
                    <tbody>
                      <?php $i=1;

                      $total_ser=0;
                          // $last_date=0;
                      foreach ($service_info as $key => $value) { ?>

                        <tr>
                          <td align="center"><?=$i?></td>
                          <td align="center"><?=date('d-M-Y h:i:s', strtotime($value['created_at']))?></td>
                          <td align="center"><?=$value['service_name']?> (<?=$value['operated_name']?>)</td>
                          <td align="right"><?=$value['price']?></td>
                          <td align="right"><?=$value['qty']?></td>
                          <td align="right"><?=$value['price']*$value['qty']?></td>

                        </tr>



                        <?php $total_ser+=$value['price']*$value['qty'];
                        $i++;}  


                        ?>

                      </tbody>
                    </table>
                  </div>
                </div>

              <?php } $total=$total_ser+round($total_cabin)+$total_bill_info[0]['admission_fee'];?>

              <div class="row pl-5 pr-5 my-3">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered table-striped test_table_report">
                    <tbody>

                      <tr><td colspan="4"align="right">Total</td><td  align="right"> <input style="text-align: right" class="form-control" readonly type="text" name="total" value="<?=number_format($total,2,'.','')?>"></td></tr>
                      
                      <?php
                      $net_total=$total+$total_bill_info[0]['total_vat']-$total_bill_info[0]['total_discount']
                      ?>



                      <tr><td colspan="4"align="right">Advance Payment</td><td align="right"><input readonly style="text-align: right" id="adv_pay" name="adv_pay" value="<?=number_format($total_bill_info[0]['advance_payment'],2,'.','')?>" class="form-control" type="text"></td></tr>

                      <tr><td colspan="4"align="right">Admission Fee Paid <br>Total Adm Fee: <?=number_format($total_bill_info[0]['admission_fee'],0,'.','')?></td><td align="right"><input readonly style="text-align: right" id="adm_fee_pay" name="adm_fee_pay" value="<?=number_format($total_bill_info[0]['admission_fee_paid'],2,'.','')?>" class="form-control" type="text"></td></tr>

                      <tr><td colspan="4"align="right"> Total Paid</td><td align="right"><input readonly style="text-align: right" id="already_paid" name="already_paid" value="<?=number_format($total_bill_info[0]['total_paid'],2,'.','')?>" class="form-control" type="text"></td></tr>

                      <tr><td colspan="4"align="right">Due</td><td align="right"><input style="text-align: right" readonly id="due" name="due" value="<?=number_format($net_total-$total_bill_info[0]['total_paid'],2,'.','')?>" class="form-control" type="text"></td></tr>


                      <?php if($flag=="release"){?> 
                        <tr><td colspan="4"align="right">Discount<br><p>Already Discount Given: <?=number_format($total_bill_info[0]['total_discount'],2,'.','')?></p></td><td align="right"><input data-total="<?=number_format($total,2,'.','')?>"  style="text-align: right" id ="discount" name="discount" value="<?=number_format(0,2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>

                        <tr><td colspan="4"align="right">Discount Ref</td><td align="right"><input   style="text-align: right" id ="discount_ref" name="discount_ref" class="form-control col-md-12" type="text"></td></tr>



                        <tr><td colspan="4" align="right">VAT</td><td align="right"><input style="text-align: right" data-total="<?=number_format($total,2,'.','')?>" id ="vat" name="vat" value="<?=number_format(0,2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>
                        
                        <tr><td colspan="4" align="right">Grand Due</td><td align="right"><input style="text-align: right" readonly="" data-total="<?=number_format($total,2,'.','')?>" id ="grand_due" name="grand_due" value="<?=number_format($net_total-$total_bill_info[0]['total_paid'],2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>

                        <?php if($total_bill_info[0]['payment_status']!="paid"){
                          ?>                         
                          <tr><td colspan="4"align="right"><button class="btn-xs btn-success" type="submit">Pay</button></td><td><input style="text-align: right" id="total_paid" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_payment" ></td></tr>

                        <?php } }?>



                      </tbody>

                    </table>
                  </div>
                  <!-- /.col -->

                </div>

              </form>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
     <div class="control-sidebar-bg shadow white fixed"></div>
   </div>

   <?php $this->load->view('back/footer_link');?>



   <script type="text/javascript">
    $(document).ready(function()
    {

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


      $(document).on('input', '#adm_fee_discount', function()
      {
        var discount;
        var vat;


        if($('#adm_fee_discount').val()=="")
        {
          discount="0";
        }
        else
        {
          discount=$('#adm_fee_discount').val();

        }

      // alert(delivary_cost);

      var net_tot=(parseFloat($('#adm_fee_due').val()))-(parseFloat(discount));

      // alert(net_tot);

      $('#adm_fee_grand_due').val(net_tot.toFixed(2));


    });

    });





  </script>
</body>
</html>












