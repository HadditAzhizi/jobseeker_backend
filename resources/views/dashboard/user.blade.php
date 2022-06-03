@extends('layouts.dashboard')
@section('title', 'User')
@section('content')

<div class="page has-sidebar-left">
  <header class="my-3">
      <div class="container-fluid">
          <div class="card no-b">
            <div class="card-body">
              <a href="#" onclick="tambah()" class="btn btn-primary btn-sm" style="float:right;"><i class="icon icon-plus pr-2"></i>Tambah User</a>
              <div class="card-title"><h4>Data User</h4></div><br>
              <table class="table table-striped data-tables">
                  <thead>
                      <tr>
                          <th>Username</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody> 
                      @foreach ($dt_admin as $admin)
                        <tr>
                            <td>{{ $admin->username }}</td>
                            <td>
                                <a onclick="edit({{$admin->id}})" class="btn btn-primary btn-xs"><i class="icon icon-pencil pr-2"></i>Edit</a>
                                <a onclick="hapus_data({{$admin->id}})"  class="btn btn-danger btn-xs"><i class="icon icon-trash pr-2"></i>Hapus</a>
                                <a onclick="ganti_password({{$admin->id}})"  class="btn btn-warning btn-xs"><i class="icon icon-trash pr-2"></i>Ganti Password</a>
                            </td>
                        </tr>
                     @endforeach
                  </tbody>
                </table>
            </div> 
        </div>
    </div>
  </header>
</div>
<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="title"></h6> 
      </div>
        <form id="form-simpan" method="post">
        @csrf
        @method('POST')
          <input type="text" name="id" hidden="" id="id">
            <div class="modal-body">   
               <div class="form-group" id="username_div">
                    <label class="control-label mb-10" id="pass_username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" required="required"> 
                </div> 
               <div class="form-group" id="pass_div" hidden="hidden">
                    <label class="control-label mb-10">Password</label>
                    <input type="password" name="pass" id="pass" class="form-control" required="required"> 
                </div>       
            </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="btn_simpan">Simpan</button>
          </div>
      </form>
    </div> 
  </div> 
</div>
@endsection

@section('js') 
 <script type="text/javascript">

  function ganti_password(id)
  { 
    url = 'edit_pass'; 
    $('#id').val(id);
    $('#title').html("Ganti Password");
    $('#modal').modal('show');
    $("#username_div").prop("hidden",true);
    $("#pass_div").prop("hidden",false);
    $("#username").prop('required',false);
    $("#pass").prop('required',true);
    $.ajax({
      type: 'GET',
      url: 'user/get_select',
      dataType: 'json',
      data: "id="+id,
      success: function (resp) {
          },
          error: function()
          {
          }
      }); 
  }

  function edit(id)
  { 
    url = 'edit'; 
    $('#id').val(id);
    $('#title').html("Edit User");
    $('#modal').modal('show');
    $("#pass_div").prop("hidden",true);
    $("#username_div").prop("hidden",false);
    $("#username").prop('required',true);
    $("#pass").prop('required',false);
    $.ajax({
      type: 'GET',
      url: 'user/get_select',
      dataType: 'json',
      data: "id="+id,
      success: function (resp) { 
              $("#username").val(resp.username);  
          },
          error: function()
          {
          }
      }); 
  }

  function tambah()
  { 
     url = 'tambah';
    $('#title').html("Tambah User");
    $('#modal').modal('show');
    $("#username_div").prop("hidden",false);
    $("#pass_div").prop("hidden",false);
  }

  $("#form-simpan").on('submit', function (e) {    

      $('#btn_simpan').html('Proses...');
      $('#btn_simpan').attr('disabled',true);    
      $.ajax({
          type: 'post',
          url: 'user/'+url,
          dataType: 'json',
          data: $('#form-simpan').serialize(),
          success: function (resp) { 
            $('#btn_simpan').html('Simpan');
            $('#btn_simpan').attr('disabled',true); 

                swal({
                    title: "Proses Berhasil",
                    text:"",
                    type: "success"
                }, function() {
                    location.reload(true);
                });  
          },
          error: function()
          {}
      });  
   return false;
});

function hapus_data(id)
{
   $('#id').val(id);
   swal({
      title: "Hapus admin?",
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
            url: 'user/hapus',
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
