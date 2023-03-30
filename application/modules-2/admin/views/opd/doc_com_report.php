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

      <div class="card my-3 no-b">
        <div class="card-body">
         <div class="card-title">Date Wise Doctor Commission Report</div>
         <form method="POST" action="admin/opd_com_list_report_print_view" target="_blank">
           <div class="form-row">
            <div class="form-group col-md-3">

             <label for="inputEmail4" class="col-form-label">Start Date</label>
             <div class="input-group ml-3">
              <input type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
              data-options='{"timepicker":false, "format":"Y-m-d"}' autocomplete="off" value="" required="" />
              <span class="input-group-append">
                <span class="input-group-text add-on white">
                  <i class="icon-calendar"></i>
                </span>
              </span>
            </div>
          </div>
          <div class="form-group col-md-3">

           <label for="inputEmail4" class="col-form-label">End Date</label>
           <div class="input-group ml-3">
            <input type="text" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
            data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
            <span class="input-group-append">
              <span class="input-group-text add-on white">
                <i class="icon-calendar"></i>
              </span>
            </span>
          </div>
        </div>
        <div class="form-group col-md-3">

         <label for="inputEmail4" class="col-form-label">Paid Status</label>
         <select class="custom-select select2" name="paid_status">
          <option value="1">All</option>
          <option value="2">Paid</option> 
          <option value="3">Unpaid</option>    						 
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

    <table id="test_table" class="table table-bordered table-hover test_table_report"
    >
    <thead>
      <tr>
        <th>SL NO</th>
        <th>Doctor Name</th>
        <th>Patient Id</th>
        <th>Patient Name</th>
        
        <th>Total Commission</th>
        <th>Paid Commission</th>
        <th style="width:10%;">Status</th>
        <th>Date</th>
        <!-- <th style="width:10%;">Details</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
      $i=1;
      $total_com=0;
      $paid_com=0;
      foreach($comission_list as $key => $value1)
      {

        $total_com+=$value1['total_commission'];
        $paid_com+=$value1['paid_amount'];
        ?>
        <tr>
         <td><?=$i++?></td>
         <td><?=$value1['doc_name']?></td>
         <td><?=$value1['patient_info_id']?></td>
         <td><?=$value1['patient_name']?></td>
         
         <td><?=$value1['total_commission']?></td>
         <td><?=$value1['paid_amount']?></td>
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
            <!--  <td>
             <a href="admin/com_payment_details/<?=$value1['id']?>">Payment Details</a>
           </td> -->
         </tr> 
         <?php
         
       }
       
       ?>
       
     </tbody>
     <tfoot>

     </style>
     <tr>
      <td colspan="4"></td>
      <!-- <td align="right">Total Due: <?php echo number_format($total_due,2,'.','')?> </td> -->
      <td align="right"> <?php echo number_format($total_com,2,'.','')?> </td>
      <td align="right"> <?php echo number_format($paid_com,2,'.','')?> </td>

      <td></td>
      <td></td>


    </tr>
  </tfoot>
</table>





</div>
</div>
<!-- cart one end -->



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