@extends('app')

@section('content')

	<h1>{{$article->title}}</h1>
	<hr>

		<article>

			<div class="body">
				{{$article->body}}
			</div>
		</article>	
    
    @unless ($article->tags->isEmpty())
    <h5>Tags:</h5>
        <ul>
        @foreach($article->tags as $tag)
        <li>{{$tag->name}}</li>
        @endforeach
        </ul>
    @endif
@stop