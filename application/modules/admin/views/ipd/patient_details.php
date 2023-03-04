<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>
  <!-- Loader End -->

  <div id="app">
    <aside class="main-sidebar fixed offcanvas shadow">
     <!-- Sidebar Start -->
     <?php $this->load->view('back/sidebar'); ?>
   </aside>
   <!--Sidebar End-->
   <div class="has-sidebar-left">
    <?php $this->load->view('back/navbar'); ?>
  </div>
  <?php $this->load->view('back/update_patient_img_modal'); ?>

  <div class="page has-sidebar-left height-full">
    <header class="blue accent-3 relative nav-sticky">
      <div class="container-fluid text-white ">
        <div class="row p-t-b-10 ">
          <div class="col">
            <div class="pb-3">
       <!--        <div class="image mr-3  float-left">
                <img style="width: 100px; height:100px;border-radius: 100%;" src="uploads/patient_image/<?=$patient_details_info[0]['patient_image']?>" alt="User Image">
              </div> -->
             <!--  <div>
                <h4><?=$patient_details_info[0]['patient_name']?><br>
                <?=$patient_details_info[0]['room_title']?></h4>
              </div> -->
            </div>
          </div>
        </div>
        <div class="row mb-2">
          <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
            <li>
              <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="icon icon-home2"></i>Profile</a>
            </li>
          </ul>
        </div>
      </div>
    </header>

    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?> 
    <div class="container-fluid relative animatedParent animateOnce">
      <div class="tab-content pb-3" id="v-pills-tabContent">
        <!--Today Tab Start-->
        <div class="tab-pane animated fadeInUpShort show active" id="v-pills-home">
         <div class="row">
           <div class="col-md-3">
             <div class="card ">
              <div class="card-header bg-white">
               <strong class="card-title">Patient Details</strong>

             </div>
             <div class="patient_img">

               <button type="button" id="" data-toggle="modal" data-target="#patient_img_modal" class="btn btn-secondary btn-xs rounded-0 border-0" style="position: absolute; right: 0">Change</button>



               <img src="uploads/patient_image/<?=$patient_details_info[0]['patient_image']?>" alt="" height="250px;"width="100%;">


             </div>





             <ul class="list-group list-group-flush">
               <li class="list-group-item"><i class="icon icon-user text-primary"></i><strong class="s-12">Name :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['patient_name']?></span></li>
               <li class="list-group-item"><i class="icon icon-mail text-success"></i><strong class="s-12">Age :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['age']?></span></li>
               <li class="list-group-item"><i class="icon icon-address-card-o text-warning"></i><strong class="s-12">Gender :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['gender']?></span></li>
               <li class="list-group-item"><i class="icon icon-web text-danger"></i> <strong class="s-12">Cabin No:</strong> <span class="float-right s-12"><?=$patient_details_info[0]['room_title']?></span></li>
               <li class="list-group-item"><i class="icon icon-web text-danger"></i> <strong class="s-12">Blood Group :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['blood_group_title']?></span></li>

               <li class="list-group-item"><i class="icon icon-web text-danger"></i> <strong class="s-12">Dr :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['doc_name']?></span></li>

               <li class="list-group-item"><i class="icon icon-web text-danger"></i> <strong class="s-12">Ref. Dr :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['ref_doc_name']?></span></li>

               <li class="list-group-item"><i class="icon icon-web text-danger"></i> <strong class="s-12">Email :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['email']?></span></li>
               <li class="list-group-item"><i class="icon icon-web text-danger"></i> <strong class="s-12">Phone No :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['mobile_no']?></span></li>
               <li class="list-group-item"><i class="icon icon-web text-danger"></i> <strong class="s-12">Date of Birth :</strong> <span class="float-right s-12"><?=$patient_details_info[0]['date_of_birth']?></span></li>
             </ul>
           </div>
         </div>



         <div class="col-md-9">

           <div class="row">
             <div class="col-lg-4">
               <div class="card r-3">
                 <div class="p-4">
                   <div class="counter-title"></div>
                   <h5 align="center"><?=$patient_details_info[0]['patient_name']?><br>
                   </div>
                 </div>
               </div>
               <div class="col-lg-4">
                 <div class="card r-3">
                   <div class="p-4">

                     <h5 align="center"><?=$patient_details_info[0]['room_title']?></h5>
                   </div>
                 </div>
               </div>

             </div>

             <div class="row my-3">
               <!-- bar charts group -->
               <div class="col-md-12">
                 <div class="card">

                  <form action="admin/update_patient_data/<?=$patient_details_info[0]['i_id']?>" method="post" id="ipd_form" class="ipd_form" style="padding: 5px 30px;">

                    <input type="hidden" value="<?=$patient_details_info[0]['patient_info_id']?>" name="ipd_long_id">

                    <div class="row">
                     <div class="col-md-12">
                      <h4>Basic Info</h4>
                      <div class="form-group">
                        <div class="row">
                          <label for="" class="col-md-3 text-right">Patient Name</label>
                          <div class="col-md-9"><input class="form-control form-control-sm" name="patient_name" value="<?=$patient_details_info[0]['patient_name']?>" type="text" placeholder="" required></div>
                        </div>
                      </div>


                      <div class="form-group">
                        <div class="row">
                          <label for="" class="col-md-3 text-right">Age</label>
                          <div class="col-md-9"><input class="form-control form-control-sm" name="age" value="<?=$patient_details_info[0]['age']?>" type="number" placeholder="" required></div>
                        </div>
                      </div>


                      <div class="form-group">
                        <div class="row">
                          <label for="" class="col-md-3 text-right">Gender</label>
                          <div class="col-md-9">

                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" value="Male" id="male" name="gender" <?php if ($patient_details_info[0]['gender']=="Male"){ echo 'checked';}?> class="custom-control-input" required>
                              <label class="custom-control-label m-0" for="male">Male</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" value="Female" id="female" name="gender" <?php if ($patient_details_info[0]['gender']=="Female"){ echo 'checked';}?> class="custom-control-input " required>
                              <label class="custom-control-label m-0" for="female">Female</label>
                            </div>

                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" value="Others" id="others" name="gender" <?php if ($patient_details_info[0]['gender']=="Others"){ echo 'checked';}?> class="custom-control-input " required>
                              <label class="custom-control-label m-0" for="others">Others</label>
                            </div>
                          </div>


                        </div>
                      </div>



                      <div class="form-group">
                        <div class="row">
                          <label for="" class="col-md-3 text-right">Cabin No</label>
                          <div class="col-md-9">
                            <select class="custom-select select2" name="cabin_no" id="cabin_no" required readonly>
                              <option value="">Select Cabin No</option>
                              <?php 
                              foreach ($all_cabin_room as $key => $room){ if($room['id']==$patient_details_info[0]['r_id'])
                                { ?>
                                  <option selected value="<?=$room['id']?>"><?=$room['room_title']?></option>
                                <?php } else {?>
                                  <option value="<?=$room['id']?>"><?=$room['room_title']?></option>
                                <?php } } ?>
                              </select>
                            </div>
                          </div>
                        </div>


                        <div class="form-group">
                         <div class="row">
                          <label for="blood_group" class="col-md-3 text-right">Blood Group</label>
                          <div class="col-md-9">
                            <select class="custom-select select2" name="blood_group" id="blood_group" required>
                              <option value="">Select Blood Group</option>
                              <?php 
                              foreach ($all_blood_group as $key => $blood){ if($blood['id']==$patient_details_info[0]['b_id'])
                                { ?>
                                  <option selected value="<?=$blood['id']?>"><?=$blood['blood_group_title']?></option>
                                <?php } else {?>
                                  <option value="<?=$blood['id']?>"><?=$blood['blood_group_title']?></option>
                                <?php } } ?>
                              </select>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <label for="" class="col-md-3 text-right">Phone No</label>
                            <div class="col-md-9">

                              <input  class="form-control form-control-sm" name="mobile_no" value="<?=$patient_details_info[0]['mobile_no']?>" type="number" placeholder="" required>
                            </div>
                          </div>
                        </div>



                      </div>


                      <div class="col-md-12">

                       <h4>Other Info</h4>


                       <div class="form-group">
                        <div class="row">
                          <label for="" class="col-md-4 text-right">Doctor Name <a href="admin/add_doc" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;" style="font-size:10px"> (ADD NEW)</a></label>
                          <div class="col-md-8">

                            <select class="custom-select select2"  name="doc_name" required>
                              <option value="">Select Doctor Title</option>
                              <?php
                              foreach ($doctor_list as $key => $value)
                              {
                                $doctor_id=$value['doctor_id'];
                                $doctor_type=$value['doctor_type'];
                                $doctor_title=$value['doctor_title'];
                                $doctor_degree=$value['doctor_degree'];

                                if($doctor_id==$patient_details_info[0]['doc_id'])
                                {
                                  echo "<option selected value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";

                                }
                                else{
                                  echo "<option value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";

                                }


                              }

                              ?>
                            </select> 
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <label for="" class="col-md-4 text-right">Ref Doctor Name <a href="admin/add_doc" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;" style="font-size:10px"> (ADD NEW)</a></label>
                          <div class="col-md-8">

                           <select class="custom-select select2"  name="ref_doc_name" required>
                            <option value="">Select Doctor Title</option>
                            <?php
                            foreach ($doctor_list as $key => $value)
                            {
                              $doctor_id=$value['doctor_id'];
                              $doctor_type=$value['doctor_type'];
                              $doctor_title=$value['doctor_title'];
                              $doctor_degree=$value['doctor_degree'];


                              if($doctor_id==$patient_details_info[0]['ref_doc_id'])
                              {
                               echo "<option selected value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";
                             }
                             else{
                               echo "<option value='$doctor_title#$doctor_id'>$doctor_title ($doctor_degree)</option>";

                             }



                           }

                           ?>
                         </select>   
                       </div>
                     </div>
                   </div>




                   <div class="form-group">
                    <div class="row">
                      <label for="" class="col-md-3 text-right">Email Address</label>
                      <div class="col-md-9"><input class="form-control form-control-sm" name="email" value="<?=$patient_details_info[0]['email']?>" type="email" placeholder=""></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <label for="" class="col-md-3 text-right">Date Of Birth</label>
                      <div class="col-md-9"><div class="input-group focused">
                        <input type="text" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" name="date_of_birth" value="<?=$patient_details_info[0]['date_of_birth']?>" required>
                        <span class="input-group-append">
                          <span class="input-group-text add-on white">
                            <i class="icon-calendar"></i>
                          </span>
                        </span>
                      </div></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <label for="" class="col-md-3 text-right">Disease Name</label>
                      <div class="col-md-9"><input class="form-control form-control-sm" name="disease_name" value="<?=$patient_details_info[0]['disease_name']?>" type="text" placeholder=""></div>
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="row">
                      <label for="" class="col-md-3 text-right">Guardian Name</label>
                      <div class="col-md-9"><input class="form-control form-control-sm" name="guardian_name" value="<?=$patient_details_info[0]['guardian_name']?>" type="text" placeholder=""></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <label for="" class="col-md-3 text-right">Address</label>
                      <div class="col-md-8"><textarea class="form-control" rows="2" id="address"  name="address"><?=$patient_details_info[0]['address']?></textarea></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <label for="" class="col-md-3 text-right">Blood Pressure</label>
                      <div class="col-md-8"><input class="form-control form-control-sm" value="<?=$patient_details_info[0]['blood_pressure']?>" type="text" name="blood_pressure" placeholder="" ></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <label for="" class="col-md-3 text-right">Pulse Rate</label>
                      <div class="col-md-8"><input class="form-control form-control-sm" value="<?=$patient_details_info[0]['pulse_rate']?>" type="text" name="pulse_rate" placeholder="" ></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <label for="" class="col-md-3 text-right">Description</label>
                      <div class="col-md-8"><textarea class="form-control" rows="2" id=""  name="description"><?=$patient_details_info[0]['description']?></textarea></div>

                    </div>

                  </div>

                  <div class="col-md-12">

                   <h4>Payment Info</h4>

                   <div class="form-group">

                     <div class="row">
                      <label for="" class="col-md-3 text-right">Advance Payment</label>
                      <div class="col-md-9"><input class="form-control form-control-sm" name="adv_pay" value="<?=$patient_details_info[0]['advance_payment']?>" type="number" placeholder="" <?php if($patient_details_info[0]['type'] == 3) echo "readonly";?>></div>
                    </div>
                  </div>

                  <div class="form-group">

                    <div class="row">
                      <label for="" class="col-md-3 text-right">Admission Fee</label>
                      <div class="col-md-9"><input class="form-control form-control-sm" id="adm_fee" name="adm_fee" value="<?=$patient_details_info[0]['admission_fee']?>" type="number" placeholder="" <?php if($patient_details_info[0]['type'] == 3) echo "readonly"  ?>></div>
                    </div>
                  </div>

                  <div class="form-group">

                    <div class="form-group">
                      <div class="row">
                        <label for="" class="col-md-3 text-right">Admission Fee Paid:</label>
                        <div class="col-md-9"><input class="form-control form-control-sm" id="adm_fee_paid" type="number" name="adm_fee_paid" value="<?=$patient_details_info[0]['admission_fee_paid']?>" <?php if($patient_details_info[0]['type'] == 3) echo "readonly"  ?>></div>
                        <div class="col-md-8 offset-md-4 pt-1" id="adm_fee_level_div"><p style="color: red;">Adm Fee Paid Must be Less than Adm Fee</p></div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>


              <div class="col-md-12 text-right"> 
               <input type="submit" value="Update" class="btn btn-primary m-2">
             </div>


           </form>

         </div>
       </div>
       <!-- /bar charts group -->


     </div>

   </div>
 </div>
</div>



</div>
</div>
</div>

<div class="control-sidebar-bg shadow white fixed"></div>
</div>



<?php $this->load->view('back/footer_link');  ?>

<script type="text/javascript">
  $('#adm_fee_level_div').hide();

  $('#ipd_form').on('submit', function() {

   var adm_fee=$('#adm_fee').val();
   var adm_fee_paid=$('#adm_fee_paid').val();



   if(adm_fee < adm_fee_paid)
   {
    $('#adm_fee_level_div').show();
    return false;

  }

});
</script>
</body>
</html>