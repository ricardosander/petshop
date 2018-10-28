app.controller("pets", function ($scope, $http, $cookies, $location) {

    $scope.getPage = function getPage() {
        var page = 1;
        let parts = $location.absUrl().split("?");
        if (parts.length > 1) {
            let paramWithValues = parts[1].split("&");
            for (let index in paramWithValues) {
                if (paramWithValues[index].startsWith("page")) {
                    let pageParamValue = paramWithValues[index].split("=");
                    if (pageParamValue.length > 1) {
                        let pageTest = parseInt(pageParamValue[1]);
                        if (pageTest > 1) {
                            page = pageTest;
                        }
                    }
                }
            }
        }
        return page;
    }

    $scope.requestFirstPage = function() {
        $scope.request(1);
    }

    $scope.requestPreviousPage = function() {
        $scope.request($scope.previousPage);
    }

    $scope.requestNextPage = function() {
        $scope.request($scope.nextPage);
    }

    $scope.requestLastPage = function() {
        $scope.request($scope.totalPages);
    }

    $scope.request = function request(page) {
    
        const config = {
            headers: {
                skey : $cookies.get(AUTH_COOKIE_NAME)
            }, 
            params : {page : page}
        };

        $http.get("http://localhost:8080/pets", config)
            .then(function (response) {

                if (response.status === 200) {

                    $scope.pets = [];

                    var data = response.data.content;

                    $scope.show_no_pets = data.length === 0;
                    $scope.show_pets = data.length > 0;
                    $scope.currentPage = response.data.page;
                    $scope.totalPages = response.data.totalPages;
                    $scope.totalElements = response.data.totalElements;

                    $scope.nextPage = $scope.currentPage + 1 > $scope.totalPages ? $scope.totalPages : $scope.currentPage + 1;
                    $scope.previousPage = $scope.currentPage - 1 < 1 ? 1 : $scope.currentPage - 1;

                    for (var i = 0; i < data.length; i++) {
                        console.log(data[i]);
                        $scope.pets.push(data[i]);
                    }
                }
            }, function (response) {
                console.log(response);
                console.log(response.status + " - " + response.statusText + " : " + response.data);
                alert("Problemas ao carregar a página. Tente novamente.");
            });
    }


    $scope.pets = [];

    console.log($cookies.get(AUTH_COOKIE_NAME));

    $scope.show_no_pets = false;
    $scope.show_pets = false;
    console.log("Page: " + $scope.getPage());
    
    $scope.request($scope.getPage());
});