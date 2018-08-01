<!DOCTYPE html>
<html lang="en">
<style>

@media (min-width: 768px) {
 .navbar-brand {
  position: absolute;
  width: 100%;
  left: 0;
  top: 0;
  text-align: center;
  margin: auto;
 }
}
</style>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Pass App - Registration</title>
  <!-- Bootstrap core CSS-->
  <link href="<?php echo asset_url();?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo asset_url();?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo asset_url();?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo asset_url();?>css/sb-admin.css" rel="stylesheet">
  <script src="<?php echo asset_url(); ?>js/jquery/jquery-3.1.1.js" type="text/javascript"></script>


    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo asset_url();?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo asset_url();?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo asset_url();?>vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo asset_url();?>vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo asset_url();?>js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="<?php echo asset_url();?>js/sb-admin-charts.min.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<? echo base_url(); ?>index.php/user/dashboard_user_c">PassApp Registration</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="<? echo base_url(); ?>index.php/user/dashboard_user_c">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
       
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Technical">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion" id='collapse1'>
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Driver Registration</span>
          </a>
          <ul class="sidenav-second-level <?=$this->session->userdata('menu_department')!='collapse1'?'collapse':''?>" id="collapseMulti">
            <li>
              <a href="<? echo base_url(); ?>index.php/register/register_c/register_new">
                <i class="fa fa-fw fa-plus"></i>
                <span class="nav-link-text">New</span>
              </a>
            </li>
            <li>
              <a href="<? echo base_url(); ?>index.php/register/register_c/register_search">
                <i class="fa fa-fw fa-search"></i>
                <span class="nav-link-text">Search Registration</span>
              </a>
            </li>
            <!-- <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Search">
              <a class="nav-link" href="<? //echo base_url(); ?>index.php/register/register_c/register_search">
                <i class="fa fa-fw fa-search"></i>
                <span class="nav-link-text">Search Registration</span>
              </a>
            </li> -->
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Update Driver">
          <a class="nav-link" href="<? echo base_url(); ?>index.php/driver/driver_c/driver_search">
            <i class="fa fa-fw fa-search"></i>
            <span class="nav-link-text">Search Driver</span>
          </a>
        </li>
        <?  
        // $register_count_dept=$this->register_m->count_by_dept();
        // $cashier_count='';
        // $system_count ='';
        // $service_count ='';
        // foreach ($register_count_dept as $row) {
        //     if($row->department_id==4) $service_count='('.$row->no_register.')';
        //     elseif($row->department_id==5) $system_count='('.$row->no_register.')';
        //     elseif($row->department_id==6) $cashier_count='('.$row->no_register.')';
        //     }               
        ?>
        <?if($this->session->userdata('my_department_id')==4 || $this->session->userdata('group_name')== 'Manager') { ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Customer Service">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti3" data-parent="#exampleAccordion" id='collapse3'>
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Customer Service <?//=$service_count?></span>
          </a>
          <ul class="sidenav-second-level <?=$this->session->userdata('menu_department')!='collapse3'?'collapse':''?>" id="collapseMulti3">
          <?if( $this->session->userdata('group_name')== 'Manager'){?>
            <li>
               <a href="<? echo base_url(); ?>index.php/register/register_c/register_list/4/3">Done System <?//=$this->register_m->count_by_status(4,3)==0?'':$this->register_m->count_by_status(4,3)?></a>
            </li>
          <? } else { ?>
            <li>
               <a href="<? echo base_url(); ?>index.php/register/register_c/register_list_by_status/4/3/<?=$this->session->userdata['emp_num']?>">Done System</a>
            </li>
          <? } ?>
          <?if( $this->session->userdata('group_name')== 'Manager'){?>
            <li>
              <a href="<? echo base_url(); ?>index.php/register/register_c/register_list/4/4">Complete</a>
            </li>
          <? } ?>
          <?if( $this->session->userdata('group_name')== 'Manager'){?>
            <li>
            <li>
              <a href="<? echo base_url(); ?>index.php/register/register_c/register_list/4/5">Rejected</a>
            </li>
            </li>
          <? } else { ?>
            <li>
              <a href="<? echo base_url(); ?>index.php/register/register_c//register_list_by_status/4/5/<?=$this->session->userdata['emp_num']?>">Rejected</a>
            </li>
          <? } ?>
            <!-- <li>
              <a href="<? //echo base_url(); ?>index.php/register/register_c/register_list/4/4">Complete <?//=$this->register_m->count_by_status(4,4)==0?'':$this->register_m->count_by_status(4,4)?></a>
            </li>  -->
            
          </ul>
        </li>
      <? } ?>
      <?if($this->session->userdata('my_department_id')==5 || $this->session->userdata('group_name')== 'Manager') { ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Technical">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti1" data-parent="#exampleAccordion" id='collapse2'>
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">System <?//=$system_count?></span>
          </a>
          <ul class="sidenav-second-level <?=$this->session->userdata('menu_department')!='collapse2'?'collapse':''?>" id="collapseMulti1">
            <li>
              <a href="<? echo base_url(); ?>index.php/register/register_c/register_list/5/1">Open</a>
            </li>
          </ul>
        </li>
      <? } ?>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#">
            <i class="fa fa-fw fa-user"></i><?=$this->session->userdata('staff_name')?> |</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container">
      <!-- Breadcrumbs-->
      <!--<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<? //echo base_url(); ?>index.php/user/dashboard_user_c">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><? //echo $page_title; ?></li>
      </ol>
      -->
   <!-- <script type="text/javascript" src="<?php //echo asset_url(); ?>js/menu_session.js"></script> -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#collapse1').on('click', function (e) {

      var isVisible = $("#collapseMulti").is( ":visible" ); 
      if(isVisible==false) 
        {
            var value1='collapse1';
            $("#collapseMulti1").toggleClass("newClass");
         //   $("#collapseMulti2").toggleClass("newClass");
        } 

         $.ajax({
                    method: 'post',
                    url:'<?php echo base_url('index.php/session/menu_c/set_menu_session/')?>'+value1,
                    data:{},
                    dataType: 'json'
        });

    });   
                
    $('#collapse2').on('click', function (e) {

      var isVisible = $("#collapseMulti1").is( ":visible" ); 
      if(isVisible==false) 
        {
            var value1='collapse2';
            $("#collapseMulti").toggleClass("newClass");
           // $("#collapseMulti2").toggleClass("newClass");
        } 
        
         $.ajax({
                    method: 'post',
                    url:'<?php echo base_url('index.php/session/menu_c/set_menu_session/')?>'+value1,
                    data:{},
                    dataType: 'json'
        });

    }); 

    $('#collapse3').on('click', function (e) {

      var isVisible = $("#collapseMulti3").is( ":visible" ); 
      if(isVisible==false) 
        {
            var value1='collapse3';

            $("#collapseMulti").hide;
            $("#collapseMulti1").hide;
        } 

         $.ajax({
                    method: 'post',
                    url:'<?php echo base_url('index.php/session/menu_c/set_menu_session/')?>'+value1,
                    data:{},
                    dataType: 'json'
        });

    });   

    });
</script>
