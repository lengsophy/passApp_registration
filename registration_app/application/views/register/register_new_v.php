<? $this->load->view('header'); ?>
<script src="<?php echo asset_url(); ?>js/jquery/jquery-3.1.1.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo asset_url();?>js/datepicker/pikaday.css">    
<script src="<?php echo asset_url();?>js/datepicker/pikaday.js"></script>  
      <!-- Icon Cards-->
          <div class="card mx-auto mb-3">
            <div class="card-header">
              <i class="fa fa-ticket"></i> Driver Creation</div>
            <div class="card-body">
              
              <!-- Body Section goes here -->
                <?//= $this->session->flashdata('msg');  ?>
                <?php
                      echo $this->session->flashdata('msg');
                ?>
                <form  name="myForm" id="myForm" class="login-form" method="POST" action="<?php //echo site_url('register/register_c/register_create'); ?>" enctype="multipart/form-data">
                  <div class="form-row">
                        <div class="col-sm-3 form-control-sm">
                          <label for="driver_id">Driver ID </label>&nbsp;<span id='driver_span'></span>
                          <input class="form-control" id="driver_id" name="driver_id" type="text" required="required">
                        </div>
                        
                  </div>
                  <div class="form-group border" id="customer_info">
                    <div class="card-header">
                    <i class="fa fa-user"></i> Register Information</div>
                    <div class="form-row">
                      <div class="col-sm-3 form-control-sm">
                        <label for="first_name">First Name</label>
                        <input class="form-control" id="first_name" name="first_name" type="text" placeholder="">
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="last_name">Last Name (Family's name)</label>
                        <input class="form-control" id="last_name" name="last_name" type="text" placeholder="">
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="gender">Gender</label><br/>
                        <input type="radio" name="gender" value="M" checked> Male &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="gender" value="F" > Female
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="nationality_id">Nationality</label>
                        <select name="nationality_id" id="nationality_id" class="form-control">
                          <option value="33">Cambodian</option>
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
                          <input type='text' class="form-control" name="date_of_birth" id="date_of_birth" autocomplete="off"/>
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                        </div>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="id_card_number">ID Card Number</label>
                        <input class="form-control" id="id_card_number" name="id_card_number" type="text" placeholder="">
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="house_number">House Number</label>
                        <input class="form-control" id="house_number" name="house_number" type="text" placeholder="">
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="street">Street</label>
                        <input class="form-control" id="street" name="street" type="text" placeholder="">
                      </div>
                      <div class="col-md-3 form-control-sm">
                        <label for="province">Province</label>
                        <select name="province" id="province" class="form-control">
                                    <option value=""> - Select Province -</option>
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
                        </select>
                      </div>
                      <div class="col-md-3 form-control-sm">
                        <label for="commune">Commune</label>
                        <select name="commune" id="commune" class="form-control">
                        </select>
                      </div>
                      <div class="col-md-3 form-control-sm">
                        <label for="village">Village</label>
                        <input class="form-control" id="village" name="village" type="text" placeholder="">
                      </div>
                      <div class="col-sm-3 form-control-sm">
                        <label for="phone_number">Phone Number&nbsp;<span id='phone_span'></label>
                        <input class="form-control" id="phone_number" name="phone_number" type="text" placeholder="">
                      </div>
                    </div>
                  <br/>
                  </div>
                  <div class="form-group border" id="vehicle_info">
                      <div class="card-header">
                      <i class="fa fa-car"></i> Vehicle Information</div>
                      <div class="form-row">
                        <div class="col-md-3 form-control-sm">
                          <label for="service">Service</label>
                          <select name="service" id="service" class="form-control">
                                  <option value="1">- Select Service -</option>
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
                          </select>
                        </div>
                        <div class="col-sm-3 form-control-sm">
                          <label for="model_year">Model Year</label>
                          <input class="form-control" id="model_year" name="model_year" type="text" placeholder="">
                        </div>
                        <div class="col-sm-3 form-control-sm">
                          <label for="vehicle_color_id">Color</label>
                          <select name="vehicle_color_id" id="vehicle_color_id" class="form-control">
                            <option value="">- Select Color -</option>
                            <?php
                                foreach($color as $key){
                                  echo '<option value="'.$key->id.'">';
                                  echo $key->name;
                                  echo '</option>';
                                }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="col-sm-3 form-control-sm">
                          <label for="plate">Plate Number</label>&nbsp;<span id='plate_span'></span>
                          <input class="form-control" id="plate" name="plate" type="text" placeholder="">
                        </div>
                      </div>
                      <br/>
                  </div>
                  <div class="form-group border" id="attachment_info">
                    <div class="card-header">
                    <i class="fa fa-file"></i> Attachment Document</div>
                    <div class="form-row">
                      <div class="col-sm-3 form-control-sm">   
                        <input id="id_card_status" name="id_card_status" type="checkbox" value=''/>
                        <label for="id_card_status">ID Card</label>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                          <input id="drive_licences_status" name="drive_licences_status" type="checkbox" value=''>
                          <label for="drive_licences_status">Driving licences</label>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                          <input id="vehicle_iden_status" name="vehicle_iden_status" type="checkbox" value=''>
                          <label for="vehicle_iden_status">Vehicle Identification</label>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-sm-3 form-control-sm">
                            <input id="family_book_status" name="family_book_status" type="checkbox" value=''>
                            <label for="family_book_status">Family Book</label>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                          <input id="residen_book_status" name="residen_book_status" type="checkbox" value=''>
                          <label for="residen_book_status">Residential book</label>
                      </div>
                      <div class="col-sm-3 form-control-sm">
                          <input id="accredit_book_status" name="accredit_book_status" type="checkbox" value=''>
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
                  <div class="form-group">
                        <input class="btn btn-primary btn-block" type="submit" id="submit" value="Submit to System">
                  </div>
                  <!-- <a class="btn btn-primary btn-block" onclick="document.getElementById('myform').submit()">Login</a> -->
                 
                </form>

              <!-- End of Body Section -->
              <!-- Modal Existing Data-->
                <div class="modal fade" id="myExisting_data" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <span style="color:red;margin:0 auto;" class="textExisting center"></span>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
<? 
$this->load->view('footer'); ?>

<script type="text/javascript">
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
  /** @FORM POST Submit */
  $(document).ready(function(event) {
    // function check_data(){
    //           var driver_id = $('#driver_id').val();
    //           var phone = $('#phone_number').val();
    //           var plate = $('#plate').val();
    //           var session = "";
    //           $.ajax({
    //             method: 'post',
    //             url:'<?php //echo base_url('index.php/register/register_c/check_data_form/')?>' + driver_id + '/' + phone + '/' + plate,
    //             data:{},
    //             dataType: 'json',
    //             success:function (data) {
    //               if(data != true){
    //                 $(".textExisting").html(data);
    //                 $("#myExisting_data").modal("show");
    //                 session = data;
    //               } else {
    //                 session = "";
    //               }
    //             } 
    //           });
    //           return session;
    // }
    $('#myForm').on('submit', function(e) {
            
                e.preventDefault();
                var driver_id = $('#driver_id').val();
                var phone = $('#phone_number').val();
                var plate = $('#plate').val();
                $.ajax({
                    method: 'post',
                    url:'<?php echo base_url('index.php/register/register_c/check_data_form/')?>' + driver_id + '/' + phone + '/' + plate,
                    data: $("#myForm").serialize(),
                    dataType: 'json',
                    success:function (data) {
                      if(data.status == false){
                        $(".textExisting").html(data.message);
                        $("#myExisting_data").modal("show");
                      } else {
                        console.log(data);
                        window.location.href = "/register_view/"+data.id;
                      }
                    } 
                });
    });
  });
  /** @ Get Staff list By Department ID*/
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
  $(document).on("change", '#service', function(e) {
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
            // $(this).setCustomValidity('Driver Id Already Exist');
            if(driver_id !=''){              
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
    $("#plate").keyup(function(e) {
            var plate = $(this).val();
           // $(this).setCustomValidity('Driver Id Already Exist');
            if(plate !=''){              
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
    $("#phone_number").keyup(function(e) {
            var phone = $(this).val();
           // $(this).setCustomValidity('Driver Id Already Exist');
            if(phone !=''){              
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
  $(document).ready(function(){
    $("input:checkbox").val(0);
  });
  $(document).on("change", 'input:checkbox', function(e) {
        $(this).attr('checked','checked');
        $(this).val(1);
  });
  $(document).on("click", 'input:label', function(e) {
        $(this).attr('checked','checked');
        $(this).val(1);
  });
</script>