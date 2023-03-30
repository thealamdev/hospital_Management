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
          <!-- <div class="card-title">Simple usage</div> -->
          <div class="row">


            <div class="col-md-8 offset-md-4" >
             <form action="admin/edit_sell_invoice" method="get">

              <div class="row">

                <div class="col-md-4">
                  <label for="supplier_name" style="float: left;">Sell Code:</label>
                  <select name="sell_code" id="purchase_code" class="chosen-select custom-select select2 form-control" required> 
                   <option value=""></option>
                   <?php foreach ($all_sell_code as $row) {

                    if($sell_id==$row['sell_id'])
                      { ?>
                        <option selected="" value="<?=$row['sell_id'];?>"><?=$row['sell_code'];?></option>
                      <?php } else { ?>

                        <option value="<?=$row['sell_id'];?>"><?=$row['sell_code'];?></option>
                      <?php }

                      ?>

                    <?php } ?>
                  </select> 
                </div>

                <div class="col-md-8">
                  <input class="btn btn-success col-md-3" type="submit" name="purchase_btn" value="Search">
                </div>

              </div>

            </form>
          </div>

          </div>
        </div>
      </div> 
      <div class="control-sidebar-bg shadow white fixed"></div>
    </div>
  
    <?php $this->load->view('back/footer_link');?>





</body>
</html>