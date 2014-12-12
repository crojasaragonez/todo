<!DOCTYPE html>
<html>
<head>
  <title>Todo app</title>
  <meta charset="UTF-8"> 
  {{HTML::style('bootstrap/css/bootstrap.min.css');}}
  {{HTML::style('css/style.css');}}
</head>
<body>
  <div class="container">
    <div class="jumbotron">
      <h1 class="text-center">Todo App</h1>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Open</strong></div>
          <div id="open" class="task-bucket panel-body">
            <!--<div class="well text-center">
              
            </div>-->
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>In Progress</strong></div>
          <div id="in_progress" class="task-bucket panel-body">
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Fixed</strong></div>
          <div id="fixed" class="task-bucket panel-body">
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Verified</strong></div>
          <div id="verified" class="task-bucket panel-body">
          </div>
        </div>
      </div>
    </div>
  </div>

  {{HTML::script('js/jquery-2.1.1.min.js');}} <!-- jquery -->
  {{HTML::script('js/angular.min.js');}} <!-- angular -->
  {{HTML::script('js/controllers/mainCtrl.js');}} <!-- load our controller -->
  {{HTML::script('js/services/taskService.js');}} <!-- load our service -->
  {{HTML::script('js/app.js');}} <!-- load our application -->
  {{HTML::script('bootstrap/js/bootstrap.min.js');}}
</body>
</html>