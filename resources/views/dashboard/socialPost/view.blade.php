<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Social Posts
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    {{ $socialPost->title }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto ">
            <div class="p-4 sm:p-8">
                <div class="w-full">
                    <div class="flex gap-10 justify-end">
                        <div class="mx-1">
                            <a href="{{ route('socialPost.view.article', ['id' => $socialPost->id]) }}">
                                <button type="button"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Article
                                </button>
                            </a>
                        </div>
                        <div class="mx-1">
                            <a href="{{ route('socialPost.view.posts', ['id' => $socialPost->id]) }}">
                                <button type="button"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Posts
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pb-12 pt-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h2 class="text-lg font-medium text-gray-900 mb-5">
                        Blog post
                    </h2>
                    <div class="flex gap-10">
                        <div class="mx-1">
                            <a href="{{ route('socialPost.createArticle', ['id' => $socialPost->id, 'language' => 'pl']) }}">
                                <button type="button"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Create Article - Polish language
                                </button>
                            </a>
                        </div>
                        <div class="mx-1">
                            <a href="{{ route('socialPost.createArticle', ['id' => $socialPost->id, 'language' => 'en']) }}">
                                <button type="button"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Create Article - English language
                                </button>
                            </a>
                        </div>
                        <div class="mx-1">
                            <a href="{{ route('socialPost.updateDataApi', ['id' => $socialPost->id]) }}">
                                <button type="button"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Update Data
                                </button>
                            </a>
                        </div>

                        <div class="mx-1">
                            <a href="{{ route('socialPost.content-blog.generate', ['id' => $socialPost->id]) }}"  onclick="return confirm('Czy chcesz to na pewno zrobić?')">
                                <button type="button"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Generate All content
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($socialPost->blogs as $blog)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="w-full">
                        <h2 class="text-lg font-medium text-gray-900 mb-5">
                            Blog post
                        </h2>
                        <form method="POST" action="{{ route('saveEvent') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $blog->id }}">

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                <div class="mt-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" type="text" name="title" placeholder="Title" value="{{ $blog->title }}"  />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Tags</label>
                                <div class="mt-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="tags" type="text" name="tags" placeholder="architecture, backend, php" value="{{ $blog->tags }}"  />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
                                <div class="mt-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="slug" id="slug" value="{{ $blog->slug }}"  />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Language</label>
                                <div class="mt-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="language" id="language" value="{{ $blog->language }}"  />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Image url</label>
                                <div class="mt-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="image_url" id="image_url" value="{{ $blog->image_url }}"  />
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Short description</label>
                                <div class="mt-2">
                                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="short_description" id="short_description" value="{{ $blog->short_description }}"  />
                                </div>
                            </div>

                           <div class="flex mt-4">
                               <x-bladewind.checkbox
                                   label="Activated"
                                   checked="{{ $blog->activated == 0 ? 'false' : 'true' }}"/>


                               <div class="flex justify-between gap-5">
                                   <button type="submit"
                                           class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                       <i class="fa-regular fa-floppy-disk mr-2"></i>
                                       Save
                                   </button>

                                   @if($blog->language == 'pl')
                                    <a href="{{ route('blogPost', ['slug' => $blog->slug]) }}" target="_blank">
                                   @else
                                            <a href="https://oatllo.com/article/{{ $blog->slug }}" target="_blank">
                                   @endif
                                       <button type="button"
                                               class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                                           <i class="fa-solid fa-eye mr-2"></i>
                                           View
                                       </button>
                                   </a>
                                   <a href="{{ route('socialPost.deleteBlog', ['id' => $blog->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');">
                                       <button type="button"
                                               class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                           <i class="fa-regular fa-trash-can mr-2"></i>
                                           Delete
                                       </button>
                                   </a>


                                    <a href="{{ route('socialPost.content-blog.generate.prototype', ['id' => $blog->id]) }}"  onclick="return confirm('Czy chcesz to na pewno zrobić?')">
                                        <button type="button"
                                                class="inline-flex items-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                            Generate prototype
                                        </button>
                                    </a>

                               </div>
                           </div>
                        </form>
                        <div class="border border-1 border-gray-500 rounded p-5 my-4">
                            <h3 class="text-sm leading-7 text-gray-900 sm:truncate sm:text-sm sm:tracking-tight">
                                Content</h3>

                            @foreach($blog->contents as $content)
                                <form method="POST"
                                      action="{{ route('socialPost.updateBlogContent', ['contentId' => $content->id ]) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="contentId" value="{{ $content->id }}">

                                    <div class="mt-8">
                                        <div class="lg:flex lg:items-center lg:justify-between">
                                            <div class="min-w-0 flex-1">
                                                {{--                                                <h3 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Back End Developer</h3>--}}
                                                <div
                                                    class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                                                    {{--                                                    <div class="mt-2 flex items-center text-sm text-gray-500">--}}
                                                    {{--                                                        <svg class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
                                                    {{--                                                            <path fill-rule="evenodd" d="M6 3.75A2.75 2.75 0 018.75 1h2.5A2.75 2.75 0 0114 3.75v.443c.572.055 1.14.122 1.706.2C17.053 4.582 18 5.75 18 7.07v3.469c0 1.126-.694 2.191-1.83 2.54-1.952.599-4.024.921-6.17.921s-4.219-.322-6.17-.921C2.694 12.73 2 11.665 2 10.539V7.07c0-1.321.947-2.489 2.294-2.676A41.047 41.047 0 016 4.193V3.75zm6.5 0v.325a41.622 41.622 0 00-5 0V3.75c0-.69.56-1.25 1.25-1.25h2.5c.69 0 1.25.56 1.25 1.25zM10 10a1 1 0 00-1 1v.01a1 1 0 001 1h.01a1 1 0 001-1V11a1 1 0 00-1-1H10z" clip-rule="evenodd" />--}}
                                                    {{--                                                            <path d="M3 15.055v-.684c.126.053.255.1.39.142 2.092.642 4.313.987 6.61.987 2.297 0 4.518-.345 6.61-.987.135-.041.264-.089.39-.142v.684c0 1.347-.985 2.53-2.363 2.686a41.454 41.454 0 01-9.274 0C3.985 17.585 3 16.402 3 15.055z" />--}}
                                                    {{--                                                        </svg>--}}
                                                    {{--                                                        Full-time--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                            <div class="mt-5 flex lg:ml-4 lg:mt-0">
                                                {{--                                                <span class="hidden sm:block">--}}
                                                {{--                                                  <button type="button"--}}
                                                {{--                                                          class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">--}}
                                                {{--                                                    <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-400"--}}
                                                {{--                                                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">--}}
                                                {{--                                                      <path--}}
                                                {{--                                                          d="M2.695 14.763l-1.262 3.154a.5.5 0 00.65.65l3.155-1.262a4 4 0 001.343-.885L17.5 5.5a2.121 2.121 0 00-3-3L3.58 13.42a4 4 0 00-.885 1.343z"/>--}}
                                                {{--                                                    </svg>--}}
                                                {{--                                                    Edit--}}
                                                {{--                                                  </button>--}}
                                                {{--                                                </span>--}}


                                                @if($content->type == 'text')
                                                    <span class="ml-3 hidden sm:block">
                                                      <a href="{{ route('socialPost.generateBlogContent', ['contentId' => $content->id]) }}">
                                                          <button type="button"
                                                                  class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                            <i class="fa-solid fa-gear mr-2"></i>
                                                            Generate
                                                          </button>
                                                      </a>
                                                    </span>

                                                    <span class="ml-3 hidden sm:block">
                                                      <a href="{{ route('socialPost.updateDesignBlogContent', ['contentId' => $content->id]) }}">
                                                          <button type="button"
                                                                  class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                                            <i class="fa-solid fa-palette mr-2"></i>
                                                            Design
                                                          </button>
                                                      </a>
                                                    </span>
                                                @endif

                                                <span class="sm:ml-3">
                                                  <button type="submit"
                                                          class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                    <i class="fa-regular fa-floppy-disk mr-2"></i>
                                                    Save
                                                  </button>
                                                </span>

                                                <span class="sm:ml-3">
                                                    <a href="{{ route('socialPost.removeBlogContent', ['contentId' => $content->id]) }}"
                                                       onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <button type="button"
                                                                class="inline-flex items-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                                <i class="fa-regular fa-trash-can mr-2"></i>
                                                                Delete
                                                        </button>
                                                    </a>
                                                </span>

                                                <!-- Dropdown -->
                                                <div class="relative ml-3 sm:hidden">
                                                    <button type="button"
                                                            class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:ring-gray-400"
                                                            id="mobile-menu-button" aria-expanded="false"
                                                            aria-haspopup="true">
                                                        More
                                                        <svg class="-mr-1 ml-1.5 h-5 w-5 text-gray-400"
                                                             viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                                                  clip-rule="evenodd"/>
                                                        </svg>
                                                    </button>

                                                    <!--
                                                      Dropdown menu, show/hide based on menu state.

                                                      Entering: "transition ease-out duration-200"
                                                        From: "transform opacity-0 scale-95"
                                                        To: "transform opacity-100 scale-100"
                                                      Leaving: "transition ease-in duration-75"
                                                        From: "transform opacity-100 scale-100"
                                                        To: "transform opacity-0 scale-95"
                                                    -->
                                                    <div
                                                        class="absolute right-0 z-10 -mr-1 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                                        role="menu" aria-orientation="vertical"
                                                        aria-labelledby="mobile-menu-button" tabindex="-1">
                                                        <!-- Active: "bg-gray-100", Not Active: "" -->
                                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                                           role="menuitem" tabindex="-1"
                                                           id="mobile-menu-item-0">Edit</a>
                                                        <a href="#" class="block px-4 py-2 text-sm text-gray-700"
                                                           role="menuitem" tabindex="-1"
                                                           id="mobile-menu-item-1">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mt-8">

                                            @switch($content->type)

                                                @case('image')
                                                    {{--                                                        url="https://bladewindui.com/images/404.svg"--}}

                                                    @if($content->image_url !== null)
                                                        <img
                                                            src="{{ \App\Helper\ImageHelper::getImage($content->image_url) }}"/>
                                                    @endif
                                                    <div class="col-span-full">
                                                        <div
                                                            class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                                            <div class="text-center">
                                                                <label for="file-upload"
                                                                       class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                                    <span>Upload a file</span>
                                                                    <input id="file-upload" name="file-upload"
                                                                           type="file" class="sr-only">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--                                                        <x-bladewind.input label="Image" name="image_url" value="{{ $content->image_url }}"/>--}}
                                                    <x-bladewind.input label="Alt" name="image_alt"
                                                                       value="{{ $content->image_alt }}"/>
                                                    @break

                                                @case('text_with_header')
                                                    <x-bladewind.input label="Header" name="header"
                                                                       value="{{ $content->header }}"/>
                                                    <textarea name="content" rows="3"
                                                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">{{ $content->content }}</textarea>

                                                    @break

                                                @default
                                                    <textarea name="content" rows="3"
                                                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-3">{{ $content->content }}</textarea>
                                            @endswitch


                                        </div>


                                        <hr class="border border-b border-gray-300 my-5"/>

                                        <div class="flex">
                                            <a href="{{ route('socialPost.generateArticleAddContent', ['blogId' => $blog->id, 'type' => 'image', 'contentId' => $content->id ]) }}"
                                               class="w-1/2 px-2">
                                                <div
                                                    class="border border-b border-gray-300 border-dashed my-5 mx-auto text-center hover:cursor-pointer hover:border-solid hover:border-black">
                                                    <i class="fa-regular fa-image" style="color: #a8acb0"></i>
                                                </div>
                                            </a>
                                            <a href="{{ route('socialPost.generateArticleAddContent', ['blogId' => $blog->id, 'type' => 'text', 'contentId' => $content->id ]) }}"
                                               class="w-1/2 px-2">
                                                <div
                                                    class="border border-b border-gray-300 border-dashed my-5 mx-auto text-center hover:cursor-pointer hover:border-solid hover:border-black">
                                                    <i class="fa-solid fa-font" style="color: #a8acb0"></i>
                                                </div>
                                            </a>
                                        </div>

                                        <hr class="border border-b border-gray-300 my-5"/>

                                    </div>
                                </form>
                            @endforeach

                            @if(count($blog->contents) == 0)
                                <div class="flex">
                                    <a href="{{ route('socialPost.generateArticleAddContent', ['blogId' => $blog->id, 'type' => 'image', 'contentId' => 0 ]) }}"
                                       class="w-1/2 px-2">
                                        <div
                                            class="border border-b border-gray-300 border-dashed my-5 mx-auto text-center hover:cursor-pointer hover:border-solid hover:border-black">
                                            <i class="fa-regular fa-image" style="color: #a8acb0"></i>
                                        </div>
                                    </a>
                                    <a href="{{ route('socialPost.generateArticleAddContent', ['blogId' => $blog->id, 'type' => 'text', 'contentId' => 0 ]) }}"
                                       class="w-1/2 px-2">
                                        <div
                                            class="border border-b border-gray-300 border-dashed my-5 mx-auto text-center hover:cursor-pointer hover:border-solid hover:border-black">
                                            <i class="fa-solid fa-font" style="color: #a8acb0"></i>
                                        </div>
                                    </a>
                                </div>
                            @endif


                        </div>


                    </div>
                </div>
            @endforeach


        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h2 class="text-lg font-medium text-gray-900 mb-5">
                        Blog post - image - PL
                    </h2>
                    <form method="POST" action="{{ route('saveImageForSocialPost.generate', ['socialPost' => $socialPost->id, 'language' => 'pl']) }}" enctype="multipart/form-data">
                        @csrf
                        <label for="file-upload"
                               class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file">
                        </label>
                        <span class="sm:ml-3">
                                                  <button type="submit"
                                                          class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                    <i class="fa-regular fa-floppy-disk mr-2"></i>
                                                    Save
                                                  </button>
                                                </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <h2 class="text-lg font-medium text-gray-900 mb-5">
                        Blog post - image - EN
                    </h2>
                    <form method="POST" action="{{ route('saveImageForSocialPost.generate', ['socialPost' => $socialPost->id, 'language' => 'en']) }}" enctype="multipart/form-data">
                        @csrf
                        <label for="file-upload"
                               class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                            <span>Upload a file</span>
                            <input id="file-uploade" name="file-uploade" type="file">
                        </label>
                        <span class="sm:ml-3">
                                                  <button type="submit"
                                                          class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                                    <i class="fa-regular fa-floppy-disk mr-2"></i>
                                                    Save
                                                  </button>
                                                </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
