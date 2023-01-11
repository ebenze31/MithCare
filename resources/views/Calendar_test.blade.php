<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>

  <link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />

</head>
<body>
  <h1>TEST CALENDAR</h1>
  <div id="calendar" style="height: 600px;background-color: blue;"></div>


<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.ie11.min.js"></script>
<script>
  const Calendar = tui.Calendar;
</script>
  <script>

    const container = document.getElementById('calendar');
    const options = {
      defaultView: 'month',
      timezone: {
        zones: [
          {
            timezoneName: 'Asia/Bangkok',
            displayLabel: 'Bangkok',
          }
        ],
      },
      calendars: [
        {
          id: 'cal1',
          name: 'Personal',
          backgroundColor: '#03bd9e',
        }
      ],
    };

    const calendar = new Calendar(container, options);
  </script>
</body>
</html>