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

			<div class="section-wrapper">
				<div class="container">
					<div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">
						<form method="post" action="admin/staff_salary_generay_add_post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<div class="row">
											<label for="staff_id" class="col-sm-4 control-label text-right">Staff
												Name(*)</label>
											<div class="col-sm-8">
												<select class="custom-select select2" name="staff_id" onchange="getAllStaffInfo(this)" name="staff_id">
													<option value="">--Select--</option>
													<?php
														foreach ($staff_list_show as $key => $value)
														{?>


													<option value="<?=$value['staff_id']?>">
														<?=$value['first_name'].' '.$value['last_name']?></option>;

													<?php }

                            								?>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="staff_id"
												class="col-sm-4 control-label text-right">Date(*)</label>
											<div class="col-sm-8">
												<input type="text" placeholder="Date" name="generated_date"
													id="date_of_birth"
													class="date-time-picker form-control date_of_birth"
													data-options='{"timepicker":false, "format":"Y-m-d"}' value=""
													autocomplete="off" required="" />
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group">
										<div class="row">
											<label for="salary_type" class="col-sm-4 control-label text-right">Salary
												Type</label>
											<div class="col-sm-8">
												<select class="custom-select select2" id="salary_type"
													name="salary_type">
													<option value="">--Select--</option>
													<option value="Standard">Standard</option>
													<option value="High">High</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="month" class="col-sm-4 control-label text-right">Staff
												Month(*)</label>
											<div class="col-sm-8">
												<select class="custom-select select2" name="month" for="month">
													<option value="0">--Select--</option>
													<option value="01">January</option>
													<option value="02">February</option>
													<option value="03">March</option>
													<option value="04">April</option>
													<option value="05">May</option>
													<option value="06">June</option>
													<option value="07">July</option>
													<option value="08">August</option>
													<option value="09">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h4>Addition</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<div class="row">
											<label for="basic" class="col-sm-4 control-label text-right">Basic</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" name="basic_salary" id="basic" placeholder="Basic"
													type="text" readonly>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="perdaysalary" class="col-sm-4 control-label text-right">Per Day
												Salary</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" name="perdaysalary" id="perdaysalary"
													placeholder="Per Day Salary" type="text" readonly>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="workingdays"
												class="col-sm-4 control-label text-right">Working Days</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" onkeyup="total_count(this)" name="workingdays" id="workingdays"
													placeholder="Working Days" type="text">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="row">
											<label for="presents"
												class="col-sm-3 control-label text-right">Absent</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" name="absent"  onkeyup="total_count(this)" id="absent"
													placeholder="Absent" type="text">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="late" class="col-sm-3 control-label text-right">Late</label>

											<div class="col-sm-5">
												<input class="form-control" autocomplete="off" name="late" onkeyup="total_count(this)" id="late" placeholder="Late"
													type="text">
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" id="islate" name="islate" value="islate"  onkeyup="total_count(this)"
													class="custom-control-input">
												<label class="custom-control-label m-0" for="islate">is Late?</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="over_time" class="col-sm-3 control-label text-right">Over
												Time</label>
											<div class="col-sm-5">
												<input class="form-control" autocomplete="off" name="over_time" id="over_time" onkeyup="total_count(this)"
													placeholder="Over Time" type="text">
											</div>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input type="checkbox" id="isovertime" name="isovertime"
													value="isovertime" class="custom-control-input">
												<label class="custom-control-label m-0" for="isovertime">is
													Overtime?</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="row">
											<label for="absent_salary" class="col-sm-4 control-label text-right">Absent
												Salary</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" name="absent_salary" id="absent_salary"
													placeholder="Absent Salary" type="text" readonly>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="late_salary" class="col-sm-4 control-label text-right">Late
												Salary</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" name="late_salary" id="late_salary"
													placeholder="Late Salary" type="text" readonly>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<label for="over_time_salary" class="col-sm-4 control-label text-right">Over
												Time Salary</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" name="over_time_salary"
													id="over_time_salary" placeholder="Over Time Salary" type="text" readonly>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<div class="row">
											<label for="presents"
												class="col-sm-4 control-label text-right">Present</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" name="presents" id="presents" readonly
													placeholder="Present" type="text">
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4 show_bank_part">								
									
								</div>
								<div class="col-md-4 show_bank_part">								
									
								</div>
							</div>

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<div class="row">
											<label for="salary_pay_method" class="col-sm-4 control-label text-right">Salary Pay
												Method</label>
											<div class="col-sm-8">
												<select class="custom-select select2" id="salary_pay_method"
													name="salary_pay_method" onchange="change_payment(this)">
													<option value="">--Select--</option>
													<option value="due">Due</option>
													<option value="cash">Cash</option>
													<option value="bank">Bank</option>
													<option value="bkash">Bkash</option>
												</select>
											</div>
										</div>
									</div>
								</div>
									<div class="col-md-4 show_bank_part" id="show_bank_part" style="display:none;">								
										<div class="form-group">
											<div class="row">
												<label for="bank" class="col-sm-4 control-label text-right">Bank Name</label>
												<div class="col-sm-8">
													<input class="form-control" autocomplete="off" name="bank_name"
														id="bank" placeholder="Bank Name" type="text">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-4 show_bank_part" id="show_bank_part" style="display:none;">								
										<div class="form-group">
											<div class="row">
												<label for="cheque_no" class="col-sm-4 control-label text-right">Cheque</label>
												<div class="col-sm-8">
													<input class="form-control" autocomplete="off" name="cheque_no"
														id="cheque_no" placeholder="Cheque" type="text">
												</div>
											</div>
										</div>
									</div>
							</div>
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<div class="row">
											<label for="total_salary" class="col-sm-4 control-label text-right">Total
												Salary</label>
											<div class="col-sm-8">
												<input class="form-control" autocomplete="off" name="t_salary" id="total_salary"
													placeholder="Total Salary" type="text" readonly>
											</div>
										</div>
									</div>
									</div>
								<div class="col-md-5">
									<button type="submit" class="btn btn-success">Submit</button>
								</div>
							</div>
						</form>
					</div>
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
<script type="text/javascript">
var li = "<?=base_url()?>";
function total_count(v){
	var workingdays = 0;
	var latecount = 3;
	var presents = 0;
	var perdaysalary = 0;
	var basic = 0;
	var absent = 0;
	var absentsalary = 0;
	var late = 0;
	var actuallates = 0;
	var latesalary = 0;
	var over_time = 0;
	var over_time_salary = 0;
	var totaldeduct = 0;
	var totaladd = 0;
	var grandTotal = 0;
	var basic=0;
	workingdays = $('#workingdays').val();
	basic = $('#basic').val();
	absent = $('#absent').val();
	perdaysalary = $('#perdaysalary').val();
	presents = (workingdays-absent);
	$('#presents').val(presents);
	absentsalary = (perdaysalary*absent);
	var islate = $('#islate').is(':checked');
	var isovertime = $('#isovertime').is(':checked');
	if(islate == true){
		late = $('#late').val();
		actuallates = (late/latecount).toFixed(2);
		if(actuallates>=1){
			latesalary = (perdaysalary*actuallates).toFixed(2);
		}else{
			latesalary=0;
		}
	}else{
		latesalary=0;
	}
	if(isovertime == true){
		over_time = $('#over_time').val();
		over_time_salary = (perdaysalary*over_time).toFixed(2);
	}else{
		over_time_salary=0;
	}


	totaladd = (parseFloat(basic)+parseFloat(over_time_salary));
	totaldeduct = (parseFloat(absentsalary)+parseFloat(latesalary));
	grandTotal = (parseFloat(totaladd)-parseFloat(totaldeduct)); 

	$('#absent_salary').val(absentsalary);
	$('#late_salary').val(latesalary);
	$('#over_time_salary').val(over_time_salary);
	$('#total_salary').val(Math.round(grandTotal));
}

function change_payment(v){

	var value = $(v).val();

	if(value == 'bank'){
		$('.show_bank_part').show();
	}else{
		$('.show_bank_part').hide();
	}

}
function getAllStaffInfo(id){
	var staffID = $(id).val();
	
	$.ajax({
		type:'POST',
		dataType:'json',		
		url:li+'admin/getStaffList',
		data:{staffID:staffID},
		success:function(data)
		{		
			var workingdays = 26;
			var perdays = (data.staff.total_salary/workingdays);
			$('#basic').val(data.staff.total_salary);
			$('#perdaysalary').val(perdays.toFixed(2));
	
		},
		error:function(jqXHR, textStatus, errorThrown)
		{
			
				if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404] - Click \'OK\'');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error. [500] - Click \'OK\'');
                } else if (errorThrown === 'parsererror') {
                    alert('Requested JSON parse failed - Click \'OK\'');
                } else if (errorThrown === 'timeout') {
                    alert('Time out error - Click \'OK\' and try to re-submit your responses');
                } else if (errorThrown === 'abort') {
                    alert('Ajax request aborted ');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText + ' - Click \'OK\' and try to re-submit your responses');
                }

		}
		});
}
</script>


</body>

</html>
