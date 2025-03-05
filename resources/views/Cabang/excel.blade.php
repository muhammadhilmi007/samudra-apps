<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="3"><h1>Cabang</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Nama Cabang</b></td>
		<td><b>Divisi</b></td>
	</tr>
	@foreach($cabang as $cab)
		<tr>
			<td>{{$cab->id}}</td>
			<td>{{$cab->nama_cabang}}</td>
			<td>{{$cab->s_divisi->nama_divisi}}</td>
		</tr>
	@endforeach

</html>