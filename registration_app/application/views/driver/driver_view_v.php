<? $this->load->view('header'); ?>
<script src="<?php echo asset_url(); ?>js/jquery/jquery-3.1.1.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo asset_url();?>js/datepicker/pikaday.css">    
<script src="<?php echo asset_url();?>js/datepicker/pikaday.js"></script>  
<script src="https://cdn.jsdelivr.net/momentjs/2.13.0/moment.min.js"></script>
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
          <form  name="myForm" class="login-form" method="POST" action="<?php echo site_url('driver/driver_c/driver_update'); ?>" enctype="multipart/form-data">
            <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-table"></i> Driver View</div>
              <div class="card-body">
                <!-- Body Section goes here -->
                <!-- Hidden Value -->
                <input type="hidden"  id="id"  name="id" value='<?=$dri["id"]?>'>
                <input type="hidden"  id="old_phone_num"  name="old_phone_num" value='<?=$dri["phone"]?>'>
                <input type="hidden"  id="old_driver_id"  name="old_driver_id" value='<?=$dri["driver_id"]?>'>
                <input type="hidden"  id="old_plate_num"  name="old_plate_num" value='<?=$dri["vehicle_plate"]?>'>
                <div class="form-group">
                        <div class="col-sm-3 form-control-sm">
                          <label for="driver_id">Driver ID<span id='driver_span'></span></label>
                          <input class="form-control" id="driver_id" name="driver_id" type="text" value='<?=$dri["driver_id"]?>'>
                        </div>
                </div>
                <div class="form-group border" id="customer_info">
                    <div class="card-header">
                    <i class="fa fa-user"></i> Driver Information</div>
                    <div class="form-row">
                      <div class="col-sm-3 form-control-sm">
                        <label for="first_name">First Name</label>
                        <input class="form-control" type="text" id="first_name" name="first_name" value='<?=$dri["first_name"]?>'>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="last_name">Last Name (Family's name)</label>
                        <input class="form-control" type="text" id="last_name" name="last_name" value='<?=$dri["last_name"]?>'>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="gender">Gender</label><br/>
                        <input type="radio" name="gender" value="M" <?=$dri["gender"]=='M'?'checked':''?>> Male &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="F" <?=$dri["gender"]=='F'?'checked':''?>> Female
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="nationality_id">Nationality</label>
                        <select name="nationality_id" id="nationality_id" class="form-control">
                            <option value='<?=$dri["nationality_id"]?>'><?=$dri["nationality_name"]?></option>
                            <?php
                                foreach($nationality as $key){
                                  echo '<option value="'.$key->id.'">';
                                  echo $key->name;
                                  echo '</option>';
                                }
                            ?>
                        </select>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="date_of_birth">Date of Birth (Month/Date/Year)</label>
                        <div class='input-group date'>
                          <input type='text' class="form-control" name="date_of_birth" id="date_of_birth" value='<?=$dri["date_of_birth"]?>' autocomplete="off"/>
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="id_card_number">ID Card Number</label>
                        <input class="form-control" type="text" id="id_card_number" name="id_card_number" value="<?=$dri["id_card_number"]?>">
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="house_number">House Number</label>
                        <input class="form-control" type="text" id="house_number" name="house_number" value='<?=$dri["house_number"]?>'>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="street">Street</label>
                        <input class="form-control" type="text" id="street" name="street" value="<?=$dri["street"]?>">
                      </div>
                      <div class="col-md-3 form-control-sm">
                        <label for="province">Province</label>
                        <select name="province" id="province" class="form-control">
                                    <option value='<?=$dri["pro_id"]?>'><?=$dri["province"]?></option>
                                    <?php
                                        foreach ($province as $row){
                                            echo '<option value="'.$row->pro_id.'">';
                                            echo $row->pro_name_kh;
                                            echo '</option>';
                                        }
                                    ?>
                        </select>
                      </div>
                      <div class="col-md-3 form-control-sm">
                        <label for="district">District</label>
                        <select name="district" id="district" class="form-control">
                          <option value='<?=$dri["dis_id"]?>'><?=$dri["district"]?></option>
                        </select>
                      </div>
                      <div class="col-md-3 form-control-sm">
                        <label for="commune">Commune</label>
                        <select name="commune" id="commune" class="form-control">
                          <option value='<?=$dri["com_id"]?>'><?=$dri["commune"]?></option>
                        </select>
                      </div>
                      <div class="col-md-3 form-control-sm">
                        <label for="village">Village</label>
                        <input class="form-control" type="text" id="village" name="village" value='<?=$dri["village"]?>'>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="phone">Phone Number<span id='phone_span'></span></label>
                        <input class="form-control" type="text" id="phone" name="phone" value='<?=$dri["phone"]?>'>
                      </div>
                    </div>
                  <br/>
                </div>
                <div class="form-group border" id="vehicle_info">
                      <div class="card-header">
                      <i class="fa fa-car"></i> Vehicle Information</div>
                      <div class="form-row">
                        <div class="col-md-3 form-control-sm">
                          <label for="service_id">Service</label>
                          <select name="service_id" id="service_id" class="form-control">
                                  <option value='<?=$dri["service_id"]?>'><?=$dri["service_name"]?></option>
                                    <?php
                                        foreach ($service as $row){
                                            echo '<option value="'.$row->id.'">';
                                            echo $row->name;
                                            echo '</option>';
                                        }
                                    ?>
                          </select>  
                        </div>
                        <div class="col-sm-3 form-control-sm">
                          <label for="vehicle_model_id">Model</label>
                          <select name="vehicle_model_id" id="vehicle_model_id" class="form-control">
                            <option value='<?=$dri["vehicle_model_id"]?>'><?=$dri["vehicle_model_name"]?></option>
                          </select>
                        </div>
                        <div class="col-sm-3 form-control-sm">
                          <label for="vehicle_color_id">Color</label>
                          <select name="vehicle_color_id" id="vehicle_color_id" class="form-control">
                            <option value='<?=$dri["vehicle_color_id"]?>'><?=$dri["vehicle_color_name"]?></option>
                            <?php
                                foreach($color as $key){
                                  echo '<option value="'.$key->id.'">';
                                  echo $key->name;
                                  echo '</option>';
                                }
                            ?>
                          </select>
                        </div>
                        <div class="col-sm-3 form-control-sm">
                          <label for="model_year">Model Year</label>
                          <input class="form-control" type="text" id="vehicle_model_year" name="vehicle_model_year" value='<?=$dri["vehicle_model_year"]?>'>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-sm-3 form-control-sm">
                          <label for="vehicle_plate">Plate Number <span id='plate_span'></span></label>
                          <input class="form-control" type="text" id="vehicle_plate" name="vehicle_plate" value='<?=$dri["vehicle_plate"]?>'>
                        </div>
                      </div>
                      <br/>
                </div>
                <div class="form-group border" id="attachment_info">
                    <div class="card-header">
                    <i class="fa fa-file"></i> Attachment Document</div>
                    <div class="form-row">
                      <div class="col-sm-3 form-control-sm">   
                        <input id="id_card_status" name="id_card_status" type="checkbox" value='<?=$dri["id_card_status"]?>' <?=$dri["id_card_status"]!=0?'checked':''?>/>
                        <label for="id_card_status">ID Card</label>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <input id="drive_licences_status" name="drive_licences_status" type="checkbox" value='<?=$dri["drive_licences_status"]?>' <?=$dri["drive_licences_status"]!=0?'checked':''?>>
                          <label for="drive_licences_status">Driving licences</label>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                          <input id="vehicle_iden_status" name="vehicle_iden_status" type="checkbox" value='<?=$dri["vehicle_iden_status"]?>' <?=$dri["vehicle_iden_status"]!=0?'checked':''?>/>
                          <label for="vehicle_iden_status">Vehicle Identification</label>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-3 form-control-sm">
                          <input id="family_book_status" name="family_book_status" type="checkbox" value='<?=$dri["family_book_status"]?>' <?=$dri["family_book_status"]!=0?'checked':''?>/>
                          <label for="family_book_status">Family Book</label>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                          <input id="residen_book_status" name="residen_book_status" type="checkbox" value='<?=$dri["residen_book_status"]?>' <?=$dri["residen_book_status"]!=0?'checked':''?>/>
                          <label for="residen_book_status">Residential book</label>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                          <input id="accredit_book_status" name="accredit_book_status" type="checkbox" value='<?=$dri["accredit_book_status"]?>' <?=$dri["accredit_book_status"]!=0?'checked':''?>/>
                          <label for="accredit_book_status">Accreditation Book</label>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-6 form-control-sm">
                          <label for="filesToUpload">Attached Document</label>
                          <input type="file" id="filesToUpload" multiple="" onChange="makeFileList();" name="files[]" class="form-control">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-6 form-control-sm">
                        <ul id="fileList"><li>No Files Selected</li></ul>
                      </div>
                    </div>
                    <br/>
                  </div>
                <div class="form-group row">
                  <div class="col-sm-6"></div>
                  <input class="btn btn-primary btn-block" id="submit" type="submit" value="Update">
                </div>
                <div class="form-group row border">
                    <ul class="gallery">
                        <?php $i = 1 ?>
                        <?php if(!empty($files)){ foreach($files as $file){ ?>
                              <?php echo $i.'.  <a href="'.base_url('uploads/files/'.$file['file_name']).'">'.$file['file_name'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Uploaded On: '.date("j M Y",strtotime($file['uploaded_on'])).')<br/>' ?>
                              <!-- <img src="<?php //echo base_url('uploads/files/'.$file['file_name']); ?>" >-->
                              <!-- <p>Uploaded On <?php //echo date("j M Y",strtotime($file['uploaded_on'])); ?></p>  -->
                              <?php $i++ ?>
                          
                        <?php } }else{ ?>
                        <p>Image(s) not found.....</p>
                        <?php } ?>
                    </ul>
                </div>   
                <!-- End of Body Section -->
              </div>
            </div>   
          </form>    
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
/**
  --- Piker Date Of birth ---
*/
var disable = false, picker = new Pikaday({
      field: document.getElementById('date_of_birth'),
      firstDay: 1,
      minDate: new Date(1950, 0, 1),
      maxDate: new Date(2019, 12, 31),
      yearRange: [1950,2019],
      format: 'YYYY-MM-DD',
      
      showDaysInNextAndPreviousMonths: true,
      enableSelectionDaysInNextAndPreviousMonths: true
  });
function makeFileList() {
    //get the input and UL list
    var input = document.getElementById('filesToUpload');
    var list = document.getElementById('fileList');

    //empty list for now...
    while (list.hasChildNodes()) {
      list.removeChild(list.firstChild);
    }

    //for every file...
    for (var x = 0; x < input.files.length; x++) {
      //add to list
      var li = document.createElement('li');
      li.innerHTML = 'File ' + (x + 1) + ':  ' + input.files[x].name;
      list.append(li);
    }
}
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
  /** @ Get District By Province ID*/
$(document).on("change", '#province', function(e) {
              var province_id = $(this).val();
              if(province_id !=''){              
                $.ajax({
                    method: 'post',
                    url:'<?php echo base_url('index.php/register/register_c/get_district/')?>'+province_id,
                    data:{},
                    dataType: 'json',
                    success:function (return_data) {
                        var $dis = $("#district");
                        $("#commune").empty();
                        $dis.empty(); // remove old options
                        $dis.append($("<option></option>")
                                .attr("value", '').text(' - Select District - '));
                        $.each(return_data, function(value, key) {
                            $dis.append($("<option></option>").attr("value", key.dis_id).text(key.dis_name_kh));
                        });     
                    } 
                });
              } else {
                $("#district").empty();
                $("#commune").empty();
              }
});
  /** @Get Commune By District ID */
$(document).on("change", '#district', function(e) {
          var district_id = $(this).val();
          if(district_id !=''){              
            $.ajax({
                method: 'post',
                url:'<?php echo base_url('index.php/register/register_c/get_commune/')?>'+district_id,
                data:{},
                dataType: 'json',
                success:function (return_data) {
                    var $com = $("#commune");
                    $com.empty(); // remove old options
                    $com.append($("<option></option>")
                            .attr("value", '').text(' - Select Commune - '));
                    $.each(return_data, function(value, key) {
                        $com.append($("<option></option>").attr("value", key.com_id).text(key.com_name_kh));
                    });     
                } 
            });
          } else {
            $("#commune").empty();
            $("#commune").append($("<option></option>").attr("value", '').text(''));
          }
});
  /** @Get Commune By District ID */
$(document).on("change", '#service_id', function(e) {
        var service_id = $(this).val();
        if(service_id !=''){              
          $.ajax({
              method: 'post',
              url:'<?php echo base_url('index.php/register/register_c/get_vehicle_model/')?>'+service_id,
              data:{},
              dataType: 'json',
              success:function (return_data) {
                  var $com = $("#vehicle_model_id");
                  $com.empty(); // remove old options
                  $com.append($("<option></option>")
                          .attr("value", '').text(' - Select Model - '));
                  $.each(return_data, function(value, key) {
                      $com.append($("<option></option>").attr("value", key.id).text(key.name));
                  });     
              } 
          });
        }
});
/** @Validate Data Driver ID */
$(document).ready(function() {
    $("#driver_id").keyup(function(e) {
            var driver_id = $(this).val();
            var old_driver_id = $('#old_driver_id').val();
            if(driver_id !='' && driver_id != old_driver_id){              
              $.ajax({
                  method: 'post',
                  url:'<?php echo base_url('index.php/register/register_c/check_exist_data_driver_id/')?>'+driver_id,
                  data:{},
                  dataType: 'json',
                  success:function (return_data) {
                    if(return_data == true){
                      $('#driver_span').html('(Already exists..!)');
                      $('#driver_span').css("color", "red");
                    }else{
                       $('#driver_span').html('');
                    }
                  } 
              });
            }
    });
    $("#vehicle_plate").keyup(function(e) {
            var plate = $(this).val();
            var old_plate_num = $('#old_plate_num').val();
            if(plate !='' && plate != old_plate_num){              
              $.ajax({
                  method: 'post',
                  url:'<?php echo base_url('index.php/register/register_c/check_exist_data_plate_id/')?>'+plate,
                  data:{},
                  dataType: 'json',
                  success:function (return_data) {
                    if(return_data == true){
                      $('#plate_span').html('(Already exists..!)');
                      $('#plate_span').css("color", "red");
                    }else{
                       $('#plate_span').html('');
                    }
                  } 
              });
            }
    });
    $("#phone").keyup(function(e) {
            var phone = $(this).val();
            var old_phone_num = $('#old_phone_num').val();
            if(phone !='' && phone != old_phone_num){              
              $.ajax({
                  method: 'post',
                  url:'<?php echo base_url('index.php/register/register_c/check_exist_data_phone/')?>'+phone,
                  data:{},
                  dataType: 'json',
                  success:function (return_data) {
                    if(return_data == true){
                      $('#phone_span').html('(Already exists..!)');
                      $('#phone_span').css("color", "red");
                    }else{
                       $('#phone_span').html('');
                    }
                  } 
              });
            }
    });
  });
</script>

