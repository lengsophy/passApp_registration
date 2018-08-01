<? $this->load->view('header'); ?>
<style type="text/css">
.table-condensed{
  font-size: 12px;
  font-family: Arial;
}
</style>
      <!-- Icon Cards-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-table"></i> <?=$page_title?></div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-condensed" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Driver ID</th>
                      <th>Department</th>
                      <th>Staff</th>
                      <th>Register Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?  foreach ($register_list as $row) {
                       ?>
                      <tr>
                        <td><a href="<? echo site_url();?>/register/register_c/register_view/<?=$row->register_id?>"><?=$row->last_name?> <?=$row->first_name?></a></td>
                        <td><a href="<? echo site_url();?>/register/register_c/register_view/<?=$row->register_id?>"><?=$row->gender=='F'?'Female':'Male'?></a></td>
                        <td><a href="<? echo site_url();?>/register/register_c/register_view/<?=$row->register_id?>"><?=$row->driver_id?></a></td>
                        <td><a href="<? echo site_url();?>/register/register_c/register_view/<?=$row->register_id?>"><?=$row->department_name?></a></td>
                        <td><?=$row->staff?></td>
                        <td><?=$row->create_date?></td>
                      </tr>
                    <? } ?>
                  </tbody>
                </table>
              <!-- Body Section goes here -->
                
              <!-- End of Body Section -->

            </div>
          </div>
<? 
$this->load->view('footer'); ?>



