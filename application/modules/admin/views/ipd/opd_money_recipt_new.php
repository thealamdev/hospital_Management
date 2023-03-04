<base href="<?=base_url();?>">
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
            <title>
             Cash Receipt
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
                            </link>
                        </link>
                    </link>
                </meta>
            </meta>
        </meta>

    <style>
        body{
             height: 625px!important;
        width: 421px!important;
      
        /* to centre page on screen*/
        margin:20px 0px;
        margin-left: auto;
        margin-right: auto;
        }
    </style>

    </head>

    <body style="color:#000; text-align: center;">
                    <input  type="hidden" id="hidden_patient_id" value="<?=$patient_id?>" name="hidden_patient_id">
                <input  type="hidden" id="hidden_order_id" value="<?=$order_id?>" name="hidden_order_id">
            <div style="  margin: 0 auto;" class="container">
                <div  class="row">
                    	<div>
                <img style="margin:0 auto; margin-top:10px; text-align: center; margin-left:-271px" height="50px" width="50px" src="back_assets/img/dummy/u4.PNG" alt="">
            </div>
                   	<div style="margin-left:0px; margin-top:10px; float: left; margin-left: 85px;
margin-top: -65px;">
                        <h1 style=" font-size:14px;  color:red; text-align: center   ">
				ফ্যামিলি কেয়ার হাসপাতাল (প্রাঃ)</h1>
				<h1 style="margin:0 auto; font-size:14px; padding-bottom: 5px; color:blue;" >এন্ড ডায়াগণস্টিক সেন্টার </h1>
            <p style="font-size:9px;margin-top:5px">আদালত পারা মসজিদ সংলগ্ন, ভূঁইয়া ম্যানশন, হাজী
            মহসিন রোড
            চাঁদপুর  <br>
			মোবাইল : ০১৭১২-৪৯১৬৫৫</p>
			</div>
                </div>
                
                
                
                <div style="margin:0 auto; padding-top:10px" class="row text-center">
		<div style="width:120px; margin-left:30px"  class="col-lg-4 col-md-4"><img style="margin-left: -75px;" width="100px" height="20px" src="back_assets/money_recipt_new/images/Code39Barcode.jpg" alt=""></div>
	<div  style="width:120px; margin-left:150px; margin-top:-60px" class="col-lg-4 col-md-4"><p style="border-bottom:1px solid #111111; font-size: 12px">CASH RECEIPT</p></div>
	<div  style="width:120px; margin-left:280px; margin-top:-50px" class="col-lg-4 col-md-4"><img style="margin-right: -50px;" width="100px" height="20px" src="back_assets/money_recipt_new/images/Code39Barcode.jpg" alt=""></div>
	</div>

  <table style="padding-top:20px;  margin-left:5px; width:230px; text-align: center;font-size:12px ">
  <tr>
    <th style="text-align: left"><b>Bill No :</b> <span style="font-weight:normal"><label id="invoice"></label></th>
  </tr>

   <tr>
    <th style="text-align: left"><b>Patient ID :</b> <span style="font-weight:normal"><label id="patient_info_id"></label></span></th>
    
      
   
  </tr>
   <tr>
    <th style="text-align: left"><b>Patient Name :</b> <span style="font-weight:normal"><label id="patient_name"></label></span></th>
    
      
   
  </tr>
  <tr>
  
       <th style="text-align: left">Ref. Doctor : <span style="font-weight:normal"><label id="ref_by"></label></span></th>
      
  </tr>

    
    
 
</table>    
                       <table style="padding-top:20px;  margin-left:280px ; margin-top:-100px; width:230px; text-align: center;font-size:12px  ">
  <tr>
    <th style="text-align: left"><b>Date :</b> <span style="font-weight:normal"><label id="date_time"></label></span></th>
   

   
  </tr>

   <tr>
    <th style="text-align: left"><b>Age :</b> <span style="font-weight:normal"><label id="age"></label></span></th>
     
      
   
  </tr>
  <tr>
  
       <th style="text-align: left"><b>Sex :</b> <span style="font-weight:normal"><label id="gender"></label></span></th>
      
  </tr>
   <tr>
  
      <th style="text-align: left"><b>Delivery Type :</b> <span style="font-weight:normal">Normal </span></th>
        
            

  </tr>
     <tr>
  
      <th style="text-align: left"><b>Mobile :</b> <span style="font-weight:normal"><label id="phone_no"></label></span> </th>
        
          

  </tr>
    

 
</table>

   <div class="static-data">
<table style="border-collapse: collapse;font-size: 12px; width:400px; margin-left:10px; margin-top:20px;margin-bottom:20px" class="table">
  <thead>
    <tr>
      <th style="padding:0px!important;border: #000 solid 1px;">SL</th>
      <th style="border: #000 solid 1px;text-align:left;padding:0px 15px">Name of Investigation</th>
      <th style="border: #000 solid 1px;text-align:;padding:0px 15px" align="right" >Amount</th>

    </tr>
  </thead>
  <tbody id="patient_ordered_test_table">

   
  </tbody>
</table>
     
           
                   
                      
             

               


                  <div style=" padding-bottom:10px" class="row">
                  
                   <table style="padding-top:20px;  margin-left:5px; width:170px; text-align: center;font-size:12px ">
  <tr>
    <th style="text-align: left"><b>Remarks</b></th>
   

   
  </tr>
   <tr>
    <th style="text-align: left"><b>User : </b><span style="font-weight:normal"><label id="booked_by"></label></span></th>
     
      
   
  </tr>


   <tr>
  
      <th style="text-align: left"><b>Payment Status</b>  <span style="font-weight:normal"><label id="payment_status"></label></span></th>
        
      

  </tr>

    
    
 
</table>

 <table style="padding-top: 20px;
    margin-left: 158px;
    margin-top: -100px;
    width: 240px;
    text-align: center;
    font-size: 12px;" cellpadding="3px" cellspacing="0px">
  <tr>
    <th style="text-align: left"><b>Total Amount </b></th>
      <td style="text-align: left">  :<label id="total_amount"></label></td>

   
  </tr>

   <tr>
    <th style="text-align: left"><b>Discount Amount (-)</b></th>
      <td style="text-align: left">:<label id="total_discount"></label> </td>
      
   
  </tr>
  <tr >
     
         <th style="text-align: left;border-bottom:1px solid #ebebeb;padding-bottom: 10px; width: 80% "><b>VAT(+)</b> </th>
        <td style="text-align: left;padding-bottom: 10px;border-bottom:1px solid #ebebeb;"> :  <label id="vat"></label>%</td>
        
  </tr>
   <tr>
  
      <th style="text-align: left"><b>Payable Amount</b>  </th>
        
            <td style="text-align: left">:<label id="net_total"></label> </td>

  </tr>
    
     <tr>
  
       <th style="text-align: left;border-bottom:1px solid #ebebeb;padding-top: 10px;"><b>Amount Received</b></th>
        <td style="text-align: left;border-bottom:1px solid #ebebeb;">  :<label id="paid_amount"></label> </td>
  </tr>
                         
                          <tr>
  
       <th style="text-align: left"><b>Due Amount</b></th>
        <td style="text-align: left">  : <label id="due_amnt"></label> </td>
  </tr>
 
</table>


                    </div>
                        
   <table style=" width:400px;padding-left:10px;   text-align: center;font-size:9px  ">
  <tr>
    <th style="text-align: left;font-size: 7px;
    line-height: 1.5;">Developed By Softwareparkbd &Rcreation 
	</br>01813322678,01816306190 <br><?php echo date('l jS \of F Y h:i:s A')?></th>
     

   
  </tr>

   
     
     
  
              
 
</table>
            </div>
            </div>

<!--=======  SCRIPTS =======-->
    <script src="back_assets/money_recipt/js/jquery.min.js"></script>
    <script src="back_assets/money_recipt/js/popper.min.js"></script>
    <script src="back_assets/money_recipt/js/bootstrap.min.js"></script>
    <script src="back_assets/money_recipt/js/custom-js.js"></script>
<script type="text/javascript">

  $(document).ready(function(){
     // alert('hi');
    var patient_id=$('#hidden_patient_id').val();
    var order_id=$('#hidden_order_id').val();

    $.ajax({
            url:"<?=site_url("admin/get_patient_ordered_test_info")?>",
            method:"POST",
            dataType:"json",
            data:{patient_id:patient_id,order_id:order_id},
            success:function(data)
            {
              // var obj=$.parseJSON(data);
               $.each(data, function (key, value) {
                  $('#patient_name').text(value.patient_name);
				  $('#patient_info_id').text(value.patient_info_id);
                  $('#phone_no').text(value.mobile_no);
                  $('#email').text(value.email);
                  $('#age').text(value.age);
                  $('#gender').text(value.gender);
                  $('#invoice').text(value.test_order_id);
                  $('#booked_by').text(value.operator_name);
                  $('#printed_by').text(value.operator_name);
                  $('#ref_by').text(value.ref_doctor_name);
				  $('#booked_by_2').text(value.quack_doc_name);
                  $('#payment_status').text(value.payment_status);
                  $('#date_time').text(value.created_at);
				  $('#quack_doc_name').text(value.quack_doc_name);

                  
                  // var result = new Date('27/07/1990');
                  // result.setDate(result.getDate() + parseInt(2));
                  // var dateEnd = result.getFullYear() + '-' + (result.getMonth()+1) + '-' + result.getDate();
                  // alert(dateEnd);
                  // var myDate = new Date($('#date_time').text(value.created_at)+(5*24*60*60*1000));
                  // alert(myDate);
                  // var date = new Date();
                  // // add a day
                  // alert(date.setDate($('#date_time').text(value.created_at)+ 1));
                  });
            },
                  error: function(e) 
                  {
                    alert(e);
                  }
            
           });

          var i=1;
          $.ajax({
            url:"<?=site_url("admin/get_patient_ordered_test_details_info")?>",
            method:"POST",
            dataType:"json",
            data:{order_id:order_id},
            success:function(data)
            {
               $.each(data, function (key, value) {
                $("#patient_ordered_test_table").append('<tr><td align="center" style="border: #000 solid 1px;">'+i+'</td><td align="center" style="border: #000 solid 1px;text-align:left;padding:0px 15px">'+value.sub_test_title+'</td><td align="right" style="border: #000 solid 1px;text-align:;padding:0px 15px">'+parseFloat(value.price).toFixed(2)+'</td></tr>');
                  i++;
                  });


               $.ajax({
                        url:"<?=site_url("admin/get_order_info")?>",
                        method:"POST",
                        dataType:"json",
                        data:{order_id:order_id},
                        success:function(data){
                        $.each(data, function (key, value) {
							
                          var vat=parseFloat(value.total_amount*(value.vat/100));
                          var net_total=(parseFloat(value.total_amount)+parseFloat(value.total_amount*(value.vat/100)-1*(value.total_discount))).toFixed(2);
                          var due=(parseFloat(net_total)-parseFloat(value.paid_amount)).toFixed(2);
                           $('#total_amount').text(value.total_amount);
						   $('#total_discount').text(value.total_discount);
					       $('#paid_amount').text(value.paid_amount);
						   $('#vat').text(value.vat);
						   $('#due_amnt').text((parseFloat(net_total)-parseFloat(value.paid_amount)).toFixed(2));
						   $('#net_total').text(net_total);
						   

                                            });
                        }
                      });

            }
           });
});
</script>
    </body>
	
</html>
