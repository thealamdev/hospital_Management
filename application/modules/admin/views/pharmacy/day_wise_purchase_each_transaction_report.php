
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

              <p style="text-align:center;font-weight:bold">Purchase Report from <?php echo date('d-m-Y', strtotime($from_date))?> to <?php echo date('d-m-Y', strtotime($end_date))?></br>

                <table class="table table-bordered table-striped test_table_report">            
              <thead>
                <tr style="text-align:center">
                  <th>S.L</th>
                  <th>Bill No</th>
                  <th>Purchage Code</th>
                  <th>Purchage Date</th>
                  <th>Suplier Name</th>
                  <!-- <th>Expire Date</th> -->
                  <th>Total Amount</th> 
                  <th>Unload Cost</th>  
                  <th>Net Total</th> 
                  <th>Amount Paid</th> 
                  <th>Due</th> 
                  <th>Status</th>

                </tr>
              </thead>
              <tbody>
                <?php 
                $i=1;
                $total=0;
                $total_amount=0;
                $total_paid=0;
                $total_due=0;
                $total_unload_cost=0;
                foreach ($all_purchased_product_list as $key => $value)
                {


                  // $total_amount+=$value['credit'];
                  // $total_unload_cost+=$value['unload_cost'];
                  // $total_paid+=$value['paid_due'];
                  // $total_due+=$value['current_due'];

                  ?>            
                  <tr style="text-align:center">
                    <td><?=$i?></td>

                    <td><?=$value['bill_no'];?></td>



                    <td><?=$value['buy_code'];?></td>

                    <td><?=date("d-m-Y", strtotime($value['created_at']));?></td>

                    <td><?=$value['supp_name'];?></td>
                    <!-- <td><?=$value['expire_date'];?></td> -->

                    <td align="right"><span class=""><?=$value['total_amount'];?></span></td>
                    <td align="right"><span class=""><?=$value['unload_cost'];?></span></td>
                    <td align="right"><span class=""><?=$value['cost_total'];?></span></td>
                    <td align="right"><span class=""><?=$value['paid_due'];?></span></td>
                    <td align="right"><span class=""><?=$value['current_due'];?></span></td>

                    <td align="center"><?php
                    if($value['cost_total'] <= $value['debit']){?>

                      <span class="badge badge-success">Paid</span>

                    <?php }  
                    else{ ?>

                      <span class="badge badge-danger">Due</span>
                    <?php }
                    ?></td>
                  </tr>
                  <?php 
                  $i++;
                  $total+=$value['cost_total'];
                }?>   
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












