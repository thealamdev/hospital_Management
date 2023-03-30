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
                <img style="height: 130px;width: 150px;" src="back_assets/img/dummy/<?=$hos_logo?>" alt="">  
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
          <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Balance Sheet Report : <?php echo $from_date?> to <?php echo $end_date?> </p>

         
         

          <?php if($head=="all"){?>
             <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Head Type: All  </p>
          <?php } else { ?>
          <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Head Type: <?=$head?>  </p>

        <?php } ?>

        

                      <table  class="table table-bordered table-striped test_table_report">            
                        <thead>
    <tr>
                        <th>SL NO</th>
                         
                        <th>Acc. Head</th>
                       
                        <th> Income</th>
                        <th> Expense</th>
                        
                       
    </tr>
                        </thead>
                    <tbody>
                        <?php $i=1;
            $total_inc=0;
            $total_exp=0;
            
                        foreach ($total_income as $key => $value) { ?>
                           <tr>
                               <td align="center"><?=$i?></td>
                               
                        <td align="center"><?=$value['acc_head_title']?></td>
                          
                          <?php if($value['total_paid']=="") { ?>
                            <td align="center">0</td>

                            <?php } else { ?>
                               
                               <td align="center"><?=$value['total_paid']?></td>
                          
                          <?php } ?>  

                          <?php if($total_expense[$key]['total_paid']=="") { ?>
                            <td align="center">0</td>

                            <?php } else { ?>
                               
                               <td align="center"><?=$total_expense[$key]['total_paid']?></td>
                          
                          <?php } ?>     
                        
                        </td>
						
   
                    </tr>

                        
                        
                        
                        
                      <?php 
                        $total_inc+=$value['total_paid'];
                        $total_exp+=$total_expense[$key]['total_paid']; 
                        $i++; 
                      } ?>


       
            

                     </tbody>


                      </table>
            
           <!-- <p style="font-weight:bold">Total Amount : <?php echo $toatl?></p> -->
          
            <p style="font-weight:bold">Total Income : <?php echo $total_inc?></p>

             <p style="font-weight:bold">Total Expense : <?php echo $total_exp ?></p>
<hr>
             <p style="font-weight:bold">Total Balance : <?php echo $total_inc-$total_exp ?></p>
            
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












