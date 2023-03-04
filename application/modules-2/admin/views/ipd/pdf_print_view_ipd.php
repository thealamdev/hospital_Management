<script type="text/javascript">
 setTimeout(function() { 
  window.print();
  // self.close();
}, 1000);
</script>

<base href="<?=base_url();?>">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"> 
  <title>

  </title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <!--====== STYLESHEETS ======-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <!--====== FONT AWSOME ======-->
  <link crossorigin="anonymous" href="/css/all.css" integrity="sha384-VY3F8aCQDLImi4L+tPX4XjtiJwXDwwyXNbkH7SHts0Jlo85t1R15MlXVBKLNx+dj" rel="stylesheet">
</link>
<link href="https://fonts.googleapis.com/css?family=BenchNine" rel="stylesheet"> 
</link>
</link>
</link>
</meta>
</meta>
</meta>

<style>
  body{
   height: 700px!important;
   width:750px!important;
   
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
  font-weight:500;
}
.first-p{
  font-size:14px;  
  color:#111111; 
  text-align: center; 
  margin-top: -8px;
  
}
.first-p-1{
  font-size:15px;  
  color:#111111!important; 
  text-align: center; 
  margin-top: -16px;
  font-family: 'BenchNine', sans-serif;
  
}

.farhana-table-2{
  width:90%;
}

.table-1-col-1{
 width: 33%;
 text-align: center;
}
.table-1-col-1 p{

  font-weight: bold;
  text-align: center;
  font-size: 20px;
  text-decoration: underline;
}
.farhana-table-3 {
  margin:0 auto;
  width:120%;
  margin-top:8px;
  
}
.farhana-table-3 tr td{
  font-size: 30px;

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

  width:120%;
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
  width:80%;
}
.farhana-table-4 tr td:nth-child(2){
  text-align: left;
  width:100%;
}
.farhana-table-4 tr td{
  border: 1px solid #111111;
  border-collapse: collapse!important;
  text-align: center;
  padding: 2px;
  padding-left: 7px;
}

.farhana-table-5{
  margin-top:15px;
  width:120%;
  margin-left: 15px;

}

.farhana-table-6{
  margin-top:60px;
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
  font-size:20px;
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

      <table class="farhana-table-1" style="width: 620px;">
        <tr>
          <td class="farhana-table-1-col-1">
            <img height="100px" width="100px" src="uploads/hospital_logo/<?=$hos_logo?>">
          </td>
          <td>
           <h1 class="" style="margin-bottom: 2px; font-size: 18px; text-align: center;margin-left:0px;">
             <?=$hospital_title_eng_report?>
           </h1>

           <h1 style="margin-top: 0px; font-size: 16px; text-align: center;margin-left:2px;">
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
     <td   class="table-1-col-1"><p >IPD RECEIPT</p></td>
     <td   class="table-1-col-1"></td>
   </tr>
 </table>


</div>

<table style="padding-top:10px;  margin-left:5px; width:500px; text-align: center;font-size:15px ">
  <tr>
    
  <tr>
    <th style="text-align: left"><b>Registration ID :</b><?<span style="font-weight:normal"><?=$patient_info[0]['patient_info_id']?></span></th>
    


  </tr>
  <tr>
    <th style="text-align: left"><b>Patient Name :</b><?<span style="font-weight:normal"><?=$patient_info[0]['patient_name']?></span></th>
    


  </tr>
  <tr>

   <th style="text-align: left">Admit:<?<span style="font-weight:normal"><?=$patient_info[0]['doc_name']?></span></th>

 </tr>

 <tr>

   <th style="text-align: left">Ref.by:<?<span style="font-weight:normal"><?=$patient_info[0]['ref_doc_name']?></span></th>

 </tr>
<th style="text-align: left"><b>Patient Contact No :</b><?<span style="font-weight:normal"><?=$patient_info[0]['mobile_no']?></span> </th>

 </tr>
 <th style="text-align: left"><b>Operator by : </b><?<span style="font-weight:normal"><?=$patient_info[0]['operator_name']?></span></th>
 
</table>               




<table style="margin-left:450px ; margin-top:-130px; width:500px; text-align: center;font-size:15px  ">
<th style="text-align: left"><b>Bill No :</b><?<span style="font-weight:normal"><?= $final_bill_info[0]['invoice_order_id']?></span></th>
  </tr>
    <tr>
    <th style="text-align: left"><b>UHID :</b><?<span style="font-weight:normal"><?=$patient_info[0]['gen_id']?></span></th>
  </tr>

  <tr>
    <th style="text-align: left"><b>Admit Date :</b><?<span style="font-weight:normal"><?=date('d-M-Y h:i:s a',strtotime($patient_info[0]['created_at']))?></span></th>
  </tr>

  <tr>
    <th style="text-align: left"><b>Release Date :</b><?<span style="font-weight:normal"><?=date('d-M-Y h:i:s a',strtotime($patient_info[0]['released_date']))?></span></th>
  </tr>

  <tr>
    <th style="text-align: left"><b>Patient Age :</b><?<span style="font-weight:normal"><?=$patient_info[0]['age']?></span></th>
  </tr>
  <tr>

   <th style="text-align: left"><b>Gender :</b><?<span style="font-weight:normal"><?=$patient_info[0]['gender']?></span></th>

 </tr>
 <tr>

  <!-- <th style="text-align: left"><b>Delivery Type :</b> <?<span style="font-weight:normal">Normal </span></th> -->



</tr>
<tr>

  



</tr>



</table>




<div class="static-data">
  <table style=" border: #000 solid 1px; border-collapse: collapse;font-size: 15px; width:700px; margin-left:10px; margin-top:15px;margin-bottom:43px" class="table">
    <thead>
      <tr>
        <th style="padding:0px!important;border: #000 solid 1px;">SL</th>

        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center">Service Type</th>

        <th style="border: #000 solid 1px;text-align:;padding:0px 15px "  align="center" >Service Name</th>

        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center" >Qty</th>
        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center" >Price</th>

        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center" >Sub Total</th>

        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center" >Total</th>

      <!-- 

       <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center">Vat</th> -->

       
     </tr>
   </thead>
   <tbody>

    <?php $i=1;
    $days=0;
    $total=0;
    $total_cabin=0;
    $total_operation=0;
    $total_service=0;
    $total_cabin_show=0;

    ?>

    <tr>
      <td align="center" style="border: #000 solid 1px;">1</td>
      <td align="center" style="border: #000 solid 1px;">Admission</td>
      <td align="left" style="border: #000 solid 1px;">Admission Fee</td>
      <td></td>
      <td align="right" style="border: #000 solid 1px;"><?=$final_bill_info[0]['admission_fee']?></td>
      <td align="right" style="border: #000 solid 1px;"><?=$final_bill_info[0]['admission_fee']?></td>
      <td align="right" style="border: #000 solid 1px;"><?=$final_bill_info[0]['admission_fee']?></td>
    </tr>


    <tr>
      <td align="center" style="border: #000 solid 1px;">2</td>

      <td align="center" style="border: #000 solid 1px;">Cabin</td>

      <td align="left" style="border: #000 solid 1px;">

        <?php foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) {?>



         <span style="">  <b></b> <?=$value['room_title']?> <br><b>Time</b> <?php 
         $current_date=date_create(date('Y-m-d H:i:s',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
         $next_date=date_create(date('Y-m-d H:i:s',strtotime($patient_timeline[$key+1]['created_at'])));
         $diff=date_diff($next_date,$current_date);
         $hours= $diff->h;
         $days= $diff->d;

         echo $days.'d '.$hours.'h';

         $price_per_hour=$value['room_price']/24;

         $total_cabin_show=round($days*$value['room_price']).' + '.round($hours*$price_per_hour);
         $total_cabin=round($days*$value['room_price']) + round($hours*$price_per_hour);
         ?>

       </span><br>

       <?php $i++;} } ?>

     </td>
     <td></td>

     <td align="right" style="border: #000 solid 1px;">

      <?php foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) { ?>

        <span style=""><?=$value['room_price'];?>


      </span><br>

    <?php } } ?>

  </td>

  <td align="right" style="border: #000 solid 1px;">

    <?=$total_cabin_show?>


  </td> 





  <td align="right" style="border: #000 solid 1px;"><?=$total_cabin?></td>

</tr>



<?php if($service_info!=null) { ?>

 <tr>
  <td align="center" style="border: #000 solid 1px;">3</td>
  <td align="center" style="border: #000 solid 1px;">Service</td>

  <td align="left" style="border: #000 solid 1px;">

    <?php 


    foreach ($service_info as $key => $value) { ?>


      <table  style=" border-bottom: 1px solid black;width: 100%; font-size: 15px;"> 
        <tr>
          <td>

            <span align="left"><?=$value['service_name']?> (<?=$value['operated_name']?>)</span><br/>

          </td>


        </tr>
      </table>

    <?php }  ?>


  </td>

  <td align="left" style="border: #000 solid 1px;">

    <?php 


    foreach ($service_info as $key => $value) { ?>


      <table  style="border-bottom: 1px solid black;width: 100%; font-size: 15px;"> 
        <tr>
          <td align="right">

            <span  style=""><?=$value['qty']?></span><br/>

          </td>

          
        </tr>
      </table>

    <?php }  ?>


  </td>

  <td align="center" style="border: #000 solid 1px;">

    <?php

    foreach ($service_info as $key => $value) { ?>

      <table style="border-bottom: 1px solid black;width: 100%; font-size: 15px;"> 
        <tr>
          <td align="right">
            <span ><?=$value['price']?></span><br/>
          </td>
        </tr>
      </table>

      

      <?php   $total_service+=$value['price']*$value['qty']; }  ?>

    </td>   

    <td align="right" style="border: #000 solid 1px;">

      <?php

      foreach ($service_info as $key => $value) { ?>
       <table style="width: 100%; border-bottom: 1px solid black; font-size: 15px;"> 
        <tr>
          <td align="right">
            <span align="center" style=""><?=$value['price']*$value['qty'];?></span><br/>
            </td>
          </tr>
        </table>
      <?php } ?>


    </td>



    <td align="right" style="border: #000 solid 1px;">
     <?= $total_service; ?>
   </td>    


 </tr>

<?php } ?>

</tbody>
</table>


<div style=" padding-bottom:10px" class="row">

 <table style="padding-top:30px;  margin-left:5px; width:200px; text-align: center;font-size:15px ">
 

  <tr>
    <th style="text-align: left"><b>Status:</b>
    <span style="font-weight:bold;font-size:20px;">

      <?php if(round($final_bill_info[0]['total_amount'])+$final_bill_info[0]['total_vat']- $final_bill_info[0]['total_discount'] <= $final_bill_info[0]['total_paid'] ) 
      {

        echo "Paid";

      }

        else
        {
          echo "Due";
        }

        ?>

    </span>
  </th>
  </tr>
  <tr>
    <th style="text-align: left;"><b>Discount Refer Name : </b><span style="font-weight:normal"><?=$final_bill_info[0]['discount_ref']?></span></th>
  </tr>

</table>

<table style="padding-top: 20px;
margin-left: 488px;
margin-top: -130px;
width: 230px;
text-align: center;
font-size: 16px;" cellpadding="0px" cellspacing="0px">
<tr>
  <td style="text-align: left; padding-bottom: 5px;"><b>Total Amount</b>:</td><td><?php echo round($final_bill_info[0]['total_amount'])?></td>

</tr>

<tr>
  <td style="text-align: left; padding-bottom: 5px;"><b>Discount Amount</b>:</td><td><?php echo $final_bill_info[0]['total_discount'] ?>  </td>

</tr>
<tr >

 <td style="text-align: left; padding-bottom:5px; width: 80% "><b>VAT(+)</b>:</td>
 <td><?php echo $final_bill_info[0]['total_vat'] ?></td>

</tr>
<tr>

  <?php $net_total=0;

  $net_total=round($final_bill_info[0]['total_amount'])+$final_bill_info[0]['total_vat']- $final_bill_info[0]['total_discount'];


  ?>
  
  <td style="text-align: left; padding-bottom:5px;"><b>Payable Amount</b>:</td><td><?php echo $net_total ?> </td>


</tr>

<tr>

 <td style="text-align: left;padding-bottom:5px;"><b>Amount Received</b>:</td><td><?php echo $final_bill_info[0]['total_paid'] ?></td>
</tr>

<tr>

 <td style="text-align: left;"><b>Due Amount</b>:</td><td><?php echo $net_total-$final_bill_info[0]['total_paid'] ?></td>
</tr>

</table>


</div>

<table style="margin-top:2px; width:400px;padding-left:10px;   text-align: center;font-size:10px  ">
  <tr>
  </tr>
    <th style="text-align: left;"><b>কাউন্টার ব্যতীত কারো সাথে টাকাপয়সা লেনদেন করিবেন না
	</tr>
	 <th style="text-align: left;"><b>রিসিট ব্যতীত কোন রিপোর্ট ডেলিভারি দেওয়া হয় না
</tr>
 <th style="text-align: left;font-size: 7px;
    line-height: 1.5;">Developed By Softwareparkbd Contact No:01624-794910
  <br><?php echo date('l jS \of F Y h:i:s A')?></th>






</table>



</div>


</div>










</body>

</html>
