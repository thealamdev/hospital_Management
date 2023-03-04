
<form  action="admin/insert_purchage_product" method="post">
  <br>
  <div class="col-md-10 offset-md-1">
    <div class="row">
      <div class="col-md-4" id="supplier_div">
        <label for="supplier_name">Supplier Name:</label>
        <select required id="supplier_name" name="supp_id" class="chosen-select custom-select select2 form-control">  <option value=""></option>
          <?php foreach ($supplier_list as $row) { 

            if($row['id']==$buy_details[0]['supp_id']){ ?>
             <option selected="" value="<?=$row['id'];?>"><?=$row['supp_name'];?></option>

           <?php } else { ?>


           <?php }

           ?>
           <option value="<?=$row['id'];?>"><?=$row['supp_name'];?></option>
         <?php } ?>

         <option value="new_supp">Add New Supplier</option>
       </select> 
     </div>  
     <div class="col-md-4">
      <label for="product_category">Purchase Date:</label>
      <div class="input-group focused">
        <input type="text"  name="purchase_date" class="date-time-picker form-control" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}" value="<?=date("d-m-Y", strtotime($buy_details[0]['created_at']));?>" required>
        <span class="input-group-append">
          <span class="input-group-text add-on white">
            <i class="icon-calendar"></i>
          </span>
        </span>
      </div>
    </div>


    <div class="col-md-4">
      <label for="product_category">Bill No:</label>
      <div class="input-group focused">
        <input required="" id="bill_no" name="bill_no"  type="text"  class="form-control" value="<?=$buy_details[0]['bill_no'];?>">
        <span class="input-group-append">
          <span class="input-group-text add-on white">
            <i class="ace-icon fa fa-paper-plane"></i>
          </span>
        </span>
      </div>

    </div>
  </div>


  <div class="space-6"></div>
  <div class="row mt-3">
    <div class="col-md-12">
      <table class="table table-striped table-bordered mytable_style table-hover sell_cart">
        <thead>
          <tr>
            <th>S.L</th>
            <th style="width:25%;">Product Name</th>
            <th style="width:10%;">Unit</th>
            <th style="width:15%;">Price</th>
            <th style="width:10%;">Qty</th>
            <th style="width:20%;">Price*Qty</th>
            <th style="width:30%;">Expire Date</th>
            <th style="width:5%;">Action</th>
          </tr>
        </thead>
        <tbody class="mytable_style" id="dynamic_row">

          <?php foreach ($buy_details as $key => $value) { ?>

            <tr>
              <td>1</td>
              <td>
                <select required  id="product_id_<?=$key?>" name="p_id[]" class="chosen-select custom-select select2 form-control product_list">
                  <option value=""></option>
                  <?php foreach ($product_list as $row) { 

                    if($value['p_id']==$row['id'])
                      { ?>

                        <option selected="" value="<?=$row['id'];?>"><?=$row['p_name'];?></option>
                      <?php } else { ?>

                        <option  value="<?=$row['id'];?>"><?=$row['p_name'];?></option>

                      <?php }

                      ?>
                 
                    <?php } ?>
                  </select> 
                </td>
                <td id="product_unit_0" class="align-center"></td>
                <td>
                  <div class="input-group icon_tag_input">
                    <input name="buy_price[]" id="product_price_0" readonly value="0.00" class="form-control align-right" type="text">
                    <span class="input-group-addon">৳</span>
                  </div>
                </td>
                <td><input oninput="qty_update_calculation(0)" name="buy_qty[]" id="product_qty_0" class="form-control sell_cart_input" type="number" value="0"></td>
                <td>
                  <div class="input-group icon_tag_input">
                    <input id="product_price_qty_0" readonly value="0.00" class="form-control align-right subtotal" type="text" >
                    <span class="input-group-addon">৳</span>
                  </div>
                </td>

                <td><div class="input-group focused">
                  <input type="text" name="expire_date" class="date-time-picker form-control" required="" data-options="{&quot;timepicker&quot;:false, &quot;format&quot;:&quot;Y-m-d&quot;}">
                  <span class="input-group-append">
                    <span class="input-group-text add-on white">
                      <i class="icon-calendar"></i>
                    </span>
                  </span>
                </div></td>
                <td>

                  <a class="add_row btn btn-success btn-xs">
                    <i class="fa fa-plus"></i>
                  </a >


                </td>
              </tr>


            <?php } ?>

          </tbody>
          <tr>
            <td colspan="5" align="right"><strong>Total:</strong></td>
            <td style="width:130px;">
              <div class="input-group icon_tag_input">
                <input name="credit" id="total" readonly value="<?=number_format(0,2);?>" class="form-control align-right" type="text">
                <span class="input-group-addon">৳</span>
              </div>
            </td>

          </tr>

          <tr>
            <td colspan="5" align="right"><strong>Paid:</strong></td>
            <td>
              <div class="input-group icon_tag_input">
                <input name="debit" value="0.00" onchange="due_advance_calculation()" id="paid" class="form-control align-right" type="text">
                <span class="input-group-addon">৳</span>
              </div>
            </td>

          </tr>



          <tr>
            <td colspan="5" align="right"><strong id="remain_label"> Due/Advance:</strong></td>
            <td>
              <div class="input-group icon_tag_input">
                <input id="remain_val" readonly class="form-control align-right" type="text">
                <span class="input-group-addon">৳</span>
              </div>
            </td>

          </tr>


          <tr>
            <td colspan="5" align="right"><strong id="remain_label"> Unload Cost:</strong></td>
            <td >
              <div class="input-group icon_tag_input">
                <input value="0.00" id="unload_cost" name="unload_cost" class="form-control" type="text">
                <span class="input-group-addon">৳</span>
              </div>
            </td>

          </tr>



        </table>
      </div>
    </div>

    <div class="row" id="validation_err_msg">


    </div>

    <div class="col-md-12" align="center">

      <div class="col-md-offset-4 col-md-4" >
        <button class="btn btn-white btn-primary btn-bold">
          <i class="ace-icon glyphicon glyphicon-list"></i>
          Purchase Products
        </button>
      </div>
    </div>
  </div>

</form>
