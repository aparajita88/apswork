<div class="date_panel">
       <div class="closes"><a href="javascript:void(0);"><i class="fa fa-times"></i></a></div>
         <div class="heading_text">
       		 <h2>To Do List</h2>
       		 <a href="javascript:void(0);" class="add_new"><button type="submit" class="btn btn-primary btn_green btn_green1" >ADD NEW</button></a>
         <div class="clearfix"></div>
       </div>
    	<ul>
    	<?php if (!empty($todo)) { ?>
    	<?php foreach ($todo as $key => $value) { ?>
    		<li>
            	<div class="editis"><a href="javascript:void(0);" id="todo_<?php echo $value['id']?>" data-todoid="<?php echo $value['id'];?>"><i class="fa fa-pencil"></i></a></div>		
            	<textarea rows="1" id="todomsg_<?php echo $value['id']?>"><?php echo $value['message'];?></textarea>
            </li>
    	<?php } ?>
    	<?php }else{ ?>
    		<li><textarea rows="1">   No todos are found</textarea></li>
    	<?	} ?>
        </ul>   	
        <form class="add_form" style="display:none;" >
               <div class="form-group">
              	<textarea class="form-control" type="textarea" id="txtrTodo" placeholder="Message" maxlength="140" rows="3"></textarea>
               </div>
                <input type="hidden" id="todoid" value="">
                <button class="btn btn-primary pull-right" name="saveData" id="saveData" type="button">Save</button>
            	<a href="javascript:void(0);" class="add_new_close">
                	<button class="btn btn-default pull-right" name="cancel" id="cancel" type="button">Cancel</button>
                </a>
             </form>	
     <div class="clearfix"></div>   
    </div>
<div class="clearfix"></div>
<script type="text/javascript">
// this dialog box for ToDo List 
$(document).ready(function() {
  var url = '<?php echo base_url(); ?>';
  $(".closes a").click(function(){
    $(".date_min").css({display:"none"});
  });

  $("#open_div").click(function(){
    $(".date_min").css({display:"block"});
  });
    
  $(".add_new").click(function(){
    $('#txtrTodo').val('');
    $('#todoid').val('');
    $(".add_form").css({display:"block"});
  });
  $(".add_new_close").click(function(){
    $('#todoid').val('');
    $('#txtrTodo').val('');
    $(".add_form").css({display:"none"});
  });
  $('a[id^="todo_"]').click(function(){
    var todoid = $(this).attr('data-todoid');
    $('#txtrTodo').val('');
    $('#todoid').val('');
    $('#todoid').val(todoid);
    $('#txtrTodo').val($('#todomsg_'+todoid).val());
    $(".add_form").css({display:"block"});

  });   
    $('#saveData').click(function(){
  var id = $('#todoid').val();
  var message = $('#txtrTodo').val();
  if (message == '') {
    $("#txtrTodo").css("border","1px solid red");
    return false;
  }else{
    $("#txtrTodo").css("border","1px solid #ccc");
    $.ajax({
      type: 'post',
      url: url+"index.php/client/setTodo",
      data: {message: message,id: id},
      async: false,
      dataType : 'json',
      success: function(data, textStatus, jqXHR) {
          //code after success
          console.log("Success Msg: "+textStatus);
          if (data == true) {
            $.ajax({
            type: "GET",
            url: js_site_url+"index.php/client/getTodo",
            //data: { userid: userid },
            dataType: "html",
            success: function(data, textStatus, jqXHR) {
              $(".loding-ajax").css('display','none');
              //code after success
              $(".date_min").html(data);
            },
            error: function(data, textStatus, jqXHR){
              console.log("Error Msg: "+textStatus);
              //code after getting error
            },
            complete: function(data, textStatus, jqXHR){
              console.log("Complete Msg: "+textStatus);
              //code after complete ajax request
            }
            });
          }else{
            $(".date_min").html('Something went wrong !!');
          }
      },
      error: function(data, textStatus, jqXHR){
         console.log("Error Msg: "+textStatus);
         //code after getting error
      },
      complete: function(data, textStatus, jqXHR){
         console.log("Complete Msg: "+textStatus);
         //code after complete ajax request
      }
    });   
  }
   });
});
</script>  

