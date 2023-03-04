<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>
  <!-- Loader End -->

  <div class="modal fade" id="add_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <select class="custom-select select2" required>
            <option value="">Select Product Category</option>
           <!--  <option value="1">Mobile Phone</option>
            <option value="2">Laptop & Computers</option>
            <option value="3">Accessories</option> -->
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  
  <div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
     <!-- Sidebar Start -->
     <?php $this->load->view('back/sidebar'); ?>
   </aside>
   <!--Sidebar End-->
   <div class="has-sidebar-left">
    <?php $this->load->view('back/navbar'); ?>
  </div>

  <div class="page has-sidebar-left height-full">

    <?php if($this->session->userdata('warn_msg') != "") {?>
      <span style="color: red; font-size: 28px;"><marquee><?=$this->session->userdata('warn_msg')?></marquee></span>
    <?php }?>

    <header class=" relative nav-sticky">
      <div class="container-fluid ">
       <div class="row pt-2 pb-4">
        <div class="col-md-12"><img style="width: 100%;
        height: 270px; border: 4px solid #1f72d1" src="uploads/dashboard_img/<?=$this->session->userdata['logged_in']['dashboard_img']?>"></div>
      </div>
    </div>
  </header>

  <?php if($this->session->userdata['logged_in']['role']!=0 && $this->auth->can('index-admin')) {?>

    <div class="container">
      <div class="row">
        <div class="col-md-12">
         <div class="row">
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg1"><i class="fa fa-money" aria-hidden="true"></i></span>
              <div class="dash-widget-info text-right">
                <h3><?=number_format($outdoor_net_income[0]['paid_due'], 2, '.', '');?> BDT</h3>
                <span class="widget-title1">Total Opd collection <i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg2"><i class="fa fa-money"></i></span>
              <div class="dash-widget-info text-right">
                <h3><?=number_format($outdoor_net_income[0]['paid_due']-$outdoor_commission_expense[0]['paid_com'], 2, '.', '');?> BDT</h3>
                <span class="widget-title2">Total Opd Net Cash In<i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
              <div class="dash-widget-info text-right">
                <h3><?=count($opd_test_order_info)?></h3>
                <span class="widget-title3">Total Test Receipt<i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg4"><i class="fa fa-money" aria-hidden="true"></i></span>
              <div class="dash-widget-info text-right">
                <h3><?=number_format($outdoor_commission_expense[0]['paid_com'], 2, '.', '');?> BDT</h3>
                <span class="widget-title4">Total Paid Commission<i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg4 dash-widget-bg5-cus"><i class="fa fa-money" aria-hidden="true"></i></span>
              <div class="dash-widget-info text-right">
                <h3><?=number_format($indoor_net_income[0]['paid_due'], 2, '.', '');?> BDT</h3>
                <span class="widget-title4 widget-title5">Total Ipd Collection  <i class="fa fa-check" aria-hidden="true"></i></span>
              </div>

            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg1 dash-widget-bg6-cus"><i class="fa fa-money" aria-hidden="true"></i></span>
              <div class="dash-widget-info text-right">
                <h3><?=number_format($indoor_net_income[0]['paid_due']-$operation_expense[0]['paid_cost'], 2, '.', '');?> BDT</h3>
                <span class="widget-title1 widget-title6">Indoor Net Cash In<i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg2 dash-widget-bg7-cus" ><i class="fa fa-user-o"></i></span>
              <div class="dash-widget-info text-right">
                <h3><?=count($ipd_patient_info)?></h3>
                <span class="widget-title2 widget-title7">Total Ipd Patient<i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg3 dash-widget-bg8-cus"><i class="fa fa-money" aria-hidden="true"></i></span>
              <div class="dash-widget-info text-right">
                <h3><?=number_format($indoor_adm_fee_income[0]['admission_fee_paid'], 2, '.', '');?> BDT</h3>
                <span class="widget-title3 widget-title8">Total Paid Adm. Fee<i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
         
          </div>
          </div>
<!-- 
          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg2 dash-widget-bg7-cus" ><i class="fa fa-bed"></i></span>
              <div class="dash-widget-info text-right">
                <h3>10721072 BDT</h3>
                <span class="widget-title2 widget-title7">Ipd Patient <i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <div class="dash-widget">
              <span class="dash-widget-bg3 dash-widget-bg8-cus"><i class="fa fa-user-md" aria-hidden="true"></i></span>
              <div class="dash-widget-info text-right">
                <h3>10721072 BDT</h3>
                <span class="widget-title3 widget-title8">Total Expense <i class="fa fa-check" aria-hidden="true"></i></span>
              </div>
            </div>
          </div> -->

        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6 col-xl-6">
        <div class="card">
          <div class="card-body"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <div class="chart-title">
            <h4>Patient Total</h4>
            <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span>
          </div>  
          <canvas id="linegraph" style="display: block; width: 475px; height: 237px;" width="475" height="237" class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6 col-xl-6">
      <div class="card">
        <div class="card-body"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div class="chart-title">
          <h4>Patients In</h4>
          <div class="float-right">
            <ul class="chat-user-total">
              <li><i class="fa fa-circle current-users" aria-hidden="true"></i>ICU</li>
              <li><i class="fa fa-circle old-users" aria-hidden="true"></i> OPD</li>
            </ul>
          </div>
        </div>  
        <canvas id="bargraph" style="display: block; width: 475px; height: 237px;" width="475" height="237" class="chartjs-render-monitor"></canvas>
      </div>
    </div>
  </div>
</div>
<div class="row mt-4">
  <div class="col-12 col-md-6 col-lg-8 col-xl-8">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="admin/appointment_list" class="btn btn-primary float-right">View all</a>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table mb-0 table-moushumi">
            <tbody>

              <?php foreach ($appointment_info as $key => $value) {?>
                <tr>
                  <td style="min-width: 200px;">
                    <a class="avatar" href="javascript:void(0)"><img src="uploads/appointment_patient_img/<?=$value['patient_image']?>" alt="..."></a>
                    <h2><a href="profile.html"><?=$value['patient_name']?><span><?=$value['address']?></span></a></h2>
                  </td>                 
                  <td>
                    <h5 class="time-title p-0">Appointment With</h5>
                    <p><?=$value['doctor_title']?></p>
                  </td>
                  <td>
                    <h5 class="time-title p-0">Serial No</h5>
                    <p><?=$value['serial_no']?></p>
                  </td>
                  <td>
                    <h5 class="time-title p-0">Timing</h5>
                    <p><?=$value['start_time']?>-<?=$value['end_time']?></p>
                  </td>

                  <td>
                    <h5 class="time-title p-0">Date</h5>
                    <p><?=date('d-m-Y', strtotime($value['appointment_date']))?></p>
                  </td>

                </tr>
              <?php } ?>


            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-md-6 col-lg-4 col-xl-4">
    <div class="card member-panel">
      <div class="card-header bg-white">
        <h4 class="card-title mb-0">Doctors</h4>
      </div>
      <div class="card-body">
        <ul class="contact-list">

          <?php foreach ($doctor_list as $key => $value) { ?>

           <li>
            <div class="contact-cont">
              <div class="float-left user-img m-r-10">
                <img width="25" height="25" src="uploads/doctor_image/<?=$value['profile_img']?>" alt="" class="w-40 rounded-circle">

              </div>
              <div class="contact-info">
                <span class="contact-name text-ellipsis"><?=$value['doctor_title']?></span>
                <span class="contact-date"><?=$value['doctor_degree']?></span>
              </div>
            </div>
          </li>


        <?php } ?>


      </ul>
    </div>
    <div class="card-footer text-center bg-white">
      <a href="admin/all_doc_list">View all Doctors</a>
    </div>
  </div>
</div>
</div>
<div class="row mt-4 mb-4">
  <div class="col-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title d-inline-block">New OPD Patients </h4> <a href="admin/show_all_opd_patient" class="btn btn-primary float-right">View all</a>
      </div>
      <div class="card-block">
        <div class="table-responsive">
          <table style="text-align: left;" class="table mb-0 new-patient-table table-moushumi">
            <tbody>
              <tr>
                <?php foreach ($opd_patient_info as $key => $value) { ?>


                  <td>
                    <img class="rounded-circle" src="uploads/patient_image/<?=$value['profile_img']?>" alt="" width="28" height="28"> 
                    <h2><?=$value['patient_name']?></h2>
                  </td>
                  <td><?=$value['address']?></td>
                  <td><?=$value['mobile_no']?></td>
                  <td><?=$value['gender']?></td>
                </tr>
              <?php        } ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


</div>


</div>
<footer  class="main-footer text-right">Software Release Date:01/07/2022 © (Development Company By (Software Park BD ) Office Address: QC Tower,Level-8,Hajigonj,Chandpur Contact No:(01624794910)</footer>
</div>

<div class="control-sidebar-bg shadow white fixed"></div>
</div>

<?php } ?>

<?php $this->load->view('back/footer_link');  ?>
</body>
</html>