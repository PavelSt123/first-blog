@include ('partials.header')
@if (session('message'))
    <div class="alert alert-fail">
        {{ session('message') }}
    </div>
@endif
    <div class="post">
    	<img src="/storage/images/{{ $post->image }}" width="200px">
        <h2> {{ $post->title }} </h2>
        <small>{{ $post->created_at->diffForHumans()}} by {{ $post->user->name}} </small>
        <h4> {{ $post->body }} </h4>
 	</div>
 	<a href="/posts/{{$post->id}}/edit">
 		<button type="button" class="btn btn-primary edit-btn"> Edit </button>	
 	</a>
 	<a href="/posts/{{$post->id}}/delete">
 		<button type="button" class="btn btn-primary edit-btn"> Delete </button>	
 	</a>
@include ('partials.footer')