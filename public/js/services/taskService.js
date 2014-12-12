'use strict';
angular.module('taskService', [])

.factory('Task', function($http) {

    return {
        get: function() {
            return $http.get('api/v1/tasks');
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
        destroy: function(id) {
            return $http.delete('api/v1/tasks/' + id);
        }
    };

});