$(document).ready(function() {
   var url = $("#baseurl").val();
   $('#check').change(function() {
		$('#check').val(this.checked ? 1 : '');
   });
   $('#checkView').change(function() {
		$('#checkView').val(this.checked ? 1 : '');
   });
   var $calendar = $('#calendar_virtual_assistant');
   var id = 10;
   $calendar.weekCalendar({
      timeslotsPerHour : 2,
      allowCalEventOverlap : true,
      overlapEventsSeparate: true,
      firstDayOfWeek : 1,
      businessHours :{start: 8, end: 21, limitDisplay: true },
      daysToShow : 7,
      height : function($calendar) {
         return $(window).height() - $("h1").outerHeight() - 1;
      },
      eventRender : function(calEvent, $event) {
      },
      draggable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      resizable : function(calEvent, $event) {
         return calEvent.readOnly != true;
      },
      eventNew : function(calEvent, $event) {
         var currentDate = new Date();
         if (calEvent.start < currentDate) {
            $calendar.weekCalendar("removeUnsavedEvents");
            alert('Please select correct date or time slot');
            return false;
         }
         else{
                  var $dialogContent = $("#event_new_create");
                  resetForm($dialogContent);
                  $dialogContent.find("#check").val("");
                  var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
                  var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
                  var bodyField = $dialogContent.find("textarea[name='body']");
                  $dialogContent.dialog({
                     modal: true,
                     title: "New Calendar Event",
                     close: function() {
                        $dialogContent.dialog("destroy");
                        $dialogContent.hide();
                        $calendar.weekCalendar("removeUnsavedEvents");
                     },
                     buttons: {
                        save : function() {
                           var year = new Date($dialogContent.find("select[name='start']").val()).getFullYear();
                           var month = new Date($dialogContent.find("select[name='start']").val()).getMonth();
                           if (month < 10) {
                              month = "0"+month;
                           }
                           var day = new Date($dialogContent.find("select[name='start']").val()).getDate();
                           var eventDate = year+"-"+month+"-"+day;
                           
                           //var eventStart = $dialogContent.find("select[name='start']").val();
                           
                           var startHour = new Date($dialogContent.find("select[name='start']").val()).getHours();
                           var startMin  = new Date($dialogContent.find("select[name='start']").val()).getMinutes();
                           var eventStartTime = startHour+":"+startMin;
                           
                           //var eventEnd = $dialogContent.find("select[name='end']").val();
                           
                           var endHour = new Date($dialogContent.find("select[name='end']").val()).getHours();
                           var endMin  = new Date($dialogContent.find("select[name='end']").val()).getMinutes();
                           var eventEndTime = endHour+":"+endMin;
                           
                           var eventShared = $dialogContent.find("#check").val();
                           var eventDesc = $dialogContent.find("textarea[name='body']").val();                          
                           $.ajax({
                              type: 'post',
                              url: url+"index.php/client/putcalevent",
                              data: { eventDate: eventDate, eventStartTime: eventStartTime, eventEndTime: eventEndTime, eventShared: eventShared, eventDesc: eventDesc },
                              async: false,
                              dataType : 'json',
                              success: function(data, textStatus, jqXHR) {
                                    //code after success
                                    console.log("Success Msg: "+textStatus);
                                    location.reload();
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
                           $calendar.weekCalendar("removeUnsavedEvents");
                           $calendar.weekCalendar("updateEvent", calEvent);
                           $dialogContent.dialog("close");
                        },
                        cancel : function() {
                           $calendar.weekCalendar("removeUnsavedEvents");
                           $calendar.weekCalendar("updateEvent", calEvent);
                           $dialogContent.dialog("close");
                        }
                     }
                  }).show();
         
                  $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
                  setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
         }
      },     
      eventDrop : function(calEvent, $event) {       
      },
      eventResize : function(calEvent, $event) {
      },
      eventClick : function(calEvent, $event) {
         if (calEvent.readOnly) {
            return;
         }
         var $dialogContent = $("#event_view_container");
         //resetForm($dialogContent);
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);            
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         var bodyField = $dialogContent.find("textarea[name='body']");
         bodyField.val(calEvent.message);
         var currentDate = new Date();
         if (calEvent.start < currentDate) {
         $("textarea[name='body']").attr("disabled", "true");
         $("#checkView").attr("disabled", "true");
         if (calEvent.is_shared == 1) {
            $('#checkView').attr('checked', true);
         }
          $dialogContent.dialog({
            modal: true,
            title: calEvent.title,
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
            },
            buttons: {             
               cancel : function() {
                  $dialogContent.dialog("close");
                  $dialogContent.hide();
               }
            }
         }).show();  
         }else{
            $("textarea[name='body']").removeAttr("disabled");
            $("#checkView").removeAttr("disabled");
            if (calEvent.is_shared == 1) {
               $('#checkView').attr('checked', true);
            }
            $dialogContent.dialog({
            modal: true,
            title: calEvent.title,
            close: function() {
               $dialogContent.dialog("destroy");
               $dialogContent.hide();
            },
            buttons: {
               Update : function() {
                var eventDesc = $dialogContent.find("textarea[name='body']").val();
                var eventShared = $dialogContent.find("#checkView").val();
                $.ajax({
                  type: 'post',
                  url: url+"index.php/client/updcalevent",
                  data: { eventId: calEvent.id, eventDesc: eventDesc, eventShared:eventShared },
                  async: false,
                  dataType : 'json',
                  success: function(data, textStatus, jqXHR) {
                        //code after success
                        console.log("Success Msg: "+textStatus);
                        location.reload();
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
               },
               cancel : function() {
                  $dialogContent.dialog("close");
                  $dialogContent.hide();
               }
            }
         }).show();           
         }
         var startField = $dialogContent.find("select[name='start']").val(calEvent.start);
         var endField = $dialogContent.find("select[name='end']").val(calEvent.end);
         $dialogContent.find(".date_holder").text($calendar.weekCalendar("formatDate", calEvent.start));
         setupStartAndEndTimeFields(startField, endField, calEvent, $calendar.weekCalendar("getTimeslotTimes", calEvent.start));
         $(window).resize().resize(); //fixes a bug in modal overlay size ??

      },
      eventMouseover : function(calEvent, $event) {
      },
      eventMouseout : function(calEvent, $event) {
      },
      noEvents : function() {

      },
      data : function(start, end, callback) {
         callback(getEventData());
      }
   });

   function resetForm($dialogContent) {
      $dialogContent.find("input").val("");
      $dialogContent.find("textarea").val("");
   }
   /*
    * Sets up the start and end time fields in the calendar event
    * form for editing based on the calendar event being edited
    */
   function setupStartAndEndTimeFields($startTimeField, $endTimeField, calEvent, timeslotTimes) {

      for (var i = 0; i < timeslotTimes.length; i++) {
         var startTime = timeslotTimes[i].start;
         var endTime = timeslotTimes[i].end;
         var startSelected = "";
         if (startTime.getTime() === calEvent.start.getTime()) {
            startSelected = "selected=\"selected\"";
         }
         var endSelected = "";
         if (endTime.getTime() === calEvent.end.getTime()) {
            endSelected = "selected=\"selected\"";
         }
         $startTimeField.append("<option value=\"" + startTime + "\" " + startSelected + ">" + timeslotTimes[i].startFormatted + "</option>");
         $endTimeField.append("<option value=\"" + endTime + "\" " + endSelected + ">" + timeslotTimes[i].endFormatted + "</option>");

      }
      $endTimeOptions = $endTimeField.find("option");
      $startTimeField.trigger("change");
   }

   var $endTimeField = $("select[name='end']");
   var $endTimeOptions = $endTimeField.find("option");

   //reduces the end time options to be only after the start time options.
   $("select[name='start']").change(function() {
      var startTime = $(this).find(":selected").val();
      var currentEndTime = $endTimeField.find("option:selected").val();
      $endTimeField.html(
            $endTimeOptions.filter(function() {
               return startTime < $(this).val();
            })
            );

      var endTimeSelected = false;
      $endTimeField.find("option").each(function() {
         if ($(this).val() === currentEndTime) {
            $(this).attr("selected", "selected");
            endTimeSelected = true;
            return false;
         }
      });

      if (!endTimeSelected) {
         //automatically select an end date 2 slots away.
         $endTimeField.find("option:eq(1)").attr("selected", "selected");
      }

   });
   var $about = $("#about");
   $("#about_button").click(function() {
      $about.dialog({
         title: "About this calendar demo",
         width: 600,
         close: function() {
            $about.dialog("destroy");
            $about.hide();
         },
         buttons: {
            close : function() {
               $about.dialog("close");
            }
         }
      }).show();
   });


});
