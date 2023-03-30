<?php $this->load->view('back/header_link'); ?>

<?php 
$hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
$hospital_title_eng_report=$this->session->userdata['logged_in']['hospital_title_eng_report'];
$hospital_title_ban_report=$this->session->userdata['logged_in']['hospital_title_ban_report'];
$address_report=$this->session->userdata['logged_in']['address_report'];
$others_report=$this->session->userdata['logged_in']['others_report'];
?>

<body>

  <style type="text/css">
  body
  {
    background-color: white !important;
    width: 1000px;
    height: 800px;
    /*border:1px solid black;*/
    color: black !important;
    margin: 0 auto;

    padding: 5px;
  }

</style>

<div class="row">
  <div class="col-md-2">
    <img src="uploads/hospital_logo/<?=$hos_logo?>" height="100px" width="100px">
  </div>
  <div class="col-md-8">
    <h4 style="text-align: center; color: blue; font-size: 26px;"><?=$hospital_title_eng_report?></h4>
    <h4 style="text-align: center; color: red; font-size: 20px;"><?=$hospital_title_ban_report?></h4>
    <h4 style="text-align: center; color: black; font-size: 16px;"><?=$address_report?></h4>
    <h4 style="text-align: center; color: black; font-size: 16px;"><?=$others_report?></h4>
  </div>
</div>

<h3 style="text-align: center;font-weight: bold; color: black;margin-top: 20px;margin-bottom:20px;text-decoration: underline;">IPD Registration Form</h3>


<div class="row">
  <div class="col-md-6">
    <table style="color: black; font-size: 18px; margin-left: 40px;">
      <tr>
        <td style="font-weight: normal">Patient Name: </td>
        <td><?=$ipd_patient_info[0]['patient_name']?></td>
      </tr>
      <tr>
        <td style="font-weight: normal">Registration No: </td>
        <td><?=$ipd_patient_info[0]['reg_id']?></td>
      </tr>

       <tr>
        <td style="font-weight: normal">Pateint Id: </td>
        <td><?=$ipd_patient_info[0]['patient_info_id']?></td>
      </tr>
      <tr>
        <td style="font-weight: normal">Phone No: </td>
        <td><?=$ipd_patient_info[0]['mobile_no']?></td>
      </tr>

      <tr>
        <td style="font-weight: normal">age: </td>
        <td><?=$ipd_patient_info[0]['age']?></td>
      </tr> 

      <tr>
        <td style="font-weight: normal">Gender: </td>
        <td><?=$ipd_patient_info[0]['gender']?></td>
      </tr>

      <tr>
        <td style="font-weight: normal">Cabin No: </td>
        <td><?=$ipd_patient_info[0]['room_title']?></td>
      </tr>

 <!--        <tr>
          <td style="font-weight: normal">Blood Group: </td>
          <td><?=$ipd_patient_info[0]['blood_group_title']?></td>
        </tr> -->

        <tr>
          <td style="font-weight: normal">Advance Payment: </td>
          <td><?=$ipd_patient_info[0]['advance_payment']?></td>
        </tr>

        <tr>
          <td style="font-weight: normal">Admission Fee: </td>
          <td><?=$ipd_patient_info[0]['admission_fee']?></td>
        </tr>

        <tr>
          <td style="font-weight: normal">Admission Fee Paid: </td>
          <td><?=$ipd_patient_info[0]['admission_fee_paid']?></td>
        </tr>
      </table>
    </div>

    <div class="col-md-6">
      <table style="color: black; font-size: 18px; margin-left: 50px;">
        <tr>
          <td style="font-weight: normal">Dr. Name: </td>
          <td><?=$ipd_patient_info[0]['doc_name']?></td>
        </tr>
        <tr>
          <td style="font-weight: normal">Ref Dr. Name: </td>
          <td><?=$ipd_patient_info[0]['ref_doc_name']?></td>
        </tr>
        <tr>
          <td style="font-weight: normal">DOB: </td>
          <td><?=date('d-m-Y', strtotime($ipd_patient_info[0]['date_of_birth']))?></td>
        </tr>

        <tr>
          <td style="font-weight: normal">Email: </td>
          <td><?=$ipd_patient_info[0]['email']?></td>
        </tr>

        <tr>
          <td style="font-weight: normal">Disease Name: </td>
          <td><?=$ipd_patient_info[0]['disease_name']?></td>
        </tr>

        <tr>
          <td style="font-weight: normal">Guardian Name: </td>
          <td><?=$ipd_patient_info[0]['guardian_name']?></td>
        </tr>

        <tr>
          <td style="font-weight: normal">Address: </td>
          <td>-------------</td>
        </tr><br>
        <tr>
          <td style="font-weight: normal">Village: </td>
          <td><?=$ipd_patient_info[0]['village']?></td>
        </tr>
        <tr>
          <td style="font-weight: normal">Post Office: </td>
          <td><?=$ipd_patient_info[0]['post_office']?></td>
        </tr>
        <tr>
          <td style="font-weight: normal">Police Station: </td>
          <td><?=$ipd_patient_info[0]['police_station']?></td>
        </tr>
        <tr>
          <td style="font-weight: normal">District: </td>
          <td><?=$ipd_patient_info[0]['district']?></td>
        </tr>

       <!--  <tr>
          <td style="font-weight: normal">Blood Pressure: </td>
          <td><?=$ipd_patient_info[0]['blood_pressure']?></td>
        </tr>

        <tr>
          <td style="font-weight: normal">Pulse Rate: </td>
          <td><?=$ipd_patient_info[0]['pulse_rate']?></td>
        </tr>  -->

        <tr>
          <td style="font-weight: normal">Date: </td>
          <td><?=date('d-m-Y h:i:s a', strtotime($ipd_patient_info[0]['created_at']))?></td>
        </tr>
      </table>
    </div>
  </div>

  <div class="row" style="margin-top: 70px;">
    <div class="col-md-4">
     <div style="width: 200px; border:1px solid black; margin-top: 62px;"></div>
     <table align="left" style="color: black; font-size: 18px; ">

      <tr>
        <td style="font-weight: normal;">Guardian Sig: </td>
      </tr>
    </table>
  </div>

  <div class="col-md-4">
   <table style="color: black; font-size: 18px;margin-left: -200px;">
    <tr>
<!--       <td style="font-weight: normal">Description: </td> -->
      <td><div style="padding: 5px; height: 200px;margin-left: 110px; width: 500px; border: 1px solid black;margin-top: 30px;"><?=$ipd_patient_info[0]['description']?></div></td>
    </tr>
  </table>
</div>

<div class="col-md-4">
 <div style="width: 200px; border:1px solid black; margin-top: 62px; margin-left: 170px;"></div>
 <table align="left" style="color: black; font-size: 18px; margin-left: 170px;width: 180px;">

  <tr>
    <td style="font-weight: normal;">Authorize Sig: </td>
    <td style="font-weight: bold;"><?=$ipd_patient_info[0]['operator_name']?></td>
  </tr>
</table>
</div>


</div>



<!--=======  SCRIPTS =======-->
<script src="back_assets/money_recipt/js/jquery.min.js"></script>
<script src="back_assets/money_recipt/js/popper.min.js"></script>
<script src="back_assets/money_recipt/js/bootstrap.min.js"></script>
<script src="back_assets/money_recipt/js/custom-js.js"></script>
<!-- <script src="back_assets/js/moment.js"></script> -->

<!-- <script type="text/javascript">
   setTimeout(function() { 
    window.print();

  }, 1000);
</script> -->

<script type="text/javascript">

  // $(document).ready(function(){
  //    // alert('hi');
  //    var patient_id=$('#hidden_patient_id').val();
  //    var order_id=$('#hidden_order_id').val();

  //    $.ajax({
  //     url:"<?=site_url("admin/get_patient_ordered_test_info")?>",
  //     method:"POST",
  //     dataType:"json",
  //     data:{patient_id:patient_id,order_id:order_id},
  //     success:function(data)
  //     {
  //             // var obj=$.parseJSON(data);

  //             if(data['ipd_info'] != "")
  //             {
  //               $('#ipd_patient_id').text(data['ipd_info'][0]['patient_info_id']);
  //               $('#cabin_no').text(data['ipd_info'][0]['room_title']);
  //             }

  //             $.each(data['test_info'], function (key, value) {

  //               $('#patient_name').text(value.patient_name);
  //               $('#patient_info_id').text(value.patient_info_id);
  //               $('#phone_no').text(value.mobile_no);
  //               $('#email').text(value.email);
  //               $('#age').text(value.age);
  //               $('#gender').text(value.gender);
  //               $('#invoice').text(value.test_order_id);
  //               $('#booked_by').text(value.operator_name);
  //               $('#printed_by').text(value.operator_name);



  //               var status;
  //               if(value.payment_status=="unpaid")
  //               {
  //                 status="Due";
  //               }
  //               else
  //               {
  //                 status="Paid";
  //               }
  //               $('#payment_status').text(status);

  //               var myDate = new Date(value.created_at)

  //               $('#date_time').text(changeDateFormat(myDate.toLocaleString()));



  //               $.each(data['doctor_info_ref'], function (key1, value1) {

  //                 if(value.ref_doc_id==value1.doctor_id)
  //                 {
  //                  $('#ref_by').text(value1.doctor_title+' ('+value1.doctor_degree+')');
  //                }
  //                else if(value.ref_doc_id==0)
  //                {
  //                 $('#ref_by').text(" Self");
  //               }



  //             });

  //               $.each(data['doctor_info_quack'], function (key2, value2) {

  //                if(value.quack_doc_id==value2.doctor_id)
  //                {
  //                  $('#quack_by').text(value2.doctor_title+' ('+value2.doctor_degree+')');
  //                }
  //                else if(value.quack_doc_id==0)
  //                {
  //                 $('#quack_by').text(" Self");
  //               }


  //                //  if(value.quack_doc_id==value2.doctor_id)
  //                //  {
  //                //   $('#quack_by').text(value2.doctor_title);
  //                // }



  //              });




  //         // $('#quack_doc_name').text(value.quack_doc_name);


  //                 // var result = new Date('27/07/1990');
  //                 // result.setDate(result.getDate() + parseInt(2));
  //                 // var dateEnd = result.getFullYear() + '-' + (result.getMonth()+1) + '-' + result.getDate();
  //                 // alert(dateEnd);
  //                 // var myDate = new Date($('#date_time').text(value.created_at)+(5*24*60*60*1000));
  //                 // alert(myDate);
  //                 // var date = new Date();
  //                 // // add a day
  //                 // alert(date.setDate($('#date_time').text(value.created_at)+ 1));
  //               });




  //           },
  //           error: function(e) 
  //           {
  //             alert(e);
  //           }

  //         });

  //    var i=1;
  //    $.ajax({
  //     url:"<?=site_url("admin/get_patient_ordered_test_details_info")?>",
  //     method:"POST",
  //     dataType:"json",
  //     data:{order_id:order_id},
  //     success:function(data)
  //     {
  //      $.each(data, function (key, value) {
  //       $("#patient_ordered_test_table").append('<tr><td class="farhana-table-4-col-1">'+i+'</td><td class="farhana-table-4-col-2">'+value.sub_test_title+'</td><td class="farhana-table-4-col-3">'+parseFloat(value.price).toFixed(2)+'</td></tr>');
  //       i++;
  //     });


  //      $.ajax({
  //       url:"<?=site_url("admin/get_order_info")?>",
  //       method:"POST",
  //       dataType:"json",
  //       data:{order_id:order_id},
  //       success:function(data){
  //         $.each(data, function (key, value) {

  //           var vat=parseFloat(value.vat).toFixed(2);
  //           var net_total=(parseFloat(value.total_amount)+parseFloat(value.vat)-(value.total_discount)).toFixed(2);
  //           var due=(parseFloat(net_total)-parseFloat(value.paid_amount)).toFixed(2);


  //           $('#total_amount').text(parseFloat(value.total_amount).toFixed(2));
  //           $('#total_discount').text(parseFloat(value.total_discount).toFixed(2));
  //           $('#paid_amount').text(parseFloat(value.paid_amount).toFixed(2));
  //           $('#vat').text(vat);
  //           $('#due_amnt').text((parseFloat(net_total)-parseFloat(value.paid_amount)).toFixed(2));
  //           $('#net_total').text(net_total);


  //         });
  //       }
  //     });

  //    // }
  //  });
  //  });



// function changeDateFormat(inputDate){  // expects Y-m-d
//   var splitDate= inputDate.split(',');

//   var splitDate1= splitDate[0].split('/');

//   var year = splitDate1[2];
//   var month = splitDate1[0];
//   var day = splitDate1[1]; 

//   return day + '/' + month + '/' + year + splitDate[1];




// }
</script>

<script type="text/javascript">
 setTimeout(function() { 
  window.print();
}, 1000); 
</script>
</body>

</html>
