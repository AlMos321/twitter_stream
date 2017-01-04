<h3 style="font-family: 'Droid Arabic Kufi'">Last 25 tweets. (@foreach($tweetsTrack as $value){{$value}} && @endforeach </h3>
@foreach($tweets as $tweet)
    <div class="tweet">
        @include('tweets.tweet')
    </div>
@endforeach