<!DOCTYPE html>
<html>
<head>
  <title>Todo app</title>
  <meta charset="UTF-8"> 
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"></style>
  <link rel="stylesheet" href="css/style.css"></style>
  <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/angular.min.js"></script>
  <script type="text/javascript" src="js/app.js"></script>
  <script type="text/javascript" src="js/controllers/mainCtrl.js"></script>
  <script type="text/javascript" src="js/services/taskService.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body ng-app="todoApp" ng-controller="mainController">
  <div class="container">
    <div class="jumbotron">
      <h1 class="text-center">Todo App</h1>
    </div>
    <div class="row">
      <div class="col-md-12">
        <form ng-submit="submitTask()" ng-show="showForm" class="form-horizontal">
          <fieldset>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="title">Title</label>  
              <div class="col-md-4">
              <input id="title" name="title" ng-model="taskData.title" class="form-control input-md" type="text">
                
              </div>
            </div>
            <!-- Select Basic -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="status">Status</label>
              <div class="col-md-4">
                <select id="status" ng-model="taskData.status" name="status" class="form-control">
                  <option value="Open">Open</option>
                  <option value="In Progress">In Progress</option>
                  <option value="Fixed">Fixed</option>
                  <option value="Verified">Verified</option>
                </select>
              </div>
            </div>
            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="description">Description</label>
              <div class="col-md-4">                     
                <textarea class="form-control" ng-model="taskData.description" id="description" name="description"></textarea>
              </div>
            </div>
            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="save"></label>
              <div class="col-md-2">
                <button id="save" name="save" type="submit" class="btn btn-primary btn-block">Save</button>
              </div>
              <div class="col-md-2">
                <button ng-click="showForm = !showForm" id="cancel" name="cancel" class="btn btn-primary btn-block">Cancel</button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <button ng-click="showForm = !showForm" class="btn btn-default btn-lg btn-block" id="session_clear">Create Task</button>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Open</strong></div>
          <div id="open" class="task-bucket panel-body">
            <div class="task" ng-hide="loading" ng-repeat="task in tasks.Open">
              <div class="well text-center">
                <h3>Task #{{ task.id }}</h3>
                <p>{{ task.description }}</p>
                <p><a href="#" ng-click="deleteTask(task.id, task.status)" class="text-muted">Delete</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>In Progress</strong></div>
          <div id="in_progress" class="task-bucket panel-body">
            <div class="task" ng-hide="loading" ng-repeat="task in tasks['In Progress']">
              <div class="well text-center">
                <h3>Task #{{ task.id }}</h3>
                <p>{{ task.description }}</p>
                <p><a href="#" ng-click="deleteTask(task.id, task.status)" class="text-muted">Delete</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Fixed</strong></div>
          <div id="fixed" class="task-bucket panel-body">
            <div class="task" ng-hide="loading" ng-repeat="task in tasks.Fixed">
              <div class="well text-center">
                <h3>Task #{{ task.id }}</h3>
                <p>{{ task.description }}</p>
                <p><a href="#" ng-click="deleteTask(task.id, task.status)" class="text-muted">Delete</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading text-center"><strong>Verified</strong></div>
          <div id="verified" class="task-bucket panel-body">
            <div class="task" ng-hide="loading" ng-repeat="task in tasks.Verified">
              <div class="well text-center">
                <h3>Task #{{ task.id }}</h3>
                <p>{{ task.description }}</p>
                <p><a href="#" ng-click="deleteTask(task.id, task.status)" class="text-muted">Delete</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>