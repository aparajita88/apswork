    
            <?php if(!empty($result)){ ?>
            <h3 class="virtualhead">select a package</h3>
            <div class="parent">                 
                <?php foreach($result as $row){ ?>
                    <div class="child <?php echo $row['css_class']; ?>">
                       <h2><?php echo $row['name']; ?></h2>
                       <p><?php echo $row['details']; ?> </p>
                    </div>
                <?php }?>
            </div>
            <?php }else{ ?>
            <div style="text-align:center;font-size: 18px;text-transform: capitalize;">No Virtual office available</div>
            <?php }
            if(!empty($result)){ ?>
            <div class="parent">
                <?php foreach($result as $row){?>
                <div class="child">
                    <button type="button" class="<?php echo $row['css_class']; ?>" id="btn_<?php echo $row['id']; ?>">select now</button>
                </div>

                <?php }?>
            </div>

             <div class="clearfix"></div>
   <!-- <div class="panel-body">
       <a href="<?php echo base_url(); ?>index.php/business/voffice_agreement" target="rightframe"> <button type="button" class="btn btn-info agreementbtn">view agreement</button></a>
    </div>-->
    
    <div class="panel-body">
  	<div class="form-group sub_text" style="padding-left:15px !important;">
       <a href="<?php echo base_url(); ?>index.php/business/voffice_agreement" target="rightframe"><button type="button" id="add_seat_allocation" class="btn btn-primary"  >View Agreement </button>
  </a></div>
            <?php }?>       
  </section>
  <script>
 $(document).ready(function(){
   $('#add_seat_allocation').attr("disabled", "disabled");
    $('button[id^="btn_"]').click(function(){
    $('#add_seat_allocation').removeAttr("disabled");
    var v_id= $(this).attr("id");
    $('.parent').find('.black').removeClass("black");
    $(this).addClass("black");
    var res = v_id.split("_");
    var v=res[1];
   // alert(v);
    $.ajax({ 
      method: "POST", 
      url: js_site_url+"index.php/business/set_virtualoffice", 
      data: { id:v,}, 
      async: false, 
      success: function(data) { 

      //alert(data);
      
      //  $("#business").html(data.trim()); 
      } 
    });
  
    });

});
 </script>