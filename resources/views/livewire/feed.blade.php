<div>
    @foreach ($twits as $twit)
            <div class="px-4 position-relative">
                <a href="/{{$twit->user->username}}" class="stretched-link"><h2>{{$twit->user->username}}</h2></a>
                <div class="container position-relative">
                    @if ($pageType == 'dashboard')
                        <a href="/{{$user->username}}/status/{{$twit->id}}" class="stretched-link">
                    @else
                        <a href="/{{$user->username}}/status/{{$twit->twit_id}}/{{$twit->id}}" class="stretched-link">
                    @endif
                            <p class="text-body">{{$twit->body}}</p>
                    </a>
                </div>
            </div>
        <hr class="py-3 w-auto m-auto">
    @endforeach
</div>
