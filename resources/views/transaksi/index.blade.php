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
                        <h2>Transaksi</h2>
                    </div>

                    <div class="card-body">
                        @if (Auth::check() && Auth::user()->role == 'maskapai')
                            <span class="btn btn-success">{{ Auth::user()->name }}</span>
                            <a href="{{ route('transaksi.create') }}" class="btn btn-outline-primary">Tambah</a>
                        @elseif (Auth::check() && Auth::user()->role == 'admin')
                            <a href="{{ route('transaksi.create') }}" class="btn btn-outline-primary">Tambah</a>
                        @endif

                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Nama Penerbangan</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->listTransaksi->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>
                                                &nbsp;
                                                @if (Auth::check() && Auth::user()->role == 'admin')
                                                    <a href="{{ route('transaksi.edit', $item->id) }}"
                                                        class="btn btn-outline-warning">Edit</a>
                                                @elseif(Auth::check() && Auth::user()->role == 'maskapai')
                                                @endif
                                                @if ($item->status == 'unpaid')
                                                    <span class="btn btn-warning">Unpaid</span>
                                                @else
                                                    <span class="btn btn-success">Paid</span>
                                                @endif
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
