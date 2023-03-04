 <base href="<?= base_url(); ?>">
 <!DOCTYPE html>
 <html lang="en">

 <head>
   <meta charset="utf-8">
   <title>

   </title>
   <meta charset="utf-8">
   <meta content="width=device-width, initial-scale=1" name="viewport">
   <link href="back_assets/money_receipt/css/google_api.css" rel="stylesheet">
   </link>

   <style>
     body {
       width: 700px !important;
       height: 100vh;
       margin: 0 auto;
       /* to centre page on screen*/
       /* margin:1px 0px;
     margin-left: auto;
     margin-right: auto;
     font-family:  serif; */
     }

     .farhana-table-1-col-1 {
       vertical-align: top;
     }

     .first-h1 {
       font-size: 16px;
       color: #111111;
       text-align: center;
       font-weight: 600;
     }

     .first-p {
       font-size: 14px;
       color: #111111;
       text-align: center;
       margin-top: -10px;

     }

     .first-p-1 {
       font-size: 15px;
       color: #111111 !important;
       text-align: center;
       margin-top: -10px;
       font-family: 'BenchNine', sans-serif;

     }

     .farhana-table-2 {
       width: 90%;
     }

     .table-1-col-1 {
       width: 35%;
       text-align: center;
     }

     .table-1-col-1 p {

       font-weight: bold;
       text-align: center;
       font-size: 16px;
       text-decoration: underline;
     }

     .farhana-table-3 {
       margin: 0 auto;
       width: 95%;
       margin-top: 10px;

     }

     .farhana-table-3 tr td {
       font-size: 12px;

     }

     .doctor-name {
       font-size: 12px;
     }

     .text-right {
       text-align: right;
     }

     .text-center {
       text-align: center;
     }

     .farhana-table-4 {

       width: 95%;
       margin: 0 auto;
       margin-top: 10px;
       border-collapse: collapse;
       border: 1px solid #111111;
       font-size: 12px;
     }

     .farhana-table-4 tr th {
       border: 1px solid #111111;
       border-collapse: collapse !important;
       text-align: center;
       padding: 2px;
       padding-left: 7px;
     }

     .farhana-table-4 tr th:nth-child(2) {
       text-align: left;
       width: 55%;
     }

     .farhana-table-4 tr td:nth-child(2) {
       text-align: left;
       width: 55%;
     }

     .farhana-table-4 tr td {
       border: 1px solid #111111;
       border-collapse: collapse !important;
       text-align: center;
       padding: 2px;
       padding-left: 7px;
     }

     .farhana-table-5 {
       margin-top: 10px;
       width: 95%;
       margin-left: 8px;

     }

     .farhana-table-6 {
       margin-top: 50px;
       width: 95%;
       margin: 0 auto;

     }

     .farhana-table-5 tr td:nth-child(2) {
       width: 25% !important;

     }

     .farhana-table-5 tr td:last-child {
       width: 25% !important;

     }


     .farhana-table-4-col-1 {
       width: 10%;
     }

     .farhana-table-4-col-2 {
       width: 50%;
     }

     .farhana-table-4-col-3 {
       width: 22%;
     }

     .farhana-table-5 tr td {

       font-size: 12px;

     }

     .tranform-text {
       font-size: 38px !important;
       font-weight: bold;
       transform: rotate(-0deg);
       text-align: center;
       vertical-align: middle;
       width: 57%;
     }

     .unit-class {
       font-size: 12px;
       padding: 0px 0px;
     }

     .delivery {
       font-size: 10px;
     }

     .last-p {
       padding: 4px;
       font-size: 10px;
       border: 1px solid #111111;
       border-radius: 13px;
       width: 163px;
       margin: 5px 0px;
     }

     .print {
       font-size: 12px;
     }

     .authorize {
       font-size: 15px;
       text-decoration: overline;
       text-align: right;
     }

     h1,
     h2,
     h3,
     h4,
     h5,
     h6,
     p {
       margin: 0;
       padding: 0;
     }

     .hostiptal_info {
       flex-direction: column;
       text-align: center;
       width: 100%;
       display: flex;
       justify-content: space-between;
     }

     .hostipal_img {
       width: 20%;
       margin: 0 auto;
     }

     .hostipal_img img {
       width: 100%;
     }

     .cash_recipt_wrapper {
       margin-top: 10px;
     }

     .cash_recipt_wrapper h2 {
       text-align: center;
       font-weight: 600;
       font-size: 20px;
       text-decoration: underline;
     }

     .patient_details_wrapper {
       width: 100%;
       display: flex;
       justify-content: space-between;
     }

     .patient_left_details p {
       font-size: 16px;
       font-weight: 500;
       font-family: Arial, sans-serif;
     }

     .patient_right_details p {
       font-size: 16px;
       font-weight: 500;
       font-family: Arial, sans-serif;
     }

     table {
       margin-top: 10px;
       padding: 10px;
       border-collapse: collapse;
       width: 100%;
       font-family: Arial, sans-serif;
     }

     th {
       background-color: gray;
       color: white;
     }

     tr:nth-child(even) {
       background-color: #f2f2f2;
     }

     thead {
       text-align: center;
       border: 1px solid gray;
     }

     .accounts_wrapper {
       margin-top: 10px;
     }

     .payment_auth_wrapper {
       display: flex;
       justify-content: space-between;
       margin-top: 20px;
     }


     .authentication h4 {
       display: inline-block;
       position: relative;
       font-size: 16px;
       font-weight: 500;
       font-family: Arial, sans-serif;
     }

     .authentication h4::after {
       left: 0;
       bottom: -10px;
       position: absolute;
       content: '';
       width: 100%;
       height: 1px;
       background: #222;

     }

     /* tbody{
      text-align: center;
    } */
   </style>

 </head>

 <?php

  use Picqer\Barcode\BarcodeGeneratorHTML;

  $hos_logo = $this->session->userdata['logged_in']['hospital_logo'];
  $hospital_title_eng_report = $this->session->userdata['logged_in']['hospital_title_eng_report'];
  $hospital_title_ban_report = $this->session->userdata['logged_in']['hospital_title_ban_report'];
  $address_report = $this->session->userdata['logged_in']['address_report'];
  $others_report = $this->session->userdata['logged_in']['others_report'];
  ?>

 <body>


   <!-- <div> -->

   <!-- <div>

      <table class="farhana-table-1">
        <tr>
          <td class="farhana-table-1-col-1">
            <img height="60px" width="60px" src="uploads/hospital_logo/<?= $hos_logo ?>">
          </td>
          <td>
           <h1 class="" style="margin-bottom: 4px; font-size: 18px; text-align: center;margin-left: 5px;">
             <?= $hospital_title_eng_report ?>
           </h1>

           <h1 style="margin-top: 0px; font-size: 16px; text-align: center;margin-left: 5px;">
            <?= $hospital_title_ban_report ?>
          </h1>

          <p class="first-p"><?= $address_report ?></p>
          <p class="first-p-1"><?= $others_report ?></p>
          </td>

        </tr>
      </table>

  </div> -->
   <div class="pdf_container">
     <div class="hostiptal_info">
       <div class="hostipal_img">
         <img src="uploads/hospital_logo/<?= $hos_logo ?>" alt="uploads/hospital_logo/<?= $hos_logo ?>">
       </div>

       <div class="hospital_details">
         <h3><?= $hospital_title_eng_report ?></h3>
         <h4><?= $hospital_title_ban_report ?></h4>
         <p><?= $address_report ?></p>
         <p><?= $others_report ?></p>
       </div>

     </div>
     <div class="cash_recipt_wrapper">
       <h2 style="text-align: center;">CASH RECEIPT</h2>
     </div>
     <!-- <table class="table table-striped">
      <tr>
        <td class="table-1-col-1"></td>
        <td class="table-1-col-1">
          <p>CASH RECEIPT</p>
        </td>
        <td class="table-1-col-1"></td>
      </tr>
    </table> -->
   </div>

   <div class="patient_details_wrapper">
     <div class="patient_left_details">
       <p>Patient ID: <?= $test_info[0]['patient_id'] ?> </p>
       <?php
        require 'vendor/autoload.php';
        $generator = new BarcodeGeneratorHTML();
        echo $generator->getBarcode($test_info[0]['patient_id'], $generator::TYPE_CODE_128);
        ?>

       <p>Bill No: <?= $test_info[0]['test_order_id'] ?></p>
       <p>Patient Name: <?= $test_info[0]['patient_name'] ?> </p>
       <p>Sex: <?= $test_info[0]['gender'] ?></p>
       <?php if ($is_ipd_patient == 1) { ?>
         <p>Ipd Patient Id: <?= $ipd_info[0]['patient_info_id'] ?></p>
       <?php } ?>
       <p>Doctor Name: <?= $test_info[0]['ref_doc_name'] ?></p>

     </div>
     <div class="patient_right_details">
       <p>Date: <?= date("d-m-Y H:i:s", strtotime($test_info[0]['created_at'])) ?></p>
       <p>Mobile No: <?= $test_info[0]['mobile_no'] ?></p>
       <?php if (!empty($uhid_info)) { ?>
         <p>UHID: <?= $uhid_info[0]['gen_id'] ?></p>
       <?php } ?>
       <p>Age: <?= $test_info[0]['age'] ?></p>
       <?php if ($is_ipd_patient == 1) { ?>
         <p>Cabin No: <?= $ipd_info[0]['room_title'] ?></p>
       <?php } ?>
     </div>
   </div>

   <!-- <table class="farhana-table-3">
    <tr>
      <td colspan="2"><b>Bill No: </b><b><b><label id="invoice"><?= $test_info[0]['test_order_id'] ?></label></td>
      <td><b><b>Date: </b><label id="date_time"><?= date("d-m-Y H:i:s", strtotime($test_info[0]['created_at'])) ?></label></td>
    </tr>
    <tr>
      <td colspan="2"><b>Patient Name: </b><b><b><label id="patient_name"><?= $test_info[0]['patient_name'] ?></td>
    <tr>
      <td style="text-align: left"><b>Sex: </b><b><b><label id="gender"><?= $test_info[0]['gender'] ?><b> / Age:</b><label id="age"><?= $test_info[0]['age'] ?></label></td>
      <td class="text-left">
      <td><b>Mob: </b><b><b><label id="phone_no"><?= $test_info[0]['mobile_no'] ?></label></td>
    </tr>

    <?php if (!empty($uhid_info)) { ?>
      <td colspan="2"><b>UHID: </b><label id="uhid"><?= $uhid_info[0]['gen_id'] ?></label></td> <?php } ?>

    </tr>

    <tr>
      <td colspan="3" class="doctor-name"><b>Dr. Name: </b><b><b><label id="ref_by"><?= $test_info[0]['ref_doc_name'] ?></label></td>
    </tr>


    <?php if ($is_ipd_patient == 1) { ?>
      <tr>
        <td colspan="2" class="doctor-name"><b>Ipd Patient Id: </b><b><b><label id="ipd_patient_id"><?= $ipd_info[0]['patient_info_id'] ?></label></td>

        <td colspan="3" class="doctor-name"><b>Cabin No: </b><b><b><label id="cabin_no"><?= $ipd_info[0]['room_title'] ?></label></td>
      </tr>

    <?php } ?>



  </table> -->

   <table class="investication_wrapper">
     <thead>
       <th>SL</th>
       <th>Name Of Investigation</th>
       <th>Amount</th>
     </thead>
     <!-- <tr>
      <th class="farhana-table-4-col-1">
        SL
      </th>
      <th class="farhana-table-4-col-2">
        Name Of Investigation
      </th>
      <th class="farhana-table-4-col-3">
        Amount
      </th>
    </tr> -->

     <tbody id="patient_ordered_test_table">
       <?php foreach ($order_info as $key => $value) {

        ?>

         <tr>
           <td>
             <?= $key + 1 ?>
           </td>
           <td><?= $value['sub_test_title'] ?></td>
           <td><?= $value['price'] ?></td>
         </tr>

       <?php } ?>
     </tbody>

   </table>


   <div class="accounts_wrapper">

     <div class="payment_status_wrapper">
       <h2 style="text-align: center;text-decoration:underline">PAYMENT DETAILS</h2>
     </div>
     <div class="payment_details">
       <table>
         <thead>
           <th>Total Amount</th>
           <th>Vat (+)</th>
           <th>Discount (-)</th>
           <th>Net Amount</th>
           <th>Receive Amount</th>
           <th>Due Amount</th>
         </thead>

         <tbody>
           <tr>
             <td><?= $test_info[0]['total_amount'] ?></td>
             <td><?= $test_info[0]['vat'] ?></td>
             <td><?= $test_info[0]['total_discount'] ?></td>
             <td><?= ($test_info[0]['total_amount'] + $test_info[0]['vat']) - $test_info[0]['total_discount'] ?></td>
             <td><?= $test_info[0]['paid_amount'] ?></td>
             <td><?= (($test_info[0]['total_amount'] + $test_info[0]['vat']) - $test_info[0]['total_discount']) - $test_info[0]['paid_amount'] ?></td>
           </tr>
         </tbody>
       </table>
     </div>


   </div>

   <div class="payment_auth_wrapper">

     <div class="authentication">
       <h4>Authorize Signature: <i><?= $test_info[0]['operator_name'] ?></i></h4>
     </div>
     <div class="payment_status">
       <?php if ($test_info[0]['payment_status'] == "paid") { ?>
         <img src="uploads/payment-status/paid.avif" width="100px" alt="uploads/hospital_logo/<?= $hos_logo ?>">
       <?php } else { ?>
         <img src="uploads/payment-status/unpaid.jpg" width="100px" alt="uploads/hospital_logo/<?= $hos_logo ?>">
       <?php } ?>
     </div>
   </div>
   <!-- <div class="static-data">

    <div style=" padding-bottom:5px">
      <table style="margin-top:60px;margin-left:70px">
        <tr>
          <td class="authorize">Authorize Sig: <label id="booked_by"><?= $test_info[0]['operator_name'] ?></label></td>
          <td class="tranform-text"><span><label id="payment_status">

                <?php if ($test_info[0]['payment_status'] == "paid") {
                  echo "Paid";
                } else {
                  echo "Due";
                }
                ?>

              </label></span></td>
        </tr>

      </table>
      <table class="farhana-table-5" style="margin-top:-100px;margin-left:100px;margin-bottom:10px;">
        <tr>
          <td rowspan="6"></td>
          <td><b>Total Amount </b></td>
          <td> :<label id="total_amount"><?= $test_info[0]['total_amount'] ?></label></td>


        </tr>
        <tr>

          <td><b>Vat(+)</b></td>
          <td> :<label id="vat"><?= $test_info[0]['vat'] ?></label></td>


        </tr>
        <tr>

          <td><b>Dis(-) </b></td>
          <td> :<label id="total_discount"><?= $test_info[0]['total_discount'] ?></label>


        </tr>
        <tr>

          <td><b>Net Amount </b></td>
          <td> :<label id="net_total"><?= ($test_info[0]['total_amount'] + $test_info[0]['vat']) - $test_info[0]['total_discount'] ?></label></td>


        </tr>
        <tr>

          <td><b>Received Amount </b></td>
          <td> :<label id="paid_amount"><?= $test_info[0]['paid_amount'] ?></label></td>


        </tr>
        <tr>

          <td><b>Due Amount </b></td>
          <td> :<label id="due_amnt"><?= (($test_info[0]['total_amount'] + $test_info[0]['vat']) - $test_info[0]['total_discount']) - $test_info[0]['paid_amount'] ?></label></td>


        </tr>


      </table>

    </div>

  </div>

  </div> -->


   <div class="direction_wrapper">
     <p>Discount By: <?= $test_info[0]['discount_ref'] ?></p>
     <p>Ref Dr. ID: <?= $test_info[0]['quack_doc_name'] ?></p>

     <div class="direction_details">
       <h4>যেসকল রুমে যাবেন :</h4>
       <ul>
         <li>কালেকশন রুম-১১২ **</li>
         <li>ইসিজি রুম-১১০ **</li>
         <li>আল্ট্রা রুম-১০৮ **</li>
         <li>এক্স রে রুম-১০৬</li>
         <li>রিপোর্ট ডেলিভারি-১০২ **</li>
         <li>ফার্মেসি-১০৩ **</li>
         <li>নার্সিং স্টেশন তৃতীয় তলা</li>
       </ul>
       <h3 style="text-align:center">কাউন্টার ব্যতীত কারো সাথে টাকাপয়সা লেনদেন করিবেন না</h3>
       <h3 style="text-align: center;">রিসিট ব্যতীত কোন রিপোর্ট ডেলিভারি দেওয়া হয় না</h3>
       <p style="text-align: center; margin-top:10px">Print Date: <?php echo "Print Date: " . date('l jS \of F Y h:i:s A') ?></p>
       <p style="text-align: center;font-size:14px">Developed By Shah Alam (01795678789)</p>
     </div>
   </div>

   <footer class="footer">

     <table class="farhana-table-6">

       <!-- <tr>
        <td colspan="2" style="font-size: 12px;"><b>Discount by: </b><label id="dis_refer"><?= $test_info[0]['discount_ref'] ?></label></td>
      </tr>
      <tr>
        <td colspan="2" class="doctor-name"><b>Ref Dr. ID: </b><b><b><label id="quack_by">D-<?= $test_info[0]['quack_doc_name'] ?></label></td>
        <td colspan="2" class="doctor-name">
      </tr>

      <tr>
      <tr> -->
       <!-- <td colspan="2" class="doctor-name"><b>যেসকল রুমে যাবেন :
      </tr>
      <tr>
      <tr>
        <td colspan="2" class="doctor-name"><b>কালেকশন রুম-১১২ **</>ইসিজি রুম-১১০ **</>আল্ট্রা রুম-১০৮ **</>এক্স রে রুম-১০৬
        </td>
      <tr>
      <tr>
        <td colspan="2" class="doctor-name"><b>রিপোর্ট ডেলিভারি-১০২ **</>ফার্মেসি-১০৩ **</>নার্সিং স্টেশন তৃতীয় তলা
        </td>
      <tr>
      <tr>
        <td colspan="2" class="doctor-name"><b>কাউন্টার ব্যতীত কারো সাথে টাকাপয়সা লেনদেন করিবেন না
      <tr>
        <td colspan="2" class="doctor-name"><b>রিসিট ব্যতীত কোন রিপোর্ট ডেলিভারি দেওয়া হয় না
        </td>
        <td></td>
      </tr>
      <tr>
        <td class="print"><?php echo "Print Date: " . date('l jS \of F Y h:i:s A') ?> <br> Developed By: Software Park Bd (01624794910)

      </tr> -->
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