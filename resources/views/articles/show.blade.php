@extends('app')

@section('content')

	<h1>{{$article->title}}</h1>
    <br>
    <a href="{{ route('articles.upvote', $article->id) }}">点赞</a>
        已有{{ $article->vote_count }}个赞
        <br>内容：{{$article->body}}
        <br>作者：{{\App\User::find($article->user_id)->name}}
        <br>创建时间：{{$article->published_at}}
        @unless ($article->tags->isEmpty())
    <h5>Tags:</h5>
        <ul>
        @foreach($article->tags as $tag)
        <li>{{$tag->name}}</li>
        @endforeach
        </ul>
      
    @endif
    
	<hr>
		<article>

			<div class="body">
				<img src="/images/catalog/{{$article->photo}}">
			</div>
		</article>	
    


@stop