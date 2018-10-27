app.controller("pets", function ($scope, $http, $cookies) {

    $scope.pets = [];

    console.log($cookies.get(AUTH_COOKIE_NAME));

    const config = {
        headers: {
            skey : $cookies.get(AUTH_COOKIE_NAME)
        }
    };

    $scope.show_no_pets = false;
    $scope.show_pets = false;

    $http.get("http://localhost:8080/pets", config)
        .then(function (response) {

            if (response.status === 200) {

                var data = response.data;

                $scope.show_no_pets = data.length === 0;
                $scope.show_pets = data.length > 0;

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
});
