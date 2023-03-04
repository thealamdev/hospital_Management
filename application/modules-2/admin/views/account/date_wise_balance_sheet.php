<?php $this->load->view('back/header_link'); ?>
<body class="light">  
 <!-- Pre loader -->
 <?php $this->load->view('back/loader'); ?>

 <?php 
 $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
 $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
 ?>



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

    <form class="form-inline" method="POST" action="admin/date_wise_balance_sheet_report" target="_blank">


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
                 data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
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
               data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
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

 <div align="right"><button id="btn_print" onclick="print_page1('balance_div')" style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>

 <div class="card my-3 no-b" id="balance_div">
   <div class="card-body">

     <div class="row pl-5 pr-5" id="header_div">
       <div class="col-md-2">
        <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
      </div>      
      <div class="col-md-8">

       <?=$hos_head_report?>
     </div> 


     <div class="col-md-12" style="border-bottom:#000 solid 1px">
     </div>
   </div>    <br>



   <?php   
   if($cat=='opd' || $cat=='acc'){ ?>

    <!-- Outdoor Balance Sheet -->

    <h3 align="center">Today Outdoor Balance Sheet (<?=date('d-m-Y')?>)</h3><br>



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
      <?php

      $total_n_i=0;
      $due=0;

      $total_n_i+=$outdoor_total_amount[0]['total_amount']+$outdoor_vat_income[0]['vat']-$outdoor_discount_expense_today[0]['discount'];

      $due=$total_n_i-$outdoor_total_paid_today[0]['paid_due'];
      ?>

      <tr>
        <td align="left">1</td>
        <td align="left">Outdoor Total Test Price</td>
        <td align="right"><?=number_format($outdoor_total_amount[0]['total_amount'], 2, '.', '');?></td>

      </tr>

      <tr>
       <td align="left">2</td>
       <td align="left">Outdoor Total Vat (+)</td>
       <td align="right"><?=number_format($outdoor_vat_income[0]['vat'], 2, '.', '');?></td>

     </tr> 


     <tr>
       <td align="left">3</td>
       <td align="left">Outdoor Total Discount (-)</td>
       <td align="right"><?=number_format($outdoor_discount_expense[0]['discount'], 2, '.', '');?></td>

     </tr> 

     <tr>
       <td align="left">4</td>
       <td align="left" >Outdoor Due(-)</td>
       <td align="right" ><?=number_format($due, 2, '.', '');?></td>

     </tr> 
     <tr>
      <td></td>
      <td></td>
      <td></td>
    </tr>

    <tr >
      <td align="left">5</td>
      <td align="left">Outdoor Current Collection</td>
      <td align="right"><?=number_format($outdoor_total_paid[0]['paid_due'], 2, '.', '');?></td>

    </tr>



    <tr >
      <td align="left">6</td>
      <td align="left">Outdoor Due Collection(+)</td>
      <td align="right" style="border-bottom: 3px solid #000 !important;"><?=number_format($outdoor_due_collection[0]['paid_due'], 2, '.', '');?></td>

    </tr>

    <tr >
      <td align="left">7</td>
      <td align="left">Outdoor Total Collection</td>
      <td align="right"><?=number_format($outdoor_net_income[0]['paid_due'], 2, '.', '');?></td> 

    </tr>

    <tr>
     <td align="left">8</td>
     <td align="left">Outdoor Total Commission (-)</td>
     <td align="right" style="border-bottom: 3px solid #000 !important;"><?=number_format($outdoor_commission_expense[0]['paid_com'], 2, '.', '');?></td>

   </tr>

   <tr>
    <td align="left">9</td>
    <td align="left">Outdoor Total Net Cash In</td>
    <td align="right"><?=number_format($outdoor_net_income[0]['paid_due']-$outdoor_commission_expense[0]['paid_com'], 2, '.', '');?></td>

  </tr> 

  <tr>
    <td></td>
    <td></td>
    <td align="right">

     <h4 style="color: black;font-weight: bold;"> <?php

     if($outdoor_net_income[0]['paid_due']-$outdoor_commission_expense[0]['paid_com'] < 0){

       echo "(Minus) ";
       echo convertNumber(($outdoor_net_income[0]['paid_due']-$outdoor_commission_expense[0]['paid_com'])*(-1));

     } else {
      echo convertNumber($outdoor_net_income[0]['paid_due']-$outdoor_commission_expense[0]['paid_com']);
    }

  ?></h4>

</td>
</tr>

</tbody>
</table>

<?php } ?>

<?php if($cat=="ipd" || $cat=="acc") { ?>

 <!-- Indoor Balance Sheet -->

 <br><h3 align="center">Today Indoor Balance Sheet</h3><br>



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

  <?php

  $total_indoor_gross_income=0;
  $total_indoor_expense=0;
  $total_indoor_discount=0;
  $total_indoor_vat=0;
  $total_indoor_due=0;
  $total_indoor_current_collection=0;
  $total_indoor_due_collection=0;
  $total_indoor_net_cash_in=0;


  $total_n_i=0;
  $total_n_i+=($indoor_total_amount[0]['total_amount']-$indoor_total_adm_fee[0]['admission_fee']+$indoor_total_adm_fee_today_created[0]['admission_fee']+$indoor_vat_income_today[0]['vat'])-$indoor_discount_expense_today_only[0]['discount'];

  ?>
  <tr>
    <td align="left">1</td>
    <td align="left">Indoor Total Gross Income (including adm fee)</td>
    <td align="right"><?=number_format($indoor_total_amount[0]['total_amount']-$indoor_total_adm_fee[0]['admission_fee']+$indoor_total_adm_fee_today_created[0]['admission_fee'], 2, '.', '');?></td> 

    <?php $total_indoor_gross_income+=$indoor_total_amount[0]['total_amount']-$indoor_total_adm_fee[0]['admission_fee']+$indoor_total_adm_fee_today_created[0]['admission_fee'];?>

  </tr>

  <tr>
    <td align="left">2</td>
    <td align="left">Indoor Total Vat (+)</td>
    <td align="right"><?=number_format($indoor_vat_income[0]['vat'], 2, '.', '');?></td>

    <?php $total_indoor_vat+=$indoor_vat_income[0]['vat'];?>

  </tr> 


  <tr >
    <td align="left">3</td>
    <td align="left">Indoor Total Discount (-)</td>
    <td align="right"><?=number_format($indoor_discount_expense[0]['discount'], 2, '.', '');?></td>
    <?php $total_indoor_discount+=$indoor_discount_expense[0]['discount']+$operation_expense[0]['paid_cost'];?>

  </tr>

  <tr >
    <td align="left">4</td>
    <?php if($indoor_total_due[0]['current_due']>= 0){ ?>
     <td>Total Indoor Due (-)</td>
     <td align="right" ><?=number_format($indoor_total_due[0]['current_due']
     , 2, '.', '');?></td>

     <?php 

     $total_indoor_due+=($indoor_total_due[0]['current_due']);

   } else{ 

    $temp=($indoor_total_due[0]['current_due'])*(-1);
    ?>

    <td>Total Indoor Advance (+)</td>
    <td align="right" ><?=number_format($temp
     , 2, '.', '');?></td>


    <?php $total_indoor_due+=$total_n_i-$indoor_total_paid[0]['paid_due']; } 

    ?>
  </tr>

  <tr><td></td></tr>
  <tr><td></td></tr>

  <tr>
    <td align="left">5</td>
    <td align="left">Indoor Admission Fee Collection</td>
    <td align="right"><?=number_format($indoor_adm_fee_income_today[0]['admission_fee_paid'], 2, '.', '');?></td>

  </tr>

  <tr>
    <td align="left">6</td>
    <td align="left">Indoor Advance Fee Collection</td>
    <td align="right"><?=number_format($indoor_advance_payment[0]['advance_payment'], 2, '.', '');?></td>
  </tr>

<!--   <tr>
    <td align="left">7</td>
    <td align="left">Indoor Today Collection</td>
    <td align="right"><?=number_format($indoor_today_collection[0]['paid_due'], 2, '.', '');?></td>
  </tr>  -->

  <tr>
    <td></td>
    <td></td>
  </tr>

  <tr>
    <td align="left">7</td>
    <td align="left">Indoor Current Collection<br><span>(including adm & adv fee)</span></td>
    <td align="right"><?=number_format($indoor_net_income[0]['paid_due']-$indoor_due_collection[0]['paid_due'], 2, '.', '');?></td>

    <?php  $total_indoor_current_collection+= $indoor_net_income[0]['paid_due']-$indoor_due_collection[0]['paid_due'];  ?>
  </tr> 

  <tr>
    <td align="left">8</td>
    <td align="left">Indoor Due Collection</td>
    <td align="right" ><?=number_format($indoor_due_collection[0]['paid_due']-$indoor_due_admission_fee[0]['admission_fee_paid'], 2, '.', '');?></td>


    <?php $total_indoor_due_collection+=$indoor_due_collection[0]['paid_due'];
    ?>
  </tr>

  <tr>
    <td align="left">9</td>
    <td align="left">Indoor Due Admission Fee Collection</td>
    <td align="right" ><?=number_format($indoor_due_admission_fee[0]['admission_fee_paid'], 2, '.', '');?></td>
  </tr>


  <tr>
    <td align="left">10</td>
    <td align="left">Total Collection</td>
    <td align="right" style="border-top: 3px solid #000 !important;"><?=number_format($indoor_net_income[0]['paid_due'], 2, '.', '');?></td>

  </tr>

  <tr>
    <td align="left">11</td>
    <td align="left">Total Operation Cost Paid</td>
    <td align="right" style="border-bottom: 3px solid #000 !important;"><?=number_format($operation_expense[0]['paid_cost'], 2, '.', '');?></td>

    <?php $total_indoor_expense+=$operation_expense[0]['paid_cost']?>
  </tr>


  <tr>
    <td align="left">12</td>
    <td align="left">Indoor Total Net Cash In</td>
    <td align="right"><?=number_format($indoor_net_income[0]['paid_due']-$operation_expense[0]['paid_cost'], 2, '.', '');?></td>

    <?php $total_indoor_net_cash_in+=$indoor_net_income[0]['paid_due']-$operation_expense[0]['paid_cost']; ?>

  </tr> 

  <tr>
    <td></td>
    <td></td>

    <td align="right">

     <h4 style="color: black;font-weight: bold;"> <?php

     if($indoor_net_income[0]['paid_due']-$operation_expense[0]['paid_cost'] < 0)
     { 

      echo "(Minus) ";
      echo convertNumber(($indoor_net_income[0]['paid_due']-$operation_expense[0]['paid_cost'])*(-1));
    }
    else {
      echo convertNumber($indoor_net_income[0]['paid_due']-$operation_expense[0]['paid_cost']);
    }


  ?></h4>

</td>
</tr>
</tbody>
</table>



<h3 align="center" class="mb-3">Today Indoor Diagnostic Service</h3>

<table id="test_table" class="table table-bordered table-hover table-striped test_table_report"
>
<thead>
  <tr>
    <th><h5>SL</h5></th>
    <th><h5>Head Name</h5></th>
    <th><h5>Amount</h5></th>      
  </tr>
</thead>
<tbody>

  <?php

  $total_n_i=0;
  $due=0;

  $total_n_i+=$indoor_diag_total_amount[0]['total_amount']+$indoor_diag_vat_income_today[0]['vat']-$indoor_diag_discount_income_today[0]['discount'];
  $due=$total_n_i-$indoor_diag_total_paid[0]['total_paid'];

  ?>
  <tr>
    <td align="left">1</td>
    <td align="left">Indoor Diagnostic Service Total Gross Income</td>
    <td align="right"><?=number_format($indoor_diag_total_amount[0]['total_amount'], 2, '.', '');?>

    <?php $total_indoor_gross_income+=$indoor_diag_total_amount[0]['total_amount']; ?>
  </td>

</tr>

<tr>
  <td align="left">2</td>
  <td align="left">Indoor Diagnostic Service Total Vat (+)</td>
  <td align="right"><?=number_format($indoor_diag_vat_income[0]['vat'], 2, '.', '');?></td>

  <?php $total_indoor_vat+=$indoor_diag_vat_income[0]['vat']; ?>

</tr> 


<tr >
  <td align="left">3</td>
  <td align="left">Indoor Diagnostic Service Total Discount (-)</td>
  <td align="right"><?=number_format($indoor_diag_discount_expense[0]['discount'], 2, '.', '');?></td>

  <?php $total_indoor_discount+=$indoor_diag_discount_expense[0]['discount']; ?>

</tr> 


<tr>
  <td align="left">4</td>
  <td align="left">Indoor Diagnostic Service Total Due</td>
  <td align="right"><?=number_format($due, 2, '.', '');?></td>
</tr> 

<?php $total_indoor_due+=$due; ?>

<tr><td></td></tr>
<tr><td></td></tr>



<tr>
  <td align="left">5</td>
  <td align="left">Indoor Diagnostic Service Total Current Collection</td>
  <td align="right"><?=number_format($indoor_diag_total_paid[0]['total_paid'], 2, '.', '');?></td>

  <?php $total_indoor_current_collection+=$indoor_diag_total_paid[0]['total_paid']; ?>

</tr>

<tr >
  <td align="left">6</td>
  <td align="left">Indoor Diagnostic Service Total Due Collection</td>
  <td align="right" style="border-bottom: 3px solid #000 !important;"><?=number_format($indoor_diag_net_income[0]['paid_due']-$indoor_diag_total_paid[0]['total_paid'], 2, '.', '');?></td>

  <?php  
  $total_indoor_due_collection+=($indoor_diag_net_income[0]['paid_due']-$indoor_diag_total_paid[0]['total_paid']);

  ?>

</tr>


<tr>
  <td align="left">7</td>
  <td align="left">Indoor Diagnostic Service Total Net Cash In</td>
  <td align="right"><?=number_format($indoor_diag_net_income[0]['paid_due'], 2, '.', '');?></td>

  <?php  $total_indoor_net_cash_in+=$indoor_diag_net_income[0]['paid_due'];

  ?>

</tr> 


<tr>
  <td></td>
  <td></td>
  <td align="right">

   <h4 style="color: black;font-weight: bold;"> 

    <?php 
    if($indoor_diag_net_income[0]['paid_due'] < 0){

     echo "(Minus) ";
     echo convertNumber(($indoor_diag_net_income[0]['paid_due'])*(-1));

   } else {
    echo convertNumber($indoor_diag_net_income[0]['paid_due']);
  }
?></h4>

</td>
</tr>

</tbody>
</table>


<?php if($cat=="ipd") { ?>

  <br><h3 align="center">Today Indoor Summary</h3><br>

  <table id="test_table" class="table table-bordered table-hover table-striped test_table_report"
  >
  <thead>
    <tr>
      <th><h5>SL</h5></th>
      <th><h5>Info</h5></th>
      <th><h5>Amount</h5></th>   
    </tr>


  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Total Indoor Amount</td>
      <td align="right"><?=number_format($total_indoor_gross_income, 2, '.', '');?></td>

    </tr>

    <tr>
      <td>2</td>
      <td>Total Indoor Vat</td>
      <td align="right"><?=number_format($total_indoor_vat, 2, '.', '');?></td>

    </tr>

    <tr>
      <td>3</td>
      <td>Total Indoor Discount</td>
      <td align="right"><?=number_format($total_indoor_discount, 2, '.', '');?></td>

    </tr>

    <tr>
     <td>4</td>
     <td>Total Indoor Expense (-)</td>
     <td align="right"><?=number_format($total_indoor_expense, 2, '.', '');?></td>

   </tr>

   <tr>
     <td>5</td>


     <?php if($total_indoor_due > 0){ ?>

       <td>Total Indoor Due (-)</td>

       <td align="right"><?=number_format($total_indoor_due, 2, '.', '');?></td>

     <?php  } else { ?>

      <td>Total Indoor Advance (+)</td>

      <td align="right"><?=number_format($total_indoor_due*(-1), 2, '.', '');?></td>

    <?php  }?>


  </tr>

  <tr>
   <td>6</td>
   <td>Total Indoor Current Collection</td>
   <td align="right"><?=number_format($total_indoor_current_collection, 2, '.', '');?></td>

 </tr>

 <tr>
   <td>7</td>
   <td>Total Indoor Due Collection</td>
   <td align="right"><?=number_format($total_indoor_due_collection, 2, '.', '');?></td>

 </tr>


 <tr>
   <td>8</td>
   <td>Total Indoor Net Cash In</td>
   <td align="right"><?=number_format($total_indoor_net_cash_in, 2, '.', '');?></td>

 </tr>

 <tr>
  <td></td>
  <td></td>
  <td align="right">

    <h4 style="color: black;font-weight: bold;">

      <?php if($total_indoor_net_cash_in < 0){

       echo "(Minus) ";
       echo convertNumber(($total_indoor_net_cash_in)*(-1));

     } else {
      echo convertNumber($total_indoor_net_cash_in);
    }

  ?></h4>

</td>
</tr>


</tbody>
</table>
<?php } }?>

<?php if($cat=="acc" || $cat=="phar") {?>
 <br> <!-- Pharmacy Balance Sheet -->

 <h3 align="center">Today Pharmacy Balance Sheet</h3><br>



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
  <?php


  $total_n_i=0;
  $due=0;

  $total_n_i+=$pharmacy_total_amount[0]['credit']+$pharmacy_vat_income[0]['vat']-($pharmacy_discount_expense[0]['discount']+$pharmacy_supplier_expense[0]['paid_due']+$pharmacy_unload_expense[0]['unload_cost']);

  $due=$pharmacy_total_amount[0]['credit']+$pharmacy_vat_income[0]['vat']-($pharmacy_total_paid[0]['debit']+$pharmacy_discount_expense[0]['discount']);

                    // $total_due+=$due;

                    // $total_income+=$total_n_i;

                    // $total_collection+=$pharmacy_net_income[0]['paid_due'];

                    // $total_amount+=$pharmacy_total_amount[0]['credit'];

                    // $t_f_v+=$pharmacy_vat_income[0]['vat'];

                    // $t_f_d+=$pharmacy_discount_expense[0]['discount'];

                    // $t_f_e+=$pharmacy_supplier_expense[0]['paid_due']+$pharmacy_unload_expense[0]['unload_cost'];

  ?>
  <tr>
    <td align="left">1</td>
    <td align="left">Pharmacy Total Gross Income</td>
    <td align="right"><?=number_format($pharmacy_total_amount[0]['credit'], 2, '.', '');?></td>

  </tr>

  <tr>
    <td align="left">2</td>
    <td align="left">Pharmacy Total Vat (+)</td>
    <td align="right"><?=number_format($pharmacy_vat_income[0]['vat'], 2, '.', '');?></td>

  </tr> 


  <tr>
    <td align="left">3</td>
    <td align="left">Pharmacy Total Discount (-)</td>
    <td align="right"><?=number_format($pharmacy_discount_expense[0]['discount'], 2, '.', '');?></td>

  </tr> 
          <!--  <tr >
              <td align="left">Pharmacy Total Commission (-)</td>
              <td align="right"><?=number_format(0, 2, '.', '');?></td>
           
            </tr> -->

            <tr >
              <td align="left">4</td>
              <td align="left">Pharmacy Total Supplier Expense (-)</td>
              <td align="right"><?=number_format($pharmacy_supplier_expense[0]['paid_due']-$pharmacy_unload_expense[0]['unload_cost'], 2, '.', '');?></td>

            </tr>


            <tr>
              <td align="left">5</td>
              <td align="left">Pharmacy Total Unload Cost (-)</td>
              <td align="right"><?=number_format($pharmacy_unload_expense[0]['unload_cost'], 2, '.', '');?></td>

            </tr>


            <tr>
              <td align="left">6</td>
              <td align="left">Pharmacy Total Due (-)</td>
              <td align="right" style="border-bottom: 3px solid #000 !important;"><?=number_format($due, 2, '.', '');?></td>

            </tr>

        <!--    <tr style="border-bottom: 3px solid #000 !important;">
              <td align="left">Pharmacy Total Other Expense (-)</td>
             <td align="right"><?=number_format(0, 2, '.', '');?></td>
           
           </tr>   -->

           <tr>
            <td align="left">7</td>
            <td align="left">Pharmacy Current Collection</td>
            <td align="right"><?=number_format($pharmacy_total_paid[0]['debit']-$pharmacy_supplier_expense[0]['paid_due'], 2, '.', '');?></td>

          </tr> 


          <tr>
            <td align="left">8</td>
            <td align="left">Pharmacy Due Collection(+)</td>
            <td align="right"><?=number_format($pharmacy_net_income[0]['paid_due']-$pharmacy_total_paid[0]['debit'], 2, '.', '');?></td>

          </tr>

          <tr>
            <td align="left">9</td>
            <td align="left">Pharmacy Purchase Return(+)</td>
            <td align="right"><?=number_format($total_purchase_return_paid[0]['total_paid'], 2, '.', '');?></td>

          </tr>

          <tr>
            <td align="left">10</td>
            <td align="left">Pharmacy Sales Return(-)</td>
            <td align="right" style="border-bottom: 3px solid #000 !important;"><?=number_format($total_sales_return_paid[0]['total_paid'], 2, '.', '');?></td>

          </tr>

          <!--  <tr>
            <td align="left">7</td>
              <td align="left">Pharmacy Total Collection</td>
             <td align="right" style="border-bottom: 3px solid #000 !important;"><?=number_format($pharmacy_net_income[0]['paid_due'], 2, '.', '');?></td>
           
           </tr> -->

<!--            <tr>
            <td align="left">9</td>
            <td align="left">Pharmacy Net Cash In</td>
            <td align="right" ><?=number_format($pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due'], 2, '.', '');?></td>

          </tr>
        -->




        <?php if($pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due']-$total_sales_return_paid[0]['total_paid']+$total_purchase_return_paid[0]['total_paid'] < 0){?>

         <tr>
          <td align="left">11</td>
          <td align="left"><span style="color: red;">Pharmacy Net Loss</span></td>
          <td align="right" ><?=number_format($pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due']-$total_sales_return_paid[0]['total_paid']+$total_purchase_return_paid[0]['total_paid'], 2, '.', '');?></td>

        </tr>

      <?php  } else { ?>
       <tr>
        <td align="left">11</td>
        <td align="left"><span style="color: green;">Pharmacy Net Cash In</span></td>
        <td align="right" ><?=number_format($pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due']-$total_sales_return_paid[0]['total_paid']+$total_purchase_return_paid[0]['total_paid'], 2, '.', '');?></td>

      </tr>
    <?php   }

    ?>

    <?php if($pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due']-$total_sales_return_paid[0]['total_paid']+$total_purchase_return_paid[0]['total_paid'] < 0){?>

      <tr>
        <td></td>
        <td></td>
        <td align="right"><h4 style="color: black;font-weight: bold;"><?=convertNumber($pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due']-$total_sales_return_paid[0]['total_paid']+$total_purchase_return_paid[0]['total_paid']);?></h4></td>

      </tr>

    <?php  } else { ?>
     <tr>
      <td></td>
      <td></td>
      <td align="right"><h4 style="color: black;font-weight: bold;"><?=convertNumber($pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due']-$total_sales_return_paid[0]['total_paid']+$total_purchase_return_paid[0]['total_paid']);?></h4></td>

    </tr>
  <?php   }

  ?>

          <!-- <tr>
            <td align="left">7</td>
              <?php if($due < 0){?>
                <td align="left">Net Advance</td>
             <td align="right"><?=number_format((-1)*$due, 2, '.', '');?></td>
           <?php } else { ?>
              <td align="left">Net Due</td>
             <td align="right"><?=number_format($due, 2, '.', '');?></td>
           <?php } ?>
           
         </tr>  -->




       </tbody>
     </table>

   <?php } 

   ?>

   <!-- others income-->

   <?php if($cat=="acc" || $cat=="income") { ?>

     <br><h3 align="center">Today Others Income</h3><br>

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

     <?php

     $total_others_inc=0;
     foreach ($others_total_income as $key => $value) {

       $total_others_inc+=$value['total_paid'];
       ?>

       <tr>
        <td><?=$key+1?></td>
        <td align="left"><?=$value['acc_head_title']?> (+)</td>
        <td align="right"><?=number_format($value['total_paid'], 2, '.', '');?></td>
      </tr>

    <?php } ?>


  </tbody>
</table>

<?php } ?>
<!-- others Expense-->

<?php if($cat=="acc" || $cat=="expense") { ?>


 <br><h3 align="center">Today Others Expense</h3><br>



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

 <?php 
 $total_others_exp=0;

 foreach ($others_total_expense as $key => $value) {
  $total_others_exp+=$value['total_paid'];
  ?>

  <tr>
    <td><?=$key+1?></td>
    <td align="left"><?=$value['acc_head_title']?>(-)</td>
    <td align="right"><?=number_format($value['total_paid'], 2, '.', '');?></td>
  </tr>

<?php } ?>


</tbody>
</table>

<?php } ?>

<?php if($cat=="acc") { 

  $t_n_c=0

  ?>

  <br><h3 align="center">Today Summary</h3><br>

  <table id="test_table" class="table table-bordered table-hover table-striped test_table_report"
  >
  <thead>
    <tr>
      <th><h5>SL</h5></th>
      <th><h5>Info</h5></th>
      <th><h5>Amount</h5></th>   
    </tr>


  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Total Net Cash In OPD</td>
      <td align="right"><?=number_format($outdoor_net_income[0]['paid_due']-$outdoor_commission_expense[0]['paid_com'], 2, '.', '');?></td>

      <?php $t_n_c+=$outdoor_net_income[0]['paid_due']-$outdoor_commission_expense[0]['paid_com']; ?>

    </tr>


    <tr>
      <td>2</td>
      <td>Total Net Cash In IPD</td>
      <td align="right"><?=number_format($indoor_net_income[0]['paid_due']-$operation_expense[0]['paid_cost'], 2, '.', '');?></td>

      <?php $t_n_c+=$indoor_net_income[0]['paid_due']-$operation_expense[0]['paid_cost']; ?>

    </tr>


    <tr>
      <td>3</td>
      <td>Total Net Cash In IPD Diagnostic Service</td>
      <td align="right"><?=number_format($indoor_diag_net_income[0]['paid_due'], 2, '.', '');?></td>

      <?php $t_n_c+=$indoor_diag_net_income[0]['paid_due']; ?>

    </tr>

    <tr>
      <td>4</td>
      <td>Total Net Cash In Pharmacy</td>
      <td align="right"><?=number_format($pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due']-$total_sales_return_paid[0]['total_paid']+$total_purchase_return_paid[0]['total_paid'], 2, '.', '');?></td>

      <?php $t_n_c+=$pharmacy_net_income[0]['paid_due']-$pharmacy_supplier_expense[0]['paid_due']-$total_sales_return_paid[0]['total_paid']+$total_purchase_return_paid[0]['total_paid']; ?>
    </tr>

    <tr>
     <td>5</td>
     <td>Total Others Income</td>
     <td align="right"><?=number_format($total_others_inc, 2, '.', '');?></td>

     <?php $t_n_c+=$total_others_inc; ?>
   </tr>



   <tr>
     <td>6</td>
     <td>Total Hospital Collection</td>
     <td align="right" style="border-top: 2px solid #000 !important;"><?=number_format($t_n_c, 2, '.', '');?></td>

   </tr>

   <tr>
     <td>7</td>
     <td>Total Others Expense</td>
     <td align="right" style="border-bottom: 2px solid #000 !important;"><?=number_format($total_others_exp, 2, '.', '');?></td>
   </tr>

   <tr>
     <td>8</td>
     <td>Total Hospital Net Cash In</td>
     <td align="right"><?=number_format($t_n_c-$total_others_exp, 2, '.', '');?></td>
   </tr>



   <tr>
    <td></td>
    <td></td>
    <td align="right">

     <h4 style="color: black;font-weight: bold;"> 
      <?php
      if($t_n_c-$total_others_exp < 0){

       echo "(Minus) ";
       echo convertNumber($t_n_c-$total_others_exp*(-1));

     } else {
      echo convertNumber($t_n_c-$total_others_exp);
    }
  ?></h4>

</td>
</tr>



</tbody>
</table>

<?php } ?>

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

  <style type="text/css">
    .test_table_report tr td
    {
      font-size: 14px !important;
    }
  </style>
  <?php $this->load->view('back/footer_link');?>

  <script>
    $(document).ready(function(){

      $('#header_div').hide();

    });

    function print_page1(divName) {
      $('#header_div').show();
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }

    window.onafterprint = function(){
      location.reload();
    };

  </script>
</body>
</html>