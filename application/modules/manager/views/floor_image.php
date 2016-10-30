<?php require_once(FCPATH.'assets/admin/lib/header2.php'); ?>

<section role="main" class="content-body">
  <header class="page-header">
    <h2>Hi <?php echo $userData['FirstName']." ".$userData['LastName'];?></h2>
  </header>
  <section class="panel">
    <header class="panel-heading">
      <h2 class="panel-title">Invoice List</h2>
    </header>
    <div class="panel-body">
      <div class="col-lg-12">
        <div class="map_ses">
          <div class="text-center map001"> <img src="http://smartworks.demostage.net/application/modules/manager/views/kolkata.jpg"  width="900px" height="743px"   alt="" usemap="#planetmap" class="map" />
            <map name="planetmap">
              <area href="#" alt="Mercury" coords="655,209,713,241"  shape="rect" data-toggle="modal" data-target="#myModal" 
              data-maphilight='{"fillColor":"000000","fillOpacity":0.3,"alwaysOn":true}'/>
              
              <area href="#" alt="Mercury" coords="656,179,714,211"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="656,149,714,181"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="656,119,714,151"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="656,89,712,119"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="597,110,632,156"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="562,111,597,157"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="627,42,713,89"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="595,41,627,88"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="565,42,596,90"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="585,275,631,348"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="585,229,632,278"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="585,182,632,231"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="537,277,586,349"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="536,227,586,279"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="537,182,587,231"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="515,112,565,159"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="516,42,566,113"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="461,276,509,352"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="461,228,508,278"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="460,183,508,229"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="439,110,489,157"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="439,41,489,111"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="391,109,439,158"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="391,41,440,111"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="325,568,372,594"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="325,529,372,569"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="324,490,371,530"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="324,452,371,492"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="324,415,371,455"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="324,377,371,417"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="422,289,462,351"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="379,290,422,351"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="380,237,459,290"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="382,183,443,239"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="318,225,380,272"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="319,183,382,227"  shape="rect" data-toggle="modal" data-target="#myModal" />
              <area href="#" alt="Mercury" coords="317,110,365,158"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="316,42,365,113"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="266,109,317,159"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="266,48,315,112"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="57,49,110,99"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="57,98,110,148"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="59,148,91,208"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="62,209,89,273"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="62,531,100,595"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="64,618,101,672"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="102,619,139,670"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="99,557,139,594"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="100,531,138,557"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="89,208,166,265"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="90,148,165,210"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="110,49,190,149"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="355,619,392,678"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="311,618,357,680"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="263,618,312,668"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="215,617,261,667"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="179,617,215,661"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="140,617,179,662"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="252,569,302,596"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="206,568,253,594"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="163,564,206,594"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="252,519,303,570"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="206,519,254,569"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="163,518,206,566"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="253,454,300,492"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="223,436,254,491"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="193,436,224,491"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="163,436,194,491"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="254,379,300,454"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="209,379,256,436"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="163,378,210,435"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="239,225,286,269"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="192,225,239,269"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="239,182,286,226"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="192,181,239,225"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="191,110,241,160"  shape="rect" data-toggle="modal" data-target="#myModal">
              <area href="#" alt="Mercury" coords="191,50,242,112"  shape="rect" data-toggle="modal" data-target="#myModal">
            </map>
            <div class="clearfix"></div>
          </div>
        </div>
        <style>
				 .map_ses { overflow:auto;}
				 .map001 {width:900px;  margin:0 auto;}
				 </style>
      </div>
    </div>
  </section>
</section>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Book Workstation</b></h4>
      </div>
      <div class="modal-body">
        <p>Do you want to book this workstation?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary"  data-dismiss="modal" data-toggle="modal" data-target="#myModalsave" >Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModalsave" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><b>Book Workstation</b></h4>
      </div>
      <div class="modal-body">
        <p>The workstation has been booked.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for details service only view end here-->
<?php require_once(FCPATH.'assets/admin/lib/footer2.php'); ?>
<script>(function($) {
	var has_VML, has_canvas, create_canvas_for, add_shape_to, clear_canvas, shape_from_area,
		canvas_style, hex_to_decimal, css3color, is_image_loaded, options_from_area;

	has_canvas = !!document.createElement('canvas').getContext;

	// VML: more complex
	has_VML = (function() {
		var a = document.createElement('div');
		a.innerHTML = '<v:shape id="vml_flag1" adj="1" />';
		var b = a.firstChild;
		b.style.behavior = "url(#default#VML)";
		return b ? typeof b.adj == "object": true;
	})();

	if(!(has_canvas || has_VML)) {
		$.fn.maphilight = function() { return this; };
		return;
	}
	
	if(has_canvas) {
		
		hex_to_decimal = function(hex) {
			return Math.max(0, Math.min(parseInt(hex, 16), 255));
		};
		css3color = function(color, opacity) {
			return 'rgba('+hex_to_decimal(color.substr(0,2))+','+hex_to_decimal(color.substr(2,2))+','+hex_to_decimal(color.substr(4,2))+','+opacity+')';
		};
		create_canvas_for = function(img) {
			var c = $('<canvas style="width:'+$(img).width()+'px;height:'+$(img).height()+'px;"></canvas>').get(0);
			c.getContext("2d").clearRect(0, 0, $(img).width(), $(img).height());
			return c;
		};
		var draw_shape = function(context, shape, coords, x_shift, y_shift) {
			
			x_shift = x_shift || 0;
			y_shift = y_shift || 0;
			
			context.beginPath();
			if(shape == 'rect') {
				// x, y, width, height
				context.rect(coords[0] + x_shift, coords[1] + y_shift, coords[2] - coords[0], coords[3] - coords[1]);
			} else if(shape == 'poly') {
				context.moveTo(coords[0] + x_shift, coords[1] + y_shift);
				for(i=2; i < coords.length; i+=2) {
					context.lineTo(coords[i] + x_shift, coords[i+1] + y_shift);
				}
			} else if(shape == 'circ') {
				// x, y, radius, startAngle, endAngle, anticlockwise
				context.arc(coords[0] + x_shift, coords[1] + y_shift, coords[2], 0, Math.PI * 2, false);
			}
			context.closePath();
		};
		add_shape_to = function(canvas, shape, coords, options, name) {
			var i, context = canvas.getContext('2d');
			
			// Because I don't want to worry about setting things back to a base state
			
			// Shadow has to happen first, since it's on the bottom, and it does some clip /
			// fill operations which would interfere with what comes next.
			if(options.shadow) {
				context.save();
				if(options.shadowPosition == "inside") {
					// Cause the following stroke to only apply to the inside of the path
					draw_shape(context, shape, coords);
					context.clip();
				}
				
				// Redraw the shape shifted off the canvas massively so we can cast a shadow
				// onto the canvas without having to worry about the stroke or fill (which
				// cannot have 0 opacity or width, since they're what cast the shadow).
				var x_shift = canvas.width * 100;
				var y_shift = canvas.height * 100;
				draw_shape(context, shape, coords, x_shift, y_shift);
				
				context.shadowOffsetX = options.shadowX - x_shift;
				context.shadowOffsetY = options.shadowY - y_shift;
				context.shadowBlur = options.shadowRadius;
				context.shadowColor = css3color(options.shadowColor, options.shadowOpacity);
				
				// Now, work out where to cast the shadow from! It looks better if it's cast
				// from a fill when it's an outside shadow or a stroke when it's an interior
				// shadow. Allow the user to override this if they need to.
				var shadowFrom = options.shadowFrom;
				if (!shadowFrom) {
					if (options.shadowPosition == 'outside') {
						shadowFrom = 'fill';
					} else {
						shadowFrom = 'stroke';
					}
				}
				if (shadowFrom == 'stroke') {
					context.strokeStyle = "rgba(0,0,0,1)";
					context.stroke();
				} else if (shadowFrom == 'fill') {
					context.fillStyle = "rgba(0,0,0,1)";
					context.fill();
				}
				context.restore();
				
				// and now we clean up
				if(options.shadowPosition == "outside") {
					context.save();
					// Clear out the center
					draw_shape(context, shape, coords);
					context.globalCompositeOperation = "destination-out";
					context.fillStyle = "rgba(0,0,0,1);";
					context.fill();
					context.restore();
				}
			}
			
			context.save();
			
			draw_shape(context, shape, coords);
			
			// fill has to come after shadow, otherwise the shadow will be drawn over the fill,
			// which mostly looks weird when the shadow has a high opacity
			if(options.fill) {
				context.fillStyle = css3color(options.fillColor, options.fillOpacity);
				context.fill();
			}
			// Likewise, stroke has to come at the very end, or it'll wind up under bits of the
			// shadow or the shadow-background if it's present.
			if(options.stroke) {
				context.strokeStyle = css3color(options.strokeColor, options.strokeOpacity);
				context.lineWidth = options.strokeWidth;
				context.stroke();
			}
			
			context.restore();
			
			if(options.fade) {
				$(canvas).css('opacity', 0).animate({opacity: 1}, 100);
			}
		};
		clear_canvas = function(canvas) {
			canvas.getContext('2d').clearRect(0, 0, canvas.width,canvas.height);
		};
	} else {   // ie executes this code
		create_canvas_for = function(img) {
			return $('<var style="zoom:1;overflow:hidden;display:block;width:'+img.width+'px;height:'+img.height+'px;"></var>').get(0);
		};
		add_shape_to = function(canvas, shape, coords, options, name) {
			var fill, stroke, opacity, e;
			for (var i in coords) { coords[i] = parseInt(coords[i], 10); }
			fill = '<v:fill color="#'+options.fillColor+'" opacity="'+(options.fill ? options.fillOpacity : 0)+'" />';
			stroke = (options.stroke ? 'strokeweight="'+options.strokeWidth+'" stroked="t" strokecolor="#'+options.strokeColor+'"' : 'stroked="f"');
			opacity = '<v:stroke opacity="'+options.strokeOpacity+'"/>';
			if(shape == 'rect') {
				e = $('<v:rect name="'+name+'" filled="t" '+stroke+' style="zoom:1;margin:0;padding:0;display:block;position:absolute;left:'+coords[0]+'px;top:'+coords[1]+'px;width:'+(coords[2] - coords[0])+'px;height:'+(coords[3] - coords[1])+'px;"></v:rect>');
			} else if(shape == 'poly') {
				e = $('<v:shape name="'+name+'" filled="t" '+stroke+' coordorigin="0,0" coordsize="'+canvas.width+','+canvas.height+'" path="m '+coords[0]+','+coords[1]+' l '+coords.join(',')+' x e" style="zoom:1;margin:0;padding:0;display:block;position:absolute;top:0px;left:0px;width:'+canvas.width+'px;height:'+canvas.height+'px;"></v:shape>');
			} else if(shape == 'circ') {
				e = $('<v:oval name="'+name+'" filled="t" '+stroke+' style="zoom:1;margin:0;padding:0;display:block;position:absolute;left:'+(coords[0] - coords[2])+'px;top:'+(coords[1] - coords[2])+'px;width:'+(coords[2]*2)+'px;height:'+(coords[2]*2)+'px;"></v:oval>');
			}
			e.get(0).innerHTML = fill+opacity;
			$(canvas).append(e);
		};
		clear_canvas = function(canvas) {
			// jquery1.8 + ie7 
			var $html = $("<div>" + canvas.innerHTML + "</div>");
			$html.children('[name=highlighted]').remove();
			canvas.innerHTML = $html.html();
		};
	}
	
	shape_from_area = function(area) {
		var i, coords = area.getAttribute('coords').split(',');
		for (i=0; i < coords.length; i++) { coords[i] = parseFloat(coords[i]); }
		return [area.getAttribute('shape').toLowerCase().substr(0,4), coords];
	};

	options_from_area = function(area, options) {
		var $area = $(area);
		return $.extend({}, options, $.metadata ? $area.metadata() : false, $area.data('maphilight'));
	};
	
	is_image_loaded = function(img) {
		if(!img.complete) { return false; } // IE
		if(typeof img.naturalWidth != "undefined" && img.naturalWidth === 0) { return false; } // Others
		return true;
	};

	canvas_style = {
		position: 'absolute',
		left: 0,
		top: 0,
		padding: 0,
		border: 0
	};
	
	var ie_hax_done = false;
	$.fn.maphilight = function(opts) {
		opts = $.extend({}, $.fn.maphilight.defaults, opts);
		
		if(!has_canvas && !ie_hax_done) {
			$(window).ready(function() {
				document.namespaces.add("v", "urn:schemas-microsoft-com:vml");
				var style = document.createStyleSheet();
				var shapes = ['shape','rect', 'oval', 'circ', 'fill', 'stroke', 'imagedata', 'group','textbox'];
				$.each(shapes,
					function() {
						style.addRule('v\\:' + this, "behavior: url(#default#VML); antialias:true");
					}
				);
			});
			ie_hax_done = true;
		}
		
		return this.each(function() {
			var img, wrap, options, map, canvas, canvas_always, highlighted_shape, usemap;
			img = $(this);

			if(!is_image_loaded(this)) {
				// If the image isn't fully loaded, this won't work right.  Try again later.
				return window.setTimeout(function() {
					img.maphilight(opts);
				}, 200);
			}

			options = $.extend({}, opts, $.metadata ? img.metadata() : false, img.data('maphilight'));

			// jQuery bug with Opera, results in full-url#usemap being returned from jQuery's attr.
			// So use raw getAttribute instead.
			usemap = img.get(0).getAttribute('usemap');

			if (!usemap) {
				return;
			}

			map = $('map[name="'+usemap.substr(1)+'"]');

			if(!(img.is('img,input[type="image"]') && usemap && map.size() > 0)) {
				return;
			}

			if(img.hasClass('maphilighted')) {
				// We're redrawing an old map, probably to pick up changes to the options.
				// Just clear out all the old stuff.
				var wrapper = img.parent();
				img.insertBefore(wrapper);
				wrapper.remove();
				$(map).unbind('.maphilight');
			}

			wrap = $('<div></div>').css({
				display:'block',
				backgroundImage:'url("'+this.src+'")',
				backgroundSize:'contain',
				position:'relative',
				padding:0,
				width:this.width,
				height:this.height
				});
			if(options.wrapClass) {
				if(options.wrapClass === true) {
					wrap.addClass($(this).attr('class'));
				} else {
					wrap.addClass(options.wrapClass);
				}
			}
			img.before(wrap).css('opacity', 0).css(canvas_style).remove();
			if(has_VML) { img.css('filter', 'Alpha(opacity=0)'); }
			wrap.append(img);
			
			canvas = create_canvas_for(this);
			$(canvas).css(canvas_style);
			canvas.height = this.height;
			canvas.width = this.width;
			
			$(map).bind('alwaysOn.maphilight', function() {
				// Check for areas with alwaysOn set. These are added to a *second* canvas,
				// which will get around flickering during fading.
				if(canvas_always) {
					clear_canvas(canvas_always);
				}
				if(!has_canvas) {
					$(canvas).empty();
				}
				$(map).find('area[coords]').each(function() {
					var shape, area_options;
					area_options = options_from_area(this, options);
					if(area_options.alwaysOn) {
						if(!canvas_always && has_canvas) {
							canvas_always = create_canvas_for(img[0]);
							$(canvas_always).css(canvas_style);
							canvas_always.width = img[0].width;
							canvas_always.height = img[0].height;
							img.before(canvas_always);
						}
						area_options.fade = area_options.alwaysOnFade; // alwaysOn shouldn't fade in initially
						shape = shape_from_area(this);
						if (has_canvas) {
							add_shape_to(canvas_always, shape[0], shape[1], area_options, "");
						} else {
							add_shape_to(canvas, shape[0], shape[1], area_options, "");
						}
					}
				});
			}).trigger('alwaysOn.maphilight')
			.bind('mouseover.maphilight, focus.maphilight', function(e) {
				var shape, area_options, area = e.target;
				area_options = options_from_area(area, options);
				if(!area_options.neverOn && !area_options.alwaysOn) {
					shape = shape_from_area(area);
					add_shape_to(canvas, shape[0], shape[1], area_options, "highlighted");
					if(area_options.groupBy) {
						var areas;
						// two ways groupBy might work; attribute and selector
						if(/^[a-zA-Z][\-a-zA-Z]+$/.test(area_options.groupBy)) {
							areas = map.find('area['+area_options.groupBy+'="'+$(area).attr(area_options.groupBy)+'"]');
						} else {
							areas = map.find(area_options.groupBy);
						}
						var first = area;
						areas.each(function() {
							if(this != first) {
								var subarea_options = options_from_area(this, options);
								if(!subarea_options.neverOn && !subarea_options.alwaysOn) {
									var shape = shape_from_area(this);
									add_shape_to(canvas, shape[0], shape[1], subarea_options, "highlighted");
								}
							}
						});
					}
					// workaround for IE7, IE8 not rendering the final rectangle in a group
					if(!has_canvas) {
						$(canvas).append('<v:rect></v:rect>');
					}
				}
			}).bind('mouseout.maphilight, blur.maphilight', function(e) { clear_canvas(canvas); });
			
			img.before(canvas); // if we put this after, the mouseover events wouldn't fire.
			
			img.addClass('maphilighted');
		});
	};
	$.fn.maphilight.defaults = {
		fill: true,
		fillColor: '000000',
		fillOpacity: 0.2,
		stroke: true,
		strokeColor: 'ff0000',
		strokeOpacity: 1,
		strokeWidth: 1,
		fade: true,
		alwaysOn: false,
		neverOn: false,
		groupBy: false,
		wrapClass: true,
		// plenty of shadow:
		shadow: false,
		shadowX: 0,
		shadowY: 0,
		shadowRadius: 6,
		shadowColor: '000000',
		shadowOpacity: 0.8,
		shadowPosition: 'outside',
		shadowFrom: false
	};
})(jQuery);

</script>
    <script>$(function() {
        $('.map').maphilight({
            //fillColor: 'rgba(0,0,0,1)'
        });
         
    });</script>
