<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="5"><h1>Truck</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>No Polisi</b></td>
		<td><b>Nama Truck</b></td>
		<td><b>Grup</b></td>
	</tr>
	@foreach($truck as $k)
		<tr>
			<td>{{$k->id}}</td>
			<td>{{$k->no_polisi}}</td>
			<td>{{$k->nama_truck}}</td>
			<td>{{$k->grup}}</td>
		</tr>
	@endforeach

</html>