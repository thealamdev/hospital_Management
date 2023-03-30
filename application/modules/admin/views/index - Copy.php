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
                                <option value="1">Mobile Phone</option>
                                <option value="2">Laptop & Computers</option>
                                <option value="3">Accessories</option>
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
                <div class="row">
                    <ul class="nav responsive-tab nav-material nav-material-white" id="v-pills-tab">
                        <li>
                            <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1">
                                <i class="icon icon-home2"></i>Today</a>
                        </li>
                        <li>
                            <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"><i class="icon icon-plus-circle mb-3"></i>Yesterday</a>
                        </li>
                        <li>
                            <a class="nav-link" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3"><i class="icon icon-calendar"></i>By Date</a>
                        </li>
                    </ul>
                    <a class="btn-fab fab-right btn-primary" data-toggle="control-sidebar">
                        <i class="icon icon-menu"></i>
                    </a>
                </div>
            </div>
        </header>
        <div class="container-fluid relative animatedParent animateOnce">
            <div class="tab-content pb-3" id="v-pills-tabContent">
                <!--Today Tab Start-->
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                    <div class="row my-3">

                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-note-list text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title">Total Patient</div>
                                    <h5 class="sc-counter mt-3">1228</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                         aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-mail-envelope-open s-48"></span>
                                    </div>
                                    <div class="counter-title ">IPD Patient</div>
                                    <h5 class="sc-counter mt-3">1228</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25"
                                         aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-stop-watch3 s-48"></span>
                                    </div>
                                    <div class="counter-title">Opd Patient</div>
                                    <h5 class="sc-counter mt-3">1228</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="25"
                                         aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-inbox-document-text s-48"></span>
                                    </div>
                                    <div class="counter-title">Others</div>
                                    <h5 class="sc-counter mt-3">550</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                         aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>


                    </div>
<!--                     <div class="row my-3">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="card no-b p-2">
                                <div class="card-header white b-0">
                                    <div class="card-handle">
                                        <a data-toggle="collapse" href="#salesCard" aria-expanded="false"
                                           aria-controls="salesCard">
                                            <i class="icon-menu"></i>
                                        </a>
                                    </div>
                                    <h4 class="card-title">Admitted Patient List</h4>
                                    <!-- <small class="card-subtitle mb-2 text-muted">Items purchase by users.</small> -->
                                </div>
                                <div class="collapse show" id="salesCard">
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover earning-box">
                                                <thead class="bg-light">
                                                <tr>
                                                    <th colspan="2">Patient Name</th>
                                                    <th>Admission Date</th>
                                                    <th>Admission Time</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                             
                                                <tr>
                                                    <td class="w-10">
                                                        <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                            <img src="<?=base_url();?>/back_assets/img/dummy/u7.png" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <h6>Sara Kamzoon</h6>
                                                        <small class="text-muted">Marketing Manager</small>
                                                    </td>
                                                    <td>25</td>
                                                    <td>$250</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-10">
                                                        <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                            <img src="<?=base_url();?>/back_assets/img/dummy/u9.png" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <h6>Sara Kamzoon</h6>
                                                        <small class="text-muted">Marketing Manager</small>
                                                    </td>
                                                    <td>25</td>
                                                    <td>$250</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-10">
                                                        <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                            <img src="<?=base_url();?>/back_assets/img/dummy/u11.png" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <h6>Sara Kamzoon</h6>
                                                        <small class="text-muted">Marketing Manager</small>
                                                    </td>
                                                    <td>25</td>
                                                    <td>$250</td>
                                                </tr>
                                                <tr>
                                                    <td class="w-10">
                                                        <a href="panel-page-profile.html" class="avatar avatar-lg">
                                                            <img src="<?=base_url();?>/back_assets/img/dummy/u12.png" alt="">
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <h6>Sara Kamzoon</h6>
                                                        <small class="text-muted">Marketing Manager</small>
                                                    </td>
                                                    <td>25</td>
                                                    <td>$250</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                          <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-header white">
                        <h6>Cabin Class </h6>
                    </div>
                    <div class="card-body p-0">
                        <div id="cabin_class_donut" style="width:100%; height:300px;"></div>
                    </div>
                </div>
            </div>

            
                    </div> -->


                    <div class="row my-3">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="card ">
                            <div class="card-header white">
                                    <strong> Total Patients Admitted <small>(Recent Month)</small> </strong>
                                </div>
                            <div class="card-body p-0">
                                <div id="total_patient_monthly" style="width:100%; height:280px;"></div>
                            </div>
                        </div>
            </div>
        </div>
                      
                      <div class="row my-3">
                       <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="card ">
                    <div class="card-header white">
                            <strong> Total Patients Admitted <small>(Days)</small> </strong>
                        </div>
                    <div class="card-body p-0">
                        <div id="total_patient_daily" style="width:100%; height:280px;"></div>
                    </div>
                </div>
            </div>
        </div>
                       
                       
                 
                </div>
                <!--Today Tab End-->
                <!--Yesterday Tab Start-->
                

                <div class="tab-pane animated fadeInUpShort" id="v-pills-2">
                    <div class="row my-3">
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-note-list text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title">Web Projects</div>
                                    <h5 class="sc-counter mt-3">3000</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 25%;"
                                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-mail-envelope-open s-48"></span>
                                    </div>
                                    <div class="counter-title ">Premium Themes</div>
                                    <h5 class="sc-counter mt-3">1000</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 50%;"
                                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-stop-watch3 s-48"></span>
                                    </div>
                                    <div class="counter-title">Support Requests</div>
                                    <h5 class="sc-counter mt-3">600</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="25"
                                         aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-inbox-document-text s-48"></span>
                                    </div>
                                    <div class="counter-title">Support Requests</div>
                                    <h5 class="sc-counter mt-3">525</h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 25%;"
                                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-12">
                            <div class="white p-5 r-5">
                                <div style="height: 528px">
                                    <canvas
                                            data-chart="line"
                                            data-dataset="[
                                                    [0,528,228,728,528,1628,0],
                                                    [0,628,228,1228,428,1828,0],
                                                    ]"
                                            data-labels="['Blue','Yellow','Green','Purple','Orange','Red','Indigo']"
                                            data-dataset-options="[
                                                { label:'Sales', borderColor:  'rgba(54, 162, 235, 1)', backgroundColor: 'rgba(54, 162, 235,1)'},
                                                { label:'Orders', borderColor:  'rgba(255,99,132,1)', backgroundColor: 'rgba(255, 99, 132, 1)' }]"
                                            data-options="{
                                                    maintainAspectRatio: false,
                                                    legend: {
                                                        display: true
                                                    },
                                        
                                                    scales: {
                                                        xAxes: [{
                                                            display: true,
                                                            gridLines: {
                                                                zeroLineColor: '#eee',
                                                                color: '#eee',
                                                          
                                                                borderDash: [5, 5],
                                                            }
                                                        }],
                                                        yAxes: [{
                                                            display: true,
                                                            gridLines: {
                                                                zeroLineColor: '#eee',
                                                                color: '#eee',
                                                                borderDash: [5, 5],
                                                            }
                                                        }]
                                        
                                                    },
                                                    elements: {
                                                        line: {
                                                        
                                                            tension: 0.4,
                                                            borderWidth: 1
                                                        },
                                                        point: {
                                                            radius: 2,
                                                            hitRadius: 10,
                                                            hoverRadius: 6,
                                                            borderWidth: 4
                                                        }
                                                    }
                                                }">
                                    </canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Yesterday Tab Start-->
                <!--Yesterday Tab Start-->
                <div class="tab-pane animated fadeInUpShort" id="v-pills-3">
                    <div class="row">
                        <div class="col-md-4 mx-md-auto m-5">
                            <div class="card no-b shadow">
                                <div class="card-body p-4">
                                    <div>
                                        <i class="icon-calendar-check-o s-48 text-primary"></i>
                                        <p class="p-t-b-20">Hey Soldier welcome back signin now there is lot of new stuff
                                            waiting
                                            for you</p>
                                    </div>
                                    <form action="dashboard2.html">
                                        <div class="form-group has-icon"><i class="icon-calendar"></i>
                                            <input class="form-control form-control-lg datePicker" placeholder="Date From"
                                                   type="text">
                                        </div>
                                        <div class="form-group has-icon"><i class="icon-calendar"></i>
                                            <input class="form-control form-control-lg datePicker" placeholder="Date TO"
                                                   type="text">
                                        </div>
                                        <input class="btn btn-success btn-lg btn-block" value="Get Data" type="submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Yesterday Tab Start-->
            </div>
        </div>
    </div>
    <!-- Right Sidebar -->
    <aside class="control-sidebar fixed white ">
        <div class="slimScroll">
            <div class="sidebar-header">
                <h4>Activity List</h4>
                <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
            </div>
            <div class="p-3">
                <div>
                    <div class="my-3">
                        <small>25% Complete</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="my-3">
                        <small>45% Complete</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 45%;" aria-valuenow="45"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="my-3">
                        <small>60% Complete</small>
                        `
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="my-3">
                        <small>75% Complete</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="my-3">
                        <small>100% Complete</small>
                        <div class="progress" style="height: 3px;">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-3 bg-primary text-white">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="font-weight-normal s-14">Sodium</h5>
                        <span class="font-weight-lighter text-primary">Spark Bar</span>
                        <div> Oxygen
                            <span class="text-primary">
                                                        <i class="icon icon-arrow_downward"></i> 67%</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <canvas width="100" height="70" data-chart="spark" data-chart-type="bar"
                                data-dataset="[[28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100]]"
                                data-labels="['a','b','c','d','e','f','g','h','i','j','k','l','m','n','a','b','c','d','e','f','g','h','i','j','k','l','m','n']">
                        </canvas>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                    <tbody>
                    <tr>
                        <td>
                            <a href="#">INV-281281</a>
                        </td>
                        <td>
                            <span class="badge badge-success">Paid</span>
                        </td>
                        <td>$ 1228.28</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">INV-01112</a>
                        </td>
                        <td>
                            <span class="badge badge-warning">Overdue</span>
                        </td>
                        <td>$ 5685.28</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">INV-281012</a>
                        </td>
                        <td>
                            <span class="badge badge-success">Paid</span>
                        </td>
                        <td>$ 152.28</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">INV-01112</a>
                        </td>
                        <td>
                            <span class="badge badge-warning">Overdue</span>
                        </td>
                        <td>$ 5685.28</td>
                    </tr>
                    <tr>
                        <td>
                            <a href="#">INV-281012</a>
                        </td>
                        <td>
                            <span class="badge badge-success">Paid</span>
                        </td>
                        <td>$ 152.28</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="sidebar-header">
                <h4>Activity</h4>
                <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
            </div>
            <div class="p-4">
                <div class="activity-item activity-primary">
                    <div class="activity-content">
                        <small class="text-muted">
                            <i class="icon icon-user position-left"></i> 5 mins ago
                        </small>
                        <p>Lorem ipsum dolor sit amet conse ctetur which ascing elit users.</p>
                    </div>
                </div>
                <div class="activity-item activity-danger">
                    <div class="activity-content">
                        <small class="text-muted">
                            <i class="icon icon-user position-left"></i> 8 mins ago
                        </small>
                        <p>Lorem ipsum dolor sit ametcon the sectetur that ascing elit users.</p>
                    </div>
                </div>
                <div class="activity-item activity-success">
                    <div class="activity-content">
                        <small class="text-muted">
                            <i class="icon icon-user position-left"></i> 10 mins ago
                        </small>
                        <p>Lorem ipsum dolor sit amet cons the ecte tur and adip ascing elit users.</p>
                    </div>
                </div>
                <div class="activity-item activity-warning">
                    <div class="activity-content">
                        <small class="text-muted">
                            <i class="icon icon-user position-left"></i> 12 mins ago
                        </small>
                        <p>Lorem ipsum dolor sit amet consec tetur adip ascing elit users.</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg shadow white fixed"></div>
</div>



<?php $this->load->view('back/footer_link');  ?>
</body>
</html>