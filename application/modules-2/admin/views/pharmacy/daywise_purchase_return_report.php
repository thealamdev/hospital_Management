
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
                <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>" alt="">  
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

             </p>

             <table class="table table-bordered table-striped test_table_report">            
              <thead>
                <tr style="text-align:center">
                  <th>S.L</th>
                  <th>Bill No</th>
                  <th>Purchage Code</th>
                  <th>Purchage Date</th>
            
                  <!-- <th>Expire Date</th> -->
                  <th>Total Amount</th> 
                  <th>Unload Cost</th>  
                  
                  <th>Total Refund</th>  
                  <th>Refund Charge</th>  
                  <th>Net Total</th> 
                  <th>Amount Paid</th> 
                  <th>Due</th> 
                  <th>Refundable</th> 
                  <th>Refunded</th> 
                  <th>Ret. Qty</th> 
                  <th>Status</th>
                  <th>Print</th>
                  <th>Details</th>

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
                $refund=0;
                $total_refund=0;
                $total_charge=0;
                $net_total=0;
                $total_refundable=0;
                $total_refunded=0;
                $total_ret_qty=0;
                foreach ($all_purchased_product_list as $key => $value)
                {

                  if($value['current_total_amount'] != "")
                  {
                    $refund=$value['current_total_amount'];
                  }

                  $total_amount+=$value['credit'];
                  $total_unload_cost+=$value['unload_cost'];
                  $total_paid+=$value['debit'];
                  $total_due+=$value['cost_total']-$value['debit'];
                  $total_refund+=$refund;
                  $total_charge+=$value['current_total_charge'];
                  $total_ret_qty+=$value['ret_qty'];

                  ?>            
                  <tr style="text-align:center">
                    <td><?=$i?></td>

                    <td><?=$value['bill_no'];?></td>



                    <td><?=$value['buy_code'];?></td>

                    <td><?=date("d-m-Y", strtotime($value['created_at']));?></td>

                
                    <!-- <td><?=$value['expire_date'];?></td> -->

                    <td align="right"><span class=""><?=$value['credit'];?></span></td>
                    <td align="right"><span class=""><?=$value['unload_cost'];?></span></td>
                    <td align="right"><span class=""><?=$refund;?></span></td>
                    <td align="right"><span class=""><?=$value['current_total_charge'];?></span></td>
                    <td align="right"><span class=""><?=$value['cost_total']-$refund+$value['current_total_charge'];?></span>

                      <?php $net_total=$value['cost_total']-$refund+$value['current_total_charge'];?>
                    </td>
                    <td align="right"><span class=""><?=$value['debit']+$value['current_total_paid'];?></span></td>
                    

                    <?php if($net_total > $value['debit']){ ?>
                      <td align="right"><?=$net_total-($value['debit']+$value['current_total_paid'])?></td>

                      <td align="right">0</td>

                      <td align="right">0</td>

                    <?php } else if($net_total < $value['debit'])
                    { ?>

                      <td align="right">0</span></td>


                      <td align="right"><?=$value['debit']-$net_total?></td>

                      <?php $total_refundable+=$value['debit']-$net_total ?>

                      <td align="right"><?=$value['current_total_paid'];?></td>

                       <?php $total_refunded+=$value['current_total_paid'] ?>

                    <?php } else { ?>
                      <td align="right">0</td>
                      <td align="right">0</td>

                      <td align="right">0</td>

                    <?php } ?>


                  </span></td>

                  <td><?=$value['ret_qty'];?></td>

                  <td align="center"><?php
                  if($value['cost_total'] <= $value['debit']){?>

                    <span class="badge badge-success">Paid</span>

                  <?php }  
                  else{ ?>

                    <span class="badge badge-danger">Due</span>
                  <?php }
                ?></td>

                <td><span class=""><a href="admin/purchage_product_details_pdf/<?=$value['buy_id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button">Print</a></span></td>

                <td align="center">
                  <a href="admin/purchage_product_details/<?=$value['buy_id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>
                </td>


              </tr>
              <?php 
              $i++;
              $total+=$value['cost_total'];
            }?>   
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4" align="right">
               Total :  
             </td>
             <td align="right"> <?php echo $total_amount?></td>
             <td align="right"> <?php echo $total_unload_cost?></td>
             <td align="right"> <?php echo $total_refund?></td>
             <td align="right"> <?php echo $total_charge?></td>
             <td align="right"> <?php echo $total?></td>
             <td align="right">
              <?php echo $total_paid?>
            </td>
            <td align="right"> <?php echo $total_due?></td>
            <td align="right"> <?php echo $total_refundable?></td>
            <td align="right"> <?php echo $total_refunded?></td>
            <td align="center"> <?php echo $total_ret_qty?></td>
            <td></td>

          </tr>
        </tfoot>


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












