
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

           <div class="row pl-5 pr-5">
             <div class="col-md-2">
              <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>" alt="">  
            </div>      
            <div class="col-md-9">

             <?=$hos_head_report?>
           </div> 
         </div>
           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">

              <p style="text-align:center;font-weight:bold">Collection Between <?php echo $from_date?> - <?php echo $end_date?></br>
                Report By: <?=$dir_name[0]['director_name'];?>
              </p>

              <table id="test_table" class="table table-bordered table-hover test_table_report"
               >          
                <thead>
                  <tr>
                    <th>S.L</th>
                    <th>Invoice No</th>
                    <th>Cust Name</th>
                    <th>Total Amount</th>
                    <!-- <th></th> -->
                    <th>Total Discount</th>
                    <!-- <th></th> -->
                    <th>Total Vat</th>
                    <!-- <th></th> -->
                    <th>Net Total</th> 
                    <!-- <th></th> -->
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
                  $net_total=0;
                  foreach ($dir_wise_collection as $key => $value)
                  {


                    $net_total=$value['credit']-$value['discount']+$value['vat'];
                    ?>            
                    <tr>
                      <td><?=$i?></td>
                      <td><?=$value['sell_code'];?></td>
                      <td><?=$value['cust_name'];?></td>
                      <td><?=$value['credit'];?></td>
                      <!-- <td></td> -->
                      <td><?=$value['discount'];?></td>
                      <!-- <td></td> -->
                      <td><?=$value['vat'];?></td>
                      <!-- <td></td> -->
                      <td><?=$net_total;?></td>
                      <!-- <td></td> -->
                      <td><?=$value['debit'];?></td>
                      <td><?=$value['created_at'];?></td>

                      <td align="center"><?php
                      if($net_total <= $value['debit']){?>

                        <span class="badge badge-success">Paid</span>

                      <?php } 
                      else{ ?>

                        <span class="badge badge-danger">Due</span>
                      <?php }
                      ?></td>


                    </tr>
                    <?php 
                    $i++;

                    $total_a+=$value['credit'];
                    $total_d+=$value['discount'];
                    $total_v+=$value['vat'];
                    $total_n+=$value['net_total'];
                    $total_p+=$value['debit'];

                  }?>   
                </tbody>
                <tfoot>
                  <tr >
                    <td colspan="3"></td>
                    <td>
                     <?php echo $total_a?>
                   </td>


                   <td>
                     <?php echo $total_d?>
                   </td>


                   <td>
                     <?php echo $total_v?>
                   </td>


                   <td>
                     <?php echo $total_n?>
                   </td>


                   <td>
                     <?php echo $total_p?>
                   </td>

                   <td></td>  
                   <td></td>  
                 </tr>

               </tfoot>


             </table>




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












