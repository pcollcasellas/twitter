<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between align-items-center">
            <div class="flex">
                <a href="/dashboard" class="link-primary">
                    <i class="mr-1 bi bi-arrow-left-circle" style="font-size: 2rem"></i>
                </a>
                <h2 class="mt-1 font-semibold text-xxl text-gray-800 leading-tight">
                    {{ $username }}
                </h2>
            </div>
            <div>
                <a href="/{{$username}}/followers" class="mr-1 link-primary">Followers</a>
                <a href="/{{$username}}/following" class="link-primary">Following</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('feed')
            </div>
        </div>
    </div>
</x-app-layout>
