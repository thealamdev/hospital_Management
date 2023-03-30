<?php $this->load->view('back/header_link'); ?>

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
      <header class="accent-3 relative nav-sticky" style="background: #2B3467;border-top:1px solid #fff">
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

      <div class="section-wrapper">
        <div class="card">
          <div class="card-body">
            <div class="form-group mt-4">
              <a href="admin/opd_file_tag_print_selective" class="btn btn-primary btn-md"><i class="fa fa-plus-square"></i>&nbsp;File Tag Print ID Wise</a>
            </div>
          </div>
        </div>


        <!-- cart one end -->

        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h4>Print File Tag</h4>
            </div>
            <form method="POST" action="admin/opd_file_tag_print_datewise_post">
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="inputEmail4" class="form-label">
                      <h5>From</h5>
                    </label>

                    <div class="input-group">
                      <input type="text" name="start_date" id="date_of_birth" class="date-time-picker form-control date_of_birth" data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
                      <span class="input-group-append">
                        <span class="input-group-text add-on white">
                          <i class="icon-calendar"></i>
                        </span>
                      </span>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4">
                <div class="form-group">
                  <label for="inputEmail4" class="form-label">
                    <h5>To</h5>
                  </label>

                  <div class="input-group">
                    <input type="text" name="end_date" id="date_of_birth" class="date-time-picker form-control date_of_birth" data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
                    <span class="input-group-append">
                      <span class="input-group-text add-on white">
                        <i class="icon-calendar"></i>
                      </span>
                    </span>
                  </div>
                </div>
                </div>

                <div class="col-lg-4 mt-2 d-flex align-items-center">
                  <div class="sub_btn">
                    <button type="submit" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </div>
            </form>
            <hr />




          </div>
        </div>


        <!-- /.right-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
        <div class="control-sidebar-bg shadow white fixed"></div>
      </div>

      <?php $this->load->view('back/footer_link'); ?>




</body>

</html>