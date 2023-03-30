<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>

  <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>


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


        <div align="center"><button id="btn_print" onclick="print_page1('balance_div')" style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>

        <div class="section-wrapper">
          <div class="card  no-b" id="balance_div">
           <div class="row pl-5 pr-5" id="header_div">
             <div class="col-md-2">
              <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
            </div>      
            <div class="col-md-8">

             <?=$hos_head_report?>
           </div> 
           <div class="col-md-12" style="border-bottom:#000 solid 1px">
           </div>

           
         </div>    <br>

         <div align="center">
           <h3>Doctor Comission Report Individual</h3>
         </div>

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
                      <td><?=$total_com_info[0]['patient_name']?></td>
                    </tr>

                    <tr>
                      <td>Gender: </td>
                      <td><?=$total_com_info[0]['gender']?></td>
                    </tr>

                    <tr>
                      <td>Mobile No: </td>
                      <td><?=$total_com_info[0]['mobile_no']?></td>
                    </tr>
                    <tr>
                      <td>Address: </td>
                      <td><?=$total_com_info[0]['address']?></td>
                    </tr>

                  </tbody>
                </table>      
              </div>
              <div class="col-md-4 mt-3">

                <table class="test_table_report">
                  <tbody>
                   <tr>
                    <td>Booked By: </td>
                    <td><?=$total_com_info[0]['operator_name']?></td>
                  </tr>
                  <tr>
                    <td>Doctor Name: </td>
                    <td><?=$total_com_info[0]['doc_name']?></td>
                  </tr>
                  <tr>
                    <td>Ordered Date: </td>
                    <td><?=date('d M,Y h:i a',strtotime($total_com_info[0]['created_at']))?></td>
                  </tr>
                  <tr>
                    <td>Order Id: </td>
                    <td><?=$total_com_info[0]['test_order_id']?></td>
                  </tr>
                </tbody>
              </table>

            </div>

          </div>
          <!-- Table row -->
          <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">
              <form action="admin/com_update_payment/<?=$total_com_info[0]['id']?>" method="POST">
                <table class="table table-bordered table-striped test_table_report">
                  <thead>
                    <th>SL NO</th>
                    <th>Test Name</th>
                    <th>Test Price</th>
                    <th>Total Commission</th>
                    <th>Per Test Discount <br> (Total Test Discount / No of Test)</th>
                    <th>Net Commission <br> (Total Commission - Per Test Discount)</th>
                          <!-- <th>Vat</th>
                            <th>Discount</th> -->

                          </thead>
                          <tbody>
                           <?php
                           foreach ($total_com_info as $key => $value) { 

                            $i=1;

                            ?>
                            <tr> 
                              <td align="center"><?=$i?></td>
                              <td align="center"><?=$value['sub_test_title']?></td>
                              <td align="center"><?=$value['price']?></td>
                              <td align="right"><?=number_format($value['gross_amount'],2,'.','')?> &#x9f3</td>
                              <td align="center">(<?=$value['total_test_discount'].'/'.count($total_com_info)?>) = <?=number_format($value['total_test_discount']/count($total_com_info),2,'.','')?></td>
                              <td align="right"><?=number_format($value['amount'],2,'.','')?> &#x9f3</td>

                            </tr>
                            <?php  $i++; 

                          }

                          ?>


                          <?php $due=($value['total_amount']-$value['paid_amount']);
                          ?>

                          <tr><td colspan="5" align="right">Total</td><td id="total" align="right"><?=number_format($value['total_commission'],2,'.','')?> &#x9f3</td></tr>

                          <tr><td colspan="5" align="right">Total Paid</td><td align="right"><?php echo number_format($value['paid_amount'],2,'.','')?> &#x9f3</td></tr>



                          <tr>
                            <td colspan="5" align="right">Due</td>
                            <td colspan="5" align="right">
                              <input style="text-align: right" name="due" id="due" onkeyup="addinput();" value="<?=number_format($value['total_commission']-$value['paid_amount'],2,'.','')?>" class="form-control" readonly></td>
                            </tr>

                            <?php if($value['total_commission'] > $value['paid_amount']) { ?>          



                              <tr>

                                <td colspan="5"align="right"><button class="btn-xs btn-success" id="paid_amount" type="submit">Paid Amount</button></td>
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

   <script>
    $(document).ready(function(){

      $('#header_div').hide();

    });

    function print_page1(divName) {
      $('#header_div').show();
      $('#paid_amount').hide();
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }

    window.onafterprint = function(){
      location.reload();
    };

  </script>


</body>
</html>












