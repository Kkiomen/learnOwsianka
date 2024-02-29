<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Blog to Course Category
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">

                    <x-bladewind.table>
                        <x-slot name="header">
                            <th>Id</th>
                            <th>Nazwa</th>
                            <th>Język</th>
                            <th>Opcje</th>
                        </x-slot>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>{{ $blog->id }}</td>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->language }}</td>
                                <td>
                                    <form method="POST" action="{{ route('course.category.add.blog.new', ['course' => $course->id, 'category' => $category->id, 'blog' => $blog->id]) }}">
                                        @csrf
                                        <div class="flex gap-5">
                                            <input class="w-3/4" type="number" min="0" step="1" name="sort" value="0"/>
                                            <button class="w-1/4 bg-black text-white">Dodaj</button>
                                        </div>
                                    </form>
{{--                                    <a href="{{ route('course.view', ['course' => $course->id]) }}">--}}
{{--                                        <x-bladewind.button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                                            View--}}
{{--                                        </x-bladewind.button>--}}
{{--                                    </a>--}}
{{--                                    --}}{{--                                    <a href="{{ route('socialPost.listEdit', ['id' => $social->id]) }}">--}}
{{--                                    <a href="#">--}}
{{--                                        <x-bladewind.button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                                            Edit--}}
{{--                                        </x-bladewind.button>--}}
{{--                                    </a>--}}
{{--                                    <x-bladewind.button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-2 rounded">--}}
{{--                                        --}}{{--                                        <a href="{{ route('socialPost.remove', ['id' => $social->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>--}}
{{--                                        <a href="#" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>--}}
{{--                                    </x-bladewind.button>--}}
                                </td>
                            </tr>

                        @endforeach
                    </x-bladewind.table>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
