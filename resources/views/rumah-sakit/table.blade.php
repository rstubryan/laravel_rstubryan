@foreach($rumahSakits as $rumahSakit)
    <tr>
        <td>{{ $rumahSakit->id }}</td>
        <td>{{ $rumahSakit->nama_rumah_sakit }}</td>
        <td>{{ $rumahSakit->alamat }}</td>
        <td>{{ $rumahSakit->email }}</td>
        <td>{{ $rumahSakit->telepon }}</td>
        <td>
            <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $rumahSakit->id }}">Edit</button>
            <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $rumahSakit->id }}">Delete</button>
        </td>
    </tr>
@endforeach
