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
              <?= $page_title ?> --For <?=$doctor_title;?>
            </h4>
          </div>
        </div>
      </div>
    </header>
    
    <div class="section-wrapper">
      <div class="container">
        <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">  
          <form class="form-inline" action="admin/doc_comission_add" method="post">

            <input type="hidden" name="hospital_id" value="<?php echo $this->session->userdata['logged_in']['hospital_id']?>"/>
            <input type="hidden" name="doc_id" value="<?php echo $doc_id?>"/>


            <table id="group_id_table" class="table table-striped table-bordered test_table_report">
              <thead>
                <tr>
                  <th style="width:5%;">S.L</th>
                  <th style="width:34%;">Group Name</th>
                  <th style="width:34%;">Test Name</th>
                  <th style="width:15%;">Com Type</th>
                  <th style="width:12%;">Amount/Per</th>
                </tr>
              </thead>
              <tbody class="mytable_style" id="dynamic_row">


                <?php foreach ($test_group as $key => $value) { ?>

                 <tr>
                  <td><?=$key+1?></td>
                  <td>
                    <select id="test_group_<?=$key+1?>" required="" name="group_id[]" class="chosen-select custom-select select2 form-control">
                      <option value="0"></option>
                      <?php
                      $testid=$value['test_id'];
                      $grp_title=$value['test_title'];

                      echo "<option selected value='$testid'>$grp_title</option>";
                      ?>
                    </select> 
                  </td>

                  <td>
                    <select required="" name="test_name_<?=$key+1?>[]" class="multi_select form-control custom-select select2" id="test_<?=$key+1?>" onchange="fun_test(<?=$key+1?>)"  multiple="multiple">
                      <option selected value="all">All</option>
                      <?php foreach ($test as $key1 => $value1) { 
                        if($value['test_id'] == $value1['mtest_id']){ ?>

                          <option value="<?=$value1['id']?>"><?=$value1['sub_test_title']?></option>

                        <?php  }

                      } ?>

                    </select>
                  </td>
                  <td>
                    <select required="" name="com_type[]" class="percent_select form-control custom-select select2">
                     <!-- <option  disabled="disabled">Choose Commission Type</option> -->
                     <option value="1">Percentage</option>
                     <!-- <option value="3">Amount</option> -->
                     <option value="2">Fixed Commission</option>
                   </select>
                 </td>
                 <td>
                  <input  type="text" name="com_amnt[]" class="form-control"/>
                </td>
              </tr>

            <?php  } ?>

          </tbody>
        </table>


        <div class="col-md-12" align="center">

          <div class="col-md-offset-4 col-md-4" >
            <button class="btn btn-white btn-primary btn-bold"  type="submit">
              <i class="ace-icon glyphicon glyphicon-list"></i>
              Save
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>

<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<style type="text/css">
  .mytable_style tr td{
    padding: 2px !important;
    color:#000 !important;

    vertical-align: middle !important;
  }
  .mytable_style tr td input{
    color:#000 !important;
  }
  .sell_cart thead th{
    text-align: center !important;
    background: #EFF3F8;
    color: #0f0808;
    font-weight: 600;
  }
  .sell_cart_input{
    padding: 5px 0px !important;
    margin: 0 auto !important;
    height: auto !important;
    width: 100% !important;
    text-align: center !important;
  }
  .icon_tag_input{
    width: 100% !important;
    float: right;
  }
  .input-group-addon {
    padding: 6px 6px !important;
  }

</style>
<?php $this->load->view('back/footer_link');?>
<script>


  function fun_test(id) {

    var val=$("#test_"+id).val();

    var val1=$("#test_group_"+id).val();

    var isInArray = val.includes("all");


      if(isInArray==true)
      {
        $("#test_"+id).empty();

        $.ajax({
          url: "<?php echo site_url('admin/select_test_name_selected');?>",
          type: "post",
          data: {val1:val1},
          success: function(msg)
          {

           $("#test_"+id).html(msg);
         }      
       });  
      }

      

    }
    

  </script>
</body>
</html>