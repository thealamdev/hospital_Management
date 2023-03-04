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
  font-size: 38px !important;
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

    <div style="margin-left: 24px;">

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
     <td   class="table-1-col-1"><p >Death Certificate</p></td>
     <td   class="table-1-col-1"></td>
   </tr>
 </table>
 

 
 <table class="farhana-table-3">
  <tr><td colspan="2"><b>It is certified that:</b>______________________</td>
  </tr>
  <tr><td style="text-align: left"><b>Patient Description: </b></td>
  </tr>

</table>

<table class="farhana-table-3">

    <tr><td colspan="2"><b>Sex: </b><label ><?=$birth_info[0]['gender']?></td></tr> 
    <tr><td colspan="2"><b>Weight: </b><label ><?=$birth_info[0]['weight']?></td> 
    </tr>  <tr><td colspan="2"><b>Height: </b><label ><?=$birth_info[0]['height']?></td> 
    </tr>

  </table>

  <table class="farhana-table-3">
    <tr><td colspan="3" class="doctor-name"><b>Dr. Name: </b><label id="ref_by"><?=$birth_info[0]['ref_doc_name']?></label></td>
    </tr>
    <tr><td colspan="2"><b>Date of Birth: </b><label ><?=$birth_info[0]['date_of_birth']?></td> 
    <tr><td colspan="2"><b>Date of Death: </b><label ><?=$birth_info[0]['date_of_death']?></td> 
    </tr> <tr><td colspan="2"><b>Place of Birth: </b><label ><?=$birth_info[0]['place_of_birth']?></td> 
    </tr> 
  </table>

  <table class="farhana-table-3">
    <tr><td colspan="2"><b>Patient Name: </b><label ><?=$birth_info[0]['patient_name']?></td> 
    </tr>   <tr><td colspan="2"><b>Father Name: </b><label ><?=$birth_info[0]['father_name']?></td> 
    </tr>   <tr><td colspan="2"><b>Mother Name: </b><label ><?=$birth_info[0]['mother_name']?></td> 
    </tr> 
  </table>

  <table class="farhana-table-3" style="margin-top:100px !important;">
    <tr><td align="left" class="authorize">Doctor Signature<label id="booked_by"></label></td>
    <td class="authorize">MS Signature<label id="booked_by"></label></td></tr>
  </table>
</div>
  
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
