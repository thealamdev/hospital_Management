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

            <form class="form-inline" method="POST" action="admin/date_wise_due_collection_report" target="_blank">
                     
             
               <div class="row mb-10">
                  <!-- <div class="col-md-3">
                     <select class="custom-select select2 form-control" name="inc_exp" id="inc_exp" required>
                    <option value="0">Select Type</option>
                    <option value="1">Income</option>
                    <option value="2">Expense</option>
                </select>
                  </div> -->
               
                                       
                 
             <div class="col-md-4">
               
          

                     <div class="form-group mb-2">
                        <input type="hidden" value="<?=$cat?>" name="cat">
                       
                        <div class="input-group">
                           <input type="text" placeholder="From Date" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                              data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                           <span class="input-group-append">
                           <span class="input-group-text add-on white">
                           <i class="icon-calendar"></i>
                           </span>
                           </span>
                        </div>
                     </div>
                  </div>

                   <div class="col-md-4">
                     <div class="form-group mx-sm-3 mb-2">
                        
                        <div class="input-group">
                           <input type="text" placeholder="End Date" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                              data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                           <span class="input-group-append">
                           <span class="input-group-text add-on white">
                           <i class="icon-calendar"></i>
                           </span>
                           </span>
                        </div>
                     </div>
                  </div>
                   <div class="col-md-1">
                     <button type="submit" class="btn btn-success mb-2">Search</button>
                  </div>
                     </div>
                  </form>

               </div>
            </div>

            <div class="card my-3 no-b">
               <div class="card-body">

                                      <?php   
         
          $total_due=0;

         

          $total_n_i=0;
          $due=0;

         $total_n_i+=$outdoor_total_amount[0]['total_amount']+$outdoor_vat_income[0]['vat']-$outdoor_discount_expense[0]['discount']-$outdoor_commission_expense[0]['paid_com'];

          $due=$total_n_i-$outdoor_net_income[0]['paid_due'];

           $total_due+=$due;

           ?>
         
         

                    <!-- Outdoor Balance Sheet -->

                    <h3 align="center">Today Due Balance Sheet</h3><br>
         
         

                       <table id="test_table" class="table table-bordered table-hover table-striped test_table_report"
                       >
                    <thead>
                    <tr>
                      <th><h5>SL</h5></th>
                        <th><h5>Head Name</h5></th>
                        <th><h5>Amount</h5></th>      
         
                        <!-- <th style="width:10%;">Details</th> -->
                    </tr>
                    </thead>
                    <tbody>

          <tr>
            <td align="left">1</td>
              <td align="left">Outdoor Total Due</td>
              <td align="right"><?=number_format($due, 2, '.', '');?></td>
           
          </tr>


           <?php
         

          $total_n_i=0;
          $due=0;

         $total_n_i+=$indoor_total_amount[0]['total_amount']+$indoor_vat_income[0]['vat']-$indoor_discount_expense[0]['discount'];

          $due=$total_n_i-$indoor_net_income[0]['paid_due'];

         



          $total_n_i1=0;
          $due1=0;

          $total_n_i1+=$indoor_diag_total_amount[0]['total_amount']+$indoor_diag_vat_income[0]['vat']-$indoor_diag_discount_expense[0]['discount'];

          $due1=$total_n_i1-$indoor_diag_net_income[0]['paid_due'];

           $total_due+=$due+$due1;

          ?>

             <tr>
              <td align="left">2</td>
              <td align="left">Indoor Total Due</td>
              <td align="right"><?=number_format($due+$due1, 2, '.', '');?></td>
           
          </tr> 


           <?php
         

          $total_n_i=0;
          $due=0;

          $total_n_i+=$pharmacy_total_amount[0]['credit']+$pharmacy_vat_income[0]['vat']-$pharmacy_discount_expense[0]['discount']-$pharmacy_supplier_expense[0]['paid_due'];

          $due=$total_n_i-$pharmacy_net_income[0]['paid_due'];

          $total_due+=$due;

          ?>


           <tr>
            <td align="left">3</td>
              <td align="left">Pharmacy Total Due</td>
              <td align="right"><?=number_format($due, 2, '.', '');?></td>
           
          </tr> 
         

                    </tbody>

                    <tfoot>
                      <tr>
                        <td colspan="2">Total Due</td>
                        <td align="right"><?=number_format($total_due, 2, '.', '');?></td>
                      </tr>
                    </tfoot>

                  </table>
         
                  
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