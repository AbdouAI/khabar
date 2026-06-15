<x-app-layout>
    <div class="category-bar"> 
        @foreach ($categories as $cat)
        <form action="{{route('search')}}" method="get">
            <input class="hidden" type="search" name="term" value="{{$cat->name}}">
            <input class="hidden" type="search" name="is_category" value="true">
            <button type="submit">{{$cat->name}}</button>
        </form>
        @endforeach
    </div>
    <div class="filtres">
    <select  style="cursor: pointer;" onchange="window.location.href=this.value;">
    <option value="">Articles...</option>
        <option value="{{ route('filtre',['filtre'=>'all']) }}">Tous</option>
        <option value="{{ route('filtre',['filtre'=>'views']) }}">Plus lus</option>
        <option value="{{ route('filtre',['filtre'=>'comments']) }}">Avec Plus De Commentaire</option>
        <option value="{{ route('filtre',['filtre'=>'old']) }}">Plus ancien</option>
        <option value="{{ route('filtre',['filtre'=>'new']) }}">Plus nouveau</option>
    </select>
</div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden ">
                <div class="bg-white p-6 text-gray-900 sm:rounded-lg shadow-sm">
                    <form action="{{route('search')}}" method="get">
                        <input class="searchbar" type="search" name="term">
                        @error('term')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        <button type="submit">Chercher</button>
                    </form>
                </div>
                @isset($result)
                    @if((count($result)!=0))
                    <div class="pagination">{{$result->links()}}</div> 
                    @isset($term)
                    <h1 class="search-term">{{$term}}</h1>
                    @endisset
                    <div class="article-container bg-white p-6 text-gray-900 sm:rounded-lg shadow-sm ">
                        
                        @foreach($result as $res)
                        <a class="article-link" href="{{route('article.show',['article'=>$res->id])}}">
                            <div class="article" style="background-image: linear-gradient(to top, rgba(0,0,0,.5), rgba(0,0,0,0)), url({{asset('storage/articleImages/'.$res->image)}});">

                                <h4 class="article-date">{{$res->date}}</h4>
                                <h2 class="article-title">{{$res->title}}</h2>
                            </div>
                        </a>
                        
                        @endforeach

                    </div>
                    @else
                    <p class="is-empty-msg">Pas d'articles</p>
                    @endif

                @else
                <div class="bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm ">
                    <h1 class="home-title">Ajourd'hui</h1>
                    <div class="article-container bg-white text-gray-900  ">
                    @foreach($todayArticles as $at)
                        <a class="article-link" href="{{route('article.show',['article'=>$at->id])}}">
                            <div class="article" style="background-image: linear-gradient(to top, rgba(0,0,0,.5), rgba(0,0,0,0)), url({{asset('storage/articleImages/'.$at->image)}});">

                                <h4 class="article-date">{{$at->date}}</h4>
                                <h2 class="article-title">{{$at->title}}</h2>
                            </div>
                        </a>
                        
                        @endforeach
                    </div>
                </div>
                <div class="week-view-container bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm">

            
                    <div class="week-titles-container">
                        <h1 class="home-title">Grands Titres de semaine</h1>
                        <div class="inner-week-titles-container bg-white">
                        @foreach($weekTitles as $at)
                            <a class="week-title" href="{{route('article.show',['article'=>$at->id])}}">
                                    <h4 class="article-date">{{$at->date}}</h4>
                                    <h2 class="article-title">{{$at->title}}</h2>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="view-container">
                    <h1 class="home-title">Plus Lus</h1>
                        <div class="inner-view-container bg-white">
                        @foreach($viewArticles as $at)
                            <a class="view-article" href="{{route('article.show',['article'=>$at->id])}}">
                                    <img src="{{asset('storage/articleImages/'.$at->image)}}" alt="">
                                    <div class="text">
                                        <h4 class="article-date">{{$at->date}}</h4>
                                        <h2 class="article-title">{{$at->title}}</h2>
                                    </div> 
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm ">
                    <h1 class="home-title">Economie</h1>
                    <div class="article-container bg-white text-gray-900  ">
                    @foreach($economieArticles as $at)
                        <a class="article-link" href="{{route('article.show',['article'=>$at->id])}}">
                            <div class="article" style="background-image: linear-gradient(to top, rgba(0,0,0,.5), rgba(0,0,0,0)), url({{asset('storage/articleImages/'.$at->image)}});">

                                <h4 class="article-date">{{$at->date}}</h4>
                                <h2 class="article-title">{{$at->title}}</h2>
                            </div>
                        </a>
                        
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm ">
                    <h1 class="home-title">Politique</h1>
                    <div class="article-container bg-white text-gray-900  ">
                    @foreach($politiqueArticles as $at)
                        <a class="article-link" href="{{route('article.show',['article'=>$at->id])}}">
                            <div class="article" style="background-image: linear-gradient(to top, rgba(0,0,0,.5), rgba(0,0,0,0)), url({{asset('storage/articleImages/'.$at->image)}});">

                                <h4 class="article-date">{{$at->date}}</h4>
                                <h2 class="article-title">{{$at->title}}</h2>
                            </div>
                        </a>
                        
                        @endforeach
                    </div>
                </div>

                <div class="bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm ">
                    <h1 class="home-title">Sport</h1>
                    <div class="article-container bg-white text-gray-900  ">
                    @foreach($sportArticles as $at)
                        <a class="article-link" href="{{route('article.show',['article'=>$at->id])}}">
                            <div class="article" style="background-image: linear-gradient(to top, rgba(0,0,0,.5), rgba(0,0,0,0)), url({{asset('storage/articleImages/'.$at->image)}});">

                                <h4 class="article-date">{{$at->date}}</h4>
                                <h2 class="article-title">{{$at->title}}</h2>
                            </div>
                        </a>
                        
                        @endforeach
                    </div>
                </div>
                @endisset
            </div>
        </div>
       
    </div>
</x-app-layout>
