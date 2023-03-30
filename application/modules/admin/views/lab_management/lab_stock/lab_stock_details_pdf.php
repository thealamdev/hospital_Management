<?php $this->load->view('back/header_link'); ?>
<body class="light">
<!-- Pre loader -->
<?php $this->load->view('back/loader'); ?>
 
<div id="app">
   
      <div class="section-wrapper">
          <div class="card no-b">
            <div class="card-body">
             
            <div class="row">
              <div class="col-md-10 offset-md-1">
                  <img class="mb-4" style="height:140px; width: 100%;" src="uploads/hospital_logo/<?=$this->session->userdata['logged_in']['hospital_logo']?>" alt="">
              </div>
              <div class="col-md-10

               offset-md-1">
                  
    <table class="table table-striped table-bordered table-hover sell_cart">
      <thead>
        <tr>
        <th>S.L</th>
        <th>Date</th>
        <th>Product Name</th>
        <th>Product Code</th>
        <!-- <th>Total</th> -->
        <th>Opening Stock</th>
        <th>Purchage</th>
        <th>Sale</th>
        
        <th>Closing Stock</th>
      </tr>
        <!-- <th>Remain</th> -->
      </thead>
      <tbody class="mytable_style" >
      
        <tr>
          <?php foreach ($stock_details as $key => $row) { ?>
            
          <td><?=$key+1;?></td>
          <td><?=date('d M Y', strtotime($row['st_date']));?></td>
          <td><?=$row['p_name'];?></td>
          <td><?=$row['p_code'];?></td>
          <!-- <td><?=$row['total'];?></td> -->
          <td><?=$row['stock_open'];?></td>
          <td><?=$row['stock_in'];?></td>
          <td><?=$row['stock_out'];?></td>
          
          <td><?=$row['stock_close'];?></td>
          <!-- <td><?=$row['remain'];?></td> -->
        </tr>
        <?php } ?>
        
        
    </tbody>                    
  </table>
  </div>
              </div>
            </div><!-- /.row --> 
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












