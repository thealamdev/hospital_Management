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
    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>


    <div class="section-wrapper">
      <div class="container-fluid">
        <div align="right" class="mt-3">
          <!-- <a href="admin/opd_patient_billing_print_view/<?=$patient_info[0]['id']?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i>PDF</a> -->
        <!-- <a href="admin/opd_patient_billing_print_view1/<?=$patient_info[0]['id']?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i> Print View1</a>
        <a href="" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i> Print</a>
        <a href="admin/get_patient_info_pdf" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a> -->
      </div>
      <div class="card  no-b">
        <div class="card-body">
         <div class="row">

           <div class="col-md-4">
            <div class="form-horizontal">
              <label >Patient Name:</label>
              <label id="patient_name"><?=$patient_info[0]['patient_name']?></label>
            </div>
            <div class="form-horizontal">
              <label for="phone_no">Phone No:</label>
              <label id="phone_no"><?=$patient_info[0]['mobile_no']?></label>
            </div>

            <div class="form-horizontal">
              <label for="age">Age:</label>
              <label id="age"><?=$patient_info[0]['age']?></label>
            </div>
            <div class="form-horizontal">
              <label for="gender">Gender:</label>
              <label id="gender"><?=$patient_info[0]['gender']?></label>
            </div>

          </div>
          <div class="col-md-4">
               <!--  <div class="form-horizontal">
                      <label for="invoice">Invoice:</label>
                      <label id="invoice"><?=$patient_info[0]['']?></label>
                    </div> -->
                    <div class="form-horizontal">
                      <label for="booked_by">Booked By:</label>
                      <label id="booked_by"><?=$patient_info[0]['operator_name']?></label>
                    </div>
                    <div class="form-horizontal">
                      <label for="printed_by">Printed By:</label>
                      <label id="printed_by"><?=$patient_info[0]['operator_name']?></label>
                    </div>


                    <div class="form-horizontal">
                      <label for="ref_by">Ref Doctor:</label>
                      <?php foreach ($doctor_info_ref as $key => $value) {

                        if($value['doctor_id']==$patient_info[0]['ref_doctor_id'])
                          {?>


                            <label id="ref_by"><?=$value['doctor_title']?></label>


                          <?php }

                        } ?>

                      </div>

                      <div class="form-horizontal">
                        <label for="ref_by">Quack Doctor:</label>
                        <?php foreach ($doctor_info_quack as $key => $value) {

                          if($value['doctor_id']==$patient_info[0]['quack_doc_id'])
                            {?>


                              <label id="ref_by"><?=$value['doctor_title']?></label>


                            <?php }

                          } ?>

                        </div>


                      </div>

                      <div class="col-md-4">
                        <div class="form-horizontal">
                          <label for="printed_by">Date:</label>
                          <label id="printed_by"><?=$patient_info[0]['created_at']?></label>
                        </div>
                      </div>

                    </div>
                    <div class="row mt-3" >
                     <div class="col-md-3"></div>
                     <div class="col-md-6">

                      <?php 
                      foreach ($patient_order_info as $key => $value) {
                        if($value['payment_status']=='unpaid' && $flag=="")
                          { ?>
                            <div id="accordion">
                              <div class="card">
                                <div class="card-header">

                                 <!-- <a href="admin/opd_patient_billing_print_view/<?=$patient_info[0]['id']?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i>Print ( <?=$value['test_order_id']?>)</a> -->

                                 <a class="card-link" data-toggle="collapse" href="#collapseOne<?=$value['id']?>">
                                  <?=$value['test_order_id']?>
                                </a>


                                <a style="float: right;" href="admin/opd_each_patient_pdf/<?=$value['patient_id']?>/<?=$value['id']?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i>Print</a>



                              </div>
                              <div id="collapseOne<?=$value['id']?>" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                  <table class="table table-bordered table-striped test_table_report">
                                   <thead>
                                     <th>SL</th>
                                     <th>Service Booked</th>
                                     <th style="width: 40%">Charges</th>
                                   </thead>
                                   <tbody>
                                    <?php
                                    $i=1;
                                    foreach ($patient_test_details_info as $key => $value1) 
                                      { if($value['id']==$value1['patient_test_order_id']) { ?>
                                       <tr> 
                                        <td><?=$i?></td>
                                        <td align="center"><?=$value1['sub_test_title']?></td>
                                        <td align="right"><?=number_format($value1['price'],2,'.','')?></td>

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
                                    <tr><td colspan="2"align="right">Total</td><td align="right"><?=number_format($value['total_amount'],2,'.','')?></td></tr>

                                    <tr><td colspan="2"align="right">VAT (+)</td><td align="right"><?=$value['vat']?></td></tr>

                                    <tr><td colspan="2"align="right">Total Discount (-)</td><td align="right"><?=$value['total_discount']?></td></tr>

                                    <tr><td colspan="2"align="right">Net Total </td><td align="right"><?=number_format($net_total,2,'.','')?></td></tr>

                                    <tr><td colspan="2"align="right">Due</td><td align="right"><?php echo number_format($due,2,'.','')?></td></tr>

                                    <form action="admin/opd_update_payment/<?=$value['id']?>/<?=$value['patient_id']?>" method="POST">
                                      <tr>
                                       <td colspan="2"align="right"><button class="btn-xs btn-success" type="Button">Pay</button>
                                       </td>
                                       <td><input style="text-align:right" value="<?=number_format(0,2,'.','')?>" class="form-control" type="text" name="update_payment">
                                       </td>
									<!---
									<tr>
									<td colspan="2"align="right"><button class="btn-xs btn-success" type="Button">Discount ( As %)</button>
									</td>
									<td><input style="text-align:right" value="<?//=number_format(0,2,'.','')?>" class="form-control" type="text" name="discount">
									</td>
									</tr>
               -->
               <tr>
                 <td colspan="2"align="right"><button class="btn-xs btn-success" type="submit">Receive</button>
                 </td>
                 <td>
                 </td>
               </tr>
             </form>


           </tbody>
         </table> 
       </div>
     </div>
   </div>
 </div>
<?php }

else
  { ?>
    <div id="accordion">
      <div class="card">
        <div class="card-header">
          <a class="card-link" data-toggle="collapse" href="#collapseTwo<?=$value['id']?>">
            <?=$value['test_order_id']?>
          </a>

          <a style="float: right;" href="admin/opd_each_patient_pdf/<?=$value['patient_id']?>/<?=$value['id']?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i>Print</a>
        </div>
        <div id="collapseTwo<?=$value['id']?>" class="collapse show" data-parent="#accordion">
          <div class="card-body">
            <table class="table table-striped table-bordered test_table_report">
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
                  <td align="center"><?=$value1['sub_test_title']?></td>
                  <td align="right"><?=number_format($value1['price'],2,'.','')?></td>

                </tr>
                <?php  $i++; 

              } }

              ?>
              <tr><td colspan="2"align="right">Total</td><td align="right"><?=number_format($value['total_amount'],2,'.','')?></td></tr>

              <tr><td colspan="2"align="right">VAT</td><td align="right"><?=$value['vat']?></td></tr>

              <tr><td colspan="2"align="right">Total Discount</td><td align="right"><?=$value['total_discount']?></td></tr>
              <tr><td colspan="2"align="right">Net Total</td><td align="right"><?=number_format(($value['total_amount']+$value['vat'])-$value['total_discount'],2,'.','')?></td></tr>

              <tr><td colspan="2"align="right">Due</td><td align="right"><?=number_format((($value['total_amount']+$value['vat'])-$value['total_discount'])-$value['paid_amount'],2,'.','')?></td></tr>

            </tbody>
          </table> 
        </div>
      </div>
    </div>
  </div>
<?php   }
}
?>

</div>
<div class="col-md-3"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>
</body>
</html>