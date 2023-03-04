
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
                <th>Trip No</th>
                <th>Ambulance No</th>
                <th>Patient Name</th>
                <th>Age</th>
                <th>Contact</th>      
                <th>Gardian Name</th>      
                <th>Road Name</th>            
                <th>Driver Name</th>            
                <th>Driver Mobile No</th>            
                <th>Total Recieved</th>            
                <th>Total Cost</th>            
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
              $t_amount=0;
              $tt_amount=0;
              foreach ($ambulance_reciept as $key => $value)
              {

                ?>            
                <tr>
                  <td><?=$i?></td>
                  <td><?=date('d-m-Y g:i:s A',strtotime($value['created_at']));?></td>
                  <td><?php echo $value['trip_no']?></td>
                  <td><?php echo $value['ambulance_no'];?></td>
                  <td><?php echo $value['patient_name'];?></td>
                <td><?php echo $value['age'];?></td>
                <td><?php echo $value['patient_mobile_no']?></td>
                <td><?php echo $value['gardian_name']?></td>
                <td><?php echo $value['road_name'];?></td>
                <td><?php echo $value['driver_name'];?></td>
                <td><?php echo $value['driver_mobile_no'];?></td>
                <td><?php echo $value['total_recieve']; $t_recieved += $value['total_recieve'];?></td>
                <td><?php echo $t_cost = ($value['fuel_cost']+$value['road_cost']+$value['service_maintance_cost']); $tt_cost += $t_cost;?></td>
                <td><?php echo $t_amount = ($value['total_recieve'] - $t_cost);$tt_amount+=$t_amount;?></td>
              </tr>
              <?php 
              $i++;

            }?>   
          </tbody>
          <tfoot>
            <tr >
              <td colspan="5"></td>
              <td colspan="6">Total</td>
              <td>
               <?php echo $t_recieved?>
             </td> 
             <td>
               <?php echo $tt_cost?>
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












