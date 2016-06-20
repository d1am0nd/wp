app.factory('CardService', function($http) {
    var cardsUrl = '/api/cards';
    var attributesUrl = '/api/cardattributes';
    return {
        getCards: function() {
             //return the promise directly.
            return $http.get(cardsUrl)
                //resolve the promise as the data
                .then(function(result) {
                    return result.data;
                });
        },
        getAttributes: function() {
            return $http.get(attributesUrl)
                .then(function(result) {
                    return result.data;
                });
        },
        
        /**
         * Inits attributeClasses object. Sets all classes
         * to empty string.
         */
        getAttributeClasses: function(attributes, picked = null) {
            var attributeClasses = {};
            $.each(attributes, function(attribute, values){
                attributeClasses[attribute] = {};
                $.each(values, function(dbName, prettyName){
                    if(picked == dbName)
                        attributeClasses[attribute][dbName] = "btn-u-sea";
                    else
                        attributeClasses[attribute][dbName] = "";
                });
            });
            return attributeClasses;
        }
    }
});