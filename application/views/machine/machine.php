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
        <div class="card">
          <div class="card-body">
            <div class="card-header">
              <label for="">Machine Name Store</label>
            </div>
            <div class="row">
              <div class="col-lg-6 m-auto">
                <form action="Machine/MachineController/store" method="POST">
                   
                    <div class="mb-3">
                      <label for="machine_name" class="form-label">Enter Machine Name</label>
                      <input type="text" name="machine_name" class="form-control" id="machine_name" aria-describedby="emailHelp">
                      <div id="emailHelp" class="form-text text-danger"><?php echo form_error('machine_name') ?></div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          </div>
        </div>



      </div>


      <?php $this->load->view('back/footer_link'); ?>