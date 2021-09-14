<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-4 py-2">
                    <div class="w-full rounded-md grid grid-cols-2 text-center">
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
                            abc
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
