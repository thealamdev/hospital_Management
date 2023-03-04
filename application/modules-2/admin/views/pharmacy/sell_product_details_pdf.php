<base href="<?=base_url();?>"> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"> 
  <title>

  </title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="back_assets/money_receipt/css/google_api.css" rel="stylesheet"></link>

  <style>
    body{
     height: 700px!important;
     width: 500px!important;

     /* to centre page on screen*/
     margin:1px 0px;
     margin-left: auto;
     margin-right: auto;
     font-family:  serif;
   }
   .farhana-table-1-col-1{
    vertical-align: top;
  }
  .first-h1{
    font-size:18px;  
    color:#111111; 
    text-align: center; 
    font-weight: 600;
  }
  .first-p{
    font-size:15px;  
    color:#111111; 
    text-align: center; 
    margin-top: -13px;

  }
  .first-p-1{
    font-size:15px;  
    color:#111111!important; 
    text-align: center; 
    margin-top: -10px;
    font-family: 'BenchNine', sans-serif;

  }

  .farhana-table-2{
    width: 100%;
  }

  .table-1-col-1{
   width: 33%;
   text-align: center;
 }
 .table-1-col-1 p{

  font-weight: bold;
  text-align: center;
  font-size: 16px;
  text-decoration: underline;
}
.farhana-table-3 {
  margin:0 auto;
  width: 90%;
  margin-top: 10px;
  
}
.farhana-table-3 tr td{
  font-size: 12px;

}
.doctor-name{
  font-size: 10px;
}
.text-right{
  text-align: right;
}
.text-center{
  text-align: center;
}
.farhana-table-4 {

  width: 90%;
  margin:0 auto;
  margin-top: 10px;
  border-collapse: collapse;
  border:1px solid #111111;
  font-size: 12px;
}
.farhana-table-4 tr th{
  border: 1px solid #111111;
  border-collapse: collapse!important;
  text-align: center;
  padding: 2px;
  padding-left: 7px;
}
.farhana-table-4 tr th:nth-child(2){
  text-align: left;
  width: 55%;
}
.farhana-table-4 tr td:nth-child(2){
  text-align: left;
  width: 55%;
}
.farhana-table-4 tr td{
  border: 1px solid #111111;
  border-collapse: collapse!important;
  text-align: center;
  padding: 2px;
  padding-left: 7px;
}

.farhana-table-5{
  margin-top: 10px;
  width: 95%;
  margin-left: 8px;

}

.farhana-table-6{
  margin-top: 40px;
  width: 95%;
  margin:0 auto;

}
.farhana-table-5 tr td:nth-child(2){
  width: 25%!important;

}
.farhana-table-5 tr td:last-child{
 width: 25%!important;

}


.farhana-table-4-col-1{
  width: 10%;
}
.farhana-table-4-col-2{
  width: 50%;
}
.farhana-table-4-col-3{
  width: 22%;
}
.farhana-table-5 tr td{

  font-size: 12px;

}

.tranform-text{
  font-size: 35px !important;
  font-weight: bold;
  transform: rotate(-30deg);
  text-align: center;
  vertical-align: middle;
  width: 57%;
}
.unit-class{
  font-size:12px;
  padding: 0px 0px;
}
.delivery{
  font-size:10px;
}
.last-p{
  padding: 4px;
  font-size: 10px;
  border:1px solid #111111;
  border-radius: 13px;
  width: 163px;
  margin:5px 0px;
}
.print{
  font-size: 9px;
}
.authorize{
  font-size:10px;
  text-decoration: overline;
  text-align: right;
}

</style>

</head>

<?php 
$hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
$hospital_title_eng_report=$this->session->userdata['logged_in']['hospital_title_eng_report'];
$hospital_title_ban_report=$this->session->userdata['logged_in']['hospital_title_ban_report'];
$address_report=$this->session->userdata['logged_in']['address_report'];
$others_report=$this->session->userdata['logged_in']['others_report'];
?>

<body style="color:#000; text-align: center;">

  <div style="margin: 0 auto;" class="container">

    <div  class="row">

      <table>
        <tr>
          <td class="farhana-table-1-col-1">
            <img style="margin-left: 15px;" height="60px" width="60px" src="uploads/hospital_logo/<?=$hos_logo?>">
          </td>
          <td>
           <h1 class="" style="margin-bottom: 2px; font-size: 20px; text-align: center;margin-left: 30px;">
             <?=$hospital_title_eng_report?>
           </h1>

           <h1 style="margin-top: 0px; font-size: 16px; text-align: center;margin-left: 30px;">
            <?=$hospital_title_ban_report?>
          </h1>

          <p class="first-p"><?=$address_report?></p>
          <p class="first-p-1"><?=$others_report?></p>
        </td>

      </tr>
    </table>


  </div>




  <table class="farhana-table-2">
    <tr>
     <td   class="table-1-col-1"></td>
     <td   class="table-1-col-1"><p >CASH RECEIPT</p></td>
     <td   class="table-1-col-1"></td>
   </tr>
 </table>
 <table style="padding-top:20px; float: left;  margin-left:5px; width:230px; text-align: center;font-size:15px;">
  <tr>
   <th style="text-align: left"><b>Customer Id :</b> <span style="font-weight:normal"><?=$sell_details[0]['cust_gen_id'];?></span></th>
 </tr>

 <tr>
   <th style="text-align: left"><b>Customer Name :</b> <span style="font-weight:normal"><?=$sell_details[0]['cust_name'];?></span></th>
 </tr>

 <tr>
  <th style="text-align: left">Sell Code: <span style="font-weight:normal"><?=$sell_details[0]['sell_code'];?></span></th>
</tr>

</table>

<table style="padding-top:20px;  margin-left:5px; width:230px; text-align: center;font-size:15px ">

  <?php if($opd_info != null) {?>
  <tr>
   <th style="text-align: left"><b>Opd Id :</b> <span style="font-weight:normal"><?=$opd_info[0]['patient_info_id'];?></span></th>
 </tr>
<?php } ?>

  <?php if($uhid_info != null) {?>
  <tr>
   <th style="text-align: left"><b>UHID:</b> <span style="font-weight:normal"><?=$uhid_info[0]['gen_id'];?></span></th>
 </tr>
<?php } ?>


<?php if($ipd_info != null) {?>

 <tr>
   <th style="text-align: left"><b>Ipd Id :</b> <span style="font-weight:normal"><?=$ipd_info[0]['patient_info_id'];?></span></th>
 </tr>

 <tr>
  <th style="text-align: left">Cabin No: <span style="font-weight:normal"><?=$ipd_info[0]['room_title'];?></span></th>
</tr>

<?php } ?>

<tr>
 <th style="text-align: left">Date: <span style="font-weight:normal"><?=date('d M,Y h:i a',strtotime($sell_details[0]['created_at']))?></span></th>
</tr>

</table>

<div class="static-data">

  <?php if($return_info == null) { ?>

   <table style=" border-collapse: collapse;font-size:15px; width:515px; margin-left:10px; margin-top:20px;margin-bottom:20px" class="table">
    <thead>
      <tr>
        <th style="padding:0px!important;border: #000 solid 1px;">SL</th>
        <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Product Name</th>
        <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Qty</th>
        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="right" >Price</th>
        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="right" >Price*Qty</th>
        <?php if($ipd_info != null) {?>
        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="right">Date</th>
      <?php } ?>

      </tr>
    </thead>
    <tbody>
     <?php foreach ($sell_details as $key => $row) { ?>
       <tr>
         <td align="center" style="border: #000 solid 1px;"><?=$key+1;?></td>
         <td align="center" style="padding:0px!important;border: #000 solid 1px;"><?=$row['p_name'];?></td>
         <td align="center" style="border: #000 solid 1px;"><?=$row['sell_qty'];?>&nbsp;<?=$row['unit'];?>
       </td>
       <td align="center" style="border: #000 solid 1px;"><?=number_format($row['sell_price'],2);?>&nbsp;৳ 
       </td>
       <td align="right" style="border: #000 solid 1px;"><?=number_format(($row['sell_price']*$row['sell_qty']),2);?>&nbsp;৳ 
       </td>
       <?php if ($row['type']==2){?>
       <td align="right" style="border: #000 solid 1px;"><?=date('d M Y', strtotime($row['c_date']))?>
      </td> 
    <?php } ?>
     </tr>
   <?php } ?>
 </tbody>
</table>



<div style=" padding-bottom:10px" class="row">
 <table style="padding-top:20px;  margin-left:5px; width:200px; text-align: center;font-size:15px;">
  <tr>
   <th style="text-align: left"><b>Remarks : </b></th>
 </tr>
 <tr>
   <th style="text-align: left"><b>User : </b><span style="font-weight:normal"><?=$row['operator_name']?></span></th>
 </tr>
 <tr>
   <th style="text-align: left"><b>Payment Status : </b> <span style="font-weight:normal"><?php
   $due= $row['net_total']-$row['debit'];
                         // echo $due;
   if($due<=0)
   {
     $dst="<span style='font-weight:bold;font-size:17px'>PAID</span>";
   }
   else
   {
     $dst="<span style='font-weight:bold;font-size:17px'>UNPAID</span>"; 
   }
   echo $dst;
   ?></span>
 </th>
</tr>
</table>

<table style="padding-top: 20px;
<?php if($ipd_info != null) {
  echo "margin-left: 230px;";
} else { 
   echo "margin-left: 322px;";
 } ?>
margin-top: -100px;
width: 240px;
text-align: center;
font-size: 15px;" cellpadding="0px" cellspacing="0px">
<tr>
  <th style="text-align: left"><b>Total Amount </b></th>
  <td style="text-align: left">  : <?=number_format($row['credit'],2);?>&nbsp;৳</td>
</tr>
<tr>
  <th style="text-align: left"><b>Discount (-)</b></th>
  <td style="text-align: left">: <?=number_format($row['discount'],2);?> &#x9f3</td>
</tr>
<tr>
  <th style="text-align: left"><b>Vat (+)</b></th>
  <td style="text-align: left">: <?=number_format($row['vat'],2);?> &#x9f3</td>
</tr>

<tr>
  <th style="text-align: left"><b>Net Total</b>  </th>
  <td style="text-align: left">:  <?=number_format($row['net_total'],2);?>&nbsp;৳</td>
</tr>

<tr>
  <th style="text-align: left;border-bottom:1px solid #ebebeb;"><b>Amount Paid</b></th>
  <td style="text-align: left">  :  <?=number_format($row['debit'],2);?> &#x9f3</td>
</tr>

<tr>
  <th style="text-align: left;border-bottom:1px solid #ebebeb;"><b>Due</b></th>
  <td style="text-align: left">  :  <?=number_format($due= $row['net_total']-$row['debit'],2);?> &#x9f3</td>


</tr>

</table>


</div>
<?php } else { ?>


 <table style="text-align:center; border-collapse: collapse;font-size: 12px; width:535px; margin-left:10px; margin-top:20px;margin-bottom:20px" class="table">
  <thead>
    <tr>
      <th style="padding:0px!important;border: #000 solid 1px;">SL</th>
      <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Product Name</th>
      <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Qty</th>
      <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Returned Qty</th>
      <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Current Qty</th>
      <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="right" >Price</th>
      <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="right" >Price*Qty</th>

    </tr>
  </thead>
  <tbody>
   <?php 
   $total_price=0;
   $total_ret_qty=0;
   $total_sell_qty=0;
   $discount_ret=0;
   $discount_per=0;


   foreach ($sell_details as $key => $row) { 

     $total_price=$total_price+($row['sell_qty']-$return_info[$key]['total_qty'])*$row['sell_price'];
     $total_ret_qty+=$return_info[$key]['total_qty'];
     $total_sell_qty+=$row['sell_qty'];
     ?>
     <tr>
       <td align="" style="border: #000 solid 1px;"><?=$key+1;?></td>
       <td align="" style="padding:0px!important;border: #000 solid 1px;"><?=$row['p_name'];?></td>
       <td align="" style="border: #000 solid 1px;"><?=$row['sell_qty'];?>&nbsp;<?=$row['unit'];?>
     </td>

     <td align="" style="border: #000 solid 1px;"><?=$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
   </td>

   <td align="" style="border: #000 solid 1px;"><?=$row['sell_qty']-$return_info[$key]['total_qty'];?>&nbsp;<?=$row['unit'];?>
 </td>


 <td align="" style="border: #000 solid 1px;"><?=number_format($row['sell_price'],2);?>&nbsp;৳ 
 </td>
 <td align="right" style="border: #000 solid 1px;"><?=number_format($row['sell_price']*($row['sell_qty']-$return_info[$key]['total_qty']),2);?>&nbsp;৳ 
 </td>
</tr>
<?php }   
$discount_per=$sell_details[0]['discount']/$total_sell_qty;
$discount_ret=($total_sell_qty-$total_ret_qty)*$discount_per;

$vat_per=$sell_details[0]['vat']/$total_sell_qty;
$vat_ret=($total_sell_qty-$total_ret_qty)*$vat_per; ?>
</tbody>
</table>



<div style=" padding-bottom:10px" class="row">
 <table style="padding-top:20px;  margin-left:5px; width:170px; text-align: center;font-size:12px ">
  <tr>
   <th style="text-align: left"><b>Remarks : </b></th>
 </tr>
 <tr>
   <th style="text-align: left"><b>User : </b><span style="font-weight:normal"><?=$row['operator_name']?></span></th>
 </tr>
 <tr>
   <th style="text-align: left"><b>Status : </b> <span style="font-weight:normal"><?php
   // $due= $row['net_total']-$row['debit'];

   if($total_price+$vat_ret-$discount_ret+$total_charge[0]['charge'] < $sell_details[0]['debit'])
   { 

     echo "<span style='font-weight:bold'>PAID & REFUND</span>"; 

   }
   else
   {
     echo "<span style='font-weight:bold'>UNPAID</span>"; 
   }
   ?>
 </th>
</tr>
</table>

<table style="padding-top: 20px;
<?php if($ipd_info != null) {
  echo "margin-left: 212px;";
} else { 
   echo "margin-left: 325px;";
 } ?>
margin-top: -100px;
width: 240px;
text-align: center;
font-size: 12px;" cellpadding="0px" cellspacing="0px">
<tr>
  <th style="text-align: left"><b>Total Amount </b></th>
  <td style="text-align: left">  : <?=number_format($total_price,2);?>&nbsp;৳</td>
</tr>
<tr>
  <th style="text-align: left"><b>Discount (-)</b></th>
  <td style="text-align: left">: <?=number_format($discount_ret,2);?> &#x9f3</td>
</tr>
<tr>
  <th style="text-align: left"><b>Vat (+)</b></th>
  <td style="text-align: left">: <?=number_format($vat_ret,2);?> &#x9f3</td>
</tr>

<tr>
  <th style="text-align: left"><b>Cancellation Charge (-)</b></th>
  <td style="text-align: left">: <?=number_format($total_charge[0]['charge'],2);?> &#x9f3</td>
</tr>

<tr>
  <th style="text-align: left"><b>Net Total</b>  </th>
  <td style="text-align: left">:  <?=number_format($total_price+$vat_ret-$discount_ret-$total_charge[0]['charge'],2);?>&nbsp;৳</td>
</tr>

<tr>
  <th style="text-align: left;border-bottom:1px solid #ebebeb;"><b>Amount Paid</b></th>
  <td style="text-align: left">  :  <?=number_format($sell_details[0]['debit'],2);?> &#x9f3</td>
</tr>

<?php if($total_price+$vat_ret-$discount_ret+$total_charge[0]['charge'] < $sell_details[0]['debit'])
{ ?>


  <tr>
   <th style="text-align: left"><b>Refundable</b></th>
   <td style="text-align: left"> : 
    <?=number_format($sell_details[0]['debit']-($total_price+$vat_ret-$discount_ret+$total_charge[0]['charge']),2);?>&nbsp;৳
  </td>
</tr>

<tr>

  <th style="text-align: left"><b>Total Refunded</b></th>

  <td style="text-align: left"> :
    <?=number_format($total_ret_paid[0]['total_paid'],2);?>&nbsp;৳
  </td>
</tr>

<tr>
  <th style="text-align: left"><b>Due</b></th>
  <td style="text-align: left"> :
    <?=number_format($sell_details[0]['debit']-($total_price+$vat_ret-$discount_ret+$total_charge[0]['charge'])-$total_ret_paid[0]['total_paid'],2);?>&nbsp;৳
  </td>
</tr>

<?php  } else { ?>


  <tr>
    <th style="text-align: left"><b>Due</b></th>
    <td style="text-align: left"> :
      <?=number_format($total_price+$vat_ret-$discount_ret-$total_charge[0]['charge']-$sell_details[0]['debit'],2);?>&nbsp;৳
    </td>
  </tr>

<?php  } ?>  


</table>


</div>
<?php }?>

<table style=" margin-top:200px; width:400px;padding-left:10px;   text-align: center;font-size:9px  ">
 <tr>
  <th style="text-align: left;font-size: 9px;
  line-height: 1.5;">Developed By Softwareparkbd 
  <br><?php echo date('l jS \of F Y h:i:s A')?>
</th>
</tr>
</table>

</div>


</div>


<script type="text/javascript">
 setTimeout(function() { 
  window.print();
}, 1000);
</script>

</body>
</html>