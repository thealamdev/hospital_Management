<?php $this->load->view('back/header_link'); ?>
<body class="light">
<style type="text/css">
.ipd_ot_report{}
.ipd_ot_report table{width:100%; border-collapse: collapse;}
.ipd_ot_report table tr{border:solid 1px #000}
.ipd_ot_report table tr th{border:solid 1px #000;font-weight:bold;text-align:center;}
.ipd_ot_report table tr td{border:solid 1px #000;text-align:center;}
</style>
<!-- Pre loader -->
<?php $this->load->view('back/loader'); ?>
 
<?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>

  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="invoice white shadow">
             <div class="row pl-5 pr-5">
               <div class="col-md-3">
                <img style="height: 130px;width: 150px;" src="back_assets/img/dummy/<?=$hos_logo?>" alt="">  
              </div>      
               <div class="col-md-9">

               <?=$hos_head_report?>
            </div> 

          
<div class="col-md-12" style="border-bottom:#000 solid 1px">
</div>

                
            </div>
                  <!-- Table row -->
                
                    <div class="width:100%">
					<p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report of IPD Service Collection Between <?php echo $start_date?> to <?php echo $end_date?> </p>

                    </div>
					<div  style="width:100%" class="ipd_ot_report">
					<table>
					  <tr>
					     <th>Sl</th>
						 <th>Title</th>
						<th>Total</th>
						<th>Price</th>	
                        <th>Amount</th>	
                         <th>Discount</th>						
						<th>Paid Amount</th>
						<th>Due</th>
						<th>Date</th>
						 </tr>
						                           <?php $i=1;
							  $tamnt=0;
							  $tadv=0;
							  $due=0;	   
                            foreach ($ipd_operation_collection as $key => $value) {
								
	
								?>
                                <tr>
                                    <td><?=$i?></td>
									<td><?=$value['service_name']?></td>
                                	<td><?=$value['cnt']?></td>   
									<td><?=$value['service_cost']?></td>  
									<td><?=$value['total']?></td> 
	                                <td><?=$value['discount']?></td>  									
									<td><?=$value['advance']?></td>									
									<td><?=$value['due']?></td>
									<td><?=$value['cdate']?></td>

                                </tr>
                           <?php $i++;
                              
							  $tamnt+=$value['total'];
							  $tadv+=$value['advance'];
							  $due+=$value['due'];
						   }
						   
                          ?>
						 
					</table>
					<?php
					echo "</br>";
					echo "Total Amount : ".$tamnt;
					echo "</br>";
					echo "Total Advance : ".$tadv;
					echo "</br>";
					echo "Total Due : ".$due;
					echo "</br>";
					?>
					</div>
                    <!-- /.col -->
            
                  <!-- /.row -->
            
                  
                  <!-- /.row -->
            
                  <!-- this row will not appear when printing -->
          </div>
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












