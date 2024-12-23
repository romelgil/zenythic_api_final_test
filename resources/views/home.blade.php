<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Zenythic API Final Test</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Zenythic API Final Test</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Sports
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('/api/sports') }}">All Sports</a>
            <a class="dropdown-item" href="{{ url('/api/sports/soccer') }}">Soccer</a>
            <a class="dropdown-item" href="{{ url('/api/sports/basketball') }}">Basketball</a>
            <a class="dropdown-item" href="{{ url('/api/sports/american-football') }}">American Football</a>
            <a class="dropdown-item" href="{{ url('/api/sports/golf') }}">Golf</a>
            <a class="dropdown-item" href="{{ url('/api/sports/ice-hockey') }}">Ice Hockey</a>
            <a class="dropdown-item" href="{{ url('/api/sports/aussie-football') }}">Aussie Football</a>
            <a class="dropdown-item" href="{{ url('/api/sports/baseball') }}">Baseball</a>
            <a class="dropdown-item" href="{{ url('/api/sports/boxing') }}">Boxing</a>
            <a class="dropdown-item" href="{{ url('/api/sports/cricket') }}">Cricket</a>
            <a class="dropdown-item" href="{{ url('/api/sports/mixed-martial-arts') }}">Mixed Martial Arts</a>
            <a class="dropdown-item" href="{{ url('/api/sports/rugby-league') }}">Rugby League</a>
          </div>
        </li>
        <li class="nav-item">
          <!-- TODO: -->
          <a class="nav-link" href="#" id="apiLink">Casino API Data</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container mt-5">
    <div id="content">
      <!-- Content will be loaded here -->
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function () {
      $('a.dropdown-item').on('click', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        $.get(url, function (data) {
          var table = '<table class="table table-striped">';
          table += '<thead><tr><th>Sport</th><th>Title</th><th>Description</th><th>Active</th><th>Has Outrights</th></tr></thead>';
          table += '<tbody>';
          data.forEach(function (item) {
            table += '<tr>';
            table += '<td>' + item.group + '</td>';
            table += '<td>' + item.title + '</td>';
            table += '<td>' + item.description + '</td>';
            table += '<td>' + (item.active ? "Yes" : "No") + '</td>';
            table += '<td>' + (item.has_outrights ? "Yes" : "No") + '</td>';
            table += '</tr>';
          });
          table += '</tbody></table>';
          $('#content').html(table);
        });
      });
      $('#apiLink').on('click', function (e) {
        e.preventDefault();
        $.ajax({
          url: '{{ url('/api/casino') }}',
          method: 'POST',
          contentType: 'application/json',
          success: function (data) {
            $('#content').html('<pre>' + JSON.stringify(data, null, 2) + '</pre>');
          },
          error: function (xhr, status, error) {
            $('#content').html('<pre>' + xhr.responseText + '</pre>');
          }
        });
      });
    });
  </script>
</body>

</html>