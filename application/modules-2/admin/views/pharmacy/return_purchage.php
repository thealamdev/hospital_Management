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
      
              <select class="custom-select select2" name="buy_code" id="buy_code" required>
                <option value="">Purchase Code</option>

                <?php
                foreach ($all_purchase_code as $key => $val) { ?>

                <option value="<?=$val['buy_code']?>"><?=$val['buy_code']?></option>

                <?php } ?>
              </select>
            </div>

     <!--        <div class="col-md-4 offset-md-2">
              <button class="btn-lg btn-primary" id="get_info">Get Bill Info</button>
            </div>
 -->
            <input type="hidden"  id ="buy_code_hidden" name="buy_code_hidden" value="<?=$buy_code?>">


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

   // var buy_code= $('#buy_code_hidden').val();

   // if(buy_code != "")
   // {

   //   $("#input_bill").val(buy_code);

   //   get_bill_info();
   // }



   $(document).on('change', '#buy_code', function()
   {


    get_bill_info();


  });

 });


  function get_bill_info(argument) {

   var buy_code=$("#buy_code").val();

   if(buy_code!="")
   {
    $.ajax({
      url:"<?=site_url("admin/get_purchage_info_by_bill")?>",
      method:"POST",
      dataType:"html",
      data:{buy_code:buy_code},
      success:function(data)
      {

        $("#bill_details_div").html(data);
      }
    });
  }
}
</script>