$(document).ready(function(e){
    function getQueryStrings(url) {
        var queryString =  url.split('?')[1];
        var qParams = queryString.split('&');
        var queryStringsArr = [];
        qParams.map(function(key, index){
            var paramArr = key.split('=');
            queryStringsArr[paramArr[0]] = paramArr[1];
        });
        return queryStringsArr;
    }
    $(document).on('click', '.page-link', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        var queryString = getQueryStrings(href);
        console.log(queryString);
    });
    // href = http://127.0.0.1:8000/admin/listings?keyword=gas&page=2
    // output array
    // [
    //  keyword:gas
    //  page:2
    //]
});
