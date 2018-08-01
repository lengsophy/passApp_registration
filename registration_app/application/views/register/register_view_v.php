<? $this->load->view('header'); ?>
<style type="text/css">
.table-condensed{
  font-size: 12px;
  font-family: Arial;
}
input.form-fixer {
    padding-top: 1px;
    margin-top: 5px;
    margin-bottom: 5px;
    font-size: 15px;
    line-height: 20px;
}
img { max-width: 100%; height: auto; }
</style>
      <!-- Icon Cards-->
          <div class="row">
              <div class="col-sm-12" id="alert">
                  <?php
                      echo @$this->session->flashdata('msg');
                  ?>
              </div>
          </div>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> Register View</div>
              <nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
              <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive1" aria-controls="navbarResponsive1" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive1">
                <ul class="navbar-nav">
                
                  <!-- <li class="nav-item" >
                    <a class="nav-link" data-toggle="modal" href="#myModal_reassign">
                      <i class="fa fa-fw fa-dashboard"></i>
                      <span class="nav-link-text">Reassign</span>
                    </a>
                  </li> -->
                  <!-- <li class="nav-item" >
                    <a class="nav-link" data-toggle="modal" href="#myModal_dispatch">
                      <i class="fa fa-fw fa-dashboard"></i>
                      <span class="nav-link-text">Dispatch</span>
                    </a>
                  </li> -->
                  <li class="nav-item" >
                    <a class="nav-link" data-toggle="modal" href="#myModal_addnote">
                      <i class="fa fa-fw fa-dashboard"></i>
                      <span class="nav-link-text">Add Note</span>
                    </a>
                  </li>
                  <?=$reg['department_id']==4?($reg["status_id"]==2 || $reg["status_id"]==3?
                  '<li class="nav-item" >
                    <a class="nav-link" data-toggle="modal" href="#myModal_done">
                      <i class="fa fa-fw fa-dashboard"></i>
                      <span class="nav-link-text">Complete</span>
                    </a>
                  </li>':''):
                    '<li class="nav-item" >
                      <a class="nav-link" data-toggle="modal" href="#myModal_done">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Process to CSV</span>
                      </a>
                    </li>' 
                  ?>
                  <?=$reg['department_id']!=5?'':
                  '<li class="nav-item" >
                      <a class="nav-link" data-toggle="modal" href="#myModal_reject">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Reject</span>
                      </a>
                    </li>'
                  ?>
                </ul>
              </div>
              </nav>
            <div class="card-body">
              <!-- Body Section goes here -->
              <div class="form-group" id="customer_info">
                <div class="form-row">
                  <label class="col-sm-2 col-form-label form-control-sm form-fixer"  for="register_type">Driver ID :</label>
                  <div class="col-sm-2">
                    <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["driver_id"]?>'>
                  </div>
                </div>
              </div>
              <div class="form-group border" id="customer_info">
                <div class="card-header">
                  <i class="fa fa-user"></i> Register Information</div>
                <div class="form-row">
                    <label class="col-sm-2 col-form-label form-control-sm form-fixer"  for="register_type">First Name :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["first_name"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm form-fixer"  for="register_type">Last Name :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["last_name"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Gender :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value="<?=$reg["gender"]=='F'?'Female':'Male'?>">
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Nationality :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["nationality_name"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm form-fixer"  for="register_type">Date of Birth :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["date_of_birth"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">ID Card Number :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value="<?=$reg["id_card_number"]?>">
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm form-fixer"  for="register_type">House Number :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["house_number"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Street :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value="<?=$reg["street"]?>">
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm form-fixer"  for="register_type">Province :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["province"]?>'>
                      <input class="form-control form-fixer" type="hidden" value='<?=$reg["pro_id"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">District :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["district"]?>'>
                      <input class="form-control form-fixer" type="hidden" value='<?=$reg["dis_id"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Commune :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["commune"]?>'>
                      <input class="form-control form-fixer" type="hidden" value='<?=$reg["com_id"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Village :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["village"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Phone Number :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["phone"]?>'>
                    </div>
                </div>
              </div>

              <div class="form-group border" id="driver_info">
                <div class="card-header">
                  <i class="fa fa-car"></i> Vehicle Information</div>
                <div class="form-row">
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Service Type :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["service_name"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Model :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["vehicle_model_name"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Plate Number :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["vehicle_plate"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Model Year :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["vehicle_model_year"]?>'>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm"  for="register_type">Color :</label>
                    <div class="col-sm-2">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["vehicle_color_name"]?>'>
                    </div>
                </div>
              </div>

              <div class="form-group border" id="driver_info">
                <div class="card-header">
                  <i class="fa fa-file"></i> Attachment Document</div>
                  <div class="form-row">
                    <div class="col-sm-2 form-control-sm">   
                      <input id="id_card_status" name="id_card_status" type="checkbox" onclick="return false;" value='<?=$reg["id_card_status"]?>' <?=$reg["id_card_status"]!=0?'checked':''?>/>
                      <label for="id_card_status">ID Card</label>
                    </div>
                    <div class="col-sm-2 form-control-sm">
                        <input id="drive_licences_status" name="drive_licences_status" type="checkbox" onclick="return false;" value='<?=$reg["drive_licences_status"]?>' <?=$reg["drive_licences_status"]!=0?'checked':''?>>
                        <label for="drive_licences_status">Driving licences</label>
                    </div>
                    <div class="col-sm-2 form-control-sm">
                        <input id="vehicle_iden_status" name="vehicle_iden_status" type="checkbox" onclick="return false;" value='<?=$reg["vehicle_iden_status"]?>' <?=$reg["vehicle_iden_status"]!=0?'checked':''?>/>
                        <label for="vehicle_iden_status">Vehicle Identification</label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-2 form-control-sm">
                        <input id="family_book_status" name="family_book_status" type="checkbox" onclick="return false;" value='<?=$reg["family_book_status"]?>' <?=$reg["family_book_status"]!=0?'checked':''?>/>
                        <label for="family_book_status">Family Book</label>
                    </div>
                    <div class="col-sm-2 form-control-sm">
                        <input id="residen_book_status" name="residen_book_status" type="checkbox" onclick="return false;" value='<?=$reg["residen_book_status"]?>' <?=$reg["residen_book_status"]!=0?'checked':''?>/>
                        <label for="residen_book_status">Residential book</label>
                    </div>
                    <div class="col-sm-2 form-control-sm">
                        <input id="accredit_book_status" name="accredit_book_status" type="checkbox" onclick="return false;" value='<?=$reg["accredit_book_status"]?>' <?=$reg["accredit_book_status"]!=0?'checked':''?>/>
                        <label for="accredit_book_status">Accreditation Book</label>
                    </div>
                </div>
              </div>
              <div class="form-group border" id="assign_info">
                <div class="card-header">
                  <i class="fa fa-ticket"></i> Staff Information</div>
                  <div class="form-row">
                      <label class="col-sm-2 col-form-label form-control-sm"  for="customer_type">Assign Department :</label>
                      <div class="col-sm-3">
                      <input class="form-control form-fixer"  readonly="readonly" type="text" value='<?=$reg["department_name"]?>'>
                      </div>
                      <label class="col-sm-2 col-form-label form-control-sm"   for="customer_type">Staff :</label>
                      <div class="col-sm-3">
                      <input class="form-control form-fixer" readonly="readonly" type="text" value='<?=$reg["staff"]?>'>
                      </div>
                  </div>
              </div>
              <? foreach ($note_list as $row) { ?>
              <div class="form-group row border">
                    <label class="col-sm-2 col-form-label form-control-sm"  for="customer_type"><? echo $row->create_by.'<br>'.$row->note_date; ?> </label>
                    <div class="col-sm-10">
                        <textarea class="form-control form-fixer" readonly="readonly"><?=$row->description?></textarea>
                    </div>
              </div>  
            <? } ?>
              <div class="form-group row border">
                    <label class="col-sm-2 col-form-label form-control-sm"  for="customer_type"><? echo $reg["create_by"].'<br>'.$reg["create_date"]; ?> </label>
                    <div class="col-sm-10">
                        <textarea class="form-control form-fixer" readonly="readonly"><?=$reg["description"]?></textarea>
                    </div>
              </div>

              <div class="form-group row border">
                  <ul class="gallery">
                      <?php if(!empty($files)){ foreach($files as $file){ ?>
                      <li class="item">
                          <img src="<?php echo base_url('uploads/files/'.$file['file_name']); ?>" >
                          <p>Uploaded On <?php echo date("j M Y",strtotime($file['uploaded_on'])); ?></p>
                      </li>
                      <?php } }else{ ?>
                      <p>Image(s) not found.....</p>
                      <?php } ?>
                  </ul>
              </div>   
              <!-- End of Body Section -->
            </div>
          </div>


 <div class="container">
  <!-- Modal Reassign-->
  <div class="modal fade" id="myModal_reassign" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span>ReAssign Registration</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<? echo base_url('index.php/register/register_c/register_reassign/').$reg["register_id"]; ?>">
            <div class="form-group">
              <label for="department"><span class="glyphicon glyphicon-user"></span> Department</label>
              <select name="department"  data-show-subtext="true" data-live-search="true" id="department" class="form-control form-fixer">
                          <?php
                              foreach ($department as $row){
                                  echo '<option '.($row->id==$reg["department_id"]? 'selected':'').' value="'.$row->id.'">';
                                  echo $row->name;
                                  echo '</option>';
                              }
                          ?>
              </select>
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Staff</label>
              <select name="staff" id="staff" class="form-control form-fixer">
                          <option value=""> - UnAssign - </option>
                          <?php
                              foreach ($staff as $row){
                                  echo '<option '.($row->emp_num==$myid? 'selected':'').' value="'.$row->emp_num.'">';
                                  echo $row->name;
                                  echo '</option>';
                              }
                          ?>
              </select>  
            </div>
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off" id="submit_reassign"></span> Save</button>
            <input type="hidden" id="register_id" name="register_id" value="<?=$reg["register_id"]?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Dispatch-->
  <div class="modal fade" id="myModal_dispatch" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span>Dispatch Registration</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<? echo base_url('index.php/register/register_c/register_dispatch/').$reg["register_id"]; ?>">
            <div class="form-group">
              <label for="department"><span class="glyphicon glyphicon-user"></span> Department</label>
              <select name="department"  data-show-subtext="true" data-live-search="true" id="department" class="form-control form-fixer">
                          <?php
                              foreach ($department as $row){
                                  echo '<option '.($row->id==$reg["department_id"]? 'selected':'').' value="'.$row->id.'">';
                                  echo $row->name;
                                  echo '</option>';
                              }
                          ?>
              </select>
            </div>
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off" id="submit_reassign"></span> Save</button>
            <input type="hidden" id="register_id" name="register_id" value="<?=$reg["register_id"]?>">
            <input type="hidden" id="old_dept_id" name="old_dept_id" value="<?=$reg["department_id"]?>">
            <input type="hidden" id="old_staff_id" name="old_staff_id" value="<?=$reg["staff_id"]?>">
            <input type="hidden" id="staff_login_id" name="staff_login_id" value="<?=$myid?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Resolve-->
  <div class="modal fade" id="myModal_done" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!-- <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span><?//=$reg["department_id"]==5?'Comfirm Process to CSV':($reg["department_id"]==4?'Comfirm Process to Cashier':'Comfirm Done Payment to CSV')?></h4> -->
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span><?=$reg["department_id"]==5?'Comfirm Process to CSV':'Complete Registration'?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<? echo base_url('index.php/register/register_c/register_done/').$reg["register_id"]; ?>">
            <div class="form-group">
              <label for="note"><span class="glyphicon glyphicon-user"></span> Note:</label>
              <textarea class="form-control form-fixer" id="note" name="note" type="note" placeholder="Note"></textarea>
            </div>
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off" id="submit_reassign"></span> Save</button>
            <input type="hidden" id="status_id" name="status_id" value="<?=$reg["status_id"]?>">
            <input type="hidden" id="register_id" name="register_id" value="<?=$reg["register_id"]?>">
            <input type="hidden" id="old_dept_id" name="old_dept_id" value="<?=$reg["department_id"]?>">
            <input type="hidden" id="old_staff_id" name="old_staff_id" value="<?=$reg["staff_id"]?>">
            <input type="hidden" id="staff_login_id" name="staff_login_id" value="<?=$myid?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Close-->
  <div class="modal fade" id="myModal_reject" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span>Reject Registration</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<? echo base_url('index.php/register/register_c/register_reject/').$reg["register_id"]; ?>">
            <div class="form-group">
              <label for="note"><span class="glyphicon glyphicon-user"></span> Note:</label>
              <textarea class="form-control form-fixer" id="note" name="note" type="note" placeholder="Note"></textarea>
            </div>
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off" id="submit_reassign"></span> Save</button>
            <input type="hidden" id="department_id" name="department_id" value="<?=$reg["department_id"]?>">
            <input type="hidden" id="register_id" name="register_id" value="<?=$reg["register_id"]?>">
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Add Note-->
  <div class="modal fade" id="myModal_addnote" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="color:red;"><span class="glyphicon glyphicon-lock"></span>Add Note to Registration</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form role="form" method="post" action="<? echo base_url('index.php/register/register_c/register_note/').$reg["register_id"]; ?>">
            <div class="form-group">
              <label for="note"><span class="glyphicon glyphicon-user"></span> Note:</label>
              <textarea class="form-control form-fixer" id="note" name="note" type="note" placeholder="Note"></textarea>
            </div>
            <button type="submit" class="btn btn-default btn-success btn-block"><span class="glyphicon glyphicon-off" id="submit_reassign"></span> Save</button>
            <input type="hidden" id="register_id" name="register_id" value="<?=$reg["register_id"]?>">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>           
<? 
$this->load->view('footer'); ?>

<script type="text/javascript">
$(document).ready(function(){
    imageWidth = $('.main img').width();
    parentWidth = $('.main').width();
    if (imageWidth > parentWidth) {
        $('.main img').css('width', '100%');
    }
});
$(document).on("change", '#department', function(e) {
            var department = $(this).val();

            $.ajax({
                method: 'post',
                url:'<?php echo base_url('index.php/register/register_c/get_stafflist/')?>'+department,
                data:{},
                dataType: 'json',
                success:function (return_data) {

                    var $el = $("#staff");
                    $el.empty(); // remove old options
                    $el.append($("<option></option>")
                            .attr("value", '').text(' - UnAssign - '));
                    $.each(return_data, function(value, key) {
                        $el.append($("<option></option>").attr("value", key.emp_num).text(key.name));
                    });     

                } 
            });
    });
</script>

