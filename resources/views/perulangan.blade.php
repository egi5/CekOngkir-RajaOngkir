<!doctype html>
<html lang="en">
<head>
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
    <h3 class="center">Logika Perulangan</h3>
    <ul class="nav justify-content-center" style="background-color: #d98825;">
        <li class="nav-item"><a class="nav-link" aria-current="page" href="/">Perulangan</a></li>
        <li class="nav-item"><a class="nav-link" aria-current="page" href="/cekOngkir">Cek Ongkir</a></li>
    </ul>
</div>

<div class="container-fluid mt-4">
    <div class="row">
        <h5>Rule :</h5>
        <ul>
            <li>Jika bilangan tersebut kelipatan 3 maka program akan mencetak "Bage"</li>
            <li>Jika bilangan merupakan kelipatan bilangan 5 maka akan mencetak "Concat"</li>
            <li>Jika bilangan merupakan kelipatan bilangan 3 dan 5 maka akan mencetak "Bage Concat"</li>
            <li>Jika bilangan mencetak kata "Bage Concat" sebanyak 2 kali Maka untuk bilangan kelipatan 3 akan mencetak "Concat" dan bilangan kelipatan 5 akan mencetak "Bage" </li>
            <li>Hentikan proram ketika kata "Bage Concat" telah tercetak sebanyak 5 kali </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card" style=" background-color: #f2a057;">
                <div class="card-body">
                    <div class="form-group">
                        <h4>Jumlah Perulangan</h4>
                        <input type="number" class="form-control" id="bilangan" placeholder="Masukan Bilangan">
                    </div>
                    <button class="btn btn-md btn-primary btn-block btn-check" id="run">RUN</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <span id="hasil"></span>
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
        $('#run').click(function (e) {
            e.preventDefault();

            let token       = $("meta[name='csrf-token']").attr("content");
            let bilangan    = $('#bilangan').val();

            jQuery.ajax({
                url: "/cekBilangan",
                data: {
                    _token:     token,
                    bilangan:   bilangan,
                },
                dataType: "JSON",
                type: "POST",
                success: function (response) {
                    var data = response.data;
                    var hasil = "<ul>";
                    for (var i = 0; i < data.length; i++) {
                        hasil += "<li>" + data[i] + "</li>";
                    }
                    hasil += "</ul>";
                    $('#hasil').html(hasil);
                }
            });
        });
    });
</script>