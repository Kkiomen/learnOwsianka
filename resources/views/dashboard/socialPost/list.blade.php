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
                        <x-bladewind.input label="Title post" name="title" />
                        <x-bladewind.datepicker required="true" label="Publication date (2024-01-11)" name="date" placeholder="2024-01-11" />
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
