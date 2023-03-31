<div>
    @foreach ($users as $user)
        <div class="px-4 ">
            <a href="/{{$user->username}}"><h2>{{$user->username}}</h2></a>
        </div>
        <hr class="py-3 w-auto m-auto">
    @endforeach
</div>
