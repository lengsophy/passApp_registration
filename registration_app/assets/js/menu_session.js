$(document).ready(function() {
    $('#collapse1').on('click', function (e) {

      var isVisible = $("#collapseMulti").is( ":visible" ); 
      if(isVisible==false) 
        {
            var value1='collapse1';
        } 
         alert(isVisible);
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
        } 
        
         $.ajax({
                    method: 'post',
                    url:'<?php echo base_url('index.php/session/menu_c/set_menu_session/')?>'+value1,
                    data:{},
                    dataType: 'json'
        });

    }); 

    $('#collapse3').on('click', function (e) {

      var isVisible = $("#collapseMulti2").is( ":visible" ); 
      if(isVisible==false) 
        {
            var value1='collapse3';
        } 
        alert(isVisible);
         $.ajax({
                    method: 'post',
                    url:'<?php echo base_url('index.php/session/menu_c/set_menu_session/')?>'+value1,
                    data:{},
                    dataType: 'json'
        });

    });   

    });


