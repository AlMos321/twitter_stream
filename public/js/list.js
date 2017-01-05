/**
 * Dynamic add new tweets to list
 */
$(document).ready(function () {
    function getTweets() {
        var firstTweeTd = $('.first_tweet').attr('id');
        $.ajax({
            url: '/get-last-tweets',
            type: "get",
            data: {_token: window.Laravel.csrfToken, last_id: firstTweeTd},
            success: function (data) {

                if (typeof data.emptyData == "undefined") {

                    $(".tweet").each(function (index) {
                        $(this).remove();
                    });

                    var lengthTweets = data.tweets.length;
                    $.each(data.tweets, function (index, value) {
                        var imgBlock = '';
                        var tweetLast = "";
                        var tweetFirst = "";

                        if(index == 0){
                            tweetFirst = "first_tweet"
                        }

                        if(index+1 == lengthTweets){
                            tweetLast = "last_tweet"
                        }

                        if (typeof value.media_url != "object") {
                            imgBlock = '<p><img width="60%" src="' + value.media_url + '"></p>';
                        }
                        $('.tweet-list').append('<div class="tweet '+tweetFirst+''+tweetLast+'" id="'+ value.id +'"> ' +
                            '<div class="media">' +
                            '<div class="media-left">' +
                            '<img class="img-thumbnail media-object" src="' + value.user_avatar_url + '" alt="Avatar">' +
                            '</div>' +
                            '<div class="media-body" title="' + value.id + '">' +
                            '<h4 class="media-heading">@' + value.user_screen_name + '</h4>' +
                            '<p>' + value.tweet_text + '</p>' +
                            '<p><a target="_blank" href="https://twitter.com/' + value.user_screen_name + '/status/' + value.id_str + '">' +
                            'View on Twitter' +
                            '</a></p>' +
                            '' + imgBlock +'' +
                            '</div>' +
                            '</div>' +
                            '</div>').hide().fadeIn(700);
                    });
                }
            }
        });
    }
    setInterval(getTweets, 20 * 1000);
});