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
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>   


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <form action="admin/edit_service_post" method="POST" class="ipd_form">
              <input type="hidden" value="<?php echo $id?>" name="service_id"/>
              <div class="row">


                <div class="col-md-12">



                 <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Service Name</label>
                    <div class="col-md-8"><input class="form-control form-control-sm" value="<?php echo $service_name?>"  type="text" name="service_name" placeholder="Service Name" required></div>
                  </div>
                </div>

                
<!--                 <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Service Type</label>
                    <div class="col-md-8">
                      <select class="form-control form-control-sm" required name="service_type">
                        <?php
                        $service_type=$value['service_type'];
                        if($service_type==1)
                        {
                         $stype="Daily Service";
                       }
                       else
                       {
                         $stype="One Time Service";
                       }
                       ?>
                       <option value="<?php echo $service_type?>" selected><?php echo $stype?></option>									
                       <option value="1">Daily Service</option>
                       <option value="2">One Time Service</option>
                     </select>
                   </div>
                 </div>
               </div>
             -->


             <div class="form-group">
              <div class="row">
                <label for="" class="col-md-4 text-right">Service Price</label>
                <div class="col-md-8"><input class="form-control form-control-sm" value="<?php echo $service_price?>" type="text" name="service_price" placeholder="Price" required></div>
              </div>
            </div>





            <div class="text-right"> 
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
     <div class="control-sidebar-bg shadow white fixed"></div>
   </div>

   <?php $this->load->view('back/footer_link');?>




 </body>
 </html>