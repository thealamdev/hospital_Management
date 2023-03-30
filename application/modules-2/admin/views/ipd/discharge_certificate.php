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
   width: 700px!important;
   
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
  font-size:20px;  
  color:#111111; 
  text-align: center; 
  margin-top: -12px;
  
}
.first-p-1{
  font-size:20px;  
  color:#111111!important; 
  text-align: center; 
  margin-top: -16px;
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
  font-size: 20px;
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

      <table class="farhana-table-1" style="width: 630px;">
        <tr>
          <td class="farhana-table-1-col-1">
            <img height="100px" width="100px" src="uploads/hospital_logo/<?=$hos_logo?>">
          </td>
          <td>
           <h1 class="" style="margin-bottom: 2px; font-size: 28px; text-align: center;margin-left: 5px;">
             <?=$hospital_title_eng_report?>
           </h1>

           <h1 style="margin-top: 0px; font-size: 20px; text-align: center;margin-left: 5px;">
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
     <td   class="table-1-col-1"><p >Discharge Certificate</p></td>
     <td   class="table-1-col-1"></td>
   </tr>
 </table>


</div>

<table style="padding-top:20px;  margin-left:5px; width:230px; text-align: center;font-size:12px ">
  <tr>
    <th style="text-align: left"><b>Bill No :</b> <span style="font-weight:normal"><?= $final_bill_info[0]['invoice_order_id']?></span></th>
  </tr>

  <tr>
    <th style="text-align: left"><b>Patient ID :</b> <span style="font-weight:normal"><?=$patient_info[0]['patient_info_id']?></span></th>
    


  </tr>
  <tr>
    <th style="text-align: left"><b>Patient Name :</b> <span style="font-weight:normal"><?=$patient_info[0]['patient_name']?></span></th>
    


  </tr>
  <tr>

   <th style="text-align: left">Doctor : <span style="font-weight:normal"><?=$dr_info[0]['doctor_title'].'('.$dr_info[0]['doctor_degree'].')'?></span></th>

 </tr>

<!--  <tr>

   <th style="text-align: left">Ref. Doctor : <span style="font-weight:normal"><?=$patient_info[0]['ref_doc_name']?></span></th>

 </tr> -->

 <tr>

   <th style="text-align: left">Disease Name : <span style="font-weight:normal"><?=$patient_info[0]['disease_name']?></span></th>

 </tr>
 
</table>               




<table style="margin-left:500px ; margin-top:-100px; width:230px; text-align: center;font-size:12px  ">
   <tr>

   <th style="text-align: left">UHID : <span style="font-weight:normal"><?=$uhid_info[0]['gen_id']?></span></th>

 </tr>
  <tr>
    <th style="text-align: left"><b>Admit Date :</b> <span style="font-weight:normal"><?=date('d-M-Y h:i;s a',strtotime($patient_info[0]['created_at']))?></span></th>
  </tr>

  <tr>
    <th style="text-align: left"><b>Release Date :</b> <span style="font-weight:normal"><?=date('d-M-Y h:i:s a',strtotime($patient_info[0]['released_date']))?></span></th>
  </tr>

  <tr>
    <th style="text-align: left"><b>Age :</b> <span style="font-weight:normal"><?=$patient_info[0]['age']?></span></th>



  </tr>
  <tr>

   <th style="text-align: left"><b>Sex :</b> <span style="font-weight:normal"><?=$patient_info[0]['gender']?></span></th>

 </tr>
 <tr>

  <!-- <th style="text-align: left"><b>Delivery Type :</b> <span style="font-weight:normal">Normal </span></th> -->



</tr>
<tr>

  <th style="text-align: left"><b>Mobile :</b> <span style="font-weight:normal"><?=$patient_info[0]['mobile_no']?></span> </th>

</tr>
</table>

<hr>


<table>
  <tr>
    <th style="text-align: left;width:230px !important"><b>Case Summary :</b> <span style="font-weight:normal;display: block;word-wrap:break-word;width: 700px;white-space: normal"><?=$patient_info[0]['description']?></span></th>
  </tr>

  <tr>
     <th style="text-align: left;width:230px !important"><b>Investigation Report :</b> <span style="font-weight: normal">All reports are supplied with the patient in file</span></th>
  </tr>
</table>




<div class="static-data">
  <table style=" border: #000 solid 1px; border-collapse: collapse;font-size: 12px; width:700px; margin-left:10px; margin-top:20px;margin-bottom:20px" class="table">
    <thead>
      <tr>
        <th style="padding:0px!important;border: #000 solid 1px;">SL</th>

        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center">Medicine Type</th>

        <th style="border: #000 solid 1px;text-align:;padding:0px 15px "  align="center" >Medicine</th>

        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center" >Dose Qty</th>
        <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="center">Description</th>

      </tr>
    </thead>


    <tbody>

      <?php

      foreach ($prescription_info as $key => $value) {  ?>

        <tr>
          <td style="border: #000 solid 1px;" align="center"><?=$key+1?></td>
          <td style="border: #000 solid 1px;" align="center"><?=$value['type']?></td>
          <td style="border: #000 solid 1px;" align="center"><?=$value['medicine_name']?></td>
          <td style="border: #000 solid 1px;" align="center"><?=$value['dose_qty']?></td>
          <td style="border: #000 solid 1px;" align="center"><span style="display: block;word-wrap:break-word;width: 400px;white-space: normal"><?=$value['description']?></span></td>
        </tr>

      <?php   }
      ?>

    </tbody>
  </table>


  <div style=" padding-bottom:10px" class="row">

   <table style="padding-top:20px;  margin-left:5px; width:170px; text-align: center;font-size:12px ">
    <tr>
      <th style="text-align: left"><b>Remarks:</b></th>



    </tr>

    <tr>
      <th style="text-align: left"><b>User : </b><span style="font-weight:normal"></span></th>
    </tr>

    <tr>
      <th style="text-align: left"><b>Sign : </b><span style="font-weight:normal"></span></th>
    </tr>



  </table>

  <table style="padding-top: 20px;
  margin-left: 515px;
  margin-top: -90px;
  width: 200px;
  text-align: center;
  font-size: 12px;" cellpadding="0px" cellspacing="0px">
  <tr>
  </tr>

</table>


</div>

<table style="margin-top:350px; width:400px;padding-left:10px;   text-align: center;font-size:9px  ">
  <tr>
    <th style="text-align: left;font-size: 7px;
    line-height: 1.5;">Developed By Softwareparkbd & Rcreation 
  </br>01813322678,01816306190 <br><?php echo date('l jS \of F Y h:i:s A')?></th>
</tr>

</table>



</div>


</div>










</body>

</html>
