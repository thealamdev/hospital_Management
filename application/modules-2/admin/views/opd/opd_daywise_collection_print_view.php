<?php $this->load->view('back/header_link'); ?>
<body class="light">
<!-- Pre loader -->
<?php $this->load->view('back/loader'); ?>
 
<div id="app">
    
                    
        <div class="section-wrapper">
          <div class="card my-3 no-b">
          <div class="card-body">
          <div class="container">
          <div class="invoice white shadow">
             <div class="row pl-5 pr-5">
                 <div class="col-md-12">
                  <img class="mb-4" style="height:140px; width: 1020px;" src="uploads/hospital_header/hos_erp_header.PNG" alt="">
              </div> 
              <div class="col-md-4 mt-2">
                   
              </div> 
              <div class="col-md-4"></div>
              <div class="col-md-9">
                <table class="table table-bordered table-hover test_table_report">
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
                <table>
                  <tbody>
                     <tr>
                      <td>Booked By: </td>
                      <td><?=$patient_info[0]['operator_name']?></td>
                    </tr>
                    <tr>
                      <td>Ref Doctor Name: </td>
                      <td><?=$patient_info[0]['ref_doctor_name']?></td>
                    </tr>
                  </tbody>
                </table>
                    
              </div>
                
            </div>
                  <!-- Table row -->
                  <div class="row pl-5 pr-5 my-3">
                    <div class="col-12 table-responsive">
                      <table class="table table-bordered table-striped  test_table_report">
                        <thead>
                          <th>SL NO</th>
                          <th>Date</th>
                          <th>Test Name</th>
                          <th>Price</th>
                          <!-- <th>Vat</th>
                          <th>Discount</th> -->

                        </thead>
                        <tbody>
                          <?php
                          $total=0;
                          $vat=0;
                          $discount=0;
                          $net_total=0;
                          $due=0;
                          foreach ($patient_order_info as $key => $value) {
                          $total=$total+$value['total_amount'];
                          $vat=$vat+$value['vat'];
                          $discount=$discount+$value['total_discount'];
                          $net_total=($net_total+$value['total_amount']+$value['vat'])-$value['total_discount'];
                          $due=$due+(($value['total_amount']+$value['vat'])-$value['total_discount'])-$value['paid_amount']; ?>

                          <?php
                                  $i=1;
                                    foreach ($patient_test_details_info as $key => $value1) 
                                      { if($value['id']==$value1['patient_test_order_id']) { ?>
                                       <tr> 
                                          <td align="center"><?=$i?></td>
                                          <td align="center"><?=date('d M,Y h:i a',strtotime($value['created_at']))?></td>
                                          <td align="center"><?=$value1['sub_test_title']?></td>
                                          <td align="right"><?=number_format($value1['price'],2,'.','')?> &#x9f3</td>
                                          
                                       </tr>
                                    <?php  $i++; 

                                  } }
                                   
                                  ?>
                                  <tr><td colspan="3"align="right">Total</td><td align="right"><?=number_format($value['total_amount'],2,'.','')?> &#x9f3</td></tr>

                                  <tr><td colspan="3"align="right">VAT</td><td align="right"><?=$value['vat']?> %</td></tr>

                                  <tr><td colspan="3"align="right">Total Discount</td><td align="right"><?=$value['total_discount']?> %</td></tr>
                                  <tr><td colspan="3"align="right">Net Total</td><td align="right"><?=number_format(($value['total_amount']+$value['vat'])-$value['total_discount'],2,'.','')?> &#x9f3</td></tr>

                                  <tr><td colspan="3"align="right">Due</td><td align="right"><?=number_format((($value['total_amount']+$value['vat'])-$value['total_discount'])-$value['paid_amount'],2,'.','')?> &#x9f3</td></tr>
                                   <?php } ?>
                                   <tr>
                                     <td align="center" colspan="3"><b>Summary:</b></td>
                                   </tr>
                                   <tr><td colspan="3"align="right">Total</td><td align="right"><?=number_format($total,2,'.','')?> &#x9f3</td></tr>

                                   <tr><td colspan="3"align="right">VAT</td><td align="right"><?=$vat?> &#x9f3</td></tr>

                                   <tr><td colspan="3"align="right">Total Discount</td><td align="right"><?=$discount?> &#x9f3</td></tr>

                                   <tr><td colspan="3"align="right">Net Total</td><td align="right"><?=number_format($net_total,2,'.','')?> &#x9f3</td></tr>

                                   <tr><td colspan="3"align="right">Due</td><td align="right"><?=number_format($due,2,'.','')?> &#x9f3</td></tr>

                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  
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




</body>
</html>












