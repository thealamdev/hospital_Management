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
         <div class="card-title">Date Wise Due Collection Report</div>
         <form method="POST" action="admin/outdoor_due_collection_report_date_wise" target="_blank">
           <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputEmail4" class="col-form-label">Start Date</label>
              <label for="inputEmail4" class="col-form-label">Start Date</label>
              <div class="input-group ml-3">
                <input type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' value="" autocomplete="off" required="" />
                <span class="input-group-append">
                  <span class="input-group-text add-on white">
                    <i class="icon-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="inputEmail4" class="col-form-label">End  Date</label>
              <label for="inputEmail4" class="col-form-label">End Date</label>
              <div class="input-group ml-3">
                <input type="text" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' value="" autocomplete="off" required="" />
                <span class="input-group-append">
                  <span class="input-group-text add-on white">
                    <i class="icon-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
			<!-- 	 <div class="form-group col-md-3">
                                        
                                     <label for="inputEmail4" class="col-form-label">Paid Status</label>
              <select class="custom-select select2" name="paid_status">
                          <option value="1">All</option>
                         <option value="2">Paid</option> 
                         <option value="3">Unpaid</option>    						 
                    </select> 
                  </div> -->
                  <div class="form-group col-md-3"> 
                    <label for="inputEmail4" class="col-form-label"></label>
                    <label for="inputEmail4" class="col-form-label"></label>
                    <div class="input-group ml-3">
                      <button type="submit" class="btn btn-success">Search</button>

                    </div>

                  </div>

                </div>
              </form> 
              <hr/>


              <h4 align="center">Today Due Collection Report</h4>

            </div>
          </div>

          <div class="card my-3 no-b">
            <div class="card-body">

              <table id="test_table" class="table table-bordered table-hover test_table_report"
              >
              <thead>
                <tr>
                  <th>SL NO</th>

                  <th>Patient Id</th>
                  <th>Imvoice Id</th>
                  <th>Patient Name</th>

                  <th>Total Amount</th>
                  <th>Due Collection</th>
                  <th>Details</th>
                  <th>Date & Time</th>
                  <!-- <th>Others Day Collection</th> -->
                  <!-- <th>Due</th> -->
                  <th>Operator Name</th>

                  <!-- <th style="width:10%;">Details</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $i=1;
                $total_due_c=0;
                $total_due=0;
                $total_others_day_collection=0;

                foreach($due_collection_info as $key => $value1)
                {
                  $total_due_c+=$value1['paid_due'];

                  $total_due+=$value1['total_amount']-$value1['paid_amount'];
                  $total_others_day_collection+=$value1['total_amount']-(($value1['total_amount']-$value1['paid_amount'])+$value1['paid_due']);

                  

                  ?>
                  <tr>
                   <td><?=$i++?></td>

                   <td><?=$value1['patient_info_id']?></td>
                   <td><?=$value1['test_order_id']?></td>
                   <td><?=$value1['patient_name']?></td>
                   <td align="right"><?=$value1['total_amount']?></td>
                   <td align="right"><?=$value1['paid_due']?></td>
                   <td><a target="_blank" href="admin/opd_each_billing_details/<?=$value1['patient_id']?>/<?=$value1['order_id']?>">Payment Details</a></td>

                   <!-- <td><?=$value1['total_amount']-(($value1['total_amount']-$value1['paid_amount'])+$value1['paid_due'])?></td> -->

                   <!-- <td><?=$value1['total_amount']-$value1['paid_amount']?></td> -->
                   <td><?=date("d-m-Y h:i:s a", strtotime($value1['c_at']))?></td>
                   <td><?=$value1['o_name']?></td>

                 </tr> 
                 <?php


               }
               ?>

             </tbody>

             <tfoot style="background:#ccc;font-weight: bold;">

               <tr>
                 <td align="right" colspan="6">Total Due Collection : <?php echo $total_due_c?></td>
                 <!-- <td align="right">Total Other Day Collection: <?php echo $total_others_day_collection?></td> -->
                 <!-- <td>Total Due: <?php echo $total_due?></td> -->
                 <td></td>
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