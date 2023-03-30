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
      <!-- Add Customer Modal Starts -->
      <!-- 
         <div class="modal fade" id="add_customer_modal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Add Customer</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                     <div class="modal-body">
                     <input type="hidden" name="hidden_field" id="hidden_field">
                      <input type="hidden" name="patient_id" id="patient_id">
                     <div class="form-check-inline">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" value="1"  onclick="pass_radio_val()" name="optradio">opd patient
                       </label>
                     </div>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                         <input type="radio" class="form-check-input" value="2" onclick="pass_radio_val()" name="optradio">ipd patient
                       </label>
                     </div>
                     <div class="form-check-inline">
                       <label class="form-check-label">
                         <input checked type="radio" class="form-check-input mb-4" value="3" onclick="pass_radio_val()" name="optradio">others
                       </label>
                     </div>
                     
         
                       
         
                       <div class="md-form mb-2">
                         <i class="fa fa-medkit" aria-hidden="true"></i>
                         <label data-error="wrong" data-success="right" for="customer_phone">Customer Phone</label>
                         <input type="text" name="customer_phone" id="customer_phone" class="form-control validate">
                     </div>
         
                     <div class="md-form mb-2">
                         <i class="fa fa-h-square" aria-hidden="true"></i>
                         <label data-error="wrong" data-success="right" for="customer_name">Customer Name</label>
                         
                          <input type="text" id="customer_name" name="customer_name" class="form-control validate" required="">
                           
                         
                     </div>
                     <div class="md-form mb-2">
                         <i class="fa fa-medkit" aria-hidden="true"></i>
                         <label data-error="wrong" data-success="right" for="customer_address">Customer Address</label>
                         <input type="text" id="customer_address" name="customer_address" class="form-control validate">
                     </div>
                   </div>
                   <div class="modal-footer">
                     <button type="submit" class="btn btn-outline-primary btn-sm"  id="add_customer_name_button">Add<i class="fa fa-plus ml-1"></i></button>
                     <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
                   </div>
                 </div>
               </div>
             </div> -->
      <!-- Add Customer Modal Ends -->
      <?php if (isset($message)) {?>
      <CENTER>
         <h3 style="color:green;"><?php echo $message ?></h3>
      </CENTER>
      <br>
      <?php } ?>
      <?php echo validation_errors(); ?>
      <div class="section-wrapper">
         <div class="container-fluid">
            <div class="row">
               <!-- first COl 1 -->
               <div class="col-md-7">
                  <div class="card my-3 no-b">
                     <div class="card-body">
                        <!-- <div class="card-title">Simple usage</div> -->
                        <table id="test_info_table" class="table table-bordered table-hover data-tables"
                           data-options='{ "paging": false; "searching":false}'>
                           <thead>
                              <tr>
                                 <th>SL NO</th>
                                 <th>Test Category</th>
                                 <th>Test Name</th>
                                 <th>Ref Doc Com</th>
                                 <th>Q/C Doc Com</th>
                                 <th>Price</th>
                                 <th style="width:10%;">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php  $i=1;
                                 foreach ($test_info as $key => $value) {?>
                              <tr>
                                 <td><?=$i?></td>
                                 <td><?=$value['test_title']?></td>
                                 <td><?=$value['sub_test_title']?></td>
                                 <td><?=$value['doc_ref_com']?></td>
                                 <td><?=$value['quk_ref_com']?></td>
                                 <td><?=$value['price']?></td>
                                 <td><button type="button" id="<?=$value['id']?>" data-sub_test_id="<?=$value['id']?>" data-test_id="<?=$value['mtest_id']?>" data-test="<?=$value['sub_test_title']?>" data-price="<?=$value['price']?>"
                                    data-quk_ref_com="<?=$value['quk_ref_com']?>" class="btn btn-primary btn-sm add_this_test"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Add</button></td>
                              </tr>
                              <?php
                                 $i++; 
                                 } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <!-- Second Col 2 -->
               <div class="col-md-5">
                  <form action="admin/update_opd_order_data" method="post" onsubmit="return validateForm()">
                     <div class="card my-3 no-b">
                        <div class="card-body">
                           <div class="row" style="padding:15px;">
                              <div class="col-md-12 mb-4" id="customer_list_div">
                                 <label for="bill_no">Bill No:</label>
                                 <select id="bill_no"  name="bill_no" class="chosen-select custom-select select2 form-control" required>
                                    <option value=""></option>
                                    <?php foreach ($test_order_info as $row) { 
                                      if($row['id']==$passed_order_id)
                                      { ?>
                                         <option selected value="<?=$row['id'];?>"><?=$row['test_order_id'];?></option>
                                   <?php } else { ?>
                                    <option value="<?=$row['id'];?>"><?=$row['test_order_id'];?></option>
                                    <?php } }?>
                                 </select>
                              </div>

                               <input type="hidden" value="" id="delete_t_id_list" name="delete_t_id_list">

                              <!--  <input type="text" value="<?=count($this->cart->contents())?>" id="total_val_cart" name="total_val_cart"> -->

                              <!-- <input type="hidden"  name="order_id" id="order_id">

                              <input type="hidden" value="<?=$row['patient_id'];?>" name="patient_id" id="patient_id"> -->

                              <div class="col-md-12 mb-3">
                                 <input type="text" id="patient_name"  name="patient_name" placeholder="Patient Name" required class="form-control">
                              </div>

                               <div class="col-md-12 mb-3">
                                <select id="ref_doc_name"  name="ref_doc_name" class="chosen-select custom-select select2 form-control" required>
                                    <option value=""></option>
                                    
                                 </select>

                                
                              </div>

                               <div class="col-md-12 mb-3">
                                 <select id="quack_doc_name"  name="quack_doc_name" class="chosen-select custom-select select2 form-control" required>
                                    <option value=""></option>
                                   
                                 </select>

                                
                              </div>

                              <div class="col-md-12 mb-3">
                                 <input type="text" id="mobile_no" name="mobile_no" placeholder="Mobile No" required class="form-control">
                              </div>

                              <input type="hidden" id="table_length" name="table_length">

                               <input type="hidden" id="test_id" name="test_id">

                              <!-- <div class="col-md-6 ">
                                 <input type="text" id="bill_no" name="bill_no" placeholder="Bill No" required class="form-control">
                                 </div> -->

                              <!-- <div class="col-md-6 align-right">
                                 <input type="text" name="export_no" id="chalan_no" placeholder="Chalan No" class="form-control">
                              </div> -->
                           </div>
                        </div>
                     </div>
                     <div class="card my-3 no-b">
                        <div class="card-body" >
                         
                           <div id="test_cart_details">
                              <?php $this->load->view('opd/opd_edit_invoice_cart_details'); ?>
                           </div>

                           
                           <div align="right">
                              <button type="submit" id="save_button" class="btn btn-success">Update</button>
                           </div>
                          
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <div class="control-sidebar-bg shadow white fixed"></div>
   </div>
   <style type="text/css">
      .card-body
      {
      padding-top: 10px !important;
      padding-bottom: 10px !important;
      padding-left: 0px !important;
      padding-right:0px !important;
      }
   </style>
   <?php $this->load->view('back/footer_link');?>
   <script type="text/javascript">




      $(document).ready(function()
      {

         fun_cart();

         $(document).on('change','#bill_no', function(event)
        { 

            fun_cart();

        });


          $(document).on('click', '.add_this_test', function()
          {
            var sum=0;
            var test_name=$(this).data('test');
            var sub_test_id=$(this).data('sub_test_id');
            var test_price=$(this).data('price');
            var test_id=$(this).data('test_id');
            var quk_ref_com=$(this).data('quk_ref_com');
            var quantity="1";

            var total_discount=$('#discount').val();
            var vat=$('#vat').val();
            var total_paid=$('#total_paid').val();
      
            $.ajax({
                url:"<?=site_url("admin/add_edit_invoice")?>",
                method:"POST",
                dataType:"html",
                data:{test_id:test_id,sub_test_id:sub_test_id, test_name:test_name, test_price:test_price,quk_ref_com:quk_ref_com,quantity:quantity,total_discount:total_discount,vat:vat,total_paid:total_paid},
                success:function(data)
                {
                  
                  $('#test_cart_details').html(data);
                 
                   total_discount_vat();
                    
      
                  var rowCount =$('#test_cart_table tr').length;
                var table = document.getElementById('test_cart_table');
      
                for(var i=1;i<rowCount-6;i++)
                {
                  sum=parseFloat(sum)+parseFloat(table.rows[i].cells[3].innerHTML);
                  // alert(sum);
                }
                      $("#total_c_o").val(sum.toFixed(2));
                      sum=0;


      
                    }
          });
      
        });
      
        $(document).on('click', '.remove_test', function()
          {
            var row_id = $(this).attr("row_id");

            var t_id = $(this).attr("t_id");

        var delete_val=$("#delete_t_id_list").val();

        // alert(delete_val);
        delete_val=delete_val+'_'+t_id;
            


            var sum=0;
            alertify.confirm('<b>Delete Confirmation</b>',"Are you sure you want to remove this?",
            function(){
              //alertify.success('Ok');
               $("#delete_t_id_list").val(delete_val);
              $.ajax({
                  url:"<?=site_url()?>admin/remove_edit_invoice",
                  method:"POST",
                  dataType:"html",
                  data:{row_id:row_id},
                  success:function(data)
                  {
                    $('#test_cart_details').html(data);
                    var rowCount =$('#test_cart_table tr').length;
                    var table = document.getElementById('test_cart_table');
          
                    for(var i=1;i<rowCount-6;i++)
                    {
                      sum=parseFloat(sum)+parseFloat(table.rows[i].cells[3].innerHTML);
                      // alert(sum);
                    }
                          $("#total_c_o").val(sum.toFixed(2));
                          sum=0;
                  },
                  error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
                });
            },
            function(){
              //alertify.error('Cancel');
            });
            
          });
      
 
      
        $(document).on('input', '#discount', function()
        {
          
            total_discount_vat();
      
        
          });
      
          $(document).on('input', '#vat', function()
        {
           total_discount_vat();
      
        
          });
      
          $(document).on('input', '#total_paid', function()
        {
          total_paid();
          });

      });
      
        
      
        function total_paid(argument) {
          var net_total;
          var total_paid;
          if($('#net_total').val()=="")
          {
            net_total="0";
          }
          else
          {
            net_total=$('#net_total').val();
          }
          if($('#total_paid').val()=="")
          {
            total_paid="0";
          }
          else
          {
            total_paid=$('#total_paid').val();
          }
          
          // alert(net_total +':'+ total_paid );
          
      
          var due=parseFloat(net_total)-parseFloat(total_paid);
          // alert(due);
      
          $('#due').val(due.toFixed(2));
        }

        function total_discount_vat()
        {
            var discount;
          var vat;
          var total=$('#discount').data('total');
          if($('#discount').val()=="")
          {
            discount="0";
          }
          else
          {
            discount=$('#discount').val();
            discount=discount;
          }
          if($('#vat').val()=="")
          {
            vat="0";
          }
          else
          {
            vat=$('#vat').val();
            vat=parseFloat(vat);
            // vat=vat.toFixed(2);
      
      
          }
          
          
          // alert(total+':'+vat+":"+discount);
      
          var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);
      
          $('#net_total').val(net_total.toFixed(2));

          total_paid();

         
         
        }


        function validateForm() 
        {
          var rowCount2 =$('#test_cart_table tr').length;
          var rowCount1 =$('#table_length').val();

          var old_id=$('#test_id').val().split("#");

          var arr=[];


          var sum1=0;
          var sum2=0;


          // alert(old_id[0]);
          

          if(rowCount1 != rowCount2)
          {
            
            return true;
          }

          else
          {
           
      
                for (var i =1; i < rowCount1-6; i++) {

                    

                  var k = parseFloat($('#test_'+i).val());     
                    arr.push(k);
                
                }


                arr.sort(function(a,b) { return a - b; });

                old_id.sort(function(a,b) { return a - b; });

                sum1=arr.join();
                sum2=old_id.join();

                if(sum1!=sum2)
                {
                  return true;
                }

                 // $('#no_change').show();
                 alert("No Changes Made");
                return false;

          }
        }

      
        function fun_cart(argument) {


          var rowCount1=0;
               
              
                var bill_no=$('#bill_no').find(":selected").text();

                $.ajax({
                url:"<?=site_url("admin/get_info_by_invoice_opd")?>",
                method:"POST",
                dataType:"html",
                data:{bill_no:bill_no},
                success:function(data)
                {
                  $('#test_cart_details').html(data);

                rowCount1 =$('#test_cart_table tr').length;

                $('#table_length').val(rowCount1);

                var all_id="";
                for (var i =1; i < rowCount1-6; i++) {

                 
                  // var table = document.getElementById('test_cart_table');

                    if(i==1)
                    {
                       all_id=$('#test_'+i).val();
                       // alert(all_id);
                    }
                    else
                    {
                       all_id=all_id+'#'+$('#test_'+i).val();
                    }
                
                }

                 $('#test_id').val(all_id);


                  $.ajax({
                url:"<?=site_url("admin/get_patient_info_by_bill")?>",
                method:"POST",
                dataType:"json",
                data:{bill_no:bill_no},
                success:function(val)
                {
                    $("#patient_name").val(val['patient_info'][0]['patient_name']);
                      $("#mobile_no").val(val['patient_info'][0]['mobile_no']);

                      $("#discount_ref").val(val['patient_info'][0]['discount_ref']);

                      $("#ref_doc_name").empty();
                      $("#quack_doc_name").empty();

                      $("#ref_doc_name").append('<option value="0#self">self</option>');
                      $("#quack_doc_name").append('<option value="0#self">self</option>');

                      $.each(val['doctor_info_ref'], function (key, value) {
                                
                              if(val['patient_info'][0]['ref_doc_id']==value['doctor_id'])
                              {
                                $("#ref_doc_name").append('<option selected value="' + value.doctor_id +'#'+value.doctor_title+ '">' + value.doctor_title + '</option>');
                              }
                              else
                              {
                                 $("#ref_doc_name").append('<option  value="' + value.doctor_id +'#'+value.doctor_title+ '">' + value.doctor_title + '</option>');
                              }
                
                                
                               
                        });

                      $.each(val['doctor_info_quack'], function (key, value) {
                                
                              if(val['patient_info'][0]['quack_doc_id']==value['doctor_id'])
                              {
                                $("#quack_doc_name").append('<option selected value="' + value.doctor_id +"#"+value.doctor_title+ '">' + value.doctor_title + '</option>');
                              }
                              else
                              {
                                 $("#quack_doc_name").append('<option  value="' + value.doctor_id +"#"+value.doctor_title+ '">' + value.doctor_title + '</option>');
                              }
                
                                
                               
                        });

                    
                          var sum=0;
                var rowCount =$('#test_cart_table tr').length;
      
                var table = document.getElementById('test_cart_table');
      
                for(var i=1;i<rowCount-6;i++)
                {
                  sum=parseFloat(sum)+parseFloat(table.rows[i].cells[3].innerHTML);
                  // alert(sum);
                }
      
          $("#total_c_o").val(sum.toFixed(2));

          // 
                    
                    total_discount_vat();
      
                }
                 });
                }
      
               }); 
            
          }  
          
      
   </script>


   
</body>
</html>