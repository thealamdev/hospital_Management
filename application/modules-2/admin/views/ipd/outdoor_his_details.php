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
                 <img style="height: 110px;width: 110px; margin-top:10px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt=""> 
               </div>       
               <div class="col-md-8">

                 <?=$hos_head_report?> 
               </div> 


               <hr style="width: 100%; border:0.5px solid #000"/>



             </div>

           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12">

              <p style="text-align:center;font-weight:bold">Diagnostic Order History Between <?php echo $from_date?> to <?php echo $end_date?></br>

                <table class="table table-bordered table-striped test_table_report">            
                  <thead>
                    <tr>
                      <th>S.L</th>
                      <th>Reg No</th>
                      <th>Patient Name</th>
                      <th>Total Amount</th>
                      <th></th>
                      <th>Total Discount</th>
                      <th></th>
                      <th>Total Vat</th>
                      <th></th>
                      <th>Net Total</th> 
                      <th></th>
                      <th>Total Paid</th> 
                      <th>Date</th> 
                      <th>Status</th>             

                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $i=1;
                    $total_a=0;
                    $total_v=0;
                    $total_d=0;
                    $total_n=0;
                    $total_p=0;
                    foreach ($outdoor_service_history as $key => $value)
                    {



                      ?>            
                      <tr>
                        <td><?=$i?></td>
                        <td><?=$value['reg_id'];?></td>
                        <td><?=$value['patient_name'];?></td>
                        <td><?=$value['total_amount'];?></td>
                        <td></td>
                        <td><?=$value['total_discount'];?></td>
                        <td></td>
                        <td><?=$value['total_vat'];?></td>
                        <td></td>
                        <td><?=$value['net_total'];?></td>
                        <td></td>
                        <td><?=$value['total_paid'];?></td>
                        <td><?=$value['created_at'];?></td>

                        <td align="center"><?php
                        if($value['net_total'] <= $value['total_paid']){?>

                          <span class="badge badge-success">Paid</span>

                        <?php } 
                        else{ ?>

                          <span class="badge badge-danger">Due</span>
                        <?php }
                        ?></td>


                      </tr>
                      <?php 
                      $i++;

                      $total_a+=$value['total_amount'];
                      $total_d+=$value['total_discount'];
                      $total_v+=$value['total_vat'];
                      $total_n+=$value['net_total'];
                      $total_p+=$value['total_paid'];

                    }?>   
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3" align="right">
                       Total :  
                     </td>
                     <td>
                       <?php echo $total_a?>
                     </td>

                     <td  align="right">
                       Discount :  
                     </td>
                     <td>
                       <?php echo $total_d?>
                     </td>


                     <td  align="right">
                       Vat :  
                     </td>
                     <td>
                       <?php echo $total_v?>
                     </td>

                     <td  align="right">
                       Net Total :  
                     </td>
                     <td>
                       <?php echo $total_n?>
                     </td>

                     <td  align="right">
                       Paid :  
                     </td>
                     <td>
                       <?php echo $total_p?>
                     </td>


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












