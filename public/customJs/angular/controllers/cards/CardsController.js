app.controller('CardsController', function ($scope, $filter, $state, $stateParams, CardService){
    $scope.limit = 28;

    $scope.pagination = {};
    $scope.pagination.currentPage = $stateParams.page ? $stateParams.page : 1;
    $scope.pagination.pages = {};

    $scope.costs = [0, 1, 2, 3, 4, 5, 6, "7+"];

    $scope.search = {
        "isStd" : $stateParams.standard,
        "rarity" : $stateParams.rarity,
        "class" : $stateParams.class,
        "set" : $stateParams.set,
        "type" : $stateParams.type,
        "name" : undefined,
    }
    $scope.cost = $stateParams.cost;

    $scope.originalSearchName = $stateParams.name;

    /**
     * Change state to new searched state
     *
     * Currently not in use cause more trouble than awesomeness
     */
    $scope.searchNameChanged = function(){
        $state.go('cards',{
            page : undefined, 
            type : $scope.search.type, 
            set: $scope.search.set, 
            class : $scope.search.class, 
            rarity : $scope.search.rarity, 
            standard : $scope.search.isStd,
            name : $scope.search.name,
            cost : $scope.cost
        });
    }

    /**
     * Filter cards and reset limit.
     */
    $scope.updateFiltered = function(){
        $scope.filteredCards = $filter('filter')($scope.cards, $scope.search);
        $scope.filteredCards = $filter('cost')($scope.filteredCards, $scope.cost);
        $scope.setPaginationRange();
    }

    /**
     * Sets pagination range. 
     * From, to, current page, last page
     */
    $scope.setPaginationRange = function(){
        var lastPage = Math.ceil($scope.filteredCards.length / $scope.limit);
        var currentPage = $scope.pagination.currentPage ? parseInt($scope.pagination.currentPage) : 1;

        $scope.pagination.lastPage = lastPage;
        $scope.limitTo = currentPage * $scope.limit;
        $scope.limitFrom = (currentPage - 1) * $scope.limit;

        if(lastPage < 10){
            $scope.pagination.from = 1,
            $scope.pagination.to = lastPage
        }else {
            // more than 10 to = l pages so calculate start and end pages
            if (currentPage <= 6) {
                $scope.pagination.from = 1;
                $scope.pagination.to = 10;
            } else if (currentPage + 4 >= lastPage) {
                $scope.pagination.from = lastPage - 9;
                $scope.pagination.to = lastPage;
            } else {
                $scope.pagination.from = currentPage - 5;
                $scope.pagination.to = currentPage + 4;
            }
        }
    }

    /**
     * Return array of pages to display in pagination
     */
    $scope.getPaginationPages = function(){
        var pages = [];
        for(var i = $scope.pagination.from; i <= $scope.pagination.to; i++){
            pages.push(i);
        }
        return pages;
    }

    /**
     * Checks sessionStorage for cardAttributes. If none is found
     * fetch them from db
     */
    if (sessionStorage.getItem("cardAttributes") === null) {
        CardService.GetAttributes().then(function(cardAttributes){
            console.log(cardAttributes);
            $scope.cardAttributes = cardAttributes;
            sessionStorage.setItem("cardAttributes", JSON.stringify(cardAttributes));
        });
    }else{
        $scope.cardAttributes = JSON.parse(sessionStorage.getItem("cardAttributes"));
    }

    /**
     * Checks sessionStorage for cards. If none is found
     * fetch them from db
     */
    if (sessionStorage.getItem("cards") === null) {
        CardService.GetCards().then(function(cards){
            $scope.cards = cards;
            $scope.updateFiltered();
            sessionStorage.setItem("cards", JSON.stringify(cards));
        });

    }else{
        $scope.cards = JSON.parse(sessionStorage.getItem("cards"));
        $scope.updateFiltered();
    }
});