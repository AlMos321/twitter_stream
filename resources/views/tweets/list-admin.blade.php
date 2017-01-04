<form action="/approve-tweets" method="post">
    {{ csrf_field() }}

    @foreach($tweets as $tweet)
        <div class="tweet row">
            <div class="col-xs-8">
                @include('tweets.tweet')
            </div>
            <div class="col-xs-4 approval">
                <label class="radio-inline">
                    <input onclick="approveTweet({{$tweet->id }})"
                           type="radio"
                           name="approval-status-{{ $tweet->id_str }}"
                           value="1"
                           @if($tweet->approved)
                           checked="checked"
                            @endif
                    >
                    Approved
                </label>
                <label class="radio-inline">
                    <input onclick="unapproveTweet({{$tweet->id }})"
                           type="radio"
                           name="approval-status-{{ $tweet->id_str }}"
                           value="0"
                           @unless($tweet->approved)
                           checked="checked"
                            @endif
                    >
                    Unapproved
                </label>
            </div>
        </div>
    @endforeach

    <div class="row">
        <div class="col-sm-12">
            <input type="submit" class="btn btn-primary" value="Approve All Tweets">
        </div>
    </div>

</form>

{!! $tweets->links() !!}

<script>
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
</script>