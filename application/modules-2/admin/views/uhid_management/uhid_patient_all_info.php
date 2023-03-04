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
         <!--      <div align="right" class="mt-3 mr-3">
            <a href="admin/opd_each_patient_pdf/<?=$patient_id?>/<?=$order_id?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a>
         </div>  -->      
         <div class="section-wrapper">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-md-3"></div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="acc_head" class="col-sm-12 control-label">Patient Id: </label>
                                 <div class="col-md-10">
                                    <form action="admin/uhid_patient_all_info_post/" method="POST">
                                       <select class="custom-select select2 form-control" onchange="this.form.submit()" name="uhid"  id="uhid" required>
                                          <option value="0">Select UHID</option>
                                          <?php 
                                          foreach ($all_uhid_patient_id as $key => $patient_id){  ?>
                                             <option value="<?=$patient_id['id']?>"><?=$patient_id['gen_id']?></option>
                                          <?php } ?>
                                       </select>
                                    </form>

                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row my-3">
               <div class="col-md-12">
                  <div class="card  no-b">

                     <div class="card-body"  id="bill_info_div">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>

</body>
</html>