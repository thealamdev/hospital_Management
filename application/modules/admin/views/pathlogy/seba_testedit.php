<?php $this->load->view('back/header_link'); ?>
<body class="light">

  <style type="text/css" media="screen">

table{
  border: 1px solid black;
  padding: 10px !important;
}

.bio-chemestry{
  border: 1px solid red !important;
}
.wrapper_table{
  width: 650px !important;
      border: 1px solid black;
      padding: 15px;
      border-radius: 10px;
    }
</style>  


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
  <?php if($this->session->userdata('scc_alt')){ ?>
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
      <a href="javascript:;" class="alert-link"><?=$this->session->userdata('scc_alt');?></a>
    </div>
  <?php } $this->session->unset_userdata('scc_alt');?>    
  <?php if (isset($message)) { ?>
    <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
  <?php } ?>
  <?php echo validation_errors(); ?>         
  <div class="section-wrapper">
    <div class="card my-3 no-b">
      <div class="card-body">
        <div class="container">
          <form action="admin/edit_test" method="POST" class="ipd_form">
            <input type="hidden" value="<?php echo $subtestid?>" name="subtestid"/>
            <div class="row">                 
              <div class="col-md-12"> 
                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Test Name</label>
                    <div class="col-md-8"><input class="form-control form-control-sm" value="<?php echo $sub_test_title?>" readonly  type="text" id="sub_test_title" name="sub_test_title" placeholder="" required></div>
                  </div>
                </div> 

                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-4 text-right">Heading</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="heading" id="inlineRadio1" value="1" <?php if($is_heading==1){echo 'checked';}?> >
                      <label class="form-check-label" for="inlineRadio1">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="heading" id="inlineRadio2" <?php if($is_heading==2){echo 'checked';}?> value="2">
                      <label class="form-check-label" for="inlineRadio2">No</label>
                    </div>
                  </div>
                </div>   


                <div class="form-group">
                  <div class="row">
                    <label for="" class="col-md-6 text-right"> Set Report Template</label>

                  </div>
                </div>



                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12">
                      <?php

                      ?>
                      <textarea id="editor" name="template">


                        <?php
                        if(($test_template!=="NULL")and($test_template!=="")and($test_template!==" ")and(!empty($test_template)))
                        {
                          echo $test_template;  
                        }
                        else
                        {
                          ?>

                          <div class="bio-chemestry">
                           <table class="farhana-table-4"> 
                            <tr>
                              <th class="farhana-table-4-tr-1" colspan="4">
                                Test name : <?php echo $sub_test_title?>
                              </th>
                            </tr>

                            <tr>
                              <td>
                                <?php echo $sub_test_title?>
                              </td>
                              <td ><b></b></td>
                              <td ><?php echo $unit?></td>
                              <td >

                              </td>
                            </tr>
                          </table> 
                        </div> 


                        <?php 
                      }
                      ?>
                    </textarea>


                  </div>

                  </div>
                </div>
                <div class="text-right"> 


                  <input type="submit" value="Update" class="btn btn-primary m-2">
                </div>
              </div>

            </div>

          </form>
          <button style="" onclick="reset_summernote()" class="btn btn-danger">Reset</button>
          <button style="" onclick="old_format_summernote()" class="btn btn-danger">Old Format</button>
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



    function reset_summernote(argument) {
     $('#editor').summernote('code', '<div class="bio-chemestry_without_border"></div>');
   }

   function old_format_summernote(argument) {
     $('#editor').summernote('code', '<div class="bio-chemestry"><table class="farhana-table-4"><tbody><tr><td><?php echo $sub_test_title?></td><td></td><td></td><td><br></td></tr></tbody></table></div>');
   }

 </script>
  <script src="back_assets/ckeditor/ckeditor.js"></script>
  <script src="back_assets/ckeditor/samples/js/sample.js"></script>
  <script>
    initSample();
 
  </script>



</body>
</html>