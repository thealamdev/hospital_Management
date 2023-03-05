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
      background-color: #222;
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
      width: 80%;
      margin: 0 auto;
    }

    .patient_details_wrapper {
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
      width: 200px;
      display: inline-block;
    }

    .profile_footer_wrapper {
      margin-top: 15px;
      display: flex;
      width: 100%;
      justify-content: space-between;
    }

    .profile_footer_left {
      width: 50%;
    }

    .profile_footer_right {
      width: 50%;
    }

    .developer_details{
      margin-top: 30px;
      font-size: 14px;
      font-family: Arial, sans-serif;
      width: 100%;
      margin: 0 auto;
      text-align: center;
    }
  </style>

</head>

<?php
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

      <p class="details_width">Patient Id</p> <span>: <?= $patient_info[0]['patient_info_id'] ?></span><br>
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
  <!-- here code end -->

  <!-- <table style="padding-top:2px;  margin-left:5px; width:500px; text-align: center;font-size:15px ">
    <tr>
      <th style="text-align: left"><b>Bill No :</b> <span style="font-weight:normal"><?= $final_bill_info[0]['invoice_order_id'] ?></span></th>
    </tr>

    <tr>
      <th style="text-align: left"><b>Patient ID :</b> <span style="font-weight:normal"><?= $patient_info[0]['patient_info_id'] ?></span></th>



    </tr>
    <tr>
      <th style="text-align: left"><b>Patient Name :</b> <span style="font-weight:normal"><?= $patient_info[0]['patient_name'] ?></span></th>



    </tr>
    <tr>

      <th style="text-align: left">Doctor : <span style="font-weight:normal"><?= $patient_info[0]['doc_name'] ?></span></th>

    </tr>

    <tr>

      <th style="text-align: left">Ref. Doctor : <span style="font-weight:normal"><?= $patient_info[0]['ref_doc_name'] ?></span></th>

    </tr>




  </table>

  <table style="margin-left:400px ; margin-top:-100px; width:500px; text-align: center;font-size:15px  ">
    <tr>
      <th style="text-align: left"><b>Admit Date :</b> <span style="font-weight:normal"><?= date('d-M-Y h:i:s a', strtotime($patient_info[0]['created_at'])) ?></span></th>
    </tr>

    <tr>
      <th style="text-align: left"><b>Release Date :</b> <span style="font-weight:normal"><?= date('d-M-Y h:i:s a', strtotime($patient_info[0]['released_date'])) ?></span></th>
    </tr>

    <tr>
      <th style="text-align: left"><b>Age :</b> <span style="font-weight:normal"><?= $patient_info[0]['age'] ?></span></th>



    </tr>
    <tr>

      <th style="text-align: left"><b>Sex :</b> <span style="font-weight:normal"><?= $patient_info[0]['gender'] ?></span></th>

    </tr>
    <tr>

    </tr>
    <tr>

      <th style="text-align: left"><b>Mobile :</b> <span style="font-weight:normal"><?= $patient_info[0]['mobile_no'] ?></span> </th>



    </tr>



  </table> -->





  <table class="table">
    <thead>
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
        <td>1</td>
        <td>Admission</td>
        <td>Admission Fee</td>
        <td></td>
        <td><?= $final_bill_info[0]['admission_fee'] ?></td>
        <td><?= $final_bill_info[0]['admission_fee'] ?></td>
        <td><?= $final_bill_info[0]['admission_fee'] ?></td>
      </tr>


      <tr>
        <td>2</td>

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
          <td>3</td>
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
      <p class="detail_width">User</p><span>:<?= $patient_info[0]['operator_name'] ?></span> <br>
      <p class="detail_width">Dis. Ref. Name</p><span>:<?= $final_bill_info[0]['discount_ref'] ?></span> <br>
      <p class="detail_width">Status </p><span>:<?php if (round($final_bill_info[0]['total_amount']) + $final_bill_info[0]['total_vat'] - $final_bill_info[0]['total_discount'] <= $final_bill_info[0]['total_paid']) {

                              echo "Paid";
                            } else {
                              echo "Due";
                            }

                            ?></span>
    </div>
    <div class="profile_footer_right">
      <p class="detail_width">Total Amount</p><span>:<?php echo round($final_bill_info[0]['total_amount']) ?></span> <br>
      <p class="detail_width">Discount Amount</p><span>:<?php echo $final_bill_info[0]['total_discount'] ?></span> <br>
      <p class="detail_width">Vat(+)</p><span>:<?php echo $final_bill_info[0]['total_vat'] ?></span> <br>
      <?php $net_total = 0;
      $net_total = round($final_bill_info[0]['total_amount']) + $final_bill_info[0]['total_vat'] - $final_bill_info[0]['total_discount'];
      ?>
      <p class="detail_width">Payable Amount</p> <span>:<?php echo $net_total ?></span> <br>
      <p class="detail_width">Amount Receive</p><span>:<?php echo $final_bill_info[0]['total_paid'] ?></span> <br>
      <p class="detail_width">Due Amount</p><span>:<?php echo $net_total - $final_bill_info[0]['total_paid'] ?></span>

    </div>
  </div>
 
  <div class="developer_details">
    <p>Date:<?php echo date('l jS \of F Y h:i:s A') ?> </p>
    <p>Developed By Shah Alam</p>
    <p>01795678789</p>
  </div>


  <!-- <div style=" padding-bottom:10px" class="row">

    <table>
      <tr>
        <th><b>User : </b><span style="font-weight:normal"><?= $patient_info[0]['operator_name'] ?></span></th>
      </tr>

      <tr>
        <th><b>Status:</b>
          <span style="font-weight:bold;font-size: 22px;">

            <?php if (round($final_bill_info[0]['total_amount']) + $final_bill_info[0]['total_vat'] - $final_bill_info[0]['total_discount'] <= $final_bill_info[0]['total_paid']) {

              echo "Paid";
            } else {
              echo "Due";
            }

            ?>

          </span>
        </th>
      </tr>
      <tr>
        <th><b>Discount Refer Name : </b><span style="font-weight:normal"><?= $final_bill_info[0]['discount_ref'] ?></span></th>
      </tr>
      <tr>
        <th>Developed By Shah Alam
          </br>01795678789<br><?php echo date('l jS \of F Y h:i:s A') ?></th>
    </table>

    <table style="padding-top: 20px;
          margin-left:400px;
          margin-top: -130px;
          width: 230px;
          text-align: center;
          font-size: 15px;" cellpadding="0px" cellspacing="0px">
      <tr>
        <td style="text-align: left; padding-bottom: 5px;"><b>Total Amount</b>:</td>
        <td><?php echo round($final_bill_info[0]['total_amount']) ?></td>

      </tr>

      <tr>
        <td style="text-align: left; padding-bottom: 5px;"><b>Discount Amount</b>:</td>
        <td><?php echo $final_bill_info[0]['total_discount'] ?> </td>

      </tr>
      <tr>

        <td style="text-align: left; padding-bottom:5px; width: 80% "><b>VAT(+)</b>:</td>
        <td><?php echo $final_bill_info[0]['total_vat'] ?></td>

      </tr>
      <tr>

        <?php $net_total = 0;

        $net_total = round($final_bill_info[0]['total_amount']) + $final_bill_info[0]['total_vat'] - $final_bill_info[0]['total_discount'];


        ?>

        <td style="text-align: left; padding-bottom:5px;"><b>Payable Amount</b>:</td>
        <td><?php echo $net_total ?> </td>


      </tr>

      <tr>

        <td style="text-align: left;padding-bottom:5px;"><b>Amount Received</b>:</td>
        <td><?php echo $final_bill_info[0]['total_paid'] ?></td>
      </tr>

      <tr>

        <td style="text-align: left;"><b>Due Amount</b>:</td>
        <td><?php echo $net_total - $final_bill_info[0]['total_paid'] ?></td>
      </tr>

    </table>


  </div>

  <table style="margin-top:350px; width:420px;padding-left:10px;   text-align: center;font-size:10px  ">




    </tr>







  </table> -->



  </div>


  </div>










</body>

</html>