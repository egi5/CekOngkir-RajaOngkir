<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.3.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
    <title>Cek Ongkir menggunakan Raja Ongkir</title>
</head>
<body >

<div class="topnav text-center" style="background-color: #f2a057;">
    <h3 class="center">Cek Ongkir Menggunakan Raja Ongkir</h3>
    <ul class="nav justify-content-center" style="background-color: #d98825;">
        <li class="nav-item"><a class="nav-link" aria-current="page" href="/">Perulangan</a></li>
        <li class="nav-item"><a class="nav-link" aria-current="page" href="/cekOngkir">Cek Ongkir</a></li>
    </ul>
</div>

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="height: 20rem; background-color: #f2a057;">
                <div class="card-body">
                    <h4 class="card-title">ORIGIN</h4>
                    <hr>
                    <div class="form-group">
                        <label class="font-weight-bold">PROVINSI ASAL</label>
                        <select class="form-control provinsiAsal" name="province_origin" id="provinsiAsal">
                            <option value="0">-- pilih provinsi asal --</option>
                            @foreach ($provinces as $province => $value)
                                <option value="{{ $province  }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">KOTA / KABUPATEN ASAL</label>
                        <select class="form-control kotaAsal" name="city_origin" id="kotaAsal">
                            <option value="">-- pilih kota asal --</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height: 20rem; background-color: #f2a057;">
                <div class="card-body">
                    <h4 class="card-title">DESTINATION</h4>
                    <hr>
                    <div class="form-group">
                        <label class="font-weight-bold">PROVINSI TUJUAN</label>
                        <select class="form-control provinsiTujuan" name="province_destination" id="provinsiTujuan">
                            <option value="0">-- pilih provinsi tujuan --</option>
                            @foreach ($provinces as $province => $value)
                                <option value="{{ $province  }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">KOTA / KABUPATEN TUJUAN</label>
                        <select class="form-control kotaTujuan" name="city_destination" id="kotaTujuan">
                            <option value="">-- pilih kota tujuan --</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="height: 20rem; background-color: #f2a057;">
                <div class="card-body">
                    <h4 class="card-title">KURIR</h4>
                    <hr>
                    <div class="form-group">
                        <label>PROVINSI TUJUAN</label>
                        <select class="form-control kurir" name="kurir" id="kurir">
                            <option value="0">-- pilih kurir --</option>
                            <option value="jne">JNE</option>
                            <option value="pos">POS</option>
                            <option value="tiki">TIKI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">BERAT (GRAM)</label>
                        <input type="number" class="form-control" name="weight" id="weight" placeholder="Masukkan Berat (GRAM)">
                    </div>

                    <button class="btn btn-md btn-primary btn-block btn-check" id="cekOngkir">CEK ONGKOS KIRIM</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-8">
            <div class="card d-none ongkir" style="background-color: #f2a057;">
                <div class="card-body">
                    <ul class="list-group" id="ongkir"></ul>
                </div>
            </div>
        </div>
    </div>    

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
</body>
</html>

<script>
    $(document).ready(function(){
        $(".provinsiAsal , .kotaAsal, .provinsiTujuan, .kotaTujuan").select2({
            theme:'bootstrap4',width:'style',
        });

        //select kota asal
        $('#provinsiAsal').on('change', function () {
            let provinceId = $(this).val();

            if (provinceId) {
                jQuery.ajax({
                    url: '/cities/'+provinceId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('#kotaAsal').empty();
                        $('#kotaAsal').append('<option value="">-- pilih kota asal --</option>');
                        $.each(response, function (key, value) {
                            $('#kotaAsal').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('#kotaAsal').append('<option value="">-- pilih kota asal --</option>');
            }
        });

        //select kota tujuan
        $('#provinsiTujuan').on('change', function () {
            let provinceId = $(this).val();

            if (provinceId) {
                jQuery.ajax({
                    url: '/cities/'+provinceId,
                    type: "GET",
                    dataType: "json",
                    success: function (response) {
                        $('#kotaTujuan').empty();
                        $('#kotaTujuan').append('<option value="">-- pilih kota tujuan --</option>');
                        $.each(response, function (key, value) {
                            $('#kotaTujuan').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                $('#kotaTujuan"]').append('<option value="">-- pilih kota tujuan --</option>');
            }
        });

        //check ongkir
        $('#cekOngkir').click(function (e) {
            e.preventDefault();

            let token       = $("meta[name='csrf-token']").attr("content");
            let kotaAsal    = $('#kotaAsal').val();
            let kotaTujuan  = $('#kotaTujuan').val();
            let kurir       = $('#kurir').val();
            let weight      = $('#weight').val();

            jQuery.ajax({
                url: "/ongkir",
                data: {
                    _token:     token,
                    kotaAsal:   kotaAsal,
                    kotaTujuan: kotaTujuan,
                    kurir:      kurir,
                    weight:     weight,
                },
                dataType: "JSON",
                type: "POST",
                success: function (response) {
                    if (response) {
                        $('#ongkir').empty();
                        $('.ongkir').addClass('d-block');
                        $.each(response[0]['costs'], function (key, value) {
                            $('#ongkir').append('<li class="list-group-item">'+response[0].code.toUpperCase()+' : <strong>'+value.service+'</strong> - Rp. '+value.cost[0].value+' ('+value.cost[0].etd+' hari)</li>')
                        });
                    }
                }
            });
        });
    });
</script>