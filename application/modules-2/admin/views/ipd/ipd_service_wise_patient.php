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
         <?php if($this->session->userdata('scc_alt')){ ?>
         <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <a href="javascript:;" class="alert-link"><?=$this->session->userdata('scc_alt');?></a>
         </div>
         <?php } $this->session->unset_userdata('scc_alt');?>    
         <?php if (isset($message)) {?>
         <CENTER>
            <h3 style="color:green;"><?php echo $message ?></h3>
         </CENTER>
         <br>
         <?php } ?>
         <?php echo validation_errors(); ?>         
         <div class="section-wrapper">
            <div class="card my-3 no-b">
               <div class="card-body">
                 
                 <form class="form-inline" method="POST" action="admin/ipd_service_wise_patient_report" target="_blank">
                     
             
               <div class="row">
                  <div class="col-md-3">
                     <select class="custom-select select2 form-control" name="service_id" id="service_id" required>
                    <!-- <option value="0">Select Customer</option> -->
                     <option value="all">All</option>
                    
                    <?php 
                    foreach ($service_info as $key => $value) { ?>
                       <option value="<?=$value['id']?>"><?=$value['service_name']?></option>
                   <?php }
                    ?>
                </select>
                  </div>
              <div class="col-md-4">
          <div class="form-group mb-2">                       
                        <div class="input-group">
                           <input type="text" placeholder="Start Date" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                              data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                           <span class="input-group-append">
                           <span class="input-group-text add-on white">
                           <i class="icon-calendar"></i>
                           </span>
                           </span>
                        </div>
                     </div>
                  </div>
                   <div class="col-md-4">
                     <div class="form-group mx-sm-3 mb-2">                        
                        <div class="input-group">
                           <input type="text" placeholder="End Date" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                              data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                           <span class="input-group-append">
                           <span class="input-group-text add-on white">
                           <i class="icon-calendar"></i>
                           </span>
                           </span>
                        </div>
                     </div>
                  </div>
                   <div class="col-md-1">
                     <button type="submit" class="btn btn-success mb-2">Search</button>
                  </div>
                     </div>
                  </form>

                 
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