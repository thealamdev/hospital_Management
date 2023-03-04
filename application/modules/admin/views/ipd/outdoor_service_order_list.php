<?php $role=$this->session->userdata['logged_in']['role']; ?>

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
    <?php if (isset($message)) {?>
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>

    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <h3>Outdoor Service List</h3><br><br>
         <form class="form-inline" method="POST" action="admin/outdoor_his_details" target="_blank">


           <div class="row">

            <div class="col-md-4">
              <div class="form-group mb-2">                       
                <div class="input-group">
                 <input type="text" required="" placeholder="Start Date" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
                 data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
                 <span class="input-group-append">
                   <span class="input-group-text add-on white">
                     <i class="icon-calendar"></i>
                   </span>
                 </span>
               </div>
             </div>
           </div>
           <div class="col-md-4">
             <div class="form-group mx-sm-3 mb-2">                        
              <div class="input-group">
               <input type="text" required="" placeholder="End Date" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
               data-options='{"timepicker":false, "format":"Y-m-d"}' value=""/>
               <span class="input-group-append">
                 <span class="input-group-text add-on white">
                   <i class="icon-calendar"></i>
                 </span>
               </span>
             </div>
           </div>
         </div>
         <div class="col-md-1">
           <button type="submit" class="btn btn-success mb-2">Search</button>
         </div>
       </div>
     </form>
   </div>
 </div>


  <div class="card my-3 no-b">
    <div class="card-body">

<!--      <div class="form-group">
       <a href="admin/outdoor_service_ipd" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Take Outdoor Service</a>
     </div> -->

     
     <table id="test_table" class="table table-bordered table-hover data-tables"
     data-options='{ "paging": false; "searching":false}'>
     <thead>
      <tr>
        <th>S.L</th>
        <th>Reg No</th>
        <th>Patient Name</th>
        <th>Mobile No</th>
        <!-- <th>Cabin No</th> -->
        <th>Total Amount</th>
        <th>Date</th>  
        <th>Status</th>             
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $i=1;
      foreach ($outdoor_service_info as $key => $value)
        {?>            
          <tr>
            <td><?=$i?></td>

            <td><span class="badge badge-secondary"><?=$value['reg_id'];?></span></td>


            <td><span class="badge badge-secondary"><?=$value['patient_name'];?></span></td>
            <td><span class="badge badge-secondary"><?=$value['mobile_no'];?></span></td>

            <!-- <td><span class="badge badge-secondary"><?=$value['room_title'];?></span></td> -->
            <td><span class="badge badge-secondary"><?=$value['total_amount'];?></span></td>

            <td><span class="badge badge-secondary"><?=$value['created_at'];?></span></td>

            <td align="center"><?php
            if($value['net_total'] <= $value['total_paid']){?>

              <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>

            <?php } 
            else{ ?>

              <span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
            <?php }
            ?></td>

            <td align="center">
              <a href="admin/outdoor_service_details/<?=$value['id']?>" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a>
            </td>
          </tr>

          <?php 
          $i++;
        }?>   
      </tbody>
    </table>
    
</div>
</div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>