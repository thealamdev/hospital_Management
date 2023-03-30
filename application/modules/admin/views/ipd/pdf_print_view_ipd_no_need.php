<?php $this->load->view('back/header_link'); ?>
<body class="light">
<!-- Pre loader -->
<?php $this->load->view('back/loader'); ?>
 
<div id="app">
        <div class="section-wrapper">
          <div class="card  no-b">
          <div class="card-body">
          <div class="container">
          <div class="invoice white shadow">
             <div class="row pl-5 pr-5 pt-2">
              <div class="col-md-12">
                  <img class="mb-4" style="height:140px; width: 100%;" src="uploads/hospital_header/hos_erp_header.PNG" alt="">
              </div> 
             
            </div>

             <div class="row pl-5 pr-5">
              <div class="col-md-4"></div>
              <div class="col-md-9">
                <table>
                  <tbody>
                    <tr>
                      <td>Patient Name: </td>
                      <td><?=$patient_info[0]['patient_name']?></td>
                    </tr>
                    <tr>
                      <td>Age: </td>
                      <td><?=$patient_info[0]['age']?></td>
                    </tr>
                    <tr>
                      <td>Gender: </td>
                      <td><?=$patient_info[0]['gender']?></td>
                    </tr>
                     <tr>
                      <td>Date Of Birth: </td>
                      <td><?=date('d M,Y',strtotime($patient_info[0]['date_of_birth']))?></td>
                    </tr>
                     <tr>
                      <td>Mobile No: </td>
                      <td><?=$patient_info[0]['mobile_no']?></td>
                    </tr>
                    <tr>
                      <td>Address: </td>
                      <td><?=$patient_info[0]['address']?></td>
                    </tr>
                    
                  </tbody>
                </table>      
              </div>
              <div class="col-md-3">
                <table>
                  <tbody>
                     <tr>
                      <td>Booked By: </td>
                      <td><?=$patient_info[0]['operator_name']?></td>
                    </tr>
                    <tr>
                      <td>Ref Doctor Name: </td>
                      <td><?=$patient_info[0]['ref_doctor_name']?></td>
                    </tr>
                    <tr>
                      <td>Ref Doctor Name (Two): </td>
                      <td><?=$patient_info[0]['ref_doc_name_t']?></td>
                    </tr>
                  </tbody>
                </table>
                    
              </div>
                
            </div>
                  <!-- Table row -->
                  <div class="row pl-5 pr-5 my-3">
                    <div class="col-12 table-responsive">
                      <table class="table table-bordered table-striped">
                        <thead>
                          <th>SL NO</th>
                          <th>Service</th>
                          <th>Day</th>
                          <th>Price</th>
                          <th style="width:20%">Total</th>
                        </thead>
                        <tbody>
                          <?php $i=1;
                          $days=0;
                          $total=0;
                          // $last_date=0;
                          foreach ($patient_timeline as $key => $value) { if($key < count($patient_timeline)-1) {?>

                            <tr>
                              <td align="center"><?=$i?></td>
                              <td align="center"><?=$value['room_title']?></td>
                              <td align="right">
                                 <?php 
                                 // echo date('Y-m-d',strtotime($value['created_at']));
                                 // echo date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at']));

                                 $current_date=date_create(date('Y-m-d',strtotime($value['created_at'])));
                                 // echo  $current_date;
                                 // echo  $next_date;
                                 $next_date=date_create(date('Y-m-d',strtotime($patient_timeline[$key+1]['created_at'])));
                                $diff=date_diff($next_date,$current_date);
                                $days=$diff->format("%a")+1;
                                $total= $total+($days*$value['room_price']);
                                echo $days;?>
                              </td>
                              <td align="right"><?=$value['room_price']?></td>


                              <td align="right"><?=$days*$value['room_price']?></td>
                            </tr>
                           
                         <?php $i++;} } ?>
                                <form action="admin/insert_ipd_patient_order_info/<?=$order_id?>/<?=$patient_info[0]['id']?>" method="POST" >
                                  <tr><td colspan="4"align="right">Total</td><td  align="right"> <input style="text-align: right" class="form-control" readonly type="text" name="total" value="<?=number_format($total,2,'.','')?>"></td></tr>


                                    <tr><td colspan="4"align="right">VAT</td><td align="right"><?=number_format($order_info[0]['vat']/100*$total,2,'.','')?></td></tr>

                                  <tr><td colspan="4"align="right">Total Discount</td><td align="right"><?=number_format($order_info[0]['total_discount']/100*$total,2,'.','')?></td></tr>

                                  <tr><td colspan="4"align="right"> Already Paid</td><td align="right"><?=number_format($order_info[0]['total_paid'],2,'.','')?></td></tr>

                                  <tr><td colspan="4"align="right">Net Total</td><td align="right"><?=number_format($total+($total*$order_info[0]['vat']/100)-(($total*$order_info[0]['total_discount']/100)+$order_info[0]['total_paid']),2,'.','')?></td></tr>

                                  <tr><td colspan="4"align="right">Due</td><td align="right"><?=number_format($total+($total*$order_info[0]['vat']/100)-(($total*$order_info[0]['total_discount']/100)+$order_info[0]['total_paid']),2,'.','')?></td></tr>

                                    <?php if($order_info[0]['payment_status']!="paid"){

                                    ?>                             
                                    <?php }?>
                                  </form>
                         
                        </tbody>
                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
            
                  
                  <!-- /.row -->
            
                  <!-- this row will not appear when printing -->
          </div>
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
  $(document).ready(function()
  {
  $(document).on('input', '#discount', function()
    {
      var discount;
      var vat;
      var already_paid=$('#already_paid').val();
      var total=$(this).data('total');
      if($('#discount').val()=="")
      {
        discount="0";
      }
      else
      {
        discount=$('#discount').val();
        discount=parseFloat(total)*(discount/100);
      }
      if($('#vat').val()=="")
      {
        vat="0";
      }
      else
      {
        vat=$('#vat').val();
        vat=parseFloat(total)*(vat/100);
        // vat=vat.toFixed(2);


      }
      
      
      // alert(delivary_cost);

      var net_total=(parseFloat(total)+parseFloat(vat))-(parseFloat(discount)+parseFloat(already_paid));

      $('#net_total').val(net_total.toFixed(2));
      total_paid();


    
      });

      $(document).on('input', '#vat', function()
    {
      var discount;
      var vat;
      var already_paid=$('#already_paid').val();
      var total=$(this).data('total');
      if($('#discount').val()=="")
      {
        discount="0";
      }
      else
      {
        discount=$('#discount').val();
        discount=parseFloat(total)*(discount/100);
        
      }
      if($('#vat').val()=="")
      {
        vat="0";
      }
      else
      {
        vat=$('#vat').val();
        vat=parseFloat(total)*(vat/100);
      }
      
      
      // alert(discount);

      var net_total=(parseFloat(total)+parseFloat(vat))-(parseFloat(discount)+parseFloat(already_paid));

      $('#net_total').val(net_total.toFixed(2));
      total_paid();

    
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
            
            

            var due=parseFloat(net_total)-parseFloat(total_paid);

            $('#due').val(due.toFixed(2));
          }


</script>
</body>
</html>












