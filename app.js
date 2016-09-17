(function () {
    'use strict';

    angular
        .module('RestApp', ['ui.bootstrap', 'ngAnimate'])
        .controller('CarouselController', CarouselController)
        .controller('ButtonsController', ButtonsController)
        .controller('PaginationController', PaginationController)
        .controller('PagerController', PagerController)
        .controller('AlertController', AlertController)
        .controller('UsersController', UsersController);

    UsersController.$inject = ['$http'];
    /* @ngInject */
    function UsersController($http) {
        var vm = this;
        vm.users = [];
        vm.user = {};
        init();
        function init() {
            $http.get("http://localhost/rest_app/web/app_dev.php/api/users")
                .then(function (response) {
                    vm.users = response.data;
                });
        }

        vm.submit = function () {
            $http.post("http://localhost/rest_app/web/app_dev.php/api/users", vm.user)
                .then(function (response) {
                    vm.user.id = response.data.id;
                    vm.users.push(angular.copy(vm.user));
                });
        }
    }

    CarouselController.$inject = ['$http'];
    function CarouselController($http) {
        var vm = this;
        vm.slidesInterval = 0;
        vm.slideHeight = 400;
        vm.noWrapSlides = false;
        vm.active = 0;
        vm.slides = [];
        $http.get("slides.json")
            .then(function (response) {
                vm.slides = response.data;
            });
    }

    /* @ngInject */
    //ButtonsController.$inject = ['$scope'];
    function ButtonsController() {
        var vm = this;
        vm.singleModel = true;
    }

    /* @ngInject */
    //PaginationController.$inject = ['$scope'];
    function PaginationController() {
        var vm = this;
        vm.boundaryLinks = true;
        vm.directionLinks = false;
        vm.totalItems = 64;
        vm.currentPage = 4;
    }

    /* @ngInject */
    //PagerController.$inject = ['$scope'];
    function PagerController() {
        var vm = this;
        vm.totalItems = 64;
        vm.currentPage = 4;
    }


    /* @ngInject */
    //AlertDemoCtrl.$inject = ['$scope'];
    function AlertController() {
        var vm = this;
        vm.alerts = [
            {type: 'danger', msg: 'Oh snap! Change a few things up and try submitting again.'},
            {type: 'success', msg: 'Well done! You successfully read this important alert message.'},
            {type: 'info', msg: 'Well done! You successfully read this important alert message.'},
            {type: 'warning', msg: 'Well done! You successfully read this important alert message.'}
        ];

        vm.addAlert = function () {
            vm.alerts.push({msg: 'Another alert!'});
        };
        vm.closeAlert = function (index) {
            vm.alerts.splice(index, 1);
        };
    }
})();





