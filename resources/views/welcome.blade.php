@include ('partials.header')
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div>
        <h1><strong>
            @if (! $posts->isEmpty()) List of All Posts
            @else No Posts at the moment
            @endif
        </strong></h1>
        <hr style="width: 40%"> 
        @foreach ($posts as $post)
            @if (Carbon\Carbon::now()->toDateTimeString() > $post->created_at->toDateTimeString())
                <div class="post">
                    <img src="storage/images/{{ $post->image }}" width="200px">
    		        <h2>
                        <a href="posts/{{$post->id}}">{{ $post->title }} </a>
                    </h2>
    		        <small>{{ $post->created_at->toDateString()}} by {{ $post->user->name}} </small>
                    <h4> {{ $post->body }} </h4>
             	</div>  
            @endif    
	    @endforeach
    </div>
@include ('partials.footer')    
