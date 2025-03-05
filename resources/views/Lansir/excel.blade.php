<html>

	<tr>
	    <td colspan="3"><h1>Lansir</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Antrian Kendaraan</b></td>
		<td><b>Cabang</b></td>
		<td><b>Kode Lansir</b></td>
		<td><b>Checker</b></td>
		<td><b>Berangkat</b></td>
		<td><b>Sampai</b></td>
		<td><b>Created At</b></td>
		<td><b>Updated At</b></td>
	</tr>
	@foreach($lansir as $m)
		<tr>
			<td>{{$m->id}}</td>
			<td>{{$m->antrian_kendaraan}}</td>
			<td>{{$m->s_antrian_kendaraan->s_kendaraan->s_cabang->nama_cabang}}</td>
			<td>{{$m->kode_lansir}}</td>
			<td>{{$m->s_checker->name}}</td>
			<td>{{$m->berangkat}}</td>
			<td>{{$m->sampai}}</td>
			<td>{{$m->created_at}}</td>
			<td>{{$m->updated_at}}</td>
		</tr>
	@endforeach

</html>