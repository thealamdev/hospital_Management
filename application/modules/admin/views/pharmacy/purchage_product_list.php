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


    <div class="card  no-b">
      <div class="card-body">

        <div class="form-group">
          <a href="admin/purchage_product" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Puchase Product</a>
        </div>

        <form method="POST" action="admin/purchase_product_list_day_wise_report" target="_blank">
         <div class="form-row">
          <div class="form-group col-md-3">
            <label for="inputEmail4" class="col-form-label">Start Date</label>

            <div class="input-group ml-3">
              <input type="text" name="start_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
              data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
              <span class="input-group-append">
                <span class="input-group-text add-on white">
                  <i class="icon-calendar"></i>
                </span>
              </span>
            </div>
          </div>
          <div class="form-group col-md-3">
            <label for="inputEmail4" class="col-form-label">End  Date</label>

            <div class="input-group ml-3">
              <input type="text" name="end_date" id="date_of_birth" class="col-sm-8 date-time-picker form-control date_of_birth"
              data-options='{"timepicker":false, "format":"Y-m-d"}' value="" required="" autocomplete="off" />
              <span class="input-group-append">
                <span class="input-group-text add-on white">
                  <i class="icon-calendar"></i>
                </span>
              </span>
            </div>
          </div>

          <div class="form-group col-md-3"> 
            <label for="inputEmail4" class="col-form-label"></label>
            <label for="inputEmail4" class="col-form-label"></label>
            <div class="input-group ml-3">
              <button type="submit" class="btn btn-success">Submit</button>

            </div>

          </div>

        </div>
      </form> 

      <!-- <div class="card-title">Simple usage</div> -->
      <table id="test_table" class="table table-bordered table-hover data-tables"
      data-options='{ "paging": false; "searching":false}'>
      <thead>
        <tr>
          <th>S.L</th>
          <th>Bill No</th>
          <th>Purchase Code</th>
          <th>Purchase Date</th>
          <th>Suplier Name</th>
          <!-- <th>Expire Date</th> -->
          <!-- <th>Ret. Product</th> -->
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $i=1;
        foreach ($all_purchased_product_list as $key => $value)
          {?>            
            <tr>
              <td><?=$i?></td>

              <td><span class="badge badge-secondary"><?=$value['bill_no'];?></span></td>



              <td><span class="badge badge-secondary"><?=$value['buy_code'];?></span></td>

              <td><span class="badge badge-secondary"><?=date('d-m-Y h:i:s a', strtotime($value['created_at']));?></span></td>

              <td><span class="badge badge-secondary"><?=$value['supp_name'];?></span></td>
              <!-- <td><span class="badge badge-secondary"><?=$value['expire_date'];?></span></td> -->

              <!-- <td><span class="badge badge-secondary"><?=$value['cost_total'];?></span></td> -->

             <!--    <td align="center">
                  <a href="admin/purchage_return/<?=$value['bill_no'];?>" type="button" class="btn btn-primary btn-xs supplier_edit_button">Ret. Product</a></td>
                -->
                <td align="center"><?php
                if($value['cost_total'] <= $value['debit']){?>

                  <span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i></span>

                <?php } 
                else{ ?>

                  <span class="badge badge-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></span>
                <?php }
                ?></td>

                <td align="center">
                  <a href="admin/purchage_product_details/<?=$value['buy_id'];?>" type="button" class="btn btn-success btn-xs supplier_edit_button">View Details</a></td>
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