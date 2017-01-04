<div class="media">
    <div class="media-left">
        <img class="img-thumbnail media-object" src="{{ $tweet->user_avatar_url }}" alt="Avatar">
    </div>
    <div class="media-body" title="{{$tweet->id}}">
        <h4 class="media-heading">{{ '@' . $tweet->user_screen_name }}</h4>
        <p>{{ $tweet->tweet_text }}</p>
        <p><a target="_blank" href="https://twitter.com/{{ $tweet->user_screen_name }}/status/{{ $tweet->id_str }}">
                View on Twitter
            </a></p>
        @if(isset($tweet->media_url))
            <p>
                <img width="60%" src="{{ $tweet->media_url }}">
            </p>
        @endif
    </div>
</div>