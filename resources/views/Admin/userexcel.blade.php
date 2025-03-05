<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="5"><h1>Users</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Name</b></td>
		<td><b>Email</b></td>
		<td><b>Cabang</b></td>
	</tr>
	@foreach($users as $r)
		<tr>
			<td>{{$r->id}}</td>
			<td>{{$r->name}}</td>
			<td>{{$r->email}}</td>
			<td>{{$r->s_cabang->nama_cabang}}</td>
		</tr>
	@endforeach

</html>