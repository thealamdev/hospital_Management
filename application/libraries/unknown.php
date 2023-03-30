
<section class="sidebar">
   <div class="w-80px mt-4 mb-3 ml-3">
      <!-- <img src="back_assets/img/dummy/header.png" alt=""> -->
   </div>
   <div class="relative">
      <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
      aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm fab-right fab-top btn-primary shadow1 ">
      <i class="icon icon-cogs"></i>
   </a>
   <div class="user-panel p-3 light mb-2">
      <div>
         <div class="float-left image">
            <img class="user_avatar" src="back_assets/img/dummy/logo.jpg" alt="User Image">
         </div>
         <div class="float-left info">
            <h6 class="font-weight-light mt-2 mb-1">
               <?php if($admin_type==3)
               {?>
                  <?=$hospital_ttile ?>
               </h6>
               <?php
            }
            else
            {
             echo "Admin";
          }
          ?>
          <?php
          echo "Welcome ".$username;
          ?>
       </div>
    </div>
    <div class="clearfix"></div>
    <div class="collapse multi-collapse" id="userSettingsCollapse">
      <div class="list-group mt-3 shadow">
         <a href="admin/change_password/<?php echo $role?>" class="list-group-item list-group-item-action"><i
            class="mr-2 icon-security text-purple"></i>Change Password</a>
         </div>
      </div>
   </div>
</div>

<ul class="sidebar-menu">
   <li class="header"><strong>MAIN NAVIGATION</strong></li>
   <li class="treeview"><a href="admin" class="<?php if($active=='dashboard'){echo 'active';}?>" >
      <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span >Dashboard</span> <i
      class="icon icon-angle-left s-18 pull-right"></i>
   </a>
</li>


<li class="treeview <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'active';}?>">
   <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Super Admin Area<i
      class="icon icon-angle-left s-18 pull-right"></i></a>
      <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">
         

         <?php if(($this->auth->can('add_hospital'))){?> 
            <li><a href="admin/add_hospital"><i class="icon icon-circle-o"></i>Add Hospital Title</a>
            </li>
         <?php } ?>
         <?php if(($this->auth->can('add_user'))){?> 
            <li><a href="admin/add_user"><i class="icon icon-circle-o"></i>Add Hospital User</a>
            </li>
         <?php } ?>
         <?php if(($this->auth->can('all_hospital_user_list'))){?> 
            <li><a href="admin/all_hospital_user_list"><i class="icon icon-circle-o"></i>All Hospital User List</a>
            </li>
         <?php } ?>
      </ul>
   </li>


   
   <li class="treeview <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'active';}?>">
      <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Manage<i
         class="icon icon-angle-left s-18 pull-right"></i></a>
         <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/service_list"><i class="icon icon-circle-o"></i>Service Lists</a>
               </li>
            <?php } ?>
         <!--  <?php if($admin_type==1) { ?>
            <li><a href="admin/add_hospital"><i class="icon icon-circle-o"></i>Add Hospital Title</a>
            </li>
            
            <li><a href="admin/add_user"><i class="icon icon-circle-o"></i>Add Hospital User</a>
            </li>
            
            <?php } ?> -->
         </ul>
      </li>
      <li class="treeview <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'active';}?>">
         <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Manage<i
            class="icon icon-angle-left s-18 pull-right"></i></a>
            <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/test_group"><i class="icon icon-circle-o"></i>Test Group Lists</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/operation_list"><i class="icon icon-circle-o"></i>Operation Lists</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/service_list"><i class="icon icon-circle-o"></i>Service Lists</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/add_specimen"><i class="icon icon-circle-o"></i>Add Specimen</a>
                  </li>
               <?php } ?>
         <!--  <li><a href="admin/add_hospital"><i class="icon icon-circle-o"></i>Add Hospital Title</a>
         </li> -->
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/add_user"><i class="icon icon-circle-o"></i>Add Hospital User</a>
            </li>
         <?php } ?>
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/user_list"><i class="icon icon-circle-o"></i>Hospital User List</a>
            </li>
         <?php } ?>
      </ul>
   </li>
   <li class="treeview <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'active';}?>">
      <a href="#"><i class="icon icon-account_box light-green-text s-18"></i>Manage User & Role<i
         class="icon icon-angle-left s-18 pull-right"></i></a>
         <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/role_list"><i class="icon icon-circle-o"></i>Role List</a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/add_user"><i class="icon icon-circle-o"></i>Add Hospital User</a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/user_list"><i class="icon icon-circle-o"></i>Hospital User List</a>
               </li>
            <?php } ?>
         </ul>
      </li>
      <li class="treeview <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'active';}?>">
         <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Manage Appointment<i
            class="icon icon-angle-left s-18 pull-right"></i></a>
            <ul class="treeview-menu <?php if($active=='test_group'||$active=='add_user'||$active=='add_hospital'||$active=='add_hospital_form'){echo 'menu-open display_block';}?>">
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/doc_schedule_list"><i class="icon icon-circle-o"></i>Doctor Schedule List</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/appointment_list"><i class="icon icon-circle-o"></i>Appointment List</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/attendant_list"><i class="icon icon-circle-o"></i>Attendant List</a>
                  </li>
               <?php } ?>
            </ul>
         </li>
         <li class="treeview">
            <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Doctor Management<i
               class="icon icon-angle-left s-18 pull-right"></i></a>
               <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
                  <li>
                     <a href="javascript:void(0)"><i class="icon icon-documents3"></i>Manage Doctor<i class="icon icon-angle-left s-18 pull-right"></i></a>
                     <ul class="treeview-menu <?php if($active=='opd_patient_list'){echo 'menu-open display_block';}?>">
                        <?php if(($this->auth->can('all_hospital_user_list'))){?>
                           <li><a href="admin/add_doc/1"><i class="icon icon-document"></i>Add Ref Doc</a>
                           </li>
                        <?php } ?>
                        <?php if(($this->auth->can('all_hospital_user_list'))){?>
                           <li><a href="admin/add_doc/2"><i class="icon icon-document"></i>Add Q/C Doc</a>
                           </li>
                        <?php } ?>
                        <?php if(($this->auth->can('all_hospital_user_list'))){?>
                           <li><a href="admin/all_doc_list/1"><i class="icon icon-document"></i>All Doctor List</a>
                           </li>
                        <?php } ?>
                        <?php if(($this->auth->can('all_hospital_user_list'))){?>
                           <li><a href="admin/all_doc_list/2"><i class="icon icon-document"></i>All Ref Doc List</a>
                           </li>
                        <?php } ?>
                        <?php if(($this->auth->can('all_hospital_user_list'))){?>
                           <li><a href="admin/all_doc_list/3"><i class="icon icon-document"></i>All Q/C Doc List</a>
                           </li>
                        <?php } ?>
                     </ul>
                  </li>
               </ul>
            </li>
            <li class="treeview">
               <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Outdoor<i
                  class="icon icon-angle-left s-18 pull-right"></i></a>
                  <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
                     <li>
                        <a href="javascript:void(0)"><i class="icon icon-documents3"></i>Outdoor Patient List<i class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu <?php if($active=='opd_patient_list'){echo 'menu-open display_block';}?>">
                           <?php if(($this->auth->can('all_hospital_user_list'))){?>
                              <li><a href="admin/show_all_opd_patient"><i class="icon icon-document"></i>All Patient List</a>
                              </li>
                           <?php } ?>
                           <?php if(($this->auth->can('all_hospital_user_list'))){?>
                              <li><a href="admin/show_all_paid_opd_patient"><i class="icon icon-document"></i>Paid Patient List</a>
                              </li>
                           <?php } ?>
                           <?php if(($this->auth->can('all_hospital_user_list'))){?>
                              <li><a href="admin/show_all_unpaid_opd_patient"><i class="icon icon-document"></i>Due Patient List</a>
                              </li>
                           <?php } ?>
                        </ul>
                     </li>
                     <!-- <li><a href="admin/discount_summary"><i class="icon icon-circle-o"></i>Outdoor Discount Summary</a> -->
                     </li>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/opd_registration"><i class="icon icon-circle-o"></i>Outdoor Registration</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/opd_all_billing_info"><i class="icon icon-circle-o"></i>Outdoor Billing</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/edit_opd_invoice"><i class="icon icon-circle-o"></i>Edit Receipt</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/opd_com_list"><i class="icon icon-circle-o"></i>Doctor Commission List</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/opd_today_com_list/qc"><i class="icon icon-circle-o"></i>Datewise Q/C Com. Details List</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/opd_today_com_list/rf"><i class="icon icon-circle-o"></i>Datewise Ref Com. Details List</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/outdoor_due_collection"><i class="icon icon-circle-o"></i>Outdoor Due Collection</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/opd_com_list_report"><i class="icon icon-circle-o"></i>Doctor Com. Report (paid/unpaid)</a>
                        </li>
                     <?php } ?>
         <!--    <li><a href="admin/doc_com_summary"><i class="icon icon-circle-o"></i>Doctor Com. Report (Dr.)</a>
         </li> -->
         <!-- <li><a href="admin/doc_com_testwise"><i class="icon icon-circle-o"></i>Doctor Com. Report (Test)</a>
         </li> -->
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/test_group_wise_collection"><i class="icon icon-circle-o"></i>Group Wise Collection</a></li> 
         <?php } ?>
      </ul>
   </li>
   <li class="treeview">
      <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Outdoor Accounts<i
         class="icon icon-angle-left s-18 pull-right"></i></a>
         <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/opd_collection/1"><i class="icon icon-circle-o"></i>Outdoor Datewise Collection</a></li>
            <?php } ?>
            <!-- <li><a href="admin/due_collection_summary"><i class="icon icon-circle-o"></i>Outdoor Datewise Collection</a></li> -->
            <!-- <li><a href="admin/opd_collection/2"><i class="icon icon-circle-o"></i>Outdoor Test wise Collection</a></li> -->
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/commission_summary/qc"><i class="icon icon-circle-o"></i>Outdoor Date Wise Q/C Com Summary</a></li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/commission_summary/ref"><i class="icon icon-circle-o"></i>Outdoor Date wise Ref Com Summary</a></li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/opd_collection/3"><i class="icon icon-circle-o"></i>Outdoor Date wise Summary</a></li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/date_wise_balance_sheet/opd"><i class="icon icon-circle-o"></i>Outdoor Balance Sheet</a></li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/outdoor_due_collection_report"><i class="icon icon-circle-o"></i>Outdoor Due Collection Report</a></li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/cancel_invoice_list"><i class="icon icon-circle-o"></i>Cancel Invoice List</a></li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/head_list"><i class="icon icon-circle-o"></i>Add Accounts Head</a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/income_list"><i class="icon icon-circle-o"></i>Add Income</a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/expense_list"><i class="icon icon-circle-o"></i>Add Expense</a>
               </li>
            <?php } ?>
         </ul>
      </li>
      <li class="treeview <?php if($active=='cabin_class_room_list'){echo 'active';}?>">
         <a href="admin/cabin_class_room_list"><i class="icon icon-account_box light-green-text s-18"></i>Indoor Cabin Management<i class="icon icon-angle-left s-18 pull-right"></i></a>
         <ul class="treeview-menu <?php if($active=='cabin_class_room_list'){echo 'menu-open display_block';}?>">
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/cabin_class_room_list"><i class="icon icon-circle-o"></i>Cabin Class & Room List</a></li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/indoor_cabin_summary"><i class="icon icon-circle-o"></i>Indoor Cabin Summary</a></li>
            <?php } ?>
         </ul>
      </li>



      <li class="treeview <?php if($active=='ipd_registration' || $active=='ipd_patient_list' || $active == 'patient_details' || $active == 'ipd_billing' || $active == 'cabin_transfer' ){echo 'active';}?>">
         <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Indoor<i
            class="icon icon-angle-left s-18 pull-right"></i></a>
            <ul class="treeview-menu <?php if($active=='ipd_registration'){echo 'menu-open display_block';}?>">
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/ipd_registration"><i class="icon icon-circle-o"></i>Indoor Registration</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/ipd_all_patient_list"><i class="icon icon-circle-o"></i>Indoor All Patient List</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/ipd_patient_billing_list_all"><i class="icon icon-circle-o"></i>Indoor All Billing List</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/ipd_patient_billing_list_due"><i class="icon icon-circle-o"></i>Indoor Due Patient List</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/ipd_patient_billing_list_paid"><i class="icon icon-circle-o"></i>Indoor Paid Patient List</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/ipd_patient_release_list"><i class="icon icon-circle-o"></i>Indoor Release Patient List</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/ipd_patient_unrelease_list"><i class="icon icon-circle-o"></i>Indoor UnRelease Patient List</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/indoor_due_collection"><i class="icon icon-circle-o"></i>Indoor Due Collection</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/cabin_transfer"><i class="icon icon-circle-o"></i>Cabin Transfer</a>
                  </li>
               <?php } ?>
         <!-- <li><a href="admin/add_ipd_patient_operation"><i class="icon icon-circle-o"></i>Operation</a>
         </li> -->
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/add_ipd_patient_service"><i class="icon icon-circle-o"></i>Indoor Service</a>
            </li>
         <?php } ?>
         <!--   <li><a href="admin/outdoor_service_ipd"><i class="icon icon-circle-o"></i>Diagonostic Service</a>
         </li> -->

         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/outdoor_service_order_list"><i class="icon icon-circle-o"></i>Diagonostic Service Order List</a>
            </li>
         <?php } ?>
         <!-- <li><a href="admin/ipd_service_wise_patient"><i class="icon icon-circle-o"></i>Indoor Patient Service Wise</a>
         </li>  --> 
      </ul>
   </li>
   <li class="treeview">
      <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Indoor Accounts<i
         class="icon icon-angle-left s-18 pull-right"></i></a>
         <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/ipd_summary_day_wise"><i class="icon icon-circle-o"></i>Indoor Day Wise Summary</a>
               </li>
            <?php } ?>
         <!--  <li><a href="admin/ipd_collection_service_wise"><i class="icon icon-circle-o"></i>Indoor Service Wise Collection </a>
         </li> -->
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/date_wise_indoor_collection"><i class="icon icon-circle-o"></i>DateWise Indoor Collection</a></li>
         <?php } ?>
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/date_wise_balance_sheet/ipd"><i class="icon icon-circle-o"></i>Indoor Balance Sheet</a></li>
         <?php } ?>
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/head_list"><i class="icon icon-circle-o"></i>Add Accounts Head</a>
            </li>
         <?php } ?>
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/income_list"><i class="icon icon-circle-o"></i>Add Income</a>
            </li>
         <?php } ?>
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/expense_list"><i class="icon icon-circle-o"></i>Add Expense</a>
            </li>
         <?php } ?>
      </ul>
   </li>
   <li class="treeview <?php if($active=='ipd_registration' || $active=='ipd_patient_list' || $active == 'patient_details' || $active == 'ipd_billing' || $active == 'cabin_transfer' ){echo 'active';}?>">
      <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Pathology Report<i
         class="icon icon-angle-left s-18 pull-right"></i></a>
         <ul class="treeview-menu <?php if($active=='ipd_registration'){echo 'menu-open display_block';}?>">
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/technologist_list"><i class="icon icon-circle-o"></i>Technologist List</a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/testlist"><i class="icon icon-circle-o"></i>Test List</a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/pathology_list"><i class="icon icon-circle-o"></i>Pathology List</a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/search_pathology"><i class="icon icon-circle-o"></i>Search Pathology Report</a>
               </li>
            <?php } ?>
            <!-- <li><a href=""><i class="icon icon-circle-o"></i>IPD Collection</a> -->
            </ul>
         </li>
         <li class="treeview">
            <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Pharmacy Management<i class="icon icon-angle-left s-18 pull-right"></i></a>
            <ul class="treeview-menu <?php if($active=='pharmacy'){echo 'menu-open display_block';}?>">
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/add_customer"><i class="icon icon-circle-o"></i>Add Customer</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/add_supplier"><i class="icon icon-circle-o"></i>Add Supplier</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/add_unit"><i class="icon icon-circle-o"></i>Add Unit</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/add_gen"><i class="icon icon-circle-o"></i>Add Generic Name</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/add_pro_cat"><i class="icon icon-circle-o"></i>Add Product Category</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/add_com"><i class="icon icon-circle-o"></i>Add Company Name</a>
                  </li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/add_dir"><i class="icon icon-circle-o"></i>Add Director</a>
                  </li>
               <?php } ?>
               <li>
                  <a href=""><i class="icon icon-circle-o"></i>Product</a>
                  <ul class="treeview-menu <?php if($active=='pharmacy'){echo 'menu-open display_block';}?>">
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/product_list"><i class="icon icon-circle-o"></i>Product List</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/sell_product_list"><i class="icon icon-circle-o"></i>Sell Product</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/purchage_product_list"><i class="icon icon-circle-o"></i>Purchase Product</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/outstanding_supplier"><i class="icon icon-circle-o"></i>Due Supplier</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/outstanding_customer"><i class="icon icon-circle-o"></i>Due Customer</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/full_paid_supp"><i class="icon icon-circle-o"></i>Full Paid Supplier</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/full_paid_cust"><i class="icon icon-circle-o"></i>Full Paid Customer</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/add_product_invoice"><i class="icon icon-circle-o"></i>Edit Receipt</a>
                        </li>
                     <?php } ?>
                     <!--   <li><a href="admin/purchage_return"><i class="icon icon-circle-o"></i>Purchase Return</a></li> -->
                     <!--  <li><a href="admin/sales_return"><i class="icon icon-circle-o"></i>Sales Return</a></li> -->
                  </ul>
               </li>
               <li>
                  <a href=""><i class="icon icon-circle-o"></i>Stock</a>
                  <ul class="treeview-menu <?php if($active=='pharmacy'){echo 'menu-open display_block';}?>">
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/stock"><i class="icon icon-circle-o"></i>Stock Report</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/product_stock"><i class="icon icon-circle-o"></i>Product Wise Stock Report</a></li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/company_stock"><i class="icon icon-circle-o"></i>Company Wise Stock Report</a></li>
                     <?php } ?>
                  </ul>
               </li>
            </ul>
         </li>
         <li class="treeview">
            <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Pharmacy Accounts<i
               class="icon icon-angle-left s-18 pull-right"></i></a>
               <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
                  <?php if(($this->auth->can('all_hospital_user_list'))){?>
                     <li><a href="admin/dir_wise_collection"><i class="icon icon-circle-o"></i>Daywise Collection History By Dir./Dr.</a>
                     </li>
                  <?php } ?>
                  <?php if(($this->auth->can('all_hospital_user_list'))){?>
                     <li><a href="admin/day_wise_collection_pharmacy"><i class="icon icon-circle-o"></i>Daywise Collection By Pharmacy</a>
                     </li>
                  <?php } ?>
                  <?php if(($this->auth->can('all_hospital_user_list'))){?>
                     <li><a href="admin/date_wise_balance_sheet/phar"><i class="icon icon-circle-o"></i>Pharmacy Balance Sheet</a></li>
                  <?php } ?>
                  <?php if(($this->auth->can('all_hospital_user_list'))){?>
                     <li><a href="admin/head_list"><i class="icon icon-circle-o"></i>Add Accounts Head</a>
                     </li>
                  <?php } ?>
                  <?php if(($this->auth->can('all_hospital_user_list'))){?>
                     <li><a href="admin/income_list"><i class="icon icon-circle-o"></i>Add Income</a>
                     </li>
                  <?php } ?>
                  <?php if(($this->auth->can('all_hospital_user_list'))){?>
                     <li><a href="admin/expense_list"><i class="icon icon-circle-o"></i>Add Expense</a>
                     </li>
                  <?php } ?>
               </ul>
            </li>
            <li class="treeview <?php if($active=='Acc_head'){echo 'active';}?>">
               <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Accounts Management<i
                  class="icon icon-angle-left s-18 pull-right"></i></a>
                  <ul class="treeview-menu">
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/head_list"><i class="icon icon-circle-o"></i>Add Accounts Head</a>
                           </li>
                        <?php } ?>
                        <?php if(($this->auth->can('all_hospital_user_list'))){?>

                        <li><a href="admin/income_list"><i class="icon icon-circle-o"></i>Add Income</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/expense_list"><i class="icon icon-circle-o"></i>Add Expense</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/asset_list"><i class="icon icon-circle-o"></i>Add Asset</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/other_asset_report"><i class="icon icon-circle-o"></i>Date Wise Others Asset Report</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/other_expense_report"><i class="icon icon-circle-o"></i>Date Wise Others Expense Report</a>
                        </li>
                     <?php } ?>
                     <?php if(($this->auth->can('all_hospital_user_list'))){?>
                        <li><a href="admin/other_income_report"><i class="icon icon-circle-o"></i>Date Wise Others Income Report</a>
                        </li>
                     <?php } ?>
         <!--  <li><a href="admin/income_due_list"><i class="icon icon-circle-o"></i>Due Income List</a>
            </li>
            
             <li><a href="admin/expense_due_list"><i class="icon icon-circle-o"></i>Due Expense List</a>
             </li> -->
         <!--  <li><a href="admin/paid_income_list"><i class="icon icon-circle-o"></i>Paid Income List</a>
            </li>
            
            <li><a href="admin/paid_expense_list"><i class="icon icon-circle-o"></i>Paid Expense List</a>
            </li> -->
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/date_wise_balance_sheet/acc"><i class="icon icon-circle-o"></i>Date Wise Balance Sheet</a>
               </li>
            <?php } ?>
         <!--  <li><a href="admin/date_wise_due_collection"><i class="icon icon-circle-o"></i>Date Wise Due Collection</a>
         </li> -->
         <!--  <li><a href="admin/date_wise_report"><i class="icon icon-circle-o"></i>Date Wise Report</a>
            </li>
            
            <li><a href="admin/headwise_income_report"><i class="icon icon-circle-o"></i>Headwise Income Report</a>
            </li>
            
            <li><a href="admin/headwise_expense_report"><i class="icon icon-circle-o"></i>Headwise Expense Report</a>
            </li> -->
         <!-- <li><a href="admin/headwise_income_expense_report"><i class="icon icon-circle-o"></i> Inc. & Exp. Summary Report</a>
            </li>
             --><!-- <li><a href="admin/groupwise_report"><i class="icon icon-circle-o"></i> Group Wise Income</a>
             </li> -->
         <!-- <li><a href="admin/opd_collection/1"><i class="icon icon-circle-o"></i>Outdoor Today Collection</a></li>
            <li><a href="admin/opd_collection/2"><i class="icon icon-circle-o"></i>Outdoor Test wise Collection</a></li>
            
                <li><a href="admin/opd_collection/3"><i class="icon icon-circle-o"></i>Outdoor Day wise Collection</a></li>
             <li><a href="admin/ipd_collection_day_wise"><i class="icon icon-circle-o"></i>Indoor Collection Day Wise</a>
            </li> 
            
            <li><a href="admin/ipd_collection_service_wise"><i class="icon icon-circle-o"></i>Indoor Collection Service Wise</a>
            </li> -->
         <!-- <li><a href="admin/ipd_service_wise_patient"><i class="icon icon-circle-o"></i>IPD Patient Service Wise</a>
         </li>   -->
         <?php if(($this->auth->can('all_hospital_user_list'))){?>
            <li><a href="admin/sell_product_list"><i class="icon icon-circle-o"></i>Daywise Sell History</a></li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/purchage_product_list"><i class="icon icon-circle-o"></i>Daywise Purchase History</a></li>
            <?php } ?>
         <!-- <li><a href="admin/outdoor_service_order_list"><i class="icon icon-circle-o"></i>Outdoor Service Collection</a>
         </li>   -->
      </ul>
   </li>
   <li class="treeview">
      <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Indoor Accounts<i
         class="icon icon-angle-left s-18 pull-right"></i></a>
         <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/ipd_collection_day_wise"><i class="icon icon-circle-o"></i>Indoor Day Wise Collection</a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/ipd_collection_service_wise"><i class="icon icon-circle-o"></i>Indoor Service Wise Collection </a>
               </li>
            <?php } ?>
            <?php if(($this->auth->can('all_hospital_user_list'))){?>
               <li><a href="admin/date_wise_balance_sheet/ipd"><i class="icon icon-circle-o"></i>Indoor Balance Sheet</a></li>
            <?php } ?>
         </ul>
      </li>
      <li class="treeview">
         <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Outdoor Accounts<i
            class="icon icon-angle-left s-18 pull-right"></i></a>
            <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/opd_collection/1"><i class="icon icon-circle-o"></i>Outdoor Today Collection</a></li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/opd_collection/2"><i class="icon icon-circle-o"></i>Outdoor Test wise Collection</a></li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/opd_collection/3"><i class="icon icon-circle-o"></i>Outdoor Day wise Collection</a></li>
               <?php } ?>
               <?php if(($this->auth->can('all_hospital_user_list'))){?>
                  <li><a href="admin/date_wise_balance_sheet/opd"><i class="icon icon-circle-o"></i>Outdoor Balance Sheet</a></li>
               <?php } ?>
            </ul>
         </li>
         <li class="treeview">
            <a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Pharmacy Accounts<i
               class="icon icon-angle-left s-18 pull-right"></i></a>
               <ul class="treeview-menu <?php if($active=='opd'||$active=='opd_patient_list'){echo 'menu-open display_block';}?>">
                  <?php if(($this->auth->can('all_hospital_user_list'))){?>
                     <li><a href="admin/doc_wise_collection"><i class="icon icon-circle-o"></i>Daywise Collection By Director/Doctor</a>
                     </li>
                  <?php } ?>
                  <?php if(($this->auth->can('all_hospital_user_list'))){?>
                     <li><a href="admin/date_wise_balance_sheet/phar"><i class="icon icon-circle-o"></i>Pharmacy Balance Sheet</a></li>
                  <?php } ?>
               </ul>
            </li>
   <!--   <li class="treeview <?php if($active=='Acc_head'){echo 'active';}?>"><a href="javascript:void(0)"><i class="icon icon-account_box light-green-text s-18"></i>Manage Share Holder<i
      class="icon icon-angle-left s-18 pull-right"></i></a>
      <ul class="treeview-menu">
      
      
      <li><a href="admin/add_share_holder"><i class="icon icon-circle-o"></i>Add Share Holder</a>
      </li>
      
      <li><a href="admin/share_holder_type"><i class="icon icon-circle-o"></i>Add Share Holder Type</a>
      </li>
      
      </ul>
      </li>
   -->
   <li class="treeview"><a href="logout"><i class="icon icon-account_box light-green-text s-18"></i>Log Out<i
      class="icon icon-angle-left s-18 pull-right"></i></a>
   </li>
</section>