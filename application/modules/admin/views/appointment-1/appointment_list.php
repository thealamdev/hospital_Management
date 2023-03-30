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
         <form method="POST" action="admin/appointment_list_datewise_report" target="_blank">
           <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputEmail4" class="col-form-label">Start Date</label>
              
              <div class="input-group ml-3">
                <input type="text" name="start_date" id="date_of_birth" autocomplete="off" class="col-sm-8 date-time-picker form-control date_of_birth"
                data-options='{"timepicker":false, "format":"Y-m-d"}' required="" value=""/>
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
                data-options='{"timepicker":false, "format":"Y-m-d"}' required="" value=""/>
                <span class="input-group-append">
                  <span class="input-group-text add-on white">
                    <i class="icon-calendar"></i>
                  </span>
                </span>
              </div>
            </div>
            <div class="form-group col-md-3">

             <label for="inputEmail4" class="col-form-label">Doctor List</label>
             <select class="custom-select select2" name="doc_name">
              <option value="0">All</option>
              <?php foreach ($doc_info as $key => $value) { ?>

                <option value="<?=$value['doctor_id']?>"><?=$value['doctor_title']?></option>

              <?php } ?>  

            </select> 
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
  <!--        <div class="form-group">
           <a href="admin/add_appointment" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Appointment</a>
         </div> -->

         <h2 style="text-align: center;">Todays Appointment List</h2><br>

         <table class="table table-bordered test_table_report" id="test_table">
           <thead>
            <tr>
              <th>S.L</th>
              <th>Appointment Date & Time</th>
              <th>Appointment Id</th>
              <th>Serial</th>
              <th>Doctor</th>
              <th>Patient Name</th>
              <th>Ref By</th>
              <th>Patient Type</th>
              <th>Mobile</th>
              <th>Total Amount</th>
              <th>Discount</th>
              <th>Net Amount</th>
              <th>Paid Amount</th>
              <th>Due</th>
              <th>Date</th>
              <th>Details</th>
              <th>Print</th>
              <th>Presc. Print</th>
              <th>Add Presc.</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>
            <?php 

            $total_amount=0;
            $due=0;
            $total_paid=0;
            $net_amount=0;
            $discount=0;

            foreach ($appointment_info as $key => $value) { 


              $total_amount+=$value['total_amount'];
              $due+=$value['net_amount']-$value['total_paid'];
              $total_paid+=$value['total_paid'];
              $net_amount+=$value['net_amount'];
              $discount+=$value['discount'];


              ?>
              <tr>
                <td><?=$key+1?></td>
                <td><?=$value['schedule_day'].', '.date('d-m-Y', strtotime($value['appointment_date'])).' '.date('h:i a', strtotime($value['appointment_time']))?></td>
                <td><?=$value['appointment_gen_id']?></td>
                <td><?=$value['serial_no']?></td>
                <td><?=$value['doc_name']?> (<?=$value['doc_designation']?>)</td>
                <td><?=$value['patient_name']?></td>
                <td><?=$value['ref_doc_name']?></td>
                <td><?=$value['patient_type']?></td>
                <td><?=$value['mobile_no']?></td>
                <td><?=$value['total_amount']?></td>
                <td><?=$value['discount']?></td>
                <td><?=$value['net_amount']?></td>
                <td><?=$value['total_paid']?></td>
                <td><?=$value['net_amount']-$value['total_paid']?></td>
                <td><?=date("d-m-Y", strtotime($value['created_at']))?></td>
                <td><a href="admin/appointment_pay_details/<?=$value['id']?>"class="btn btn-primary btn-xs">Details</a></td>
                <td><a href="admin/appointment_receipt/<?=$value['id']?>" class="btn btn-primary btn-xs">Print</a></td>
                <td><a href="admin/add_appointment_prescription/<?=$value['id']?>" class="btn btn-primary btn-xs">Add Presc.</a></td>
                <td><a href="admin/appointment_prescription/<?=$value['id']?>" class="btn btn-primary btn-xs">Presc.</a></td>
                <td><button type="button" data-id="<?=$value['id']?>" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
              </tr>
            <?php  } ?>
          </tbody>

          <tfoot>
            <tr>
              <td colspan="9"></td>
              <td colspan=""><?=$total_amount?></td>
              <td colspan=""><?=$discount?></td>
              <td colspan=""><?=$net_amount?></td>
              <td colspan=""><?=$total_paid?></td>
              <td colspan=""><?=$due?></td>
            </tr>
          </tfoot>

        </table>
      </div>
    </div>
  </div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>

<script type="text/javascript">

  $(document).on('click','.delete_button', function(event)
  {

    var appointment_id=$(this).data('id');

    alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
      function()
      {
        $.ajax({  

          url:"<?=site_url('admin/delete_appointment')?>",  
          method:"POST",  
          data:{appointment_id:appointment_id},
          dataType:"json",  
          success:function(data)  
          { 

            $("#delete_button_modal").notify
            (
              "Successfully Deleted","success", 
              { position:"bottom" }

              );

            setTimeout( my_fun_delete, 500 );
          },
          error: function (e) {

            $("#delete_button_modal").notify
            (
              "Failed", 
              { position:"bottom" }
              );
            setTimeout( my_fun_delete, 500 );
          }   
        });

      },
      function()
      {

      });
  });


  function my_fun_delete() {

   window.location="admin/appointment_list";
 }

</script>

<!-- <script type="text/javascript" language="javascript" >  
 $(document).ready(function(){ 

  var dataTable = $('#test_table').DataTable({  
   "processing":true,  
   "paging":false,  
   "serverSide":true,  
   "order":[],  
   "ajax":{  
    url:"<?php echo base_url()?>"+'admin/appointment_list_dt/',  
    type:"POST"
  },  
  "columnDefs":[  
  {  
    "targets":[3,4],  
    "orderable":false,  
  },  
  ],  
});  
});  
</script>   -->