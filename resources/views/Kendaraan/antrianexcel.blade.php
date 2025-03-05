<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="4"><h1>Antrian Kendaraan</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Kendaraan</b></td>
		<td><b>Supir</b></td>
		<td><b>Kernet</b></td>
	</tr>
	@foreach($antrian as $k)
		<tr>
			<td>{{$k->id}}</td>
			<td>{{$k->s_kendaraan->nama_kendaraan}}</td>
			<td>{{$k->s_supir->name}}</td>
			<td>{{$k->s_kernet->name}}</td>
		</tr>
	@endforeach

</html>