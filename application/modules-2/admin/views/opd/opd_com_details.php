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
        								            <?php if ($this->session->flashdata('Successfully')): ?>
                            <script>
                                swal({
                                    title: "Done",
                                    text: "<?php echo $this->session->flashdata('Successfully'); ?>",
                                    timer: 1500,
                                    showConfirmButton: false,
                                    type: 'success'
                                });
                            </script>
                    <?php endif; ?>


            <div class="card my-3 no-b">
            <div class="card-body">
               
         <table id="test_table" class="table table-bordered table-hover data-tables  test_table_report"
                       data-options='{ "paging": false; "searching":false}'>
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Doctor Name</th>
						<th>Patient Name</th>
                        <th>Service Type</th>
                        <th>Service Title</th>
                        <th>Service Charge</th>
						<th>Commission</th>

                    </tr>
                    </thead>
                    <tbody>
					<?php
					$i=1;
		
					foreach($comm_details as $key => $value1)
					{
						?>
					<tr>
					   <td><?=$i++?></td>
					   <td><?=$value1['doc_title']?></td>
					   <td><?=$value1['patient_name']?></td>
					   <td><?php
					   $srtype=$value1['service_type'];
					   if($srtype==1)
					   {
						   $t="OPD";
					   }
					  echo $t?></td>
					   <td><?=$value1['sub_test_title']?></td>
					   <td><?=$value1['price']?></td>
					   <td><?=$value1['com_amnt']?></td>

					   
					</tr>	
						<?php
						
					}
					
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