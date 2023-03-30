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

          <form id="my_form" action="admin/ipd_update_payment/<?=$patient_info[0]['id']?>/ipd_due" method="POST">

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


                    foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) {?>

                      <tr>
                        <td align="center"><?=$i?></td>
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

                     <?php $i++; } } ?>


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

                      <tr><td colspan="4"align="right">Discount</td><td align="right"><input data-total="<?=number_format($total,2,'.','')?>"  style="text-align: right" id ="discount" name="discount" value="<?=number_format(0,2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>



                      <tr><td colspan="4" align="right">VAT</td><td align="right"><input style="text-align: right" data-total="<?=number_format($total,2,'.','')?>" id ="vat" name="vat" value="<?=number_format(0,2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>

                      <tr><td colspan="4" align="right">Grand Due</td><td align="right"><input style="text-align: right" readonly="" data-total="<?=number_format($total,2,'.','')?>" id ="grand_due" name="grand_due" value="<?=number_format($net_total-$total_bill_info[0]['total_paid'],2,'.','')?>" class="form-control col-md-12" type="text"></td></tr>

                      <?php if($total_bill_info[0]['payment_status']!="paid"){
                        ?>                         
                        <tr><td colspan="4"align="right"><button class="btn-xs btn-success" type="submit">Pay</button></td><td><input style="text-align: right" id="total_paid" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_payment"></td></tr>

                      <?php } ?>

                    </tbody>
                  </table>
                  <div class="col-md-8 offset-md-4 pt-1" id="error_level_div"><p style="color: red;">Over due amount can not be submitted</p></div>
                </div>
                <!-- /.col -->

              </div>

            </form> 









