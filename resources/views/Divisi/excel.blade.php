<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="3"><h1>Divisi</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Nama Divisi</b></td>
	</tr>
	@foreach($divisi as $div)
		<tr>
			<td>{{$div->id}}</td>
			<td>{{$div->nama_divisi}}</td>
		</tr>
	@endforeach

</html>