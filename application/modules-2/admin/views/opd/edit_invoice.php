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

   <?php if (isset($message)) {?>
    <CENTER>
     <h3 style="color:green;"><?php echo $message ?></h3>
   </CENTER>
   <br>
 <?php } ?>
 <?php echo validation_errors(); ?>
 <div class="section-wrapper">
   <div class="container-fluid">
    <div class="row my-2">
     <!-- first COl 1 -->
     <div class="col-md-6">
      <div class="card  no-b">
       <div class="card-body" id="all_test">
        <!-- <div class="card-title">Simple usage</div> -->
        <?php $this->load->view('opd/opd_edit_invoice_all_test'); ?>
      </div>
    </div>
  </div>
  <!-- Second Col 2 -->
  <div class="col-md-6">
    <form action="admin/update_opd_order_data" method="post" id="my_form">
     <div class="card  no-b">
      <div class="card-body">
       <div class="row pl-2" >
        <div class="col-md-4" id="customer_list_div">
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

        <input type="hidden" id="long_order_id" name="long_order_id">

        <input type="hidden" id="discount_commission_type" value="<?=$discount_commission_type[0]['type']?>" name="discount_commission_type">



        <div class="col-md-4">
          <label for="ref_doc_name">Dr. Name:</label>
          <select id="ref_doc_name"  name="ref_doc_name" class="chosen-select custom-select select2 form-control" required>
            <option value=""></option>

          </select>


        </div>

        <div class="col-md-4">
          <label for="quack_doc_name">Ref Dr. Name:</label>
          <select id="quack_doc_name"  name="quack_doc_name" class="chosen-select custom-select select2 form-control" required>
            <option value=""></option>

          </select>


        </div>

        <input type="hidden" value="" id="delete_t_id_list" name="delete_t_id_list">






        <input type="hidden" id="table_length" name="table_length">

        <!-- <input type="text" id="test_id" name="test_id"> -->


      </div>
    </div>
  </div>

  <input type="hidden"  name="discount_store" id="discount_store">

  <input type="hidden" name="discount_store_per" id="discount_store_per">


  <input type="hidden"  name="vat_store" id="vat_store">

  <input type="hidden" name="vat_store_per" id="vat_store_per">



  <div class="card my-1 no-b">
    <div class="card-body" > 

     <div id="test_cart_details">

      <?php $this->load->view('opd/opd_edit_invoice_cart_details'); ?>
    </div>




    <div align="right" id="save_button_div">
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
    padding-top: 5px !important;
    padding-bottom:5px !important;
    padding-left: 5px !important;
    padding-right:5px !important;

  }

  .col-md-12{
   padding-top: 5px !important;
   padding-bottom: 5px !important;

   padding-left: 5px !important;
   padding-right:5px !important;

 }

 .col-md-5{


   padding-left: 5px !important;
   padding-right:5px !important;

 }

 .col-md-7{

   padding-bottom: 0px !important;


 }

 .form-group{

   margin-bottom: 5px !important;


 }

 .col-md-8{

   padding-bottom: 0px !important;


 }

 .col-md-6{
  padding-left: 5px !important;
  padding-right:5px !important;


}

.col-md-4{
  padding-left: 5px !important;
  padding-right:5px !important;
  padding-bottom: 0px !important;

}

.col-md-3{
  padding-left: 5px !important;
  padding-right:5px !important;

}
</style>
<?php $this->load->view('back/footer_link');?>
<script type="text/javascript">


  $(document).ready(function()
  {

    $('#my_form').submit(function () {

      if(parseInt($("#total_paid").val()) > parseInt($("#net_total").val()))
      {
        alertify.alert("<b>Total Paid Cant Be Greater Than Net Total</b>");

        return false;
      }

    });


    $('#loader_div').hide();

    var bill_no=$('#bill_no').find(":selected").text();



    if(bill_no!="")
    {

      fun_cart();
    }



    $(document).on('change','#bill_no', function(event)
    { 
      // alert(bill_no);

      fun_cart();

    });


    $(document).on('change','#quack_doc_name', function(event)
    { 

     var quack_doc_id=$('#quack_doc_name').find(":selected").val();

     if(quack_doc_id!="")
     {
      $.ajax({
        url:"<?=site_url()?>admin/edit_opd_invoice_ajax",
        method:"POST",
        dataType:"html",
        data:{quack_doc_id:quack_doc_id},
        success:function(data)
        {
          if ($.fn.DataTable.isDataTable("#test_info_table")) {
            $('#test_info_table').DataTable().clear().destroy();
          }

          $('#all_test').html(data);

          $("#test_info_table").dataTable({});

        }
      });
    }

    var rowCount =$('#test_cart_table tr').length;
    var table = document.getElementById('test_cart_table');
    var main_test =$('#main_test').val();

    var test_row=main_test;

    for(var i=1;i<=main_test;i++)
    {

      var test_id=table.rows[i].cells[9].innerHTML;
      var test_name=table.rows[i].cells[1].innerHTML;
      var row_id=table.rows[i].cells[10].innerHTML;
      var type=table.rows[i].cells[11].innerHTML;
      var price=table.rows[i].cells[2].firstChild.value;

      // var doc_id=$(this).find('option:selected');
      var doc_id=$(this).find(":selected").val().split('#')[0];

      var total_discount=$('#discount').val();
      var vat=$('#vat').val();
      var total_pa=$('#total_paid').val();


      $.ajax({  
        url:"<?=site_url('admin/get_com_this_test')?>",  
        method:"post",  
        dataType:"html",  
        data:{test_id:test_id,doc_id:doc_id,price:price,row_id:row_id,total_discount:total_discount,vat:vat,total_pa:total_pa,test_row:test_row,test_name:test_name,type:type},
        success:function(val)  
        { 

         $('#test_cart_details').html(val);

       }
     });

    }

  });

    $(document).on('change','#quack_doc_name', function(event)
    { 


      $('#save_button').attr("disabled", true);

      window.setTimeout(function() {
       var rowCount =$('#test_cart_table tr').length;
       var table = document.getElementById('test_cart_table');
       var main_test =$('#main_test').val();


       var sum=0;
       var sum_sub=0;

       for(var i=1;i<=main_test;i++)
       {
        sum=parseFloat(sum)+parseFloat(table.rows[i].cells[6].innerHTML);
        sum_sub+=parseFloat(table.rows[i].cells[7].innerHTML);

      }

      

      $("#total_c_o").val(sum.toFixed(2));
      $("#sub_c_o").val(sum_sub.toFixed(2));

      sum=0;
      sum_sub=0;

      $('#loader_div').show();

      $('#save_button').attr("disabled", false);

    }, 4000);

      
    });

    $(document).on('click', '.add_this_test', function()
    {
      var sum=0;
      var test_name=$(this).data('test');
      var sub_test_id=$(this).data('sub_test_id');
      var test_price=$(this).data('price');
      var test_id=$(this).data('test_id');
      var type=$(this).data('type');


      var quk_ref_com=$("#quack_"+sub_test_id).val();
      var quantity="1";
      var sum_sub=0;
      var doc_id=$('#quack_doc_name').find(":selected").val().split('#')[0];

      var total_discount=$('#discount').val();
      var vat=$('#vat').val();
      var total_pa=$('#total_paid').val();

      var rowCount =$('#test_cart_table tr').length;
      var table = document.getElementById('test_cart_table');

      var main_test =$('#main_test').val();

      var test_row=main_test;


      $.ajax({
        url:"<?=site_url("admin/add_edit_invoice")?>",
        method:"POST",
        dataType:"html",
        data:{test_id:test_id,sub_test_id:sub_test_id, test_name:test_name, test_price:test_price,quk_ref_com:quk_ref_com,quantity:quantity,total_discount:total_discount,vat:vat,total_pa:total_pa,doc_id:doc_id,test_row:test_row,type:type},
        success:function(data)
        {

          $('#test_cart_details').html(data);
                  // discount

                  var dis=$("#discount_store").val();

                  var dis_per=$("#discount_store_per").val();
                  $("#discount_percent").val(dis_per);
                  var total=$('#total_amount').val();

                  if(dis_per!="")
                  {
                    dis=parseFloat(total)*parseFloat(dis_per)/100;
                  }

                  $("#discount").val(dis);

                  var discount=dis;

                  var rowCount=$('#test_cart_table tr').length;
                  var table = document.getElementById('test_cart_table');

                  if(discount=="")
                  {
                    discount=0;
                  }


                // vat ....

                var va=$("#vat_store").val();

                var vat_per=$("#vat_store_per").val();

                $("#vat_percent").val(vat_per);



                if(vat_per!="")
                {
                  va=parseFloat(total)*parseFloat(vat_per)/100;
                }


                $("#vat").val(va);

                
                var vat=va;

                var rowCount =$('#test_cart_table tr').length;
                var table = document.getElementById('test_cart_table');
                var main_test =$('#main_test').val();

                if(vat=="")
                {
                  vat=0;
                }



                for(var i=1;i<=main_test;i++)
                {

                 table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(main_test)).toFixed(2));

                  // table.rows[i].cells[5].innerHTML=parseFloat(parseFloat(table.rows[i].cells[2].children[0].value)-((parseFloat(discount)/(rowCount-10)))).toFixed(2);

                  table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(main_test)).toFixed(2));

                  table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

                  // sub com

                  if($('#discount_commission_type').val() == 1)
                  {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
                 }
                 else 
                 {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
                 }

                 if(table.rows[i].cells[7].innerHTML < 0)
                 {
                  table.rows[i].cells[7].innerHTML=0;
                }

              }


              if(vat=="")
              {
                vat=0;
              }

              if(discount=="")
              {
                discount=0;
              }


              var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

              $('#net_total').val(net_total.toFixed(2));
              total_paid();



              var rowCount =$('#test_cart_table tr').length;
              var table = document.getElementById('test_cart_table');

              for(var i=1;i<=main_test;i++)
              {
                sum=parseFloat(sum)+parseFloat(table.rows[i].cells[6].innerHTML);
                sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
             }

             $("#total_c_o").val(sum.toFixed(2));
             $("#sub_c_o").val(sum_sub.toFixed(2));
             sum=0;

             sum_sub=0;



           }

         });

});

$(document).on('click', '.remove_test', function()
{
  var row_id = $(this).attr("row_id");

  var t_id = $(this).attr("t_id");
  var sum_sub=0;

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


                     // discount

                     var dis=$("#discount_store").val();

                     var dis_per=$("#discount_store_per").val();
                     $("#discount_percent").val(dis_per);
                     var total=$('#total_amount').val();

                     if(dis_per!="")
                     {
                      dis=parseFloat(total)*parseFloat(dis_per)/100;
                    }

                    $("#discount").val(dis);


                    var discount=dis;

                    var rowCount=$('#test_cart_table tr').length;
                    var table = document.getElementById('test_cart_table');
                 // alert(rowCount);

                 if(discount=="")
                 {
                  discount=0;
                }


                // vat ....

                var va=$("#vat_store").val();

                var vat_per=$("#vat_store_per").val();

                $("#vat_percent").val(vat_per);



                if(vat_per!="")
                {
                  va=parseFloat(total)*parseFloat(vat_per)/100;
                }


                $("#vat").val(va);

                
                var vat=va;

                var rowCount =$('#test_cart_table tr').length;
                var table = document.getElementById('test_cart_table');
                 // alert(rowCount);

                 if(vat=="")
                 {
                  vat=0;
                }

                var main_test=$('#main_test').val();

                for(var i=1;i<=main_test;i++)
                {

                 table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(main_test)).toFixed(2));

                  // table.rows[i].cells[5].innerHTML=parseFloat(parseFloat(table.rows[i].cells[2].children[0].value)-((parseFloat(discount)/(rowCount-10)))).toFixed(2);

                  table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(main_test)).toFixed(2));

                  table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

                  // sub com

                  if( $('#discount_commission_type').val() == 1)
                  {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
                 }
                 else 
                 {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
                 }

                 if(table.rows[i].cells[7].innerHTML < 0)
                 {
                  table.rows[i].cells[7].innerHTML=0;
                }

              }


              if(vat=="")
              {
                vat=0;
              }

              if(discount=="")
              {
                discount=0;
              }


              var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

              $('#net_total').val(net_total.toFixed(2));
              total_paid();


              var rowCount =$('#test_cart_table tr').length;
              var table = document.getElementById('test_cart_table');

              for(var i=1;i<=main_test;i++)
              {
                sum=parseFloat(sum)+parseFloat(table.rows[i].cells[6].innerHTML);
                sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
             }

             $("#total_c_o").val(sum.toFixed(2));
             $("#sub_c_o").val(sum_sub.toFixed(2));
             sum=0;
             sum_sub=0;

           },
           error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
         });
},
function(){

});

});



          // ******************* New ******************


          $(document).on('input', '#discount', function()
          {
            var discount;
            var vat;
            var total=$(this).data('total');
            var sum_sub=0;

            $('#discount_percent').val("");

            $('#discount_store_per').val("");


            if($('#discount').val()=="")
            {
              discount=0;
              $('#discount_store').val("");
            }
            else
            {
              discount=$('#discount').val();
              $('#discount_store').val(discount);


            }
            if($('#vat').val()=="")
            {
              vat=0;
            }
            else
            {
              vat=$('#vat').val();

            }


            var rowCount =$('#test_cart_table tr').length;
            var table = document.getElementById('test_cart_table');

            var main_test=$('#main_test').val();


            for(var i=1;i<=main_test;i++)
            {

              table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(main_test)).toFixed(2));

              table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

      // sub com

      if( $('#discount_commission_type').val() == 1)
      {
       table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
     }
     else 
     {
       table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
     }

     if(table.rows[i].cells[7].innerHTML < 0)
     {
      table.rows[i].cells[7].innerHTML=0;
    }
  }

  var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

  $('#net_total').val(net_total.toFixed(2));
  total_paid();

  for(var i=1;i<=main_test;i++)
  {

    sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);

  }


  $("#sub_c_o").val(sum_sub.toFixed(2));

  sum_sub=0;



});

          $(document).on('input', '#vat', function()
          {

            var discount;
            var vat;
            var total=$(this).data('total');

            $('#vat_percent').val("");
            $('#vat_store_per').val("");


            if($('#discount').val()=="")
            {
              discount=0;
            }
            else
            {
              discount=$('#discount').val();

            }
            if($('#vat').val()=="")
            {
              vat=0;
              $('#vat_store').val("");
            }
            else
            {
              vat=$('#vat').val();
              $('#vat_store').val(vat);
            }



            var rowCount =$('#test_cart_table tr').length;
            var table = document.getElementById('test_cart_table');

            var main_test=$('#main_test').val();

            


            for(var i=1;i<=main_test;i++)
            {

              table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(main_test)).toFixed(2));

              table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat(table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

            }

            var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

            $('#net_total').val(net_total.toFixed(2));
            total_paid();


          });

          $(document).on('input', '#total_paid', function()
          {
            total_paid();
          });


          $(document).on('input', '#discount_percent', function()
          {

           var total=$(this).data('total');
           var sum_sub=0;
           var discount_percent;
           $('#discount_store_per').val("");

           if($('#discount_percent').val()=="")
           {
            discount=0;
            $("#discount").val("");
            $("#discount_store").val("");
          }
          else
          {
            discount_percent=$('#discount_percent').val();
            $('#discount_store_per').val(discount_percent);

            var discount=parseFloat((parseFloat(total)* parseFloat(discount_percent)/100));
            $("#discount").val(discount);
            $("#discount_store").val(discount);

          }

          if($('#vat').val()=="")
          {
            vat=0;
          }
          else
          {
            vat=$('#vat').val();

          }

          var rowCount =$('#test_cart_table tr').length;
          var table = document.getElementById('test_cart_table');
          var main_test=$('#main_test').val();


          for(var i=1;i<=main_test;i++)
          {

            table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(main_test)).toFixed(2));

            table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

       // sub com

       if( $('#discount_commission_type').val() == 1)
       {
         table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
       }
       else 
       {
         table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
       }

       if(table.rows[i].cells[7].innerHTML < 0)
       {
        table.rows[i].cells[7].innerHTML=0;
      }

    }


    var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

    $('#net_total').val(net_total.toFixed(2));
    total_paid();

    for(var i=1;i<=main_test;i++)
    {

      sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
             }


             $("#sub_c_o").val(Math.round(sum_sub).toFixed(2));

             sum_sub=0;

           });



          $(document).on('input', '#vat_percent', function()
          {

           var total=$(this).data('total');
         // var discount_percent;
         var vat_percent;

         if($('#vat_percent').val()=="")
         {
          vat=0;
          $("#vat").val("");
        }
        else
        {
          vat_percent=$('#vat_percent').val();
          $('#vat_store_per').val(vat_percent);
          var vat=parseFloat((parseFloat(total)*parseFloat(vat_percent)/100));

          $("#vat").val(vat);
          $("#vat_store").val(vat);

        }

        if($('#discount').val()=="")
        {
          discount=0;
        }
        else
        {
          discount=$('#discount').val();

        }



        var rowCount =$('#test_cart_table tr').length;
        var table = document.getElementById('test_cart_table');
        var main_test=$('#main_test').val();


        for(var i=1;i<=main_test;i++)
        {

          table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(main_test)).toFixed(2));

          table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

        }

        var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

        $('#net_total').val(net_total.toFixed(2));
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


        function fun_cart(argument) {


          var rowCount1=0;

          var sum=0;
          var sum_sub=0;


          var bill_no=$('#bill_no').find(":selected").text();

          $('#long_order_id').val(bill_no);

          $.ajax({
            url:"<?=site_url("admin/get_info_by_invoice_opd")?>",
            method:"POST",
            dataType:"html",
            data:{bill_no:bill_no},
            success:function(data)
            {
              $('#test_cart_details').html(data);

              rowCount1 =$('#test_cart_table tr').length;
              var table = document.getElementById('test_cart_table');

              $('#table_length').val(rowCount1);
              var main_test= $('#main_test').val();

              // var all_id="";

              // for (var i =1; i <=main_test ; i++) {

              //     var test_id=parseInt(table.rows[i].cells[9].innerHTML);

              //     if(i==1)
              //     {
              //      all_id=test_id;

              //        }
              //        else
              //        {
              //          all_id=all_id+'#'+test_id;
              //        }

              //      }

                   // $('#test_id').val(all_id);


                   $.ajax({
                    url:"<?=site_url("admin/get_patient_info_by_bill")?>",
                    method:"POST",
                    dataType:"json",
                    data:{bill_no:bill_no},
                    success:function(val)
                    {

                      $("#ref_doc_name").empty();
                      $("#quack_doc_name").empty();

                      $("#ref_doc_name").append('<option selected value="' + 0 +'#self">self</option>');

                      if(val['patient_info'][0]['ref_doc_id']==0)
                      {
                        $("#ref_doc_name").empty();
                        $("#ref_doc_name").append('<option selected value="' + 0 +'#self">self</option>');
                      }

                      $.each(val['doctor_info'], function (key, value) {

                        if(val['patient_info'][0]['ref_doc_id']==value['doctor_id'])
                        {
                          $("#ref_doc_name").append('<option selected value="' + value.doctor_id +'#'+value.doctor_title+ '">' + value.doctor_title + '</option>');
                        }

                        else
                        {
                         $("#ref_doc_name").append('<option  value="' + value.doctor_id +'#'+value.doctor_title+ '">' + value.doctor_title + '</option>');
                       }

                     });


                      $("#quack_doc_name").append('<option selected value="' + 0 +'#self">self</option>');

                      if(val['patient_info'][0]['quack_doc_id']==0)
                      {
                       $("#quack_doc_name").empty();
                       $("#quack_doc_name").append('<option selected value="' + 0 +'#self">self</option>');
                     }


                     $.each(val['doctor_info'], function (key, value) {

                      if(val['patient_info'][0]['quack_doc_id']==value['doctor_id'])
                      {
                        $("#quack_doc_name").append('<option selected value="' + value.doctor_id +"#"+value.doctor_title+ '">' + value.doctor_title + '</option>');
                      }
                      else
                      {
                       $("#quack_doc_name").append('<option  value="' + value.doctor_id +"#"+value.doctor_title+ '">' + value.doctor_title + '</option>');
                     }



                   });



                     var quack_doc_id=$('#quack_doc_name').find(":selected").val();



                     if(quack_doc_id!="")
                     {
                      $.ajax({
                        url:"<?=site_url()?>admin/edit_opd_invoice_ajax",
                        method:"POST",
                        dataType:"html",
                        data:{quack_doc_id:quack_doc_id},
                        success:function(data)
                        {
                          if ($.fn.DataTable.isDataTable("#test_info_table")) {
                            $('#test_info_table').DataTable().clear().destroy();
                          }

                          $('#all_test').html(data);

                          $("#test_info_table").dataTable({});

                        }
                      });
                    }

                  }

                });



                   $("#discount_store_per").val("");
                   $("#vat_store_per").val("");



               // discount


               $("#discount_store").val($("#discount").val());
               var dis=$("#discount_store").val();

               var dis_per=$("#discount_store_per").val();
               $("#discount_percent").val(dis_per);
               var total=$('#total_amount').val();

               if(dis_per!="")
               {
                dis=parseFloat(total)*parseFloat(dis_per)/100;
              }


              

                // $("#discount").val(dis);


                

                var discount=dis;

                var rowCount=$('#test_cart_table tr').length;
                var table = document.getElementById('test_cart_table');
                 // alert(rowCount);

                 if(discount=="")
                 {
                  discount=0;
                }


                // vat ....

                $("#vat_store").val($("#vat").val());

                var va=$("#vat_store").val();

                var vat_per=$("#vat_store_per").val();

                $("#vat_percent").val(vat_per);



                if(vat_per!="")
                {
                  va=parseFloat(total)*parseFloat(vat_per)/100;
                }

                var vat=va;

                var rowCount =$('#test_cart_table tr').length;
                var table = document.getElementById('test_cart_table');
                 // alert(rowCount);

                 if(vat=="")
                 {
                  vat=0;
                }

                if(discount=="")
                {
                  discount=0;
                }

                var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);



                $('#net_total').val(net_total.toFixed(2));
                total_paid();

                var main_test=$('#main_test').val();


                for(var i=1;i<=main_test;i++)
                {
                  sum=parseFloat(sum)+parseFloat(table.rows[i].cells[6].innerHTML);
                  sum_sub+=parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(table.rows[i].cells[7].innerHTML);
             }
             
             

             $("#total_c_o").val(sum.toFixed(2));
             $("#sub_c_o").val(sum_sub.toFixed(2));
             sum=0;

             sum_sub=0;



           }
         });

}


</script>





</body>
</html>