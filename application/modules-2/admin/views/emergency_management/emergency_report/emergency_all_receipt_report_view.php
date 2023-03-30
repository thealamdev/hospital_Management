
<?php $this->load->view('back/header_link'); ?>
<body class="light">
  <!-- Pre loader -->
  <?php $this->load->view('back/loader'); ?>

  <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>

  <div align="center"><button id="btn_print" onclick="print_page('app')" style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>

  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">

           <div class="row pl-5 pr-5">
             <div class="col-md-2">
              <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>" alt="">  
            </div>      
            <div class="col-md-9">

             <?=$hos_head_report?>
           </div> 
         </div>
           <!-- Table row -->
           <div class="row pl-5 pr-5 my-3">
            <div class="col-12 table-responsive">

              <p style="text-align:center;font-weight:bold"><?php echo date('Y-m-d',strtotime($_GET['start_date'])).' To '.date('Y-m-d',strtotime($_GET['end_date']))?></br>
              </p>

              <table id="test_table" class="table table-bordered table-hover test_table_report"
               >          
                <thead>
                  <tr>
                    <th>S.L</th>
                    <th>Date</th>
                    <th>Emegency No</th>
                    <th>Patient Name</th>
                    <th>Age</th>
                    <th>Contact</th>  
                    <th>Gardian Name</th>          
                    <th>Relation Of Patient</th>            
                    <th>Diagnosis</th>            
                    <th>Service Doctor</th>            
                    <th>Refered Doctor</th>            
                    <th>Department</th>                
                    <th>Doctor Fee</th>            
                    <th>Other Cost</th>            
                    <th>Service Fee</th>            
                    <th style="color:red !important">Discount</th>            
                    <th>Total Amount</th>            

                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  $t_recieved=0;
                  $total_n=0;
                  $t_cost=0;
                  $tt_cost=0;
                  $t_doctor_fee=0;
                  $t_other_cost=0;
                  $t_hospital_amount=0;
                  $t_discount_amount=0;
                  $t_amount=0;
                  $tt_amount=0;
                  foreach ($all_payment as $key => $value)
                  {

                    ?>            
                    <tr>
                      <td><?=$i?></td>
                      <td><?=date('d-m-Y g:i:s A',strtotime($value['created_at']));?></td>
                      <td><?php echo $value['emergency_no']?></td>
                      <td><?php 
					$patient_type = $value['patient_type'];
					if($patient_type == 1){
		                $patient_name = $this->admin_model->anyName_Opd_patient_list('id',$value['patient_name'],'patient_name');
		                $patient_age = $this->admin_model->anyName_Opd_patient_list('id',$value['patient_name'],'age');
		                $mobile_no = $this->admin_model->anyName_Opd_patient_list('id',$value['patient_name'],'mobile_no');
						
		               }else if($patient_type == 2){
		                $patient_name = $this->admin_model->anyName_Ipd_patient_list('id',$value['patient_name'],'patient_name');
		                $mobile_no = $this->admin_model->anyName_Ipd_patient_list('id',$value['patient_name'],'mobile_no');
		                $patient_age="";
						}else{
		                $patient_name = $value['patient_name']; 
		                $mobile_no = "";
		                $patient_age="";
			           }
					   echo $patient_name;
					
					?></td>
                      <td><?php echo  $value['age'];?></td>
                      <td><?php echo $mobile_no?></td>
                      <td><?php echo $value['gardian_name'];?></td>
                      <td><?php echo $value['relation_patient'];?></td>
                      <td><?php echo $value['diagnosis'];?></td>
                      <td><?php echo $this->admin_model->anyName_Doctor_list('doctor_id',$value['service_doctor'],'doctor_title');?></td>
                      <td><?php echo $this->admin_model->anyName_Doctor_list('doctor_id',$value['refered_doctor'],'doctor_title');?></td>
                      <td><?php echo $this->admin_model->anyName_Department_list('id',$value['department'],'dept_name');?></td>
                      
                      <td><?php echo $value['doctor_fee']; $t_doctor_fee += $value['doctor_fee'];?></td>
                      <td><?php echo $value['other_cost']; $t_other_cost += $value['other_cost'];?></td>
                      <td><?php echo $value['hospital_amount']; $t_hospital_amount += $value['hospital_amount'];?></td>
                      <td style="color:red !important"><?php echo $value['discount_amount']; $t_discount_amount += $value['discount_amount'];?></td>
                      <td><?php $t_cost = ($value['doctor_fee']+$value['other_cost']+$value['hospital_amount']); $tt_cost += $t_cost;?>
                      <?php echo $t_amount = ($t_cost - $value['discount_amount']);$tt_amount+=$t_amount;?></td>
                    </tr>
                    <?php 
                    $i++;

                  }?>   
                </tbody>
                <tfoot>
                  <tr >
                    <td colspan="7"></td>
                    <td colspan="5">Total</td>
                   <td>
                     <?php echo $t_doctor_fee?>
                   </td> 
                   <td>
                     <?php echo $t_other_cost?>
                   </td> 
                   <td>
                     <?php echo $t_hospital_amount?>
                   </td> 
                   <td style="color:red !important">
                     <?php echo $t_discount_amount?>
                   </td> 
                   <td>
                     <?php echo $tt_amount?>
                   </td> 
                 </tr>

               </tfoot>


             </table>




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












