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
             <table class="table">
               <thead>

                 <th>ID</th>
                 <th>Machine Name</th>
                 <th>Actions</th>

               </thead>
               <tbody>
                 <?php foreach ($machines as $machine) {
                  ?>
                   <tr class="text-center">
                     <td><?php echo $machine['id'] ?></td>
                     <td><?php echo $machine['machine_name'] ?></td>
                     <td>
                      <a href="machine/edit/<?php echo $machine['id'] ?>" class="btn btn-primary">Edit</a>
                      <a href="machine/delete/<?php echo $machine['id'] ?>" class="btn btn-danger">Delete</a>
                     </td>
                   </tr>
                 <?php
                  }
                  ?>


               </tbody>
             </table>
           </div>
         </div>
       </div>



       <?php $this->load->view('back/footer_link'); ?>