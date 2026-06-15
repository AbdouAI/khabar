<x-app-layout>

<div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden ">
            <div class="bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm ">
                <h1 class="article-page-title">{{$article->title}}</h1>
                <img class="article-page-image" src="{{asset('storage/articleImages/'.$article->image)}}" alt="image">
                <h4 class="article-page-date">{{$article->date}}</h4>
                <h4 class="writer-name">{{$article->user->first_name}} {{$article->user->last_name}}</h4>
                
                <p class="article-text"> {!! nl2br($article->text)!!}</p>
                <div class="share-box">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" target="_blank"><img src="{{asset('storage/sm/fb.webp')}}" alt="Facebook"></a>

                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}&text=Check%20out%20this%20awesome%20page!" target="_blank"><img src="{{asset('storage/sm/x.png')}}" alt="X"></a>

                    <a href="https://wa.me/?text={{ urlencode('Check out this awesome page: ' . Request::fullUrl()) }}" target="_blank"><img src="{{asset('storage/sm/wa.png')}}" alt="WhatsApp"></a>
                </div>
            </div>


            <div class="bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm ">
                <h1 class="article-page-title">Recommandé:</h1>
                <div class="article-container recommendation-container">
                @foreach($recommend as $rec)
                        <a class="article-link" href="{{route('article.show',['article'=>$rec->id])}}">
                            <div class="article" style="background-image: url({{asset('storage/articleImages/'.$rec->image)}});">

                                <h4 class="article-date">{{$rec->date}}</h4>
                                <h2 class="article-title">{{$rec->title}}</h2>
                            </div>
                        </a>
                        
                        @endforeach
                </div>
            </div>
            

            <div class="bg-white p-6 text-gray-900 mt-4 sm:rounded-lg shadow-sm ">
            <h1 class="article-page-title">Ajouter un commentaire:</h1>
            <form action="{{route('comment.store',['article'=>$article->id])}}" method="post" class="comment-form mt-6 mb-6 space-y-6">
            @csrf
            @method('POST')
                    <div>
                    <x-input-label for="name" :value="__('Nom')" />
                    <input class="article-input long-input" type="text" name="name" >
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <input class="article-input long-input" type="email" email="email" name="email">
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <div>
                    <x-input-label for="comment_text" :value="__('Commentaire')" />
                    <textarea class="comment-text-area" name="comment_text" id="comment_text" cols="30" rows="10"></textarea>
                    @error('comment_text')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    </div>
                    <input class="submit-btn" type="submit" value="Submit">
                </form>
            <h1 class="article-page-title">Commentaires:</h1>
            @if(count($article->comments)!=0)
                @foreach ($article->comments as $cmnt)
                    <div class="comment" data-comment-id="{{$cmnt->id}}">
                        <h3 class="name">{{$cmnt->name}} - <span class="date-time">{{$cmnt->date_time}}</span></h3>
                        <p class="text">{{$cmnt->comment_text}}</p>
                        <div class="reviews">
                            <div class="inner-reviews">
                            <p class="like-count">{{$cmnt->like_count}}</p>
                            <img class="vote-btn" data-vote="like" data-article-id="{{$cmnt->article->id}}" data-cmnt-id="{{$cmnt->id}}" src="{{asset('/storage/images/like.png')}}" alt="">
                            </div>

                            <div class="inner-reviews">
                            <p class="dislike-count">{{$cmnt->dislike_count}}</p>
                            <img class="vote-btn" data-vote="dislike" data-article-id="{{$cmnt->article->id}}" data-cmnt-id="{{$cmnt->id}}" src="{{asset('/storage/images/dislike.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="is-empty-msg">Aucun commentaire</p>
            @endif
            </div>

            </div>
        </div>
        <script>

                document.querySelectorAll('.vote-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var article_id = this.getAttribute('data-article-id');
                    var cmnt_id = this.getAttribute('data-cmnt-id');
                    var action = this.getAttribute('data-vote');
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                var commentContainer = document.querySelector('.comment[data-comment-id="' + cmnt_id + '"]');
                                console.log(commentContainer)
                                var countElement;
                                if (action === 'like') {
                                    countElement = commentContainer.querySelector('.like-count');
                                } else if (action === 'dislike') {
                                    countElement = commentContainer.querySelector('.dislike-count');
                                }
                                console.log(countElement)
                                var currentCount = parseInt(countElement.innerText);
                                countElement.innerText = currentCount + 1;
                            } else {
                                console.error('Request failed:', xhr.status);
                                // Handle error
                            }
                        }
                    };
                    xhr.open('GET', '/articles/'+article_id+'/comments/'+cmnt_id+'/votes/'+action);
                    xhr.setRequestHeader('Content-Type', 'application/json');
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.send();
                });
            });

        </script>
</x-app-layout>
