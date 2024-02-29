<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Social Posts
        </h2>
    </x-slot>

    <div class="pb-4 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
{{--            <a href="{{ route('socialPost.generateTitle') }}">--}}
{{--                <div class="rounded-md bg-indigo-600 px-3.5 mt -2 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Generuj tytuł</div>--}}
{{--            </a>--}}
{{--            <a href="{{ route('socialPost.updateSitemap') }}">--}}
{{--                <div class="rounded-md bg-indigo-600 px-3.5 mt-2 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Sitemap</div>--}}
{{--            </a>--}}
        </div>
    </div>

    <div class="pb-4 mt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <form method="POST" action="{{ route('course.add') }}">
                    @csrf
                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                            <div class="mt-2">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" name="name" placeholder="Name"  />
                            </div>
                        </div>
                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Language</label>
                            <div class="mt-2">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="language" type="text" name="language" placeholder="Language"  value="pl" />
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
                            <th>Id</th>
                            <th>Nazwa</th>
                            <th>Opis</th>
                            <th>Język</th>
                            <th>Opcje</th>
                        </x-slot>
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->id }}</td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->language }}</td>
                                <td>
                                    <a href="{{ route('course.view', ['course' => $course->id]) }}">
                                        <x-bladewind.button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            View
                                        </x-bladewind.button>
                                    </a>
{{--                                    <a href="{{ route('socialPost.listEdit', ['id' => $social->id]) }}">--}}
                                    <a href="#">
                                        <x-bladewind.button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Edit
                                        </x-bladewind.button>
                                    </a>
                                    <x-bladewind.button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-2 rounded">
{{--                                        <a href="{{ route('socialPost.remove', ['id' => $social->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>--}}
                                        <a href="#" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
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
