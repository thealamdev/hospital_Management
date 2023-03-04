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
     height: 750px!important;
     width: 650px!important;

     /* to centre page on screen*/
     margin:1px 0px;
     margin-left: auto;
     margin-right: auto;
     font-family:  serif;
     border: 1px solid black;বর্ডার লাইন
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
    /*font-family: 'BenchNine', sans-serif;*/

  }

  .farhana-table-2{
    width: 98%;
  }

  .table-1-col-1{
   width: 98%;
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

  width: 100%;
  margin:0 auto;
  margin-top: 20px;
  border-collapse: collapse;
  border:1px solid #111111;
  font-size: 15px;
  text-align: right !important;
}
.farhana-table-4 tr th{
  border: 0px solid #111111;
  border-collapse: collapse!important;
  text-align: center;
  padding: 2px;
  padding-left: 12px;
}
.farhana-table-4 tr th:nth-child(2){
  text-align: right;
  width: 55%;
}
.farhana-table-4 tr td:nth-child(2){
  text-align: right;
  width: 55%;
}
.farhana-table-4 tr td{
  border: 1px solid #111111;
  border-collapse: collapse!important;
  text-align: center;
  padding: 5px;
  padding-left: 7px;
}

.farhana-table-5{
  margin-top: -23px;
  width: 30%;
  margin-left: 342px;

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

.authorize{
  font-size:10px;
  text-decoration: overline;
  text-align: right;
}


ul {
  padding-left: 0;
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

     
      </tr>
    </table>
  </div>

  <table class="farhana-table-2">
    <tr><td colspan="2"><b>UHID: </b><label id="invoice"><?=$appointment_info[0]['id']?></label></td> <td style="text-align: right"><b>Patient Name: </b><label id="date_time"><?=$appointment_info[0]['patient_name']?></label></td>
   
    <tr><td colspan="2"> <b>Contact: </b><label id="phone_no"><?=$appointment_info[0]['mobile_no']?></label></td><td style="text-align: right"><b>Visit App. Date: </b><label id="phone_no"><?=$appointment_info[0]['appointment_date']?> <?=$appointment_info[0]['appointment_time']?></label></td>
    </tr>
    <tr><td colspan="2"><b>Address: </b><label id="ref_by"><?=$appointment_info[0]['address']?></label></td><td style="text-align: right"><b>Blood Group: </b><label id="ref_by"><?=$blood_group_info?$blood_group_info[0]['blood_group_title']:""?></label></td>
    </tr>
    <tr><td colspan="2" style="text-align: left"><b>Age/Sex: </b><label id="gender"><?=$appointment_info[0]['age']?>/<?=$appointment_info[0]['gender']?>
    </tr>
   </tr>

  </table>

  <table class="farhana-table-4">
    <tr>      
      <td style="text-align:left;">
       <b>Weight</b>: <?=$appointment_info[0]['weight']?>
     </td>
     <td style="text-align:center;">
      <b>Pulse</b>: <?=$appointment_info[0]['pulse']?>
    </td>

    <td style="text-align:center;">
     <b>BP</b>: <?=$appointment_info[0]['bp']?>
   </td>

   <td style="text-align:center;">
     <b>SPO2</b>: <?=$appointment_info[0]['spo2']?>
   </td>
 </tr>
</table>  

<div style="width:200px; margin-top: 40px;float: left;">

  <span style="font-weight: bold;">CC:</span><br>
  
  <div style="word-break:break-all;border-bottom: 1px solid black;">
    <?=$appointment_info[0]['cc']?> 
  </div> <br>

<!--   <span style="font-weight: bold;">General Exam:</span><br>

  <div style="word-break:break-all;border-bottom: 1px solid black;">
    <?=$appointment_info[0]['general_exam']?> 
  </div> -->

  <span style="font-weight: bold;">Investigation:</span><br>

  <div style="word-break:break-all;border-bottom: 1px solid black;">
    <?=$appointment_info[0]['test_name']?> 
  </div> <br>

  <span style="font-weight: bold;">History:</span><br>

  <div style="word-break:break-all;border-bottom: 1px solid black;">
    <?=$appointment_info[0]['note']?> 
  </div>

  <br>

  <span style="font-weight: bold;">Advice:</span><br>

  <div style="word-break:break-all;border-bottom: 1px solid black;">
    <?=$appointment_info[0]['advice']?> 
  </div>

</div>

<div style="float: left;border-left: 1px solid black;height: 540px;margin-left: 1px;"><span style="margin-left: 10px;font-size: 35px;color: grey;">R<span style="font-size:20px;">X</span></span>  
</div> <br><br><br>

<div style="float: left;">
  <?php foreach ($appointment_info as $key => $value) { ?>

    <div align="left">
      <ul>
        <li>
          <span style="font-weight:Bold; font-size: 15px;"><?=$value['medicine_name']?></span><span> (Generic name: <?=$value['generic_name']?>)</span><br><br><span>(<?=$value['dose_qty'].') - ('.$value['description'].')&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value['max_day']." days"?></span>
        </li>
      </ul>
    </div>

  <?php } ?>
</div>
</div>

<footer class="footer">

  <table  style="width:100%;margin-top:-10px;font-size:12px;font-weight: bold; border: 0px solid black;">
    

  <table align="right" style="margin-top:-0px;font-size:12px;font-weight: bold;">
    <tr>     
      <th style="text-align: right;font-size: 15px;"><b><?=$appointment_info[0]['doctor_title']?></b><br><?=$appointment_info[0]['doc_designation']?>
      </th>
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

}, 500);
</script>

</body>

</html>
