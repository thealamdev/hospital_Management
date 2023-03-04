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
              <select class="custom-select select2" name="sell_code" id="sell_code" required>
                <option value="">Sell Code</option>

                <?php
                foreach ($all_sale_code as $key => $val) { ?>

                  <option value="<?=$val['sell_code']?>"><?=$val['sell_code']?></option>

                <?php } ?>
              </select>
            </div>

            <input type="hidden"  id ="sell_code_hidden" name="sell_code_hidden" value="<?=$sell_code?>">

           

            <div class="bill_details_div col-md-10 offset-md-1 mt-5" id="bill_details_div">

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
    
   $(document).on('change', '#sell_code', function()
   {


    get_bill_info();


  });

 });

  function get_bill_info(argument) 
  {

    var sell_code=$("#sell_code").val();

    if(sell_code!="")
    {
      $.ajax({
        url:"<?=site_url("admin/get_sale_info_by_bill")?>",
        method:"POST",
        dataType:"html",
        data:{sell_code:sell_code},
        success:function(data)
        {

          $("#bill_details_div").html(data);
        }
      });
    }


  }

</script>