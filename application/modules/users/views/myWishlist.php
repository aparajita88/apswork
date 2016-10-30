<?php require_once BASEPATH."../assets/front/lib/header.php";  ?> 
<!-- Body -->
<section class="body_section" >
  <div class="container">
    <div class="row">
      <div class="col-lg-12"> 
        
        <div class="tabs text-capitalize"> <a href="#" data-tab="1" class="tab active"><?php echo "<h1><font color='red'>Work on progress.</font></h1>"; exit; ?></a> 
          <div data-content="1" class="content active">
            <div class="tab-head">
              <aside class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-capitalize">
                <!--<h2>plan your party</h2>-->
              </aside>
              <aside class="col-xs-12 col-sm-10 col-md-10 col-lg-10 rightbtns text-uppercase">
                <ul>
                	<li><input type="search" placeholder="Search by party name"></li>
                	<li><input type="search" placeholder="Search by occassion, location"></li>
                    <li>
                    	<div id="dateRangeForm">
                            <div class="date" id="dateRangePicker">
                                <input type="text" class="form-control datepicker1" placeholder="Start Date" name="Start Date" />
                            </div>
                    	</div>
                    </li>
                    <li>
                    	<div id="dateRangeForm">
                            <div class="date" id="dateRangePicker">
                                <input type="text" class="form-control datepicker1" placeholder="End Date" name="End Date" />
                            </div>
                    	</div>
                    </li>
                  	<li><a href="#" class="btn btn-default"><i class="fa fa-search"></i></a></li>
                  	<li><a href="party-creation.html" class="btn btn-default">add new party</a></li>
                </ul>
              </aside>
            </div>
            <div class="form-content">
              <div class="table-responsive">
                <table width="100%" cellpadding="0" cellspacing="0" border="1" class="table mypartylist text-capitalize">
                  <thead>
                    <th width="16%">
                      <a href="#" title="Sort descending">
                        Name
                        <span class="sortable sorted-asc">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="16%">
                      <a href="#" title="Sort ascending">
                        occassion
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="16%">
                      <a href="#" title="Sort ascending">
                        event date
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="16%">
                      <a href="#" title="Sort ascending">
                        event time
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="16%">
                      <a href="#" title="Sort ascending">
                        location
                        <span class="sortable">
                          <b class="caret"></b>
                          <!--<b class="caret flipped"></b>-->
                        </span>
                      </a>
                    </th>
                    <th width="10%">
                      <a href="#" title="Sort ascending">
                        party size 
                      </a>
                    </th>
                    <th width="10%">
                      <a href="#" title="Sort ascending">
                        action
                      </a>
                    </th>
                  </thead>
                  <tbody class="text-capitalize">
                    <tr>
                      <td width="16%"><a href="party-detail-view.html">John's wedding</a></td>
                      <td width="16%">wedding</td>
                      <td width="16%">28/09/2015</td>
                      <td width="16%">09:00am</td>
                      <td width="16%">new york</td>
                      <td width="10%">200</td>
                      <td width="10%"><span class="col-md-6 col-lg-6"><a href="party-detail.html"><i class="fa fa-pencil-square-o"></i></a></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                    <tr>
                      <td><a href="party-detail-view.html">Joe's Birthday</a></td>
                      <td>birthday</td>
                      <td>30/07/2015</td>
                      <td>10:00am</td>
                      <td>new york</td>
                      <td>100</td>
                      <td><span class="col-md-6 col-lg-6"><a href="party-detail.html"><i class="fa fa-pencil-square-o"></i></a></span></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                    <tr>
                      <td><a href="party-detail-view.html">reunion</a></td>
                      <td>get together</td>
                      <td>16/04/2015</td>
                      <td>12:00am</td>
                      <td>new york</td>
                      <td>50 </td>
                      <td><span class="col-md-6 col-lg-6"><a href="party-detail.html"><i class="fa fa-pencil-square-o"></i></a></span></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                    <tr>
                      <td><a href="party-detail-view.html">joe's reception</a></td>
                      <td>reception</td>
                      <td>03/04/2015</td>
                      <td>08:00am</td>
                      <td>new york</td>
                      <td>300</td>
                      <td><span class="col-md-6 col-lg-6"><a href="party-detail.html"><i class="fa fa-pencil-square-o"></i></a></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                    <tr>
                      <td><a href="party-detail-view.html">Doe's Christening</a></td>
                      <td>Christening</td>
                      <td>19/02/2015</td>
                      <td>02:00am</td>
                      <td>new york</td>
                      <td>250</td>
                      <td><span class="col-md-6 col-lg-6"><a href="party-detail.html"><i class="fa fa-pencil-square-o"></i></a></span><span class="col-md-6 col-lg-6"><i class="fa fa-trash-o"></i></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
               <div class="clearfix"></div>
            </div>
            <div class="partylist-footer">
               <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               		<p style="padding-top:4px;">Showing 5 of 8</p>
               </aside>
               <aside class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               		 <ul class="pager mypager">
                        <li><a href="#"><i class="fa fa-angle-left"></i>Previous</a></li>
                        <li><a href="#">Next<i class="fa fa-angle-right"></i></a></li>
                     </ul>
               </aside>
               <div class="clearfix"></div>		
            </div>
          </div>
          
         
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /Body --> 

<!-- Start Footer Section -->
<div class="footer-top">
  <div class="container">
    <div class="row">
      <div><strong><a href="#">Hostmypartyz.com</a></strong> aims to make the experience of hosting a party or a ceremony simpler & convenient by providing power of information and options to host that enables them to choose what they need for hosting their party.</div>
      <div><strong><a href="#">Hostmypartyz.com</a></strong> enables vendors to reach the prospective customer by presenting their abilities & specialities in an online marketplace </div>
      
      <!--<div class="social"><a href="#"><img src="images/social/social-fb.png" alt=""></a><a href="#"><img src="images/social/social-tw.png" alt=""></a><a href="#"><img src="images/social/social-p.png" alt=""></a><a href="#"><img src="images/social/social-in.png" alt=""></a></div>-->
      
      <div class="social social-widget">
        <ul class="social-icons">
          <li><a class="facebook" href="#"><!--<i class="fa fa-facebook"></i>--><img src="images/footer-fb.png" alt="facebook"></a></li>
            <li><a class="twitter" href="#"><!--<i class="fa fa-twitter"></i>--><img src="images/footer-twitter.png" alt="twitter"></a></li>
            <li><a class="google" href="#"><!--<i class="fa fa-pinterest"></i>--><img src="images/footer-pinterest.png" alt="pinterest"></a></li>
            <li><a class="linkdin" href="#"><!--<i class="fa fa-linkedin"></i>--><img src="images/footer-in.png" alt="in"></a></li>
        </ul>
      </div>
      <ul class="breadcrumb">
        <li><a href="#">Venue</a></li>
        <li><a href="#">Catering</a></li>
        <li><a href="#">Decorator</a></li>
        <li><a href="#"> Entertainment/DJs </a></li>
        <li><a href="#"> Photographer</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="copyright-footer">
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-sm-12 col-md-push-2">
        <ul class="breadcrumb">
          <li><a href="#">Help</a></li>
          <li><a href="#">FAQs</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#"> Privacy Policy</a></li>
          <li><a href="#"> Terms of Use</a></li>
        </ul>
        <div class="footer_bottom_content"> &copy; 2015 Copyright HostMyPartyz.com All Rights Reserved. </div>
      </div>
    </div>
  </div>
</div>
<!-- End Footer Section --> 
<link rel="stylesheet" href="css/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(function () {
    
      $('[data-tab]').on('click', function (e) {
        $(this)
          .addClass('active')
          .siblings('[data-tab]')
          .removeClass('active')
          .siblings('[data-content=' + $(this).data('tab') + ']')
          .addClass('active')
          .siblings('[data-content]')
          .removeClass('active');
        e.preventDefault();
      });
      
    });
    </script> 
    
<!-- Scroll Pop up -->    
<script type="text/javascript" src="js/GScroll.js"></script> 
<script type="text/javascript">
		$(document).ready(function(){
			$('#content005').GScroll();
			//$('#content3').GScroll({height: 100});
			$('<a href=""></a>')
		});
	</script>
<!-- /Scroll Pop up -->      
<script type="text/javascript">
            $(function () {
				$( ".datepicker1" ).datepicker();
            });
        </script>
        
        
<!-- Modal Popup-->
<div id="myModal_new_04" class="modal fade" role="dialog">
  <div class="modal-dialog">

      <div class="modal-content">
          <div class="modal-header modal_new">
            
            <div class="col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal_title_04">Vendor Detail</h4>
            </div>
       </div>
      
      <div class="modal-body">
      	  
          <!-- From Input -->
          <div class="col-lg-12 new_123">
             
                 <aside class="col-xs-12 col-sm-6 col-md-5 col-lg-4 left_ac_pic ">
                   	<img src="images/ac-l1.png" alt="" /> 
                </aside>
                
                <aside class="col-xs-12 col-sm-6 col-md-7 col-lg-8  left_ac_dec">
                  	
                    <div class="star_rating">
                    	<p>Venue Rating -	4.3   </p>
                        <abbr>
                        	<i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </abbr>
                        <div class="clearfix"></div>   
                    </div>
                    
                    <div class="address_holder">
                    	<ul>
                        	<li>
                            <i class="fa fa-home"></i><p>260 5th Avenue, Roseville, New York, <br>NY 10001, United States</p><div class="clearfix"></div>
                            </li>
                            <li><i class="fa fa-phone"></i><p>+1111-1111-111</p><div class="clearfix"></div></li>
                            <li><i><img src="images/w.png" alt="" /></i><p><a href="#">www.hostmyparty.com</a></p><div class="clearfix"></div></li>
                            <li><i><img src="images/al.png" alt="" /></i><p>MON to SAT - 09:00 am to 11:00 pm, SUN - Closed</p><div class="clearfix"></div></li>
                        </ul>
                    </div>

                </aside>
             <div class="clearfix"></div>   
          </div>  
          <!-- /From Input -->
          
          <!-- Content  -->
          <div class="col-lg-12 ">  
          	
            	<h3>About Tortuga</h3>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venena tis vitae, justo. Nullam dictum felis eu pede mollis pretium.
				<br><br>
				Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viver ra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean impe rdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhon cus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipi scing sem neque sed ipsum. Nam  pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus imperdiet a, venenatis. vitae, justo. Nullam dictum felis pede mollis pretium.
                </p>
                
                
            <div class="clearfix"></div>  
          </div>
          <!-- /Content  -->
          
          
            
         <div class="clearfix"></div>     
       </div>
     
    </div>

  </div>
</div>
<!-- /Modal Popup--> 

<!-- Modal Popup-->
<div id="myModal_new_05" class="modal fade" role="dialog">
  <div class="modal-dialog">

      <div class="modal-content">
          <div class="modal-header modal_new">
            
            <div class="col-lg-12">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title modal_title_04">Add Reply</h4>
            </div>
       </div>
      
      <div class="modal-body">
      	  
          <!-- Content  -->
          <div class="col-lg-12 form_horizontal_rep">  
          	
            	<form class="form_horizontal " role="form">
                         <div class="form_part">
                         
                          <div class="form_part_submit">
                           <input type="text" class="form-control" placeholder="Subject">
                          </div>
                          <div class="clearfix"></div>
                        </div>
                        <div class="form_part">
                           <div class="form_part_submit">
                           <textarea placeholder="Message" class="form-control"></textarea>
                           <a class="btn btn-danger btn_bnt" href="#" data-toggle="modal" data-target="#myModal_new2">Reply</a>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      <div class="clearfix"></div>
                  </form>
                
                
                <div class="col-lg-12 addreply_comments">
                    <div class="commeent_box" id="content005">
                    	<div class="defult_scroll"></div>	
                        <!-- User -->
                        <div class="comm_boxes">
                        	<aside class="col-xs-7 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="images/account_dash1.png" class="img-circle" alt="" >
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- /User -->
                         
                         <!-- Vender -->
                         <div class="comm_boxes comm_boxes2">
                         	<aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="images/ac-l1.png" class="img-circle" alt="" >
                            </aside>
                        	<aside class="col-xs-5 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- Vender -->
                         
                         <!-- User -->
                        <div class="comm_boxes">
                        	<aside class="col-xs-7 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="images/account_dash1.png" class="img-circle" alt="" >
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- /User -->
                         
                         <!-- Vender -->
                         <div class="comm_boxes comm_boxes2">
                         	<aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="images/ac-l1.png" class="img-circle" alt="" >
                            </aside>
                        	<aside class="col-xs-5 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- Vender -->
                         
                         <!-- User -->
                        <div class="comm_boxes">
                        	<aside class="col-xs-7 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="images/account_dash1.png" class="img-circle" alt="" >
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- /User -->
                         
                         <!-- Vender -->
                         <div class="comm_boxes comm_boxes2">
                         	<aside class="col-xs-5 col-sm-2 col-md-2 col-lg-2 comm_boxes_right">
                            	<img src="images/ac-l1.png" class="img-circle" alt="" >
                            </aside>
                        	<aside class="col-xs-5 col-sm-10 col-md-10 col-lg-10 comm_boxes_left">
                            	Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. 
                                <div class="comm_boxes_comm"></div>
                            </aside>
                            <div class="clearfix"></div>  
                         </div>
                         <!-- Vender -->
                         
                    	
                    </div>
                </div>
                
            <div class="clearfix"></div>  
          </div>
          <!-- /Content  -->
            
         <div class="clearfix"></div>     
       </div>
     
    </div>

  </div>
</div>
<!-- /Modal Popup-->         
     
</body>
</html>
