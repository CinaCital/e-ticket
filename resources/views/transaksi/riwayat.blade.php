@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Riwayat Transaksi</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <th>#</th>
                                    <th>Nama Penerbangan</th>
                                    <th>Destination</th>
                                    <th>tanggal pergi</th>
                                    <th>Username</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @forelse ($riwayat as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->listTransaksi->name }}</td>
                                            <td>{{ $item->listTransaksi->description }}</td>
                                            <td>{{ $item->listTransaksi->tanggal }}</td>
                                            <td>{{ $item->listUser->name }}</td>
                                            <td>{{ $item->listReal->qty }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>
                                                &nbsp;
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
