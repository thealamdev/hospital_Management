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
      foreach ($staff_details as $key => $value)
      {
        ?>
        <div class="col-md-offset-2  row pl-5 pr-5">              
         <div class="col-md-8">
           <div class="col-md-12 table-responsive">
            <table id="test_table" class="table table-hover" width="50%">
              <thead>
                <tr>
                  <th class="text-left">Name</th>
                  <th class="text-left"><?php echo $value['first_name'].' '.$value['last_name'];?></th>
                </tr>
                <tr>
                  <th class="text-left">Father Name</th>
                  <th class="text-left"><?php echo $value['father_name'];?></th>
                </tr>
                <tr>
                  <th class="text-left">Mother Name</th>
                  <th class="text-left"><?php echo $value['mother_name'];?></th>
                </tr>
                <tr>
                  <th class="text-left">Phone</th>
                  <th class="text-left"><?php echo $value['mobile'];?></th>
                </tr>
                <tr>
                  <th class="text-left">Email</th>
                  <th class="text-left"><?php echo $value['email'];?></th>
                </tr>
                <tr>
                  <th class="text-left">Designation</th>
                  <th class="text-left"><?php echo $this->admin_model->anyName_Designation('id',$value['designation_id'],'name');?></th>
                </tr>
                <tr>
                  <th class="text-left">Blood Group</th>
                  <th class="text-left"><?php echo $value['blood_group'];?></th>     
                </tr>
                <tr>
                  <th class="text-left">NID</th>
                  <th class="text-left"><?php echo $value['nid_no'];?></th>     
                </tr>
                <tr>
                  <th class="text-left">Rate Type</th>
                  <th class="text-left"><?php echo $value['rate_type'];?></th>     
                </tr>
                <tr>
                  <th class="text-left">Salary</th>
                  <th class="text-left"><?php echo $value['total_salary'];?></th>     
                </tr>
                <tr>
                  <th class="text-left">Permanent Address</th>
                  <th class="text-left"><?php echo $value['permanent'];?></th>     
                </tr>
                <tr>
                  <th class="text-left">Present Address</th>
                  <th class="text-left"><?php echo $value['present'];?></th>     
                </tr>

                <tr>
                  <th class="text-left">Group Name</th>
                  <th class="text-left"><?php echo $value['group_name'];?></th>     
                </tr>

                <tr>
                  <th class="text-left">Joining Date</th>
                  <th class="text-left"><?php echo date("d-m-Y", strtotime($value['joining_date']))?></th>     
                </tr>

                <tr>
                  <th class="text-left">Duty Time</th>
                  <th class="text-left"><?php echo date("g:i a", strtotime($value['from_duty_time'])).'-'. date("g:i a", strtotime($value['to_duty_time']))?></th>     
                </tr>


              </thead>

            </table>
          </div>
        </div>
        <div class="col-md-4 text-left">
          <img style="border:2px solid black; height: 100px; width: 100px; max-width: none !important;" src="uploads/staff_images/<?=$value['profile_image'];?>">
        </div>
      </div>
    <?php }?>

    <div style="float: left;">
     <div style="width: 200px; border:1px solid black; margin-top: 62px;margin-left: 70px;"></div>
     <table style="color: black; font-size: 18px;width: 180px;margin-left: 70px;">
      <tr>
        <td style="font-weight: normal;">Authorized Sig:</td>
      </tr>
    </table>
  </div>

  <div style="float: left;">
   <div style="width: 200px; border:1px solid black; margin-top: 62px; margin-left: 170px;"></div>
   <table style="color: black; font-size: 18px; margin-left: 170px;width: 180px;">
    <tr>
      <td colspan="2" style="font-weight: normal;">Managing Director:</td>
    </tr>
  </table>
</div>

<div style="float: left;">
 <div style="width: 200px; border:1px solid black; margin-top: 62px; margin-left: 170px;"></div>
 <table style="color: black; font-size: 18px; margin-left: 170px;width: 180px;">
  <tr>
    <td colspan="2" style="font-weight: normal;">Chairman:</td>
  </tr>
</table>
</div>

</div>
</div>
</div>
</div>


</div>

<?php $this->load->view('back/footer_link');?>




</body>

</html>
