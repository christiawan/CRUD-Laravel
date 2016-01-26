All Bloglist

{{ Session::get('pesan') }}

@foreach ($data as $datas)
	<a href="crud/{{ $datas->slug }}"><p>{{ $datas->title }}</p></a>
	{{-- <a href="blog/{{ $datas->id }}"><p>{{ $datas->title }}</p></a> --}}
	<p>{{ $datas->subject }}</p><br>

	<p>{{ date('F d,Y'),strtotime($datas->created_at )}}</p>
	<br>
	<a href="blog/{{ $datas->id }}/edit">Edit </a>
	<form action="blog/{{ $datas->id }}" method="post" accept-charset="utf-8">
		<input type="hidden" name="_method" value="delete">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="submit" name="name" value="delete">
	</form>
	<hr>
@endforeach

{!! $data->links() !!}