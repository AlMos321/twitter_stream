<h3 style="font-family: 'Droid Arabic Kufi'">Last 25 tweets. (@foreach($tweetsTrack as $value){{$value}}
    && @endforeach  )</h3>

@foreach($tweets as $key => $tweet)
    @if($key == 24 || count($tweets) == $key+1)
        <div class="tweet last_tweet" id="{{$tweet->id}}">
            @include('tweets.tweet')
        </div>
    @elseif($key == 0)
        <div class="tweet first_tweet" id="{{$tweet->id}}">
            @include('tweets.tweet')
        </div>
    @else
        <div class="tweet" id="{{$tweet->id}}">
            @include('tweets.tweet')
        </div>
    @endif
@endforeach
<script src="/js/list.js"></script>
