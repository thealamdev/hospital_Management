
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

              
              <p style="text-align:center;font-size:14px;color:black !important;font-weight:bold;"> Report Type: <?=$specimen?> </p>

              
              <?php 
              $total_all=0;
              foreach ($specimen_info as $key => $value) { 

                $total=0;
                
                
                ?>

                <h2 align="center" style="color: black !important"><?=$value['specimen']?></h2>

                <table id="test_table" class="table table-bordered table-hover test_table_report test_table_report"
                >
                <thead>
                  <th>SL</th>
                  <th>Test Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Revenue</th>
                </thead>

                <tbody>




                 <?php   

                 $i=1;
                 foreach ($test_info as $key1 => $value1) { 



                  if($value1['specimen_id']==$value['id']) {

                    $total+=$value1['price']*$value1['total_test'];
                    ?>

                    
                    <tr>
                      <td align="center"><?=$i?></td>
                      <td align="center"><?=$value1['sub_test_title']?></td>
                      <td align="center"><?=$value1['total_test']?></td>
                      <td align="center"><?=$value1['price']?></td>
                      <td align="center"><?=$value1['price']*$value1['total_test']?></td>
                    </tr>
                    
                    



                    <?php 

                    $i++;} }


                      // $i++;
                    ?>    

                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="4"></td>
                      <td >Total:<?=$total ?></td>
                      
                    </tr>
                  </tfoot>

                </table> 

                <!-- <p style="font-weight:bold">Total Amount : <?php echo $total?></p> -->
                <?php $total_all+=$total; } ?>




                
                

                
                <p style="font-weight:bold;color: black !important">Total Revenue : <?php echo $total_all?></p>
                
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
