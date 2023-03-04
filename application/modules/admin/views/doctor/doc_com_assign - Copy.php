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


            <table id="group_id_table" class="table table-striped table-bordered mytable_style table-hover sell_cart">
              <thead>
                <tr>
                  <th style="width:5%;">S.L</th>
                  <th style="width:34%;">Group Name</th>
                  <th style="width:34%;">Test Name</th>
                  <th style="width:15%;">Com Type</th>
                  <th style="width:12%;">Amnt/Per</th>
                  
                  <th style="width:10%;">Action</th>
                </tr>
              </thead>
              <tbody class="mytable_style" id="dynamic_row">
                
                <tr>
                  <td>1</td>
                  <td>
                    <select required onchange="division_select(1)" id="division_1" required="" name="group_id[]" class="chosen-select custom-select select2 form-control">
                      <option value="0"></option>
                      <?php
                      foreach($test as $val)
                      {
                       $testid=$val['test_id'];
                       $grp_title=$val['test_title'];
                       echo "<option value='$testid'>$grp_title</option>";
                     }
                     ?>
                   </select> 
                 </td>
                 
                 <td>
                  <select required="" name="test_name_1[]" class="multi_select form-control custom-select select2" id="district_1" onchange="fun_test(1)"  multiple="multiple">
                   <option  disabled="disabled">Choose Test Title</option>
                   
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
              <input required="" type="text" name="com_amnt[]" class="form-control"/>
            </td>
            <td>
              
              <a class="add_row btn btn-success btn-xs">
                <i class="fa fa-plus"></i>
              </a >
              
              
            </td>
          </tr>
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

<!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
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
      
      var val=$("#district_"+id).val();

      var val1=$("#division_"+id).val();

      // alert(val1);

      var isInArray = val.includes("all");

      if(isInArray==true)
      {
        $("#district_"+id).empty();

        $.ajax({
          url: "<?php echo site_url('admin/select_test_name_selected');?>",
          type: "post",
          data: {val1:val1},
          success: function(msg)
          {

           $("#district_"+id).html(msg);
         }      
       });  
      }

      

    }
    
    function division_select(id) 
    {

      var group_id=$("#division_"+id).val();

            // alert(group_id);

            var rowCount =$('#group_id_table tr').length;
            var table = document.getElementById('group_id_table');

            // alert(rowCount);

            for(var i=1;i <= rowCount;i++)
            {
              var g_id=$("#division_"+i).val();

                    // alert(g_id);

                    if(g_id==group_id && i != id)
                    {
                      
                     $('#division_'+id).select2("val", 0);

                     group_id=$("#division_"+id).val();

                   }
                   
                   
                 }


                 $.ajax({
                  url: "<?php echo site_url('admin/select_test_name');?>",
                  type: "post",
                  data: {group_id:group_id},
                  success: function(msg)
                  {
                    //alert(msg);
					//console.log("msg");
         $("#district_"+id).html(msg);
       }      
     });  
               }

             </script>


             <script>
              var i=2;   
              $(".add_row").click(function(){

                $(".chosen-select").select2("destroy");
                $(".percent_select").select2("destroy");
                $(".multi_select").select2("destroy");
                
                $("#dynamic_row").append('<tr><td>'+i+'</td><td><select required="" id="division_'+i+'" onchange="division_select('+i+')" name="group_id[]" class="chosen-select select2 form-control"><option value="0"></option><?php foreach ($test as $val) { $test_title=$val["test_title"];?><option value="<?=$val["test_id"];?>"><?=str_replace("'","\'",$test_title)?></option><?php } ?></select> </td>  <td><select required="" name="test_name_'+i+'[]" class="form-control multi_select custom-select select2" id="district_'+i+'" onchange="fun_test('+i+')"  multiple="multiple"><option  disabled="disabled">Choose Test Title</option><select></td><td><select required="" name="com_type[]" class="form-control percent_select custom-select select2"><option  disabled="disabled">Choose Commission Type</option><option value="1">Percentage</option><option value="3">Amount</option><option value="2">Fixed Commission</option></select></td><td><input required="" type="text" name="com_amnt[]" class="form-control"/></td><td><button class="rem_row btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></button></td></tr>');
                
                i++;

                $(".chosen-select").select2();
                $(".percent_select").select2();
                $(".multi_select").select2();
    // alert(i);
  });

              $("#dynamic_row").on('click','.rem_row',function(){
                $(this).parent().parent().remove();
                i--;
              });


            </script>
          </body>
          </html>