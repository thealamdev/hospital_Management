<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>
  
  <div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
     <?php $this->load->view('back/sidebar'); ?> 
   </aside>
   <!--Sidebar End-->
   <div class="has-sidebar-left">
     <?php $this->load->view('back/navbar'); ?>   
   </div> 
   <div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
      <div class="container-fluid text-white">
        <div class="row p-t-b-10 ">
          <div class="col">
            <h4>
              <i class="icon-box"></i>
              <?= $page_title ?>
              
            </h4>
          </div>
        </div>
      </div>
    </header>
    
    <div class="section-wrapper">

     
      <!-- cart one end -->

      <div class="card my-3 no-b">
        <div class="card-body">
         <div class="card-title">Date Wise Doctor Commission Summary Report</div>
         <form method="POST" action="admin/opd_com_summary_report" target="_blank">
           <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputEmail4" class="col-form-label">Start Date</label>
              
              <div class="input-group ml-3">
                <input type="text" name="start_date" id="date_of_birth" autocomplete="off" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                <span class="input-group-append">
                  <span class="input-group-text add-on white">
                    <i class="icon-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="inputEmail4" class="col-form-label">End  Date</label>
              
              <div class="input-group ml-3">
                <input type="text" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                <span class="input-group-append">
                  <span class="input-group-text add-on white">
                    <i class="icon-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
            <div class="form-group col-md-3">
              
             <label for="inputEmail4" class="col-form-label">Doctor List</label>
             <select class="custom-select select2" name="doc_name">
              <option value="0">All</option>
              <?php foreach ($doc_list as $key => $value) { if($value['doctor_type']==2) {?>
                
                <option value="<?=$value['doctor_id']?>"><?=$value['doctor_title']?> (Quack)</option>


              <?php }} ?>  

              

              

            </select> 
          </div>
          <div class="form-group col-md-3"> 
            <label for="inputEmail4" class="col-form-label"></label>
            <label for="inputEmail4" class="col-form-label"></label>
            <div class="input-group ml-3">
              <button type="submit" class="btn btn-success">Submit</button>

            </div>

          </div>

        </div>
      </form> 
      <hr/>


      <h4 align="center">Today Commission Report</h4>
      
    </div>
  </div>

  <div class="card my-3 no-b">
   <div class="card-body">
    <!-- <div class="card-title">Date wise Doctor Commission Summary Report</div> -->
    
    <table id="test_table" class="table table-bordered table-hover test_table_report"
    >
    <thead>
      <tr>
        <th>SL NO</th>
        <th>Doctor Name</th>      
        <th>Service Name</th>
        <th>Amount</th>
        
        
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
         <td>
           <?php
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