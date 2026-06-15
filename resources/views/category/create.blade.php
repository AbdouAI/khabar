<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            <form action="{{route('category.store')}}" enctype="multipart/form-data" method="post" class="mt-6 space-y-6">
            @csrf
            @method('POST')
                    <div>
                    <x-input-label for="name" :value="__('Nom')" />
                    <input class=" long-input" type="text" name="name" id="name">
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <input class="submit-btn" type="submit" value="Submit">
                </form>
        </div>
    </div>
        </div>
</div>
</x-app-layout>
