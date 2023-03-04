 <?php
 $username=$this->session->userdata['logged_in']['username'];
 $user_id=$this->session->userdata['logged_in']['id'];
 $role=$this->session->userdata['logged_in']['role'];
 ?> 


 <section class="sidebar">
   <div class="w-80px mt-4 mb-3 ml-3">
    <!-- <img src="back_assets/img/dummy/header.png" alt=""> -->
  </div>
  <div class="relative">
    <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
    aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm fab-right fab-top btn-primary shadow1 ">
    <i class="icon icon-cogs"></i>
  </a>
  <div class="user-panel p-3 light mb-2 ">
    <div>
     <div style="text-align: center;" class=" image">
      <img  class="" style="height: 80px; width: 80px; border-radius: 100%; border: 2px solid #27e3dd" src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>" alt="User Image">
    </div>
    <div class=" info">
      <h3 style="color:#0d487b; font-weight: 500; text-align: center;" class=" mt-2 mb-1">

       <?php
       echo "Welcome ".ucwords($username)."</h3>";
       ?>
     </div>
   </div>
   <div class="clearfix"></div>
   <div class="collapse multi-collapse" id="userSettingsCollapse">
     <div class="list-group mt-3 shadow">
      <a href="admin/change_password/<?php echo $user_id?>" class="list-group-item list-group-item-action"><i
       class="mr-2 icon-security text-purple"></i>Change Password</a>
     </div>
   </div>
 </div>
</div>

<ul class="sidebar-menu">
  <li style="text-align: center" class="header"><h6><strong>MAIN NAVIGATION</strong></h6></li>
  <li class="treeview"><a href="admin" class="<?php if($active=='dashboard'){echo 'active';}?>" >
    <i class="fa fa-tachometer s-18 icon-sidebar" aria-hidden="true"></i>

   <span >Dashboard</span> <!-- <i
     class="icon icon-angle-left s-18 pull-right"></i> -->
   </a>
 </li>

 <!-- <<<<<<<<<<<<<<<< Super Admin Area >>>>>>>>>>>>>>> -->

 <?php if($role==0){ ?>

  <li class="treeview <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'active';}?>">
   <a href="javascript:void(0)"><i class="fa fa-lock icon-sidebar"></i>  <span >Super Admin Area</span> <i
    class="icon icon-angle-left s-18 pull-right"></i></a>
    <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">



     <li><a href="admin/add_hospital"><i class="fa fa-hospital-o icon-sidebar"></i>  <span> Hospital List</span> </a>
     </li>


     <li><a href="admin/role_list"><i class="fa fa-list-ol icon-sidebar"></i>   <span >Role List</span></a>
     </li>

     <li><a href="admin/add_user"><i class="fa fa-user-plus icon-sidebar"></i>  <span >Add Hospital User</span></a>
     </li>

     <li><a href="admin/all_hospital_user_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >All Hospital User List</span></a>
     </li>

   </ul>
 </li>

<?php }  else {?> 

  <!-- Super admin area Ends -->


  <!-- Manage Test & Service Starts -->

  <?php if($this->auth->can('test_group-admin') || $this->auth->can('service_list-admin') || $this->auth->can('specimen_list-admin') || $this->auth->can('add_specimen-admin') || $this->auth->can('add_user-admin') || $this->auth->can('user_list-admin') || $this->auth->can('add_user-admin') || $this->auth->can('marketing_officer_list-admin')) { ?>

   <li class="treeview <?php if($active=='test_group' || $active=='add_user'||$active=='add_hospital'|| $active=='add_hospital_form'){echo 'active';}?>">
    <a href="javascript:void(0)"><i class="fa fa-cogs icon-sidebar"></i>  <span >Test & Service Management</span><i
     class="icon icon-angle-left s-18 pull-right"></i></a>
     <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">

      <?php if(($this->auth->can('test_group-admin'))){?>
       <li><a href="admin/test_group"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Test & Test Group Lists</span></a>
       </li>
     <?php } ?>

     <?php if(($this->auth->can('additional_test_list-admin'))){?>
       <li><a href="admin/additional_test_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Additional Tests</span></a>
       </li>
     <?php } ?>

     <?php if(($this->auth->can('service_list-admin'))){?>
       <li><a href="admin/service_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Service Lists</span></a>
       </li>
     <?php } ?>

     <?php if(($this->auth->can('specimen_list-admin'))){?>

       <li><a href="admin/specimen_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Specimen List</span></a>
       </li>

     <?php } ?>


     <?php if(($this->auth->can('add_specimen-admin'))){?>
       <li><a href="admin/edit_hospital_form"><i class="fa fa-address-card icon-sidebar"></i>  <span >Edit Hospital Form</span></a>
       </li>
     <?php } ?>

     <?php if(($this->auth->can('add_user-admin'))){?>
      <li><a href="admin/add_user"><i class="fa fa-user-plus icon-sidebar"></i>  <span >Add Hospital User</span></a>
      </li>
    <?php } ?>

    <?php if(($this->auth->can('user_list-admin'))){?>
      <li><a href="admin/user_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Hospital User List</span></a>
      </li>
    <?php } ?>

    <?php if(($this->auth->can('marketing_officer_list-admin'))){?>
      <li><a href="admin/marketing_officer_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span>Marketing Officer List</span></a>
      </li>
    <?php } ?>

  </ul>
</li>

<?php } ?>

<!-- Manage Test & Service Ends -->


<!-- Manage Role & User Starts-->

<?php if($this->auth->can('role_list-admin') || $this->auth->can('add_user-admin') || $this->auth->can('user_list-admin')){ ?>


 <li class="treeview <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'active';}?>">
  <a href="#"><i class="fa fa-users icon-sidebar"></i>  <span >User & Role Management</span><i
   class="icon icon-angle-left s-18 pull-right"></i></a>
   <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">
    <?php if(($this->auth->can('role_list-admin'))){?>
     <li><a href="admin/role_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Role List</span></a>
     </li>
   <?php } ?>
   <?php if(($this->auth->can('add_user-admin'))){?>
     <li><a href="admin/add_user"><i class="fa fa-user-plus icon-sidebar"></i>  <span >Add Hospital User</span></a>
     </li>
   <?php } ?>
   <?php if(($this->auth->can('user_list-admin'))){?>
     <li><a href="admin/user_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Hospital User List</span></a>
     </li>
   <?php } ?>
 </ul>
</li>

<?php } ?>

<!-- Manage Role & User Ends -->

<!-- Manage Appointment Starts -->

<?php if($this->auth->can('doc_schedule_list-admin') || $this->auth->can('appointment_list-admin')){?>

  <li class="treeview <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'active';}?>">
   <a href="javascript:void(0)"><i class="fa fa-address-book icon-sidebar"></i>  <span >Appointment Management</span><i
    class="icon icon-angle-left s-18 pull-right"></i></a>
    <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">

      <?php if(($this->auth->can('add_doc_schedule-admin'))){?>
        <li><a href="admin/add_doc_schedule"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Add Doctor Schedule</span></a>
        </li>
      <?php } ?>

      <?php if(($this->auth->can('doc_schedule_list-admin'))){?>
        <li><a href="admin/doc_schedule_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Doctor Schedule List</span></a>
        </li>
      <?php } ?>

      <?php if(($this->auth->can('add_appointment-admin'))){?>
        <li><a href="admin/add_appointment"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Add Appointment</span></a>
        </li>
      <?php } ?>

      <?php if(($this->auth->can('appointment_list-admin'))){?>
        <li><a href="admin/appointment_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Appointment List</span></a>
        </li>
      <?php } ?>

    </ul>
  </li>


<?php } ?>

<!-- Manage Appointment Ends -->

<!-- Manage Doctor Starts -->

<?php if($this->auth->can('add_doc-admin') || $this->auth->can('all_doc_list-admin') || $this->auth->can('assign_doc_comission_view_list-admin')){?>

 <li class="treeview">
  <a href="javascript:void(0)"><i class="fa fa-user-md icon-sidebar"></i>  <span >Doctor Management</span><i
   class="icon icon-angle-left s-18 pull-right"></i></a>
   <ul class="treeview-menu <?php if($active=='doc'){echo 'menu-open display_block';}?>">


    <?php if(($this->auth->can('add_doc-admin'))){?>
     <li><a href="admin/add_doc/1"><i class="fa fa-user-plus"></i>  <span >Add Doc</span></a>
     </li>
   <?php } ?>



   <?php if(($this->auth->can('all_doc_list-admin'))){?>
    <li><a href="admin/all_doc_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >All Doctor List</span></a>
    </li>
  <?php } ?>

  <?php if(($this->auth->can('qc_doc_list-admin'))){?>
    <li><a href="admin/qc_doc_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Q/C Doctor List</span></a>
    </li>
  <?php } ?>

  <?php if(($this->auth->can('mbbs_doc_list-admin'))){?>
    <li><a href="admin/mbbs_doc_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >MBBS Doctor List</span></a>
    </li>
  <?php } ?>

  <?php if(($this->auth->can('assign_doc_comission_view_list-admin'))){?>
   <li><a href="admin/assign_doc_comission_view_list"><i class="fa fa-list-alt icon-sidebar"></i>View Commission List</a>
   </li>
 <?php } ?>

 <?php if(($this->auth->can('add_doc_category-admin'))){?>
   <li><a href="admin/add_doc_category"><i class="fa fa-list-alt icon-sidebar"></i>Add Doc Category</a>
   </li>
 <?php } ?>

 <?php if(($this->auth->can('doc_category_list-admin'))){?>
   <li><a href="admin/doc_category_list"><i class="fa fa-list-alt icon-sidebar"></i>Doc Category List</a>
   </li>
 <?php } ?>

 <?php if(($this->auth->can('cabin_class_room_list-admin'))){?>
   <li><a href="admin/cabin_class_room_list/2"><i class="fa fa-list-alt icon-sidebar"></i>Add Dr. Room</a>
   </li>
 <?php } ?>


</ul>
</li>

<?php } ?>

<!-- Manage Doctor Ends -->


<!-- Manage UHID Starts -->

<?php if($this->auth->can('uhid_reg_list-admin') || $this->auth->can('uhid_reg-admin')){?>

 <li class="treeview">
  <a href="javascript:void(0)"><i class="fa fa-user-md icon-sidebar"></i>  <span >UHID Management</span><i
   class="icon icon-angle-left s-18 pull-right"></i></a>
   <ul class="treeview-menu <?php if($active=='doc'){echo 'menu-open display_block';}?>">


    <?php if(($this->auth->can('uhid_reg-admin'))){?>
     <li><a href="admin/uhid_reg"><i class="fa fa-user-plus"></i>  <span >UHID Registration</span></a>
     </li>
   <?php } ?>



   <?php if(($this->auth->can('uhid_list-admin'))){?>
    <li><a href="admin/uhid_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >UHID List</span></a>
    </li>
  <?php } ?>


  <?php if(($this->auth->can('uhid_patient_all_info-admin'))){?>
    <li><a href="admin/uhid_patient_all_info"><i class="fa fa-list-alt icon-sidebar"></i>  <span >All Exam Report (UHID)</span></a>
    </li>
  <?php } ?>

</ul>
</li>

<?php } ?>

<!-- Manage UHID Ends -->


<!-- Manage Birth/Death Certificate Starts -->

<?php if($this->auth->can('add_birth_certificate-admin') || $this->auth->can('uhid_reg-admin')){?>

 <li class="treeview">
  <a href="javascript:void(0)"><i class="fa fa-user-md icon-sidebar"></i>  <span >Birth/Death Certificate</span><i
   class="icon icon-angle-left s-18 pull-right"></i></a>
   <ul class="treeview-menu <?php if($active=='doc'){echo 'menu-open display_block';}?>">


    <?php if(($this->auth->can('add_birth_certificate-admin'))){?>
     <li><a href="admin/add_birth_certificate"><i class="fa fa-user-plus"></i>  <span> Add Birth Certificate</span></a>
     </li>
   <?php } ?>

   <?php if(($this->auth->can('birth_certificate_list-admin'))){?>
     <li><a href="admin/birth_certificate_list"><i class="fa fa-user-plus"></i>  <span>Birth Certificate List</span></a>
     </li>
   <?php } ?>

   <?php if(($this->auth->can('add_death_certificate-admin'))){?>
     <li><a href="admin/add_death_certificate"><i class="fa fa-user-plus"></i>  <span> Add Death Certificate</span></a>
     </li>
   <?php } ?>

   <?php if(($this->auth->can('death_certificate_list-admin'))){?>
     <li><a href="admin/death_certificate_list"><i class="fa fa-user-plus"></i>  <span>Death Certificate List</span></a>
     </li>
   <?php } ?>


 </ul>
</li>

<?php } ?>

<!-- Manage Birth/Death Certificate Ends -->

<!-- Outdooor Starts -->

<?php if($this->auth->can('show_all_opd_patient-admin') || 
  $this->auth->can('show_all_paid_opd_patient-admin') || 
  $this->auth->can('show_all_unpaid_opd_patient-admin') || 
  $this->auth->can('opd_registration-admin') ||
  $this->auth->can('opd_all_billing_info-admin') ||
  $this->auth->can('edit_opd_invoice-admin') ||
  $this->auth->can('opd_com_list-admin') ||
  $this->auth->can('opd_today_com_list-admin') ||
  $this->auth->can('opd_col_from_doc_with_com-admin') ||
  $this->auth->can('opd_col_from_doc_all-admin') ||
  $this->auth->can('opd_col_from_doc_with_com_details-admin') ||
  $this->auth->can('opd_com_list_report-admin') ||
  $this->auth->can('date_wise_paid_invoice_list-admin') ||
  $this->auth->can('date_wise_due_invoice_list-admin') ||
  $this->auth->can('test_group_wise_collection-admin') ||
  $this->auth->can('discount_summary-admin') ||
  $this->auth->can('cancel_invoice_list-admin')){?>

    <li class="treeview">
     <a href="javascript:void(0)"><i class="fa fa-building icon-sidebar"></i>  <span >Outdoor</span><i
      class="icon icon-angle-left s-18 pull-right"></i></a>
      <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
        <?php if($this->auth->can('show_all_opd_patient-admin') || 
          $this->auth->can('show_all_paid_opd_patient-admin') || 
          $this->auth->can('show_all_unpaid_opd_patient-admin')) { ?>

            <li>
              <a href="javascript:void(0)"><i class="fa fa-list-alt icon-sidebar"></i><span>Outdoor Patient List</span><i class="icon icon-angle-left s-18 pull-right"></i></a>
              <ul class="treeview-menu <?php if($active=='opd_patient_list'){echo 'menu-open display_block';}?>">


                <?php if(($this->auth->can('show_all_opd_patient-admin'))){?>
                  <li><a href="admin/show_all_opd_patient"><i class="fa fa-list-alt icon-sidebar"></i>  <span >All Patient List</span></a>
                  </li>
                <?php } ?>

                <?php if(($this->auth->can('show_all_paid_opd_patient-admin'))){?>
                  <li><a href="admin/show_all_paid_opd_patient"><i class="fa fa-file-text icon-sidebar"></i>  <span >Paid Patient List</span></a>
                  </li>
                <?php } ?>

                <?php if(($this->auth->can('show_all_unpaid_opd_patient-admin'))){?>
                  <li><a href="admin/show_all_unpaid_opd_patient"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Due Patient List</span></a>
                  </li>
                <?php } ?>

              </ul>
            </li>
          <?php } ?>


          <?php if(($this->auth->can('opd_registration-admin'))){?>
            <li><a href="admin/opd_registration"><i class="fa fa-registered"></i>  <span >Outdoor Registration</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('opd_all_billing_info-admin'))){?>
            <li><a href="admin/opd_all_billing_info"><i class="fa fa-credit-card icon-sidebar"></i>  <span >Outdoor Billing</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('opd_patient_data-admin'))){?>
           <li><a href="admin/opd_patient_data"><i class="fa fa-ban icon-sidebar"></i>  <span >Opd Patient Data</span></a></li>
         <?php } ?>


         <?php if(($this->auth->can('opd_file_tag_print_datewise-admin'))){?>
          <li><a href="admin/opd_file_tag_print_datewise"><i class="fa fa-credit-card icon-sidebar"></i>  <span >Opd File Tag  Print Datewise</span></a>
          </li>
        <?php } ?>

        <?php if(($this->auth->can('opd_sample_tag_print_datewise-admin'))){?>
          <li><a href="admin/opd_sample_tag_print_datewise"><i class="fa fa-credit-card icon-sidebar"></i>  <span >Opd Sample Tag Print Datewise</span></a>
          </li>
        <?php } ?>



        <?php if(($this->auth->can('edit_opd_invoice-admin'))){?>
          <li><a href="admin/edit_opd_invoice"><i class="fa fa-edit icon-sidebar"></i>  <span >Edit Receipt</span></a>
          </li>
        <?php } ?>

        <?php if(($this->auth->can('opd_com_list-admin'))){?>
          <li><a href="admin/opd_com_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Doctor Commission List</span></a>
          </li>
        <?php } ?>


        <?php if(($this->auth->can('opd_today_com_list-admin'))){?>
          <li><a href="admin/opd_today_com_list/all"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Datewise Doc Com. Details List</span></a>
          </li>

        <?php } ?>

        <?php if(($this->auth->can('opd_col_from_doc-admin'))){?>

          <li><a href="admin/opd_col_from_doc"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Col. From Doctor (Group Wise)</span></a>
          </li>

        <?php } ?>

        <?php if(($this->auth->can('opd_col_from_doc_all-admin'))){?>

          <li><a href="admin/opd_col_from_doc_all"><i class="fa fa-info-circle icon-sidebar"></i>  <span >Doctor Col. Report</span></a>
          </li>

        <?php } ?>

        <?php if(($this->auth->can('opd_col_from_doc_with_com-admin'))){?>

          <li><a href="admin/opd_col_from_doc_with_com"><i class="fa fa-info-circle icon-sidebar"></i>  <span >Doctor Com. Report</span></a>
          </li>

        <?php } ?>

        <?php if(($this->auth->can('opd_col_from_doc_with_com_details-admin'))){?>

          <li><a href="admin/opd_col_from_doc_with_com_details"><i class="fa fa-info-circle icon-sidebar"></i>  <span >Doc Com. Report(Details)</span></a>
          </li>

        <?php } ?>


        <?php if(($this->auth->can('outdoor_due_collection-admin'))){?>

         <li><a href="admin/outdoor_due_collection"><i class="fa fa-database icon-sidebar"></i>  <span >Outdoor Due Collection</span></a>
         </li>

       <?php } ?>

       <?php if(($this->auth->can('opd_com_list_report-admin'))){?>

         <li><a href="admin/opd_com_list_report"><i class="fa fa-file-text icon-sidebar"></i>  <span >Doctor Com. Report (paid/unpaid)</span></a>
         </li>
       <?php } ?>

       <?php if(($this->auth->can('date_wise_paid_invoice_list-admin'))){?>

         <li><a href="admin/date_wise_paid_invoice_list"><i class="fa fa-address-card icon-sidebar"></i>  <span >Datewie Paid Invoice List</span></a>
         </li>
       <?php } ?>


       <?php if(($this->auth->can('date_wise_due_invoice_list-admin'))){?>

         <li><a href="admin/date_wise_due_invoice_list"><i class="fa fa-list icon-sidebar"></i>  <span >Datewie Due Invoice List</span></a>
         </li>
       <?php } ?>

       <?php if(($this->auth->can('test_group_wise_collection-admin'))){?>

         <li><a href="admin/test_group_wise_collection"><i class="fa fa-object-group icon-sidebar"></i>  <span >Group Wise Collection</span></a></li>
       <?php } ?>





       <?php if(($this->auth->can('discount_summary-admin'))){?>
         <li><a href="admin/discount_summary"><i class="fa fa-object-group icon-sidebar"></i>  <span >Discount Summary</span></a></li>
       <?php } ?>

       <?php if(($this->auth->can('cancel_invoice_list-admin'))){?>
         <li><a href="admin/cancel_invoice_list"><i class="fa fa-ban icon-sidebar"></i>  <span >cancel Invoice List</span></a></li>
       <?php } ?>



     </ul>
   </li>

 <?php } ?>

 <!-- Outdooor Ends -->

 <!-- Outdooor Account Starts -->

 <?php if($this->auth->can('opd_today_collection-admin') || 
  $this->auth->can('opd_collection_by_operator-admin')||
  $this->auth->can('marketing_officer_wise_collection-admin') ||
  $this->auth->can('opd_datewise_collection_summary-admin') ||
  $this->auth->can('date_wise_balance_sheet_opd-admin') ||
  $this->auth->can('outdoor_due_collection_report-admin') ||
  $this->auth->can('opd_due_collection_by_operator-admin')){?>

   <li class="treeview">
     <a href="javascript:void(0)"><i class="fa fa-server icon-sidebar"></i>  <span >Outdoor Accounts</span><i
       class="icon icon-angle-left s-18 pull-right"></i></a>
       <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">

         <?php if(($this->auth->can('opd_today_collection-admin'))){?>
           <li><a href="admin/opd_today_collection"><i class="fa fa-window-restore icon-sidebar"></i><span >Outdoor Collection</span></a></li>
         <?php } ?>

         <?php if(($this->auth->can('outdoor_due_collection_report-admin'))){?>

           <li><a href="admin/opd_collection_by_operator"><i class="fa fa-cubes icon-sidebar"></i>  <span >Opd Collection By Operator</span></a></li>

         <?php } ?>

         <?php if(($this->auth->can('marketing_officer_wise_collection-admin'))){?>

           <li><a href="admin/marketing_officer_wise_collection"><i class="fa fa-cubes icon-sidebar"></i>  <span >Marketing Officer Wise Collection</span></a></li>

         <?php } ?>



         <?php if(($this->auth->can('opd_datewise_collection_summary-admin'))){?>
           <li><a href="admin/opd_datewise_collection_summary"><i class="fa fa-table icon-sidebar"></i>  <span >Opd Datewise Collection Summary</span></a></li>
         <?php } ?>

         <?php if(($this->auth->can('date_wise_balance_sheet_opd-admin'))){?>
           <li><a href="admin/date_wise_balance_sheet_opd"><i class="fa fa-file-excel-o icon-sidebar"></i>  <span >Outdoor Balance Sheet</span></a></li>
         <?php } ?>

         <?php if(($this->auth->can('outdoor_due_collection_report-admin'))){?>
           <li><a href="admin/outdoor_due_collection_report"><i class="fa fa-cubes icon-sidebar"></i>  <span >Outdoor Due Collection Report</span></a></li>

         <?php } ?>

         <!-- <?php if(($this->auth->can('outdoor_due_collection_report-admin'))){?> -->
         <li><a href="admin/opd_due_collection_by_operator"><i class="fa fa-cubes icon-sidebar"></i>  <span >Opd Due Collection By Operator</span></a></li>

         <!-- <?php } ?> -->




         <?php if(($this->auth->can('head_list-admin'))){?>
            <!-- <li><a href="admin/head_list"><i class="fa fa-user-plus icon-sidebar"></i>  <span >Add Accounts Head</span></a>
            </li> -->
          <?php } ?>

          <?php if(($this->auth->can('income_list-admin'))){?>
           <!--  <li><a href="admin/income_list"><i class="fa fa-money icon-sidebar"></i>  <span >Add Income</span></a>
           </li> -->
         <?php } ?>

         <?php if(($this->auth->can('expense_list-admin'))){?>
            <!-- <li><a href="admin/expense_list"><i class="fa fa-gg icon-sidebar"></i>  <span >Add Expense</span></a>
            </li> -->
          <?php } ?>
        </ul>
      </li>


    <?php } ?>

    <!-- Outdoor Account Ends -->

    <!-- Manage Cabin Starts -->

    <?php  if($this->auth->can('cabin_class_room_list-admin') || $this->auth->can('indoor_cabin_summary-admin')){?>

     <li class="treeview <?php if($active=='cabin_class_room_list'){echo 'active';}?>">
       <a href="admin/cabin_class_room_list"><i class="fa fa-puzzle-piece icon-sidebar"></i>  <span >Indoor Cabin Management</span><i class="icon icon-angle-left s-18 pull-right"></i></a>
       <ul class="treeview-menu <?php if($active=='cabin_class_room_list'){echo 'menu-open display_block';}?>">

         <?php if(($this->auth->can('cabin_class_room_list-admin'))){?>
          <li><a href="admin/cabin_class_room_list/1"><i class="fa fa-file-text-o icon-sidebar"></i>  <span >Cabin Class & Room List</span></a></li>
        <?php } ?>

        <?php if(($this->auth->can('indoor_cabin_summary-admin'))){?>
          <li><a href="admin/indoor_cabin_summary"><i class="fa fa-file-word-o icon-sidebar"></i>  <span >Indoor Cabin Summary</span></a></li>

        <?php } ?>
      </ul>
    </li>
  <?php } ?>

  <!-- Manage Cabin Ends -->

  <!-- Manage Indoor Starts-->

  <?php if($this->auth->can('ipd_registration-admin') ||
    $this->auth->can('ipd_all_patient_list-admin') ||
    $this->auth->can('ipd_patient_billing_list_all-admin')||
    $this->auth->can('ipd_patient_billing_list_due-admin')||
    $this->auth->can('ipd_patient_billing_list_paid-admin')||
    $this->auth->can('ipd_patient_release_list-admin')||
    $this->auth->can('ipd_patient_unrelease_list-admin')||
    $this->auth->can('prescription_list-admin')||
    $this->auth->can('indoor_due_collection-admin')||
    $this->auth->can('cabin_transfer-admin')||
    $this->auth->can('add_ipd_patient_service-admin')||
    $this->auth->can('operation_cost-admin')||
    $this->auth->can('outdoor_service_order_list-admin') ||
    $this->auth->can('edit_indoor_patient_bill-admin') ||
    $this->auth->can('prescription_list-admin') 

  ){?>


    <li class="treeview <?php if($active=='ipd_registration' || $active=='ipd_patient_list' || $active == 'patient_details' || $active == 'ipd_billing' || $active == 'cabin_transfer' ){echo 'active';}?>">
      <a href="javascript:void(0)"><i class="fa fa-cube icon-sidebar"></i>  <span >Indoor</span><i
        class="icon icon-angle-left s-18 pull-right"></i></a>
        <ul class="treeview-menu <?php if($active=='ipd_registration'){echo 'menu-open display_block';}?>">

          <?php if(($this->auth->can('ipd_registration-admin'))){?>
            <li><a href="admin/ipd_registration"><i class="fa fa-registered icon-sidebar"></i>  <span >Indoor Registration</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('ipd_all_patient_list-admin'))){?>
            <li><a href="admin/ipd_all_patient_list"><i class="fa fa-bed icon-sidebar"></i>  <span >Indoor All Patient List</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('ipd_patient_billing_list_all-admin'))){?>
            <li><a href="admin/ipd_patient_billing_list_all"><i class="fa fa-file-text"></i>  <span >Indoor All Billing List</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('edit_indoor_patient_bill-admin'))){?>
            <li><a href="admin/edit_indoor_patient_bill"><i class="fa fa-file-text"></i>  <span >Edit Ipd Patient Bill</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('ipd_patient_billing_list_due-admin'))){?>
            <li><a href="admin/ipd_patient_billing_list_due"><i class="fa fa-window-restore"></i>  <span >Indoor Due Patient List</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('ipd_patient_billing_list_paid-admin'))){?>
            <li><a href="admin/ipd_patient_billing_list_paid"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Indoor Paid Patient List</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('ipd_patient_release_list-admin'))){?>
            <li><a href="admin/ipd_patient_release_list"><i class="fa fa-list-alt"></i>  <span >Indoor Release Patient List</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('ipd_patient_unrelease_list-admin'))){?>
            <li><a href="admin/ipd_patient_unrelease_list"><i class="fa fa-list-ol"></i>  <span >Indoor UnRelease Patient List</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('indoor_due_collection-admin'))){?>
            <li><a href="admin/indoor_due_collection"><i class="fa fa-window-restore"></i>  <span >Indoor Due Collection</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('prescription_list-admin'))){?>
            <li><a href="admin/prescription_list"><i class="fa fa-file-text"></i>  <span >Discharge List</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('cabin_transfer-admin'))){?>
            <li><a href="admin/cabin_transfer"><i class="fa fa-wheelchair"></i>  <span >Cabin Transfer</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('add_ipd_patient_service-admin'))){?>
            <li><a href="admin/add_ipd_patient_service"><i class="fa fa-check-square"></i>  <span >Indoor Service</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('operation_cost-admin'))){?>
            <li><a href="admin/operation_cost"><i class="fa fa-check-square"></i>  <span >Operation Cost</span></a>
            </li>
          <?php } ?>


          <?php if(($this->auth->can('outdoor_service_order_list-admin'))){?>
            <li><a href="admin/outdoor_service_order_list"><i class="fa fa-sort-numeric-asc"></i>  <span >Diagonostic Service List Datewise</span></a>
            </li>
          <?php } ?>

          <?php if(($this->auth->can('outdoor_service_ipd-admin'))){?>
            <li><a href="admin/outdoor_service_ipd"><i class="fa fa-sort-numeric-asc"></i>  <span >Take Diagonostic Service</span></a>
            </li>
          <?php } ?>

        </ul>
      </li>

    <?php } ?>

    <!-- Manage Indoor Ends-->

    <!-- Manage Indoor Account Starts-->

    <?php if($this->auth->can('ipd_summary_day_wise-admin') || 
      $this->auth->can('date_wise_indoor_collection-admin') ||
      $this->auth->can('date_wise_balance_sheet_ipd-admin')||
      $this->auth->can('ipd_collection_by_opd-admin')||
      $this->auth->can('ipd_adv_pay_daywise-admin')
    ) { ?>

      <li class="treeview">
        <a href="javascript:void(0)"><i class="fa fa-server icon-sidebar"></i>  <span >Indoor Accounts</span><i
          class="icon icon-angle-left s-18 pull-right"></i></a>
          <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
            <?php if(($this->auth->can('ipd_summary_day_wise-admin'))){?>
              <li><a href="admin/ipd_summary_day_wise"><i class="fa fa-pie-chart"></i>  <span >Indoor Day Wise Summary</span></a>
              </li>
            <?php } ?>

            <?php if(($this->auth->can('date_wise_indoor_collection-admin'))){?>

              <li><a href="admin/date_wise_indoor_collection"><i class="fa fa-newspaper-o"></i>  <span >DateWise Indoor Collection</span></a></li>

            <?php } ?>

            <?php if(($this->auth->can('date_wise_balance_sheet-admin'))){?>
              <li><a href="admin/date_wise_balance_sheet_ipd"><i class="fa fa-file-text"></i>  <span >Indoor Balance Sheet</span></a></li>
            <?php } ?>

            <?php if(($this->auth->can('ipd_collection_by_opd-admin'))){?>
              <li><a href="admin/ipd_collection_by_opd"><i class="fa fa-object-group icon-sidebar"></i><span >IPD Collection By OPD</span></a></li>
            <?php } ?>

            <?php if(($this->auth->can('operation_cost_dr_wise-admin'))){?>
              <li><a href="admin/operation_cost_dr_wise"><i class="fa fa-object-group icon-sidebar"></i><span>Operation Cost Report (Dr Wise)</span></a></li>
            <?php } ?>

            <?php if(($this->auth->can('ipd_adv_pay_daywise-admin'))){?>
              <li><a href="admin/ipd_adv_pay_daywise"><i class="fa fa-object-group icon-sidebar"></i><span>Operation Cost Report (Dr Wise)</span></a></li>
            <?php } ?>


            <?php if(($this->auth->can('head_list-admin'))){?>
                <!-- <li><a href="admin/head_list"><i class="fa fa-user-plus"></i>  <span >Add Accounts Head</span></a>
                </li> -->
              <?php } ?>

              <?php if(($this->auth->can('income_list-admin'))){?>
                <!-- <li><a href="admin/income_list"><i class="fa fa-money"></i>  <span >Add Income</span></a>
                </li> -->
              <?php } ?>

              <?php if(($this->auth->can('expense_list-admin'))){?>
                <!-- <li><a href="admin/expense_list"><i class="fa fa-database"></i>  <span>Add Expense</span></a>
                </li> -->
              <?php } ?>

            </ul>
          </li>

        <?php } ?> 

        <!-- Manage Indoor Account Ends-->

        <!-- Manage Pathology Starts-->

        <?php if($this->auth->can('technologist_list-admin') || 
          $this->auth->can('testlist-admin')||
          $this->auth->can('pathology_list-admin')||
          $this->auth->can('search_pathology-admin') || $this->auth->can('search_pathology_custom-admin')){?>

            <li class="treeview <?php if($active=='ipd_registration' || $active=='ipd_patient_list' || $active == 'patient_details' || $active == 'ipd_billing' || $active == 'cabin_transfer' ){echo 'active';}?>">
              <a href="javascript:void(0)"><i class="fa fa-print icon-sidebar"></i>  <span >Pathology Report</span><i
                class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu <?php if($active=='ipd_registration'){echo 'menu-open display_block';}?>">

                  <?php if(($this->auth->can('technologist_list-admin'))){?>
                    <li><a href="admin/technologist_list"><i class="fa fa-universal-access"></i>  <span >Technologist List</span></a>
                    </li>
                  <?php } ?>

                  <?php if(($this->auth->can('testlist-admin'))){?>
                    <li><a href="admin/testlist"><i class="fa fa-file-text"></i>  <span >Manage Test Report</span></a>
                    </li>
                  <?php } ?>

                  <?php if(($this->auth->can('pathology_list-admin'))){?>
                    <li><a href="admin/pathology_list"><i class="fa fa-list-alt"></i>  <span >Pathology Report Individual</span></a>
                    </li>
                  <?php } ?>

                  <?php if(($this->auth->can('search_pathology-admin'))){?>
                    <li><a href="admin/search_pathology"><i class="fa fa-file-text"></i>  <span >Search Pathology Report</span></a>
                    </li>
                  <?php } ?>

                  <?php if(($this->auth->can('search_pathology_custom-admin'))){?>
                    <li><a href="admin/search_pathology_custom"><i class="fa fa-file-text"></i>  <span >Search Pathology Report Custom</span></a>
                    </li>
                  <?php } ?>

                  <?php if(($this->auth->can('pathology_report_lock_unlock-admin'))){?>
                    <li><a href="admin/pathology_report_lock_unlock"><i class="fa fa-file-text"></i>  <span >Pathology Report Lock/Unlock</span></a>
                    </li>
                  <?php } ?>

                </ul>
              </li>

            <?php } ?>

            <!-- Manage Pathology Ends-->

            <!-- Manage Pharmacy Starts-->

            <?php

            if($this->auth->can('add_customer-admin') || 
              $this->auth->can('add_supplier-admin') || 
              $this->auth->can('add_unit-admin') ||
              $this->auth->can('add_rack-admin') ||
              $this->auth->can('add_gen-admin') || 
              $this->auth->can('add_pro_cat-admin') || 
              $this->auth->can('add_com-admin') ||
              $this->auth->can('add_dir-admin') ||
              $this->auth->can('product_list-admin')||
              $this->auth->can('sell_product_list-admin') ||
              $this->auth->can('purchage_product_list-admin') ||
              $this->auth->can('outstanding_supplier-admin') ||
              $this->auth->can('outstanding_customer-admin') ||
              $this->auth->can('full_paid_supp-admin') ||
              $this->auth->can('full_paid_cust-admin') ||
              $this->auth->can('edit_product_invoice-admin') ||
              $this->auth->can('stock-admin') ||
              $this->auth->can('product_stock-admin') ||
              $this->auth->can('company_stock-admin') || 
              $this->auth->can('day_wise_sale-admin') || 
              $this->auth->can('transaction_summary-admin')
            ){?>

             <li class="treeview">
               <a href="javascript:void(0)"><i class="fa fa-medkit icon-sidebar"></i>  <span >Pharmacy Management</span><i class="icon icon-angle-left s-18 pull-right"></i></a>

               <ul class="treeview-menu <?php if($active=='pharmacy'){echo 'menu-open display_block';}?>">

                <?php    if($this->auth->can('add_customer-admin') || 
                  $this->auth->can('add_supplier-admin') || 
                  $this->auth->can('add_unit-admin') ||
                  $this->auth->can('add_rack-admin') ||
                  $this->auth->can('add_gen-admin') || 
                  $this->auth->can('add_pro_cat-admin') || 
                  $this->auth->can('add_com-admin') ||
                  $this->auth->can('add_dir-admin') ){?>

                   <li>
                     <a href=""><i class="fa fa-cube"></i>  <span>Manage Pharmacy</span> <i class="icon icon-angle-left s-18 pull-right"></i></a> 


                     <ul class="treeview-menu <?php if($active=='pharmacy'){echo 'menu-open display_block';}?>">

                       <?php if(($this->auth->can('add_customer-admin'))){?>
                        <li><a href="admin/add_customer"><i class="fa fa-user-plus"></i>  <span >Add Customer</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('add_supplier-admin'))){?>
                        <li><a href="admin/add_supplier"><i class="fa fa-user-plus"></i>  <span >Add Supplier</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('add_unit-admin'))){?>
                        <li><a href="admin/add_unit"><i class="fa fa-mercury"></i>  <span >Add Unit</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('add_rack-admin'))){?>
                        <li><a href="admin/add_rack"><i class="fa fa-mercury"></i>  <span >Add Rack</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('add_gen-admin'))){?>
                        <li><a href="admin/add_gen"><i class="fa fa-plus-square"></i>  <span >Add Generic Name</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('add_pro_cat-admin'))){?>
                        <li><a href="admin/add_pro_cat"><i class="fa fa-product-hunt"></i>  <span >Add Product Category</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('add_com-admin'))){?>
                        <li><a href="admin/add_com"><i class="fa fa-address-card"></i>  <span >Add Company Name</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('add_dir-admin'))){?>
                        <li><a href="admin/add_dir"><i class="fa fa-id-card"></i>  <span >Add Director</span></a>
                        </li>
                      <?php } ?>

                    </ul>
                  </li>

                <?php } ?>

                <?php if($this->auth->can('product_list-admin')||
                  $this->auth->can('sell_product_list-admin') ||
                  $this->auth->can('purchage_product_list-admin') ||
                  $this->auth->can('outstanding_supplier-admin') ||
                  $this->auth->can('outstanding_customer-admin') ||
                  $this->auth->can('full_paid_supp-admin') ||
                  $this->auth->can('full_paid_cust-admin') ||
                  $this->auth->can('edit_product_invoice-admin')) { ?>

                    <li>
                      <a href=""><i class="fa fa-cube"></i>  <span>Product</span> <i class="icon icon-angle-left s-18 pull-right"></i></a> 
                      <ul class="treeview-menu <?php if($active=='pharmacy'){echo 'menu-open display_block';}?>">

                       <?php if(($this->auth->can('add_product-admin'))){?>
                        <li><a href="admin/add_product"><i class="fa fa-cube"></i>  <span >Add Product</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('product_list-admin'))){?>
                        <li><a href="admin/product_list"><i class="fa fa-cube"></i>  <span >Product List</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('sell_product-admin'))){?>
                        <li><a href="admin/sell_product"><i class="fa fa-cube"></i>  <span >Sell Product</span></a></li>
                      <?php } ?>


                      <?php if(($this->auth->can('sell_product_list-admin'))){?>
                        <li><a href="admin/sell_product_list"><i class="fa fa-cubes"></i>  <span >Sell Product List</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('edit_sale-admin'))){?>
                        <li><a href="admin/edit_sale"><i class="fa fa-edit"></i>  <span >Edit Sell Receipt</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('purchage_product-admin'))){?>
                        <li><a href="admin/purchage_product"><i class="fa fa-database"></i>  <span >Purchase Product</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('purchage_product_list-admin'))){?>
                        <li><a href="admin/purchage_product_list"><i class="fa fa-database"></i>  <span >Purchase Product List</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('edit_purchase-admin'))){?>
                        <li><a href="admin/edit_purchase"><i class="fa fa-edit"></i>  <span >Edit Purchase Receipt</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('outstanding_supplier-admin'))){?>
                        <li><a href="admin/outstanding_supplier"><i class="fa fa-users"></i>  <span >Due Supplier</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('outstanding_customer-admin'))){?>
                        <li><a href="admin/outstanding_customer"><i class="fa fa-users"></i>  <span >Due Customer</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('full_paid_supp-admin'))){?>
                        <li><a href="admin/full_paid_supp"><i class="fa fa-user-circle"></i>  <span >Full Paid Supplier</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('full_paid_cust-admin'))){?>
                        <li><a href="admin/full_paid_cust"><i class="fa fa-user-circle"></i>  <span >Full Paid Customer</span></a></li>
                      <?php } ?>



                      <?php if(($this->auth->can('make_an_order-admin'))){?>

                        <li><a href="admin/make_an_order"><i class="fa fa-info-circle"></i>Make Order</a></li>

                      <?php } ?>

                      <?php if(($this->auth->can('make_an_order_list-admin'))){?>

                        <li><a href="admin/make_an_order_list"><i class="fa fa-info-circle"></i>Order List</a></li>

                      <?php } ?>

                      <?php if(($this->auth->can('purchase_return-admin'))){?>

                        <li><a href="admin/purchase_return"><i class="fa fa-info-circle"></i>Purchase Return</a></li>

                      <?php } ?>

                      <?php if(($this->auth->can('sales_return-admin'))){?>

                        <li><a href="admin/sales_return"><i class="fa fa-info-circle"></i>Sales Return</a></li>

                      <?php } ?>





                    </ul>
                  </li>

                <?php } ?>

                <?php if ($this->auth->can('stock-admin') ||
                  $this->auth->can('product_stock-admin') ||
                  $this->auth->can('company_stock-admin')) {
                   ?>

                   <li>
                    <a href=""><i class="fa fa-cubes"></i><span>Stock</span> <i class="icon icon-angle-left s-18 pull-right"></i></a> 
                    <ul class="treeview-menu <?php if($active=='pharmacy'){echo 'menu-open display_block';}?>">

                      <?php if(($this->auth->can('stock-admin'))){?>
                        <li><a href="admin/stock"><i class="fa fa-list-ol"></i>  <span >Daily Stock Report (Datewise)</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('product_stock-admin'))){?>
                        <li><a href="admin/product_stock"><i class="fa fa-list-ol"></i>  <span >Product Wise Stock Report</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('company_stock-admin'))){?>
                        <li><a href="admin/company_stock"><i class="fa fa-list-alt"></i>  <span >Company Wise Stock Report</span></a></li>
                      <?php } ?>

                    </ul>
                  </li>

                <?php } ?>

                <?php if(($this->auth->can('day_wise_sale-admin'))){?>
                  <li><a href="admin/day_wise_sale"><i class="fa fa-cubes"></i>  <span >Sale Report Summary</span></a></li>
                <?php } ?>
                <?php if(($this->auth->can('transaction_summary-admin'))){?>
                  <li><a href="admin/transaction_summary"><i class="fa fa-database"></i>  <span >Purchase Report Summary</span></a></li>
                <?php } ?>

                <?php if(($this->auth->can('purchase_return_report-admin'))){?>
                  <li><a href="admin/purchase_return_report"><i class="fa fa-database"></i>  <span >Purchase Return Report</span></a></li>
                <?php } ?>

                <?php if(($this->auth->can('sales_return_report-admin'))){?>
                  <li><a href="admin/sales_return_report"><i class="fa fa-database"></i>  <span >Sales Return Report</span></a></li>
                <?php } ?>

                <?php if(($this->auth->can('day_wise_sale_each_transaction-admin'))){?>

                  <li><a href="admin/day_wise_sale_each_transaction"><i class="fa fa-info-circle"></i>Daywise Sales Report</a></li>

                <?php } ?>

                <?php if(($this->auth->can('day_wise_purchase_each_transaction-admin'))){?>

                  <li><a href="admin/day_wise_purchase_each_transaction"><i class="fa fa-info-circle"></i>Daywise Purchase Report</a></li>

                <?php } ?>

                <?php if(($this->auth->can('daywise_expired_date-admin'))){?>

                  <li><a href="admin/daywise_expired_date"><i class="fa fa-info-circle"></i>Expired Date Report</a></li>

                <?php } ?>


              </ul>
            </li>

            <!-- Manage Pharmacy Ends-->



            <!-- Manage Pharmacy Account Starts-->

          <?php } if($this->auth->can('dir_wise_collection-admin') || 
            $this->auth->can('day_wise_collection_pharmacy-admin')||
            $this->auth->can('date_wise_balance_sheet_phar-admin')
          ) {?>

            <li class="treeview">
              <a href="javascript:void(0)"><i class="fa fa-server icon-sidebar"></i>  <span >Pharmacy Accounts</span><i
                class="icon icon-angle-left s-18 pull-right"></i></a>
                <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">

                  <?php if(($this->auth->can('dir_wise_collection-admin'))){?>
                    <li><a href="admin/dir_wise_collection"><i class="fa fa-pie-chart"></i>  <span >Daywise Collection By Dir./Dr.</span></a>
                    </li>
                  <?php } ?>

                  <?php if(($this->auth->can('user_wise_collection_pharmacy-admin'))){?>
                    <li><a href="admin/user_wise_collection_pharmacy"><i class="fa fa-pie-chart"></i>  <span >Userwise Collection</span></a>
                    </li>
                  <?php } ?>

                  <?php if(($this->auth->can('day_wise_collection_pharmacy-admin'))){?>
                    <li><a href="admin/day_wise_collection_pharmacy"><i class="fa fa-cubes"></i>  <span >Daywise Collection By Pharmacy</span></a>
                    </li>
                  <?php } ?>

                  <?php if(($this->auth->can('date_wise_balance_sheet_phar-admin'))){?>
                    <li><a href="admin/date_wise_balance_sheet_phar"><i class="fa fa-file-excel-o"></i>  <span >Pharmacy Balance Sheet</span></a></li>
                  <?php } ?>

                  <?php if(($this->auth->can('head_list-admin'))){?>
                      <!-- <li><a href="admin/head_list"><i class="fa fa-user-plus"></i>  <span >Add Accounts Head</span></a>
                      </li> -->
                    <?php } ?>

                    <?php if(($this->auth->can('income_list-admin'))){?>
                      <!-- <li><a href="admin/income_list"><i class="fa fa-money"></i>  <span >Add Income</span></a>
                      </li> -->
                    <?php } ?>

                    <?php if(($this->auth->can('expense_list-admin'))){?>
                      <!-- <li><a href="admin/expense_list"><i class="fa fa-file-text"></i>  <span >Add Expense</span></a>
                      </li> -->
                    <?php } ?>
                  </ul>
                </li>

              <?php } ?>

              <!-- Manage Pharmacy Account Ends-->

              <!-- Manage Lab System Starts-->

              <li class="treeview">
               <a href="javascript:void(0)"><i class="fa fa-medkit icon-sidebar"></i>  <span >Lab Management</span><i class="icon icon-angle-left s-18 pull-right"></i></a>

               <ul class="treeview-menu <?php if($active=='lab'){echo 'menu-open display_block';}?>">

                <?php if($this->auth->can('lab_product_list-admin')||
                  //$this->auth->can('lab_out_product_list-admin') ||
                  $this->auth->can('lab_in_product_list-admin') ||
                  $this->auth->can('lab_outstanding_supplier-admin') ||
                  $this->auth->can('lab_full_paid_supp-admin') ||
                  $this->auth->can('lab_in_return-admin') ||
                  $this->auth->can('lab_edit_product_invoice-admin')) { ?>

                    <li>
                     <a href=""><i class="fa fa-cube"></i>  <span>Manage Lab</span> <i class="icon icon-angle-left s-18 pull-right"></i></a> 


                     <ul class="treeview-menu <?php if($active=='pharmacy'){echo 'menu-open display_block';}?>">



                      <?php if(($this->auth->can('add_supplier-admin'))){?>
                        <li><a href="admin/add_supplier"><i class="fa fa-user-plus"></i>  <span >Add Supplier</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('add_unit-admin'))){?>
                        <li><a href="admin/add_unit"><i class="fa fa-mercury"></i>  <span >Add Unit</span></a>
                        </li>
                      <?php } ?>



                      <?php if(($this->auth->can('add_gen-admin'))){?>
                        <li><a href="admin/add_gen"><i class="fa fa-plus-square"></i>  <span >Add Generic Name</span></a>
                        </li>
                      <?php } ?>



                      <?php if(($this->auth->can('add_com-admin'))){?>
                        <li><a href="admin/add_com"><i class="fa fa-address-card"></i>  <span >Add Company Name</span></a>
                        </li>
                      <?php } ?>

                    </ul>
                  </li>

                  <li>


                    <a href=""><i class="fa fa-cube"></i>  <span>Product</span> <i class="icon icon-angle-left s-18 pull-right"></i></a> 
                    <ul class="treeview-menu <?php if($active=='lab'){echo 'menu-open display_block';}?>">

                      <?php if(($this->auth->can('lab_product_list-admin'))){?>
                        <li><a href="admin/lab_product_list"><i class="fa fa-cube"></i>  <span >Lab Product List</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('lab_in_product_list-admin'))){?>
                        <li><a href="admin/lab_in_product_list"><i class="fa fa-database"></i>  <span >Lab Purchase Product List</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('lab_outstanding_supplier-admin'))){?>
                        <li><a href="admin/lab_outstanding_supplier"><i class="fa fa-users"></i>  <span >Due Supplier</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('lab_full_paid_supp-admin'))){?>
                        <li><a href="admin/lab_full_paid_supp"><i class="fa fa-user-circle"></i>  <span >Full Paid Supplier</span></a></li>
                      <?php } ?>

                      <?php if(($this->auth->can('lab_edit_product_invoice-admin'))){?>
                          <!--<li><a href="admin/lab_edit_product_invoice"><i class="fa fa-edit"></i>  <span >Edit Receipt</span></a>
                          </li>-->
                        <?php } ?>

                        <?php if(($this->auth->can('lab_in_return-admin'))){?>

                          <li><a href="admin/lab_in_return"><i class="fa fa-info-circle"></i>Lab In Return</a></li>

                        <?php } ?>
                      </ul>
                    </li>

                  <?php } ?>

                  <?php if ($this->auth->can('lab_stock-admin') ||
                    $this->auth->can('lab_product_stock-admin') ||
                    $this->auth->can('lab_company_stock-admin')) {
                     ?>

                     <li>
                      <a href=""><i class="fa fa-cubes"></i><span>Stock</span> <i class="icon icon-angle-left s-18 pull-right"></i></a> 
                      <ul class="treeview-menu <?php if($active=='lab'){echo 'menu-open display_block';}?>">

                        <?php if(($this->auth->can('lab_stock-admin'))){?>
                          <li><a href="admin/lab_stock"><i class="fa fa-list-ol"></i>  <span >Lab Stock Report</span></a></li>
                        <?php } ?>

                        <?php if(($this->auth->can('lab_product_stock-admin'))){?>
                          <li><a href="admin/lab_product_stock"><i class="fa fa-list-ol"></i>  <span >Product Wise Lab Stock Report</span></a></li>
                        <?php } ?>

                        <?php if(($this->auth->can('company_stock-admin'))){?>
                          <li><a href="admin/lab_company_stock"><i class="fa fa-list-alt"></i>  <span >Company Wise Lab Stock Report</span></a></li>
                        <?php } ?>

                      </ul>
                    </li>

                  <?php } ?>
                </ul>
              </li>

              
              <!-- Manage  Lab System Ends-->

              <!-- Manage Account Starts-->

              <?php if  ($this->auth->can('head_list-admin') || 
                $this->auth->can('income_list-admin')||
                $this->auth->can('expense_list-admin')||
                $this->auth->can('asset_list-admin')||
                $this->auth->can('other_asset_report-admin')||
                $this->auth->can('other_expense_report-admin')||
                $this->auth->can('other_income_report-admin') || 
                $this->auth->can('date_wise_balance_sheet_acc-admin')
              ){?>

                <li class="treeview <?php if($active=='Acc_head'){echo 'active';}?>">
                  <a href="javascript:void(0)"><i class="fa fa-cog icon-sidebar"></i>  <span >Accounts Management</span><i
                    class="icon icon-angle-left s-18 pull-right"></i></a>
                    <ul class="treeview-menu">

                      <?php if(($this->auth->can('head_list-admin'))){?>
                        <li><a href="admin/head_list"><i class="fa fa-user-plus"></i>  <span >Head List</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('income_list-admin'))){?>

                        <li><a href="admin/income_list"><i class="fa fa-money"></i>  <span >Income List</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('expense_list-admin'))){?>
                        <li><a href="admin/expense_list"><i class="fa fa-mercury"></i>  <span >Expense List</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('asset_list-admin'))){?>
                        <li><a href="admin/asset_list"><i class="fa fa-list-ol"></i>  <span >Asset List</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('other_asset_report-admin'))){?>
                        <li><a href="admin/other_asset_report"><i class="fa fa-file-text-o"></i>  <span >Date Wise Others Asset Report</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('other_expense_report-admin'))){?>
                        <li><a href="admin/other_expense_report"><i class="fa fa-file-text"></i>  <span >Date Wise Others Expense Report</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('other_income_report-admin'))){?>
                        <li><a href="admin/other_income_report"><i class="fa fa-list-alt"></i>  <span >Date Wise Others Income Report</span></a>
                        </li>
                      <?php } ?>

                      <?php if(($this->auth->can('date_wise_balance_sheet_acc-admin'))){?>
                       <li><a href="admin/date_wise_balance_sheet_acc"><i class="fa fa-file-excel-o"></i>  <span >Date Wise Balance Sheet</span></a>
                       </li>
                     <?php } ?>

                     <?php if(($this->auth->can('date_wise_balance_sheet_opd-admin'))){?>
                      <li><a href="admin/date_wise_balance_sheet_opd"><i class="fa fa-file-excel-o icon-sidebar"></i>  <span >Outdoor Balance Sheet Opd</span></a></li>
                    <?php } ?>

                    <?php if(($this->auth->can('date_wise_balance_sheet_ipd-admin'))){?>
                     <li><a href="admin/date_wise_balance_sheet_ipd"><i class="fa fa-file-excel-o icon-sidebar"></i>  <span >Outdoor Balance Sheet Ipd</span></a></li>
                   <?php } ?>

                   <?php if(($this->auth->can('date_wise_balance_sheet_phar-admin'))){?>
                     <li><a href="admin/date_wise_balance_sheet_phar"><i class="fa fa-file-excel-o icon-sidebar"></i>  <span >Outdoor Balance Sheet Pharma</span></a></li>
                   <?php } ?>

                   <?php if(($this->auth->can('date_wise_balance_sheet_others_income-admin'))){?>
                     <li><a href="admin/date_wise_balance_sheet_others_income"><i class="fa fa-file-excel-o icon-sidebar"></i>  <span >Balance Sheet Others Income</span></a></li>
                   <?php } ?>

                   <?php if(($this->auth->can('date_wise_balance_sheet_others_expense-admin'))){?>
                     <li><a href="admin/date_wise_balance_sheet_others_expense"><i class="fa fa-file-excel-o icon-sidebar"></i>  <span> Balance Sheet Others Expense</span></a></li>
                   <?php } ?>

                 </ul>
               </li>

             <?php }  ?>

             <!-- Manage Account Ends-->

             <!-- Shahed Code Starts-->
             <!-- Manage HR Starts-->
             <?php if($this->auth->can('add_staff_designation-admin') ||$this->auth->can('all_staff_designation_list-admin') || $this->auth->can('staff_registation-admin') || 
              $this->auth->can('all_staff_list-admin')||
              $this->auth->can('staff_salary_generate-admin')||
              $this->auth->can('all_staff_payment_list-admin')||
              $this->auth->can('all_staff_salary_payment_report-admin') ||
              $this->auth->can('add_staff_groups-admin')||
              $this->auth->can('staff_group_list-admin')

            ){?>

              <li class="treeview <?php if($active=='HR_head'){echo 'active';}?>">
                <a href="javascript:void(0)"><i class="fa fa-user-md icon-sidebar"></i>  <span >HR Management</span><i
                  class="icon icon-angle-left s-18 pull-right"></i></a>
                  <ul class="treeview-menu">

                    <?php if(($this->auth->can('add_staff_designation-admin'))){?>
                      <li><a href="admin/add_staff_designation"><i class="fa fa-user-plus"></i>  <span >Add Designation</span></a>
                      </li>
                    <?php } ?>


                    <?php if(($this->auth->can('add_staff_groups-admin'))){?>
                      <li><a href="admin/add_staff_groups"><i class="fa fa-user-plus"></i>  <span >Add Groups</span></a>
                      </li>
                    <?php } ?>

                    <?php if(($this->auth->can('staff_group_list-admin'))){?>
                      <li><a href="admin/staff_group_list"><i class="fa fa-user-plus"></i>  <span >Groups List</span></a>
                      </li>
                    <?php } ?>

                    <?php if(($this->auth->can('all_staff_designation_list-admin'))){?>
                      <li><a href="admin/all_staff_designation_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Designation List</span></a>
                      </li>
                    <?php } ?>
                    <?php if(($this->auth->can('staff_registation-admin'))){?>
                      <li><a href="admin/staff_registation"><i class="fa fa-user-plus"></i>  <span >Staff Registation</span></a>
                      </li>
                    <?php } ?>
                    <?php if(($this->auth->can('all_staff_list-admin'))){?>
                      <li><a href="admin/all_staff_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Staff List</span></a>
                      </li>
                    <?php } ?>
                    <?php if(($this->auth->can('staff_salary_generate-admin'))){?>
                      <li><a href="admin/staff_salary_generate"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Staff Salary Generate</span></a>
                      </li>
                    <?php } ?>
                    <?php if(($this->auth->can('all_staff_payment_list-admin'))){?>
                      <li><a href="admin/all_staff_payment_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Staff Payment</span></a>
                      </li>
                    <?php } ?>

                    <?php if(($this->auth->can('all_staff_salary_payment_report-admin'))){?>
                      <li><a href="admin/all_staff_salary_payment_report"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Staff Salary Payment Report</span></a>
                      </li>
                    <?php } ?>


                  </ul>
                </li>

              <?php }  ?>
              <!-- Manage HR Ends-->


              <!-- Manage Ambulence Starts-->
              <?php if($this->auth->can('ambulance_receipt_registation-admin') || 
                $this->auth->can('add_ambulance-admin') || 
                $this->auth->can('ambulance_list-admin') ||
                $this->auth->can('ambulance_receipt_list-admin')){?>

                  <li class="treeview <?php if($active=='Ambulance_head'){echo 'active';}?>">
                    <a href="javascript:void(0)"><i class="fa fa-user-md icon-sidebar"></i>  <span >Ambulance Managment</span><i
                      class="icon icon-angle-left s-18 pull-right"></i></a>
                      <ul class="treeview-menu">

                        <?php if(($this->auth->can('add_ambulance-admin'))){?>
                          <li><a href="admin/add_ambulance"><i class="fa fa-user-plus"></i>  <span >Add Ambulance</span></a>
                          </li>
                        <?php } ?>

                        <?php if(($this->auth->can('ambulance_list-admin'))){?>
                          <li><a href="admin/ambulance_list"><i class="fa fa-user-plus"></i>  <span >Ambulance List</span></a>
                          </li>
                        <?php } ?>

                        <?php if(($this->auth->can('ambulance_receipt_registation-admin'))){?>
                          <li><a href="admin/ambulance_receipt_registation"><i class="fa fa-user-plus"></i>  <span >Ambulance Reciept Create</span></a>
                          </li>
                        <?php } ?>
                        <?php if(($this->auth->can('ambulance_receipt_list-admin'))){?>
                          <li><a href="admin/ambulance_receipt_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Ambulance Receipt List</span></a>
                          </li>
                        <?php } ?>
                        <?php if(($this->auth->can('ambulance_all_receipt_report-admin'))){?>
                          <li><a href="admin/ambulance_all_receipt_report"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Ambulance Receipt List Report</span></a>
                          </li>
                        <?php } ?>


                      </ul>
                    </li>

                  <?php }  ?>
                  <!-- Manage Ambulence Ends-->
                  <!-- Manage Emergency Starts-->
                  <?php if($this->auth->can('emergency_receipt_registation-admin') || 
                  $this->auth->can('emergency_receipt_list-admin')){?>

                    <li class="treeview <?php if($active=='Emergency_head'){echo 'active';}?>">
                      <a href="javascript:void(0)"><i class="fa fa-user-md icon-sidebar"></i>  <span >Emergency Managment</span><i
                        class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">

                          <?php if(($this->auth->can('emergency_receipt_registation-admin'))){?>
                            <li><a href="admin/emergency_receipt_registation"><i class="fa fa-user-plus"></i>  <span >Emergency Reciept Create</span></a>
                            </li>
                          <?php } ?>
                          <?php if(($this->auth->can('emergency_receipt_list-admin'))){?>
                            <li><a href="admin/emergency_receipt_list"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Emergency Receipt List</span></a>
                            </li>
                          <?php } ?>
                          <?php if(($this->auth->can('emergency_all_receipt_report-admin'))){?>
                            <li><a href="admin/emergency_all_receipt_report"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Emergency All Receipt List</span></a>
                            </li>
                          <?php } ?>


                        </ul>
                      </li>

                    <?php }  ?>
                    <!-- Manage Emergency Ends-->




                    <!-- Shahed Code Ends-->


                    <!-- All Reports Starts-->

                    <?php if($this->auth->can('other_asset_report-admin')||
                      $this->auth->can('other_expense_report-admin')||
                      $this->auth->can('other_income_report-admin') || 
                      $this->auth->can('date_wise_balance_sheet_acc-admin')
                    ){?>

                      <li class="treeview <?php if($active=='Acc_head'){echo 'active';}?>">
                        <a href="javascript:void(0)"><i class="fa fa-cog icon-sidebar"></i>  <span >All Reports</span><i
                          class="icon icon-angle-left s-18 pull-right"></i></a>
                          <ul class="treeview-menu">

                            <?php if(($this->auth->can('opd_col_from_doc-admin'))){?>

                              <li><a href="admin/opd_col_from_doc"><i class="fa fa-list-alt icon-sidebar"></i>  <span >Col. From Doctor (Group Wise)</span></a>
                              </li>

                            <?php } ?>

                            <?php if(($this->auth->can('opd_col_from_doc_with_com_mbbs-admin'))){?>

                              <li><a href="admin/opd_col_from_doc_with_com_mbbs"><i class="fa fa-info-circle icon-sidebar"></i>  <span >Doctor Com. Report Mbbs(Dr. Com.)</span></a>
                              </li>

                            <?php } ?>

                            <?php if(($this->auth->can('opd_col_from_doc_with_com_quack-admin'))){?>

                              <li><a href="admin/opd_col_from_doc_with_com_quack"><i class="fa fa-info-circle icon-sidebar"></i>  <span >Doctor Com. Report Quack(Dr. Com.)</span></a>
                              </li>

                            <?php } ?>

                            <?php if(($this->auth->can('opd_col_from_doc_with_com_details-admin'))){?>

                              <li><a href="admin/opd_col_from_doc_with_com_details"><i class="fa fa-info-circle icon-sidebar"></i>  <span >Doctor Com. Report(Dr. Com. Details)</span></a>
                              </li>

                            <?php } ?>

                            <?php if(($this->auth->can('opd_com_list_report-admin'))){?>

                             <li><a href="admin/opd_com_list_report"><i class="fa fa-file-text icon-sidebar"></i>  <span >Doctor Com. Report (paid/unpaid)</span></a>
                             </li>
                           <?php } ?>

                           <?php if(($this->auth->can('test_group_wise_collection-admin'))){?>

                             <li><a href="admin/test_group_wise_collection"><i class="fa fa-object-group icon-sidebar"></i>  <span >Group Wise Collection</span></a></li>

                           <?php } ?>

                           <?php if(($this->auth->can('discount_summary-admin'))){?>
                             <li><a href="admin/discount_summary"><i class="fa fa-object-group icon-sidebar"></i>  <span >Discount Summary</span></a></li>
                           <?php } ?>

                           <?php if(($this->auth->can('opd_today_collection-admin'))){?>
                             <li><a href="admin/opd_today_collection"><i class="fa fa-window-restore icon-sidebar"></i><span >Outdoor Collection</span></a></li>
                           <?php } ?>

                           <?php if(($this->auth->can('outdoor_due_collection_report-admin'))){?>

                             <li><a href="admin/opd_collection_by_operator"><i class="fa fa-cubes icon-sidebar"></i>  <span >Opd Collection By Operator</span></a></li>

                           <?php } ?>

                           <?php if(($this->auth->can('marketing_officer_wise_collection-admin'))){?>

                             <li><a href="admin/marketing_officer_wise_collection"><i class="fa fa-cubes icon-sidebar"></i>  <span >Marketing Officer Wise Collection</span></a></li>

                           <?php } ?>



                           <?php if(($this->auth->can('opd_datewise_collection_summary-admin'))){?>
                             <li><a href="admin/opd_datewise_collection_summary"><i class="fa fa-table icon-sidebar"></i>  <span >Opd Datewise Collection Summary</span></a></li>
                           <?php } ?>

                           <?php if(($this->auth->can('date_wise_balance_sheet_opd-admin'))){?>
                             <li><a href="admin/date_wise_balance_sheet_opd"><i class="fa fa-file-excel-o icon-sidebar"></i>  <span >Outdoor Balance Sheet</span></a></li>
                           <?php } ?>

                           <?php if(($this->auth->can('outdoor_due_collection_report-admin'))){?>
                             <li><a href="admin/outdoor_due_collection_report"><i class="fa fa-cubes icon-sidebar"></i>  <span >Outdoor Due Collection Report</span></a></li>

                           <?php } ?>

                           <?php if(($this->auth->can('ipd_summary_day_wise-admin'))){?>
                            <li><a href="admin/ipd_summary_day_wise"><i class="fa fa-pie-chart"></i>  <span >Indoor Day Wise Summary</span></a>
                            </li>
                          <?php } ?>

                          <?php if(($this->auth->can('date_wise_indoor_collection-admin'))){?>

                            <li><a href="admin/date_wise_indoor_collection"><i class="fa fa-newspaper-o"></i>  <span >DateWise Indoor Collection</span></a></li>

                          <?php } ?>

                          <?php if(($this->auth->can('date_wise_balance_sheet-admin'))){?>
                            <li><a href="admin/date_wise_balance_sheet_ipd"><i class="fa fa-file-text"></i>  <span >Indoor Balance Sheet</span></a></li>
                          <?php } ?>

                          <?php if(($this->auth->can('ipd_collection_by_opd-admin'))){?>
                            <li><a href="admin/ipd_collection_by_opd"><i class="fa fa-object-group icon-sidebar"></i><span >IPD Collection By OPD</span></a></li>
                          <?php } ?>

                          <?php if(($this->auth->can('dir_wise_collection-admin'))){?>
                            <li><a href="admin/dir_wise_collection"><i class="fa fa-pie-chart"></i>  <span >Daywise Collection By Dir./Dr.</span></a>
                            </li>
                          <?php } ?>

                          <?php if(($this->auth->can('day_wise_collection_pharmacy-admin'))){?>
                            <li><a href="admin/day_wise_collection_pharmacy"><i class="fa fa-cubes"></i>  <span >Daywise Collection By Pharmacy</span></a>
                            </li>
                          <?php } ?>

                          <?php if(($this->auth->can('date_wise_balance_sheet_phar-admin'))){?>
                            <li><a href="admin/date_wise_balance_sheet_phar"><i class="fa fa-file-excel-o"></i>  <span >Pharmacy Balance Sheet</span></a></li>
                          <?php } ?>



                          <?php if(($this->auth->can('other_asset_report-admin'))){?>
                            <li><a href="admin/other_asset_report"><i class="fa fa-file-text-o"></i>  <span >Date Wise Others Asset Report</span></a>
                            </li>
                          <?php } ?>

                          <?php if(($this->auth->can('other_expense_report-admin'))){?>
                            <li><a href="admin/other_expense_report"><i class="fa fa-file-text"></i>  <span >Date Wise Others Expense Report</span></a>
                            </li>
                          <?php } ?>

                          <?php if(($this->auth->can('other_income_report-admin'))){?>
                            <li><a href="admin/other_income_report"><i class="fa fa-list-alt"></i>  <span >Date Wise Others Income Report</span></a>
                            </li>
                          <?php } ?>

                          <?php if(($this->auth->can('date_wise_balance_sheet_acc-admin'))){?>
                           <li><a href="admin/date_wise_balance_sheet_acc"><i class="fa fa-file-excel-o"></i>  <span >Date Wise Balance Sheet</span></a>
                           </li>
                         <?php } ?>

                       </ul>
                     </li>

                   <?php } } ?>

                   <!-- Manage Account Ends-->

                   <?php if($this->auth->can('add_share_holder-admin')|| $this->auth->can('share_holder_type-admin'))
                   {?>

                     <li class="treeview <?php if($active=='Acc_head'){echo 'active';}?>"><a href="javascript:void(0)"><i class="fa fa-male icon-sidebar"></i></i>Manage Share Holder<i
                      class="icon icon-angle-left s-18 pull-right"></i></a>
                      <ul class="treeview-menu">

                        <?php if(($this->auth->can('add_share_holder-admin'))){?>
                         <li><a href="admin/add_share_holder"><i class="fa fa-user-plus"></i>  <span >Add Share Holder</span></a></li> <?php } ?>
                         <?php if(($this->auth->can('share_holder_type-admin'))){?>
                           <li> <a href="admin/share_holder_type"><i class="fa fa-user-plus"></i>  <span >Add Share Holder Type</span></a></li>
                         <?php } ?>
                       </ul>
                     </li>

                   <?php } ?>

                   <?php if(($this->auth->can('backup_db-admin'))){?>
                     <li class="treeview"><a  href="admin/backup_db"><i class="fa fa-database icon-sidebar"></i>BackUp Data</a>
                     </li>
                   <?php } ?>

                   <li class="treeview"><a href="logout"><i class="fa fa-sign-out icon-sidebar"></i>  <span >Log Out</span></a>
                   </li>
                 </section>