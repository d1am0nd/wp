app.filter('cost', function(){
    return function(cards, costFilter){
        /**
         * If filter is undefined,
         * return all cards
         */
        if(costFilter == undefined)
            return cards;

        /**
         * Otherwise return filtered cards
         */
        var filtered = [];
        if(costFilter == '7+'){
        console.log(costFilter);
            cards.forEach(function(card){
                if(parseInt(card.cost) > 6)
                    filtered.push(card);
            });
        }else{
            cards.forEach(function(card){
                if(parseInt(card.cost) == costFilter)
                    filtered.push(card);
            });
        }
        return filtered;
    }
});