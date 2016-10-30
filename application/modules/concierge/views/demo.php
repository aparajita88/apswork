<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Hi   <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>	
	</header>					
	<section class="panel">						
			<div class="panel-body"><h2 class="panel-title"><?php echo $table_heading; ?></h2></div>					
			<div class="panel-body panel_body_top">
				 <ul class="nav nav-pills">
                  <li class="flight"><a data-toggle="pill" href="#flight"><i class="fa fa-fighter-jet" aria-hidden="true"></i> Flight</a></li>
                  <li class="hotel"><a data-toggle="pill" href="#hotel"><i class="fa fa-bed" aria-hidden="true"></i> Hotel</a></li>
                  <li class="train"><a data-toggle="pill" href="#train"><i class="fa fa-train" aria-hidden="true"></i> Train</a></li>
                  <li class="bus"><a data-toggle="pill" href="#bus"><i class="fa fa-bus" aria-hidden="true"></i> Bus</a></li>
                  <li class="cab"><a data-toggle="pill" href="#cab"><i class="fa fa-taxi" aria-hidden="true"></i> Cab</a></li>
                </ul>
                <div class="tab-content">
                  <div id="flight" class="tab-pane fade in active">
                  <div class="row">
                    <div class="heading">
                    	<aside class="col-lg-9">
                        	<h4>Book Domestic & International Flight Tickets</h4>
                        </aside>
                        <aside class="col-lg-3 text-right">
                        	<select class="selection1">
                            	<option>Domestic</option>
                                <option>International</option>
                            </select>
                        </aside>
                        <div class="clearfix"></div>
                    </div>
                    <div class="mainform">
                    	<div class="row">
                    		<aside class="col-lg-9">
                            <form role="form">
                                <label class="radio-inline">
                                  <input type="radio" name="optradio">ONE WAY
                                  <div class="check"></div>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="optradio">ROUND TRIP
                                  <div class="check"><div class="inside"></div></div>
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="optradio">MULTI CITY/ STOP OVER
                                  <div class="check"><div class="inside"></div></div>
                                </label>
                                <div class="clearfix"></div>
                                <div class="inputtypes">
                                	<div class="row">
                                        <div class="form-group">
                                            <div class="col-lg-5">
                                                <label>FROM</label>
                                                <input type="text" placeholder="Type Departure City" class="form-control" />
                                            </div>
                                            <div class="col-lg-1 myimg"><img src="http://smartworks.demostage.net/assets/admin1/images/two-arrows.jpg" alt="img" /></div>
                                            <div class="col-lg-5">
                                                <label>To</label>
                                                <input type="text" placeholder="Type Destination City" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="col-lg-5">
                                            <div class="row">
                                            	<div class="col-lg-6">
                                                	<label>DEPARTURE</label>
                                                    <input  type="text" id="example1" class="form-control mycalender">
                                                </div>
                                                <div class="col-lg-6">
                                                	<label>RETURN</label>
                                                    <input  type="text"  id="example2" class="form-control mycalender">
                                                </div>
                                             </div>   
                                            </div>
                                            <div class="col-lg-1">&nbsp;</div>
                                            <div class="col-lg-5">
                                            	<div class="row">
                                                	<div class="col-lg-4">
                                                    	<label>ADULT(12+)</label>
                                                        <input type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-4">
                                                    	<label>CHILD(2-11)</label>
                                                        <input type="text" class="form-control" />
                                                    </div>
                                                    <div class="col-lg-4">
                                                    	<label>INFANT(0-2)</label>
                                                        <input type="text" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="col-lg-5">
                                            	<label>CLASS</label>
                                            	<select class="form-control selection2" >
                                                	<option>Economy</option>
                                                    <option>Business</option>
                                                    <option>First Class</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-1">&nbsp;</div>
                                            <div class="col-lg-5">
                                            	<label>AIRLINE PREFERENCE (OPTIONAL)</label>
                                                <select class="form-control selection2">
                                                	<option>Option</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="col-lg-4">
                                            	<label>APPROX TIME OF DEPARTURE</label>
                                                <select class="form-control selection2">
                                                	<option>Select Time</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">&nbsp;</div>
                                            <div class="col-lg-4">
                                            	<label>BUDGET</label>
                                                <select class="form-control selection2">
                                                	<option>8,000-12,000</option>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                         	<div class="col-lg-5">
                                            	<button type="button" class="btn btn-lg btn-info mybtn">Book Now</button>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                             </form>
                         </aside>
                         </div>
                    </div>
                    </div>
                  </div>
                  <div id="hotel" class="tab-pane fade">
                   <div class="row">
                        <div class="heading">
                            <aside class="col-lg-9">
                                <h4>Book Domestic & International Flight Hotels</h4>
                            </aside>
                            <aside class="col-lg-3 text-right">
                                <select class="selection1">
                                    <option>Domestic</option>
                                    <option>International</option>
                                </select>
                            </aside>
                            <div class="clearfix"></div>
                        </div>
                        <div class="mainform">
                        	<div class="row">
                            	<div class="col-lg-5">
                                	<form>
                                    	<div class="form-group">
                                        	<label>I WANT TO GO</label>
                                            <select class="form-control selection2">
                                            	<option>Type Departure City</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                        	<div class="row">
                                            	<div class="col-lg-8">
                                                	<label>BUDGET (per night)</label>
                                                    <select class="selection2 form-control">
                                                    	<option>1500-2500</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                	<label>STAR</label>
                                                    <select class="selection2 form-control">
                                                    	<option>5</option>
                                                        <option>4</option>
                                                        <option>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="row">
                                                <div class="col-lg-6">
                                                    <label>check-in</label>
                                                    <input  type="text" id="example3" class="form-control mycalender">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label>check-out</label>
                                                    <input  type="text"  id="example4" class="form-control mycalender">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                        	<div class="row">
                                            	<div class="col-lg-3">
                                                	<label>night</label>
                                                    <select class="selection2 form-control">
                                                    	<option>1</option>
                                                        <option>2</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <br /><br />
                                        <div class="form-group">
                                        	<button type="button" class="btn btn-lg btn-info mybtn">Book Now</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-7">
                                	<div class="rooms">
                                    	<div class="col-lg-6">
                                        	<h6>Room 1</h6>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                        	<div class="col-lg-6">
                                            	<div class="form-group">
                                                	<label>adult(12+)</label>
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                            	<div class="form-group">
                                                	<label>adult(12+)</label>
                                                    <input type="text" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   </div>
                  </div>
                  <div id="train" class="tab-pane fade">
                    <h3>Menu 2</h3>
                    <p>Some content in menu 2.</p>
                  </div>
                  <div id="bus" class="tab-pane fade">
                    <h3>Menu 1</h3>
                    <p>Some content in menu 1.</p>
                  </div>
                  <div id="cab" class="tab-pane fade">
                    <h3>Menu 2</h3>
                    <p>Some content in menu 2.</p>
                  </div>
                </div>
			</div>
	</section>		
</section>
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
