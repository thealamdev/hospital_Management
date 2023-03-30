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
    
    <div class="section-wrapper">

      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="card-title">
            <h1>No data found. Please provide the report first</h1>
          </div> 

       </div>
     </div>
   </div>
 </div>
</div>
</div>


<div class="control-sidebar-bg shadow white fixed"></div>
</div>

<?php $this->load->view('back/footer_link');?>




</body>
</html>