<x-app-layout>

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
        <form action="{{route('article.update',['article'=>$article->id])}}" enctype="multipart/form-data" method="post" class="mt-6 space-y-6">
        @csrf
        @method('PUT')
                    <div>
                    <x-input-label for="title" :value="__('Titre')" />
                    <input class="article-input long-input" type="text" name="title" id="title" value="{{$article->title}}">
                    @error('title')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <div>
                    <x-input-label for="category_id" :value="__('Categorie')" />
                    <select class="article-input long-input" type="text" name="category_id">
                        @foreach ($categories as $cat)
                            @if($cat->id==$article->category_id)
                                <option selected value="{{$cat->id}}">{{$cat->name}}</option>
                            @else
                                <option  value="{{$cat->id}}">{{$cat->name}}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <div>
                    <x-input-label for="image" :value="__('Image')" />
                    <input  type="file" name="image" id="image">
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <div>
                    <x-input-label for="text" :value="__('Text')" />
                    <textarea class="article-input big-input" name="text" id="text" cols="30" rows="10">{{$article->text}}</textarea>
                    @error('text')
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
