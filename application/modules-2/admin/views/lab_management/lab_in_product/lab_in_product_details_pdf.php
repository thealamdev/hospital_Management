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

  <div style="  margin: 0 auto;" class="container">

    <div  class="row">

      <table class="farhana-table-1">
        <tr>
          <td class="farhana-table-1-col-1">
            <img height="60px" width="60px" src="uploads/hospital_logo/<?=$hos_logo?>">
          </td>
          <td>
           <h1 class="" style="margin-bottom: 2px; font-size: 20px; text-align: center;margin-left: 5px;">
             <?=$hospital_title_eng_report?>
           </h1>

           <h1 style="margin-top: 0px; font-size: 16px; text-align: center;margin-left: 5px;">
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


 <table style="padding-top:20px;  margin-left:5px; width:230px; text-align: center;font-size:12px ">
  <tr>
   <th style="text-align: left"><b>Bill No :</b> <span style="font-weight:normal"><?=$buy_details[0]['bill_no'];?></span></th>
 </tr>

 <tr>
   <th style="text-align: left"><b>Supplier Name :</b> <span style="font-weight:normal"><?=$buy_details[0]['supp_name'];?></span></th>
 </tr>

 <tr>
   <th style="text-align: left">Purchage Code: <span style="font-weight:normal"><?=$buy_details[0]['buy_code'];?></span></th>
 </tr>

 <tr>
   <th style="text-align: left">Date: <span style="font-weight:normal"><?=date('d M,Y h:i a',strtotime($buy_details[0]['created_at']))?></span></th>
 </tr>

</table>

<div class="static-data">

 <table style="text-align:center; border-collapse: collapse;font-size: 12px; width:400px; margin-left:10px; margin-top:20px;margin-bottom:20px" class="table">
  <thead>
    <tr>
      <th style="padding:0px!important;border: #000 solid 1px;">SL</th>
      <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Product Name</th>
      <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Qty</th>
      <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="right" >Price</th>
      <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="right" >Price*Qty</th>

    </tr>
  </thead>
  <tbody>
   <?php foreach ($buy_details as $key => $row) { ?>
     <tr>
       <td align="" style="border: #000 solid 1px;"><?=$key+1;?></td>
       <td align="" style="padding:0px!important;border: #000 solid 1px;"><?=$row['p_name'];?></td>
       <td align="" style="border: #000 solid 1px;"><?=$row['buy_qty'];?>&nbsp;<?=$row['unit'];?>
     </td>
     <td align="" style="border: #000 solid 1px;"><?=number_format($row['buy_price'],2);?>&nbsp;৳ 
     </td>
     <td align="" style="border: #000 solid 1px;"><?=number_format(($row['buy_price']*$row['buy_qty']),2);?>&nbsp;৳ 
     </td>
   </tr>
 <?php } ?>
</tbody>
</table>



<div style=" padding-bottom:10px" class="row">
 <table style="padding-top:20px;  margin-left:5px; width:170px; text-align: center;font-size:12px ">
  <tr>
   <th style="text-align: left"><b>Remarks</b></th>
 </tr>
 <tr>
   <th style="text-align: left"><b>User : </b><span style="font-weight:normal"><?=$row['operator_name']?></span></th>
 </tr>
 <tr>
   <th style="text-align: left"><b>Payment Status : </b> <span style="font-weight:normal"><?php
   $due= $row['cost_total']-$row['debit'];
                         // echo $due;
   if($due<=0)
   {
     $dst="<span style='font-weight:bold'>PAID</span>";
   }
   else
   {
     $dst="<span style='font-weight:bold'>UNPAID</span>"; 
   }
   echo $dst;
   ?></span>
 </th>
</tr>
</table>

<table style="padding-top: 20px;
margin-left: 186px;
margin-top: -100px;
width: 240px;
text-align: center;
font-size: 12px;" cellpadding="0px" cellspacing="0px">
<tr>
  <th style="text-align: left"><b>Total Amount </b></th>
  <td style="text-align: left">  : <?=number_format($row['credit'],2);?>&nbsp;৳</td>
</tr>
<tr>
  <th style="text-align: left"><b>Unload Cost (+)</b></th>
  <td style="text-align: left">: <?=number_format($row['unload_cost'],2);?> &#x9f3</td>
</tr>
<tr>
  <th style="text-align: left"><b>Net Total</b>  </th>
  <td style="text-align: left">:  <?=number_format($row['cost_total'],2);?>&nbsp;৳</td>
</tr>
<tr>
  <th style="text-align: left;border-bottom:1px solid #ebebeb;"><b>Amount Paid</b></th>
  <td style="text-align: left">  :  <?=number_format($row['debit'],2);?> &#x9f3</td>
</tr>
<tr>
  <th style="text-align: left;border-bottom:1px solid #ebebeb;"><b>Due</b></th>
  <td style="text-align: left">  :  <?=number_format($row['cost_total']-$row['debit'],2);?> &#x9f3</td>


</tr>

</table>


</div>
<table style=" margin-top:200px; width:400px;padding-left:10px;   text-align: center;font-size:9px  ">
 <tr>
  <th style="text-align: left;font-size: 9px;
  line-height: 1.5;">Developed By Softwareparkbd &Rcreation 
  <br>01813322678,01816306190 <br><?php echo date('l jS \of F Y h:i:s A')?>
</th>
</tr>
</table>
</div>
</div>

  <script type="text/javascript">
  setTimeout(function() { 
    window.print();
    self.close();
  }, 1000);
</script>

</body>
</html>