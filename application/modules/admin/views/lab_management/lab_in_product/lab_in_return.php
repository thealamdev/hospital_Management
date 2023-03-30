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
      <div class="card no-b">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 offset-md-2">
              <input type="text" class="form-control" placeholder="Enter Lab Bill Please" id="input_bill" name="bill_no" autocomplete="off">
            </div>
            <div class="col-md-4 offset-md-2">
              <button class="btn-lg btn-primary" id="get_info">Get Lab Bill Info</button>
            </div>

            <input type="hidden"  id ="bill_no_hidden" name="bill_no_hidden" value="<?=$bill_no?>">

            <div class="bill_details_div col-md-8 offset-md-2 mt-5" id="bill_details_div">

            </div>

          </div>


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




   $.ajax({  
    url:"<?=site_url('admin/get_all_lab_in_bill')?>",  
    method:"POST",  
    dataType:"json",  
    success:function(data)  
    { 
      var bill_no_data=[];
      $.each(data, function (key, value) {
                            // $.each(value, function (key, value) {
                              bill_no_data.push(value.bill_no)
                            });

      $("#input_bill").typeahead({source:bill_no_data});


    }
  });

   var bill_no= $('#bill_no_hidden').val();

   if(bill_no != "")
   {

       $("#input_bill").val(bill_no);
       
       get_bill_info();
   }



   $(document).on('click', '#get_info', function()
   {


    get_bill_info();


   });

 });


  function get_bill_info(argument) {

   var bill_no=$("#input_bill").val();
   if(bill_no!="")
   {
    $.ajax({
      url:"<?=site_url("admin/get_lab_in_info_by_bill")?>",
      method:"POST",
      dataType:"html",
      data:{bill_no:bill_no},
      success:function(data)
      {

        $("#bill_details_div").html(data);
      }
    });
  }
}
</script>