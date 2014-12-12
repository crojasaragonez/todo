<!DOCTYPE html>
<html>
<head>
  <title>Todo app</title>
  <meta charset="UTF-8"> 
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></style>
  <link rel="stylesheet" href="css/style.css"></style>
  <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/angular.min.js"></script>
  <script type="text/javascript" src="js/controllers/mainCtrl.js"></script>
  <script type="text/javascript" src="js/services/taskService.js"></script>
  <script type="text/javascript" src="js/app.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body ng-app="todoApp" ng-controller="mainController">
  <div class="container">
    <div class="jumbotron">
      <h1 class="text-center">Todo App</h1>
    </div>
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Open</strong></div>
          <div id="open" class="task-bucket panel-body">
            <div class="task" ng-hide="loading" ng-repeat="task in tasks.open">
              <div class="well text-center">
                <h3>Task #{{ task.id }}</h3>
                <p>{{ task.description }}</p>
                <p><a href="#" ng-click="deleteTask(task.id)" class="text-muted">Delete</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>In Progress</strong></div>
          <div id="in_progress" class="task-bucket panel-body">
            <div class="task" ng-hide="loading" ng-repeat="task in tasks.inprogress">
              <div class="well text-center">
                <h3>Task #{{ task.id }}</h3>
                <p>{{ task.description }}</p>
                <p><a href="#" ng-click="deleteTask(task.id)" class="text-muted">Delete</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Fixed</strong></div>
          <div id="fixed" class="task-bucket panel-body">
            <div class="task" ng-hide="loading" ng-repeat="task in tasks.fixed">
              <div class="well text-center">
                <h3>Task #{{ task.id }}</h3>
                <p>{{ task.description }}</p>
                <p><a href="#" ng-click="deleteTask(task.id)" class="text-muted">Delete</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Verified</strong></div>
          <div id="verified" class="task-bucket panel-body">
            <div class="task" ng-hide="loading" ng-repeat="task in tasks.verified">
              <div class="well text-center">
                <h3>Task #{{ task.id }}</h3>
                <p>{{ task.description }}</p>
                <p><a href="#" ng-click="deleteTask(task.id)" class="text-muted">Delete</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>