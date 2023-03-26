<div>
    @foreach ($twits as $twit)
        <div class="px-4 ">
            <a href="/users/{{$twit->user->username}}"><h2>{{$twit->user->username}}</h2></a>
            <p>{{$twit->body}}</p>
        </div>
        <hr class="py-3 w-auto m-auto">
    @endforeach
</div>
