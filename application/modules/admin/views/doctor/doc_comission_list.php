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



            <div class="card my-3 no-b">
            <div class="card-body">
              
         <table id="test_table" class="table table-bordered table-hover data-tables"
                       data-options='{ "paging": false; "searching":false}'>
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Doc Name</th>
                        <th>Group Name</th>                                         
					    <th>Test Title</th>
						<th>Commission</th>
						<th>Delete</th>
					
                    </tr>
                    </thead>
                    <tbody>
		
                          <?php 
						  $i=1;
                            foreach ($comission_list as $key => $value) {
								$doc_com_id=$value['doc_com_id'];
								$doc_id=$value['doc_id'];
								$testid=$value['testid'];
								$sub_test_title=$value['sub_test_title'];
								if($testid==0)
								{
									$dt="All";
								}
								elseif($testid=="NULL")
								{
									$testid=0;
									$dt="All";
								}
								else
								{
									$dt=$sub_test_title;
								}
								?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><?=$value['doctor_title']?></td>
                                    <td><?=$value['test_title']?></td>
									
                                    <td><?php echo $dt?></td>
<?php if($value['com_type']==1){?>
 <td><?=$value['doc_comission']?>%</td>

 <?php } else if($value['com_type']==2){?>
<td><?=$value['doc_comission']?>৳</td>

  <?php }else{?>

<td><?=$value['doc_comission']?>৳</td>
  <?php } ?>
<td><a href="admin/comission_cancel/<?php echo $doc_id?>/<?php echo $doc_com_id?>/<?php echo $testid?>">Delete</a></td>

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