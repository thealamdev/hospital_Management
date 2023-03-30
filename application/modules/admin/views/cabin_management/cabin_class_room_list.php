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
        <button type="button" id="add_cabin" data-toggle="modal" data-target="#add_cabin_modal" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Cabin Class</button>
        <button type="button" id="add_sub_cabin" data-toggle="modal" data-target="#add_cabin_sub_modal" class="btn btn-info btn-md ml-2"><i class="fa fa-plus-square"></i>&nbsp;Add Cabin Sub Class</button>
        <button type="button" id="add_room" data-toggle="modal" data-target="#add_cabin_room_modal" class="btn btn-info btn-md ml-2"><i class="fa fa-plus-square"></i>&nbsp;Add Room list</button>
      </div>

      <!-- Add cabin class Modal -->
      <div class="modal fade" id="add_cabin_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Cabin Class</h5>
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
                <label data-error="wrong" data-success="right" for="">Cabin Class Title</label>
                <input type="text" id="cabin_class_title" class="form-control validate">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-primary btn-sm"  id="add_cavin_button_modal">Add<i class="fa fa-plus ml-1"></i></button>
              <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->

      <!-- Add cabin sub class Modal -->
      <div class="modal fade" id="add_cabin_sub_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Cabin Sub Class</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="md-form mb-2">
                <i class="fa fa-h-square" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="hospital_name_select_sub">Hospital Name</label>
                <select class="custom-select select2" id="hospital_name_select_sub" required>
                </select>
              </div>
              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="cabin_title_select_sub">Cabin Class Title</label>
                <select class="custom-select select2" id="cabin_title_select_sub" required>
                </select>
                <div class="md-form mb-2">
                  <i class="fa fa-medkit" aria-hidden="true"></i>
                  <label data-error="wrong" data-success="right" for="sub_cabin_title">Cabin Sub Class Title</label>
                  <input type="text" id="sub_cabin_title" class="form-control validate">
                </div>

              </div>
              <div class="modal-footer">
                <button class="btn btn-outline-primary btn-sm"  id="add_sub_cabin_button_modal">Add<i class="fa fa-plus ml-1"></i></button>
                <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->
      <!-- Add cabin room list Modal -->
      <div class="modal fade" id="add_cabin_room_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Cabin Room list</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="md-form mb-2">
                <i class="fa fa-h-square" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="hospital_name_select_room">Hospital Name</label>
                <select class="custom-select select2" id="hospital_name_select_room" required>
                </select>
              </div>
              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="">Cabin Class Title</label>
                <select class="custom-select select2" id="cabin_room_select" required>
                </select>
              </div>
              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="cabin_sub_room_select">Cabin Sub Class title</label>
                <select class="custom-select select2" id="cabin_sub_room_select" required>
                </select>
              </div>
              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="cabin_room_title">Cabin Room title</label>
                <input type="text" id="cabin_room_title" class="form-control validate">
              </div>
              <div class="md-form mb-2">
                <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                <label data-error="wrong" data-success="right" for="room_price">&#x9f3; Price</label>
                <input type="text" id="room_price" class="form-control validate">
              </div>

              <div class="md-form mb-2">
                <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                <label data-error="wrong" data-success="right" for="seat_capacity">&#x9f3; Seat Capacity</label>
                <input type="number" id="seat_capacity" class="form-control validate">
              </div>

              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="room_type">Room Type</label>
                <select class="custom-select select2" id="room_type" >
                  <option value="1">Normal</option>
                  <option value="2">Doctor Room</option>
                </select>
              </div>
            </div>




            <div class="modal-footer">
              <button class="btn btn-outline-primary btn-sm"  id="add_room_button_modal">Add<i class="fa fa-plus ml-1"></i></button>
              <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
            </div>
          </div>
        </div>
      </div>

      <!-- end modal -->

      <!-- Edit cabin class Modal -->
      <div class="modal fade" id="edit_cabin_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Cabin Class</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="hidden_cabin_id" name="">
              <div class="md-form mb-2">
                <i class="fa fa-h-square" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="sub_test_title">Hospital Name</label>
                <select class="custom-select select2" id="hospital_name_select_edit_cabin" required>

                </select>
              </div>
              <div class="md-form mb-2">
                <i class="fa fa-medkit" aria-hidden="true"></i>
                <label data-error="wrong" data-success="right" for="">Cabin Class Title</label>
                <input type="text" id="cabin_class_title_edit_cabin" class="form-control validate">
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-primary btn-sm"  id="update_cabin_button_modal">Update<i class="fa fa-plus ml-1"></i></button>
              <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
            </div>
          </div>
        </div>
      </div>
      <!-- end modal -->

      <!-- Edit cabin sub class Modal -->
      <div class="modal fade" id="edit_sub_cabin_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Cabin Sub Class</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" id="hidden_sub_cabin_id" name="">
                      <!-- <div class="md-form mb-2">
                        <i class="fa fa-h-square" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="hospital_name_select_edit_sub_cabin">Hospital Name</label>
                        <select class="custom-select select2" id="hospital_name_select_edit_sub_cabin" required>
                        </select>
                      </div> -->
                      <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="cabin_title_select_edit_sub_cabin">Cabin Class Title</label>
                        <select class="custom-select select2" id="cabin_title_select_edit_sub_cabin" required>
                        </select>
                        <div class="md-form mb-2">
                          <i class="fa fa-medkit" aria-hidden="true"></i>
                          <label data-error="wrong" data-success="right" for="edit_sub_cabin_title">Cabin Sub Class Title</label>
                          <input type="text" id="edit_sub_cabin_title" class="form-control validate">
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-outline-primary btn-sm"  id="update_sub_cabin_button_modal">Update<i class="fa fa-plus ml-1"></i></button>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end modal -->
              <!-- Edit cabin room list Modal -->
              <div class="modal fade" id="edit_cabin_room_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Cabin Room list</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" id="hidden_room_id" name="">
                      <!-- <div class="md-form mb-2">
                        <i class="fa fa-h-square" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="edit_hospital_name_select_room">Hospital Name</label>
                        <select class="custom-select select2" id="edit_hospital_name_select_room" required>
                        </select>
                      </div> -->
                    <!-- <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="edit_cabin_room_select">Cabin Class Title</label>
                        <select class="custom-select select2" id="edit_cabin_room_select" required>
                        </select>
                      </div> -->
                      <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="edit_cabin_sub_room_select">Cabin Sub Class title</label>
                        <select class="custom-select select2" id="edit_cabin_sub_room_select" required>
                        </select>
                      </div>
                      <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="cabin_room_title">Cabin Room title</label>
                        <input type="text" id="edit_cabin_room_title" class="form-control validate">
                      </div>
                      <div class="md-form mb-2">
                        <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                        <label data-error="wrong" data-success="right" for="room_price">&#x9f3; Price</label>
                        <input type="text" id="edit_room_price" class="form-control validate">
                      </div>

                      <div class="md-form mb-2">
                        <!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
                        <label data-error="wrong" data-success="right" for="seat_capacity">&#x9f3; Seat Capacity</label>
                        <input type="number" id="edit_seat_capacity" class="form-control validate">
                      </div>

                      <div class="md-form mb-2">
                        <i class="fa fa-medkit" aria-hidden="true"></i>
                        <label data-error="wrong" data-success="right" for="edit_room_type">Room Type</label>
                        <select class="custom-select select2" id="edit_room_type" >
                          <option value="1">Normal</option>
                          <option value="2">Doctor Room</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-outline-primary btn-sm"  id="update_room_button_modal">update<i class="fa fa-plus ml-1"></i></button>
                      <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
                    </div>
                  </div>
                </div>
              </div>

              <!-- end modal -->


              <div class="card my-3 no-b">
                <div class="card-body">
                  <!-- <div class="card-title">Simple usage</div> -->
                  <table id="test_table" class="table table-bordered table-hover data-tables"
                  data-options='{ "paging": false; "searching":false}'>
                  <thead>
                    <tr>
                      <th>SL NO</th>
                      <th>Hospital Name</th>
                      <th>Cabin Title</th>
                      <th>Sub Cabin Title</th>
                      <th style="width:10%;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1;
                    foreach ($cabin_hospital as $cab) { ?>
                     <tr>
                       <td><?=$i?></td>
                       <td><?=$cab["hospital_title"]?></td>
                       <td><a href="javascript:void(0)" id="edit_cabin_<?=$cab['id']?>" class="edit_cabin"><span class="badge badge-danger"><?=$cab["cabin_class_title"]?></span></td></a>
                       <td>
                         <?php foreach ($sub_cabin as $sub_cab) { 
                          if($cab['id']==$sub_cab['cabin_class_id']){
                            ?> 
                            <a href="javascript:void(0)"  id="edit_sub_cabin_<?=$sub_cab['id']?>" class="edit_sub_cabin"><span class="badge badge-primary mb-2 mt-2"><?=$sub_cab['cabin_sub_class_title']?></span><br>&nbsp;&nbsp;</a> 
                            <?php
                            foreach ($room as $ro) {
                              if($ro['cabin_sub_class_id']==$sub_cab['id']){ ?>
                                <a href="javascript:void(0)"  id="edit_room_<?=$ro['id']?>" class="edit_room"><span style="margin-top: 5px;" class="badge badge-pill badge-secondary"><?=$ro['room_title']?> (<?=$ro['room_price']?> &#x9f3) (<?=$ro['seat_capacity']?> bed)</span></a>
                                <?php
                              }
                            } echo "<br>";
                          } 
                        } ?>
                      </td>
                      <td align="center"><button type="button" id="delete_<?=$cab["id"]?>"class="btn btn-danger btn-xs delete_button"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>
                    </tr> 

                    <?php $i++; } ?>
                  </tbody>
                </table>
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

//****************** ADD Cabin *********************\\
$(document).on('click','#add_cabin', function(event)
{
  $("#hospital_name_select").empty();
      // <option value=""></option>
       // $("#hospital_name_select").append('<option value="">Select Hospital Name</option>');
       $.ajax({  
        url:"<?=site_url('admin/get_all_hospital_title')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 
          if(data['admin_type']==3 || data['admin_type']==5)
          {
            $.each(data['hospital_name'], function (key, value) {
                            // $.each(value, function (key, value) {
                              $("#hospital_name_select").append('<option selected value="' + value.hospital_id + '">' + value.hospital_title + '</option>');

                            });
          }
          else{
            $.each(data['hospital_name'], function (key, value) 
            {
              $("#hospital_name_select").append('<option value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
            });
          }

        }
      });
     });


$(document).on('click','#add_cavin_button_modal', function(event)
{
  var cabin_class_title = $('#cabin_class_title').val();
  var hospital_id=$( "#hospital_name_select option:selected" ).val();
    // alert(cabin_class_title);
    $.ajax({  

      url:"<?=site_url('admin/add_cabin_class')?>",  
      method:"POST",  
      data:{cabin_class_title:cabin_class_title,hospital_id:hospital_id},
      dataType:"json",  
      success:function(data)  
      { 
        $("#add_cavin_button_modal").notify
        (
          "Successfully Cabin Added","success", 
          { position:"bottom" }
          );
        setTimeout( my_fun, 2000 );
      },
      error: function (e) {

        $("#add_cavin_button_modal").notify
        (
          "Failed", 
          { position:"bottom" }
          );
        setTimeout( my_fun, 2000 );
      }   
    });

  });

  //****************** ADD Sub Cabin *********************\\

  $(document).on('click','#add_sub_cabin', function(event)
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
        // alert(hospital_id_sub);
        $("#cabin_title_select_sub").empty();
        $("#cabin_title_select_sub").append('<option value="">Select Hospital Name</option>');
        $.ajax({  
          url:"<?=site_url('admin/get_all_cabin_by_hospital_id')?>",  
          method:"POST",
          data:{hospital_id_sub:hospital_id_sub},  
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data, function (key, value) {
            $("#cabin_title_select_sub").append('<option value="' + value.id + '">' + value.cabin_class_title + '</option>');
          });
         }
                  // error: function(e) 
                  // {
                  //   alert(e);
                  // }
                });
      });


  $(document).on('click','#add_sub_cabin_button_modal', function(event)
  {
    var cabin_class_id = $( "#cabin_title_select_sub option:selected" ).val();
    var hospital_id=$( "#hospital_name_select_sub option:selected" ).val();
    var sub_cabin_title=$("#sub_cabin_title").val();

    //alert(hospital_id);
    $.ajax({  

      url:"<?=site_url('admin/add_sub_cabin')?>",  
      method:"POST",  
      data:{cabin_class_id:cabin_class_id,hospital_id:hospital_id,sub_cabin_title:sub_cabin_title},
      dataType:"json",  
      success:function(data)  
      { 
        $("#add_sub_cabin_button_modal").notify
        (
          "Successfully Test Added","success", 
          { position:"bottom" }
          );
        setTimeout( my_fun_sub, 2000 );
      },
      error: function (e) {

        $("#add_sub_cabin_button_modal").notify
        (
          "Failed", 
          { position:"bottom" }
          );
        setTimeout( my_fun_sub, 2000 );
      }   
    });

  });

  //****************** Add Room *********************\\

  $(document).on('click','#add_room', function(event)
  {
    $("#hospital_name_select_room").empty();
      // <option value=""></option>
      $("#hospital_name_select_room").append('<option value="">Select Hospital Name</option>');
      $.ajax({  
        url:"<?=site_url('admin/get_all_hospital_title')?>",  
        method:"POST",  
        dataType:"json",  
        success:function(data)  
        { 
          $.each(data['hospital_name'], function (key, value) 
          {
            $("#hospital_name_select_room").append('<option value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
          });
        }
      });
    });

  $(document).on('change','#hospital_name_select_room', function(event)
  {

    var hospital_id_sub=$( "#hospital_name_select_room option:selected" ).val();
        // alert(hospital_id_sub);
        $("#cabin_room_select").empty();
        $("#cabin_room_select").append('<option value="">Select Cabin Name</option>');
        $.ajax({  
          url:"<?=site_url('admin/get_all_cabin_by_hospital_id')?>",  
          method:"POST",
          data:{hospital_id_sub:hospital_id_sub},  
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data, function (key, value) {
            $("#cabin_room_select").append('<option value="' + value.id + '">' + value.cabin_class_title + '</option>');
          });
         }
       });
      });

  $(document).on('change','#cabin_room_select', function(event)
  {

    var cabin_room_select_id=$( "#cabin_room_select option:selected" ).val();
        // alert(hospital_id_sub);
        $("#cabin_sub_room_select").empty();
        $("#cabin_sub_room_select").append('<option value="">Select Sub Cabin Name</option>');
        $.ajax({  
          url:"<?=site_url('admin/get_all_sub_cabin_by_cabin_id')?>",  
          method:"POST",
          data:{cabin_room_select_id:cabin_room_select_id},  
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data, function (key, value) {
            $("#cabin_sub_room_select").append('<option value="' + value.id + '">' + value.cabin_sub_class_title + '</option>');
          });
         }
       });
      });


  $(document).on('click','#add_room_button_modal', function(event)
  {
    var cabin_class_id = $( "#cabin_room_select option:selected" ).val();
    var cabin_sub_class_id = $( "#cabin_sub_room_select option:selected" ).val();
    var hospital_id=$( "#hospital_name_select_room option:selected" ).val();
    var cabin_room_title=$("#cabin_room_title").val();
    var room_price=$("#room_price").val();
    var seat_capacity=$("#seat_capacity").val();

    var room_type = $("#room_type option:selected").val();

    //alert(hospital_id);
    $.ajax({  

      url:"<?=site_url('admin/add_room')?>",  
      method:"POST",  
      data:{cabin_class_id:cabin_class_id,cabin_sub_class_id:cabin_sub_class_id,hospital_id:hospital_id,cabin_room_title:cabin_room_title,room_price:room_price,seat_capacity:seat_capacity,room_type:room_type},
      dataType:"json",  
      success:function(data)  
      { 
        $("#add_room_button_modal").notify
        (
          "Successfully Room Added", 
          { position:"left-top",className:"success" }
          );
        setTimeout( my_fun_room, 2000 );
      },
      error: function (e) {

        $("#add_room_button_modal").notify
        (
          "Failed", 
          { position:"bottom" }
          );
        // setTimeout( my_fun_room, 2000 );
      }   
    });

  });

  // ***************** Edit Cabin ********************

  $(document).on('click','.edit_cabin', function(event)
  {
    $('#edit_cabin_modal').modal('show');
    var row_id = $(this).attr("id");
    var cabin_id=row_id.replace('edit_cabin_','');
    var hospital_id;
    $('#hidden_cabin_id').val(row_id);
    $("#hospital_name_select").empty();
    $.ajax({  

      url:"<?=site_url('admin/get_specific_hospital_and_cabin')?>",  
      method:"POST", 
      data:{cabin_id:cabin_id},  
      dataType:"json",  
      success:function(data)  
      {
       if(data['admin_type']==1)
       {
        $.each(data['cabin'], function (key, value) {
                              // if(value.test_id==test_id)
                              // {
                                hospital_id=value.hospital_id;
                                $("#hospital_name_select_edit_cabin").append('<option selected value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
                                $('#cabin_class_title_edit_cabin').val(value.cabin_class_title);
                              // }
                            });

        $.each(data['hospital'], function (key, value) {
          if(value.hospital_id!=hospital_id)
          {
            $("#hospital_name_select_edit_cabin").append('<option value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
          }
        });
      }
      else if(data['admin_type']==2)
      {

      }
      else if(data['admin_type']==3)
      {
       $.each(data['cabin'], function (key, value) {
                              // if(value.test_id==test_id)
                              // {
                                hospital_id=value.hospital_id;
                                $("#hospital_name_select_edit_cabin").append('<option selected value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
                                $('#cabin_class_title_edit_cabin').val(value.cabin_class_title);
                              // }
                            }); 
     }
   }
 });

  });

  $(document).on('click','#update_cabin_button_modal', function(event)
  {
   var row_id = $('#hidden_cabin_id').val();
   var cabin_id=row_id.replace('edit_cabin_','');
   var cabin_class_title_edit_cabin=$('#cabin_class_title_edit_cabin').val();
   var hospital_id=$( "#hospital_name_select_edit_cabin option:selected" ).val();
       // alert(test_id);
       $.ajax({  

        url:"<?=site_url('admin/update_cabin')?>",  
        method:"POST",
        data:{cabin_id:cabin_id,cabin_class_title_edit_cabin:cabin_class_title_edit_cabin,hospital_id:hospital_id},  
        dataType:"json",  
        success:function(data)  
        { 
         $("#update_cabin_button_modal").notify
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

   // ************* Edit Sub Cabin ************ 

   $(document).on('click','.edit_sub_cabin', function(event)
   {
    $('#edit_sub_cabin_modal').modal('show');
    var row_id = $(this).attr("id");
    var sub_cabin_id=row_id.replace('edit_sub_cabin_','');
        // var result=id.split('#');
        // alert(sub_cabin_id);
        var hospital_id;
        var cabin_id;
        
        $("#hospital_name_select_edit_sub_cabin").empty();
        $("#cabin_title_select_edit_sub_cabin").empty();
        $('#hidden_sub_cabin_id').val(sub_cabin_id);
        $.ajax({  

          url:"<?=site_url('admin/get_specific_hospital_and_cabin_sub_cabin')?>",  
          method:"POST", 
          data:{sub_cabin_id:sub_cabin_id}, 
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data['sub_cabin'], function (key, value) {
                              // if(value.id==result[0])
                              // {
                                hospital_id=value.hospital_id;
                                cabin_id=value.cabin_class_id;
                                $("#hospital_name_select_edit_sub_cabin").append('<option selected value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
                                $("#cabin_title_select_edit_sub_cabin").append('<option selected value="' + value.cabin_class_id + '">' + value.cabin_class_title + '</option>');
                                $('#edit_sub_cabin_title').val(value.cabin_sub_class_title);
                              });

           $.each(data['cabin'], function (key, value) {
            if(cabin_id!=value.id && hospital_id==value.hospital_id)
            {
              $("#cabin_title_select_edit_sub_cabin").append('<option value="' + value.id + '">' + value.cabin_class_title + '</option>');
            }

          });
         }
       });
      });

   $(document).on('click','#update_sub_cabin_button_modal', function(event)
   {
     var id = $('#hidden_sub_cabin_id').val();
     var cabin_id=$( "#cabin_title_select_edit_sub_cabin option:selected").val();
     var sub_cabin_title=$("#edit_sub_cabin_title").val();
       // alert(test_id);
       $.ajax({  

        url:"<?=site_url('admin/update_sub_cabin')?>",  
        method:"POST",
        data:{cabin_id:cabin_id,sub_cabin_title:sub_cabin_title,id:id},  
        dataType:"json",  
        success:function(data)  
        { 
         $("#update_sub_cabin_button_modal").notify
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

    // ********************* Edit Room ****************

    $(document).on('click','.edit_room', function(event)
    {
      $('#edit_cabin_room_modal').modal('show');
      var row_id = $(this).attr("id");
      var room_id=row_id.replace('edit_room_','');
        // var result=id.split('#');
        // alert(sub_cabin_id);
        var hospital_id;
        var cabin_id;
        var sub_cabin_id;
        
        $("#edit_hospital_name_select_room").empty();
        $("#edit_cabin_room_select").empty();
        $("#edit_cabin_sub_room_select").empty();
        $('#hidden_room_id').val(room_id);
        $.ajax({  

          url:"<?=site_url('admin/get_specific_hospital_and_cabin_sub_cabin_room')?>",  
          method:"POST", 
          data:{room_id:room_id}, 
          dataType:"json",  
          success:function(data)  
          { 
            $.each(data['room'], function (key, value) {
              hospital_id=value.hospital_id;
              cabin_id=value.cabin_class_id;
              sub_cabin_id=value.cabin_sub_class_id;
              $("#edit_hospital_name_select_room").append('<option selected value="' + value.hospital_id + '">' + value.hospital_title + '</option>');
              $("#edit_cabin_room_select").append('<option selected value="' + value.cabin_class_id + '">' + value.cabin_class_title + '</option>');
              $("#edit_cabin_sub_room_select").append('<option selected value="' + value.cabin_sub_class_id + '">' + value.cabin_sub_class_title + '</option>');
              $('#edit_cabin_room_title').val(value.room_title);
              $('#edit_room_price').val(value.room_price);
              $('#edit_seat_capacity').val(value.seat_capacity);

              $("#edit_room_type").val(value.type).trigger('change');
            });

            $.each(data['sub_cabin'], function (key, value) {
              if(sub_cabin_id!=value.id && cabin_id==value.cabin_class_id && hospital_id==value.hospital_id)
              {
                $("#edit_cabin_sub_room_select").append('<option value="' + value.id + '">' + value.cabin_sub_class_title + '</option>');
              }

            });
          }  
        });
      });


    $(document).on('click','#update_room_button_modal', function(event)
    {
     var id = $('#hidden_room_id').val();
     var sub_cabin_id=$( "#edit_cabin_sub_room_select option:selected").val();
     var room_title=$("#edit_cabin_room_title").val();
     var room_price=$("#edit_room_price").val();
     var seat_capacity=$("#edit_seat_capacity").val();

     var edit_room_type=$("#edit_room_type option:selected").val();
       // alert(test_id);
       $.ajax({  

        url:"<?=site_url('admin/update_room')?>",  
        method:"POST",
        data:{sub_cabin_id:sub_cabin_id,room_title:room_title,room_price:room_price,seat_capacity:seat_capacity,id:id,edit_room_type:edit_room_type},  
        dataType:"json",  
        success:function(data)  
        { 
         $("#update_room_button_modal").notify
         (
          "Successfully Updated","success", 
          { position:"bottom" }

          );

         setTimeout( my_fun_room_update, 2000 );

       },
       error: function (e) {
       }   
     });

     });

// ********************** Delete Test ***************************

$(document).on('click','.delete_button', function(event)
{
 var row_id = $(this).attr("id");
 var cabin_id=row_id.replace('delete_','');

 alertify.confirm('<b>Delete Confirmation</b>', "Are you sure to delete this data",
  function()
  {
    $.ajax({  

      url:"<?=site_url('admin/delete_cabin')?>",  
      method:"POST",  
      data:{cabin_id:cabin_id},
      dataType:"json",  
      success:function(data)  
      { 

        $("#"+row_id).notify
        (
          "Successfully Deleted","success", 
          { position:"bottom" }

          );

        setTimeout( my_fun_delete, 2000 );
      },
      error: function (e) {

        $("#add_sub_button_modal").notify
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




function my_fun() {
 $('#add_cabin_modal').modal('hide');
 location.reload();
}
function my_fun_sub() {
 $('#add_cabin_sub_modal').modal('hide');
 location.reload();
}
function my_fun_room() {
 $('#add_cabin_room_modal').modal('hide');
 location.reload();
}
function my_fun_delete() {
 location.reload();
}
function my_fun_update() {
  $('#edit_cabin_modal').modal('hide');
  location.reload();
}
function my_fun_sub_update() {
  $('#edit_sub_cabin_modal').modal('hide');
  location.reload();
}
function my_fun_room_update() {
  $('#edit_cabin_room_modal').modal('hide');
  location.reload();
}









</script>




</body>
</html>