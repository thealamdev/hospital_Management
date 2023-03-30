
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
           <div class="col-md-12" style="border-bottom:#000 solid 1px"></div>
         </div>
         <!-- Table row -->
         <div class="row pl-5 pr-5 my-3">
          <div class="col-12 table-responsive">
           <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report From <?php echo $from_date?> to <?php echo $end_date?> </p>

           <?php if($flag=="all"){ 

            foreach ($doc_info as $key => $doc_in) { ?>



             <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$doc_in['doctor_title']?> ( <?=$doc_in['doctor_degree']?> ) ( <?=$doc_in['doc_mobile_no']?> )</p>

             <table id="test_table" class="table table-bordered table-hover test_table_report"
             >
             <thead>
               <tr>
                <th>SL NO</th>
                <!-- <th>Group Name</th> -->
                <th>Patient Id</th>
                <th>Order Id</th>
                <th>Total Amount</th>
                <th>Total Vat</th>
                <th>Total Discount</th>
                <th>Net Amount</th>
                <th>Paid Amount</th>
                <th>Due</th>
                <th>Date</th>
                <th>Operator</th>
               
          
             <?php
             $i=1;

             $total_a=0;
             $total_v=0;
             $total_d=0;
             $total_n=0;
             $total_p=0;
             $total_due=0;
            

             foreach ($col_from_doc as $key => $value) {

              if($value['ref_doc_id']==$doc_in['doctor_id'] || $value['quack_doc_id']==$doc_in['doctor_id']){
               $total_a+=$value['total_amount'];
               $total_v+=$value['vat'];
               $total_d+=$value['discount'];
               $total_p+=$value['paid_due'];
               $total_n+=$value['total_amount']-$value['discount']+$value['vat'];
               $total_due+=($value['total_amount']-$value['discount']+$value['vat'])-$value['paid_due'];
               ?>

               <tr>
                <td><?=$i++?></td>
                <!-- <td><?=$value['test_title']?></td> -->
                <td><?=$value['patient_id']?></td>
                <td><?=$value['test_order_id']?></td>
                <td><?=number_format($value['total_amount'],2,'.', '')?></td>
                <td><?=number_format($value['vat'],2,'.', '')?></td>
                <td><?=number_format($value['discount'],2,'.', '')?></td>
                <td><?=number_format($value['total_amount']-$value['discount']+$value['vat'],2,'.', '')?></td>
                <td><?=number_format($value['paid_due'],2,'.', '')?></td>
                <td><?=number_format(($value['total_amount']-$value['discount']+$value['vat'])-$value['paid_due'],2,'.', '')?></td>

                <td><?=date('d-m-Y h:i:s a', strtotime($value['created_at']))?></td>
                <td><?=$this->session->userdata['logged_in']['username']?></td>
               

              </tr>
              <?php 

            } 


          }

          ?>

        </tbody>
        <tfoot>
         <tr>
          <td  align="center" colspan="3">Total</td>
          <td><?=number_format($total_a,2,'.', '')?></td>
          <td><?=number_format($total_v,2,'.', '')?></td>
          <td><?=number_format($total_d,2,'.', '')?></td>
          <td><?=number_format($total_n,2,'.', '')?></td>
          <td><?=number_format($total_p,2,'.', '')?></td>
          <td><?=number_format($total_due,2,'.', '')?></td>
          <td></td>
          <td></td>
          <td></td>
        </tr>
      </tfoot>
    </table>

  <?php  } } else {
    ?>

    <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$doc_name?> ( <?=$doc_degree?> ) ( <?=$doc_mobile_no?> )</p>
    <table id="test_table" class="table table-bordered table-hover test_table_report"
             >
             <thead>
               <tr>
                <th>SL NO</th>
                <!-- <th>Group Name</th> -->
                <th>Patient Id</th>
                <th>Order Id</th>
                <th>Total Amount</th>
                <th>Total Vat</th>
                <th>Total Discount</th>
                <th>Net Amount</th>
                <th>Paid Amount</th>
                <th>Due</th>
                <th>Date & Time</th>
                <th style="width:10%;">User Name:</th>
              </tr>
            </thead>
            <tbody>
             <?php
             $i=1;

             $total_a=0;
             $total_v=0;
             $total_d=0;
             $total_n=0;
             $total_p=0;
             $total_due=0;
            

             foreach ($col_from_doc as $key => $value) {

              if($value['ref_doc_id']==$doc_id || $value['quack_doc_id']==$doc_id){
               $total_a+=$value['total_amount'];
               $total_v+=$value['vat'];
               $total_d+=$value['discount'];
               $total_p+=$value['paid_due'];
               $total_n+=$value['total_amount']-$value['discount']+$value['vat'];
               $total_due+= ($value['total_amount']-$value['discount']+$value['vat'])-$value['paid_due'];
               ?>

               <tr>
                <td><?=$i++?></td>
                <!-- <td><?=$value['test_title']?></td> -->
                <td><?=$value['patient_id']?></td>
                <td><?=$value['test_order_id']?></td>
                <td><?=number_format($value['total_amount'],2,'.', '')?></td>
                <td><?=number_format($value['vat'],2,'.', '')?></td>
                <td><?=number_format($value['discount'],2,'.', '')?></td>
                <td><?=number_format($value['total_amount']-$value['discount']+$value['vat'],2,'.', '')?></td>
                <td><?=number_format($value['paid_due'],2,'.', '')?></td>
                 <td><?=number_format(($value['total_amount']-$value['discount']+$value['vat'])-$value['paid_due'],2,'.', '')?></td>

                <td><?=date('d-m-Y h:i:s a', strtotime($value['created_at']))?></td>
                <td><?=$this->session->userdata['logged_in']['username']?></td>
              </tr>
              <?php 

            } 


          }

          ?>

        </tbody>
        <tfoot>
         <tr>
          <td  align="center" colspan="3">Total</td>
          <td><?=number_format($total_a,2,'.', '')?></td>
          <td><?=number_format($total_v,2,'.', '')?></td>
          <td><?=number_format($total_d,2,'.', '')?></td>
          <td><?=number_format($total_n,2,'.', '')?></td>
          <td><?=number_format($total_p,2,'.', '')?></td>
          <td><?=number_format($total_due,2,'.', '')?></td>
          <td></td>
          <td></td>
          <td></td>
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