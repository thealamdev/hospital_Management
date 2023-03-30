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

            <div class="section-wrapper">

                <div class="card">
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 m-auto">
                                        <div class="card-header">
                                            <h4 class="text-center">Pathology Search Collection</h4>
                                        </div>

                                        <div class="card_details">
                                            <form method="POST" action="admin/search_pathology_list">
                                                <label for="">Patient ID:</label>
                                                <input type="text" name="patient_id" class="form-control">
                                                <div class="submit_btn text-center mt-3">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="card my-3 no-b">
                    <div class="card-body">
                        <div class="card-title">Pathology Search Collection</div>
                        <form method="POST" action="admin/search_pathology_list">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="inputEmail4" class="col-form-label">Patient ID</label>

                                    <div class="input-group ml-3">
                                        <input type="text" name="patient_id" class="col-sm-12 form-control">

                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="inputEmail4" class="col-form-label">ddf</label>
                                    <label for="inputEmail4" class="col-form-label">dfd</label>
                                    <label for="inputEmail4" class="col-form-label"></label>
                                    <label for="inputEmail4" class="col-form-label"></label>
                                    <label for="inputEmail4" class="col-form-label"></label>
                                    <label for="inputEmail4" class="col-form-label"></label>
                                    <div class="input-group ml-3">
                                        <button type="submit" class="btn btn-success">Submit</button>

                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div> -->
            </div>
        </div>
    </div>


    <!-- /.right-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg shadow white fixed"></div>


    <?php $this->load->view('back/footer_link'); ?>




</body>

</html>