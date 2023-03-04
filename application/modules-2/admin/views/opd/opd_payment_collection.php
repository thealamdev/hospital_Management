
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
                <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
              </div>      
              <div class="col-md-8">

               <?=$hos_head_report?>
             </div> 


             <div class="col-md-12" style="border-bottom:#000 solid 1px">
             </div>


           </div>
           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">
             <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of OPD Collection Between <?php echo $from_date?> to <?php echo $end_date?> </p>
             <table class="table table-bordered table-striped test_table_report">					  
              <thead>
                <tr>
                  <th>SL NO</th>
                  <th>Patient Name</th>
                  <th>Patient ID</th>
                  <th>Invoice No</th>
                  <th>Mobile No</th>
                  <th>Total Amount</th>
                  
                  <th>Paid Amount</th>
                  <th>Due</th>
                  <th>Discount</th>
                  <th>VAT</th>

                  <th>C/O Paid</th>
                  <th>Net Cash</th>
                  <th>Date</th>
                  <th>Operator</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1;
                $toatl=0;
                $toatlp=0;
                $total_discount=0;
                $total_vat=0;
                $total_vat=0;
                $total_c=0;
                $due=0;
                $total_com=0;
                $total_net_cash_in=0;
                foreach ($patient_test_order_info as $key => $value) {
                  $value['due']=$value['total_amount']+$value['vat']-($value['paid_amount']+$value['total_discount']);

                  ?>
                  <tr>
                   <td><?=$i?></td>
                   <td><?=$value['patient_name']?></td>
                   <td><?=$value['patient_info_id']?></td>
                   <td><?=$value['test_order_id']?></td>
                   <td><?=$value['mobile_no']?></td>
                   <td><?=$value['total_amount']?></td>
                   <td><?=$value['paid_amount']?></td>
                   <td><?=$value['due']?></td>
                   <td><?=$value['total_discount']?></td>
                   <td><?=$value['total_vat']?></td>
                   <td><?=$value['com_paid']?></td>								  
                   <td><?=$value['paid_amount']-$value['com_paid']?></td>                 
                   <td><?=date('d-M-Y h:i:s a',strtotime($value['created_at']))?></td>
                   <td><?=$value['operator_name']?></td>  
                   
                 </tr>
                 
                 <?php $i++;

                 $toatl+=$value['total_amount'];
                 $toatlp+=$value['paid_amount'];
                 $total_discount+=$value['total_discount'];	
                 $total_vat+=$value['total_vat'];	
                 $due+=$value['due'];	
                 $total_com+=$value['com_paid'];
                 $total_net_cash_in+=$value['paid_amount']-$value['com_paid'];
               }?>
               

             </tbody>



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












