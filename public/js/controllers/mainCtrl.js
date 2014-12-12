'use strict';
angular.module('mainCtrl', [])

.controller('mainController', function($scope, $http, Task) {
    // object to hold all the data for the new task form
    $scope.taskData = {};

    // loading variable to show the spinning loading icon
    $scope.loading = true;

    // get all the tasks and bind them to the $scope.tasks object
    Task.get().success(function(data) {
            var tasksByStatus = {open:[], inprogress:[], fixed:[], verified:[]}
            $.each(data.data, function(index, val) {
                var status = val.status.replace(/\s+/gi, '').toLowerCase();
                tasksByStatus[status].push(val);
            });
            $scope.tasks = tasksByStatus;
            $scope.loading = false;
        });


    // function to handle submitting the form
    $scope.submitTask = function() {
        $scope.loading = true;

        // save the task. pass in task data from the form
        Task.save($scope.taskData)
            .success(function(data) {
                $scope.taskData = {};
                // if successful, we'll need to refresh the task list
                Task.get()
                    .success(function(getData) {
                        $scope.tasks = getData;
                        $scope.loading = false;
                    });

            })
            .error(function(data) {
                console.log(data);
            });
    };

    // function to handle deleting a task
    $scope.deleteTask = function(id) {
        $scope.loading = true;
        Task.destroy(id)
            .success(function(data) {
                // if successful, we'll need to refresh the tasks list
                Task.get().success(function(getData) {
                        var tasksByStatus = {open:[], inprogress:[], fixed:[], verified:[]}
                        $.each(getData.data, function(index, val) {
                            var status = val.status.replace(/\s+/gi, '').toLowerCase();
                            tasksByStatus[status].push(val);
                        });
                        $scope.tasks = tasksByStatus;
                        $scope.loading = false;
                    });

            });
    };

});