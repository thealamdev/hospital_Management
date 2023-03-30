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
<!--          <div class="form-group">
           <a href="admin/add_doc_schedule" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Doctor Schedule</a>
         </div> -->
         <table class="table table-bordered table-hover test_table_report" id="test_table">
           <thead>
            <tr>
              <th>S.L</th>
              <th>Action</th>
              <th>Dr. Name</th>
              <th>Saturday</th>
              <th>Sunday</th>
              <th>Monday</th>
              <th>Tuesday</th>
              <th>Wednesday</th>
              <th>Thursday</th>
              <th>Friday</th>
              
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



  function dlt_confirm(val) {

   alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
    function()
    {
      window.location="admin/delete_doc_schedule/"+val;
    },
    function()
    {
      event.stopPropagation(); event.preventDefault();
    });
   

 }

 function confirmation(val) {

    // alert(val);

    // alert('hi');

    // onclick="if (confirm('Delete selected item?')){return true;}else{event.stopPropagation(); event.preventDefault();};"

    alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
      function()
      {
        window.location="admin/delete_individual_doc_schedule/"+val;
      },
      function()
      {
        event.stopPropagation(); event.preventDefault();
      });

  }





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

    <script type="text/javascript" language="javascript" >  
     $(document).ready(function(){ 

      var dataTable = $('#test_table').DataTable({  
       "processing":true,  
       "serverSide":true,  
       "order":[],  
       "ajax":{  
        url:"<?php echo base_url()?>"+'admin/doc_schedule_list_dt/',  
        type:"POST"
      },  
      "columnDefs":[  
      {  
        "targets":[1,3,4,5,6,7,8,9],  
       "orderable":false,  
     },  
     ],  
   });  
    });  
  </script>  