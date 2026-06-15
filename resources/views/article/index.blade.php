<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Articles') }}
        </h2>
    </x-slot>
    <div class="article-container p-6 text-gray-900 mt-4 sm:rounded-lg ">
        <div class="pagination">{{$articles->links()}}</div>
        @if((count($articles)!=0))
        @foreach($articles as $article)
            <div class="article-container-inner shadow-sm">
                <a class="article-link" href="{{route('article.show',['article'=>$article->id])}}">
                    <div class="article" style="background-image: linear-gradient(to top, rgba(0,0,0,.5), rgba(0,0,0,0)), url({{asset('storage/articleImages/'.$article->image)}});">
                        <h4 class="article-date">{{$article->date}}</h4>
                        <h2 class="article-title">{{$article->title}}</h2>
                    </div>
                </a>
                <div class="article-controls">
                    @if (auth()->user()->is_writer)
                        <a href="{{route('article.edit',['article'=>$article->id])}}">Modifier</a>
                        <form action="{{route('article.destroy',['article'=>$article->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Supprimer">
                    </form>
                    @endif
                    
                </div>
            </div> 
        @endforeach
        @else
        <div class=" bg-white p-6 sm:rounded-lg shadow-sm ">
            <p>Pas d'article</p>
            <a href="{{route('article.create')}}">Rédiger un article</a>
        </div>
        @endif
    </div>
</x-app-layout>
