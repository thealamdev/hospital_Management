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
          <div class="card  no-b">
            <div class="card-body">
              <!-- <div class="form-group">
                 <a href="admin/purchage_product" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Puchage Product</a>
                </div> -->
                <!-- <div class="card-title">Simple usage</div> -->
                <table id="test_table" class="table test_table_report"
                       >
                    <thead>
                    <tr>
                        <th>S.L</th>
                            <th>Bill No</th>
                             <th>Purchage Code</th>
                            <th>Purchage Date</th>
                            <th>Supplier Name</th>
                            <th>Bill Amount</th>
                            <th>Unload Cost</th>
                            <th>Net Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <!-- <th>Status</th> -->
                            <th>Action</th>
                            <th>User</th>
                    </tr>
                    </thead>

                    </table>
                </div>
            </div>
  </div>
  </div> 
  <div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>


<script type="text/javascript" language="javascript" >  
 $(document).ready(function(){ 

  var dataTable = $('#test_table').DataTable({  
   "processing":true,  
   "serverSide":true,  
   "order":[],  
   "ajax":{  
    url:"<?php echo base_url()?>"+'admin/full_paid_supp_dt/',  
    type:"POST"
  },  
  "columnDefs":[  
  {  
    "targets":[],  
    "orderable":false,  
  },  
  ],  
});  
});  
</script> 