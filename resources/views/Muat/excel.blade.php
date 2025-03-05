<html>

	<tr>
	    <td colspan="3"><h1>Muat</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Kode Muat</b></td>
		<td><b>Cabang</b></td>
		<td><b>Kode Cabang</b></td>
		<td><b>Antrian Truck</b></td>
		<td><b>Waktu Berangkat</b></td>
		<td><b>Waktu Sampai</b></td>
		<td><b>Checker</b></td>
		<td><b>Created At</b></td>
		<td><b>Updated At</b></td>
	</tr>
	@foreach($muat as $m)
		<tr>
			<td>{{$m->id}}</td>
			<td>{{$m->kode_muat}}</td>
			<td>{{$m->s_cabang->nama_cabang}}</td>
			<td>{{$m->s_cabang->kode_cabang}}</td>
			<td>{{$m->antrian_truck}}</td>
			<td>{{$m->waktu_berangkat}}</td>
			<td>{{$m->sampai}}</td>
			<td>{{$m->s_checker->name}}</td>
			<td>{{$m->created_at}}</td>
			<td>{{$m->updated_at}}</td>
		</tr>
	@endforeach

</html>