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
         <!--      <div align="right" class="mt-3 mr-3">
            <a href="admin/opd_each_patient_pdf/<?=$patient_id?>/<?=$order_id?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a>
          </div>  -->      
          <div class="section-wrapper">
            <div class="row">
             <div class="col-md-12">
              <div class="card">
               <div class="card-body">
                <div class="row">
                 <div class="col-md-3"></div>
                 <div class="col-md-6">
                  <div class="form-group">
                   <label for="acc_head" class="col-sm-12 control-label">Patient Id: </label>
                   <div class="col-md-10">
                    <select class="custom-select select2 form-control" onchange="get_bill_info()" name="patient_id"  id="patient_id" required>
                     <option value="0">Select Patient Id</option>
                     <?php 
                     foreach ($all_ipd_patient_id as $key => $patient_id){  ?>
                       <option value="<?=$patient_id['id']?>"><?=$patient_id['patient_info_id']?></option>
                     <?php } ?>
                   </select>
                 </div>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <div class="row my-3">
     <div class="col-md-12">
      <div class="card  no-b">

       <div class="card-body"  id="bill_info_div">
       </div>
     </div>
   </div>
 </div>
</div>
</div>
</div>
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>

<script type="text/javascript">
  function get_bill_info() 
  {

    var p_id=$("#patient_id option:selected").val();
          // alert(p_id);
          
          if(p_id!=0){
            $.ajax({
              type: 'POST',
              cache: false,
              url: "<?=base_url();?>admin/ipd_get_patient_bill_info_by_patient_id",
              data: {p_id:p_id},
              success: function(data) 
              { 

                $("#bill_info_div").html(data);
                $('#error_level_div').hide();
                $('#my_form').on('submit', function() {

                 var grand_due=$('#grand_due').val();
                 var total_paid=$('#total_paid').val();

                 if(parseFloat(grand_due) < parseFloat(total_paid))
                 {
                  $('#error_level_div').show();
                  return false;

                }

              });
                

              }
            });


            
            
          }
        }
      </script>


      <script type="text/javascript">
        $(document).ready(function()
        {

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

      var net_total=(parseFloat($('#due').val())+parseFloat(vat))-(parseFloat(discount));

      $('#grand_due').val(net_total.toFixed(2));
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

      var net_total=(parseFloat($('#due').val())+parseFloat(vat))-(parseFloat(discount));

      $('#grand_due').val(net_total.toFixed(2));
      total_paid();


    });


          $(document).on('input', '#adm_fee_discount', function()
          {
            var discount;
            var vat;


            if($('#adm_fee_discount').val()=="")
            {
              discount="0";
            }
            else
            {
              discount=$('#adm_fee_discount').val();

            }

      // alert(delivary_cost);

      var net_tot=(parseFloat($('#adm_fee_due').val()))-(parseFloat(discount));

      // alert(net_tot);

      $('#adm_fee_grand_due').val(net_tot.toFixed(2));


    });

        });


      </script>
    </body>
    </html>