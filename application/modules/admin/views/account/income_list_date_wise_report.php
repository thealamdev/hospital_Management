 <?php $this->load->view('back/header_link'); ?>
 <body>
   <!-- Pre loader -->
   <?php $this->load->view('back/loader'); ?>
   <?php 
   $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
   $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
   ?> 
   <div align="center"><button id="btn_print" onclick="print_page('app')" style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>


   <div id="app" style="color:#000;">
    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="">
             <div class="row pl-5 pr-5">
               <div class="col-md-2">
                <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
              </div>      
              <div class="col-md-9">

               <?=$hos_head_report?>
             </div> 
             <div class="col-md-12" style="border-bottom:#000 solid 1px"></div>
           </div>
           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">
             <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report From <?php echo $from_date?> to <?php echo $end_date?> </p>

             <?php if($flag=="all"){ 

              foreach ($acc_head_income as $key => $head) { ?>



               <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$head['acc_head_title']?></p>

               <table id="test_table" class="table table-bordered table-hover test_table_report"
               >
               <thead>
                 <tr>
                  <th>SL NO</th>
                  <th>Acc. Head</th>
                  <th>Code</th>
                  <th>Challan No</th>
                  <th style="width: 30%">Purpose</th>
                  <th>Reference</th>
                  <th>Paid By</th>
                  <th>Total Paid</th>
                  <th>Date</th>
                  <th>Operator</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
               <?php
               $i=1;
               $t_paid=0;

               foreach ($acc_head as $key => $value) {

                if($value['head_id']==$head['head_id']){

                  $t_paid+=$value['total_paid']

                  ?>

                  <tr>
                    <td><?=$i++?></td>
                    <td><?=$value['acc_head_title']?></td>

                    <td><?=$value['acc_head_code']?></td>
                    <td><?=$value['challan_no']?></td>
                    <td><?=$value['income_expense_purpose']?></td>
                    <td><?=$value['inc_exp_ref']?></td>
                    <td><?php
                    if($value['paid_by']==1)
                    {
                      echo 'Cash';
                    }
                    else if($value['paid_by']==2)
                    {
                      echo 'Check';
                    }
                    else 
                    {
                      echo 'Bank';
                    }

                    ?></td>

                    <td><?=$value['total_paid']?></td>
                    <td><?=date('d-m-Y h:i:s a', strtotime($value['created_at']))?></td>
                    <td><?=$value['operator_name']?></td>
                    <td><span><a href="admin/edit_income/<?=$value['id']?>">Edit</a></span><span class="ml-3"><a href="admin/delete_income/<?=$value['id']?>">Delete</a></span></td>
                  </tr>


                <?php    } 


              }

              ?>

            </tbody>
            <tfoot>
             <tr>
              <td colspan="7"></td>
              <td>Total:<?=$t_paid?></td>
            </tr>
          </tfoot>
        </table>

      <?php  } } else {
        ?>

    <!--     <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$doc_name?> ( <?=$doc_degree?> ) ( <?=$doc_mobile_no?> )</p> -->


        <table id="test_table" class="table table-bordered table-hover test_table_report"
        >
        <thead>
         <tr>
          <th>SL NO</th>
          <th>Acc. Head</th>
          <th>Code</th>
          <th>Challan No</th>
          <th style="width: 30%">Purpose</th>
          <th>Reference</th>
          <th>Paid By</th>
          <th>Total Paid</th>
          <th>Date</th>
          <th>Operator</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
       <?php
       $i=1;
       $t_paid=0;

       foreach ($acc_head as $key => $value) {

          $t_paid+=$value['total_paid']

          ?>

          <tr>
            <td><?=$i++?></td>
            <td><?=$value['acc_head_title']?></td>

            <td><?=$value['acc_head_code']?></td>
            <td><?=$value['challan_no']?></td>
            <td><?=$value['income_expense_purpose']?></td>
            <td><?=$value['inc_exp_ref']?></td>
            <td><?php
            if($value['paid_by']==1)
            {
              echo 'Cash';
            }
            else if($value['paid_by']==2)
            {
              echo 'Check';
            }
            else 
            {
              echo 'Bank';
            }

            ?></td>

            <td><?=$value['total_paid']?></td>
            <td><?=date('d-m-Y h:i:s a', strtotime($value['created_at']))?></td>
            <td><?=$value['operator_name']?></td>
            <td><span><a href="admin/edit_income/<?=$value['id']?>">Edit</a></span><span class="ml-3"><a href="admin/delete_income/<?=$value['id']?>">Delete</a></span></td>
          </tr>


        <?php 


      }

      ?>

    </tbody>
    <tfoot>
     <tr>
      <td colspan="7"></td>
      <td>Total:<?=$t_paid?></td>
    </tr>
  </tfoot>
</table>

<?php } ?>

</div>

</div>
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