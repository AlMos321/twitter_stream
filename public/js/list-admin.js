/**
 * approve tweet. Ajax post
 * @param id
 */
function approveTweet(id) {
    $.ajax({
        url: 'approve-tweet',
        type: "post",
        data: {_token: window.Laravel.csrfToken, id: id},
        success: function (data, textStatus) {
            if (data.status != "success") {
                alert(data.status)
            }
        }
    });
}

/**
 * unapprove tweet. Ajax post
 * @param id
 */
function unapproveTweet(id) {
    $.ajax({
        url: 'unapprove-tweet',
        type: "post",
        data: {_token: window.Laravel.csrfToken, id: id},
        success: function (data, textStatus) {
            if (data.status != "success") {
                alert(data.status)
            }
        }
    });
}