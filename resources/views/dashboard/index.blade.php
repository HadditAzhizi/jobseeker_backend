@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
<div class="page has-sidebar-left">
    <header class="my-3">
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <span class="icon icon-box text-light-blue s-48"></span>
                            </div>
                            <div class="counter-title">Product</div>
                            <h5 class="sc-counter mt-3"><?php echo $dt_product;?></h5>
                        </div> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="counter-box white r-5 p-3">
                        <div class="p-4">
                            <div class="float-right">
                                <span class="icon icon-user light-green-text s-48"></span>
                            </div>
                            <div class="counter-title">User</div>
                            <h5 class="sc-counter mt-3"><?php echo $dt_user;?></h5>
                        </div>
                    </div>
                </div>
            </div>
         <div class="card no-b">
            <div class="card-body"> 
                <div class="card-title"><h4>10 Product Terlaris</h4></div><br>
                     <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th> 
                            <th>Harga</th>
                            <th>Terjual</th>
                            <th>Total Penjualan</th>
                        </tr>
                        @foreach ($dt_terlaris as $terlaris) 
                        <tr>
                            <td><img src="/uploads/{{ $terlaris->gambar }}" height="90"/></td>  
                            <td>{{ $terlaris->product }}</td> 
                            <td>{{ $terlaris->harga }}</td> 
                            <td>{{ $terlaris->qty_jual }}</td> 
                            <td>{{ $terlaris->harga * $terlaris->qty_jual }}</td> 
                        </tr>
                     @endforeach 
                    </thead>
                  </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </header> 
</div> 
 
@endsection

@section('js')  
@endsection
