<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Course
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    {{ $course->name }}
                </div>
            </div>
        </div>
    </div>

{{--    <div class="py-2">--}}
{{--        <div class="max-w-7xl mx-auto ">--}}
{{--            <div class="p-4 sm:p-8">--}}
{{--                <div class="w-full">--}}
{{--                    <div class="flex gap-10 justify-end">--}}
{{--                        <div class="mx-1">--}}
{{--                            <a href="{{ route('socialPost.view.article', ['id' => $socialPost->id]) }}">--}}
{{--                                <button type="button"--}}
{{--                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">--}}
{{--                                    Article--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="mx-1">--}}
{{--                            <a href="{{ route('socialPost.view.posts', ['id' => $socialPost->id]) }}">--}}
{{--                                <button type="button"--}}
{{--                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">--}}
{{--                                    Posts--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="pb-12 pt-4">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
{{--                <div class="w-full">--}}
{{--                    <h2 class="text-lg font-medium text-gray-900 mb-5">--}}
{{--                        Blog post--}}
{{--                    </h2>--}}
{{--                    <div class="flex gap-10">--}}
{{--                        <div class="mx-1">--}}
{{--                            <a href="{{ route('socialPost.createArticle', ['id' => $socialPost->id, 'language' => 'pl']) }}">--}}
{{--                                <button type="button"--}}
{{--                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">--}}
{{--                                    Create Article - Polish language--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="mx-1">--}}
{{--                            <a href="{{ route('socialPost.createArticle', ['id' => $socialPost->id, 'language' => 'en']) }}">--}}
{{--                                <button type="button"--}}
{{--                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">--}}
{{--                                    Create Article - English language--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}

{{--                        <div class="mx-1">--}}
{{--                            <a href="{{ route('socialPost.content-blog.generate', ['id' => $socialPost->id]) }}"--}}
{{--                               onclick="return confirm('Czy chcesz to na pewno zrobić?')">--}}
{{--                                <button type="button"--}}
{{--                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">--}}
{{--                                    Generate All content--}}
{{--                                </button>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h2 class="text-lg font-medium text-gray-900 mb-5">
                        Course
                    </h2>
                    <form method="POST" action="{{ route('course.edit', ['course' => $course->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $course->id }}">

                        <div class="col-span-full">
                            <label for="about"
                                   class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                            <div class="mt-2">
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="title" type="text" name="name" placeholder="Name" value="{{ $course->name }}"/>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                            <div class="mt-2">
                                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="slug" type="text" name="slug" placeholder="slug"  value="{{ $course->slug }}" />
                            </div>
                        </div>

                        <div class="col-span-full mt-2">
                            <label for="about"
                                   class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                            <div class="mt-2">
                                <textarea
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" name="description" id="description">{{ $course->description }}</textarea>
                            </div>
                        </div>

                        <div class="col-span-full mt-2">
                            <label for="about"
                                   class="block text-sm font-medium leading-6 text-gray-900">Language</label>
                            <div class="mt-2">
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" name="language" id="language" value="{{ $course->language }}"/>
                            </div>
                        </div>

                        <hr class="mt-5 mb-3 mt-2"/>

                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Image url</label>
                            <div class="mt-2">
                                <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        type="text" name="image" id="image" value="{{ $course->image }}"/>
                            </div>
                            <label for="file-upload"
                                   class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500 mt-2">
                                <span>Upload a file</span>
                                <input id="file-upload" name="file-upload" type="file">
                            </label>
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Image alt</label>
                            <div class="mt-2">
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" name="image_alt" id="image_alt" value="{{ $course->image_alt }}"/>
                            </div>
                        </div>

                        <hr class="mt-5 mb-3"/>

                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Sort</label>
                            <div class="mt-2">
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="number" step="1" min="0" name="sort" id="sort"
                                    value="{{ $course->sort }}"/>
                            </div>
                        </div>

                        <div class="col-span-full mt-2">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Activated</label>
                            <div class="mt-2">
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="number" step="1" min="0" max="1" name="activated" id="activated"
                                    value="{{ $course->activated }}"/>
                            </div>
                        </div>


                            <div class="flex justify-between gap-5 mt-8">
                                <button type="submit"
                                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    <i class="fa-regular fa-floppy-disk mr-2"></i>
                                    Save
                                </button>


{{--                                            <a href="https://oatllo.com/article/{{ $blog->slug }}" target="_blank">--}}
{{--                                                <button type="button"--}}
{{--                                                        class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">--}}
{{--                                                    <i class="fa-solid fa-eye mr-2"></i>--}}
{{--                                                    View--}}
{{--                                                </button>--}}
{{--                                            </a>--}}
{{--                                            <a href="{{ route('socialPost.deleteBlog', ['id' => $blog->id]) }}"--}}
{{--                                               onclick="return confirm('Are you sure you want to delete this item?');">--}}
{{--                                                <button type="button"--}}
{{--                                                        class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">--}}
{{--                                                    <i class="fa-regular fa-trash-can mr-2"></i>--}}
{{--                                                    Delete--}}
{{--                                                </button>--}}
{{--                                            </a>--}}


{{--                                            <a href="{{ route('socialPost.content-blog.generate.prototype', ['id' => $blog->id]) }}"--}}
{{--                                               onclick="return confirm('Czy chcesz to na pewno zrobić?')">--}}
{{--                                                <button type="button"--}}
{{--                                                        class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">--}}
{{--                                                    Generate prototype--}}
{{--                                                </button>--}}
{{--                                            </a>--}}

{{--                                            <a href="{{ route('socialPost.updateDataApi', ['id' => $socialPost->id, 'blog' => $blog->id]) }}"--}}
{{--                                               onclick="return confirm('Czy chcesz to na pewno zrobić?')">--}}
{{--                                                <button type="button"--}}
{{--                                                        class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">--}}
{{--                                                    Update Data--}}
{{--                                                </button>--}}
{{--                                            </a>--}}


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr class="mt-6 mb-6" style="border-color: black;"/>


    @foreach($course->courseCategoriesByLanguage() as $category)

        <div class="py-6" style="margin-top: 20px">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-lg" style="border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                    <div class="w-full">
                        <h2 class="text-lg font-medium text-gray-900 mb-5">
                            Course Category - <small>{{ $category->name }}</small>
                        </h2>
                        <form method="POST" action="{{ route('course.category.edit', ['course' => $course->id, 'category' => $category->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="">

                            <div class="col-span-full">
                                <label for="about"
                                       class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                <div class="mt-2">
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        id="title" type="text" name="name" placeholder="Name" value="{{ $category->name }}"/>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                                <div class="mt-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="slug" type="text" name="slug" placeholder="slug" value="{{ $category->slug }}" />
                                </div>
                            </div>

                            <div class="col-span-full mt-2">
                                <label for="about"
                                       class="block text-sm font-medium leading-6 text-gray-900">Language</label>
                                <div class="mt-2">
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        type="text" name="language" id="language" value="{{ $category->language }}"/>
                                </div>
                            </div>

                            <hr class="mt-5 mb-3 mt-2"/>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Sort</label>
                                <div class="mt-2">
                                    <input
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                        type="number" step="1" min="0" name="sort" id="sort"
                                        value="{{ $category->sort }}"/>
                                </div>
                            </div>


                            <div class="flex justify-between gap-5 mt-8">
                                <button type="submit"
                                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                    <i class="fa-regular fa-floppy-disk mr-2"></i>
                                    Edit
                                </button>
                            </div>
                        </form>

                        <hr class="mt-5"/>

                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-gray-800 shadow-lg" style="margin-top: 0px">
                    <div class="w-full">
                        <div class="flex justify-between">
                            <div>
                                <h2 class="text-lg font-medium text-white mb-5">
                                    Lessons - <small>{{ $category->name }}</small>
                                </h2>
                            </div>
                            <div class="flex gap-3 text-white">
{{--                                <a href="#">--}}
{{--                                    <x-bladewind.button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">--}}
{{--                                        View--}}
{{--                                    </x-bladewind.button>--}}
{{--                                </a>--}}
                                <a href="{{ route('course.category.add-blog', ['course' => $course->id, 'category' => $category->id]) }}">
                                    <x-bladewind.button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        ADD
                                    </x-bladewind.button>
                                </a>
                            </div>
                        </div>

                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="w-full">

                                <x-bladewind.table>
                                    <x-slot name="header">
                                        <th>Nazwa</th>
                                        <th>Sort</th>
                                        <th>Opcje</th>
                                    </x-slot>
                                    @foreach($category->blogs() as $categoryLessons)
                                        <tr>
                                            <form method="POST" action="{{ route('course.category.update', ['course' => $course->id, 'category' => $category->id, 'categoryLessons' => $categoryLessons->id]) }}">
                                                @csrf
                                                <td>{{ $categoryLessons->blog()->title }}</td>
                                                <td><input type="number" min="0" step="1" name="sort" value="{{ $categoryLessons->sort }}"/></td>
                                                <td>
                                                    <a href="{{ route('socialPost.view.article', ['id' => $categoryLessons->blog()->social_post_id]) }}">
                                                        <x-bladewind.button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                            View
                                                        </x-bladewind.button>
                                                    </a>
                                                    <x-bladewind.button can_submit="true" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                                        SAVE
                                                    </x-bladewind.button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </x-bladewind.table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endforeach


    <hr class="mt-8 mb-6"/>

    <div class="py-6" style="margin-top: 20px">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h2 class="text-lg font-medium text-gray-900 mb-5">
                        Course Category
                    </h2>
                    <form method="POST" action="{{ route('course.category.add', ['course' => $course->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="">

                        <div class="col-span-full">
                            <label for="about"
                                   class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                            <div class="mt-2">
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    id="title" type="text" name="name" placeholder="Name" value=""/>
                            </div>
                        </div>

                        <div class="col-span-full mt-2">
                            <label for="about"
                                   class="block text-sm font-medium leading-6 text-gray-900">Language</label>
                            <div class="mt-2">
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="text" name="language" id="language" value=""/>
                            </div>
                        </div>

                        <hr class="mt-5 mb-3 mt-2"/>

                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Sort</label>
                            <div class="mt-2">
                                <input
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="number" step="1" min="0" name="sort" id="sort"
                                    value=""/>
                            </div>
                        </div>


                        <div class="flex justify-between gap-5 mt-8">
                            <button type="submit"
                                    class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                <i class="fa-regular fa-floppy-disk mr-2"></i>
                                Add
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
