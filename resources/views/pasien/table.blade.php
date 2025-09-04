@foreach($pasiens as $pasien)
    <tr>
        <td>{{ $pasien->id }}</td>
        <td>{{ $pasien->nama_pasien }}</td>
        <td>{{ $pasien->alamat }}</td>
        <td>{{ $pasien->no_telpon }}</td>
        <td>{{ $pasien->rumahSakit->nama_rumah_sakit ?? '-' }}</td>
        <td>
            <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $pasien->id }}">Edit</button>
            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $pasien->id }}">Delete</button>
        </td>
    </tr>
@endforeach
