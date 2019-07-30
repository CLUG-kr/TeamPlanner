<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>TeamPlanner</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="rgb(33, 85, 164)" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Courgette&display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.css" />
    <!-- If you use the default popups, use this. -->
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css" />
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css" />

    <link href='https://unpkg.com/@fullcalendar/core/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/timegrid/main.min.css' rel='stylesheet' />



    <style>
      html, th {
        text-align: center;
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">TeamPlanner</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#" onclick="location.reload(true)"><span class="glyphicon glyphicon-refresh"></span> Refresh</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-save"></span> Save</a></li>
          <li><a href="#"><i class="fas fa-share"></i> Share</a></li>
        </ul>
      </div>
    </nav>

    <div class="container-fluid" style="margin-top:50px">
      <div class="row">
        <div class="col-md-4">
          <h1>Members</h1>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Color</th>
                <th></th>
              </tr>
            </thead>
            <tbody id="tbody-members">
              <tr id="row-member-add">
                <td><input id="input-member-name" class="form-control text-center" type="text" placeholder="Name" /></td>
                <td><input id="input-member-color" class="form-control text-center" type="color" placeholder="Color" /></td>
                <td><button id="btn-member-add" type="button" class="btn btn-default">Add</button></td>
              </tr>
            </tbody>
          </table>
          <button id="test-btn" type="button">Click</button>
        </div>
        <div class="col-md-8">
          <div id='calendar' style='margin:10px; width:800px; height:80vh; float:right;'></div>
        </div>
      </div>
    </div>

    <button id='modal_click' style='display: none;' data-toggle="modal" data-target="#myModal">Add Event</button>

    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <div class="modal-content">
          <!--<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>-->
          <div class="modal-body" style="height: 80vh; overflow: auto">
            <div id='calendar2'></div>
          </div>
          <div class="modal-footer">
            <button id="add-event" type="button" class="btn btn-default" data-dismiss="modal">Add Event</button>
          </div>
        </div>

      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <script src="https://uicdn.toast.com/tui.code-snippet/latest/tui-code-snippet.js"></script>
    <script src="https://uicdn.toast.com/tui-calendar/latest/tui-calendar.js"></script>

    <script src='https://unpkg.com/@fullcalendar/core/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/timegrid/main.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/interaction/main.min.js'></script>

    <script>
      function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
          color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
      }

      $(document).ready(function() {
        var nMembers = 0;
/*
        var Calendar = tui.Calendar;
        var calendar = new Calendar('#calendar', {
          defaultView: 'month',
          taskView: true,
          template: {
            monthGridHeader: function(model) {
              var date = new Date(model.date);
              var template = '<span class="tui-full-calendar-weekday-grid-date">' + date.getDate() + '</span>';
              return template;
            }
          }
        });
*/
        $("#btn-member-add").click(function() {
          var id = "member" + nMembers;
          var name = $("#input-member-name").val();
          var color = $("#input-member-color").val();

          if (!name) {
            alert("Please input name field.");
            return;
          }

          $("#input-member-name").val("");
          $("#input-member-color").val(getRandomColor());
          $("#tbody-members .active").removeClass("active");
          $("#tbody-members").append("<tr id=\"" + id + "\" class=\"active\"></tr>");
          $("tr#" + id).
            html("<td id=\"" + id + "-name\">" + name + "</td>" +
            "<td id=\"" + id + "-color\" style=\"background: " + color + "\"></td>" +
            "<td id=\"" + id + "-remove\"><a href=\"#\"><i class=\"fas fa-user-minus\"></i></a></td>").
            click(function() {
              $("#tbody-members .active").removeClass("active");
              $(this).addClass("active");
            });
          $("td#" + id + "-remove a").click(function() {
            $("tr#" + id).remove();
          });

          nMembers++;
        });

        $("#test-btn").click(function() {
          calendar.next();
        });
      });

      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'interaction', 'dayGrid' ],
          defaultView: 'dayGridMonth',
          header: {
            left: 'prev',
            center: 'title',
            right: 'next'
          },
          selectable: true,


          events: [
            {
                  
            },

          ],

          dateClick: function(info) {

            document.getElementById("modal_click").click();

            var calendarEl2 = document.getElementById('calendar2');

            var calendar2 = new FullCalendar.Calendar(calendarEl2, {
              plugins: [ 'interaction', 'timeGrid' ],
              defaultView: 'timeGridDay',
              defaultDate: info.dateStr,
              header: {
                left: 'none',
                center: 'title',
                right: 'none'
              },
              height: 'auto',
              selectable: true,
            });

            calendar2.render();
            calendar2.updateSize();
            calendar2.updateSize();

            $("#myModal").on("hidden.bs.modal", function() {
              calendar2.destroy();
            });
          }

        });

        calendar.render();
      });

    </script>
  </body>
</html>