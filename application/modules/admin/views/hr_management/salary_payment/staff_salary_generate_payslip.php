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
									src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>"
									alt="">
							</div>
							<div class="col-md-9">

								<?=$hos_head_report?>
							</div>
						</div>

						<!-- Table row -->
						<div class="row pl-5 pr-5 my-3">
							<div class="col-12 table-responsive">
								<p style="text-align:center;font-weight:bold">Pay Slip</p>

								<table id="test_table" class="table table-bordered table-hover test_table_report">
									<thead>
										<tr>
											<th class="text-left">Employee Name</br>Designation
											</th>
											<th class="text-left"><?php echo $this->admin_model->anyName_Staff('staff_id',$staff_id,'first_name').' '.$this->admin_model->anyName_Staff('staff_id',$staff_id,'last_name');?></br><?php echo $this->admin_model->anyName_Designation('id',$designation_id,'name');?>
											</th>
											<th class="text-left">Date Month</th>
											<th class="text-left"><?php echo  date('F Y',strtotime($month_year));?></th>
										</tr>

										<tr>
											<th class="text-left">
												Basic</br>
												Per Day Salary</br>
												Present</br>
												Absent</br>
												Absent Salary</br>
											</th>
											<th class="text-left">
												<?php echo number_format($basic_salary, 2, '.', '');?>/=<br />
												<?php echo number_format($perdaysalary, 2, '.', '');?>/=<br />
												<?php echo $t_presents;?> days</br>
												<?php echo $t_absent;?> days<br />
												<?php echo number_format($t_absent_amount, 2, '.', '');?>/=<br />
											</th>
											<th class="text-left">
												Late</br>
												Late Salary</br>
												Over Time</br>
												Over Time Salary</br>
											</th>
											<th class="text-left">
												<?php echo $t_late;?> days</br>
												<?php echo number_format($t_late_amount, 2, '.', '');?>/=<br />
												<?php echo $t_overtime;?> days</br>
												<?php echo number_format($t_overtime_amount, 2, '.', '');?>/=<br />
											</th>
										</tr>

									</thead>

									<tfoot>

										<tr>
											<th class="text-left">Total</th>
											<th style="color:red;"><?php echo number_format($payment_salary, 2, '.', '')?>/= 

												<?php if($payment_type !='' && $payment_type == 'bank'){echo 'Bank Name: '.$bank_name.' Cheque No: '.$cheque_no;}else if($payment_type !='' && $payment_type == 'bkash'){echo "Bkash";}else if($payment_type !='' && $payment_type == 'cash'){ echo "Cash";}?></th>
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
