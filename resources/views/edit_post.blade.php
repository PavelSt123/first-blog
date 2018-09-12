@include ('partials.header')
@include ('partials.errors')
@if (session('message'))
    <div class="alert alert-fail">
        {{ session('message') }}
    </div>
@endif
	<form method="POST" action="/posts/{{$post->id}}" enctype="multipart/form-data">
		<input name="_method" type="hidden" value="PATCH">
		<input name="_token" type="hidden" value="aiDh4YNQfLwB20KknKb0R9LpDFNmArhka0X3kIrb">
		{{ csrf_field() }}
		<div class="form-group">
		    <label for="exampleInputEmail1">Title</label>
		    <input type="string" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter the title" value="{{$post->title}}" required>
		</div>
		<div class="form-group">
		    <label for="exampleFormControlTextarea1">Body</label>
		    <textarea name="body" placeholder="Enter the body" class="form-control" id="exampleFormControlTextarea1" rows="7" required>{{$post->body}}</textarea>
		</div>	
		<div class="form-group">
		    <label for="exampleInputEmail1">File</label>
		    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<button type="submit" class="btn btn-primary">
	        Submit
	    </button>
	</form>
@include ('partials.footer')