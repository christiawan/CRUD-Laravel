
	Buat Postingan Baru
	<form action="../../crud/{{ $data->id }}" method="post" accept-charset="utf-8">
		<input type="text" name="title" value="{{ $data->title }}" placeholder="Judul"><br>
		{{ ($errors->has('title')) ? $errors->first('title'):'' }}<br>
		<textarea name="subject">
			{{ $data->subject }}
		</textarea><br>
		{{ ($errors->has('subject')) ? $errors->first('subject'):'' }}

		<br>
		<input type="hidden" name="_method" value="put">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="submit" name="submit" value="Submit Post">		
	</form>

	