@extends('layouts.dashboard')
@section('title', 'Product')
@section('content')
 <style>
        .progress { position:relative; width:100%; }
        .bar { background-color: #00ff00; width:0%; height:20px; }
        .percent { position:absolute; display:inline-block; left:50%; color: #040608;}
   </style>
<div class="page has-sidebar-left">
  <header class="my-3">
      <div class="container-fluid">
          <div class="card mb-3 shadow no-b r-0">
            <div class="card-header white">
                <h6>Tambah Product</h6>
            </div>
            <div class="card-body"> 
              <div id="validation-errors" class="error"></div>
              <form id="form-simpan" action="/product/tambah" method="post" enctype="multipart/form-data">
              @csrf
              @method('POST')
                  <div class="form-group">
                      <label class="control-label mb-10">Gambar Product</label>
                      <input name="file" type="file" class="form-control"><br>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                      </div>
                  </div> 
                  <div class="form-group">
                      <label class="control-label mb-10">Nama Product</label>
                      <input type="text" name="nama" id="nama" class="form-control"> 
                  </div> 
                 <div class="form-group">
                      <label class="control-label mb-10">Deskripsi</label>
                      <textarea name="deskripsi" id="deskripsi"></textarea>
                  </div> 
                 <div class="form-group">
                      <label class="control-label mb-10">Harga</label>
                      <input type="number" name="harga" id="harga" class="form-control">  
                  </div> 
                   <div class="form-group">
                      <label class="control-label mb-10">Kategori Product</label>
                      <select class="form-control select2" name="prod_kateg">
                        @foreach ($dt_kateg as $kategori)
                          <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                      </select>
                  </div> 
                  <button class="btn btn-success" type="submit" id="btn_simpan">Simpan</button>
              </form>
            </div>
        </div>
    </div>
  </header>
</div> 
@endsection

@section('js') 
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript"> 
//   $("#form-simpan").on('submit', function (e) {    
//       // $('#btn_simpan').html('Proses...');
//       // $('#btn_simpan').attr('disabled',true);    
//       $.ajax({
//           type: 'post',
//           url: 'product/tambah',
//           dataType: 'json',
//           data: $('#form-simpan').serialize(),
//           success: function (resp) {
//           console.log(resp); 
//             // $('#btn_simpan').html('Simpan');
//             // $('#btn_simpan').attr('disabled',true);  
//                 swal({
//                     title: "Proses Berhasil",
//                     text:"",
//                     type: "success"
//                 }, function() {
//                     location.reload(true);
//                 });  
//           },
//           error: function()
//           {}
//       });  
//    return false;
// });

$(function () {
tinymce.init({
  selector: 'textarea#deskripsi',
}); 
  $(document).ready(function () {
      $('#form-simpan').ajaxForm({
          beforeSend: function () {
              var percentage = '0';
          },
          uploadProgress: function (event, position, total, percentComplete) {
              var percentage = percentComplete;
              $('.progress .progress-bar').css("width", percentage+'%', function() {
                return $(this).attr("aria-valuenow", percentage) + "%";
              })
          },
          complete: function (resp) {
              if(resp.status==200)
              {
                swal({
                    title: "Tambah Product Berhasil",
                    text:"",
                    type: "success"
                }, function() {
                    location.href= "/product";
                });  
              }
              else
              {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $('#validation-errors').html("");
                $.each(resp.responseJSON.errors, function(key,value) {
                   $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div');
                }); 
                // swal({
                //     title: "Warning",
                //     text:,
                //     type: "alert"
                // });  
              }
          }
      });
  });
});
</script> 
@endsection
