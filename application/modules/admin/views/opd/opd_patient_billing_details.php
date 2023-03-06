<?php $this->load->view('back/header_link'); ?>
<style>
  h1,
  h2,
  h3,
  h4,
  h5,
  h6,
  p,
  span {
    margin: 0;
    padding: 0;
  }

  .details_width {
    width: 150px;
    display: inline-block;
  }

  .patient_details_wrapper {
    display: flex;
    justify-content: space-between;
    width: 100%;
  }

  .patient_basic_details_left {
    width: 50%;
  }

  .patient_basic_details_right>p,
  span {
    font-size: 14px;
    font-weight: 500;
    font-family: Arial, sans-serif;
  }

  .patient_basic_details_left >p,
  span {
    font-size: 14px;
    font-weight: 500;
    font-family: Arial, sans-serif;
  }

  .patient_basic_details_left> p {
    font-size: 14px;
    font-weight: 500;
    font-family: Arial, sans-serif;
  }
</style>

<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>

  <div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
      <?php $this->load->view('back/sidebar'); ?>
    </aside>
    <!--Sidebar End-->
    <div class="has-sidebar-left">
      <?php $this->load->view('back/navbar'); ?>
    </div>
    <div class="page has-sidebar-left height-full">
      <header class="accent-3 relative nav-sticky" style="background: #2B3467;border-top:1px solid white">
        <div class="container-fluid text-white">
          <div class="row p-t-b-10 ">
            <div class="col">
              <h4>
                <i class="icon-box"></i>
                <?= $page_title ?>
              </h4>
            </div>
          </div>
        </div>
      </header>
      <?php if (isset($message)) { ?>
        <CENTER>
          <h3 style="color:green;"><?php echo $message ?></h3>
        </CENTER><br>
      <?php } ?>
      <?php echo validation_errors(); ?>


      <div class="section-wrapper">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-8 m-auto">
                      <div class="patient_details_wrapper">
                        <div class="patient_basic_details_left">
                          <p class="details_width">Patient Name</p> <span>: <?= $patient_info[0]['patient_name'] ?></span> <br>
                          <p class="details_width">Mobile No </p> <span>: <?= $patient_info[0]['mobile_no'] ?></span> <br>
                          <p class="details_width">Age</p> <span>: <?= $patient_info[0]['age'] ?></span> <br>
                          <p class="details_width">Gender</p> <span>: <?= $patient_info[0]['gender'] ?></span>
                        </div>

                        <div class="patient_basic_details_right">
                          <p class="details_width">Booked By</p> <span>: <?= $patient_info[0]['operator_name'] ?></span> <br>
                          <p class="details_width">Printed By</p> <span>: <?= $patient_info[0]['operator_name'] ?></span> <br>
                          <p class="details_width">Ref Doctor</p> <span>: <?php foreach ($doctor_info_ref as $key => $value) {

                                                                            if ($value['doctor_id'] == $patient_info[0]['ref_doctor_id']) { ?>
                                <label id="ref_by"><?= $value['doctor_title'] ?></label>
                            <?php }
                                                                          } ?>
                          </span> <br>
                          <p class="details_width">Quack Doctor</p> <span>: <?php foreach ($doctor_info_quack as $key => $value) {
                                                                              if ($value['doctor_id'] == $patient_info[0]['quack_doc_id']) { ?>
                                <label id="ref_by"><?= $value['doctor_title'] ?></label>
                            <?php }
                                                                            } ?></span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-5">
                    <div class="col-lg-8 m-auto">
                      <div class="patient_report_details">

                        <?php
                        foreach ($patient_order_info as $key => $value) {
                          if ($value['payment_status'] == 'unpaid' && $flag == "") { ?>
                            <div id="accordion">
                              <div class="card">
                                <div class="card-header">

                                  <!-- <a href="admin/opd_patient_billing_print_view/<?= $patient_info[0]['id'] ?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-print"></i>Print ( <?= $value['test_order_id'] ?>)</a> -->

                                  <a data-toggle="collapse" href="#collapseOne<?= $value['id'] ?>">
                                    <?= $value['test_order_id'] ?>
                                  </a>


                                  <a style="float: right;background:#2B3467;color:white" href="admin/opd_each_patient_pdf/<?= $value['patient_id'] ?>/<?= $value['id'] ?>" class="btn btn-lg  btn-default"><i class="icon icon-print"></i>Print</a>



                                </div>
                                <div id="collapseOne<?= $value['id'] ?>" class="collapse show" data-parent="#accordion">
                                  <div class="card-body">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <th>SL</th>
                                        <th>Service Booked</th>
                                        <th class="text-right">Charges</th>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($patient_test_details_info as $key => $value1) {
                                          if ($value['id'] == $value1['patient_test_order_id']) { ?>
                                            <tr>
                                              <td align="center"><?= $i ?></td>
                                              <td align="center"><?= $value1['sub_test_title'] ?></td>
                                              <td align="right"><?= number_format($value1['price'], 2, '.', '') ?></td>

                                            </tr>
                                        <?php $i++;
                                          }
                                        }

                                        ?>
                                        <?php
                                        //echo  $total_amount;
                                        $total_amount = $value['total_amount'];

                                        $vat = ($value['vat']);
                                        //echo $vat;
                                        $discount = $value['total_discount'];
                                        $paid_amount = $value['paid_amount'];
                                        //echo $discount;
                                        // echo "</br>";
                                        // echo $paid_amount;
                                        $net_total = ($total_amount + $vat - $discount);
                                        //echo "</br>";
                                        //echo $net_total;
                                        $due = ($net_total - $paid_amount);
                                        //echo "</br>";
                                        // echo $due;

                                        ?>
                                        <tr>
                                          <td colspan="2" align="right">Total</td>
                                          <td align="right"><?= number_format($value['total_amount'], 2, '.', '') ?></td>
                                        </tr>

                                        <tr>
                                          <td colspan="2" align="right">VAT (+)</td>
                                          <td align="right"><?= $value['vat'] ?></td>
                                        </tr>

                                        <tr>
                                          <td colspan="2" align="right">Total Discount (-)</td>
                                          <td align="right"><?= $value['total_discount'] ?></td>
                                        </tr>

                                        <tr>
                                          <td colspan="2" align="right">Net Total </td>
                                          <td align="right"><?= number_format($net_total, 2, '.', '') ?></td>
                                        </tr>

                                        <tr>
                                          <td colspan="2" align="right">Due</td>
                                          <td align="right"><?php echo number_format($due, 2, '.', '') ?></td>
                                        </tr>

                                        <form action="admin/opd_update_payment/<?= $value['id'] ?>/<?= $value['patient_id'] ?>" method="POST">
                                          <tr>
                                            <td colspan="2" align="right"><button class="btn-xs btn-success" type="Button">Pay</button>
                                            </td>
                                            <td><input style="text-align:right" value="<?= number_format(0, 2, '.', '') ?>" class="form-control" type="text" name="update_payment">
                                            </td>

                                          <tr>
                                            <td colspan="2" align="right"><button class="btn-xs btn-success" type="submit">Receive</button>
                                            </td>
                                            <td>
                                            </td>
                                          </tr>
                                        </form>


                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php } else { ?>
                            <div id="accordion">
                              <div class="card">
                                <div class="card-header">
                                  <a class="card-link" data-toggle="collapse" href="#collapseTwo<?= $value['id'] ?>">
                                    <?= $value['test_order_id'] ?>
                                  </a>

                                  <a style="float: right;" href="admin/opd_each_patient_pdf/<?= $value['patient_id'] ?>/<?= $value['id'] ?>" class="btn btn-lg  btn-default"><i class="icon icon-print"></i>Print</a>
                                </div>
                                <div id="collapseTwo<?= $value['id'] ?>" class="collapse show" data-parent="#accordion">
                                  <div class="card-body">
                                    <table class="table table-striped table-hover">
                                      <thead>
                                        <th>SL</th>
                                        <th>Service Booked</th>
                                        <th class="text-right">Charges</th>
                                      </thead>
                                      <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($patient_test_details_info as $key => $value1) {
                                          if ($value['id'] == $value1['patient_test_order_id']) { ?>
                                            <tr>
                                              <td align="center"><?= $i ?></td>
                                              <td align="center"><?= $value1['sub_test_title'] ?></td>
                                              <td align="right"><?= number_format($value1['price'], 2, '.', '') ?></td>

                                            </tr>
                                        <?php $i++;
                                          }
                                        }

                                        ?>
                                        <tr>
                                          <td colspan="2" align="right">Total</td>
                                          <td align="right"><?= number_format($value['total_amount'], 2, '.', '') ?></td>
                                        </tr>

                                        <tr>
                                          <td colspan="2" align="right">VAT</td>
                                          <td align="right"><?= $value['vat'] ?></td>
                                        </tr>

                                        <tr>
                                          <td colspan="2" align="right">Total Discount</td>
                                          <td align="right"><?= $value['total_discount'] ?></td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" align="right">Net Total</td>
                                          <td align="right"><?= number_format(($value['total_amount'] + $value['vat']) - $value['total_discount'], 2, '.', '') ?></td>
                                        </tr>

                                        <tr>
                                          <td colspan="2" align="right">Due</td>
                                          <td align="right"><?= number_format((($value['total_amount'] + $value['vat']) - $value['total_discount']) - $value['paid_amount'], 2, '.', '') ?></td>
                                        </tr>

                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                        <?php   }
                        }
                        ?>

                      </div>
                      <div class="col-md-3"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="control-sidebar-bg shadow white fixed"></div>
  </div>
  <?php $this->load->view('back/footer_link'); ?>
</body>

</html>