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
    <div class="container-fluid">
    <div class="row">
      <!-- first COl 1 -->
      <div class="col-md-7">
          <div class="card my-3 no-b">
            <div class="card-body" style="margin: 0px;">
                <!-- <div class="card-title">Simple usage</div> -->
                <table id="test_info_table" class="table table-bordered table-hover data-tables"
                       data-options='{ "paging": false; "searching":false}'>
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th>Test Category</th>
                        <th>Test Name</th>                       
                        <th>Doc Com</th>
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
                            <!--<td><?=$value['doc_ref_com']?></td>-->
							<?php
							$price=$value['price'];
							$testid=$value['test_id'];
							//echo $quack_doc_id;
$sql ="select * from doc_comission_distribution where doc_id=$quack_doc_id and group_id='$testid' and active_status=1 order by doc_com_id desc limit 1";
$query = $this->db->query($sql);
if ($query->num_rows()==0)
{
$quk_ref_com=0;
}
else
{
foreach ($query->result() as $row) 
    {
		
		$group_id=$row->group_id;
		$testid=$row->testid;
		$com_type=$row->com_type;
		$doc_comission=$row->doc_comission;
		if($com_type==1)
		{
		if($testid==0)
		{
		$quk_ref_com=($price*$doc_comission)/100;	
		}
		else
		{
		$quk_ref_com=($price*$doc_comission)/100;		
		}
		}
		else
		{
		$quk_ref_com=$doc_comission;		
		}
    }		
}
							 ?>
                            <td><?php echo $quk_ref_com?></td>
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
        <div class="card my-3 no-b">
            <div class="card-body">
        <div class="row ml-1 mr-1">

		 <input type="hidden" id="patient_id" value="<?=$patient_id?>" name="patient_id">

     <input type="hidden" value="<?=$ref_doctor_id?>" id="ref_doc_id" name="ref_doc_id">

     <input type="hidden" value="<?=$quack_doc_id?>" id="quack_doc_id" name="quack_doc_id">

        <!--   <input type="hidden" id="patient_id" value="<?=$patient_id[0]['id']?>" name="patient_id"> -->

          <div class="col-md-12">
            <div class="form-group">
                 <label for="patient_name" class="control-label">Patient Name</label>
                     <input class="form-control" value="<?= $patient_name ?>" name="patient_name" id="patient_name" readonly type="text">
              </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                     <label for="age" class=" control-label">Age</label>
                      <div class="">
                         <input class="form-control" value="<?=$age?>" name="age" id="age"  readonly type="text">
                      </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label">Gender</label>
                     <input class="form-control" value="<?=$gender?>" name="gender" id="gender" readonly type="text">
                  </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
                     <label for="ref_doc_name" class=" control-label">Refered Doctor Name</label>
                      <div class="">
                         <input class="form-control" value="<?=$ref_doc_name?>"  readonly name="ref_doc_name" id="ref_doc_name"   type="text">
                      </div>
                  </div>
                  <!-- <input type="hidden" value="<?=$ref_doctor_id?>" name="ref_doc_id" id="ref_doc_id"> -->
				  
			            <div class="form-group">
                     <label for="ref_doc_name" class=" control-label">Refered Quack Doc Name</label>
                      <div class="">
                         <input class="form-control" value="<?=$quack_doc_name?>" readonly  name="quack_doc_name" id="quack_doc_name"   type="text">
                      </div>
                  </div>	  

                  <!-- <input type="hidden" value="<?=$quack_doc_id?>" name="quack_doc_id" id="quack_doc_id"> -->
				  
             <div class="form-group">
                    <label for="blood_group" class="control-label">Blood Group</label>
                    <input class="form-control" value="<?=$blood_group_title?>" name="blood_group_title" id="blood_group_title"  readonly type="text">
              </div>
                  
          </div>
        </div>
      </div>
    </div>
    <div class="card my-3 no-b">
            <div class="card-body" >
              <div id="test_cart_details">
                <?php $this->load->view('opd/test_cart_details'); ?>

              </div>
              <div align="right">
                  <button type="button" id="save_button" class="btn btn-success">Save</button>
              </div>
            </div>
        </div>
      </div>
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

      var sum=0;
      var rowCount =$('#test_cart_table tr').length;
      var table = document.getElementById('test_cart_table');
      for(var i=1;i<rowCount-6;i++)
            {
              sum=parseFloat(sum)+parseFloat(table.rows[i].cells[3].innerHTML);
              // alert(sum);
            }
      $("#total_c_o").val(sum.toFixed(2));
      
      $(document).on('click', '.add_this_test', function()
      {
        var sum=0;
        var test_name=$(this).data('test');
        var sub_test_id=$(this).data('sub_test_id');
        var test_price=$(this).data('price');
        var test_id=$(this).data('test_id');
        var quk_ref_com=$(this).data('quk_ref_com');
        var quantity="1";

        $.ajax({
            url:"<?=site_url("admin/add")?>",
            method:"POST",
            dataType:"html",
            data:{test_id:test_id,sub_test_id:sub_test_id, test_name:test_name, test_price:test_price,quk_ref_com:quk_ref_com,quantity:quantity},
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
      });

    $(document).on('click', '.remove_test', function()
      {
        var row_id = $(this).attr("id");
		var sum=0;
        alertify.confirm('<b>Delete Confirmation</b>',"Are you sure you want to remove this?",
        function(){
          //alertify.success('Ok');
          $.ajax({
              url:"<?=site_url()?>admin/remove",
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

    // $(document).on('click', '#clear_cart', function()
  //    {
  //      alertify.confirm("Are you want to clear your cart?",
    //      function(){
    //        //alertify.success('Ok');
    //        $.ajax({
    //        url:"<?=site_url("admin/clear")?>",
    //        success:function(data)
    //        {
    //         //alert("");
    //         //$("#clear_cart").notify("Your cart has been clear");
    //         $('#cart_details').html(data);
    //        },
    //         error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
    //       });
    //      },
    //      function(){
    //        //alertify.error('Cancel');
    //        //return false;
    //      });
               
    //  });

    $(document).on('input', '#discount', function()
    {
      var discount;
      var vat;
      var total=$(this).data('total');
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
        
        // vat=vat.toFixed(2);


      }
      
      
      // alert(delivary_cost);

      var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

      $('#net_total').val(net_total.toFixed(2));
      total_paid();


    
      });

      $(document).on('input', '#vat', function()
    {
      var discount;
      var vat;
      var total=$(this).data('total');
      if($('#discount').val()=="")
      {
        discount="0";
      }
      else
      {
        discount=$('#discount').val();
        discount=(discount);
        
      }
      if($('#vat').val()=="")
      {
        vat="0";
      }
      else
      {
        vat=$('#vat').val();
        
      }
      
      
      // alert(discount);

      var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

      $('#net_total').val(net_total.toFixed(2));
      total_paid();

    
      });

      $(document).on('input', '#total_paid', function()
    {
      total_paid();
      });

    $(document).on('click', '#save_button', function()
    {
      
      var patient_id=$("#patient_id").val();
      var total_discount=$("#discount").val();
      var ref_doc_name=$("#ref_doc_name").val();
      var quack_doc_name=$("#quack_doc_name").val();

      var ref_doc_id=$("#ref_doc_id").val();
      var quack_doc_id=$("#quack_doc_id").val();

      var paid_amount =$("#total_paid").val();
      var total_amount=$("#total_amount").val();
      var vat=$("#vat").val();
      var total_c_o=$("#total_c_o").val();
	  var discount_ref=$("#discount_ref").val();

       var net_total=$("#net_total").val();

      
      var payment_status;

      // alert(total_paid);

      if(paid_amount >= net_total)
      {
        payment_status="paid";
      }
      else
      {
        payment_status="unpaid";  
      }

       // alert(net_total);

      $.ajax({
              url:"<?=site_url("admin/save_test_order_info")?>",
              method:"POST",
              dataType:"json",
              data:{vat:vat,patient_id:patient_id,total_discount:total_discount,paid_amount:paid_amount,total_amount:total_amount,payment_status:payment_status,total_c_o:total_c_o,quack_doc_name:quack_doc_name,ref_doc_name:ref_doc_name,discount_ref:discount_ref,ref_doc_id:ref_doc_id,quack_doc_id:quack_doc_id},
              success:function(data)
              {
                // var obj=$.parseJSON(data);
                //console.log(data);
                window.location.replace('<?=base_url();?>admin/opd_registration');
                          window.open('<?=base_url();?>admin/patient_ordered_test_info/'+data.order_id+'/'+data.patient_id,'_blank','width=560,height=340,toolbar=0,menubar=0,location=0');
              
              },
              error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
          });





      // var test_details_array = [];
   //          var tbl = document.getElementById("test_cart_table");
   //          var r_count = tbl.rows.length;

   //          for (var j = 1; j <= r_count - 6; j++) 
   //          {
   //              var test_id = tbl.rows[j].cells[1].children[0].value;
   //              var sub_test_id = tbl.rows[j].cells[1].children[0].value;
   //              var obj = {};
   //              test_details_array.push(obj);
   //          }
      });

});
    // function update_price_qty(row_id) 
    // {
    //      var quantity=$("#test_cart_qty_"+row_id).val();
    //      var price=$("#test_cart_price_"+row_id).val();

    //      $.ajax({
    //          url:"<?=site_url("admin/update_price_qty")?>",
    //          method:"POST",
    //          data:{row_id:row_id,price:price,quantity:quantity},
    //          success:function(data)
    //          {
    //            $('#test_cart_details').html(data);
    //          },
    //          error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
    //         });


    // }

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
      
      

      var due=parseFloat(net_total)-parseFloat(total_paid);

      $('#due').val(due.toFixed(2));
    }

</script>

</body>
</html>