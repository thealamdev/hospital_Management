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
        <div class="card  no-b">
          <div class="card-body">
            <div class="row">
             <div class="col-md-9">
              <table class="test_table_report">
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
              <table class="test_table_report">
                <tbody>
                 <tr>
                  <td>Booked By: </td>
                  <td><?=$patient_info[0]['operator_name']?></td>
                </tr>
                <tr>
                  <td>Doctor Name: </td>
                  <td><?=$patient_info[0]['doc_name']?></td>
                </tr>
                <tr>
                  <td>Ref Doctor Name: </td>
                  <td><?=$patient_info[0]['ref_doc_name']?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div align="right" class="mt-3 mr-3">
      <a href="admin/ipd_adv_pay_pdf/<?=$patient_info[0]['id']?>" target="_blank" class="btn btn-lg  btn-default"><i class="icon icon-cloud-download"></i> Pdf</a>
    </div>
    <div class="row">
      <div class="col-md-12">
        <table class="table test_table_report">
          <thead>
            <tr>
              <th>S.L</th>
              <th >Date</th>
              <th align="right">Advance Amount</th>

            </tr>
          </thead>
          <tbody class="mytable_style" >

            <tr>
              <?php

              $total_amount=0;
              foreach ($due_info as $key => $row) { 

                $total_amount+=$row['advance_payment'];

                ?>
                <td align="center"><?=$key+1;?></td>
                <td align="center"><?=date('d-m-Y',strtotime($row['created_at']));?></td>
                <td align="right"><?=$row['advance_payment'];?></td>

              </tr>
            <?php } ?>

            <tr>
              <td colspan="2" style="border-top:5px;" align="right">
                <strong>Total:</strong>
              </td>
              <td align="right">
                <?=number_format($total_amount,2);?>
              </td>
            </tr>

          </tbody>                    
        </table>
      </div>
      
    </div>

    <form id="my_form" method="post" action="admin/ipd_adv_pay_post/<?=$patient_info[0]['id']?>">
      <div class="row mt-5">
        <div class="col-md-4">
         <div class="form-group">
          <div class="row">
            <label for="adv_pay" class="col-md-4 text-right">Advance amount</label>
            <div class="col-md-8">
              <input class="form-control form-control-sm" id="adv_pay" name="adv_pay" autocomplete="off" type="text" placeholder="" required >
            </div>
          </div>
        </div>
      </div>
      <div class="text-right"> 
       <input type="submit" value="Pay" class="btn btn-primary m-2">
     </div>
   </div>
 </form>
 <div class="control-sidebar-bg shadow white fixed"></div>
</div>
</div>
<?php $this->load->view('back/footer_link');?>
</body>
</html>