'use strict';
angular.module('todoApp')
.factory('taskService', ['$http', function($http) {

    function tasksByStatus (data) {
        var tasksByStatus = {Open:[], 'In Progress':[], Fixed:[], Verified:[]}
        data.data.forEach(function (val, index) {
            tasksByStatus[val.status].push(val);
        });
        /*$.each(data.data, function(index, val) {
            tasksByStatus[val.status].push(val);
        });*/
        return tasksByStatus;
    }

    return {
        get: function(callback) {
            return $http.get('api/v1/tasks').then(function (response) {
                callback(tasksByStatus(response.data));
            });
        },
        show: function(id) {
            return $http.get('api/v1/tasks/' + id);
        },
        save: function(taskData) {
            return $http({
                method: 'POST',
                url: 'api/v1/tasks',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                data: $.param(taskData)
            });
        },
        put: function (taskData) {
            return $http({
                method: 'PUT',
                url: 'api/v1/tasks/' + taskData.id,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                data: $.param(taskData)
            });  
        },
        destroy: function(id) {
            return $http.delete('api/v1/tasks/' + id);
        }
    };

}]);