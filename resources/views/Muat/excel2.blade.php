<html>

	<tr>
	    <td colspan="4"><h1>Muat Detail</h1></td>
	</tr>
	<tr>
		<td><b>Id</b></td>
		<td><b>STT</b></td>
		<td><b>Id Muat</b></td>
		<td><b>Kode Muat</b></td>
		<td><b>Status</b></td>
		<td><b>Keterangan</b></td>
		<td><b>Created At</b></td>
		<td><b>Updated At</b></td>
	</tr>
	@foreach($muatdetail as $m)
		<tr>
			<td>{{$m->id}}</td>
			<td>{{$m->stt}}</td>
			<td>{{$m->id_muat}}</td>
			<td>{{$m->s_muat->kode_muat}}</td>
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