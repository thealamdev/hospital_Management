<?php $this->load->view('back/header_link'); ?>

<body class="light">
	<!-- Pre loader -->
	<?php $this->load->view('back/loader'); ?>

	<?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>

	<div align="center"><button id="btn_print" onclick="print_page('app')"
			style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>

	<div id="app" style="color:#000;font-weight:bold;">


		<div class="section-wrapper">
			<div class="card my-3 no-b">
				<div class="card-body">
					<div class="container">

						<div class="row pl-5 pr-5">
							<div class="col-md-2">
								<img style="height: 110px;width: 110px;"
									src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>" alt="">
							</div>
							<div class="col-md-9">

								<?=$hos_head_report?>
							</div>
						</div>

						<?php 
            $total_n=0;
            foreach ($emergency_reciept as $key => $value)
            {
				  ?>
						<div class="row pl-5 pr-5 my-3">
							<div class="col-md-12 table-responsive">
								<table id="test_table" class="table table-hover" width="100%">
									<thead>
										<tr>
											<th class="text-left">Emegency ID</th>
											<th class="text-left">:</th>
											<th class="text-left"><?php echo $value['emergency_reciept_id']?></th>
											<th class="text-left">Date Time</th>
											<th class="text-left">:</th>
											<th class="text-left"><?php echo date('d-m-Y g:i:s A',strtotime($value['created_at']))?></th>
										</tr>
										<tr>
											<th class="text-left">Patient Name</th>
											<th class="text-left">:</th>
											<th class="text-left"><?php 
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
												
												?>
											</th>
											<th class="text-left"></th>
											<th class="text-left">Age: <?php echo $value['age'];?> Sex: <?php echo $value['sex'];?></th>

										</tr>
										<tr>
											<th class="text-left">Service Doctor</th>
											<th class="text-left">:</th>
											<th class="text-left">
												<?php echo $this->admin_model->anyName_Doctor_list('doctor_id',$value['service_doctor'],'doctor_title');?>
											</th>
										</tr>
										<tr>
											<th class="text-left">Refered By</th>
											<th class="text-left">:</th>
											<th class="text-left">
												<?php echo $this->admin_model->anyName_Doctor_list('doctor_id',$value['refered_doctor'],'doctor_title');?>
											</th>

											<th class="text-left">Contact No</th>
											<th class="text-left">:</th>
											<th class="text-left"><?php echo $mobile_no?></th>
										</tr>
										<tr>
											<th class="text-left">Gardian Name</th>
											<th class="text-left">:</th>
											<th class="text-left"><?php echo $value['gardian_name'];?></th>
											<th class="text-left">Relation Of Patient</th>
											<th class="text-left">:</th>
											<th class="text-left"><?php echo $value['relation_patient'];?></th>
										</tr>
										<tr>
											<!-- <th class="text-left">Address:</th>
											<th class="text-left">:</th>
											<th class="text-left"></th> -->
											<th class="text-left">Diagnosis</th>
											<th class="text-left">:</th>
											<th class="text-left"><?php echo $value['diagnosis']?></th>

										</tr>
									</thead>


								</table>
							</div>
						</div>
						<!-- Table row -->
						<div class="row pl-5 pr-5 my-3">
							<div class="col-12 table-responsive">
								<p style="text-align:center;font-weight:bold">Emergency Service Reciept</p>

								<table id="test_table" class="table table-bordered table-hover test_table_report">
									<thead>
										<tr>
											<th>Title</th>
											<th>Amount(TK)</th>
										</tr>

										<tr>
											<th>Doctor Fee</th>
											<th><?php echo number_format($value['doctor_fee'], 2, '.', '');?></th>
										</tr>

										<tr>
											<th>Other Cost</th>
											<th><?php echo number_format($value['other_cost'], 2, '.', '');?></th>
										</tr>

										<tr>
											<th>Service Fee</th>
											<th><?php echo number_format($value['hospital_amount'], 2, '.', '');?></th>
										</tr>
										<?php 
                    $total_n = ($value['doctor_fee']+$value['hospital_amount'] + $value['other_cost']);
                    $total_r = ($total_n - $value['discount_amount']);
                  ?>
									</thead>

									<tfoot>
										<tr>
											<td class="text-center">Total Amount
											<td class="text-center">
												<?php echo number_format($total_n, 2, '.', '');?>
											</td>
										</tr>

										<tr>
											<th style="color:red !important">Discount</th>
											<th style="color:red !important">
												<?php echo number_format($value['discount_amount'], 2, '.', '');?></th>
										</tr>
										<tr>
											<td class="text-center">Net Total
											<td class="text-center">
												<?php echo number_format($total_r, 2, '.', '');?>
											</td>
										</tr>

									</tfoot>


								</table>



								<p style="text-align:left;font-weight:bold">Comments: <?php echo $value['comments']?></p>
								<?php }?>
							</div>

						</div>

						<div class="col-xs-12 col-md-12">
							<div class="row">
								<div class="col-xs-5 col-md-5" style="border-top:1px solid black;text-align:center;margin-right:1%">
									Patient Signiture</div>
								<div class="col-xs-5 col-md-5" style="border-top:1px solid black;;text-align:center;margin-left:1%">
									Authority Signiture <?=$value['operator_name']?></div>
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
