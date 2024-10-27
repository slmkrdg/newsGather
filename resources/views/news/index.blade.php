<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haberler</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Haber Filtreleme</h2>
    <form id="filter-form" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="coin">Coin Seçimi</label>
                <select id="coin" class="form-control" name="coin">
                    <option value="">Seçiniz</option>
                    @foreach ($coins as $coin)
                        <option value="{{ $coin->code }}">{{ $coin->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="start-date">Başlangıç Tarihi</label>
                <input type="date" id="start-date" class="form-control" name="start_date">
            </div>
            <div class="form-group col-md-4">
                <label for="end-date">Bitiş Tarihi</label>
                <input type="date" id="end-date" class="form-control" name="end_date">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrele</button>
    </form>

    <table id="news-table" class="table table-striped">
        <thead>
            <tr>
                <th>Başlık</th>
                <th>Tarih</th>
            </tr>
        </thead>
        <tbody>
            <!-- Veriler burada dinamik olarak yüklenecek -->
        </tbody>
    </table>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {

    var table = $('#news-table').DataTable({
        pageLength: 20,
        lengthMenu: [10, 20, 50, 100],
    });
 

    $('#filter-form').on('submit', function(e) {
        e.preventDefault();
        

        var formData = $(this).serialize();


        table.clear().draw();

        $.ajax({
            url: '{{ route("news.filter") }}', 
            method: 'GET',
            data: formData,
            success: function(data) {

                $.each(data.news, function(index, news) {
                    table.row.add([
                        news.title,
                        news.published_at,
                        news.coin.name
                    ]).draw();
                });
            },
            error: function(xhr) {
                alert('Hata: ' + xhr.status + ' - ' + xhr.statusText);
            }
        });
    });
});
</script>

</body>
</html>
