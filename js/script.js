

    // page is now ready, initialize the calendar...

  // $('#userCalendar').fullCalendar({
  // // put your options and callbacks here
  // });
  // $('#userCalendar').fullCalendar({
  //   weekends: false // will hide Saturdays and Sundays
  // });
  // $('#userCalendar').fullCalendar({
  //   dayClick: function() {
  //   alert('a day has been clicked!');
  //   }
  // });
  $(document).ready(function() {
      $('#userCalendar').fullCalendar({
          googleCalendarApiKey: 'AIzaSyBiWG_Zp8Fmm8-kUaJRzGkYEGBzzH-X97s',
          events: {
              googleCalendarId: '0atlgl77nu11vhb4u4pb253bbc@group.calendar.google.com'
          },
          weekends: false,
          header: false,
          default: {
          left:   'title',
          center: '',
          right:  'today prev,next'
          }
      });
  });
