@extends('layouts.dashboard')
@section('title', 'Penjualan')
@section('content')

<div class="page has-sidebar-left">
  <header class="my-3">
      <div class="container-fluid">
          <div class="card no-b">
            <div class="card-body">
              <a href="/penjualan_tambah" class="btn btn-primary btn-sm" style="float:right;"><i class="icon icon-plus pr-2"></i>Buat Penjualan</a>
              <div class="card-title"><h4>Data Penjualan</h4></div><br>
              <table class="table table-striped data-tables">
                  <thead>
                      <tr>
                          <th>No Penjualan</th> 
                          <th>Total Penjualan</th>
                          <th>Tanggal</th> 
                      </tr>
                  </thead>
                  @foreach ($dt_penjualan as $penjualan)
                        <tr>
                            <td>{{ $penjualan->no_penjualan }}</td> 
                            <td>{{ $penjualan->total }}</td> 
                            <td>{{ $penjualan->tgl_jual }}</td> 
                        </tr>
                     @endforeach
                  <tbody>  
                  </tbody>
                </table>
            </div> 
        </div>
    </div>
  </header>
</div>
@endsection

@section('js')  
@endsection
