var start = 0;
var limit = 5;
var reachedMax = false;

$(window).scroll(function() {
    if ($(window).scrollTop() == $(document).height() - $(window).height())
    getVideos();
});

$(document).ready(function (){
    getVideos();
});

function getVideos(){
    if (reachedMax)
    return;
    $.ajax({
        url: 'restrict/videos.php',
        method: 'POST',
        dataType: 'text',
        data: {
            getVideos: 1,
            start: start,
            limit: limit
        },
        success: function(response){
            if(response == "reachedMax")
                reachedMax = true;
            else {
                start += limit;
                $(".results").append(response);
            }
        }
    });
}