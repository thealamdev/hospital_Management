<script type="text/javascript">
  setTimeout(function() {
    window.print();
    // self.close();
  }, 1000);
</script>

<base href="<?= base_url(); ?>">
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
    body {
      width: 700px !important;
      height: 100vh;
      margin: 0 auto;
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

    tr:nth-child(odd) {
      background-color: #f2f2f2;
    }

    td {
      border-bottom: 1px solid #CBE4DE;
    }

    td:nth-child(last) {
      border-bottom: none;
    }

    thead {
      text-align: center;
      border: 1px solid gray;
    }

    .profile_header_wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 90%;
      margin: 0 auto;
    }

    .profile_header_img{
      width: 25%;
    }

    .profile_header_img img{
      width: 100%;
    }

    .profile_header_info{
      width: 65%;
    }

    .patient_details_wrapper {
      margin-top: 10px;
      width: 100%;
      display: flex;
      justify-content: space-between;
    }

    .patient_left_details p,
    span {
      font-size: 16px;
      font-weight: 500;
      font-family: Arial, sans-serif;
    }

    .patient_right_details p {
      font-size: 16px;
      font-weight: 500;
      font-family: Arial, sans-serif;
    }

    .details_width {
      width: 100px;
      display: inline-block;
    }

    .detail_width {
      width: 150px;
      display: inline-block;
    }

    .profile_footer_wrapper {
      margin-top: 15px;
      display: flex;
      width: 100%;
      justify-content: space-between;
    }

    .profile_footer_left {
      width: 68%;
    }

    .profile_footer_right {
      width: 32%;
    }

    .developer_details {
      margin-top: 30px !important;
      width: 100%;
      margin: 0 auto;
      text-align: center;
    }
    .developer_details p{
      font-size: 14px;
      font-family: Arial, sans-serif;
    }

    .profile_footer_left p,span {
      font-size: 16px;
      font-weight: 500;
      font-family: Arial, sans-serif;
    }

    .profile_footer_right p,span {
      font-size: 16px;
      font-weight: 500;
      font-family: Arial, sans-serif;
    }
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

  <div class="profile_header_wrapper">

    <div class="profile_header_img">
      <img src="uploads/hospital_logo/<?= $hos_logo ?>" alt="uploads/hospital_logo/<?= $hos_logo ?>">
    </div>

    <div class="profile_header_info">
      <h3><?= $hospital_title_eng_report ?></h3>
      <h3><?= $hospital_title_ban_report ?></h3>
      <p><?= $address_report ?></p>
      <p><?= $others_report ?></p>
    </div>

  </div>

  <div class="profile_report_wrapper">
    <h3 style="text-align: center;">IPD CASH RECEIPT</h3>
  </div>
  <!-- here code  -->
  <div class="patient_details_wrapper">

    <div class="patient_left_details">

       
      <?php
        require 'vendor/autoload.php';
        $generator = new BarcodeGeneratorHTML();
        echo $generator->getBarcode( $patient_info[0]['patient_info_id'], $generator::TYPE_CODE_128);
        ?>
       
      <p class="details_width" style="margin-top: 3px;">Patient Id</p> <span>: <?= $patient_info[0]['patient_info_id'] ?></span><br>
      <p class="details_width">Bill No</p> <span>: <?= $final_bill_info[0]['invoice_order_id'] ?></span> <br>
      <p class="details_width">Patient Name </p> <span>: <?= $patient_info[0]['patient_name'] ?> </span> <br>
      <p class="details_width">Doctor</p> <span>: <?= $patient_info[0]['doc_name'] ?></span> <br>
      <p class="details_width">Ref.Dr Name</p> <span>: <?= $patient_info[0]['ref_doc_name'] ?></span>

    </div>

    <div class="patient_right_details">
      <p class="details_width">Admit Date</p> <span>: <?= date('d-M-Y h:i:s a', strtotime($patient_info[0]['created_at'])) ?></span> <br>
      <p class="details_width">Release Date </p> <span>: <?= date('d-M-Y h:i:s a', strtotime($patient_info[0]['released_date'])) ?></span> <br>

      <p class="details_width">Age</p> <span>: <?= $patient_info[0]['age'] ?></span> <br>

      <p class="details_width">Sex</p> <span>: <?= $patient_info[0]['gender'] ?></span> <br>

      <p class="details_width">Mobile</p> <span>: <?= $patient_info[0]['mobile_no'] ?></span>



    </div>

  </div>

  <table class="table">
    <thead style="text-align: left;">
      <th>SL</th>
      <th>Service Type</th>
      <th>Service Name</th>
      <th>Qty</th>
      <th>Price</th>
      <th>Sub Total</th>
      <th>Total</th>
    </thead>
    <tbody>

      <?php $i = 1;
      $days = 0;
      $total = 0;
      $total_cabin = 0;
      $total_operation = 0;
      $total_service = 0;
      $total_cabin_show = 0;

      ?>

      <tr>
        <td style="text-align: center;">1</td>
        <td>Admission</td>
        <td>Admission Fee</td>
        <td></td>
        <td><?= $final_bill_info[0]['admission_fee'] ?></td>
        <td><?= $final_bill_info[0]['admission_fee'] ?></td>
        <td><?= $final_bill_info[0]['admission_fee'] ?></td>
      </tr>


      <tr>
        <td style="text-align: center;">2</td>

        <td>Cabin</td>

        <td>

          <?php foreach ($patient_timeline as $key => $value) {
            if ($key < count($patient_timeline) - 1) { ?>



              <span style=""> <b>Room:</b> <?= $value['room_title'] ?> <br><b>Duration:</b> <?php
                                                                                            $current_date = date_create(date('Y-m-d H:i:s', strtotime($value['created_at'])));
                                                                                            // echo  $current_date;
                                                                                            // echo  $next_date;
                                                                                            $next_date = date_create(date('Y-m-d H:i:s', strtotime($patient_timeline[$key + 1]['created_at'])));
                                                                                            $diff = date_diff($next_date, $current_date);
                                                                                            $hours = $diff->h;
                                                                                            $days = $diff->d;

                                                                                            echo $days . 'd ' . $hours . 'h';

                                                                                            $price_per_hour = $value['room_price'] / 24;

                                                                                            $total_cabin_show = round($days * $value['room_price']) . ' + ' . round($hours * $price_per_hour);
                                                                                            $total_cabin = round($days * $value['room_price']) + round($hours * $price_per_hour);
                                                                                            ?>

              </span><br>

          <?php $i++;
            }
          } ?>

        </td>
        <td></td>

        <td>

          <?php foreach ($patient_timeline as $key => $value) {
            if ($key < count($patient_timeline) - 1) { ?>

              <span style=""><?= $value['room_price']; ?>


              </span><br>

          <?php }
          } ?>

        </td>

        <td>

          <?= $total_cabin_show ?>


        </td>





        <td><?= $total_cabin ?></td>

      </tr>



      <?php if ($service_info != null) { ?>

        <tr>
          <td style="text-align: center;">3</td>
          <td>Service</td>

          <td>

            <?php


            foreach ($service_info as $key => $value) { ?>


              <table class="table">
                <tr>
                  <td>
                    <span align="left"><?= $value['service_name'] ?> (<?= $value['operated_name'] ?>)</span><br />
                  </td>
                </tr>
              </table>
            <?php }  ?>


          </td>

          <td>

            <?php


            foreach ($service_info as $key => $value) { ?>


              <table class="table">
                <tr>
                  <td>
                    <span style=""><?= $value['qty'] ?></span><br />
                  </td>
                </tr>
              </table>

            <?php }  ?>


          </td>

          <td>

            <?php

            foreach ($service_info as $key => $value) { ?>

              <table class="table">
                <tr>
                  <td>
                    <span><?= $value['price'] ?></span><br />
                  </td>
                </tr>
              </table>



            <?php $total_service += $value['price'] * $value['qty'];
            }  ?>

          </td>

          <td>

            <?php

            foreach ($service_info as $key => $value) { ?>
              <table class="table">
                <tr>
                  <td>
                    <span><?= $value['price'] * $value['qty']; ?></span><br />
                  </td>
                </tr>
              </table>
            <?php } ?>


          </td>



          <td>
            <?= $total_service; ?>
          </td>


        </tr>

      <?php } ?>

    </tbody>
  </table>

  <div class="profile_footer_wrapper">
    <div class="profile_footer_left">
      <p class="detail_width">User</p><span>: <?= $patient_info[0]['operator_name'] ?></span> <br>
      <p class="detail_width">Dis. Ref. Name</p><span>: <?= $final_bill_info[0]['discount_ref'] ?></span> <br>
      <p class="detail_width">Status </p><span>: <?php if (round($final_bill_info[0]['total_amount']) + $final_bill_info[0]['total_vat'] - $final_bill_info[0]['total_discount'] <= $final_bill_info[0]['total_paid']) {

                                                  echo "Paid";
                                                } else {
                                                  echo "Due";
                                                }

                                                ?></span>
    </div>
    <div class="profile_footer_right">
      <p class="detail_width">Total Amount</p><span>: <?php echo round($final_bill_info[0]['total_amount']) ?></span> <br>
      <p class="detail_width">Service Charge(+)</p><span>: <?php echo $final_bill_info[0]['total_vat'] ?></span> <br>
      <?php $net_total = 0;
      $net_total = round($final_bill_info[0]['total_amount']) + $final_bill_info[0]['total_vat'] - $final_bill_info[0]['total_discount'];
      ?>
      <p class="detail_width">Payable Amount</p><span>: <?php echo $net_total ?></span> <br>
      <p class="detail_width">Discount Amount(-)</p><span>: <?php echo $final_bill_info[0]['total_discount'] ?></span> <br>
       
       
      <p class="detail_width">Amount Receive</p><span>: <?php echo $final_bill_info[0]['total_paid'] ?></span> <br>
      <p class="detail_width">Due Amount</p><span>: <?php echo $net_total - $final_bill_info[0]['total_paid'] ?></span>

    </div>
  </div>


  <div class="developer_details">
    <p>Date:<?php echo date('l jS \of F Y h:i:s A') ?> </p>
  </div>





</body>

</html>