@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                {{-- show message success --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h2>User-Control</h2>
                    </div>

                    <div class="card-body">
                        <a href="{{ route('register') }}" class="btn btn-outline-primary">register</a>
                        <div class="table-responsive">
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($user as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->role }}</td>
                                            <td>
                                                &nbsp;
                                                @if (Auth::check() && Auth::user()->role == 'admin')
                                                    <a href="{{ route('user.edit', $item->id) }}"
                                                        class="btn btn-outline-warning">Edit</a>
                                                @endif
                                                    <a href="{{ route('user.destroy', $item->id) }}"
                                                        class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
