<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-2">
                    <div class="w-full rounded-md grid grid-cols-3 text-center">
                        <div class="my-2">
                            <h3 class="text-lg">
                                Most downloads per user
                            </h3>
                            @foreach($profiles_downloads as $p_d)
                            <div>
                                <a href="{{ route('uprofile.show', [ 'profile' => $p_d ]) }}">{{ $p_d->username }}</a>
                            </div>
                            @endforeach
                        </div>
                        <div class="my-2">
                            <h3 class="text-lg">
                                Most views per user
                            </h3>
                            @foreach($profiles_views as $p_v)
                            <div>
                                <a href="{{ route('uprofile.show', [ 'profile' => $p_v ]) }}">{{ $p_v->username }}</a>
                            </div>
                            @endforeach
                        </div>
                        <div class="my-2">
                            <h3 class="text-lg">
                                Most likes per user
                            </h3>
                            @foreach($profiles_likes as $p_l)
                            <div>
                                <a href="{{ route('uprofile.show', [ 'profile' => $p_l ]) }}">{{ $p_l->username }}</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="h-px mx-4 my-2 bg-gray-700"></div>
                    <div class="w-full rounded-md grid grid-cols-3 text-center">
                        <div class="my-2">
                            <h3 class="text-lg">
                                Most downloads per picture
                            </h3>
                            @foreach($pictures_downloads as $p_d)
                            <div class="mt-2">
                                <a href="{{ route('uprofile.show', [ 'profile' => $p_d->profile ]) }}">
                                    <img src="{{ $p_d->url . '&fm=jpg&fit=max&q=50&h=256' }}" alt="" class="rounded-md">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="my-2">
                            <h3 class="text-lg">
                                Most views per picture
                            </h3>
                            @foreach($pictures_views as $p_v)
                            <div class="mt-2">
                                <a href="{{ route('uprofile.show', [ 'profile' => $p_v->profile ]) }}">
                                    <img src="{{ $p_v->url . '&fm=jpg&fit=max&q=50&h=256' }}" alt="" class="rounded-md">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="my-2">
                            <h3 class="text-lg">
                                Most likes per picture
                            </h3>
                            @foreach($pictures_likes as $p_l)
                            <div class="mt-2">
                                <a href="{{ route('uprofile.show', [ 'profile' => $p_l->profile ]) }}">
                                    <img src="{{ $p_l->url . '&fm=jpg&fit=max&q=50&h=256' }}" alt="" class="rounded-md">
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
