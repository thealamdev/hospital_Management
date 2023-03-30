<?php $this->load->view('back/header_link'); ?>
<body class="light">
 <!-- Pre loader -->
 <?php $this->load->view('back/loader'); ?>
 <div  id="app">
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

 <?php if($date=="show") {?>
  <div class="card my-3 no-b">
    <div class="card-body">



      <form method="POST" action="admin/opd_today_com_list/<?=$flag?>/search" target="_blank">
        <div class="form-row">
          <div class="form-group col-md-3">

           <label for="inputEmail4" class="col-form-label">Start Date</label>
           <div class="input-group ml-3">
            <input type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
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
        <label for="inputEmail4" class="col-form-label"></label>
        <label for="inputEmail4" class="col-form-label"></label>
        <div class="input-group ml-3">
          <button type="submit" class="btn btn-success">Submit</button>

        </div>

      </div>

    </div>
  </form> 




</div>
</div>

<?php } ?>
<div class="card my-3 no-b">
 <div class="card-body">
  <h4 align="center" class="mb-3">Today Commission Details List</h4>
  <div class="container">
   <div class="invoice white shadow">
    <div class="row pl-5 pr-5">

      <?php   
      $total_commission=0;
      $com_paid=0;

      if($total_com_info!=null && $total_com!=null){

        foreach ($total_com as $key => $value) { 
          $i=1; ?>

          <div class="col-12 mt-2">
            <table class="table table-bordered table-hover test_table_report">
             <tbody>
              <tr>
               <td>Booked By: </td>
               <td><?=$value['operator_name']?></td>
             </tr>
             <tr>
               <td>Doctor Name: </td>
               <td><?=$value['doc_name']?></td>
             </tr>
             <tr>
               <td>Ordered Date: </td>
               <td><?=date('d M,Y h:i a',strtotime($value['created_at']))?></td>
             </tr>
             <tr>
               <td>Order Id: </td>
               <td><?=$value['test_order_id']?></td>
             </tr>
           </tbody>
         </table>
       </div>

       
       <div class="col-12 mt-2">

        <form action="admin/com_update_payment/<?=$value['id']?>/today/<?=$flag?>" method="POST"> 

          <table class="mt-4 table table-bordered table-striped test_table_report">
            <thead>
              <th>SL NO</th>
              <th>Test Name</th>
              <th>Test Price</th>
              <th>Total Commission</th>
              <th>Per Test Discount <br> (Total Test Discount / No of Test)</th>
              <th>Net Commission <br> (Total Commission - Per Test Discount)</th>

            </thead>
            <tbody>
             <?php 

        
             foreach ($total_com_info as $key1 => $value1) { 


               if($value['d_id']==$value1['com_id']){

                ?>
                
                <tr> 
                  <td align="center"><?=$i?></td>
                  <td align="center"><?=$value1['sub_test_title']?></td>
                  <td align="center"><?=$value1['price']?></td>
                  <td align="right"><?=number_format($value1['gross_amount'],2,'.','')?> &#x9f3</td>
                  <td align="center"><?=number_format($value1['sub_amount'],2,'.','')?></td>
                  <td align="right"><?=number_format($value1['amount'],2,'.','')?> &#x9f3</td>

                </tr>
                <?php   

              $i++; }  }

              ?>


              <?php

                $total_commission+=$value['total_commission'];
                $com_paid+=$value['paid_amount'];

              ?>

              <tr><td colspan="5" align="right">Total</td><td id="total" align="right"><?=number_format($value['total_commission'],2,'.','')?> &#x9f3</td></tr>

              <tr><td colspan="5" align="right">Total Paid</td><td align="right"><?php echo number_format($value['paid_amount'],2,'.','')?> &#x9f3</td></tr>



              <tr>
                <td colspan="5" align="right">Due</td>
                <td colspan="5" align="right">
                  <input style="text-align: right" name="due" id="due" onkeyup="addinput();" value="<?=number_format($value['total_commission']-$value['paid_amount'],2,'.','')?>" class="form-control" readonly></td>
                </tr>

                <?php if($value['total_commission'] > $value['paid_amount']) { ?>          


                <?php } ?>

              </tbody>
            </table>

          </form>

        </div>
        
      <?php }  ?>


      <?php $i=1; }  else { ?>

       <div style="margin:0 auto;">
        <h3 style="font-weight:bold; text-align: center">No Data Available</h3>
      </div>

    <?php } ?>




  </div>
</div>
</div>
</div>
</div>



   </tbody>
 </table>
</div>
</div>
</div>
</div>

</div>

</div>


<?php $this->load->view('back/footer_link');?>
</body>
</html>