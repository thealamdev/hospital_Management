<!-- <script type="text/javascript">
   setTimeout(function() { 
        window.print();
        self.close();
   }, 1000);
 </script> -->
 <?php $this->load->view('back/header_link'); ?>
 <body class="light">
   <!-- Pre loader -->
   <?php $this->load->view('back/loader'); ?>
     <?php 
  $hos_logo=$this->session->userdata['logged_in']['hospital_logo'];
  $hos_head_report=$this->session->userdata['logged_in']['hospital_head_report'];
  ?>

  <div id="app" style="color:#000;font-weight:bold;">


    <div class="section-wrapper">
      <div class="card my-3 no-b">
        <div class="card-body">
          <div class="container">
            <div class="invoice white shadow">
             <div class="row pl-5 pr-5">
               <div class="col-md-3">
                <img style="height: 130px;width: 150px;" src="uploads/hospital_logo/<?=$hos_logo?>" alt="">  
              </div>      
               <div class="col-md-9">

               <?=$hos_head_report?>
            </div> 
        <div class="col-md-12" style="border-bottom:#000 solid 1px"></div>
      </div>
      <!-- Table row -->
      <div class="row pl-5 pr-5 my-3">
        <div class="col-12 table-responsive">
         <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report From <?php echo $from_date?> to <?php echo $end_date?> </p>
         <?php if($flag=="all") {
          foreach ($doc_info as $key => $val) { 
            
            $doc_flag=0;
            
            
            foreach ($col_from_doc as $key => $va) {
              
              if($va['quack_doc_id']==$val['doctor_id'])
              {
                $doc_flag=1;
              }
              
            }
            
            if($doc_flag==1)
              { ?>
               <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$val['doctor_title']?> ( <?=$val['doctor_degree']?> ) </p>
               <table id="test_table" class="table table-bordered table-hover test_table_report"
               >
               <thead>
                 <tr>
                  <th>SL NO</th>
                  <th>Group Name</th>
                  <th>Count</th>
                  <th>Total Price</th>
                  <th>Total Vat</th>
                  <th>Total Discount</th>
                  <th>Net Amount</th>
                  <th>Commission</th>
                  <th>Date</th>
                  <!-- <th>Date</th> -->
                  <!-- <th style="width:10%;">Details</th> -->
                </tr>
              </thead>
              <tbody>
               <?php
               $i=1;
               $total_a1=0;
               $total_v1=0;
               $total_d1=0;
               $total_n1=0;
               foreach($group_info as $key1 => $value1)
               {
                 
                $total_a=0;
                
                $total_v=0;
                $total_d=0;
                $count_all_test=0;
                
                $flag=0;
                
                $flag1=0;
                $count=0;
                
                $quk_ref="";
                
                $quk_ref_com=0;
                
                $testid=$value1['test_id'];
                                    // add commission
                
                
                foreach ($col_from_doc as $key => $value) {
                  if($value1['test_id']==$value['test_id']  && $val['doctor_id']==$value['quack_doc_id'])
                  {
                   $total_a+=$value['total_amount'];
                   $total_v+=$value['vat'];
                   $total_d+=$value['total_discount'];
                   
                   $flag=1;
                 }
                 
               } if($flag==1){?>
                 <tr>
                  <td><?=$key1+1?></td>
                  <td><?=$value1['test_title']?></td>
                  <td>
                   <?php 
                   foreach ($test_count as $key => $value2) {
                    if($value2['test_id']==$value1['test_id']  && $val['doctor_id']==$value2['quack_doc_id'])
                      {?>
                       <table  class="table table-bordered table-hover">
                        <tr>
                         <td>
                          <?=$value2['sub_test_title']?>
                        </td>
                      </tr>
                    </table>
                  <?php }
                }
                ?>
              </td>
              <td>
               <?php 
               foreach ($test_count as $key => $value2) {
                if($value2['test_id']==$value1['test_id'] && $val['doctor_id']==$value2['quack_doc_id'])
                  {?>
                   <table  class="table table-bordered table-hover">
                    <tr>
                     <td>
                      <?=$value2['price']?>
                    </td>
                  </tr>
                </table>
              <?php }
            }
            ?>
          </td>
          <td>
           <?php 
           foreach ($test_count as $key => $value2) {
            $j=0;
            if($value2['test_id']==$value1['test_id']  && $val['doctor_id']==$value2['quack_doc_id'])
            {
              
              $cou='select count(o.id) as num_row from opd_patient_test_order_info o join opd_patient_test_details_info op on o.id=op.patient_test_order_id  where o.id="'.$value2['id'].'"';
              $que = $this->db->query($cou);
              $result=$que->result_array();
              
                                          // echo $result[0]['num_row'];
                                          // "<pre>";print_r($result);
              
              ?>
              <table  class="table table-bordered table-hover">
                <tr>
                 <td>
                  <?=$value2['vat']/($result[$j]['num_row']);
                  $j++;?>
                </td>
              </tr>
            </table>
          <?php }
        }
        ?>
      </td>
      <td>
       <?php 
       foreach ($test_count as $key => $value2) {
        $j=0;
        if($value2['test_id']==$value1['test_id']  && $val['doctor_id']==$value2['quack_doc_id'])
        {
          
          $cou='select count(o.id) as num_row from opd_patient_test_order_info o join opd_patient_test_details_info op on o.id=op.patient_test_order_id  where o.id="'.$value2['id'].'"';
          $que = $this->db->query($cou);
          $result=$que->result_array();
          
                                                 // echo $result[0]['num_row'];
                                                  // "<pre>";print_r($result);
          
          ?>
          <table  class="table table-bordered table-hover">
            <tr>
             <td>
              <?=number_format($value2['total_discount']/($result[$j]['num_row']),2,'.', '');
              $j++;?>
            </td>
          </tr>
        </table>
      <?php }
    }
    ?>
  </td>
  <td>
   <?php 
   foreach ($test_count as $key => $value2) {
    $j=0;
    if($value2['test_id']==$value1['test_id']  && $val['doctor_id']==$value2['quack_doc_id'])
    {
      
      $cou='select count(o.id) as num_row from opd_patient_test_order_info o join opd_patient_test_details_info op on o.id=op.patient_test_order_id  where o.id="'.$value2['id'].'"';
      $que = $this->db->query($cou);
      $result=$que->result_array();
      
                                                 // echo $result[0]['num_row'];
                                                  // "<pre>";print_r($result);
      
      ?>
      <table  class="table table-bordered table-hover">
        <tr>
         <td>
           <?=number_format($value2['price']-($value2['total_discount']/($result[$j]['num_row']))+($value2['vat']/($result[$j]['num_row'])),2,'.', '');
           $j++;?>
         </td>
       </tr>
     </table>
   <?php }
 }
 ?>
</td>
<!-- Commission Part -->
<td>
 <?php 
 $quk_ref_com=0;
 foreach ($test_count as $key => $value2) {
  
   if($value2['test_id']==$value1['test_id'] && $val['doctor_id']==$value2['quack_doc_id'])
   {
     
    
    $sql1="select *,testid as dis_test_id from doc_comission_distribution where doc_id='".$val['doctor_id']."' and group_id='".$value1['test_id']."' and active_status=1 order by doc_com_id desc limit 1";
    
    $query1 = $this->db->query($sql1);
    
    
    
    foreach ($query1->result() as $row) 
    {
     $group_id=$row->group_id;
                                                     $testid=$row->dis_test_id;  //sub Test id
                                                     $com_type=$row->com_type;
                                                     $doc_comission=$row->doc_comission;
                                                     
                                                     $quk_ref_com=$doc_comission;
                                                     
                                                     
                                                     
                                                     if($testid==0)
                                                     {
                                                      
                                                       if($com_type==1)
                                                       {
                                                        
                                                        
                                                         $quk_ref=$quk_ref_com.'%';  
                                                         
                                                       }
                                                       else if($com_type==2)
                                                       {
                                                         $quk_ref=$quk_ref_com.'৳';  
                                                       }
                                                       else
                                                       {
                                                        $quk_ref=$quk_ref_com.'৳';
                                                      }
                                                    }
                                                    
                                                    
                                                    else
                                                    {
                                                      
                                                      $flag1=0;
                                                      $flag2=0;
                                                      
                                                      $count=0;
                                                      $t_count=0;
                                                      
                                                      $quk_ref_com=0;
                                                      $total_price_no_match=0;
                                                      
                                                      $testid=$value1['test_id'];
                                                      
                                                      
                                                      $sql3 ="select doc_com_id,com_type,doc_comission from doc_comission_distribution where doc_id='".$val['doctor_id']."' and group_id='".$testid."' and testid=0 AND active_status=1 order by doc_com_id desc limit 1";
                                                      
                                                      $query3 = $this->db->query($sql3);
                                                      
                                                      $res=$query3->result_array();
                                                      
                                                      
                                                       // $res1=$query2->result_array();
                                                      
                                                       // "<pre>";print_r($res);
                                                      
                                                      if($res!=null) 
                                                      {
                                                        
                                                        $sql2 ="select *,testid as dis_test_id from doc_comission_distribution where doc_id='".$val['doctor_id']."' and group_id='".$testid."' and active_status=1 AND doc_com_id > '".$res[0]['doc_com_id']."' order by doc_com_id desc";
                                                        
                                                        $query2 = $this->db->query($sql2);
                                                        
                                                        if($res[0]['com_type']==1)
                                                        {
                                                          
                                                       // $total_price=0;
                                                          
                                                       // foreach ($test_count as $key => $value5) {
                                                          $flag2=0;
                                                         // $total_price+=$value5['price'];
                                                          
                                                         // $total_price_no_match+=$value5['price'];
                                                          foreach ($query2->result() as $row) 
                                                          {
                                                           $group_id=$row->group_id;
                                                           $testid=$row->dis_test_id;
                                                           $com_type=$row->com_type;
                                                           $doc_comission=$row->doc_comission;
                                                           $price=$row->price;
                                                           $doc_com_id=$row->doc_com_id;
                                                           
                                                           
                                                           
                                                           if($flag2==0)
                                                           {
                                                            
                                                             if($value2['sub_test_id']==$testid){
                                                              
                                                     // $total_price_no_match-=$value5['price'];
                                                              
                                                               $flag2=1;
                                                               
                                                               if($com_type==1)
                                                               {
                                                                
                                                         // $quk_ref_com=$doc_comission;
                                                                $quk_ref=number_format($doc_comission,2,'.', '').'%';
                                                                
                                                              }
                                                              else if($com_type==2)
                                                              {
                                                           // $quk_ref_com=$doc_comission;
                                                                $quk_ref=number_format($doc_comission,2,'.', '').'৳';
                                                                
                                                              }
                                                              
                                                       // $count++;
                                                              
                                                            }
                                                            
                                                            else
                                                            {
                                                        // $quk_ref_com=$doc_comission;
                                                              $quk_ref=number_format($res[0]['doc_comission'],2,'.', '').'%';
                                                            }
                                                            
                                                          }
                                                          
                                                        }
                                                        
                                             // }
                                                        
                                                        
                                             // $total_price_no_match=($res[0]['doc_comission']/100)*$total_price_no_match;
                                                        
                                                        
                                             //    $quk_ref_com=(($total_price_no_match+$quk_ref_com)*100)/$total_price;
                                                        
                                                        
                                                        
                                                      }
                                                      
                                                      else
                                                      {
                                                       // foreach ($test_count as $key => $value5) {
                                                        $flag2=0;
                                                        foreach ($query2->result() as $row) 
                                                        {
                                                         $group_id=$row->group_id;
                                                         $testid=$row->dis_test_id;
                                                         $com_type=$row->com_type;
                                                         $doc_comission=$row->doc_comission;
                                                         $price=$row->price;
                                                         $doc_com_id=$row->doc_com_id;
                                                         
                                                         if($flag2==0)
                                                         {
                                                          
                                                           if($value2['sub_test_id']==$testid){
                                                            
                                                             $flag2=1;
                                                             
                                                             if($com_type==1)
                                                             {
                                                              
                                                               $quk_ref=number_format($doc_comission,2,'.', '').'%';
                                                               
                                                             }
                                                             else if($com_type==2)
                                                             {
                                                               
                                                              
                                                               $quk_ref=number_format($doc_comission,2,'.', '').'৳';
                                                               
                                                             }
                                                             
                                                       // $count++;
                                                             
                                                           }
                                                           
                                                           else
                                                           {
                                                            $quk_ref_com=$res[0]['doc_comission'];
                                                            $quk_ref=number_format($quk_ref_com,2,'.', '').'৳';
                                                          }
                                                          
                                                        }
                                                        
                                                      }
                                                      
                                             // }
                                                      
                                                      
                                             // $quk_ref_com=(($res[0]['doc_comission']*$t_count)+$quk_ref_com);
                                                      
                                                      
                                               // $quk_ref=number_format($quk_ref_com,2,'.', '').'৳';      
                                                      
                                                    } 
                                                    
                                                  }
                                                  
                                                  else
                                                  {
                                                    
                                                    
                                                    $sql2 ="select *,testid as dis_test_id from doc_comission_distribution where doc_id='".$val['doctor_id']."' and group_id='".$testid."' and testid='".$value2['sub_test_id']."' and active_status=1 order by doc_com_id desc limit 1";
                                                    
                                                    $query2 = $this->db->query($sql2);
                                                    
                                                       // $r=$query2->result_array();
                                                    
                                                       // "<pre>";print_r($r);
                                                    
                                                     // foreach ($test_count as $key => $value5) {
                                                    
                                                    foreach ($query2->result() as $row) 
                                                    {
                                                     $group_id=$row->group_id;
                                                     $testid=$row->dis_test_id;
                                                     $com_type=$row->com_type;
                                                     $doc_comission=$row->doc_comission;
                                                     $price=$row->price;
                                                     $doc_com_id=$row->doc_com_id;
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     if($com_type==1)
                                                     {
                                                      
                                                      $quk_ref=number_format($doc_comission,2,'.', '').'%';
                                                      
                                                    }
                                                    else if($com_type==2)
                                                    {
                                                     
                                                      
                                                      $quk_ref=number_format($doc_comission,2,'.', '').'৳';
                                                      
                                                    }
                                                    
                                                       // $count++;
                                                    
                                                    
                                                  }
                                                  
                                                  
                                                  
                                                  
                                                }
                                                
                                                
                                                
                                              }
                                            }
                                            
                                            if($quk_ref==null){
                                             $quk_ref="None";
                                           }  
                                           
                                           
                                           ?>
                                           <table  class="table table-bordered table-hover">
                                            <tr>
                                             <td>
                                              <?=$quk_ref?>
                                            </td>
                                          </tr>
                                        </table>
                                      <?php }
                                    }
                                    ?>
                                  </td>
                                  <td>
                                   <?php 
                                   foreach ($test_count as $key => $value2) {
                                    if($value2['test_id']==$value1['test_id']  && $val['doctor_id']==$value2['quack_doc_id'])
                                      {?>
                                       <table  class="table table-bordered table-hover">
                                        <tr>
                                         <td>
                                          <?=$value2['created_at']?>
                                        </td>
                                      </tr>
                                    </table>
                                  <?php }
                                }
                                ?>
                              </td>
                            </tr>
                            <?php
                          }
                          $total_a1+=$total_a;
                          $total_v1+=$total_v;
                          $total_d1+=$total_d;
                          
                          $total_n1+=$total_a-$total_d+$total_v;
                          
                          
                        }
                        
                        ?>
                      </tbody>
                      <tfoot>
                       <tr>
                        <td  align="center" colspan="3">Total</td>
                        <td><?=$total_a1?></td>
                        <td><?=$total_v1?></td>
                        <td><?=$total_d1?></td>
                        <td><?=$total_n1?></td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                <?php }}} 
                              // Individual Dr Part
                else {?>
                 <p style="text-align:center;font-size:14px;color:#000;font-weight:bold;"> Report Type: <?=$doc_name?> ( <?=$doc_degree?> ) </p>
                 <table id="test_table" class="table table-bordered table-hover"
                 >
                 <thead>
                   <tr>
                    <th>SL NO</th>
                    <th>Group Name</th>
                    <th>Count</th>
                    <th>Total Price</th>
                    <th>Total Vat</th>
                    <th>Total Discount</th>
                    <th>Net Amount</th>
                    <th>Commission</th>
                    <th>Date</th>
                    <!-- <th>Date</th> -->
                    <!-- <th style="width:10%;">Details</th> -->
                  </tr>
                </thead>
                <tbody>
                 <?php
                 $i=1;
                 $total_a1=0;
                 $total_v1=0;
                 $total_d1=0;
                 $total_n1=0;
                 foreach($group_info as $key1 => $value1)
                 {
                  $arr=array();
                  $total_a=0;
                  
                  $total_v=0;
                  $total_d=0;
                  $count_all_test=0;
                  
                  $flag=0;
                  
                  $flag1=0;
                  $count=0;
                  
                  $quk_ref="";
                  
                  $quk_ref_com=0;
                  
                  $testid=$value1['test_id'];
                                    // add commission
                  
                  
                  foreach ($col_from_doc as $key => $value) {
                    if($value1['test_id']==$value['test_id'])
                    {
                     $total_a+=$value['total_amount'];
                     $total_v+=$value['vat'];
                     $total_d+=$value['total_discount'];
                     
                     $flag=1;
                   }
                   
                 } if($flag==1){?>
                   <tr>
                    <td><?=$key1+1?></td>
                    <td><?=$value1['test_title']?></td>
                    <td>
                     <?php 
                     foreach ($test_count as $key => $value2) {
                      if($value2['test_id']==$value1['test_id'])
                        {?>
                         <table  class="table table-bordered table-hover">
                          <tr>
                           <td>
                            <?=$value2['sub_test_title']?>
                          </td>
                        </tr>
                      </table>
                    <?php }
                  }
                  ?>
                </td>
                <td>
                 <?php 
                 foreach ($test_count as $key => $value2) {
                  if($value2['test_id']==$value1['test_id'])
                    {?>
                     <table  class="table table-bordered table-hover">
                      <tr>
                       <td>
                        <?=$value2['price']?>
                      </td>
                    </tr>
                  </table>
                <?php }
              }
              ?>
            </td>
            <!-- Vat Part -->
            <td>
             <?php 
             foreach ($test_count as $key => $value2) {
              $j=0;
              if($value2['test_id']==$value1['test_id'])
              {
                
                $cou='select count(o.id) as num_row from opd_patient_test_order_info o join opd_patient_test_details_info op on o.id=op.patient_test_order_id  where o.id="'.$value2['id'].'"';
                $que = $this->db->query($cou);
                $result=$que->result_array();
                
                                          // echo $result[0]['num_row'];
                                          // "<pre>";print_r($result);
                
                ?>
                <table  class="table table-bordered table-hover">
                  <tr>
                   <td>
                    <?=number_format($value2['vat']/($result[$j]['num_row']),2,'.', '');
                    $j++;?>
                  </td>
                </tr>
              </table>
            <?php }
          }
          ?>
        </td>
        <!-- Discount Part -->
        <td>
         <?php 
         foreach ($test_count as $key => $value2) {
          $j=0;
          if($value2['test_id']==$value1['test_id'])
          {
            
            $cou='select count(o.id) as num_row from opd_patient_test_order_info o join opd_patient_test_details_info op on o.id=op.patient_test_order_id  where o.id="'.$value2['id'].'"';
            $que = $this->db->query($cou);
            $result=$que->result_array();
            
                                                 // echo $result[0]['num_row'];
                                                  // "<pre>";print_r($result);
            
            ?>
            <table  class="table table-bordered table-hover">
              <tr>
               <td>
                <?=number_format($value2['total_discount']/($result[$j]['num_row']),2,'.', '');
                $j++;?>
              </td>
            </tr>
          </table>
        <?php }
      }
      ?>
    </td>
    <!-- Net Amount Part -->
    <td>
     <?php 
     foreach ($test_count as $key => $value2) {
      $j=0;
      if($value2['test_id']==$value1['test_id'])
      {
        
        $cou='select count(o.id) as num_row from opd_patient_test_order_info o join opd_patient_test_details_info op on o.id=op.patient_test_order_id  where o.id="'.$value2['id'].'"';
        $que = $this->db->query($cou);
        $result=$que->result_array();
        
                                                 // echo $result[0]['num_row'];
                                                  // "<pre>";print_r($result);
        
        ?>
        <table  class="table table-bordered table-hover">
          <tr>
           <td>
            <?=number_format($value2['price']-($value2['total_discount']/($result[$j]['num_row']))+($value2['vat']/($result[$j]['num_row'])),2,'.', '');
            $j++;?>
          </td>
        </tr>
      </table>
    <?php }
  }
  ?>
</td>
<!-- Commission Part -->
<td>
 <?php 
 $quk_ref_com=0;
 foreach ($test_count as $key => $value2) {
  
   if($value2['test_id']==$value1['test_id'])
   {
     
    
    $sql1="select *,testid as dis_test_id from doc_comission_distribution where doc_id='".$quack_doc_id."' and group_id='".$value1['test_id']."' and active_status=1 order by doc_com_id desc limit 1";
    
    $query1 = $this->db->query($sql1);
    
    
    
    foreach ($query1->result() as $row) 
    {
     $group_id=$row->group_id;
                                                     $testid=$row->dis_test_id;  //sub Test id
                                                     $com_type=$row->com_type;
                                                     $doc_comission=$row->doc_comission;
                                                     
                                                     $quk_ref_com=$doc_comission;
                                                     
                                                     
                                                     
                                                     if($testid==0)
                                                     {
                                                      
                                                       if($com_type==1)
                                                       {
                                                        
                                                        
                                                         $quk_ref=$quk_ref_com.'%';  
                                                         
                                                       }
                                                       else if($com_type==2)
                                                       {
                                                         $quk_ref=$quk_ref_com.'৳';  
                                                       }
                                                       else
                                                       {
                                                        $quk_ref=$quk_ref_com.'৳';
                                                      }
                                                    }
                                                    
                                                    
                                                    else
                                                    {
                                                      
                                                      $flag1=0;
                                                      $flag2=0;
                                                      
                                                      $count=0;
                                                      $t_count=0;
                                                      
                                                      $quk_ref_com=0;
                                                      $total_price_no_match=0;
                                                      
                                                      $testid=$value1['test_id'];
                                                      
                                                      
                                                      $sql3 ="select doc_com_id,com_type,doc_comission from doc_comission_distribution where doc_id='".$quack_doc_id."' and group_id='".$testid."' and testid=0 AND active_status=1 order by doc_com_id desc limit 1";
                                                      
                                                      $query3 = $this->db->query($sql3);
                                                      
                                                      $res=$query3->result_array();
                                                      
                                                      
                                                       // $res1=$query2->result_array();
                                                      
                                                       // "<pre>";print_r($res);
                                                      
                                                      if($res!=null) 
                                                      {
                                                        
                                                        $sql2 ="select *,testid as dis_test_id from doc_comission_distribution where doc_id='".$quack_doc_id."' and group_id='".$testid."' and active_status=1 AND doc_com_id > '".$res[0]['doc_com_id']."' order by doc_com_id desc";
                                                        
                                                        $query2 = $this->db->query($sql2);
                                                        
                                                        if($res[0]['com_type']==1)
                                                        {
                                                          
                                                       // $total_price=0;
                                                          
                                                       // foreach ($test_count as $key => $value5) {
                                                          $flag2=0;
                                                         // $total_price+=$value5['price'];
                                                          
                                                         // $total_price_no_match+=$value5['price'];
                                                          foreach ($query2->result() as $row) 
                                                          {
                                                           $group_id=$row->group_id;
                                                           $testid=$row->dis_test_id;
                                                           $com_type=$row->com_type;
                                                           $doc_comission=$row->doc_comission;
                                                           $price=$row->price;
                                                           $doc_com_id=$row->doc_com_id;
                                                           
                                                           
                                                           
                                                           if($flag2==0)
                                                           {
                                                            
                                                             if($value2['sub_test_id']==$testid){
                                                              
                                                     // $total_price_no_match-=$value5['price'];
                                                              
                                                               $flag2=1;
                                                               
                                                               if($com_type==1)
                                                               {
                                                                
                                                         // $quk_ref_com=$doc_comission;
                                                                $quk_ref=number_format($doc_comission,2,'.', '').'%';
                                                                
                                                              }
                                                              else if($com_type==2)
                                                              {
                                                           // $quk_ref_com=$doc_comission;
                                                                $quk_ref=number_format($doc_comission,2,'.', '').'৳';
                                                                
                                                              }
                                                              
                                                       // $count++;
                                                              
                                                            }
                                                            
                                                            else
                                                            {
                                                        // $quk_ref_com=$doc_comission;
                                                              $quk_ref=number_format($res[0]['doc_comission'],2,'.', '').'%';
                                                            }
                                                            
                                                          }
                                                          
                                                        }
                                                        
                                             // }
                                                        
                                                        
                                             // $total_price_no_match=($res[0]['doc_comission']/100)*$total_price_no_match;
                                                        
                                                        
                                             //    $quk_ref_com=(($total_price_no_match+$quk_ref_com)*100)/$total_price;
                                                        
                                                        
                                                        
                                                      }
                                                      
                                                      else
                                                      {
                                                       // foreach ($test_count as $key => $value5) {
                                                        $flag2=0;
                                                        foreach ($query2->result() as $row) 
                                                        {
                                                         $group_id=$row->group_id;
                                                         $testid=$row->dis_test_id;
                                                         $com_type=$row->com_type;
                                                         $doc_comission=$row->doc_comission;
                                                         $price=$row->price;
                                                         $doc_com_id=$row->doc_com_id;
                                                         
                                                         if($flag2==0)
                                                         {
                                                          
                                                           if($value2['sub_test_id']==$testid){
                                                            
                                                             $flag2=1;
                                                             
                                                             if($com_type==1)
                                                             {
                                                              
                                                               $quk_ref=number_format($doc_comission,2,'.', '').'%';
                                                               
                                                             }
                                                             else if($com_type==2)
                                                             {
                                                               
                                                              
                                                               $quk_ref=number_format($doc_comission,2,'.', '').'৳';
                                                               
                                                             }
                                                             
                                                       // $count++;
                                                             
                                                           }
                                                           
                                                           else
                                                           {
                                                            $quk_ref_com=$res[0]['doc_comission'];
                                                            $quk_ref=number_format($quk_ref_com,2,'.', '').'৳';
                                                          }
                                                          
                                                        }
                                                        
                                                      }
                                                      
                                             // }
                                                      
                                                      
                                             // $quk_ref_com=(($res[0]['doc_comission']*$t_count)+$quk_ref_com);
                                                      
                                                      
                                               // $quk_ref=number_format($quk_ref_com,2,'.', '').'৳';      
                                                      
                                                    } 
                                                    
                                                  }
                                                  
                                                  else
                                                  {
                                                    
                                                    
                                                    $sql2 ="select *,testid as dis_test_id from doc_comission_distribution where doc_id='".$quack_doc_id."' and group_id='".$testid."' and testid='".$value2['sub_test_id']."' and active_status=1 order by doc_com_id desc limit 1";
                                                    
                                                    $query2 = $this->db->query($sql2);
                                                    
                                                       // $r=$query2->result_array();
                                                    
                                                       // "<pre>";print_r($r);
                                                    
                                                     // foreach ($test_count as $key => $value5) {
                                                    
                                                    foreach ($query2->result() as $row) 
                                                    {
                                                     $group_id=$row->group_id;
                                                     $testid=$row->dis_test_id;
                                                     $com_type=$row->com_type;
                                                     $doc_comission=$row->doc_comission;
                                                     $price=$row->price;
                                                     $doc_com_id=$row->doc_com_id;
                                                     
                                                     
                                                     
                                                     
                                                     
                                                     if($com_type==1)
                                                     {
                                                      
                                                      $quk_ref=number_format($doc_comission,2,'.', '').'%';
                                                      
                                                    }
                                                    else if($com_type==2)
                                                    {
                                                     
                                                      
                                                      $quk_ref=number_format($doc_comission,2,'.', '').'৳';
                                                      
                                                    }
                                                    
                                                       // $count++;
                                                    
                                                    
                                                  }
                                                  
                                                  
                                                  
                                                  
                                                }
                                                
                                                
                                                
                                              }
                                            }
                                            
                                            if($quk_ref==null){
                                             $quk_ref="None";
                                           }  
                                           
                                           
                                           ?>
                                           <table  class="table table-bordered table-hover">
                                            <tr>
                                             <td>
                                              <?=$quk_ref?>
                                            </td>
                                          </tr>
                                        </table>
                                      <?php }
                                    }
                                    ?>
                                  </td>
                                  <td>
                                   <?php 
                                   foreach ($test_count as $key => $value2) {
                                    if($value2['test_id']==$value1['test_id'])
                                      {?>
                                       <table  class="table table-bordered table-hover">
                                        <tr>
                                         <td>
                                          <?=$value2['created_at']?>
                                        </td>
                                      </tr>
                                    </table>
                                  <?php }
                                }
                                ?>
                              </td>
                            </tr>
                            <?php
                          }
                          $total_a1+=$total_a;
                          $total_v1+=$total_v;
                          $total_d1+=$total_d;
                          
                          $total_n1+=$total_a-$total_d+$total_v;
                          
                          
                        }
                        
                        ?>
                      </tbody>
                      <tfoot>
                       <tr>
                        <td  align="center" colspan="3">Total</td>
                        <td><?=$total_a1?></td>
                        <td><?=$total_v1?></td>
                        <td><?=$total_d1?></td>
                        <td><?=$total_n1?></td>
                        <td></td>
                      </tr>
                    </tfoot>
                  </table>
                <?php } ?>    
                <!-- <p style="font-weight:bold">Total Commission : <?php echo $total?></p> -->
                           <!-- 
                              <p style="font-weight:bold">Total Paid : <?php echo $toatlp?></p>
                              
                              <p style="font-weight:bold">Total Due : <?php echo $toatl-$toatlp ?></p> -->
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
</body>
</html>