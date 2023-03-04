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

              
              <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$test_id?> </p>

              
              <?php 
              $total_all=0;
              foreach ($comission_testwise as $key => $value) { 

                $total=0;
                
                
                ?>

                <h2 align="center"><?=$value['sub_test_title']?></h2>

                <table id="test_table" class="table table-bordered table-hover test_table_report"
                >
                <thead>
                  <th>SL</th>
                  <th>Doctor Name</th>
                  <th>Comission</th>
                  <th>Date</th>
                  <th>Operator</th>
                </thead>

                <tbody>
                  

                  

                 <?php   

                 $i=1;
                 foreach ($comission_info as $key1 => $value1) { 

                   

                  if($value1['service_id']==$value['service_id']) {

                    $total+=$value1['amount'];
                    ?>

                    
                    <tr>
                      <td align="center"><?=$i?></td>
                      <td align="center"><?=$value1['doc_title']?></td>
                      <td align="center"><?=$value1['amount']?></td>
                      <td align="center"><?=$value1['created_at']?></td>
                      <td align="center"><?=$this->session->userdata['logged_in']['username']?></td>
                    </tr>
                    
                    



                    <?php 

                    $i++;} }


                      // $i++;
                    ?>    

                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2"></td>
                      <td>Total:<?=$total ?></td>
                      <td></td>
                    </tr>
                  </tfoot>

                </table> 

                <!-- <p style="font-weight:bold">Total Amount : <?php echo $total?></p> -->
                <?php $total_all+=$total; } ?>




                
                

                
                <p style="font-weight:bold">Total Amount : <?php echo $total_all?></p>
                
            <!-- <p style="font-weight:bold">Total Paid : <?php echo $toatlp?></p>

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












