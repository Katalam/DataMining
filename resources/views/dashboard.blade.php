<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="w-full rounded-md grid grid-cols-6">
                    <div class="col-span-4 col-start-2 px-4 py-4">
                        <form action="{{ route('uprofile.search') }}" method="POST">
                            @csrf
                            <x-jet-label for="username">Username</x-jet-label>
                            <x-jet-input name="username" type="text" class="w-full mt-1" />
                            <div class="flex items-center justify-center">
                                <x-jet-button type="submit" class="mt-2 ">Submit</x-jet-button>
                            </div>
                            @if(session('status'))
                            <div class="flex items-center justify-center mt-2">
                                {{ session('status') }}
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
