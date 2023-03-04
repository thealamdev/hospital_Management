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

    <div class="section-wrapper">



      <div class="card my-3 no-b">
        <div class="card-body">

          <div class="row">

            <div class="col-md-6">
             <form method="POST" action="admin/pathology_report_lock_unlock_post">

              <input type="hidden" value="opd"  name="opd">
              <input type="hidden" value=""  name="ipd">

               <?php if($report_lock[0]['flag']==0) { ?>
                <div class="mb-2">
                  <span class="badge badge-dark">Currently the OPD report is Unlocked</span>
                </div>
                <button type="submit" class="btn btn-danger">Lock OPD Report</button>
              <?php } else { ?>
                <div class="mb-2">
                  <span class="badge badge-dark">Currently the OPD report is Locked</span>
                </div>
                <button type="submit" class="btn btn-success">UnLock OPD Report</button>
              <?php } ?>
            </form>
          </div>


          <div class="col-md-6">
            <form method="POST" action="admin/pathology_report_lock_unlock_post">

              <input type="hidden" value="ipd" name="ipd">
              <input type="hidden" value=""  name="opd">
             <?php if($report_lock[0]['flag_ipd']==0) { ?>
              <div class="mb-2">
                <span class="badge badge-dark">Currently the report is IPD Unlocked</span>
              </div>
              <button type="submit" class="btn btn-danger">Lock IPD Report </button>
            <?php } else { ?>
              <div class="mb-2">
                <span class="badge badge-dark">Currently the IPD report is Locked</span>
              </div>
              <button type="submit" class="btn btn-success">UnLock IPD Report</button>
            <?php } ?>
          </form>
        </div>

      </div>


    </div>
  </div>
</div>
</div>
</div>
</div>

<!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
     <div class="control-sidebar-bg shadow white fixed"></div>
   </div>

   <?php $this->load->view('back/footer_link');?>


 </body>
 </html>