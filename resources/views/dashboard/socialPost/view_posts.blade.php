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
                            <a href="{{ route('generateForSocialPost.generate', ['socialPostId' => $socialPost->id]) }}">
                                <button type="button"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Generate Social Posts
                                </button>
                            </a>
                        </div>
                        <div class="mx-1">
                            <a href="{{ route('sendSocialPost.socialMedia', ['socialPost' => $socialPost->id]) }}">
                                <button type="button"
                                        class="inline-flex items-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">
                                    Send Social Posts
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
            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 xl:gap-x-8">
                @foreach($posts as $post)
                    <div class="bg-white p-3 pb-10 rounded">
                        <div
                            class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                            @if($post->image !== null)
                                <img src="{{ \App\Helper\ImageHelper::getImage($post->image) }}" class="h-full w-full object-cover object-center group-hover:opacity-75"/>
                            @endif
                        </div>
                        <p class="mt-4 text-sm text-gray-700">{{ $post->text }}</p>
                        {{--                    <p class="mt-1 text-lg font-medium text-gray-900">$48</p>--}}
                        <div
                            class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-10">
                            <div>
                                @if($post->social_type == \App\Enum\SocialType::FACEBOOK->value)
                                    <i class="fa-brands fa-facebook"></i>
                                @elseif($post->social_type == \App\Enum\SocialType::INSTAGRAM->value)
                                    <i class="fa-brands fa-square-instagram"></i>
                                @elseif($post->social_type == \App\Enum\SocialType::TWITTER->value)
                                    <i class="fa-brands fa-x-twitter"></i>
                                @else
                                    <i class="fa-brands fa-linkedin"></i>
                                @endif

                            </div>
                            <div class="flex gap-2">
                                {{--                            <a href="#">--}}
                                {{--                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">--}}
                                {{--                                    Button--}}
                                {{--                                </button>--}}
                                {{--                            </a>--}}
                                <a href="{{ route('regenerateForSocialPost.generate', ['postId' => $post->id]) }}">
                                    <button
                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Generate
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- More products... -->
            </div>
        </div>
    </div>
</x-app-layout>
