 <div class="modal fade text-center modal-sm" id="patient_img_modal"  role="dialog" aria-labelledby="modallabel" aria-hidden="true" style="margin: 0 auto">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Patient Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                    <div class="modal-body">
                      <form method="post" action="admin/update_patient_image/<?=$patient_details_info[0]['i_id']?>"  enctype="multipart/form-data">
                       <div class="form-group">
                         <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div class=" border border-secondary fileinput-new thumbnail" style="width: 200px; height: 150px;">
                            <img data-src="holder.js/100%x100%" alt="...">
                          </div>
                          <div class="border border-secondary fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                          <div>
                            <span class="border border-secondary btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" id="patient_image" name="patient_image"></span>
                            <a href="#" class="border border-secondary btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>
                      </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit"  class="btn btn-outline-primary btn-sm"  id="update_patient_img">Update<i class="fa fa-plus ml-1"></i></button>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Close<i class="fa fa-times ml-1" aria-hidden="true"></i></button> 
                          </div>
                        </form>
                        </div>
              </div>
            </div>

