<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('basic.calendar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <form method="POST" action="{{ route('saveEvent') }}">
                    @csrf
                        <x-bladewind.input label="Title" name="title" />
                        <x-bladewind.input label="Tags" name="tags" />
                        <x-bladewind.input label="Slug" name="slug" />
                        <x-bladewind.input label="Language" name="language" />
                        <x-bladewind.input label="Image url" name="image_url" />

                        <x-bladewind.textarea required="true" label="Short description" name="short_description"  />
                        <x-bladewind.textarea required="true" label="Content" name="content"  />

                        <x-bladewind.button has_spinner="true"
                                            can_submit="true"
                                            name="save-user"
                                            class="mx-auto block"
                                            onclick="unhide('.save-user .bw-spinner')">Add</x-bladewind.button>
                    </form>
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
