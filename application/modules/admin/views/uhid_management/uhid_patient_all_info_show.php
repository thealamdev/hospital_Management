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
         <div class="form-group">
           <a href="admin/uhid_patient_all_info" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Search New UHID</a>
         </div>
         <table id="test_table" class="table table-bordered table-hover data-tables test_table_report"
         data-options='{ "paging": false; "searching":false}'>
         <thead>
          <tr>
            <th>All Appointment</th>
            <th>All OPD Receipt</th>
            <th>All Patholgy Report</th>
            <th>All IPD Receipt</th>
            <th>All Pharmacy Receipt</th>
          </thead>
          <tbody>   
            <tr>

              <td><a target="_blank" href="admin/appointment_list/<?=$uhid?>"><?=$all_uhid_info[0]['gen_id']?></a></td>

              <td>
                <a target="_blank" href="admin/opd_all_billing_info/<?=$uhid?>"><?=$all_uhid_info[0]['gen_id']?></a>

              </td>
              <td>
               <?php foreach ($all_opd_info as $key => $value)
               { ?>

                <a target="_blank" href="admin/search_pathology_list_custom/<?=$value['test_order_id']?>"><?=$value['test_order_id']?></a><br>

              <?php } ?>

            </td>

            <td>
             <?php if(!empty($all_ipd_info) && $all_ipd_info[0]['type'] != 3)
             { ?>

              <a target="_blank" href="admin/ipd_patient_unrelease_list/<?=$uhid?>"><?=$all_uhid_info[0]['gen_id']?></a>

            <?php } else {?>

               <a target="_blank" href="admin/ipd_patient_billing_list_all/<?=$uhid?>"><?=$all_uhid_info[0]['gen_id']?></a>
            <?php } ?>

          </td>

          <td><span class="badge badge-secondary"></span></td>
        </tr>

      </tbody>
    </table>
  </div>
</div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>

<script type="text/javascript">

  $(document).on('click','.product_delete_button', function(event)
  {
       //var row_id = 
       var log_id=$(this).attr("id");;

       // alert(pro_id);
       
       alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
        function()
        {
          $.ajax({  

            url:"<?=site_url('admin/delete_user')?>",  
            method:"POST",  
            data:{log_id:log_id},
            dataType:"json",  
            success:function(data)  
            { 
              setTimeout( my_fun_delete,500);
            },
            error: function (e) {
              setTimeout( my_fun_delete,500);
            }   
          });

        },
        function()
        {

        });
     });
  function my_fun() {
   $('#add_modal').modal('hide');
   location.reload();
 }
 function my_fun_sub() {
   $('#add_sub_modal').modal('hide');
   location.reload();
 }
 function my_fun_delete() {
       // location.reload();
       window.location="admin/user_list";
     }
     function my_fun_update() {
      $('#edit_modal').modal('hide');
      location.reload();
    }
    function my_fun_sub_update() {
      $('#edit_sub_test_modal').modal('hide');
      location.reload();
    }
  </script>