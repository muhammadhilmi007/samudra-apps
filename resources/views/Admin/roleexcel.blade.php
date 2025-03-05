<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="5"><h1>Roles</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Name</b></td>
		<td><b>Display Name</b></td>
		<td><b>Description</b></td>
	</tr>
	@foreach($roles as $r)
		<tr>
			<td>{{$r->id}}</td>
			<td>{{$r->name}}</td>
			<td>{{$r->display_name}}</td>
			<td>{{$r->description}}</td>
		</tr>
	@endforeach

</html>