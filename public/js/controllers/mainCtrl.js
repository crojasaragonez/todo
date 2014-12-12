'use strict';
angular.module('todoApp').controller('mainController', ['$scope','taskService', function($scope, taskService) {
    // object to hold all the data for the new task form
    $scope.taskData = {};

    // loading variable to show the spinning loading icon
    $scope.loading = true;
    $scope.showForm = false;

    // get all the tasks and bind them to the $scope.tasks object
    taskService.get(function(data) {
            $scope.tasks = data;
            $scope.loading = false;
        });


    // function to handle submitting the form
    $scope.submitTask = function() {
        $scope.loading = true;

        // save the task. pass in task data from the form
        taskService.save($scope.taskData)
            .success(function(data) {
                $scope.taskData = {};
                // if successful, we'll need to refresh the task list
                taskService.get(function(data) {
            $scope.tasks = data;
            $scope.loading = false;
            $scope.showForm = false;
        });
            })
            .error(function(data) {
                console.log(data);
            });
    };

    // function to handle deleting a task
    $scope.deleteTask = function(id, status) {
        $scope.loading = true;
        taskService.destroy(id)
            .success(function(data) {
                $scope.tasks[status].forEach(function (task, index) {
                    if(task.id === id) {
                        $scope.tasks[status].splice(index, 1);
                        $scope.loading = false;
                        return;
                    }
                });
            });
    };

}]);