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
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];];
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
             



              

              <table class="table table-bordered table-striped test_table_report">            
                <thead>
                  <tr>
                    <th>SL NO</th>
                    
                    <th>Group. Head</th>
                    
                    <th>Total Amount</th>
                    <th>Paid</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1;
                  $toatl=0;
                  $toatlp=0;
                  $due=0;
                  foreach ($acc_group as $key => $value) { ?>
                   <tr>
                     <td><?=$i?></td>
                     
                     <td><?=$value['group_title'];?></td>         
                     <td><?=$value['tamnt']?></td>
                     
                     <td><?=$value['tpaid']?></td>
                     
                     <?php
                   }
                   ?>
                   

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












