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

        <div style="text-align: center;" class="mt-2">
          <?php if($this->session->userdata('no_data')){ ?>  

            <span ><h3 style="color: red;"><?=$this->session->userdata('no_data')?></h3></span>

        <?php } ?> 
    </div>
    
    <div class="section-wrapper">

        <div class="card my-3 no-b">
            <div class="card-body">
             <div class="card-title">Pathology Search Collection</div> 
             <form method="POST" action="admin/search_pathology_list_custom" >
                 <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputEmail4" class="col-form-label">Order ID</label>
                        
                        <div class="input-group ml-3">
                            <input autocomplete="off" type="text" id="order_id" name="order_id" class="col-sm-12 form-control">

                        </div>
                    </div>
                    
                    <div class="form-group col-md-3"> 
                       <label for="inputEmail4" class="col-form-label"></label>
                       <label for="inputEmail4" class="col-form-label"></label>
                       <label for="inputEmail4" class="col-form-label"></label>
                       <label for="inputEmail4" class="col-form-label"></label>
                       <label for="inputEmail4" class="col-form-label"></label>
                       <label for="inputEmail4" class="col-form-label"></label>
                       <div class="input-group ml-3">
                          <button type="submit" class="btn btn-success">Submit</button>

                      </div>

                  </div>

              </div>
          </form>
      </div>
  </div>
</div>
</div>
</div>
</div>

<!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
       <div class="control-sidebar-bg shadow white fixed"></div>
   </div>

   <?php $this->load->view('back/footer_link');?>


   <script type="text/javascript">
    $(document).ready(function()
    { 
        var order_all=[];

        $.ajax({  
          url:"<?=site_url('admin/get_order_info_all')?>",  
          method:"POST",  
          dataType:"json",  
          success:function(data)  
          { 
           
            $.each(data, function (key, value) {
              order_all.push(value.test_order_id);
          });

            $("#order_id").typeahead({source:order_all});


        }

    });
        
    });
</script>

</body>
</html>