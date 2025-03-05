<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="5"><h1>Permissions</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Name</b></td>
		<td><b>Display Name</b></td>
		<td><b>Description</b></td>
	</tr>
	@foreach($permissions as $p)
		<tr>
			<td>{{$p->id}}</td>
			<td>{{$p->name}}</td>
			<td>{{$p->display_name}}</td>
			<td>{{$p->description}}</td>
		</tr>
	@endforeach

</html>