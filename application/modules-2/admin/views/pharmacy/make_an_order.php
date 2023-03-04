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
              <div class="card-body">
                <!-- <div class="card-title">Simple usage</div> -->
                <table id="test_info_table" class="table table-bordered table-hover data-tables test_table_report"
                data-options='{ "paging": false; "searching":false}'>
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Code</th>
                    <th>Comp Name</th>
                    <th>Product Name</th>
                    <th>Unit</th>
                    <!-- <th>Price</th> -->
                    <th>Qty</th>
                    <th>Alert Qty</th>
                    <th>Add</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $i=1;
                  foreach ($product_list as $row) { ?> 
                    <tr>
                  
                      <td><?=$i?></td>
                      <td><?=$row['p_code'];?></td>
                      <td>
                        <?=$row['comp_name'];?>
                      </td>

                      <td>
                        <a href="admin/edit_product/<?=$row['id']?>" target="_blank" class="hide-option" title="Click to see the Product details"><?=$row['p_name'];?></a>
                      </td>

                      <!--   <td class="hidden-480"><?=$row['sub_cat_name'];?></td> -->
                      <td><?=$row['unit'];?></td>

                      <!-- <td><?=number_format($row['p_sell_price'],2);?> ৳</td> -->

                      <td class="hidden-480">
                        <span  class="badge <?php  if($row['p_current_stock']>$row['p_reorder_qty']){ echo "badge-success";} else { echo "badge-danger";}?>">
                          <?=$row['p_current_stock'];?>&nbsp;
                          <i class="ace-icon fa <?php if($row['p_current_stock']>$row['p_reorder_qty']){ echo "fa-arrow-up";}else{echo "fa-arrow-down";}?>"></i>
                        </span>
                      </td>

                      <td><span class="badge badge-dark"><?=$row['p_reorder_qty'];?></span></td>

                      <td>
                        <button  class="btn btn-xs btn-primary add_to_bill"  data-product_id="<?=$row['id']?>"   data-product="<?=$row['p_name']?>" data-comp_id="<?=$row['p_company_id']?>" data-comp_name="<?=$row['comp_name']?>" data-unit_id="<?=$row['p_unit_id']?>" data-unit="<?=$row['unit']?>"
                          >
                          <i class="ace-icon fa fa-plus"></i>
                          Add
                          <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                        </button>
                      </td>
                    </tr>
                    <?php $i++; } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Second Col 2 -->

          <div class="col-md-5">
            <form action="admin/make_an_order_post" method="post">
              <div class="card my-3 no-b">
                <div class="card-body">
                  <div class="row" style="padding:15px;">
                    <div class="col-md-10 mb-4" id="supp_list_div">
                      <label for="supp_id">Supplier Name:</label>
                      <select id="supp_id" required=""  name="supp_id" class="chosen-select custom-select select2 form-control">
                        <option value=""></option>
                        <?php foreach ($supplier_list as $row) { ?>
                          <option value="<?=$row['id'];?>#<?=$row['supp_name'];?>"><?=$row['supp_name'];?></option>
                        <?php } ?> 

                      </select> 
                    </div>

                  </div>
                </div>
              </div>
              <div class="card my-3 no-b">
                <div class="card-body" >
                  <div id="order_cart_details">
                    <?php $this->load->view('pharmacy/order_cart_details'); ?>

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


      $(document).on('change','#customer_name', function(event)
      {        


       if($(this).find(":selected").val()=='new_cust'){

        window.location="admin/add_customer";


      }
    });

      $(document).on('click', '.add_to_bill', function()
      {

        var p_name=$(this).data('product');
        var comp_name=$(this).data('comp_name');
        var p_id=$(this).data('product_id');
        var comp_id=$(this).data('comp_id');
        var comp_name=$(this).data('comp_name');
        var unit=$(this).data('unit');
        var unit_id=$(this).data('unit_id');

        $.ajax({
          url:"<?=site_url("admin/add_order_cart")?>",
          method:"POST",
          dataType:"html",
          data:{p_id:p_id,p_name:p_name,comp_id:comp_id,comp_name:comp_name,unit:unit,unit_id:unit_id},
          success:function(data)
          {
              //console.log(data);
              $('#order_cart_details').html(data);

            },
            error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
          });

      });



      $(document).on('click', '.remove_product', function()
      {
        var row_id = $(this).attr("id");
        alertify.confirm('<b>Delete Confirmation</b>',"Are you sure you want to remove this?",
          function(){
          //alertify.success('Ok');
          $.ajax({
            url:"<?=site_url()?>admin/remove_order_cart",
            method:"POST",
            dataType:"html",
            data:{row_id:row_id},
            success:function(data)
            {
              $('#order_cart_details').html(data);
            },
            error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
          });
        },
        function(){
          //alertify.error('Cancel');
        });

      });


    //   var order_id=$('#order_id').val();

    //   if(order_id != "")
    //   {
    //   // alert(ipd_patient_id);

    //   window.open('<?=base_url();?>admin/order_phar_pdf/'+order_id,'_blank','width=560,height=340,toolbar=0,menubar=0,location=0');


    // }


  });

</script>

<script type="text/javascript">
  function update_qty(row_id,p_id)
  {

    var qty = $('#order_cart_qty_'+p_id).val();

    $.ajax({
      url: "<?php echo site_url('admin/update_order_cart');?>",
      type: "post",
      data: {row_id:row_id,qty:qty,p_id:p_id},
      success: function(data)
      {
        $('#order_cart_details').html(data);

      }      
    });  

  }
</script>



</body>
</html>