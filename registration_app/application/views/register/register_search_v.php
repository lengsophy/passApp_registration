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
    <link rel="stylesheet" href="<?php echo asset_url();?>js/datepicker/pikaday.css">
    
    <script src="<?php echo asset_url();?>js/datepicker/pikaday.js"></script>  

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
              <i class="fa fa-table"></i> Register Search By:</div>
            <div class="card-body">
              <!-- Body Section goes here -->
            <form id="myForm"  name="myForm" class="login-form" method="POST" enctype="multipart/form-data" action="">  
              <!-- <div class="form-group row">
                <label class="col-sm-2 col-form-label form-control-sm" for="first_name">First Name :</label>
                <div class="col-sm-3">
                <input class="form-control form-fixer" id="first_name" name="first_name" type="text" >
                </div> 
                <label class="col-sm-2 col-form-label form-control-sm" for="last_name">Last Name (Family Name):</label>
                <div class="col-sm-3">
                <input class="form-control form-fixer" id="last_name" name="last_name" type="text" >
                </div> 
              </div> -->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label form-control-sm" for="driver_id">Driver ID :</label>
                <div class="col-sm-3">
                    <input class="form-control form-fixer" id="driver_id" name="driver_id" type="text" >
                </div> 
                <label class="col-sm-2 col-form-label form-control-sm"  for="phone">Phone Number :</label>
                <div class="col-sm-3">
                    <input class="form-control form-fixer" name="phone"  id="phone" type="text" value=''>
                </div>
                <!-- <label class="col-sm-2 col-form-label form-control-sm" for="vehicle_plate">Plate Number :</label>
                <div class="col-sm-3">
                    <input class="form-control form-fixer" id="vehicle_plate" name="vehicle_plate" type="text" >
                </div>  -->
              </div>
              <!-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label form-control-sm" for="customer_type">Date From:</label>
                    <div class="col-sm-3">
                      <div class='input-group date'>
                        <label for="date-picker-1" class="control-label"> <span class="glyphicon glyphicon-calendar"> </span>
                        </label>
                        <input type='text' class="form-control" name="date_from" id="date_from" autocomplete="off"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                    <label class="col-sm-2 col-form-label form-control-sm" for="customer_type">Date To:</label>
                    <div class="col-sm-3">
                      <div class='input-group date form_date_to'>
                        <input type='text' class="form-control" name="date_to" id="date_to" autocomplete="off"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div> 
              </div> -->
              <div class="form-group row">
                <label class="col-sm-2 col-form-label form-control-sm" for="customer_type"></label>
                <div class="col-sm-3">
                    <input class="btn btn-primary btn-block" id="submit" type="submit" value="Search">
                </div> 
                <!-- <label class="col-sm-2 col-form-label form-control-sm" for="customer_type"></label>
                <div class="col-sm-3">
                    <input class="btn btn-primary btn-block" id="advanced_search" type="button" value="Advanced Search">
                </div>  -->
              </div>
              <div class="form-group border" id="register_info">
                <div class="card-header">
                  <i class="fa fa-user"></i> Register Information</div>
                <div class="form-row">
                    <label class="col-sm-2 col-form-label form-control-sm" for="date_of_birth">Date of Birth:</label>
                    <div class="col-sm-3">
                      <div class='input-group date'>
                        <label for="date-picker-1" class="control-label"> <span class="glyphicon glyphicon-calendar"> </span>
                        </label>
                        <input type='text' class="form-control" name="date_of_birth" id="date_of_birth" autocomplete="off"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                    <!-- <label class="col-sm-2 col-form-label form-control-sm"  for="phone">Phone Number :</label>
                    <div class="col-sm-3">
                        <input class="form-control form-fixer" name="phone"  id="phone" type="text" value=''>
                    </div> -->
                </div>
              </div>
              <div class="form-group border" id="complaint_info">
                <div class="form-group border" id="assign_info">
                    <div class="card-header">
                    <i class="fa fa-ticket"></i> Register Processing Information</div>
                    <div class="form-row">
                        <label class="col-sm-2 col-form-label form-control-sm"  for="customer_type">Assign Department :</label>
                        <div class="col-sm-3">
                            <select name="department" form-fixer data-show-subtext="true" data-live-search="true" id="department" class="form-control">
                                        <option value=""> - Select Department - </option>
                                        <?php
                                            foreach ($department as $row){
                                                echo '<option value="'.$row->id.'">';
                                                echo $row->name;
                                                echo '</option>';
                                            }
                                        ?>
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label form-control-sm"   for="customer_type">Assign to Staff :</label>
                        <div class="col-sm-3">
                            <select name="staff" form-fixer id="staff" class="form-control">
                                        <option value=""> - UnAssign - </option>
                                        <?php
                                            foreach ($staff as $row){
                                                echo '<option value="'.$row->emp_num.'">';
                                                echo $row->name;
                                                echo '</option>';
                                            }
                                        ?>
                            </select>  
                        </div>
                    </div>
                </div>
                <div class="form-group">
                            <input class="btn btn-primary btn-block" id="submit" type="submit" value="Search">
                </div>
            </div>
            <!-- End of Body Section -->
          </form>
          </div>
          <div  class="card-body" id="search_result">
              
          </div>

         
<? 
$this->load->view('footer'); ?>

<script type="text/javascript">
var disable = false, picker = new Pikaday({
        field: document.getElementById('date_from'),
        firstDay: 1,
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [2000,2020],
        format: 'YYYY-MM-DD',
        
        showDaysInNextAndPreviousMonths: true,
        enableSelectionDaysInNextAndPreviousMonths: true
    });
var disable = false, picker = new Pikaday({
        field: document.getElementById('date_to'),
        firstDay: 1,
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [2000,2020],
        
        showDaysInNextAndPreviousMonths: true,
        enableSelectionDaysInNextAndPreviousMonths: true
    });
var disable = false, picker = new Pikaday({
        field: document.getElementById('date_of_birth'),
        firstDay: 1,
        minDate: new Date(2000, 0, 1),
        maxDate: new Date(2020, 12, 31),
        yearRange: [1950,2020],
        
        showDaysInNextAndPreviousMonths: true,
        enableSelectionDaysInNextAndPreviousMonths: true
});

$(function() {
    $('#register_info').hide(); 
    $('#complaint_info').hide(); 
    $('#assign_info').hide(); 
    // $('#advanced_search').click(function(){
    //     if(!$('#register_info').is(':visible')){
    //         $('#register_info').show(); 
    //         $('#complaint_info').show(); 
    //         $('#assign_info').show(); 
    //     } else {
    //         $('#register_info').hide(); 
    //         $('#complaint_info').hide(); 
    //         $('#assign_info').hide(); 
    //     } 
    // });
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
$(document).ready(function() {

            $("#myForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    method : "POST",
                    url : "<?php echo base_url('index.php/register/register_c/register_search_submit/')?>",
                    data : $("#myForm").serialize(),
                    beforeSend : function() {
                          $(".post_submitting").show().html("<center><img src='images/loading.gif'/></center>");
                    },
                    success : function(response) {

                        var data = JSON.parse(response);
                        var html='<div class="table-responsive">';
                        html+='<link href="<?php echo asset_url();?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">'
                        html+='<table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">';
                        html+='<thead>';
                        html+='<tr>';
                        html+='<th>Name</th>';
                        html+='<th>Driver ID</th>';
                        html+='<th>Department</th>';
                        html+='<th>Staff</th>';
                        html+='<th>Status</th>';
                        html+='<th>Create By Staff</th>';
                        html+='<th>Registration Date</th>';
                        html+='</tr>';
                        html+='</thead>';
                        html+='<tbody>';
                        var num = 1;
                        for(var i = 0;i<data.length;i++){
                          html+='<tr>';
                          html+='<td><a href="<? echo site_url();?>/register/register_c/register_view/';
                          html+=data[i].register_id+'">'+data[i].last_name+' '+data[i].first_name+'</a></td>';
                          html+='<td><a href="<? echo site_url();?>/register/register_c/register_view/';
                          html+=data[i].register_id+'">'+data[i].driver_id+'</a></td>';
                          html+='<td><a href="<? echo site_url();?>/register/register_c/register_view/';
                          html+=data[i].register_id+'">'+data[i].department_name+'</a></td>';
                          html+='<td>'+data[i].staff+'</td>';
                          html+='<td>'+data[i].status_name+'</td>';
                          html+='<td>'+data[i].create_by+'</td>';
                          html+='<td>'+data[i].create_date+'</td>';
                          html+='</tr>';
                        }
                        html+='</tbody>';
                        html+='</table>';
                        html+='</div>';
                        $("#search_result").html(html);
                        var myTable = $('#dataTable').DataTable();
                        $(window).scrollTop($('#search_result').offset().top);
                    }
                });
                e.preventDefault();
            });

        });

</script>


