<base href="<?=base_url();?>">
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Care Point Hospital</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
     <!--====== STYLESHEETS ======-->
    <link rel="stylesheet" href="back_assets/money_recipt/css/bootstrap.min.css">
    <link rel="stylesheet" href="back_assets/money_recipt/css/style.css">
   <link rel="stylesheet" href="back_assets/money_recipt/css/responsive.css">
     <!--====== FONT AWSOME ======-->
    <link rel="stylesheet" href="back_assets/money_recipt/css/all.css" integrity="sha384-VY3F8aCQDLImi4L+tPX4XjtiJwXDwwyXNbkH7SHts0Jlo85t1R15MlXVBKLNx+dj" crossorigin="anonymous">
    </head>
 <style>
    .container {
        height: 595px!important;
        width: 421px!important;
       border:1px solid #ebebeb;
        /* to centre page on screen*/
        margin:20px 0px;
        margin-left: auto;
        margin-right: auto;
    }

    .table th {

    padding:0px!important;
    vertical-align: top;
    border-top: 1px solid #dee2e6;

}
 .table td {

    padding:0px!important;
    vertical-align: top;
    border-top: 1px solid #dee2e6;

}
    </style>
</head>
<body>
                <!-- <input  type="hidden" id="hidden_patient_id" value="<?=$patient_id?>" name="">
                <input  type="hidden" id="hidden_order_id" value="<?=$order_id?>" name=""> -->
	<div class="container">
		<div style="margin:0 auto; " class="row text-center">
			<div><img style="margin:0 auto; margin-top:10px" height="50px" width="50px" src="back_assets/img/dummy/u4.PNG" alt=""></div>
			<div style="margin-left:10px; margin-top:10px"><h1 style="margin:0 auto; font-size:14px; padding-bottom: 5px; color:red;   ">
				ফ্যামিলি কেয়ার হাসপাতাল (প্রাঃ)</h1>
				<h1 style="margin:0 auto; font-size:14px; padding-bottom: 5px; color:blue;" >এন্ড ডায়াগণস্টিক সেন্টার </h1>

			</h1>
            <p style="font-size:9px;margin-top:5px">আদালত পারা মসজিদ সংলগ্ন, ভূঁইয়া ম্যানশন, হাজী
            মহসিন রোড
            চাঁদপুর  <br>
			মোবাইল : ০১৭১২-৪৯১৬৫৫</p>
			</div>
			
		</div>


	<div style="margin:0 auto; margin-top:0px" class="row text-center">
		<div  class="col-lg-4 col-md-4"><img style="margin-left: -25px;" width="100px" height="50px" src="back_assets/money_recipt/images/Code39Barcode.jpg" alt=""></div>
	<div  class="col-lg-4 col-md-4"><p style="border-bottom:1px solid #111111; font-size: 12px">CASH RECEIPT</p></div>
	<div  class="col-lg-4 col-md-4"><img width="100px" height="50px" src="back_assets/money_recipt/images/Code39Barcode.jpg" alt=""></div>
	</div>

	<div style="margin:0 auto; margin-top:0px; font-size:9px;" class="row text-center">
		<div  class="col-lg-6 col-md-6 text-left">

			<p> <b>Bill No</b> &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;: <?=$sell_details[0]['bill_no'];?><label id="invoice"></label></p>
			<p style="margin-top:-15px"><b>Purchage Code</b>&nbsp; : <?=$sell_details[0]['sell_code'];?> <span style="margin-left: 40px"></span></p>
			<p style="margin-top:-15px"><b>Supplier Name &nbsp; &nbsp; &nbsp; &nbsp; </b>: <?=$sell_details[0]['cust_name'];?> <label id=""></label></p>
			<!-- <p style="margin-top:-15px"><b>Ref. Doctor</b>  :<?=$patient_info[0]['ref_doctor_name']?></p>
			<p style="margin-top:-15px"><b>Mobile</b>  : <?=$patient_info[0]['mobile_no']?> </p> -->
		</div>
	<div  class="col-lg-6 col-md-6 text-left"><p><b>Date</b>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; : <?php $only_date_array=explode(' ', $sell_details[0]['created_at']);
                      $only_date=$only_date_array[0];
                     echo date('d M Y', strtotime($only_date));
                    // echo " ".date('h:i:a', strtotime($only_date_array[1]));
                  ?>     </p>
		<!-- <p style="margin-top:-15px"> <b>Age</b> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;: <?=$patient_info[0]['age']?> <span style="margin-left:50px"><?=$patient_info[0]['gender']?></span></p>
		<p style="margin-top:-15px"> <b>Q/C Doc</b> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;: <?=$patient_info[0]['quack_doc_name']?></p>
		
		<p style="margin-top:-15px"><b>Delivery Type</b> : Normal</p> -->

	</div>
	
	</div>

	<div class="static-data">
		<table style="border:0px solid #00000; font-size: 9px" class="table">
  <thead>
    <tr>
						<th>S.L</th>
                        <th >Product Name</th>
                        <th >Qty</th>
                        <th >Price</th>
                        
                        <th >Price*Qty</th>
    </tr>
  </thead>
  <tbody>
  	<tr >
                          <?php foreach ($sell_details as $key => $row) { ?>
                            
                          <td align=""><?=$key+1;?></td>
                          <td align=""><?=$row['p_name'];?></td>
                          <td align=""><?=$row['sell_qty'];?>&nbsp;<?=$row['unit'];?>
                          </td>
                          <td align=""><?=number_format($row['sell_price'],2);?>&nbsp;৳ 
                          </td>
                          <td align=""><?=number_format(($row['sell_price']*$row['sell_qty']),2);?>&nbsp;৳ 
                          </td> 
                        </tr>
                        <?php } ?>
                        
                        <tr>
                          <td colspan="4" align="middle">
                            <strong>Total:</strong>
                          </td>
                          <td align="">
                            <?=number_format($row['credit'],2);?>&nbsp;৳
                          </td>
                        </tr>
                        
                        <tr>
                          <td colspan="4" align="middle">
                            <strong>Paid:</strong>
                          </td>
                          <td align="">
                            <?=number_format($row['debit'],2);?>&nbsp;৳
                          </td>

                        </tr>

                        
                        
                        <tr>
                          <td colspan="4" align="middle">
                            <?php $ad= $row['debit']-$row['credit'];?>
                          <?php if($ad>0){ ?>
                            <strong class="text-success">Advance</strong>
                          <?php } else if($ad<0){  ?>

                            <strong class="text-danger">Due</strong>
                          <?php }  else {?>
                            <strong class="text-default">Due/Advance</strong>
                          <?php } ?>

                          </td>
                          <td align="">
                            <?php if($ad>=0){ ?>
                            <?=number_format($ad,2);?>&nbsp;৳
                            <?php } if($ad<0){ ?>
                            <?=number_format(($ad*(-1)),2);?>&nbsp;৳
                            <?php }  ?>                   
                          </td>   
                        </tr>

   
  </tbody>
</table>


<div style="margin:0 auto; margin-top:0px; font-size:9px;" class="row text-center">
		<div  class="col-lg-6 col-md-6 text-left"><p > <b>Remarks</b> : </p>
			<p style="margin-top:-15px"><b>User</b>  : <?=$username?>    </p>
			<div>
				<!--<p style="margin-top:-15px"><b>Due Collection Details</b></p>
			<p style="margin-top:-15px"><b>Net Due Paid</b> <span style="margin-left:20px">0</span>  </p>
			<p style="margin-top:-15px"><b>Due Discount</b>  <span style="margin-left:20px">0</span> </p>-->
			</div>
			<div style="margin-left:120px; margin-top:-45px;font-size: 18">
				<b><label id="payment_status"></label>
</b>		</div>
			
		</div>
	<!-- <div style="padding-left: 50px"  class="col-lg-6 col-md-6 text-left"> -->
<!-- <div >
		<p><b>Service Amount</b>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; :<?php echo $total_amnt?></p>
		<p style="margin-top:-15px"> <b>Discount Amount</b>&nbsp;(-) &nbsp;: <?php echo $total_discount?>% </p>
<p style="margin-top:-15px;border-bottom: 1px solid #ebebeb; padding-bottom: 10px; "> <b>VAT </b>&nbsp;(+) &nbsp;&nbsp;&nbsp;: <?php echo $vat?>% </p>

		</div>
		<p style="margin-top:-15px"><b>Payable Amount</b>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;  : <?php echo $net_amnt?></p>
		<p style="border-bottom: 1px solid #ebebeb; "><b>Amount Received</b>&nbsp; &nbsp;&nbsp; &nbsp; :<?php echo $paid_amount?></p>
<p style="margin-top:-15px"><b>Due Amount</b> : <?php echo $due?></p>
	</div>-->
	
	<!-- </div>  -->



	</div>
	
</div>

<footer>
	<div style="margin:0 auto; margin-top:50px; font-size:9px;" class="row text-center">
	<div style="width:70%!important" class="col-lg-6 col-md-6 text-left">
		<p>Developed By: Softwareparkbd / 01813322678,01816306190 </p>
		<p style="margin-top:-15px"><?php echo date('d-m-y')?></p>
	</div>

</div>
</footer>


	
  <!--=======  SCRIPTS =======-->
    <script src="back_assets/money_recipt/js/jquery.min.js"></script>
    <script src="back_assets/money_recipt/js/popper.min.js"></script>
    <script src="back_assets/money_recipt/js/bootstrap.min.js"></script>
    <script src="back_assets/money_recipt/js/custom-js.js"></script>

 

    
</body>
</html>