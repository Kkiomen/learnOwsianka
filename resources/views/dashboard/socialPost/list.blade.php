<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Social Posts
        </h2>
    </x-slot>

    <div class="pb-4 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <a href="{{ route('socialPost.generateTitle') }}">
                <div class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Generuj tytuł</div>
            </a>
        </div>
    </div>

    <div class="pb-4 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <form method="POST" action="{{ route('socialPost.add') }}">
                    @csrf
                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                            <div class="mt-2">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" placeholder="Title"  />
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Publication date</label>
                            <div class="mt-2">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="text" name="date" placeholder="2024-01-11"/>
                            </div>
                        </div>

                        <div class="mt-4 text-right">
                            <button class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" name="save-user" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">

                    <x-bladewind.table>
                        <x-slot name="header">
                            <th>Tytuł</th>
                            <th>Data publikacji</th>
                            <th>Aktywne</th>
                            <th>Opcje</th>
                        </x-slot>
                        @foreach($socialPosts as $social)

                            @php
                                $activated = 1;

                                foreach ($social->blogs as $blog) {
                                    if ($blog->activated == 0) {
                                        $activated = 0;
                                    }
                                }

                                if(empty($social->blogs->count())) {
                                    $activated = 2;
                                }
                            @endphp

                            <tr>
                                <td>{{ $social->title }}</td>
                                <td>{{ $social->date_post }}</td>
                                <td class="text-center">
                                    @if($activated == 1)
                                        <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                    @endif

                                    @if($activated == 2)
                                        <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                    @endif

                                    @if($activated == 0)
                                        <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route('socialPost.view.article', ['id' => $social->id]) }}">
                                        <x-bladewind.button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            View
                                        </x-bladewind.button>
                                    </a>
                                    <x-bladewind.button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-2 rounded">
                                        <a href="{{ route('socialPost.remove', ['id' => $social->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                                    </x-bladewind.button>
                                </td>
                            </tr>

                        @endforeach
                    </x-bladewind.table>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
