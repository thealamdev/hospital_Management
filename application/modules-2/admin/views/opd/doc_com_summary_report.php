<!-- <script type="text/javascript">
   setTimeout(function() { 
        window.print();
        self.close();
   }, 1000);
 </script> -->
 <?php $this->load->view('back/header_link'); ?>
 <body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>
  
  <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>

  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="invoice white shadow">
             <div class="row pl-5 pr-5">
               <div class="col-md-3">
                <img style="height: 130px;width: 150px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
              </div>      
              <div class="col-md-9">

               <?=$hos_head_report?>
             </div> 
             
             <div class="col-md-12" style="border-bottom:#000 solid 1px">
             </div>

             
           </div>
           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of OPD Collection Between <?php echo $from_date?> to <?php echo $end_date?> </p>

              
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$doc_id?> </p>

              

              
              

              <table id="test_table" class="table table-bordered table-hover test_table_report"
              >
              <thead>
                <tr>
                  <th>SL NO</th>
                  <th>Doctor Name</th>      
                  <th>Service Name</th>
                  <th>Commission Paid</th>
                  <th style="width:10%;">Status</th>
                  <th>Date</th>
                  <th>Operator</th>
                  <!-- <th style="width:10%;">Details</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;

                $total=0;
                foreach($comission_summary as $key => $value1)
                {
                  ?>
                  <tr>
                   <td><?=$i++?></td>
                   <td><?=$value1['doc_name']?></td>
                   <td><?=$value1['sub_test_title']?></td>
                   
                   <td><?=$value1['amount']?></td>
                   <td><?php
                   $st=$value1['com_status'];
                   if($st==0)
                   {
                     $sti="UNPAID";
                     echo  $sti;
                     
                   }
                   else if($st==1)
                   {
                     $sti="PAID";
                     echo  $sti;
                     
                     
                   }

                   else
                   {
                    $sti="Advance";
                    echo  $sti;
                  }
                  
                  
                  ?></td>

                  <td><?=$value1['created_at']?></td>
                  <td><?=$this->session->userdata['logged_in']['username']?></td>
            <!--  <td>
             <a href="admin/com_payment_details/<?=$value1['id']?>">Payment Details</a>
           </td> -->
         </tr> 
         <?php

         $total+=$value1['amount'];
         
       }
       
       ?>
       
     </tbody>
   </table>
   
   <p style="font-weight:bold">Total Commission : <?php echo $total?></p>
          <!-- 
            <p style="font-weight:bold">Total Paid : <?php echo $toatlp?></p>

            <p style="font-weight:bold">Total Due : <?php echo $toatl-$toatlp ?></p> -->

            
            
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












