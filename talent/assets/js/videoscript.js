var start=0,limit=5,reachedMax=!1;function getVideos(){reachedMax||$.ajax({url:"restrict/videos.php",method:"POST",dataType:"text",data:{getVideos:1,start:start,limit:limit},success:function(t){"reachedMax"==t?reachedMax=!0:(start+=limit,$(".results").append(t))}})}$(window).scroll(function(){$(window).scrollTop()==$(document).height()-$(window).height()&&getVideos()}),$(document).ready(function(){getVideos()});