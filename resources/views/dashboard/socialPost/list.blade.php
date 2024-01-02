<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Social Posts
        </h2>
    </x-slot>

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
                        <x-bladewind.input label="Title post" name="title" />
                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Publication date</label>
                            <div class="mt-2">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="text" name="date" placeholder="2024-01-11"/>
                            </div>
                        </div>
                        <x-bladewind.button has_spinner="true"
                                            can_submit="true"
                                            name="save-user"
                                            class="mx-auto block"
                                            onclick="unhide('.save-user .bw-spinner')">Add</x-bladewind.button>
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
                            <th>Opcje</th>
                        </x-slot>
                        @foreach($socialPosts as $social)
                            <tr>
                                <td>{{ $social->title }}</td>
                                <td>{{ $social->date_post }}</td>
                                <td>
                                    <a href="{{ route('socialPost.view', ['id' => $social->id]) }}">
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
