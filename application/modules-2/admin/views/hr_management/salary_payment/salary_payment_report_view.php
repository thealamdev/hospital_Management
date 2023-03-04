
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

              <p style="text-align:center;font-weight:bold">Month <?php echo date('F, Y',strtotime($months_year))?></br>
              </p>

              <table id="test_table" class="table table-bordered table-hover test_table_report"
               >          
                <thead>
                  <tr>
                    <th>S.L</th>
                    <th>Payment Date</th>
                    <th>Month</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Basic</th>
                    <th>Total Working Days</th>
                    <th>Total Absent</th>
                    <th>Total Late</th>
                    <th>Total Over Time</th>
                    <th>Amount(TK)</th>            
                    <th>Paid/Due</th>            

                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  $total_b=0;
                  $total_n=0;
                  foreach ($all_payment as $key => $value)
                  {

                    ?>            
                    <tr>
                      <td><?=$i?></td>
                      <td><?=date('d-m-Y',strtotime($value['payment_date']));?></td>
                      <td><?=date('F, Y',strtotime($value['month_year']));?></td>
                      <td><?=$this->admin_model->anyName_Staff('staff_id',$value['staff_id'],'first_name').' '.$this->admin_model->anyName_Staff('staff_id',$value['staff_id'],'last_name');?></td>
                      <td><?=$this->admin_model->anyName_Designation('id',$value['designation_id'],'name');?></td>
                      <td class="text-right"><?=$value['basic_salary'];?></td>
                      <td class="text-center"><?=$value['t_working_days'];?> days</td>
                      <td class="text-center"><?=$value['t_absent'];?> days</td>
                      <td class="text-center"><?=$value['t_late'];?> days</td>
                      <td class="text-center"><?=$value['t_overtime'];?> days</td>
                      <td class="text-right"><?=$value['payment_salary'];?></td>
                      <td class="text-center text-nowrap"><?=$value['pay_status'] == 2 ? "Paid" : "UnPaid" ?></td>
                    </tr>
                    <?php 
                    $i++;
                    $total_b+=$value['basic_salary'];
                    $total_n+=$value['payment_salary'];

                  }?>   
                </tbody> 
                <tfoot>
                  <tr >
                    <td colspan="5">Total</td>
                   <td class="text-right">
                     <?php echo $total_b?>
                   </td> 
                    <td colspan="4"></td>
                   <td class="text-right">
                     <?php echo $total_n?>
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












