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
     width: 530px!important;

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
    font-weight:700;
  }
  .first-p{
    font-size:12px;  
    color:#111111; 
    text-align: center; 
    margin-top: -8px;

  }
  .first-p-1{
    font-size:12px;  
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
  font-size: 38px !important;
  font-weight: bold;
  transform: rotate(-2deg);
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

    <div style="margin-left:35px;">

      <table class="farhana-table-1">
        <tr>
          <td class="farhana-table-1-col-1">
            <img height="60px" width="60px" src="uploads/hospital_logo/<?=$hos_logo?>">
          </td>
          <td>
           <h1 class="" style="margin-bottom: 2px; font-size:16px; text-align: center;margin-left: 5px;">
             <?=$hospital_title_eng_report?>
           </h1>

           <h1 style="margin-top: 0px; font-size: 14px; text-align: center;margin-left: 5px;">
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
     <td   class="table-1-col-1"><p >OPD BILL  RECEIPT</p></td>
     <td   class="table-1-col-1"></td>
   </tr>
 </table>
 

 
 <table class="farhana-table-3">
  <tr><td colspan="2"><b>Patient Bill No: </b><label id="invoice"><?=$test_info[0]['test_order_id']?></label></td> <td><b>Date & Time: </b><label id="date_time"><?=date("d-m-Y H:i:s", strtotime($test_info[0]['created_at']))?></label></td>
  </tr>
   <tr><td colspan="2"><b>Patient Name: </b><label id="patient_name"><?=$test_info[0]['patient_name']?></td>
 
    <td><b>Patient Mobile No: </b><label id="phone_no"><?=$test_info[0]['mobile_no']?></label></td>
  </tr>
  <tr><td style="text-align: left"><b>Gender: </b><label id="gender"><?=$test_info[0]['gender']?></label></td><td><b></td> <td><b>Patient Age : </b><label id="age"><?=$test_info[0]['age']?></label></td>
  <?php if(!empty($uhid_info)) {?>
   <td colspan="2"><b>UHID: </b><label id="uhid"><?=$uhid_info[0]['gen_id']?></label></td>  <?php } ?>

  </tr>
 
  </tr>
<tr><td colspan="3" class="doctor-name"><b>Dr. Name: </b><label id="ref_by"><?=$test_info[0]['ref_doc_name']?></label></td>
  </tr>
  <?php if($is_ipd_patient==1) {?>
    <tr>
      <td colspan="2" class="doctor-name"><b>Ipd Patient Id: </b><label id="ipd_patient_id"><?=$ipd_info[0]['patient_info_id']?></label></td>

      <td colspan="3" class="doctor-name"><b>Cabin No: </b><label id="cabin_no"><?=$ipd_info[0]['room_title']?></label></td>
    </tr>

  <?php } ?>





<table class="farhana-table-4">
  <tr>
    <th class="farhana-table-4-col-1">
      SL
    </th>
    <th class="farhana-table-4-col-2">
      Name Of Investigation
    </th>
    <th class="farhana-table-4-col-3">
      Amount
    </th>
  </tr>

  <tbody id="patient_ordered_test_table">
    <?php foreach ($order_info as $key => $value) { 

      ?>

      <tr>
        <td class="farhana-table-4-col-1">
         <?=$key+1?>
       </td>
       <td class="farhana-table-4-col-2"><?=$value['sub_test_title']?></td>
       <td style="text-align: right !important;" class="farhana-table-4-col-3"><?=$value['price']?></td>
     </tr>
     
   <?php } ?>
 </tbody>

</table>  


<div class="static-data">

  <div style=" padding-bottom:5px" >
   <table style="margin-top:60px;margin-left:120px">
     <tr>
      <td  class="tranform-text" ><span><label id="payment_status">

        <?php if ($test_info[0]['payment_status']=="paid")
        {
          echo "Paid";
        } else
        {
          echo "Due";
        }
        ?>

      </label></span></td></tr>

    </table>
    <table class="farhana-table-5" style="margin-top:-100px;margin-left:100px;margin-bottom:5px;">
      <tr>
        <td rowspan="6"></td>
        <td ><b>Total Amount </b></td>
        <td >  :<label id="total_amount"><?=$test_info[0]['total_amount']?></label></td>


      </tr>
      <tr>

        <td ><b>Vat(+)</b></td>
        <td >  :<label id="vat"><?=$test_info[0]['vat']?></label></td>


      </tr>
      <tr>

        <td ><b>Dis(-) </b></td>
        <td >  :<label id="total_discount"><?=$test_info[0]['total_discount']?></label>


      </tr>
      <tr>

        <td ><b>Net Amount </b></td>
        <td >  :<label id="net_total"><?=($test_info[0]['total_amount']+$test_info[0]['vat'])-$test_info[0]['total_discount']?></label></td>


      </tr>
      <tr>

        <td ><b>Received Amount </b></td>
        <td >  :<label id="paid_amount"><?=$test_info[0]['paid_amount']?></label></td>


      </tr>
      <tr>

        <td ><b>Due Amount </b></td>
        <td >  :<label id="due_amnt"><?=(($test_info[0]['total_amount']+$test_info[0]['vat'])-$test_info[0]['total_discount'])-$test_info[0]['paid_amount']?></label></td>


      </tr>


    </table>

  </div>

</div>

</div>

<footer class="footer">

  <table class="farhana-table-6">

   <tr>
    
  </tr>
	<tr><td colspan="2" class="doctor-name"><b>Ref Dr. ID: </b><label id="quack_by">D-<?=$test_info[0]['quack_doc_id']?>
  </tr>
   <td colspan="2" style="font-size: 12px;"><b>Discount by: </b><label id="dis_refer"><?=$test_info[0]['discount_ref']?></label></td>
  <tr>
   <tr>
    <tr><td colspan="2" class="doctor-name"><b>যেসকল রুমে যাবেন :
  </tr>
 <tr>
    <tr><td colspan="2" class="doctor-name"><b>কালেকশন রুম-১১২   **</>ইসিজি রুম-১১০  **</>আল্ট্রা রুম-১০৮  **</>এক্স রে রুম-১০৬
      </td>
	   <tr>
    <tr><td colspan="2" class="doctor-name"><b>রিপোর্ট ডেলিভারি-১০২   **</>ফার্মেসি-১০৩  **</>নার্সিং স্টেশন তৃতীয় তলা
      </td>
    <tr>
    <tr><td colspan="2" class="doctor-name"><b>কাউন্টার ব্যতীত কারো সাথে টাকাপয়সা লেনদেন করিবেন না
	<tr><td colspan="2" class="doctor-name"><b>রিসিট ব্যতীত কোন রিপোর্ট ডেলিভারি দেওয়া হয় না
	</td>
    <tr>
      <td class="print"><?php echo "Print Date: ".date('l jS \of F Y h:i:s A')?> <br> Developed By: Software Park Bd (01624794910)
      </td>
      <td class="authorize">Authorize Sig: <label id="booked_by"><?=$test_info[0]['operator_name']?></label></td>
    </tr>
  </table>

</footer>

<!-- </div> -->



<!--=======  SCRIPTS =======-->
<script src="back_assets/money_receipt/js/jquery.min.js"></script>
<script src="back_assets/money_receipt/js/popper.min.js"></script>
<script src="back_assets/money_receipt/js/bootstrap.min.js"></script>

<script type="text/javascript">
 setTimeout(function() { 
  window.print();

}, 1000);
</script>

</body>

</html>
