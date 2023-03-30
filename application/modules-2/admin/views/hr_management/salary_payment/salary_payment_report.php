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
						<form method="GET" action="admin/all_staff_salary_payment_report_view" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<div class="row">
											<label for="staff_id" class="col-sm-4 control-label text-right">Staff
												Name(*)</label>
											<div class="col-sm-8">
												<select class="custom-select select2"  name="staff_id">
													<option value="0">--All--</option>
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
								<div class="col-md-12 text-center">
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
<script>
var li = "http://localhost/hospital/";

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
	$('#total_salary').val(grandTotal);
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
