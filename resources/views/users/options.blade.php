<a href="{{ url('/users/'.$user->id) }}" class="btn btn-primary">
	<i class="fa fa-edit"></i> Edit
</a>
<form action="{{ url('/users/'.$user->id) }}" method="post">
	{{ csrf_field() }}
	{{ method_field('delete') }}
	<button class="btn btn-error" onclick="return ensure()">
		<i class="fa fa-trash"></i>
		Delete
	</button>
</form>
