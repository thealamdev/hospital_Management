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
      <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
    <?php } ?>
    <?php echo validation_errors(); ?>

    <div class="section-wrapper">
      <div class="container-fluid">
        <div class="row" >
         <div class="col-md-6">
          <div class="card no-b">
            <div class="card-body" style="margin: 0px;">
              <!-- <div class="card-title">Simple usage</div> -->
              <table id="test_info_table" data-page-length="5" class="table table-bordered table-hover data-tables"
              >
              <thead>
                <tr>
                  <th>SL NO</th>
                  <th>Test Category</th>
                  <th>Test Name</th>                       
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

        <div class="col-md-6">
         <div class="card no-b">
          <div class="card-body" >
            <div id="test_cart_details">
              <?php $this->load->view('opd/check_opd_test_info_ajax_cart'); ?>

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


  /*.pagination
  {
    display: none !important;
  }

  .dataTables_info
  {
    display: none !important;
    }*/
  </style>
  <?php $this->load->view('back/footer_link');?>

  <script type="text/javascript">


    $(document).ready(function()
    {
      var sum=0;
      var rowCount =$('#test_cart_table tr').length;
      var table = document.getElementById('test_cart_table');

      
      $(document).on('click', '.add_this_test', function()
      {

        var sum=0;
        var sum_sub=0;
        var test_name=$(this).data('test');
        var sub_test_id=$(this).data('sub_test_id');
        var test_price=$(this).data('price');
        var test_id=$(this).data('test_id');
        var quk_ref_com=$("#quack_"+sub_test_id).val();
        var quantity="1";


        $.ajax({
          url:"<?=site_url("admin/add_check_test_info")?>",
          method:"POST",
          dataType:"html",
          data:{test_id:test_id,sub_test_id:sub_test_id, test_name:test_name, test_price:test_price,quk_ref_com:quk_ref_com,quantity:quantity},
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

                for(var i=1;i<rowCount-9;i++)
                {

                 table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(rowCount-10)).toFixed(2));

                  // table.rows[i].cells[5].innerHTML=parseFloat(parseFloat(table.rows[i].cells[2].children[0].value)-((parseFloat(discount)/(rowCount-10)))).toFixed(2);

                  table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(rowCount-10)).toFixed(2));

                  table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat(table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);

                  // sub com

                  if( $('#discount_commission_type').val() == 1)
                  {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML))).toFixed(2);
                 }
                 else 
                 {
                   table.rows[i].cells[7].innerHTML=(parseFloat(table.rows[i].cells[6].innerHTML)-(parseFloat(table.rows[i].cells[4].innerHTML)/2)).toFixed(2);
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
              

              for(var i=1;i<rowCount-9;i++)
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
});

$(document).on('click', '.remove_test', function()
{
  var row_id = $(this).attr("id");
  var sum=0;
  var sum_sub=0;
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

                for(var i=1;i<rowCount-9;i++)
                {

                 table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(rowCount-10)).toFixed(2));

                  // table.rows[i].cells[5].innerHTML=parseFloat(parseFloat(table.rows[i].cells[2].children[0].value)-((parseFloat(discount)/(rowCount-10)))).toFixed(2);

                  table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(rowCount-10)).toFixed(2));

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

              for(var i=1;i<rowCount-9;i++)
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
          //alertify.error('Cancel');
        });

});


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
     // alert(rowCount);

     for(var i=1;i<rowCount-9;i++)
     {
      // divide discount for all

      table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(rowCount-10)).toFixed(2));

      // net amount

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


     }

     var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

     $('#net_total').val(net_total.toFixed(2));
     total_paid();


     for(var i=1;i<rowCount-9;i++)
     {

      sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
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
     // alert(rowCount);

     for(var i=1;i<rowCount-9;i++)
     {

      table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(rowCount-10)).toFixed(2));

      table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);
      
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
 var discount;
 var vat;
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

  discount=parseFloat((parseFloat(total)*parseFloat(discount_percent)/100));
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
     // alert(rowCount);

     for(var i=1;i<rowCount-9;i++)
     {

      table.rows[i].cells[4].innerHTML=((parseFloat(discount)/(rowCount-10)).toFixed(2));

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

   }


   var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

   $('#net_total').val(net_total.toFixed(2));

   total_paid();

   for(var i=1;i<rowCount-9;i++)
   {

    sum_sub=parseFloat(sum_sub)+parseFloat(table.rows[i].cells[7].innerHTML);
               // alert(sum);
             }


             $("#sub_c_o").val(sum_sub.toFixed(2));

             sum_sub=0;


           });



$(document).on('input', '#vat_percent', function()
{

 var total=$(this).data('total');
         // var discount_percent;
         var vat_percent;

         var vat;
         
         $('#vat_store_per').val("");

         if($('#vat_percent').val()=="")
         {
          vat=0;

          $("#vat_store").val("");
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
     // alert(rowCount);

     for(var i=1;i<rowCount-9;i++)
     {

      table.rows[i].cells[3].innerHTML=((parseFloat(vat)/(rowCount-10)).toFixed(2));

      table.rows[i].cells[5].innerHTML=(parseFloat(table.rows[i].cells[2].children[0].value)+(parseFloat( table.rows[i].cells[3].innerHTML)-(parseFloat( table.rows[i].cells[4].innerHTML)))).toFixed(2);
      
    }

    var net_total=(parseFloat(total)+parseFloat(vat))-parseFloat(discount);

    $('#net_total').val(net_total.toFixed(2));
    total_paid();




  });

$(document).on('click', '#save_button', function()  
{


  if($("#discount").val() != "" && $("#discount_ref").val() == "")
  {
    alertify.alert("<b>Discount Reference can not be empty</b>");

  }

  else 
  {

    $('#save_button').prop("disabled",true);

    var patient_id=$("#patient_id").val();
    var age=$("#age").val();
    var total_discount=$("#discount").val();
    var ref_doc_name=$("#ref_doc_name").val();
    var quack_doc_name=$("#quack_doc_name").val();
    var ipd_patient_id=$("#ipd_patient_id").val();

    var ref_doc_id=$("#ref_doc_id").val();
    var quack_doc_id=$("#quack_doc_id").val();

    var paid_amount =$("#total_paid").val();
    var total_amount=$("#total_amount").val();
    var vat=$("#vat").val();

    var discount_ref=$("#discount_ref").val();


    var total_gross_com=$("#total_c_o").val();


      // var discount_ref=$("#discount_ref").val();

      var net_total=$("#net_total").val();

      var due=$("#due").val();

      var total_c_o=$("#total_c_o").val();

      var is_ipd_patient=$("#is_ipd_patient").val();


      $.ajax({
        url:"<?=site_url("admin/save_test_order_info")?>",
        method:"POST",
        dataType:"json",
        data:{age:age,vat:vat,patient_id:patient_id,total_discount:total_discount,paid_amount:paid_amount,total_amount:total_amount,total_c_o:total_c_o,quack_doc_name:quack_doc_name,ref_doc_name:ref_doc_name,ref_doc_id:ref_doc_id,quack_doc_id:quack_doc_id,due:due,net_total:net_total,total_gross_com:total_gross_com,discount_ref:discount_ref,ipd_patient_id:ipd_patient_id,is_ipd_patient:is_ipd_patient},
        success:function(data)
        {
                // var obj=$.parseJSON(data);
                //console.log(data);

                window.open('<?=base_url();?>admin/patient_ordered_test_info/'+data.order_id+'/'+data.patient_id+'/'+ is_ipd_patient,'_blank','width=560,height=340,toolbar=0,menubar=0,location=0');

                window.location.replace('<?=base_url();?>admin/opd_registration');



              },
              error: function(xhr, textStatus, error){ console.log(xhr.statusText); console.log(textStatus); console.log(error); }
            });

    }

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



  var due=parseFloat(net_total)-parseFloat(total_paid);

  $('#due').val(due.toFixed(2));
}

</script>


</body>
</html>