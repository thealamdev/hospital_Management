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

            <div style="text-align: center;" class="mt-2">
                <?php if ($this->session->userdata('no_data')) { ?>

                    <span>
                        <h3 style="color: red;"><?= $this->session->userdata('no_data') ?></h3>
                    </span>

                <?php } ?>
            </div>

            <div class="section-wrapper">

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            
                        
                            <div class="col-lg-6 m-auto">
                            <div class="card-header text-center" style="font-size:20px">Pathology Search Collection</div>
                                <form method="POST" action="admin/search_pathology_list_custom">
                                    <div>
                                        <div class="form-group">
                                            <label for="inputEmail4" class="form-label mt-2" style="font-size:15px"><b>Order ID</b></label>

                                            <div>
                                                <input autocomplete="off" type="text" id="order_id" name="order_id" class=" form-control">
                                            </div>
                                            <div class="sub_btn mt-3 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="control-sidebar-bg shadow white fixed"></div>


    <?php $this->load->view('back/footer_link'); ?>


    <script type="text/javascript">
        $(document).ready(function() {
            var order_all = [];

            $.ajax({
                url: "<?= site_url('admin/get_order_info_all') ?>",
                method: "POST",
                dataType: "json",
                success: function(data) {

                    $.each(data, function(key, value) {
                        order_all.push(value.test_order_id);
                    });

                    $("#order_id").typeahead({
                        source: order_all
                    });


                }

            });

        });
    </script>

</body>

</html>