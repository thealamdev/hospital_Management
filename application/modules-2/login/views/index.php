<?php $this->load->view('back/header_link');?>
<body class="light">
  <?php if (isset($message)) { ?>
    <CENTER><h3 style="color:green;"><?php echo $message ?></h3></CENTER><br>
<?php } ?>
<?php echo validation_errors(); ?>

<?php if($this->session->userdata('warn_msg')!=""){ ?>
    
    <CENTER><h2 style="color:red"><?=$this->session->userdata('warn_msg')?></h2><CENTER>
        
    <?php } $this->session->unset_userdata('warn_msg');?>

    <!-- Pre loader -->
    <div id="loader" class="loader">
        <div class="plane-container">
            <div class="preloader-wrapper small active">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div><div class="gap-patch">
                        <div class="circle"></div>
                    </div><div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <main>
            <div id="primary" class="p-t-b-100 height-full">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-4 mx-md-auto paper-card">
                            <div class="text-center">
                                <img src="back_assets/img/dummy/logo.jpg" style="width: 100px; height: 100px;" alt="">
                                <h3 class="mt-2">Hospital ERP</h3>
                                <p class="p-t-b-20">Manage Your Hospital</p>
                            </div>
                            <form method="post">
                                <div class="form-group has-icon"><i class="icon-envelope-o"></i>
                                    <input type="text" class="form-control form-control-lg"
                                    name="username" placeholder="Username">
                                </div>
                                <div class="form-group has-icon"><i class="icon-user-secret"></i>
                                    <input type="password" class="form-control form-control-lg"
                                    name="password" placeholder="Password">
                                </div>
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Log In">
                                
                                
                            </a>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php $this->load->view('back/footer_link');?>