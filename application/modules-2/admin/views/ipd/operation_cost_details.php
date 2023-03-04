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

                  <!-- Table row -->
                  <div class="row pl-5 pr-5 my-3">
                    <div class="col-12 table-responsive">
                      <form action="admin/update_operation_cost/<?=$service_info[0]['s_id']?>" method="POST">
                        <table class="table table-bordered table-striped test_table_report">
                          <thead>
                            <th>SL NO</th>
                            <th>Service Name</th>
                            <th>Cost</th>
                           
                          </thead>
                          <tbody>
                           <?php
                           foreach ($service_info as $key => $value) { 

                            $i=1;

                            ?>
                            <tr> 
                              <td><?=$i?></td>
                              <td><?=$value['service_name']?></td>
                              <td align="right"><?=$value['price']?></td>

                            </tr>

                            <?php  $i++; 

                          }

                          ?>


                          <tr><td colspan="2" align="right">Total</td><td id="total" align="right"><?=$service_info[0]['price']?></td></tr>

                          <tr><td colspan="2" align="right">Total Paid</td><td align="right"><?=$service_info[0]['cost_paid']?></td></tr>

                          <tr><td colspan="2" align="right">Discount</td><td align="right"><?=$service_info[0]['discount']?></td></tr>

                          <tr><td colspan="2" align="right">Discount</td><td align="right"><input style="text-align: right" name="discount" id="discount" onkeyup="net_amount()" value="<?=number_format(0,2,'.','')?>" class="form-control" ></td></tr>

                          <tr><td colspan="2" align="right">Discount Ref</td><td align="right"><input style="text-align: right" name="discount_ref" id="discount_ref"  value="" class="form-control" placeholder="Ex: Mamun"></td></tr>





                          <tr>
                            <td colspan="2" align="right">Due</td>
                            <td colspan="2" align="right">
                              <input style="text-align: right" name="due" id="due_show" value="<?=$service_info[0]['price']-$service_info[0]['cost_paid']-$service_info[0]['discount']?>" class="form-control" readonly></td>
                              <input type="hidden" value="<?=$service_info[0]['price']-$service_info[0]['cost_paid']-$service_info[0]['discount']?>" id="due_hide" name="">
                            </tr>

                            <?php if($service_info[0]['price']-$service_info[0]['discount'] > $service_info[0]['cost_paid']) { ?>          



                              <tr>

                                <td colspan="2"align="right"><button class="btn-xs btn-success" type="submit">Paid Amount</button></td>
                                <td><input style="text-align:right;" value="<?=number_format(0,2,'.','')?>" id="grand_due" class="form-control"  type="text" name="update_payment"></td>

                              </tr>

                          

                          <?php } ?>

                            </form>

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


<script type="text/javascript">
  
  function net_amount(argument) {
    
    var discount=$('#discount').val();
    var due=$('#due_hide').val();

    // alert(discount); 

    var net_amount=parseFloat(due-discount);

    $('#due_show').val(net_amount);

  }
</script>
 </body>
 </html>












