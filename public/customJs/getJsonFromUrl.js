function getJsonFromUrl(url)
{
    $.getJSON(url).done(function(data){
        console.log(data);
        return data;
    });
}