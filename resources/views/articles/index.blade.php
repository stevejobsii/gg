@extends('app')

@section('content')

	<h1>文章</h1>
	<hr>

	@foreach($articles as $article)
		<article>
			<h2><a href="{{ action('ArticlesController@show', [$article->id])}}">{{$article->title}}</a></h2>

			<div class="body">
				{{$article->body}}作者：{{\App\User::find($article->user_id)->name}}
				创建时间：{{$article->published_at}}
			</div>
		</article>	
	@endforeach

@stop