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
              <i class="fa fa-table"></i> Driver Search By:</div>
            <div class="card-body">
              <!-- Body Section goes here -->
            <form id="myForm"  name="myForm" class="login-form" method="POST" enctype="multipart/form-data" action="">  
              <div class="form-group row">
                <label class="col-sm-2 col-form-label form-control-sm" for="driver_id">Driver ID :</label>
                <div class="col-sm-3">
                    <input class="form-control form-fixer" id="driver_id" name="driver_id" type="text" >
                </div> 
                <label class="col-sm-2 col-form-label form-control-sm" for="vehicle_plate">Plate Number :</label>
                <div class="col-sm-3">
                <input class="form-control form-fixer" id="vehicle_plate" name="vehicle_plate" type="text" >
                </div> 
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label form-control-sm" for="customer_type"></label>
                <div class="col-sm-3">
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
$(document).ready(function() {

            $("#myForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    method : "POST",
                    url : "<?php echo base_url('index.php/driver/driver_c/driver_search_submit/')?>",
                    data : $("#myForm").serialize(),
                    beforeSend : function() {
                          $(".post_submitting").show().html("<center><img src='images/loading.gif'/></center>");
                    },
                    success : function(response) {
                        //alert(response);

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
                        html+='<th>Create By Staff</th>';
                        html+='<th>Registration Date</th>';
                        html+='</tr>';
                        html+='</thead>';
                        html+='<tbody>';
                        var num = 1;
                        for(var i = 0;i<data.length;i++){
                          html+='<tr>';
                          html+='<td><a href="<? echo site_url();?>/driver/driver_c/driver_view/';
                          html+=data[i].id+'">'+data[i].last_name+' '+data[i].first_name+'</a></td>';
                         
                          html+='<td><a href="<? echo site_url();?>/driver/driver_c/driver_view/';
                          html+=data[i].id+'">'+data[i].driver_id+'</a></td>';
                          html+='<td><a href="<? echo site_url();?>/driver/driver_c/driver_view/';
                          html+=data[i].id+'">'+data[i].department_name+'</a></td>';
                          html+='<td>'+data[i].staff+'</td>';
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


