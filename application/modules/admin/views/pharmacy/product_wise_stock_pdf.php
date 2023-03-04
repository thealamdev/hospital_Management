<?php $this->load->view('back/header_link'); ?>
<body class="light">

 <!-- Pre loader -->
 <?php $this->load->view('back/loader'); ?>
 <?php 
 $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
 $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
 ?> 
 <div align="center"><button id="btn_print" onclick="print_page('app')" style="width: 80px;height: 50px;background-color: #759ddd; margin:0px">Print</button></div>


 <div id="app" style="color:#000;">
  <div class="section-wrapper">
    <div class="card my-3 no-b">
      <div class="card-body">
        <div class="container">

         <div class="row pl-5 pr-5">
           <div class="col-md-2">
            <img style="height: 110px;width: 110px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
          </div>      
          <div class="col-md-9">

           <?=$hos_head_report?>
         </div> 
         <div class="col-md-12" style="border-bottom:#000 solid 1px"></div>
       </div>

       <table class="table table-striped table-bordered table-hover test_table_report">
        <thead>
          <tr>
            <th>S.L</th>
            <!-- <th>Date</th> -->
            <th>Product Name</th>
            <th>Product Code</th>
            <th>Batch</th>
				    <th>Expire</th>
            <!-- <th>Total</th> -->
            <th>Current Stock</th>
          </tr>
          <!-- <th>Remain</th> -->
        </thead>
        <tbody>

          <tr>
            <?php foreach ($stock_details as $key => $row) { ?>

              <td><?=$key+1;?></td>
              <!-- <td><?=date('d M Y', strtotime($row['created_at']));?></td> -->
              <td><?=$row['p_name'];?></td>
              <td><?=$row['p_code'];?></td>
              <!-- <td><?=$row['total'];?></td> -->
              <td><?=$row['batch_id'];?></td>
					    <td><?=date('d-m-Y', strtotime($row['expire_date']));?></td>
              <td><?=$row['current_stock'];?></td>

              <!-- <td><?=$row['remain'];?></td> -->
            </tr>
          <?php } ?>


        </tbody>                    
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












