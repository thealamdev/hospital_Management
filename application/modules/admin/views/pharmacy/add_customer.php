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
    <!-- Add Customer Modal -->
    <form method="post" action="admin/add_customer" id="add_form">
     <div class="modal fade" id="add_customer_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" value="3" name="hidden_field" id="hidden_field">

            <div class="md-form mb-2">
              <i class="fa fa-medkit" aria-hidden="true"></i>
              <label data-error="wrong" data-success="right" for="customer_phone">Director Ref</label>

              <select class="custom-select select2 form-control" name="ref_dir_id" id="ref_dir_id" required>
                <option value="0#self">self</option>
                <!-- <option value="all">All</option> -->

                <?php 
                foreach ($director_list as $key => $value) { ?>
                 <option value="<?=$value['id']?>#<?=$value['director_name']?>"><?=$value['director_name']?></option>
               <?php }
               ?>
             </select>
           </div>



           <div class="md-form mb-2">
            <i class="fa fa-medkit" aria-hidden="true"></i>
            <label data-error="wrong" data-success="right" for="customer_phone">Customer Phone</label>
            <input type="text" name="customer_phone" id="customer_phone" required class="form-control validate">
          </div>

          <div class="md-form mb-2">
            <i class="fa fa-h-square" aria-hidden="true"></i>
            <label data-error="wrong" data-success="right" for="customer_name">Customer Name</label>

            <input type="text" id="customer_name" name="customer_name" required class="form-control validate">


          </div>
          <div class="md-form mb-2">
            <i class="fa fa-medkit" aria-hidden="true"></i>
            <label data-error="wrong" data-success="right" for="customer_address">Customer Address</label>
            <input type="text" id="customer_address" name="customer_address" required class="form-control validate">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-outline-primary btn-sm"  id="add_customer_name_button">Add<i class="fa fa-plus ml-1"></i></button>

          <button type="button" class="btn btn-outline-danger btn-sm" id="add_customer_modal_close" data-toggle="modal" data-target="#add_customer_modal" data-dismiss="modal" onclick="my_function()">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
        </div>
      </div>
    </div>
  </div>
</form>
<!-- Add Customer Modal End -->


<!-- Edit Customer Modal -->

<div class="modal fade" id="edit_customer_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" value="3" name="update_hidden_field" id="update_hidden_field">

        <input type="hidden" name="" id="update_cust_id">
        
     <!--    <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" value="1" id="up_opd_patient" onclick="pass_radio_val()" name="up_optradio">opd patient
          </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input type="radio" class="form-check-input" value="2" onclick="pass_radio_val()" id="up_ipd_patient" name="up_optradio">ipd patient
          </label>
        </div>
        <div class="form-check-inline">
          <label class="form-check-label">
            <input  type="radio" class="form-check-input mb-4" value="3" onclick="pass_radio_val()" id="up_others" name="up_optradio">others
          </label>
        </div>
      -->

      <div class="md-form mb-2">
        <i class="fa fa-medkit" aria-hidden="true"></i>
        <label data-error="wrong" data-success="right" for="up_ref_dir_id">Director Ref</label>

        <select class="custom-select select2 form-control" name="up_ref_dir_id" id="up_ref_dir_id" required>
          <option value="0">self</option>
          <!-- <option value="all">All</option> -->

          <?php 
          foreach ($director_list as $key => $value) { 
            ?>
            <option value="<?=$value['id']?>"><?=$value['director_name']?></option>
          <?php }
          ?>
        </select>
      </div>



      <div class="md-form mb-2">
        <i class="fa fa-medkit" aria-hidden="true"></i>
        <label data-error="wrong" data-success="right" for="update_customer_phone">Customer Phone</label>
        <input type="text" name="update_customer_phone" id="update_customer_phone" class="form-control validate">
      </div>

      <div class="md-form mb-2">
        <i class="fa fa-h-square" aria-hidden="true"></i>
        <label data-error="wrong" data-success="right" for="update_customer_name">Customer Name</label>

        <input type="text" id="update_customer_name" name="update_customer_name" class="form-control validate">


      </div>
      <div class="md-form mb-2">
        <i class="fa fa-medkit" aria-hidden="true"></i>
        <label data-error="wrong" data-success="right" for="update_customer_address">Customer Address</label>
        <input type="text" id="update_customer_address" name="update_customer_address" class="form-control validate">
      </div>
    </div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-outline-primary btn-sm"  id="update_customer_name_button">Update<i class="fa fa-plus ml-1"></i></button>
      <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
    </div>
  </div>
</div>
</div>

<!-- Edit Customer Modal End -->

<div class="section-wrapper">
  <div class="form-group ml-4 mt-4">
   <button type="button" id="edit_customer_modal" data-toggle="modal" data-target="#add_customer_modal" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Customer</button>
 </div>
 <div class="card my-3 no-b">
  <div class="card-body">
    <!-- <div class="card-title">Simple usage</div> -->
    <table id="test_table" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>SL NO</th>
          <th>Customer Id</th>
          <th>Customer Name</th>
          <th>Customer Phone</th>
          <th>Customer Address</th>
          <th>Director Name</th>
          <th>Type</th>
          <!-- <th>ID</th> -->
          <th>Det</th>
          <th style="width:10%;">Action</th>
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
<script type="text/javascript">
  $(document).ready(function()
  {


    $('#add_customer_modal').on('hidden.bs.modal', function () {

      $(this).find('form').trigger('reset');

    })

    $(document).on('click','.customer_edit_button', function(event)
    {
      $('#edit_customer_modal').modal('show');

      var row_id = $(this).attr("id");
      var cust_id=row_id.replace('customer_edit_','');
      $('#update_cust_id').val(cust_id);



      $.ajax({  

        url:"<?=site_url('admin/get_specific_customer_details')?>",  
        method:"POST", 
        data:{cust_id:cust_id},  
        dataType:"json",  
        success:function(data)  
        {
          $("#update_customer_name").val(data['cust_info'][0]["cust_name"]); 
          $("#update_customer_address").val(data['cust_info'][0]["cust_address"]); 
          $("#update_customer_phone").val(data['cust_info'][0]["cust_phone"]);


          $("#up_ref_dir_id").empty();
          $("#up_ref_dir_id").append('<option selected value="0">self</option>');

          $.each(data['director_info'], function (key, value) 
          {

            if(data['cust_info'][0]["ref_dir_id"]==value['id'])
            {
              $("#up_ref_dir_id").append('<option selected value="' + value.id + '">' + value.director_name + '</option>');
            }
            else
            {
              $("#up_ref_dir_id").append('<option value="' + value.id + '">' + value.director_name + '</option>');
            }

          });

          if(data['cust_info'][0]["type"]=="1")
          {
            $('#up_opd_patient').attr('checked', true);

          }
          else if(data['cust_info'][0]["type"]=="2")
          {
            $('#up_ipd_patient').attr('checked', true);
          }
          else
          {
            $('#up_others').attr('checked', true);
          }

        }

      });
    });

    $(document).on('click','#update_customer_name_button', function(event)
    {
     var cust_id = $('#update_cust_id').val();

     // var type_id=document.querySelector('input[name="up_optradio"]:checked').value;
     var cust_phone=$('#update_customer_phone').val();
     var cust_address=$('#update_customer_address').val();
     var cust_name=$('#update_customer_name').val();

     var dir_id=$('#up_ref_dir_id option:selected').val();
     var dir_name=$('#up_ref_dir_id option:selected').text();

       // alert(type_id);

       $.ajax({  

        url:"<?=site_url('admin/update_customer')?>",  
        method:"POST",
        data:{cust_id:cust_id,cust_phone:cust_phone,cust_address:cust_address,cust_name:cust_name,dir_id:dir_id,dir_name:dir_name},  
        dataType:"json",  
        success:function(data)  
        { 
         $("#update_customer_name_button").notify
         (
          "Successfully Updated","success", 
          { position:"bottom" }

          );

         setTimeout( my_fun_update, 2000 );

       },
       error: function (e) {
       }   
     });


     });

   // *********************** Delete Test *******************


   $(document).on('click','.customer_delete_button', function(event)
   {
     var row_id = $(this).attr("id");
     var cust_id=row_id.replace('customer_delete_','');

     alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
      function()
      {
        $.ajax({  

          url:"<?=site_url('admin/delete_customer')?>",  
          method:"POST",  
          data:{cust_id:cust_id},
          dataType:"json",  
          success:function(data)  
          { 
            setTimeout( my_fun_delete, 0 );
          }
        });

      },
      function()
      {

      });
   });



   var val=$("#hidden_field").val();
   
   $(document).on('focusout','#customer_phone', function(event)
   {
    if($("#hidden_field").val()==1)
    {
      get_opd_patient_info();
    }
    else if($("#hidden_field").val()==2)
    {
      get_ipd_patient_info();
    }

  });

   $(document).on('keydown', '#customer_phone', function (e) {
    var key = e.which;
    if(key == 13) {
      get_opd_patient_info();
    }
  });

   $(document).on('click','#opd_patient_ul>li', function(event)
   {
     if($("#hidden_field").val()==1)
     {
      get_opd_patient_info();
    }
    else if($("#hidden_field").val()==2)
    {
      get_ipd_patient_info();
    }

  });


 })

function get_opd_patient_info() {

  var patient_mobile_no=$("#customer_phone").val();
  var blood_group_id;
  $.ajax({  
    url:"<?=site_url('admin/get_all_info_by_mobile_no')?>",  
    method:"POST",
    data:{patient_mobile_no:patient_mobile_no},  
    dataType:"json",  
    success:function(data)  
    { 
     $.each(data, function (key, value) 
     {

      $('#customer_name').val(value.patient_name);
      $('#customer_address').val(value.address);
      $('#patient_id').val(value.id);
      
    });

   }   
 });
}

function get_ipd_patient_info() {

  var patient_mobile_no=$("#customer_phone").val();
  var blood_group_id;
  $.ajax({  
    url:"<?=site_url('admin/get_all_info_by_mobile_no_ipd')?>",  
    method:"POST",
    data:{patient_mobile_no:patient_mobile_no},  
    dataType:"json",  
    success:function(data)  
    { 
     $.each(data, function (key, value) 
     {

      $('#customer_name').val(value.patient_name);
      $('#customer_address').val(value.address);
      $('#patient_id').val(value.id);
      
    });

   }   
 });
}

function pass_radio_val(){
  var val=$("input[name='optradio']:checked").val();
  if(val==1)
  {
    $('#hidden_field').val("1");
    $.ajax({  
      url:"<?=site_url('admin/get_all_mobile_no')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        var mobile_no_data=[];
        $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              mobile_no_data.push(value.mobile_no)
                            });

        $("#customer_phone").typeahead('destroy','NoCached');

        $("#customer_phone").typeahead({source:mobile_no_data});


      }
    });
  }
  else if(val==2)
  {
    $('#hidden_field').val("2");
    $.ajax({  
      url:"<?=site_url('admin/get_all_mobile_no_ipd')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 
        var mobile_no_data=[];
        $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              mobile_no_data.push(value.mobile_no)
                            });

        $("#customer_phone").typeahead('destroy','NoCached');

        $("#customer_phone").typeahead({source:mobile_no_data});


      }
    });
  }
  else
  {
    $('#hidden_field').val("3");
  }
}

function my_fun() {
 $('#add_modal').modal('hide');
 window.location="admin/add_customer";
}
function my_fun_sub() {
 $('#add_sub_modal').modal('hide');
 window.location="admin/add_customer"
}
function my_fun_delete() {
 window.location="admin/add_customer"
}
function my_fun_update() {
  $('#edit_modal').modal('hide');
  window.location="admin/add_customer"
}
function my_fun_sub_update() {
  $('#edit_sub_test_modal').modal('hide');
  window.location="admin/add_customer"
}

function my_function() {
  document.getElementById("add_form").reset();
}
</script>

<script type="text/javascript" language="javascript" >  
 $(document).ready(function(){ 

  var dataTable = $('#test_table').DataTable({  
   "processing":true,  
   "serverSide":true,  
   "order":[],  
   "ajax":{  
    url:"<?php echo base_url()?>"+'admin/add_customer_dt/',  
    type:"POST"
  },  
  "columnDefs":[  
  {  
    "targets":[5],  
    "orderable":false,  
  },  
  ],  
});  
});  
</script> 
</body>
</html>