
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
                    
        <div class="section-wrapper">

            <div class="card my-3 no-b">
            <div class="card-body">
               <div class="container">
        <div class="invoice white shadow">
           

            <div class="p-5">
 <!-- title row -->
 <div class="row">
        <div class="col-12">
          <img class="w-80px mb-4" src="uploads/hospital_logo/<?=$hospital_info[0]['hospital_logo']?>" alt="">
          
              <div class="float-right">
                    <table class="table table-bordered table-hover test_table_report">
                        <tbody>
                          <tr>
                            <td class="font-weight-normal"><?=$hospital_info[0]['hospital_title']?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-normal">Address:</td>
                            <td><?=$hospital_info[0]['address_1']?></td>
                        </tr>
                        <tr>
                                <td class="font-weight-normal">Telephone:</td>
                                <td><?=$hospital_info[0]['telephone']?></td>
                            </tr>
                            <tr>
                                    <td class="font-weight-normal">Mobile No:</td>
                                    <td><?=$hospital_info[0]['mobile_no']?></td>
                                </tr>
                                
                    </tbody></table>
           
              </div>
        
        </div>
        <!-- /.col -->
      </div>

                  <!-- info row -->
            <div class="row my-3 ">
                    <div class="col-sm-4">
                     Patient Info:
                      <address>
                        <strong><?=$patient_info[0]['patient_name']?></strong><br>
                        <?=$patient_info[0]['address']?><br>
                        Phone:  <?=$patient_info[0]['mobile_no']?><br>
                      </address>
                    </div>
                    <!-- /.col -->
                    <!-- <div class="col-sm-4">
                      To
                      <address>
                        <strong>John Doe</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        Phone: (555) 539-1037<br>
                        Email: john.doe@example.com
                      </address>
                    </div> -->
                    <!-- /.col -->
                    <!-- <div class="col-sm-4">
                     
                    </div> -->
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <!-- Table row -->
                  <div class="row my-3">
                    <div class="col-12 table-responsive">
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

                           <p class="lead">Date: <?=date('d M,y h:i a',strtotime($value['created_at']));?></p>
                          <table class="table table-bordered table-striped">
                             <thead>
                               <th>SL</th>
                               <th>Service Booked</th>
                               <th>Charges</th>
                             </thead>
                               <tbody>
                                  <?php
                                  $i=1;
                                    foreach ($patient_test_details_info as $key => $value1) 
                                      { if($value['id']==$value1['patient_test_order_id']) { ?>
                                       <tr> 
                                          <td><?=$i?></td>
                                          <td><?=$value1['sub_test_title']?></td>
                                          <td align="right"><?=number_format($value1['price'],2,'.','')?> &#x9f3</td>
                                          
                                       </tr>
                                    <?php  $i++; 

                                  } }
                                   
                                  ?>
                                  <tr><td colspan="2"align="right">Total</td><td align="right"><?=number_format($value['total_amount'],2,'.','')?> &#x9f3</td></tr>

                                  <tr><td colspan="2"align="right">VAT</td><td align="right"><?=$value['vat']?> %</td></tr>

                                  <tr><td colspan="2"align="right">Total Discount</td><td align="right"><?=$value['total_discount']?> %</td></tr>
                                  <tr><td colspan="2"align="right">Net Total</td><td align="right"><?=($value['total_amount']+$value['vat'])-$value['total_discount']?> &#x9f3</td></tr>

                                  <tr><td colspan="2"align="right">Due</td><td align="right"><?=number_format((($value['total_amount']+$value['vat'])-$value['total_discount'])-$value['paid_amount'],2,'.','')?> &#x9f3</td></tr>
                                  
                               </tbody>
                          </table> 
                        <?php } ?>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <div class="row">
                    <!-- accepted payments column -->
                 
                    <!-- /.col -->
                    <div class="col-md-6 col-sm-12">
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <tbody><tr>
                            <th style="width:50%">Total:</th>
                            <td align="right"><?=number_format($total,2,'.','')?> &#x9f3</td>
                          </tr>
                          <tr>
                            <th>Discount:</th>
                            <td align="right"><?=$discount?> %</td>
                          </tr>
                          <tr>
                            <th>VAT</th>
                            <td align="right"><?=$vat?> %</td>
                          </tr>
                          <tr>
                            <th>Net Total:</th>
                            <td align="right"><?=number_format($net_total,2,'.','')?> &#x9f3</td>
                          </tr>
                          <tr>
                            <th>Due:</th>
                            <td align="right"><?=number_format($due,2,'.','')?> &#x9f3</td>
                          </tr>
                        </tbody></table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  <!-- this row will not appear when printing -->
                  <div class="row no-print">
                    <div class="col-12">
                      <a href="invoice-print.html" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i> Print</a>
                      <button type="button" class="btn btn-success btn-lg  float-right"><i class="icon icon-credit-card"></i> Submit Payment
                      </button>
                      <button type="button" class="btn btn-primary btn-lg float-right mr-2">
                        <i class="icon icon-cloud-download"></i> Generate PDF
                      </button>
                    </div>
                  </div>

            </div>
          
          </div>
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












