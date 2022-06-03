@extends('layouts.dashboard')
@section('title', 'Penjualan')
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
              <form id="cart" method="post" enctype="multipart/form-data">
              @csrf
              @method('POST')
                  <div class="form-group">
                      <label class="control-label mb-10">No Penjualan</label>
                      <input type="text" name="no_penjualan" class="form-control" required="required"> 
                  </div> 
                 <div class="form-group">
                      <label class="control-label mb-10">Tanggal Penjualan</label>
                      <input type="date" name="tgl_penjualan" class="form-control" required="required"> 
                  </div> 
                   <div class="form-group"> 
                      <table class="table table-striped" name="cart">
                        <tr>
                          <th></th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Price</th>
                          <th>&nbsp;</th>
                          <th>Item Total</th>
                        </tr>
                        <tr class="line_items">
                          <td><button class="btn btn-danger row-remove">Remove</button></td>
                          <td> <select class="form-control pil_product" name="product[]">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($dt_product as $product)
                                      <option data-harga="{{ $product->harga }}" value="{{ $product->id }}">{{ $product->nama }}</option>
                                    @endforeach
                                  </select></td>
                          <td><input class="form-control qty" type="text" name="qty" value="1"></td>
                          <td><input class="form-control price" type="text" name="price" value="0"></td>
                          <td>&nbsp;</td>
                          <td><input class="form-control" type="text" name="item_total" value="" jAutoCalc="{qty} * {price}"></td>
                        </tr> 
                        <tr>
                          <td colspan="3">&nbsp;</td>
                          <td>Sub Total</td>
                          <td>&nbsp;</td>
                          <td><input type="text" class="form-control sub_total" name="sub_total" value="" jAutoCalc="SUM({item_total})"></td>
                        </tr> 
                        <tr>
                          <td colspan="3">&nbsp;</td>
                          <td>Diskon <h6>10% Pembelian 40.000 ke atas</h6></td>
                          <td>&nbsp;</td>
                          <td><input type="text" class="form-control" name="diskon" value="0" id="diskon" readonly="readonly"></td>
                        </tr> 
                        <tr>
                          <td colspan="3">&nbsp;</td>
                          <td>Total</td>
                          <td>&nbsp;</td>
                          <td><input type="text" class="form-control" name="total" value="0" id="total"></td>
                        </tr> 
                        <tr>
                          <td colspan="3">&nbsp;</td>
                          <td>Bayar</td>
                          <td></td>
                          <td><input class="form-control bayar" type="text" name="bayar" value="0"></td>
                        </tr> 
                        <tr>
                          <td colspan="3">&nbsp;</td>
                          <td>Kembalian</td>
                          <td>&nbsp;</td>
                          <td><input type="text" class="form-control" name="kembalian" value="" jAutoCalc="SUM({item_total}) - {bayar}"></td>
                        </tr> 
                        <tr>
                          <td colspan="99"><button class="btn btn-primary row-add">Add Item</button></td>
                        </tr>
                      </table> 
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jautocalc@1.3.1/dist/jautocalc.js"></script>
  <script type="text/javascript">

     $("#cart").on('submit', function (e) {     
      // var total = $("#item_total").val();    
      var qty = $("input[name='qty']")
              .map(function(){return $(this).val();}).get();
      var harga = $("input[name='price']")
              .map(function(){return $(this).val();}).get();
              console.log(qty);
      $.ajax({
          type: 'post',
          url: 'penjualan/tambah',
          dataType: 'json',
          data: $('#cart').serialize()+"&qty_arr="+qty+"&harga_arr="+harga,
          success: function (resp) {
          console.log(resp); 
                swal({
                    title: "Proses Berhasil",
                    text:"",
                    type: "success"
                }, function() {
                    location.href="/penjualan";
                });  
          },
          error: function()
          {}
      });  
   return false;
});

    $(function() {

      function autoCalcSetup() {
        $('form#cart').jAutoCalc('destroy');
        $('form#cart tr.line_items').jAutoCalc({keyEventsFire: true, emptyAsZero: true});
        $('form#cart').jAutoCalc();
      }
      autoCalcSetup();


      $('button.row-remove').on("click", function(e) {
        e.preventDefault();

        var form = $(this).parents('form')
        $(this).parents('tr').remove();
        autoCalcSetup();

      });

      $('button.row-add').on("click", function(e) {
        e.preventDefault();

        var $table = $(this).parents('table');
        var $top = $table.find('tr.line_items').first();
        var $new = $top.clone(true);

        $new.jAutoCalc('destroy');
        $new.insertBefore($top);
        $new.find('input[type=text]').val('');
        autoCalcSetup();

      });

    });
    //-->

    $('.pil_product').change(function () { 
        var harga = $(this).find(':selected').attr('data-harga');  
        var row = $(this).closest("tr");
        row.find('.price').val(harga); 
        row.find('.qty').focus(); 
    });



  $(".bayar").on('keyup', function(){
    var n = parseInt($(this).val().replace(/\D/g,''),10);
    if(isNaN(n))
    {
        $(this).val("0");
    }
    else
    { 
        $(this).val(n.toLocaleString());
    }
});
  $(".sub_total").on('change', function(){ 
    var sub = $(this).val().split(",").join("");
    // alert(sub);
    if(sub>40000)
    {
      diskon = sub * 10 / 100;
      $("#diskon").val(diskon);
      $("#total").val(sub-diskon);
    }
    else
    { 
      $("#diskon").val(0);
      $("#total").val(sub);
    }
});
  </script>
@endsection