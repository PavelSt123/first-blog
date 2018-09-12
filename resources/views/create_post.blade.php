@include ('partials.header')
@include ('partials.errors')
<form method="POST" action="create_post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="form-group">
	    <label for="exampleInputEmail1">Title</label>
	    <input type="string" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter the title" required>
	</div>
	<div class="form-group">
	    <label for="exampleFormControlTextarea1">Body</label>
	    <textarea name="body" placeholder="Enter the body" class="form-control" id="exampleFormControlTextarea1" rows="7" required></textarea>
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1">File</label>
	    <input type="file" name="image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
	</div>
	<div class="form-group">
	    <label for="exampleInputEmail1">Publish Date</label>
	    <input type="date" name="dateCreated" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
	</div>
	<button type="submit" class="btn btn-primary">
        Submit
    </button>
</form>
@include ('partials.footer')