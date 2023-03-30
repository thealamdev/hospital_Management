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
      <header class="accent-3 relative nav-sticky" style="background: #2B3467;border-top:1px solid #fff">
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

      <div class="section-wrapper">
        <div class="form-group ml-4 mt-4">
          <a href="admin/add_technologiest"><button type="button" class="btn btn-info btn-md "><i class="fa fa-plus-square"></i>&nbsp;Add Technologiest</button></a>

        </div>


        <div class="card my-3 no-b">
          <div class="card-body">
            <!--  <a href="admin/ipd_registration"><button class="btn btn-info btn-md mb-2">Add Patient</button></a> -->

            <table id="test_table" class="table table-striped table-hover data-tables" data-options='{ "paging": false; "searching":false}'>
              <thead class="bg-info">
                <th>SL NO</th>
                <th>Specimen</th>
                <th>Checked By</th>
                <th>Technologist Name</th>
                <th>Electronic Signature</th>
                <th>Action</th>

              </thead>

              <tbody>
                <?php $i = 1;
                foreach ($technologist_list as $key => $value) { ?>
                  <tr>
                    <td align="center"><?= $i ?></td>
                    <td align="center">
                      <?php foreach ($specimen as $spe) {
                        if ($spe['id'] == $value['specimen_id']) {
                          echo $spe['specimen'];
                        }
                      } ?>
                    </td>
                    <td align="center"><?= $value['checked_by_name'] ?></br><?= $value['checked_by_designation'] ?></br><?= $value['checked_by_address'] ?></br><?= $value['checked_add_1'] ?><br><?= $value['checked_add_2'] ?></td>

                    <td align="center"><?= $value['prepared_by_name'] ?></br><?= $value['prepared_by_designation'] ?></br><?= $value['prepared_by_address'] ?></br><?= $value['prepared_add_1'] ?><br><?= $value['prepared_add_2'] ?></td>

                    <td align="center"><?= $value['technologist_name'] ?></br><img width="40px" src="<?php echo base_url('uploads/hospital_logo/' . $value['technologist_designation']); ?>" alt="Image description"> </br><?= $value['technologist_address'] ?></br><?= $value['technologist_add_1'] ?></br><?= $value['technologist_add_2'] ?>
                    </td>


                    <td align="center">
                      <!-- <a href="admin/edit_technologiest/<?= $value['id'] ?>" class="btn btn-primary btn-sm">Edit</a> -->

                      <?php foreach ($specimen as $spe) {
                        if ($spe['id'] == $value['specimen_id']) { ?>
                          <a href="admin/edit_technologiest/<?= $value['id'] ?>/<?= $spe['id'] ?>" class="btn btn-primary btn-sm">
                            <?= "Edit" ?>
                          </a>

                      <?php }
                      } ?>




                    </td>
                  </tr>
                <?php $i++;
                }
                ?>
              </tbody>
            </table>
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

  <?php $this->load->view('back/footer_link'); ?>



</body>

</html>
