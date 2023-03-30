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
         <!-- <div align="right" class="mt-3 mr-3">
          <a href="admin/opd_each_patient_pdf/<?=$patient_id?>/<?=$order_id?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a>
        </div>        -->
        <div class="section-wrapper">
          <div class="card  no-b">
            <div class="card-body">
              <div class="container">
                <div class="invoice white shadow">
                 <div class="row  pl-5 pr-5">


                  <!-- <div class="col-md-4"></div> -->
                  <div class="col-md-8 mt-3 ">
                    <table class="table table-bordered table-hover test_table_report">
                      <tbody>
                        <tr>
                          <td>Patient Name: </td>
                          <td><?=$appointment_info[0]['patient_name']?></td>
                        </tr>

                        <tr>
                          <td>Gender: </td>
                          <td><?=$appointment_info[0]['gender']?></td>
                        </tr>

                        <tr>
                          <td>Mobile No: </td>
                          <td><?=$appointment_info[0]['mobile_no']?></td>
                        </tr>
                        <tr>
                          <td>Address: </td>
                          <td><?=$appointment_info[0]['address']?></td>
                        </tr>

                      </tbody>
                    </table>      
                  </div>
                  <div class="col-md-4 mt-3">

                    <table class="test_table_report">
                      <tbody>
                       <tr>
                        <td>Booked By: </td>
                        <td><?=$appointment_info[0]['operator_name']?></td>
                      </tr>
                      <tr>
                        <td>Doctor Name: </td>
                        <td><?=$appointment_info[0]['doc_name']?></td>
                      </tr>

                      <tr>
                        <td>Ref Doctor Name: </td>
                        <td><?=$appointment_info[0]['ref_doc_name']?></td>
                      </tr>

                      <tr>
                        <td>Patient Type: </td>
                        <td><?=$appointment_info[0]['patient_type']?></td>
                      </tr>
                      <tr>
                        <td>Created Date: </td>
                        <td><?=date('d-m-Y',strtotime($appointment_info[0]['created_at']))?></td>
                      </tr>
                      <tr>
                        <td>Appointment Id: </td>
                        <td><?=$appointment_info[0]['appointment_gen_id']?></td>
                      </tr>
                    </tbody>
                  </table>

                </div>
                
              </div>
              <!-- Table row -->
              <div class="row pl-5 pr-5 my-3">
                <div class="col-12 table-responsive">
                  <form action="admin/pay_appointment_fee/<?=$appointment_info[0]['id']?>" method="POST">
                    <table class="table table-bordered table-striped test_table_report">

                      <tbody>

                        <tr><td colspan="5" align="right">Total Amount</td><td id="total" align="right"><?=number_format($appointment_info[0]['total_amount'],2,'.','')?> &#x9f3</td></tr>


                        <tr><td colspan="5" align="right">Discount</td><td id="total" align="right"><?=number_format($appointment_info[0]['discount'],2,'.','')?> &#x9f3</td></tr>

                        <tr><td colspan="5" align="right">Net Amount</td><td id="total" align="right"><?=number_format($appointment_info[0]['net_amount'],2,'.','')?> &#x9f3</td></tr>

                        <tr><td colspan="5" align="right">Total Paid</td><td align="right"><?php echo number_format($appointment_info[0]['total_paid'],2,'.','')?> &#x9f3</td></tr>



                        <tr>
                          <td colspan="5" align="right">Due</td>
                          <td colspan="5" align="right">
                            <input style="text-align: right" name="due" id="due" onkeyup="addinput();" value="<?=number_format($appointment_info[0]['net_amount']-$appointment_info[0]['total_paid'],2,'.','')?>" class="form-control" readonly></td>
                          </tr>

                          <?php if($appointment_info[0]['total_amount'] > $appointment_info[0]['total_paid']) { ?>          

                            <tr>
                              <td colspan="5"align="right"><button class="btn-xs btn-success" type="submit">Paid Amount</button></td>
                              <td><input style="text-align:right;" onkeyup="addinput();" value="<?=number_format(0,2,'.','')?>" id="grand_due" class="form-control"  type="text" name="update_payment"></td>

                            </tr>

                          </form>

                        <?php } ?>



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












