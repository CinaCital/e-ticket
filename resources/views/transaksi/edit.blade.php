@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Edit Transaksi') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form enctype="multipart/form-data" action="{{ route('transaksi.update', $transaksi->id) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Id</td>
                                        <td><input type="text" class="form-control" name="id"
                                                value="{{ $transaksi->id }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>User Id</td>
                                        <td><input type="text" class="form-control" name="user_id"
                                                value="{{ $transaksi->user_id }}" readonly></td>
                                    </tr>

                                    <tr>
                                        <td>Qty</td>
                                        <td><input type="text" class="form-control" name="qty"
                                                value="{{ $transaksi->qty }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td><input type="text" class="form-control" name="total"
                                                value="{{ $transaksi->total }}" readonly></td>
                                    </tr>
                                    <tr>
                                        <td>Admin Confi</td>
                                        <td>
                                            <select name="admin_conf" class="form-control">
                                                <option value="Process" @if ($transaksi->admin_conf == 'Process') selected @endif>
                                                    Belum dikonfirmasi</option>
                                                <option value="Confirmed" @if ($transaksi->admin_conf == 'Confirmed') selected @endif>
                                                    Sudah dikonfirmasi</option>
                                            </select>
                                        </td>
                                    <tr>
                                        <td>Status</td>
                                        <td><input type="text" class="form-control" name="status"
                                                value="{{ $transaksi->status }}"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><button class="btn btn-outline-warning">Update</button></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
