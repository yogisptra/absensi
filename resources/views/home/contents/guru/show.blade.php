@extends('home.index')
@section('content')
<div class="title pb-20">
    <h2 class="h3 mb-0">{{ $title }}</h2>
</div>
<div class="card-box mb-30">
    <div class="pd-20 d-flex justify-content-between">
        <h4 class="text-blue h4">Detail Guru</h4>
        <div class="dropleft">
            <button type="button" class="btn btn-outline-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-three-dots"></i>
            </button>
            <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item" href="/guru/create">Tambah</a>
                <a class="dropdown-item" href="/guru/{{ $gurus->id }}/edit">Edit</a>
                <form action="/guru/{{ $gurus->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="dropdown-item" onclick="return confirm('Apakah anda yakin akan menghapus buku ini?')">Hapus</button>
                </form>
            </div>
            <a class="btn btn-outline-primary" href="/guru"><i class="bi bi-arrow-return-left"></i></a>
        </div>
    </div>
    <div class="pb-20">
        <table class="table stripe hover data-table-export nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">No.</th>
                    <th class="text-center">Data</th>
                    <th class="text-center">Isi Data</th>
                </tr>
            </thead>
            <tbody class="text-center">                    
                <tr>
                    <td>1</td>
                    <td>NIK             :</td>
                    <td>{{ $gurus->nik }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nama Depan      :</td>
                    <td>{{ $gurus->firstName }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nama Belakang   :</td>
                    <td>{{ $gurus->lastName }}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Jenis Kelamin   :</td>
                    <td>{{ $gurus->jns_kelamin }}</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Alamat          :</td>
                    <td>{{ $gurus->alamat }}</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>No. Telefon     :</td>
                    <td>{{ $gurus->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>E-mail          :</td>
                    <td>{{ $gurus->email }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection