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
     height: 100px!important;
     width: 250px!important;

     /* to centre page on screen*/
     margin:10px 0px;
     margin-left: auto;
     margin-right: auto;
     font-family:  serif;
   }



.farhana-table-3 {
  margin:0 auto;
  width: 90%;
  margin-top: 5px !important;
  
}
.farhana-table-3 tr td{
  font-size: 12px;

}

</style>

</head>



<body style="color:#000; text-align: center;">


  <div style="  margin: 0 auto;" class="container">
    <div  class="row">

    <span style="text-align: center;margin-left: -70px;font-size: 18px;font-weight: bold;">Sample Tag</span>
     <table class="farhana-table-3">
      <tr><td><b>Invoice Id: </b><label><?=$patient_order_info[0]['test_order_id']?></label></td>
      </tr>
<!--       <tr><td><b>Patient Name: </b><label><?=$patient_info[0]['patient_name']?></label></td>
      </tr> -->
      <tr><td><b>Date: </b><label><?=date("d-m-Y h:i:s a", strtotime($patient_order_info[0]['created_at']))?></label></td> 
      </tr>
     
    </table>
  </div>
</div>

<!--=======  SCRIPTS =======-->
<script src="back_assets/money_receipt/js/jquery.min.js"></script>
<script src="back_assets/money_receipt/js/popper.min.js"></script>
<script src="back_assets/money_receipt/js/bootstrap.min.js"></script>

<script type="text/javascript">

  $(document).ready(function(){

   var patient_id=$('#hidden_patient_id').val();
   var order_id=$('#hidden_order_id').val();


   $.ajax({
    url:"<?=site_url("admin/get_patient_ordered_test_info")?>",
    method:"POST",
    dataType:"json",
    data:{patient_id:patient_id,order_id:order_id},
    success:function(data)
    {

     if(data['ipd_info'] != "")
     {
      $('#ipd_patient_id').text(data['ipd_info'][0]['patient_info_id']);
      $('#cabin_no').text(data['ipd_info'][0]['room_title']);
    }


    $.each(data['test_info'], function (key, value) 
    {

      $('#patient_name').text(value.patient_name);
      $('#patient_info_id').text(value.patient_info_id);
      $('#phone_no').text(value.mobile_no);
      $('#email').text(value.email);
      $('#age').text(value.age);
      $('#gender').text(value.gender);
      $('#invoice').text(value.test_order_id);
      $('#booked_by').text(value.operator_name);
      $('#printed_by').text(value.operator_name);


      var status="";

      if(value.payment_status=="unpaid")
      {
        status="Due";
      }
      else
      {
        status="Paid";
      }

      $('#payment_status').text(status);

      var myDate = new Date(value.created_at)

      $('#date_time').text(changeDateFormat(myDate.toLocaleString()));



      $.each(data['doctor_info_ref'], function (key1, value1) 
      {

        if(value.ref_doc_id==value1.doctor_id)
        {
         $('#ref_by').text(value1.doctor_title+' ('+value1.doctor_degree+')');
       }
       else if(value.ref_doc_id==0)
       {
        $('#ref_by').text(" Self");
      }

    })

      $.each(data['doctor_info_quack'], function (key2, value2) 
      {

       if(value.quack_doc_id==value2.doctor_id)
       {
         $('#quack_by').text(value2.doctor_title+' ('+value2.doctor_degree+')');
       }
       else if(value.quack_doc_id==0)
       {
        $('#quack_by').text(" Self");
      }


    })

    })

    var i=1;

    $.ajax({
      url:"<?=site_url("admin/get_patient_ordered_test_details_info")?>",
      method:"POST",
      dataType:"json",
      data:{order_id:order_id},
      success:function(data)
      {
       $.each(data, function (key, value) 
       {
        $("#patient_ordered_test_table").append('<tr><td class="farhana-table-4-col-1">'+i+'</td><td class="farhana-table-4-col-2">'+value.sub_test_title+'</td><td class="farhana-table-4-col-3">'+parseFloat(value.price).toFixed(2)+'</td></tr>');
        i++;
      })


       $.ajax({
        url:"<?=site_url("admin/get_order_info")?>",
        method:"POST",
        dataType:"json",
        data:{order_id:order_id},
        success:function(data)
        {
          $.each(data, function (key, value) 
          {

            var vat=parseFloat(value.vat).toFixed(2);
            var net_total=(parseFloat(value.total_amount)+parseFloat(value.vat)-(value.total_discount)).toFixed(2);
            var due=(parseFloat(net_total)-parseFloat(value.paid_amount)).toFixed(2);


            $('#total_amount').text(parseFloat(value.total_amount).toFixed(2));
            $('#total_discount').text(parseFloat(value.total_discount).toFixed(2));
            $('#paid_amount').text(parseFloat(value.paid_amount).toFixed(2));
            $('#vat').text(vat);
            $('#due_amnt').text((parseFloat(net_total)-parseFloat(value.paid_amount)).toFixed(2));
            $('#net_total').text(net_total);


          });
        }
      });
     }

   });

  } 

});

 });


  function changeDateFormat(inputDate)
{  // expects Y-m-d
  var splitDate= inputDate.split(',');

  var splitDate1= splitDate[0].split('/');

  var year = splitDate1[2];
  var month = splitDate1[0];
  var day = splitDate1[1]; 

  return day + '/' + month + '/' + year + splitDate[1];

}
</script>

<script type="text/javascript">
 setTimeout(function() { 
  window.print();

}, 500);
</script>

</body>

</html>
