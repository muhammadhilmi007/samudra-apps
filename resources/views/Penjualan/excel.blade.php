<html>

	<tr>
	    <!-- Headings -->
	    <td colspan="5"><h1>Users</h1></td>
	</tr>
	<tr>
		<td><b>id</b></th>
        <td><b>STT</b></th>
        <td><b>Kantor Asal</b></th>
        <td><b>Kantor Tujuan</b></th>
        <td><b>Pengirim</b></th>
        <td><b>Penerima</b></th>
        <td><b>Tanggal</b></th>
        <td><b>Action</b></th>
	</tr>
	@foreach($penjualan as $p)
		<tr>
			<td>{{$p->id}}</td>
			<td>{{$p->stt}}</td>
			<td>{{$p->s_kantor_asal->nama_cabang}}</td>
			<td>{{$p->s_kantor_tujuan->nama_cabang}}</td>
			<td>{{$p->pengirim}}</td>
			<td>{{$p->penerima}}</td>
			<td>{{$p->created_at}}</td>
		</tr>
	@endforeach

</html>



