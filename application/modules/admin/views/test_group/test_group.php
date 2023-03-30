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

      <div class="form-group ml-4 mt-4">
        <button type="button" id="add_test_group" data-toggle="modal" data-target="#add_modal" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Test Group</button>
        <button type="button" id="add_sub_test_group" data-toggle="modal" data-target="#add_sub_test_modal" class="btn btn-info btn-md ml-2"><i class="fa fa-plus-square"></i>&nbsp;Add Sub-Test Group</button>
      </div>


      <!-- Add test Modal -->
      <div class="modal fade" id="add_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Test Group</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="md-form mb-2">
                <i class="fa fa-h-square" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="sub_test_title">Hospital Name</label>
                <select class="custom-select select2" id="hospital_name_select" required>

                </select>
              </div>
              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="test_title">Test Title</label>
                <input type="text" id="test_title" class="form-control validate">
              </div>

              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="Speciman">Speciman</label>


                <select class="custom-select select2" id="speciman" required>
                 <option></option>
                 <?php foreach ($specimen as $key => $value) { ?>

                  <option value="<?=$value['specimen']?>|<?=$value['id']?>"><?=$value['specimen']?></option>

                <?php  } ?>

                <option value="add_specimen">Add Specimen</option>

              </select>
            </div>

             <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="add_machine_text">Add Machine Text</label>
                <input type="text" id="add_machine_text" class="form-control validate">
              </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-outline-primary btn-sm"  id="add_button_modal">Add<i class="fa fa-plus ml-1"></i></button>
            <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
          </div>
        </div>
      </div>
    </div>
    <!-- end modal -->

    <!-- Add sub test Modal -->
    <div class="modal fade" id="add_sub_test_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Sub Test Group</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="md-form mb-2">
              <i class="fa fa-h-square" aria-hidden="true"></i>
              <label data-error="wrong" data-success="right" for="sub_test_title">Hospital Name</label>
              <select class="custom-select select2" id="hospital_name_select_sub" required>
              </select>
            </div>
            <div class="md-form mb-2">
              <i class="fa fa-medkit" aria-hidden="true"></i>
              <label data-error="wrong" data-success="right" for="test_title_select_sub">Test Title</label>
              <select class="custom-select select2" id="test_title_select_sub" required>
              </select>
              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="sub_test_title">Sub Test Title</label>
                <input type="text" id="sub_test_title" class="form-control validate">
              </div>

              <div class="md-form mb-2">
                <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                <label data-error="wrong" data-success="right" for="price">&#x9f3; Price</label>
                <input type="text" id="price" class="form-control validate">
              </div>

              <div class="md-form mb-2">
                <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                <label data-error="wrong" data-success="right" for="price">&#x9f3; Add Reagent</label>
                <select required name="reagent_p_id" id="reagent_p_id" class="chosen-select custom-select select2 form-control">  <option value=""></option>
                  <?php foreach ($regent_product_list as $row) { ?>

                   <option value="<?=$row['id'];?>"><?=$row['p_name'].'('.$row['p_current_stock'].')';?></option>
                 <?php  } ?>

               </select> 
             </div>

             <div class="md-form mb-2">
              <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
              <label data-error="wrong" data-success="right" for="price">&#x9f3; Reagent Qty</label>
              <input type="number" id="reagent_qty" class="form-control validate">
            </div>

            <!--   <div class="md-form mb-2">
            
                <label data-error="wrong" data-success="right" for="quk_doc_com">&#x9f3; Quack Ref Com</label>
                <input type="text" id="quk_ref_com" class="form-control validate">
              </div> -->

              
              <!-- <div class="md-form mb-2">
                
                <label data-error="wrong" data-success="right" for="ref_val">&#x9f3; Ref Val</label>
                <input type="text" id="ref_val" class="form-control validate">
              </div> -->

              <!-- <div class="md-form mb-2">
                
                <label data-error="wrong" data-success="right" for="unit">&#x9f3; Unit</label>
                <input type="text" id="unit" class="form-control validate">
              </div> -->

                              <!-- <div class="md-form mb-2">
                        
                        <label data-error="wrong" data-success="right" for="ref_doc_com">&#x9f3; Doc.Ref.Com</label>
                        <input type="text" id="ref_doc_com" class="form-control validate">
                      </div> -->

                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-outline-primary btn-sm"  id="add_sub_button_modal">Add<i class="fa fa-plus ml-1"></i></button>
                      <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end modal -->

            <!-- Edit Modal -->
            <div class="modal fade" id="edit_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Test Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="md-form mb-2">
                      <i class="fa fa-h-square" aria-hidden="true"></i>
                      <label data-error="wrong" data-success="right" for="test_title">Hospital Name</label>
                      <select class="custom-select select2" id="hospital_name_select_edit" required>

                      </select>
                    </div>
                    <div class="md-form mb-2">
                      <i class="fa fa-medkit" aria-hidden="true"></i>
                      <label data-error="wrong" data-success="right" for="test_title_edit">Test Title</label>
                      <input type="text" id="test_title_edit" class="form-control validate">
                    </div>
                    <div class="md-form mb-2">
                      <i class="fa fa-medkit" aria-hidden="true"></i>
                      <label data-error="wrong" data-success="right" for="edit_speciman">Speciman</label>

                      <select class="custom-select select2" id="edit_speciman" required>

                      </select>

                    </div>
                       <div class="md-form mb-2">
                  <i class="fa fa-medkit" aria-hidden="true"></i>
                  <label data-error="wrong" data-success="right" for="add_machine_text">Add Machine Text</label>
                  <input type="text" id="edit_add_machine_text" class="form-control validate">
                </div>
                    <input type="hidden" id="hidden_test_id" value="">
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-outline-danger btn-sm"  id="delete_button_modal">Delete<i class="fa fa-pencil ml-1"></i></button>
                    <button class="btn btn-outline-success btn-sm"  id="update_button_modal">Update<i class="fa fa-pencil ml-1"></i></button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
                  </div>
                </div>
              </div>
            </div>
            <!-- End -->


            <!-- Edit Sub Modal -->
            <div class="modal fade" id="edit_sub_test_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Sub Test Group</h5>
                    <button type="button" id="close_btn" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                     <!--  <div class="md-form mb-2">
                        <i class="fa fa-h-square" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="hospital_name_select_sub_edit">Hospital Name</label>
                        <select class="custom-select select2" id="hospital_name_select_sub_edit" required>
                        </select>
                      </div> -->
                      <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="test_title_select_sub_edit">Test Title</label>
                        <select class="custom-select select2" 
                        id="test_title_select_sub_edit" required>
                      </select>
                      <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="sub_test_title_edit">Sub Test Title</label>
                        <input type="text" id="sub_test_title_edit" class="form-control validate">
                      </div>


                      <div class="md-form mb-2">
                        <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                        <label data-error="wrong" data-success="right" for="price_edit">&#x9f3; Price</label>
                        <input type="text" id="sub_price" class="form-control validate">
                      </div>


                      <div class="md-form mb-2">
                        <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                        <label data-error="wrong" data-success="right" for="price">&#x9f3; Add Reagent</label>
                        <select required name="reagent_p_id_edit" id="reagent_p_id_edit" class="chosen-select custom-select select2 form-control">  <option value=""></option>

                        </select> 
                      </div>

                      <div class="md-form mb-2">
                        <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                        <label data-error="wrong" data-success="right" for="reagent_qty_edit">&#x9f3; Reagent Qty</label>
                        <input type="number" id="reagent_qty_edit" class="form-control validate">
                      </div>
                   <!--  <div class="md-form mb-2">
                        
                        <label data-error="wrong" data-success="right" for="ref_doc_com">&#x9f3; Doc.Ref.Com</label>
                        <input type="text" id="edit_doc_ref_com" class="form-control validate">
                      </div> -->

                     <!--  <div class="md-form mb-2">
                       
                        <label data-error="wrong" data-success="right" for="quk_doc_com">&#x9f3; Quk.Ref.Com</label>
                        <input type="text" id="edit_quk_ref_com" class="form-control validate">
                      </div> -->

                      <!-- <div class="md-form mb-2">
                       
                        <label data-error="wrong" data-success="right" for="edit_ref_val">&#x9f3; Ref Val</label>
                        <input type="text" id="edit_ref_val" class="form-control validate">
                      </div> -->

                     <!--  <div class="md-form mb-2">
                       
                        <label data-error="wrong" data-success="right" for="edit_unit">&#x9f3; Unit</label>
                        <input type="text" id="edit_unit" class="form-control validate">
                      </div> -->



                      <input type="hidden" id="hidden_sub_test_id" value="">

                    </div>
                    <div class="modal-footer">
                    <!--   <button class="btn btn-outline-danger btn-sm"  id="delete_sub_button_modal">Delete<i class="fa fa-plus ml-1"></i></button> -->
                      <button class="btn btn-outline-primary btn-sm"  id="update_sub_button_modal">Update<i class="fa fa-plus ml-1"></i></button>
                      <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End -->

            <div class="card my-3 no-b">
              <div class="card-body">
                <!-- <div class="card-title">Simple usage</div> -->
      

                  <?php foreach ($test as $key => $value)
                  {  ?>

                    <div style="text-align: center;">



                      <h3><b><a href="javascript:void(0)" class="edit_button" id="edit_<?=$value['test_id'];?>"><span class="badge badge-primary"><?=$value['test_title'];?> (<?=$value['speciman'];?>)</span></a></b></h3>  
                    </div>

                    <table class="table test_table_report">
                      <thead>
                        <tr>
                          <th>SL NO</th>
                          <th>Test Title</th>
                          <th>Re-agent</th>
                          <th>Price</th>
                          <th style="width:10%;">Action</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php $i=1;  foreach ($sub_test as $key1 => $row) { ?>
                          <?php if($row['mtest_id']==$value['test_id']){?>
                            <tr>
                              <td><?=$i?></td>
                              <td><?=$row['sub_test_title'];?></td>
                              <td><?=$row['p_name'] .'('. $row['p_current_stock'].')' ?></td>
                              <td><?=$row['price'];?></td>
                              <td>       

                                <a href="javascript:void(0)" class="edit_sub_span btn btn-xs btn-success" id="edit_sub_<?=$row['id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                                 <button class="btn btn-xs btn-danger delete_sub_button_modal" data-sub_test_id="<?=$row['id'];?>" id="delete_sub_button_modal"><i class="fa fa-trash-o"></i></button>

                              </tr>

                            <?php $i++; }  } ?>

                          </tbody>
                        </table>

                      </br>
                    <?php } ?>

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
    $(document).ready(function(){ 
      var table = $('#test_table').DataTable();

      $(document).on('change','#speciman', function(event)
      {        
        if($(this).find(":selected").val()=='add_specimen'){
                  //alert($(this).find(":selected").val());
                  // $('#add_supplier_modal').modal({
                  //     show: true
                  // });

                  window.location="admin/add_specimen";


                }
              });




  // ************* Add Test *****************




  $(document).on('click','#add_test_group', function(event)
  {
    $("#hospital_name_select").empty();
    $("#hospital_name_select").append('<option value="">Select Hospital Name</option>');
    $.ajax({  
      url:"<?=site_url('admin/get_all_hospital_title')?>",  
      method:"POST",  
      dataType:"json",  
      success:function(data)  
      { 

        $.each(data['hospital_name'], function (key, value) {

          $("#hospital_name_select").append('<option selected value="' + value.hospital_id + '">' + value.hospital_title + '</option>');

        });
      }
    });
  });

  $(document).on('click','#add_button_modal', function(event)
  {
    var add_machine_text = $('#add_machine_text').val();
    var test_title = $('#test_title').val();
    var hospital_id =$( "#hospital_name_select option:selected" ).val();
    var speciman =$("#speciman" ).val();
    var res = speciman.split("|");

    // alert(res[0]);
    $.ajax({  

      url:"<?=site_url('admin/add_test')?>",  
      method:"POST",  
      data:{test_title:test_title,hospital_id:hospital_id,speciman:res[0],specimen_id:res[1],add_machine_text:add_machine_text},
      dataType:"json",  
      success:function(data)  
      { 
        $("#add_button_modal").notify
        (
          "Successfully Test Added","success", 
          { position:"bottom" }
          );
        setTimeout( my_fun, 2000 );
      },
      error: function (e) {

        $("#add_button_modal").notify
        (
          "Failed", 
          { position:"bottom" }
          );
        setTimeout( my_fun, 2000 );
      }   
    });

  });


  // ********************** Add Sub Test ***********************

  $(document).on('click','#add_sub_test_group', function(event)
  {
    $("#hospital_name_select_sub").empty();
      // <option value=""></option>
      $("#hospital_name_select_sub").append('<option value="">Select Hospital Name</option>');
      $.ajax({  
        url:"<?=site_url('admin/get_all_hospital_title')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 
          $.each(data['hospital_name'], function (key, value) 
          {
            $("#hospital_name_select_sub").append('<option value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
          });
        }

      });
    });

  $(document).on('change','#hospital_name_select_sub', function(event)
  {

    var hospital_id_sub=$( "#hospital_name_select_sub option:selected" ).val();

    $("#test_title_select_sub").empty();

    $.ajax({  
      url:"<?=site_url('admin/get_all_test_by_hospital_id')?>",  
      method:"POST",
      data:{hospital_id_sub:hospital_id_sub},  
      dataType:"json",  
      success:function(data)  
      { 
       $.each(data, function (key, value) {
        $("#test_title_select_sub").append('<option value="' + value.test_id + '">' + value.test_title + '</option>');
      });
     }

   });
  });

  $(document).on('click','#add_sub_button_modal', function(event)
  {
    var test_id = $( "#test_title_select_sub option:selected" ).val();
    var hospital_id=$( "#hospital_name_select_sub option:selected" ).val();
    var sub_test_title=$("#sub_test_title").val();
    var price=$("#price").val();
    var reagent_p_id=$("#reagent_p_id").val();
    var reagent_qty=$("#reagent_qty").val();

    // var doc_ref_com=$("#doc_ref_com").val();
    // var quk_ref_com=$("#quk_ref_com").val();
    // var ref_val=$("#ref_val").val();


    var unit=$("#unit").val();

    //alert(hospital_id);
    $.ajax({  

      url:"<?=site_url('admin/add_sub_test')?>",  
      method:"POST",  
      data:{test_id:test_id,hospital_id:hospital_id,sub_test_title:sub_test_title,price:price,unit:unit,reagent_qty:reagent_qty,reagent_p_id:reagent_p_id},
      dataType:"json",  
      success:function(data)  
      { 
        $("#add_sub_button_modal").notify
        (
          "Successfully Test Added","success", 
          { position:"bottom" }
          );
        setTimeout( my_fun_sub, 2000 );
      },
      error: function (e) {

        $("#add_sub_button_modal").notify
        (
          "Failed", 
          { position:"bottom" }
          );
        setTimeout( my_fun_sub, 2000 );
      }   
    });

  });

   //***************** Edit Test ********************

   $(document).on('click','.edit_button', function(event)
   {
    $('#edit_modal').modal('show');
    var row_id = $(this).attr("id");
    var test_id=row_id.replace('edit_','');
    var hospital_id;
       // var speciman;
       $('#hidden_test_id').val(test_id);
       $("#hospital_name_select_edit").empty();
       $("#edit_speciman").empty();
       $.ajax({  

        url:"<?=site_url('admin/get_specific_hospital_and_test')?>",  
        method:"POST", 
        data:{test_id:test_id},  
        dataType:"json",  
        success:function(data)  
        { 


         $.each(data['test'], function (key, value) {
          hospital_id=value.hospital_id;

          $("#hospital_name_select_edit").append('<option selected value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
          $('#test_title_edit').val(value.test_title);
          $('#edit_add_machine_text').val(value.add_machine_text);


        }); 

         $.each(data['specimen'], function (key1, value1) {

           if(value1.id == data['test'][0]['specimen_id'])
           {
            $("#edit_speciman").append('<option selected value="' + value1.specimen+"|"+value1.id + '">' + value1.specimen + '</option>');
          }
          else
          {
            $("#edit_speciman").append('<option  value="' + value1.specimen+"|"+value1.id + '">' + value1.specimen + '</option>');
          }



        }); 
         
       }    
     });
     });

   $(document).on('click','#update_button_modal', function(event)
   {
     var test_id=$('#hidden_test_id').val();
     var test_title_edit=$('#test_title_edit').val();
     var edit_speciman=$('#edit_speciman').val();
     var add_machine_text=$('#edit_add_machine_text').val();


     var res = edit_speciman.split("|");
     var hospital_id=$( "#hospital_name_select_edit option:selected" ).val();


       $.ajax({  

        url:"<?=site_url('admin/update_test')?>",  
        method:"POST",
        data:{test_id:test_id,test_title_edit:test_title_edit,hospital_id:hospital_id,edit_speciman:res[0],specimen_id:res[1],add_machine_text:add_machine_text},  
        dataType:"json",  
        success:function(data)  
        { 
         $("#update_button_modal").notify
         (
          "Successfully Updated","success", 
          { position:"bottom" }

          );

         setTimeout( my_fun_update, 2000 );

       },
       error: function (e) {
       }   
     });

     });

   // *********************** Delete Test *******************


   $(document).on('click','#delete_button_modal', function(event)
   {
       // var row_id = $(this).attr("id");
       var test_id=$('#hidden_test_id').val();
       
       alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
        function()
        {
          $.ajax({  

            url:"<?=site_url('admin/delete_test')?>",  
            method:"POST",  
            data:{test_id:test_id},
            dataType:"json",  
            success:function(data)  
            { 

              $("#delete_button_modal").notify
              (
                "Successfully Deleted","success", 
                { position:"bottom" }

                );

              setTimeout( my_fun_delete, 2000 );
            },
            error: function (e) {

              $("#delete_button_modal").notify
              (
                "Failed", 
                { position:"bottom" }
                );
              setTimeout( my_fun_delete, 2000 );
            }   
          });

        },
        function()
        {

        });
     });

   $(document).on('click','.delete_sub_button_modal', function(event)
   {
       // var row_id = $(this).attr("id");
       // var sub_test_id=$('#hidden_sub_test_id').val();
       var sub_test_id=$(this).data('sub_test_id');
       
       alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
        function()
        {
          $.ajax({  

            url:"<?=site_url('admin/delete_sub_test')?>",  
            method:"POST",  
            data:{sub_test_id:sub_test_id},
            dataType:"json",  
            success:function(data)  
            { 

              $("#delete_sub_button_modal").notify
              (
                "Successfully Deleted","success", 
                { position:"bottom" }

                );

              setTimeout( my_fun_sub_update, 100 );
            },
            error: function (e) {

              $("#delete_button_modal").notify
              (
                "Failed", 
                { position:"bottom" }
                );
              setTimeout( my_fun_sub_update, 2000 );
            }   
          });

        },
        function()
        {

        });
     });

      // *********** Edit Sub Test ******************

      $(document).on('click','.edit_sub_span', function(event)
      {
        $('#edit_sub_test_modal').modal('show');
        var row_id = $(this).attr("id");
        var id=row_id.replace('edit_sub_','');
        var hospital_id;
        var test_id;
        var reagent_p_id;

        
        $("#hospital_name_select_sub_edit").empty();
        $("#test_title_select_sub_edit").empty();
        $('#hidden_sub_test_id').val(id);

        $.ajax({  

          url:"<?=site_url('admin/get_specific_hospital_and_test_sub_test')?>",  
          method:"POST", 
          data:{id:id}, 
          dataType:"json",  
          success:function(data)  
          { 
            $.each(data['sub_test'], function (key, value) {

              // hospital_id=value.hospital_id;
              test_id=value.test_id;
              reagent_p_id=value.reagent_p_id;

  
              $("#test_title_select_sub_edit").append('<option selected value="' + value.test_id + '">' + value.test_title + '</option>');
              $('#sub_test_title_edit').val(value.sub_test_title);
              $('#sub_price').val(value.price);
              $('#reagent_qty_edit').val(value.reagent_qty);

              // $('#edit_quk_ref_com').val(value.quk_ref_com);
              // $('#edit_unit').val(value.unit);
              // $('#edit_ref_val').val(value.ref_val);


            });

            $.each(data['test'], function (key, value) {
              if(test_id!=value.test_id )
              {
                $("#test_title_select_sub_edit").append('<option value="' + value.test_id + '">' + value.test_title + '</option>');
              }

            });

            $.each(data['regent_product_list'], function (key, value) {

              if(reagent_p_id==value.id)
              {
                $("#reagent_p_id_edit").append('<option selected value="' + value.id + '">' + value.p_name + '('+value.p_current_stock+')'+ '</option>');
              }
              else
              {
                $("#reagent_p_id_edit").append('<option  value="' + value.id + '">' + value.p_name +  '('+value.p_current_stock+')'+'</option>');
              }

            });
          }   
        });
      });

   // update sub modal

   $(document).on('click','#update_sub_button_modal', function(event)
   {
     var id = $('#hidden_sub_test_id').val();
     var test_id=$( "#test_title_select_sub_edit option:selected").val();
     var sub_test_title=$("#sub_test_title_edit").val();
     var price=$("#sub_price").val();
     var reagent_qty_edit=$("#reagent_qty_edit").val();
     var reagent_p_id_edit=$("#reagent_p_id_edit").val();

     // var edit_quk_ref_com=$("#edit_quk_ref_com").val();
     // var edit_unit=$("#edit_unit").val();
     // var edit_ref_val=$("#edit_ref_val").val();

     $.ajax({  

      url:"<?=site_url('admin/update_sub_test')?>",  
      method:"POST",
      data:{test_id:test_id,sub_test_title:sub_test_title,price:price,id:id,reagent_qty_edit:reagent_qty_edit,reagent_p_id_edit:reagent_p_id_edit},  
      dataType:"json",  
      success:function(data)  
      { 
       $("#update_sub_button_modal").notify
       (
        "Successfully Updated","success", 
        { position:"bottom" }

        );

       setTimeout( my_fun_sub_update, 2000 );

     },
     error: function (e) {
     }   
   });

   });

 });


function my_fun() {
 $('#add_modal').modal('hide');
 window.location="admin/test_group";
}
function my_fun_sub() {
 $('#add_sub_modal').modal('hide');
 window.location="admin/test_group";
}
function my_fun_delete() {
 $('#edit_modal').modal('hide');
 window.location="admin/test_group";
}
function my_fun_update() {
  $('#edit_modal').modal('hide');
  window.location="admin/test_group";
}
function my_fun_sub_update() {
  $('#edit_sub_test_modal').modal('hide');
  window.location="admin/test_group";
}

</script>



</body>
</html>