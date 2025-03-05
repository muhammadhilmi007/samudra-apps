<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="6"><h1>Antrian Truck</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Truck</b></td>
		<td><b>Supir</b></td>
		<td><b>No Telp Supir</b></td>
		<td><b>Kernet</b></td>
		<td><b>No Telp Kernet</b></td>
	</tr>
	@foreach($antrian as $k)
		<tr>
			<td>{{$k->id}}</td>
			<td>{{$k->s_truck->nama_truck}}</td>
			<td>{{$k->supir}}</td>
			<td>{{$k->no_telp_supir}}</td>
			<td>{{$k->kernet}}</td>
			<td>{{$k->no_telp_kernet}}</td>
		</tr>
	@endforeach

</html>