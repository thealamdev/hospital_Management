  <div class="row">
 
              <div class="col-md-8">
                <table>
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

              <div class="col-md-4">
                <table>
                  <tbody>
                     <tr>
                      <td>Booked By: </td>
                      <td><?=$patient_info[0]['operator_name']?></td>
                    </tr>
                    <tr>
                      <td>Ref Doctor Name: </td>

                      <?php foreach ($doctor_info_ref as $key => $value) {
                          
                          if($value['doctor_id']==$patient_info[0]['ref_doctor_id'])
                          {?>

                            <td><?=$value['doctor_title']?></td>

                          <?php }

                      } ?>
                      
                    </tr>
                    

                       <tr>
                      <td>Quack Doctor Name: </td>

                      <?php foreach ($doctor_info_quack as $key => $value) {
                          
                          if($value['doctor_id']==$patient_info[0]['quack_doc_id'])
                          {?>

                             <td><?=$value['doctor_title']?></td>

                          <?php }

                      } ?>
                      
                    </tr>


                    <tr>
                      <td>Ordered Date: </td>
                      <td><?=date('d M,Y h:i a',strtotime($patient_order_info[0]['created_at']))?></td>
                    </tr>
                    <tr>
                      <td>Delivary Date: </td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                    
              </div>

            </div>
                
            
                  <!-- Table row -->
                  <div class="row pl-5 pr-5 my-3">
                    <div class="col-12 table-responsive">
                       <form action="admin/opd_update_payment_each_bill/<?=$order_id?>/<?=$patient_id?>/opd_due" method="POST">
                      <table class="table table-bordered table-striped test_table_report">
                        <thead>
                          <th>SL NO</th>
                          <th>Test Name</th>
                          <th>Price</th>
                          <!-- <th>Vat</th>
                          <th>Discount</th> -->

                        </thead>
                        <tbody>
                         <?php
                          foreach ($patient_order_info as $key => $value) { 
                            if($value['payment_status']=='paid')
                            {
                                  $i=1;

                                    foreach ($patient_test_details_info as $key => $value1) 
                                      { if($value['id']==$value1['patient_test_order_id']) { ?>
                                       <tr> 
                                          <td align="center"><?=$i?></td>
                                          <td align="center"><?=$value1['sub_test_title']?></td>
                                          <td align="right"><?=number_format($value1['price'],2,'.','')?> &#x9f3</td>
                                          
                                       </tr>
                                    <?php  $i++; 

                                  } }
                                   
                                  ?>
								  <?php
								  //echo  $total_amount;
								  $total_amount=$value['total_amount'];
								 
								  $vat=($value['vat']);
								   //echo $vat;
								  $discount=$value['total_discount'];
								  $paid_amount=$value['paid_amount'];
								  //echo $discount;
								 // echo "</br>";
								  // echo $paid_amount;
								  $net_total=($total_amount+$vat-$discount);
								  //echo "</br>";
								   //echo $net_total;
								  $due=($net_total-$paid_amount);
								  //echo "</br>";
								  // echo $due; 
								  
								  ?>
                                  <tr><td colspan="2"align="right">Total</td><td align="right"><?=number_format($value['total_amount'],2,'.','')?> &#x9f3</td></tr>

                                  <tr><td colspan="2"align="right">VAT (+)</td><td align="right"><?=$value['vat']?></td></tr>

                                  <tr><td colspan="2"align="right">Total Discount (-)</td><td align="right"><?=$value['total_discount']?> &#x9f3</td></tr>

                                  <tr><td colspan="2"align="right">Net Total</td><td align="right"><?php echo $net_total?> &#x9f3</td></tr>

                                  <tr><td colspan="2"align="right">Total Paid</td><td align="right"><?php echo $paid_amount?> &#x9f3</td></tr>

                                  <tr><td colspan="2"align="right">Due</td><td align="right"><?=number_format((($value['total_amount']+$value['vat'])-$value['total_discount'])-$value['paid_amount'],2,'.','')?> &#x9f3 </td></tr>
                                   <?php } 
                                   else { 
                                        $i=1;
                                    foreach ($patient_test_details_info as $key => $value1) 
                                      { if($value['id']==$value1['patient_test_order_id']) { ?>
                                       <tr> 
                                          <td align="center"><?=$i?></td>
                                          <td align="center"><?=$value1['sub_test_title']?></td>
                                          <td align="right"><?=number_format($value1['price'],2,'.','')?> &#x9f3</td>
                                          
                                       </tr>
                                    <?php  $i++; 

                                  } }
                                   
                                  ?>
								  <?php
								  $total_amount=$value['total_amount'];
								 
								  $vat=$value['vat']; 
								  $discount=$value['total_discount'];
								  $paid_amount=$value['paid_amount'];
								  //echo $discount;
								 // echo "</br>";
								  // echo $paid_amount;
								  $net_total=($total_amount+$vat-$discount);
								  //echo "</br>";
								   //echo $net_total;
								  $due=($net_total-$paid_amount);
								  //echo "</br>";
								  // echo $due; 
								  ?>
                                  <tr><td colspan="2"align="right">Total</td><td align="right"><?=number_format($value['total_amount'],2,'.','')?> &#x9f3 </td></tr>

                                  <tr><td colspan="2"align="right">VAT (+)</td><td align="right"><?=$value['vat']?></td></tr>

                                  <tr><td colspan="2"align="right">Total Discount (-)</td><td align="right"><?=$value['total_discount']?> &#x9f3 </td></tr>

                                  <tr><td colspan="2"align="right">Net Total</td><td align="right"><?php echo $net_total?> &#x9f3</td></tr>

                                  <tr><td colspan="2"align="right">Total Paid</td><td align="right"><?php echo $paid_amount?> &#x9f3</td></tr>

                      


                                  <tr><td colspan="2"align="right">Due</td>

								  <td align="right">
								  <input style="text-align: right" name="due" id="due" onkeyup="addinput();" value="<?=number_format((($value['total_amount']+$vat)-$value['total_discount'])-$value['paid_amount'],2,'.','')?>" class="form-control" readonly></td>
								
								 </tr>
                                 
                  <tr>
									<td colspan="2"align="right"><button class="btn-xs btn-success" type="Button">Discount</button></td>
									<td><input style="text-align: right" onkeyup="addinput();" value="<?=number_format(0,2,'.','')?>" class="form-control" max="<?php echo $due?>"  min="0" type="number" name="discount_due" id="discount_due"></td>
									</tr>
									                                    <tr>
									<td colspan="2"align="right"><button class="btn-xs btn-success" type="Button">Discount Ref</button></td>
									<td><input style="text-align: right"  class="form-control" type="text" name="discount_ref" ></td>
									</tr> 
									<tr>
									<td colspan="2"align="right"><button class="btn-xs btn-success" type="Button">Grand Due</button></td>
									<td><input style="text-align: right" id="grand_due" value="<?=number_format(0,2,'.','')?>" class="form-control" max="<?php echo $due?>" min="0" type="number" name="grand_due"></td>
									</tr>
									<tr>
									<td colspan="2"align="right"><button class="btn-xs btn-success" type="Button">Paid Amount</button></td>
									<td><input style="text-align: right" value="<?=number_format(0,2,'.','')?>" class="form-control" max="<?php echo $due?>" min="0" type="number" name="update_payment"></td>
									</tr>
									<tr>
									<td colspan="2"align="right"><button class="btn-xs btn-success" type="submit">Receive</button></td>
									<td></td>
									</tr>
                                  


                                   <?php } } ?>

                        </tbody>
                      </table>
                      </form>
                    </div>
                    <!-- /.col -->
                  </div>