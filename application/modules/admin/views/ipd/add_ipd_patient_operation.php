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
  <script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","admin/search_ipd_patient/"+str,true);
        xmlhttp.send();
    }
}
</script>
  <script>
function showoperation(str) {
    if (str == "") {
        document.getElementById("operation_cost").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("operation_cost").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","admin/search_operation_cost/"+str,true);
        xmlhttp.send();
    }
}
</script>
<script type="text/javascript">

function sum() {
      var Operation_cost = document.getElementById('operation_cost').value;
      var discount_operation = document.getElementById('discount_operation').value;
      var result = parseInt(Operation_cost) - parseInt(discount_operation);
      if (!isNaN(result)) {
         document.getElementById('total_operation').value = result;
      }
}
function sum_n() {
      var total_operation = document.getElementById('total_operation').value;
      var advance = document.getElementById('advance').value;
      var due = parseInt(total_operation) - parseInt(advance);
      if (!isNaN(due)) {
         document.getElementById('due').value = due;
      }
}
</script>
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
                                  <?php if($this->session->userdata('scc_alt')){ ?>
                            <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                <a href="javascript:;" class="alert-link"><?=$this->session->userdata('scc_alt');?></a>
                            </div>
                            <?php } $this->session->unset_userdata('scc_alt');?>    
   <?php if (isset($message)) {?>
    <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
  <?php echo validation_errors(); ?>         
        <div class="section-wrapper">
      <div class="container">
      <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">
	          <form method="post" action="admin/operation_entry">
          <div class="row">
                  <input type="hidden" value="<?php echo $username;?>" name="user_id"/>
				   <input type="hidden" value="<?php echo $hospital_id?>" name="hospital_id"/>
            <div class="col-md-4">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Patient ID</label>
               <div class="col-sm-10">
	<input class="form-control form-control-sm" onkeyup="showUser(this.value)"  type="text" name="patient_id" placeholder="Patient ID" required>		   
                
               </div>
            </div>   
              <div class="form-group">
                 <label for="email" class="col-sm-12 control-label">Operation Title</label>
                 <div class="col-sm-10">
                    				    <select class="custom-select select2" name="operation_id" onchange="showoperation(this.value)">
                        <option value="0">Select Operation Title</option>
						<?php
						 foreach ($operation_list as $key => $value1)
						 { ?>
								
						<option value="<?=$value1['id']?>"><?=$value1['operation_name']?></option>
														
						<?php } 
						
						?>
                    </select>
                 </div>
            </div>

            <div class="form-group">
                 <label for="mobile_no" class="col-sm-12 control-label">
									Ref. Doctor Name <a href="admin/add_doc/1" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;" style="font-size:10px"> (ADD NEW)</a></label>
                 <div class="col-sm-10">
                    				    <select class="custom-select select2" name="ref_doc_name">
                        <option value="0">Select Doctor Title</option>
						<?php
						 foreach ($doctor_list as $key => $value)
						 {
								$doctor_id=$value['doctor_id'];
								$doctor_type=$value['doctor_type'];
								$doctor_title=$value['doctor_title'];
								$doctor_degree=$value['doctor_degree'];
								if($doctor_type==1)
								{
								
						echo "<option value='$doctor_title'>$doctor_title ($doctor_degree)</option>";
								}						
						 }
						
						?>
                    </select>
                 </div>
            </div>
            <div class="form-group">
                 <label for="mobile_no" class="col-sm-12 control-label">
									Q/C Doctor Name <a href="admin/add_doc/2" onclick="window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;" style="font-size:10px"> (ADD NEW)</a></label>
                 <div class="col-sm-10">
                    				    <select class="custom-select select2" name="ref_doc_name_q">
                        <option value="0">Select Doctor Title</option>
<?php
						 foreach ($doctor_list as $key => $value)
						 {
								$doctor_id=$value['doctor_id'];
								$doctor_type=$value['doctor_type'];
								$doctor_title=$value['doctor_title'];
								$doctor_degree=$value['doctor_degree'];
								if($doctor_type==2)
								{
								
						echo "<option value='$doctor_title'>$doctor_title ($doctor_degree)</option>";
								}						
						 }
						
						?>
                    </select>
                 </div>
            </div>
<!---below for patient details-->
        
              
			
<!--upper for patient details-->							
  



          </div>
		   <div class="col-md-4">
		     <div id="txtHint"></div>
		   </div>
		    <div class="col-md-4"><div id="operation_cost"></div>
			
			 
			</div>
        </div>
		 </form>
		<div class="row">
		 <div class="col-md-12">
		         <table id="test_table" class="table table-bordered table-hover data-tables"
                       data-options='{ "paging": false; "searching":false}'>
                    <thead>
                    <tr>
                        <th>SL NO</th>
						<th>Patient ID</th>
						<th>Operation Title</th> 
						<th>Ref. Doc. Name</th>
						<th>Ref.Q/C Doc. Name</th> 	 						
						<th>Price</th> 
						<th>Paid</th>
						<th>Due</th>
						<th>Operation Date</th>	
						<th>Action</th>						
						
                    </tr>
                    </thead>
                    <tbody>
		
                          <?php $i=1;
                            foreach ($operation_patient_list as $key => $value) {
								
	
								?>
                                <tr>
                                    <td><?=$i?></td>
									<td><?=$value['patient_info_id']?></td>
                                	<td><?=$value['operation_title']?></td>   
									<td><?=$value['ref_doc_name']?></td>  
									<td><?=$value['ref_doc_name_q']?></td>  
									<td><?=$value['operation_cost']?></td>
									<td><?=$value['advance']?></td>
									<td><?=$value['due']?></td>
									<td><?=$value['created_at']?></td>
									<td>
									<?php
									$due=$value['due'];
									$id=$value['opid'];
									$ptid=$value['patient_info_id'];
									$pat_mmid=$value['patient_id'];
									if($due<=0)
									{
									echo "<span style='color:green;font-weight:bold'>Paid</span>";	
									}
									else
									{
		echo "<a href='admin/operation_due_collection/$id/$ptid/$pat_mmid/1'><button type='submit' class='btn btn-success'>Collect Due</button></a>";				
									}
									echo "</br>";
									
									
							echo "<a href='' onclick='window.open(this.href, 'windowName', 'width=1000, height=700, left=24, top=24, scrollbars, resizable'); return false;'><span style='color:red;font-weight:bold'>Print</span></a>";	
									?>
									</td>
                                </tr>
                           <?php $i++; }
                          ?>
                     </tbody>
                    </table>
		 
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




</body>
</html>