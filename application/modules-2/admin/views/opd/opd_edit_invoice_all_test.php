                        <table id="test_info_table" class="table table-bordered table-hover data-tables"
                        data-options='{ "paging": false; "searching":false}'>
                        <thead>
                          <tr>
                           <th>SL NO</th>
                           <th>Test Category</th>
                           <th>Test Name</th>
                           <th>Doc Com</th>
                           <!-- <th>Q/C Doc Com</th> -->
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
                           <!-- <td><?=$value['doc_ref_com']?></td> -->

                           <?php
                           $price=$value['price'];
                           $testid=$value['test_id'];
              //echo $quack_doc_id;

                           $sql1 ="select *,testid as dis_test_id from doc_comission_distribution where  doc_id='".$doc_id."' and group_id='".$testid."' and testid=0 and active_status=1 order by doc_com_id desc limit 1";

                           $query1 = $this->db->query($sql1);


                           $sql2 ="select *,testid as dis_test_id from doc_comission_distribution where doc_id='".$doc_id."' and group_id='".$testid."' and testid='".$value['id']."' and active_status=1 order by doc_com_id desc limit 1";

                           $query2 = $this->db->query($sql2);


                           if ($query1->num_rows()==0 && $query2->num_rows()!=0)
                           {
                            foreach ($query2->result() as $row) 
                            {
                              $group_id=$row->group_id;
                              $testid=$row->dis_test_id;
                              $com_type=$row->com_type;
                              $doc_comission=$row->doc_comission;

                              if($testid==$value['id'])
                              {
                                if($com_type==1)
                                {


                                  $quk_ref_com=($price*$doc_comission)/100;  

                                }
                                else if($com_type==2)
                                {
                                  $quk_ref_com=$doc_comission;    
                                }
                                else
                                {
                                  $quk_ref_com=$price-$doc_comission;
                                }
                              }
                            }

                          }
                          elseif ($query1->num_rows()!=0 && $query2->num_rows()==0)
                          {
                            foreach ($query1->result() as $row) 
                            {
                              $group_id=$row->group_id;
                              $testid=$row->dis_test_id;
                              $com_type=$row->com_type;
                              $doc_comission=$row->doc_comission;

                              if($group_id==$value['mtest_id'])
                              {
                                if($com_type==1)
                                {


                                  $quk_ref_com=($price*$doc_comission)/100;  

                                }
                                else if($com_type==2)
                                {
                                  $quk_ref_com=$doc_comission;    
                                }
                                else
                                {
                                  $quk_ref_com=$price-$doc_comission;
                                }
                              }
                            }
                          }
                          else if($query1->num_rows()>0 && $query2->num_rows()>0)
                          {
              // $result=$query2->get();

                            $row2= $query2->row();

              // $result=$query1->get();

                            $row1= $query1->row();

                            if($row2->doc_com_id < $row1->doc_com_id)
                            {
                              foreach ($query1->result() as $row) 
                              {
                                $group_id=$row->group_id;
                                $testid=$row->dis_test_id;
                                $com_type=$row->com_type;
                                $doc_comission=$row->doc_comission;

                                if($group_id==$value['mtest_id'])
                                {
                                  if($com_type==1)
                                  {


                                    $quk_ref_com=($price*$doc_comission)/100;  

                                  }
                                  else if($com_type==2)
                                  {
                                    $quk_ref_com=$doc_comission;    
                                  }
                                  else
                                  {
                                    $quk_ref_com=$price-$doc_comission;
                                  }
                                }
                              }
                            }
                            else
                            {
                              foreach ($query2->result() as $row) 
                              {
                                $group_id=$row->group_id;
                                $testid=$row->dis_test_id;
                                $com_type=$row->com_type;
                                $doc_comission=$row->doc_comission;

                                if($testid==$value['id'])
                                {
                                  if($com_type==1)
                                  {


                                    $quk_ref_com=($price*$doc_comission)/100;  

                                  }
                                  else if($com_type==2)
                                  {
                                    $quk_ref_com=$doc_comission;    
                                  }
                                  else
                                  {
                                    $quk_ref_com=$price-$doc_comission;
                                  }
                                }
                              }
                            }
                          }
                          else
                          {
                            $quk_ref_com=0;
                          }

                          ?>

                          <td><input type="" class="form-control" readonly="" value="<?php echo $quk_ref_com?>" name="" id="quack_<?=$value['id']?>"></td>

                          <td><?=$value['price']?></td>
                          <td><button type="button" id="<?=$value['id']?>" data-sub_test_id="<?=$value['id']?>" data-test_id="<?=$value['mtest_id']?>" data-test="<?=$value['sub_test_title']?>" data-type="<?=$value['type']?>" data-price="<?=$value['price']?>"
                            data-quk_ref_com="<?=$value['quk_ref_com']?>" class="btn btn-primary btn-sm add_this_test"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Add</button></td>
                          </tr>
                          <?php
                          $i++; 
                        } ?>
                      </tbody>
                    </table>