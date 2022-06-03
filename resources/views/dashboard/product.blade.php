@extends('layouts.dashboard')
@section('title', 'Product')
@section('content')

<div class="page has-sidebar-left">
  <header class="my-3">
      <div class="container-fluid">
          <div class="card no-b">
            <div class="card-body">
              <a href="/product_tambah" class="btn btn-primary btn-sm" style="float:right;"><i class="icon icon-plus pr-2"></i>Tambah Product</a>
              <div class="card-title"><h4>Data Product</h4></div><br>
              <div class="card-body"> 
                 <div class="box-body table-responsive no-padding">
                   <table class="table table-striped yajra-datatable">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Kategori Product</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div> 
        </div>
    </div>
  </header>
</div> 
@endsection
@section('js') 
<script type="text/javascript"> 
$(document).ready(function() {
    var table = $('.yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "product/get_all",
        columns: [
            {data: 'gambar', name: 'gambar'},
            {data: 'nama', name: 'nama'},
            {data: 'deskripsi', name: 'deskripsi'},
            {data: 'harga', name: 'harga'},
            {data: 'Kategori_Product', name: 'Kategori_Product'},
            {data: 'stock', name: 'stock'},
            {data: 'action', name: 'action'},
        ],
        columnDefs:
            [{
                "targets":0,
                "data": 'gambar',
                "render": function (data, type, row, meta) {
                    return '<img src="/uploads/' + data + '" alt="' + data + '"height="90"/>';
                }
            },{
                "targets":2,
                "data": 'deskripsi',
                "render": function (data, type, row, meta) { 
                  var testHTML = $.parseHTML(data);
                  var elemHTML = $(testHTML[0].data);

                    return (elemHTML.text());
                }
            }],
    });
  }); 


function hapus_data(id)
{
   $('#id').val(id);
   swal({
      title: "Hapus product?",
      text: "",
      type: "warning",
      showLoaderOnConfirm: true,
      showCancelButton: true,
      confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Hapus',
      cancelButtonText: "Batal",
      closeOnConfirm: false,
      closeOnCancel: true
   },
   function(isConfirm){ 
     if (isConfirm)
      {
        $.ajax({
            type: 'DELETE',
            url: 'product/hapus',
            dataType: 'json',
            data: "id="+id,
            success: function (resp) { 
                 swal({
                      title: "Proses Berhasil",
                      text:"",
                      type: "success"
                  }, function() {
                      location.reload(true);
                  }); 
            },
            error: function()
            {   
            }
        }); 
      }   
    }); 
}
</script> 
@endsection
