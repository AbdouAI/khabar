<x-app-layout>
    <div class="p-4 sm:p-8 bg-white shadow">
        <a class="margin-right" href="{{route('user.index')}}">Users</a>
        <a class="margin-right" href="{{route('submission.index')}}">Demandes</a>
        <a class="margin-right" href="{{route('admin.articles')}}">Articles</a>
        <a class="margin-right" href="{{route('category.index')}}">Category</a>

    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if($submissions)
            <div id="submissionsBox" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <h2 class="text-lg font-medium text-gray-900 mb-6">
                {{ __('Demandes') }}
            </h2>
                <div class="max-w-xl">
                @if((count($submissions)!=0))
                    <table border="1" class="submissions-table admin-table">
                        <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Details</th><th>Accepter</th><th>Rejeter</th></tr>
                        @foreach($submissions as $sub)
                            <tr><td>{{$sub->last_name}}</td><td>{{$sub->first_name}}</td><td>{{$sub->email}}</td><td><a href="{{route('submission.show',["submission"=>$sub->id])}}">Details</a></td>
                            <td>
                                <form action="{{route('submission.accept',["submission"=>$sub->id])}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="submit" value="Accepter">
                                </form>
                            </td>
                            <td>
                                <form action="{{route('submission.reject',["submission"=>$sub->id])}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="submit" value="Rejeter">
                                </form>
                            </td>
                        @endforeach
                    </table>
                    {{$submissions->links()}}
                @else
                <p class="is-empty-msg">Pas de demande</p>
                @endif
            </div>
            @endif
            @if($users)
            <div id="usersBox" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 mb-6">
                    {{ __('Users') }}
                </h2>
                    <div class="max-w-xl">
                    @if((count($users)!=0))
                        <table border="1" class="users-table admin-table">
                            <tr><th>Nom</th><th>Prenom</th><th>Email</th><th>Nombre articles</th><th>Est ecrivain</th><th>Révoquer</th><th>Accorder</th><th>Supprimer</th></tr>
                            @foreach($users as $user)
                                <tr><td>{{$user->last_name}}</td><td>{{$user->first_name}}</td><td>{{$user->email}}</td><td>{{$user->articles->count()}}</td><td>{{$user->is_writer?'oui':'non'}}</td>
                                <td>
                                    @if($user->is_writer)
                                    <form action="{{route('user.revokeWriter',["user"=>$user->id])}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="submit" value="Révoquer">
                                    </form>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if(!$user->is_writer)
                                    <form action="{{route('user.grantWriter',["user"=>$user->id])}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="submit" value="Accorder">
                                    </form>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    <form action="{{route('user.destroy',["user"=>$user->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Supprimer">
                                    </form>
                                </td>
                            @endforeach
                        </table>
                    {{$users->links()}}

                    @else
                    <p class="is-empty-msg">Pas de users</p>
                    @endif
                </div>
            </div>
            @endif
            @if($search)
            <div  class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 mb-6">
                    {{ __('Articles') }}
                </h2>
                    <div class="max-w-xl">
                    <form action="{{route('admin.search')}}" method="get">
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
                    <div class="article-container">
                    @foreach($result as $article)
                        <div class="article-container-inner shadow-sm">
                            <a class="article-link" href="{{route('article.show',['article'=>$article->id])}}">
                                <div class="article" style="background-image: linear-gradient(to top, rgba(0,0,0,.5), rgba(0,0,0,0)), url({{asset('storage/articleImages/'.$article->image)}});">
                                    <h4 class="article-date">{{$article->date}}</h4>
                                    <h2 class="article-title">{{$article->title}}</h2>
                                </div>
                            </a>
                            <div class="article-controls">
                                <a href="{{route('article.edit',['article'=>$article->id])}}">Modifier</a>
                                <form action="{{route('article.destroy',['article'=>$article->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Supprimer">
                                </form>
                            </div>
                        </div> 
                    @endforeach
                    @else
                    <p class="is-empty-msg">Pas d'articles</p>
                    @endif
                </div>
            </div>
            @endif
            @endif
            @if($categories)
            <div id="categoriesBox" class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="text-lg font-medium text-gray-900 mb-6">
                    {{ __('Categories') }}
                </h2>
                    <div class="max-w-xl">
                        <a class="action-link" href="{{route('category.create')}}">+Ajouter une categorie</a>
                    @if((count($categories)!=0))
                        <table style="margin-top: 1.5rem;" border="1" class="categorie-table admin-table">
                            <tr><th>ID</th><th>Nom</th><th>Nombre articles</th><th>Supprimer</th></tr>
                            @foreach($categories as $cat)
                                <tr><td>{{$cat->id}}</td><td>{{$cat->name}}</td><td>{{$cat->article_count}}</td>
                                <td>
                                    <form action="{{route('category.destroy',["category"=>$cat->id])}}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="submit" value="Supprimer">
                                    </form>
                                </td>
                            @endforeach
                        </table>
                    {{$categories->links()}}
                    @else
                    <p class="is-empty-msg">Pas de categorie</p>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
