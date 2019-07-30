<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>TeamPlanner</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="rgb(33, 85, 164)" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style>
      html,
      body {
        background: url('main_background.jpg') center;
        background-size: cover;
        background-repeat: no-repeat;

        height: 100%;
        margin: 0;

        color: white;
      }

      .login-container {
        width: 100%;
        min-height: 100%;
        min-height: 100vh;

        display: flex;
        align-items: center;
        align-content: center;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid login-container">
      <div style="margin: auto; border: 1px solid white; padding: 50px; background: rgba(0, 0, 0, 0.3)">
        <h1 class="text-center"><span class="glyphicon glyphicon-calendar"></span></h1>
        <h1 class="text-center" style="font-family: 'Courgette', cursive; font-size: 4vw">TeamPlanner</h1>
        <hr />
        <button type="button" class="btn btn-info btn-block" onclick="location.href='planner.php'">Start Planning</button>
      </div>
    </div>
  </body>
</html>