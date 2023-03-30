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
      <div class="container">
        <div class="mt-sm-3 shadow-lg p-3 mb-5 rounded">  
          <form method="post" enctype="multipart/form-data" action="admin/edit_hospital_form_post/<?=$hospital_info[0]['hospital_id']?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                 <label for="hospital_title" class="col-sm-12 control-label">Hospital Title</label>
                 <div class="col-sm-10">
                   <input class="form-control" name="hospital_title" value="<?=$hospital_info[0]['hospital_title']?>" id="hospital_title" placeholder="Hospital Title" type="text" required="">
                 </div>
               </div>
               <div class="form-group">
                 <label for="director_name" class="col-sm-12 control-label">Director Name</label>

                 <div class="col-sm-10">
                   <input value="<?=$hospital_info[0]['director']?>" class="form-control" name="director" id="director" placeholder="Director Name" type="text">
                 </div>
               </div>

               <div class="form-group">
                 <label for="telephone_no" class="col-sm-12 control-label">Telephone No</label>

                 <div class="col-sm-10">
                  <input value="<?=$hospital_info[0]['telephone']?>" class="form-control" name="telephone" id="telephone" placeholder="Telephone No" type="text">

                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               <label for="hospital_logo" class="col-sm-12 control-label">Hospital Logo</label>
               <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 150px;">
                  <img style="width: 100%;height: 100%" src="uploads/hospital_logo/<?=$hospital_info[0]['hospital_logo']?>" alt="...">
                </div>
                <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                <div>
                  <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="hospital_logo" name="file"></span>
                  <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                </div>
              </div>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
             <label for="email" class="col-sm-2 control-label">Email</label>
             <div class="col-sm-10">
               <input value="<?=$hospital_info[0]['email']?>" class="form-control" name="email" id="email" placeholder="Email" type="email">
             </div>
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             <label for="fax" class="col-sm-2 control-label">Fax</label>
             <div class="col-sm-10">
               <input value="<?=$hospital_info[0]['fax']?>" class="form-control" name="fax" id="fax" placeholder="Fax" type="text">
             </div>
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
             <label for="address_no_1" class="col-sm-12 control-label">Addrees No 1</label>
             <div class="col-sm-10">
              <textarea class="form-control" name="address_1" id="address_1" placeholder="Addrees No 1"><?=$hospital_info[0]['address_1']?></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
           <label for="address_no_2" class="col-sm-12 control-label">Addrees No 2</label>
           <div class="col-sm-10">
            <textarea class="form-control" name="address_2" id="address_2" placeholder="Addrees No 2"><?=$hospital_info[0]['address_2']?></textarea>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
         <label for="mobile_no" class="col-sm-12 control-label">Mobile No</label>

         <div class="col-sm-10">
           <input value="<?=$hospital_info[0]['mobile_no']?>" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No" type="text">
         </div>
       </div>
     </div>
     <div class="col-md-6">
      <div class="form-group">
       <label for="country" class="col-sm-12 control-label">Country</label>
       <div class="col-sm-10">
         <select class="custom-select select2 form-control" name="country_id" id="country">
           <option value="">Select Country</option>

           <?php foreach ($country_info as $key => $value) {

            if($value['id']==$hospital_info[0]['country_id'])
            { ?>
              <option selected value="<?=$value['id']?>"><?=$value['nicename']?></option>

          <?php  } else { ?>

            <option value="<?=$value['id']?>"><?=$value['nicename']?></option>


         <?php } }?>
          
        </select>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
     <label for="division" class="col-sm-2 control-label">Division</label>
     <div class="col-sm-10">
       <select class="custom-select select2 form-control" name="division" id="division">
        <option value="">Select Division</option>

           <?php foreach ($divisions_info as $key => $value) {

            if($value['id']==$hospital_info[0]['division_id'])
            { ?>
              <option selected value="<?=$value['id']?>"><?=$value['name']?></option>

          <?php  } else { ?>

            <option value="<?=$value['id']?>"><?=$value['name']?></option>


         <?php } }?>
       </select>
     </div>
   </div>
 </div>
 <div class="col-md-6">
  <div class="form-group">
   <label for="district" class="col-sm-2 control-label">District</label>
   <div class="col-sm-10">
     <select class="custom-select select2 form-control" name="district" id="district">
      <option value="">Select District</option>

           <?php foreach ($districts_info as $key => $value) {

            if($value['id']==$hospital_info[0]['district_id'])
            { ?>
              <option selected value="<?=$value['id']?>"><?=$value['name']?></option>

          <?php  } else { ?>

            <option value="<?=$value['id']?>"><?=$value['name']?></option>


         <?php } }?>
     </select>
     <input type="hidden" id="district_id_hidden" name="">
   </div>
 </div>
</div>
<div class="col-md-6">
  <div class="form-group">
    <label for="area" class="col-sm-2 control-label">Area</label>
    <div class="col-sm-10">
     <select class="custom-select select2 form-control" name="area" id="area" required>

      <option value="">Select Area</option>

           <?php foreach ($area_info as $key => $value) {

            if($value['area_id']==$hospital_info[0]['area_id'])
            { ?>
              <option selected value="<?=$value['area_id']?>"><?=$value['area_title']?></option>

          <?php  } else { ?>

            <option value="<?=$value['area_id']?>"><?=$value['area_title']?></option>


         <?php } }?>
     </select>
   </div>
 </div>
</div>

<div class="col-md-6">
  <div class="form-group">
   <label for="hospital_title_r_eng" class="col-sm-12 control-label">Hospital Title English (Report)</label>

   <div class="col-sm-10">
     <input value="<?=$hospital_info[0]['hospital_title_eng_report']?>" class="form-control" name="hospital_title_r_eng" id="hospital_title_r_eng" placeholder="Ex: Demo Hospital" type="text">
   </div>
 </div>
</div>

<div class="col-md-6">
  <div class="form-group">
   <label for="hospital_title_r_ban" class="col-sm-12 control-label">Hospital Title Bangla (Report)</label>

   <div class="col-sm-10">
     <input value="<?=$hospital_info[0]['hospital_title_ban_report']?>" class="form-control" name="hospital_title_r_ban" id="hospital_title_r_ban" placeholder="Ex: ডেমো হাসপাতাল" type="text">
   </div>
 </div>




 <div class="form-group">
   <label for="others_r" class="col-sm-12 control-label">Others (Ex: Mobile, Email, Others) (Report)</label>

   <div class="col-sm-10">
    <textarea class="form-control" name="others_r" id="others_r" rows="3"><?=$hospital_info[0]['others_report']?></textarea>
   </div>
 </div>




 <div class="form-group">
   <label for="address_r" class="col-sm-12 control-label">Address (Report)</label>

   <div class="col-sm-10">
    <textarea class="form-control" name="address_r" id="address_r" placeholder="Address" rows="3"><?=$hospital_info[0]['address_report']?></textarea>

    
   </div>
 </div>
</div>

<div class="col-md-4">
  <div class="form-group">
    <label for="hospital_logo" class="col-sm-12 control-label">Dashboard Image</label>
    <div class="fileinput fileinput-new" data-provides="fileinput">
      <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 150px;">
        <img style="width: 100%;height: 100%" src="uploads/dashboard_img/<?=$hospital_info[0]['dashboard_img']?>" alt="...">
      </div>
      <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
      <div>
        <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="hospital_logo" name="dashboard_img"></span>
        <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
      </div>
    </div>
  </div>
</div>





</div>
<div class="row">
  <div class="col-md-5"></div>
  <div class="col-md-5">
   <button type="submit" class="btn btn-success">Submit</button>
 </div>
</div>
</div>
</form>
</div>
</div>
</div>
</div> 
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<?php $this->load->view('back/footer_link');?>
<script type="text/javascript">

  $(document).ready(function(){

    $(document).on('change','#country', function(event)
    {
     var country_id=$( "#country option:selected" ).val();
         // alert(division_id);
         if(country_id==0)
         {
          $("#division").empty();
          $("#division").append('<option value="0">Select Division Name</option>');
        }
        else
        {
         $("#division").empty();
         $("#division").append('<option value="0">Select division Name</option>');
         $.ajax({  
          url:"<?=site_url('admin/get_all_division')?>",  
          method:"POST",
          data:{country_id:country_id},  
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data, function (key, value) {

            $("#division").append('<option value="' + value.id + '">' + value.name + '</option>');
          });
         },
         error: function(e) 
         {
          alert(e);
        }
      });

       }
     });
    
    $(document).on('change','#division', function(event)
    {
     var division_id=$( "#division option:selected" ).val();
         // alert(division_id);
         if(division_id==0)
         {
          $("#district").empty();
          $("#district").append('<option value="0">Select District Name</option>');
        }
        else
        {
         $("#district").empty();
         $("#district").append('<option value="0">Select District Name</option>');
         $.ajax({  
          url:"<?=site_url('admin/get_all_district')?>",  
          method:"POST",
          data:{division_id:division_id},  
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data, function (key, value) {

            $("#district").append('<option value="' + value.id + '">' + value.name + '</option>');
          });
         },
         error: function(e) 
         {
          alert(e);
        }
      });

       }
     });

    $("#area").append('<option value="0">Select Area Name</option>');
    $(document).on('change','#district', function(event)
    {

     var district_id=$("#district option:selected" ).val();
         // alert(district_id);
         
         if(district_id==0)
         {
          $("#area").empty();
          $("#area").append('<option value="0">Select Area Name</option>');
        }
        else
        {

         $("#area").empty();
         $("#area").append('<option value="0">Select Area Name</option>');
         $.ajax({  
          url:"<?=site_url('admin/get_all_area')?>",  
          method:"POST",
          data:{district_id:district_id},  
          dataType:"json",  
          success:function(data)  
          { 
           $.each(data, function (key, value) {
                              // $.each(value, function (key, value) {
                                $("#area").append('<option value="' + value.area_id + '">' + value.area_title + '</option>');
                              });
                          // });
                        },
                        error: function(e) 
                        {
                          alert(e);
                        }
                      });

       }
     });
  });
</script>
</body>
</html>