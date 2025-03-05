<html>

	<tr>
	    <td colspan="3"><h1>Lansir Detail</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>Stt</b></td>
		<td><b>Id Lansir</b></td>
		<td><b>Kode Lansir</b></td>
		<td><b>Nama Penerima</b></td>
		<td><b>Status</b></td>
		<td><b>Keterangan</b></td>
		<td><b>Created At</b></td>
		<td><b>Updated At</b></td>
	</tr>
	@foreach($lansirdetail as $m)
		<tr>
			<td>{{$m->id}}</td>
			<td>{{$m->stt}}</td>
			<td>{{$m->s_lansir->id}}</td>
			<td>{{$m->s_lansir->kode_lansir}}</td>
			<td>{{$m->nama_penerima}}</td>
			<td>
				@if($m->status == 0)
					On The Way
				@elseif($m->status == 1)
					Finish
				@elseif($m->status == 2)
					Pending
				@endif
			</td>
			<td>{{$m->keterangan}}</td>
			<td>{{$m->created_at}}</td>
			<td>{{$m->updated_at}}</td>
		</tr>
	@endforeach

</html>