<?php $this->load->view('back/header_link'); ?>

<body class="light">

  <style type="text/css" media="screen">
 
    .group_report {
      display: flex;
      justify-content: space-between;
    }

    .group_title {
      width: 29%;
    }

    .group_title p {
      font-size: 15px;
      font-weight: 500;
      font-family: Arial, sans-serif;
    }

    .group_clone {
      width: 1%;
    }

    .group_input {
      width: 70%;
    }

    .group_header_title {
      margin: 15px 0;
      text-align: center;
    }

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

    table {
      margin-top: 10px;
      padding: 10px;
      /* border-collapse: collapse; */
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

    .wrapper_table_main{
      border: 1px solid black;
      padding: 15px;
      border-radius: 10px;
    }

    .details_table_wrapper {

      width: 700px;
      border-radius: 5px;
      border: 1px solid #222;
      padding: 10px;
    }

    .details_main {
      width: 700px !important;
      margin: 0 auto;
      display: flex !important;
      justify-content: space-between !important;
    }

    .details_left {
      width: 50%;
    }

    .details_right {
      width: 50%;
    }


    .details_table {
      border: 1px solid #222;
      border-radius: 4px;
      padding: 10px;
    }

    .details_width {
      width: 100px !important;
      display: inline-block !important;
    }

    select {
      padding: 10px;
      font-size: 16px;
      border: none;
      background-color: #f1f1f1;
      width: 100%;
      border-radius: 5px;
    }
 
    iframe#cke_editor iframe body select#select_box {
      border: none;
      color: red;
    }

    .wrapper_table tr th:first-child {
      text-align: left;
      width: 40%;
      border-left: none !important;

      border-bottom-left-radius: 8px;
      border-top-left-radius: 8px;
    }

    .wrapper_table tr th:nth-child(2) {
      text-align: center;
      width: 20%;
    }

    .wrapper_table tr th:last-child {
      text-align: left;
      width: 30%;
      border-right: none !important;
      border-bottom-right-radius: 8px;
      border-top-right-radius: 8px;
    }

    .wrapper_table {
      border-top-left-radius: 8px;
    }
  </style>
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
      <header class="blue accent-3 relative nav-sticky">
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
      <?php if ($this->session->userdata('scc_alt')) { ?>
        <div class="alert alert-success alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
          <a href="javascript:;" class="alert-link"><?= $this->session->userdata('scc_alt'); ?></a>
        </div>
      <?php }
      $this->session->unset_userdata('scc_alt'); ?>
      <?php if (isset($message)) { ?>
        <CENTER>
          <h3 style="color:green;"><?php echo $message ?></h3>
        </CENTER><br>
      <?php } ?>

      <!-- <?php print_r($tecnology_info) ?> -->
      <?php echo validation_errors(); ?>
      <div class="section-wrapper">
        <div class="card my-3 no-b">
          <div class="card-body">
            <div class="container">
              <form action="admin/report_publish_multi/<?= $specimen_id ?>/<?= $payment_status ?>/<?= $prev_module ?>" method="POST" class="ipd_form">
                <input type="hidden" value="<?php echo $patient_info_id ?>" name="patient_info_id" />
                <input type="hidden" value="<?php echo $order_id ?>" name="order_id" />
                <input type="hidden" value="<?php echo $test_id ?>" name="itestid" />

                

                <div class="group_report_wrapper">
                  <div class="group_report">
                    <div class="group_title">
                      <p>Group Name</p>
                    </div>
                    <div class="group_clone">
                      <b>:</b>
                    </div>
                    <div class="group_input">
                      <input class="form-control" value="<?php echo $test_title ?>" readonly type="text" name="group_id" placeholder="" required>
                    </div>

                  </div>

                  

                  <div class="group_report">
                    <div class="group_title">
                      <p>Sepciman</p>
                    </div>
                    <div class="group_clone">
                      <b>:</b>
                    </div>
                    <div class="group_input">
                      <input class="form-control form-control-sm" value="<?php echo $specimen ?>" type="text" name="speciman" readonly placeholder="" required>
                    </div>

                  </div>

                  <div class="group_report">
                    <div class="group_title">
                      <p>Delivery Date</p>
                    </div>
                    <div class="group_clone">
                      <b>:</b>
                    </div>
                    <div class="group_input">
                      <input class="form-control form-control-sm" type="text" value="<?php echo date('d-m-Y', strtotime($pdate . ' + 2 days')); ?>" name="delievry_date" placeholder="<?php echo date('d-m-Y', strtotime($pdate . ' + 2 days')); ?>">
                    </div>

                  </div>

                  <div class="group_report">
                    <div class="group_title">
                      <p>Checked_by</p>
                    </div>
                    <div class="group_clone">
                      <b>:</b>
                    </div>
                    <div class="group_input">
                    <select name="checked_by" class="form-control">
                    <?php foreach ($tecnology_info as $tecnology) { ?>
                       
                      <option value="<?php echo $tecnology['id'] ?>"><?php echo $tecnology['checked_by_name'] ? $tecnology['checked_by_name'] : ($tecnology['prepared_by_name']?$tecnology['prepared_by_name']:$tecnology['technologist_name'])   ?></option>
                    <?php }  ?>
                </select>
                    </div>

                  </div>
                </div>

                <div class="group_header_title">
                  <h4>Report Details</h4>
                </div>
        

                <select name="select_machine" id="select_machine">
                  <?php foreach ($machines as $key => $machine) { ?>

                    <option value="<?php echo $machine['machine_name'] ?>"><?php echo $machine['machine_name'] ?></option>
                  <?php }  ?>
                </select>

                <div class="row">
                  <div class="col-lg-12">
                    <div class="">
                      <div class="row">

                        <div class="col-lg-12">
                          <div class="textarea_width">
                            <textarea id="editor" name="mresult">



 <?php
  if (count($multi_result_val) > 0) {
    $report_val = trim($multi_result_val[0]['mresult']);
    echo $report_val;
  } else { ?>
  <!-- width: 700px !important;
      margin: 0 auto;
      display: flex !important;
      justify-content: space-between !important; -->
      <div style="width:100%;margin:0 auto;text-align:center;font-size:20px;font-weight:700;padding-bottom:10px">  
<?php echo $test_title ?>
</div>
 <div class="details_table_wrapper">
   <div style="width:650px;margin:0 auto;display:flex;justify-content: space-between !important;box-sizing:border-box">
     <div  style="width:50%">
        <div><p style="display: inline-block;width:100px">Bill No</p> <p style="display: inline-block;">:<?php echo $order_info[0]['test_order_id'] ?></p></div>
        <div><p style="display: inline-block;width:100px">P_ID </p> <p style="display: inline-block;">:<?php echo $patient_info_id ?></p> </br></div>
        <div><p style="display: inline-block;width:100px">Name</p> <p style="display: inline-block;">:<?php echo $patient_name ?></p></div>
        <div><p style="display: inline-block;width:100px">Specimen</p> <p style="display: inline-block;">:<?php echo $specimen ?></p></div>
         
     </div>
     <div style="width: 50%;">
      <div><p style="display: inline-block;width:100px">Age</p> <p style="display: inline-block;">:<?php echo $Age ?> </p> <br></div>
     <div>
     <p style="display: inline-block;width:100px">Sex</p> <p style="display: inline-block;">:<?php if ($gender == "Male") {
                                              echo "M";
                                            } else {
                                              echo "F";
                                            } ?></p> <br>
     </div>
    <div>
    <p style="display: inline-block;width:100px">Date</p> <p style="display: inline-block;">:<?php echo date('d.m.Y h:i a', strtotime($pdate)); ?></p> 
    </div>
    <!-- <div><p style="display: inline-block;"><?php echo $ref_doctor_name . ' ' . $designation ?></p></div> -->
     

     </div>
   </div>
   <div class="div">
   <div><b style="display: inline-block;"><?php echo $ref_doctor_name . ' ' . $designation ?></b></div>
   </div>
 </div>
<!-- <table class="details_table">
 <tr>
   <td><p>Bill No: </p><?php echo $order_info[0]['test_order_id'] ?></td>
   <td><b>Date: </b><?php echo date('d.m.Y h:i a', strtotime($pdate)); ?></td>
   <td><b>P_ID: </b><?php echo $patient_info_id ?></td>
 </tr>
 <tr><td><b>Name: </b><?php echo $patient_name ?></td>
   <td ><b>Age: </b><?php echo $Age ?></td>
   <td><b>Sex: </b>
    <?php if ($gender == "Male") {
      echo "M";
    } else {
      echo "F";
    } ?>
 </td>
</tr>
</table> -->
<!-- <div id="machine_add" style="text-align:center;padding:10px;border:1px solid black;border-radius:4px;width:500px;margin:0 auto;margin-top:10px">
<select style="border:none;font-size:20px !important;">
  <?php foreach ($machines as $key => $machine) { ?>
    <option value="<?php echo $machine['machine_name'] ?>"><?php echo $machine['machine_name'] ?></option>
  <?php }  ?>
</select>

</div> -->
<table>
<!-- <tr> <td><b>Doctor: </b><?php echo $ref_doctor_name . ' ' . $designation ?></td></tr> -->
 
</table>


<!-- 
<table>
<tr>
 <td><b>Specimen: </b><?php echo $specimen ?></td>
 <?php if ($is_ipd_patient == 1) { ?>
   <td><b>Ipd Id: </b><?php echo $cabin_ipd_info[0]['patient_info_id'] ?></td>
   <td><b>Cabin No: </b><?php echo $cabin_ipd_info[0]['room_title'] ?></td>
 <?php } ?>
</tr>

</table> -->
<!-- <div style="width:100%;margin:0 auto;text-align:center;font-size:20px;font-weight:700">  
<?php echo $test_title ?>
</div> -->

<?php if ($heading == 'yes') { ?>

<br>

<div>

<div class="wrapper_table_main" style="border:1px solid black;border-radius:10px;padding:6px;">
<table class="wrapper_table" style="width:100%">
 <thead>
 <th style="width:39%;text-align:left">
   Investigation
 </th>
 <th style="width:19.5%;text-align:left">
   Result
 </th>
 <th style="width:18.5%;text-align:left">
  Unit
</th>
<th style="width:23%;text-align:left">
  Reference range
</th>
 </thead>
  
</table> 
</div>

</div>

<?php }
    foreach ($pathology as $key => $val) {
      $test_template = $val['test_template'];


      $report_val = trim($test_template);

      echo $report_val;
    }
  }

?>

</textarea>
                          </div>

                        </div>

                      </div>
                    </div>
                    <div class="text-right">
                      <!-- <input type="text" name="machine_name" value="" id="machine_show"> -->
                      <input type="submit" value="submit" class="btn btn-primary m-2">
                    </div>
                  </div>

                </div>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
    <!-- <div class="control-sidebar-bg shadow white fixed"></div> -->
  </div>


  <?php $this->load->view('back/footer_link'); ?>
  <script src="back_assets/ckeditor/ckeditor.js"></script>
  <script src="back_assets/ckeditor/samples/js/sample.js"></script>
  <script>
    initSample();


    // var select_machine = $('#select_machine');
    // var element = new CKEDITOR.dom.element(document.getElementById("machine_show"));
    // console.log(element.setHtml("set new text"));
  </script>

</body>

</html>