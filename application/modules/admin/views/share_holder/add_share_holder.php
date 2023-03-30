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
  <?php if (isset($message)) {?>
    <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
  <?php echo validation_errors(); ?>

    <div class="section-wrapper">
      <div class="container">
      <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">  
        <form method="post" enctype="multipart/form-data">
          <div class="row ml-2">
            
            <div class="col-md-5 ml-3">
              <div class="form-group">
                 <label for="hospital_logo" class="col-sm-12 control-label">Share Holder Image</label>
                 <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 100px;">
                    <img data-src="holder.js/100%x100%" alt="...">
                  </div>
                  <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                  <div>
                    <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="share_holder_image" name="share_holder_image"></span>
                    <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                  </div>
                </div>
              </div>


                <div class="form-group">
                 <label for="hospital_logo" class="col-sm-12 control-label">Verification Image</label>
                 <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 100px;">
                    <img data-src="holder.js/100%x100%" alt="...">
                  </div>
                  <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                  <div>
                    <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="verification_image" name="verification_image"></span>
                    <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                  </div>
                </div>
              </div>

              <div class="form-group">
                 <label  for="hospital_logo" class="col-sm-12 control-label">Signature</label>
                 <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 100px;">
                    <img data-src="holder.js/100%x100%" alt="...">
                  </div>
                  <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                  <div>
                    <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="signature_image" name="signature_image"></span>
                    <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-md-6">
              <div class="form-group">
                 <label for="hospital_title" class="col-sm-12 control-label">Hospital Title</label>
                 <div class="col-sm-10">
                     <input class="form-control" name="hospital_title" id="hospital_title" placeholder="Hospital Title" type="text">
                 </div>
              </div>

              <div class="form-group">
                           <label for="director_name" class="col-sm-12 control-label">Share Holder Name</label>

                           <div class="col-sm-10">
                               <input class="form-control" name="share_holder_name" id="share_holder_name" placeholder="Share Holder Name" type="text">
                           </div>
              </div>

              <div class="form-group">
                           <label for="director_name" class="col-sm-12 control-label">Father Name</label>

                           <div class="col-sm-10">
                               <input class="form-control" name="father_name" id="father_name" placeholder="Father Name" type="text">
                           </div>
              </div>

                <div class="form-group">
                           <label for="mother_name" class="col-sm-12 control-label">Mother Name</label>

                           <div class="col-sm-10">
                               <input class="form-control" name="mother_name" id="mother_name" placeholder="Mother Name" type="text">
                           </div>
              </div>

              <div class="form-group">
                           <label for="nominee_name" class="col-sm-12 control-label">Nominee Name</label>

                           <div class="col-sm-10">
                               <input class="form-control" name="nominee_name" id="nominee_name" placeholder="Nominee" type="text">
                           </div>
              </div>


              <div class="form-group">
                  <label for="nominee_name" class="col-sm-12 control-label">Relation With Nominee</label>
                   <div class="col-sm-10">
               <select class="custom-select select2 form-control" name="relation_id" required="" id="relation_id" required>
                         <option value="">Select Relation</option>
                         
                         <?php foreach ($relation as $key => $value) { ?>

                           <option value="<?=$value['id']?>"><?=$value['relation']?></option>
                          
                     <?php    } ?>  
                   </select>
                 </div>
              </div>
                         
              </select>

              <div class="form-group">
                 <label for="mobile_no" class="col-sm-12 control-label">Mobile No</label>

                 <div class="col-sm-10">
                    <input class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No" type="text">
                     
                 </div>
              </div>



              <div class="form-group">
                 <label for="email" class="col-sm-2 control-label">Email</label>
                 <div class="col-sm-10">
                     <input class="form-control" name="email" id="email" placeholder="Email" type="email">
                 </div>
              </div>
          



            </div>
           
 <div class="col-md-5 mr-3">


           <div class="form-group">
               <label for="installment" class="col-sm-12 control-label">First Installment</label>

               <div class="col-sm-10">
                   <input class="form-control" name="installment" id="installment" placeholder="First Installment" type="text">
               </div>
              </div>
            </div>

             <div class="col-md-6">

               <div class="form-group">
               <label for="nid_number" class="col-sm-3 control-label">NID Number</label>
               <div class="col-sm-10">
                   <input class="form-control" name="nid_number" id="nid_number" placeholder="NID Number" type="text">
               </div>
            </div>
          </div>


          <div class="col-md-5 mr-3">

            <div class="form-group">
               <label for="passport_number" class="col-sm-12 control-label">Passport Number</label>

               <div class="col-sm-10">
                   <input class="form-control" name="passport_number" id="passport_number" placeholder="Passport Number" type="text">
               </div>
              </div>

            </div>
             

               <div class="col-md-6">
              
                    <div class="form-group">
               <label for="gratuity_type" class="col-sm-12 control-label">Select Package</label>
                <div class="col-sm-10">
                <select class="custom-select select2 form-control" name="gratuity_type" required="" id="gratuity_type" required>
                         <option value="">Select Package</option>
                         
                         <?php foreach ($share_holder_type as $key => $value) { ?>

                          <option value="<?=$value['id']?>"><?=$value['title']?></option>
                          
                     <?php    } ?>  

                         
                        </select>
                      </div>
              </div>

            </div>

          <div class="col-md-5 mr-3">

             <div class="form-group">
                 <label for="address_1" class="col-sm-12 control-label">Addrees No 1</label>
                 <div class="col-sm-10">
                    <textarea class="form-control" name="address_1" id="address_1" placeholder="Addrees No 1"></textarea>
                 </div>
                </div>

     
            </div>

            <div class="col-md-6">
              
                    <div class="form-group">
               <label for="address_2" class="col-sm-12 control-label">Addrees No 2</label>
               <div class="col-sm-10">
                  <textarea class="form-control" name="address_2" id="address_2" placeholder="Addrees No 2"></textarea>
               </div>
              </div>

            </div>


    
       </div>

       <div class="row">
              <div class="col-md-5"></div>
               <div class="col-md-5">
                   <button type="submit" class="btn btn-success">Submit</button>
               </div>
        </div>

       </div>
     </form>
  </div>
</div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>

</body>
</html>