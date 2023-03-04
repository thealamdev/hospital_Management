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
          <div class="card-title">Ipd Advance Payment</div>
          <form method="POST" action="admin/ipd_adv_pay_daywise_report" target="_blank">
           <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputEmail4" class="col-form-label">Start Date</label>

              <div class="input-group ml-3">
                <input type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
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
                data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
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
        <hr/>

        <table id="test_table" class="table table-bordered table-hover table-striped test_table_report">
          <thead>
            <tr>
              <th>SL NO</th>
              <th>Patient ID</th>
              <th>Invoice No</th>
              <th>Patient Name</th>
              <th>Advance Amount</th>
              <th>Date</th>
              <th>Operator</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;
            $total_adv=0;

            foreach ($ipd_adv_pay as $key => $value) {

              $total_adv+=$value['advance_payment'];

              ?>
              <tr>
               <td><?=$i?></td>
               <td><?=$value['patient_info_id']?></td>
               <td><?=$value['invoice_order_id']?></td>
               <td><?=$value['patient_name']?></td>
               <td align="right"><?=$value['advance_payment']?></td>
               <td align="right"><?=date('d-M-Y h:i a',strtotime($value['created_at']))?></td>
               <td align="right"><?=$value['operator_name']?></td>

             </tr>

             <?php $i++;
           }?>

         </tbody>
         <tfoot>

           <tr>
            <td align="right" colspan="4">Total</td>
            <td align="right"><?=$total_adv?></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <div class="control-sidebar-bg shadow white fixed"></div>
</div>

<?php $this->load->view('back/footer_link');?>




</body>
</html>