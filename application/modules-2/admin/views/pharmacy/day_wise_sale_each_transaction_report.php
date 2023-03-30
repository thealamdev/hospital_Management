
<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>

  <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>
  <div align="center"><button id="btn_print" onclick="print_page('app')" style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>
  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="">
             <div class="row pl-5 pr-5">
               <div class="col-md-2">
                <img style="height: 130px;width: 150px;" src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>" alt="">  
              </div>      
              <div class="col-md-9">

               <?=$hos_head_report?>
             </div> 


             <div class="col-md-12" style="border-bottom:#000 solid 1px">
             </div>


           </div>
           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12">

              <p style="text-align:center;font-weight:bold">Sale Report from <?php echo date('d-m-Y', strtotime($from_date))?> to <?php echo date('d-m-Y', strtotime($end_date))?></br>

                <table id="test_table" class="table table-bordered table-hover test_table_report">
                  <thead>
                    <tr>
                      <th>S.L</th>
                      <!-- <th>Bill No</th> -->
                      <th>Sell Code</th>
                      <th>Sell Date</th>
                      <th>Customer Name</th>
                      <th>Total Amount</th> 
                      <th>Discount</th> 
                      <th>Vat</th> 
                      <th>Net Total</th> 
                      <th>Amount Paid</th> 

                      <th>Due</th> 
                      <th>Type</th>             
                      <th>Status</th>             
                      <!-- <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i=1;

                    $total_amount=0;
                    $net_total=0;
                    $total_paid=0;
                    $total_discount=0;
                    $total_vat=0;
                    $total_due=0;


                    foreach ($all_sale_product_list as $key => $value)
                    {

                      // $total_amount+=$value['credit'];
                      // $net_total+=$value['net_total'];
                      // $total_paid+=$value['debit'];
                      // $total_discount+=$value['discount'];
                      // $total_vat+=$value['vat'];
                      // $total_due+=$value['net_total']-$value['debit'];


                      ?>            
                      <tr>
                        <td><?=$i?></td>

                        <!-- <td><span class="badge badge-secondary"><?=$value['bill_no'];?></span></td> -->


                        <td><span class=""><?=$value['sell_code'];?></span></td>

                        <td><span class=""><?=date("d-m-Y", strtotime($value['created_at']));?></span></td>
                        <td><span class=""><?=$value['cust_name'];?></span></td>
                        
                        <td><span class=""><?=$value['credit'];?></span></td>
                        <td><span class=""><?=$value['discount'];?></span></td>
                        <td><span class=""><?=$value['vat'];?></span></td>
                        <td><span class=""><?=$value['net_total'];?></span></td>
                        <td><span class=""><?=$value['paid_due'];?></span></td>

                        <td><span class=""><?=$value['current_due'];?></span></td>
                        <td><span class=""><?php if($value['type']==1)
                        {
                          echo "Opd";
                        }
                        else if ($value['type']==2) {
                          echo "Ipd";
                        }
                         else if ($value['type']==4) {
                          echo "UHID";
                        }

                        else 
                        {
                          echo "Pharmacy Only";
                        }

                        ?></span></td>

                        <td align="center"><?php
                        if($value['net_total'] <= $value['debit']){?>

                          <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>

                        <?php } 
                        else{ ?>

                          <span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                        <?php }
                        ?></td>

                    <!--     <td align="center">
                          <a href="admin/sell_product_details/<?=$value['sell_id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>
                        </td> -->
                      </tr>

                      <?php 
                      $i++;
                    }?>   
                  </tbody>

<!--                   <tfoot style="background:#ccc;font-weight: bold;">
                   <tr>
                    <td colspan="4"></td>
                    <td><?php echo number_format($total_amount,2,'.','')?> </td>
                    <td><?php echo number_format($total_discount,2,'.','')?> </td>
                    <td><?php echo number_format($total_vat,2,'.','')?> </td>
                    <td><?php echo number_format($net_total,2,'.','')?> </td>
                    <td><?php echo number_format($total_paid,2,'.','')?> </td>
                    <td><?php echo number_format($total_due,2,'.','')?> </td>

                    <td></td>
                    <td></td>

                  </tr>
                </tfoot> -->
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












