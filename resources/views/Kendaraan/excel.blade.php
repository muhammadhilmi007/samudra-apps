<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="5"><h1>Kendaraan</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>No Polisi</b></td>
		<td><b>Nama Kendaraan</b></td>
		<td><b>Grup</b></td>
		<td><b>Cabang</b></td>
	</tr>
	@foreach($kendaraan as $k)
		<tr>
			<td>{{$k->id}}</td>
			<td>{{$k->no_polisi}}</td>
			<td>{{$k->nama_kendaraan}}</td>
			<td>{{$k->grup}}</td>
			<td>{{$k->s_cabang->nama_cabang}}</td>
		</tr>
	@endforeach

</html>