<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full flex mx-4 items-center px-4 py-2">
                    <h2 class="text-xl mr-4">{{ $profile->username }}</h2>
                    <h3 class="text-md text-gray-800">{{ $profile->name }}</h3>
                </div>
                <div class="h-px mx-4 my-2 bg-gray-700"></div>
                <div class="w-full rounded-md grid grid-cols-3 text-center">
                    <div class="my-2">
                        <h3 class="text-lg">
                            Total Collections
                        </h3>
                        {{ $profile->total_collections }}
                    </div>
                    <div class="my-2">
                        <h3 class="text-lg">
                            Total Likes
                        </h3>
                        {{ $profile->total_likes }}
                    </div>
                    <div class="my-2">
                        <h3 class="text-lg">
                            Total Photos
                        </h3>
                        {{ $profile->total_photos }}
                    </div>
                </div>
                <div class="h-px mx-4 my-2 bg-gray-700"></div>
                <div class="w-full rounded-md grid grid-cols-3 text-center">
                    <div class="my-2">
                        <h3 class="text-lg">
                            Twitter
                        </h3>
                        {{ $profile->twitter }}
                    </div>
                    <div class="my-2">
                        <h3 class="text-lg">
                            Portfolio
                        </h3>
                        <a href="{{ $profile->portfolio_url }}">{{ $profile->portfolio_url }}</a>
                    </div>
                    <div class="my-2">
                        <h3 class="text-lg">
                            Location
                        </h3>
                        {{ $profile->location }}
                    </div>
                </div>
                <div class="h-px mx-4 my-2 bg-gray-700"></div>
                <div class="w-full rounded-md text-center">
                    <div class="my-2">
                        <h3 class="text-lg">
                            Bio
                        </h3>
                        {{ $profile->bio }}
                    </div>
                </div>
            </div>
            @foreach($pictures as $picture)
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-4">
                <img src="{{ $picture->url . '&fm=jpg&fit=max&q=50' }}" alt="" class="rounded-md">
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
