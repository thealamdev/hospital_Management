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
         <div class="card-title">Daywise Collection</div> 
         <form method="POST" action="admin/opd_daywise_amnt_collection_report/sum" target="_blank">
           <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputEmail4" class="col-form-label">Start Date</label>
              <div class="input-group ml-3">
                <input autocomplete="off" type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
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
                <input autocomplete="off" type="text" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                <span class="input-group-append">
                  <span class="input-group-text add-on white">
                    <i class="icon-calendar"></i>
                  </span>
                </span>
              </div>
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


        <hr>

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
              <th>Total C/O</th>
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
            $total_com_paid=0;
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
               <td><?=$value['total_commission']?></td>                 
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
             $total_com_paid+=$value['com_paid'];
             $total_com+=$value['total_commission'];
             $total_net_cash_in+=$value['paid_amount']-$value['com_paid'];
           }?>


         </tbody>


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