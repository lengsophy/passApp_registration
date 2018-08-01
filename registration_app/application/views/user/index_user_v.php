<? 
$this->load->view('header'); ?>
      <!-- Icon Cards-->
      <?= @$this->session->flashdata('message'); ?>
            <?php
            if ($page != "") {
                $this->load->view($page);
            }
      ?>
    

<? 
$this->load->view('footer'); ?>