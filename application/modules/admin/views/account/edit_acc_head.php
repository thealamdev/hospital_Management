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
        <!--   <div class="form-group ml-4 mt-4">
            <a href="admin/add_acc_head"><button type="button" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Acc Head</button></a>
                   </div> -->
        <form method="post" action="admin/edit_head_add_post">
          <div class="row">
<input type="hidden" name="acc_head_id" value="<?php echo $head_id?>"/>


            <div class="col-md-6">
              <div class="form-group">
               <label for="user_name" class="col-sm-12 control-label">Acc Head Title</label>
               <div class="col-sm-10">
                   <input class="form-control" name="acc_head_title" value="<?php echo $acc_head_title?>" id="acc_head_title" placeholder="Acc Head Title" type="text">
               </div>
            </div>   
              <div class="form-group">
                 <label for="email" class="col-sm-12 control-label">Acc Code</label>
                 <div class="col-sm-10">
                     <input class="form-control" name="acc_code" value="<?php echo $acc_head_code ?>"  placeholder="Acc Code " type="text">
                 </div>
            </div>

            <div class="form-group">
                 <label for="mobile_no" class="col-sm-12 control-label">Group</label>
                 <div class="col-sm-10">
				 <select name="group_id" class="form-control">
				 <option value="<?php echo $groupid?>" selected><?php echo $group_title?></option>
				 <?php
				  foreach ($group as $key => $value) 
				  {
					  $group_id=$value['groupid'];
					  $group_title=$value['group_title'];
					  echo "<option value='$group_id'>$group_title</option>";
				  }
				 
				 ?>
				
				 </select>
                     
                 </div>
            </div>
             <!--  <div class="form-group">
                 <label for="email" class="col-sm-12 control-label">Opening Balance</label>
                 <div class="col-sm-10">
                     <input class="form-control" name="open_balance" value="<?php echo $opening_balance?>"   placeholder="Opening Balance" type="text">
                 </div>
            </div> -->
          </div>
        </div>
       <div class="row">
              <div class="col-md-5"></div>
               <div class="col-md-5">
                   <button type="submit" class="btn btn-success">Submit</button>
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



</body>
</html>