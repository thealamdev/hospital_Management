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
           <a href="admin/add_additional_test" id="" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Additional Test</a>
         </div>
         <table class="table table-bordered  data-tables">
           <thead>
            <tr>
              <th>S.L</th>
              <th>Additional Test Name</th>
              <th>Group Name</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i=1;
            foreach ($additional_test_list as $key => $value)
              {?>            
                <tr>
                  <td><?=$i?></td>
                  <td><?=$value['sub_test_title']?></td>
                  <td><?=$value['price']?></td>
                  <td><?=$value['test_title']?></td>
                  
                  <td>           

                     <a  href="admin/edit_additional_test/<?=$value['id']?>" class="btn btn-success btn-xs edit_button"><i class="fa fa-pencil" aria-hidden="true"></i></a>                 

                    <a  href="admin/delete_additional_test/<?=$value['id']?>" class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>


                  </tr>


                  <?php 
                  $i++;
                }?>   
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> 
    <div class="control-sidebar-bg shadow white fixed"></div>
  </div>
  <?php $this->load->view('back/footer_link');?>
