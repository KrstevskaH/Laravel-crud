@extends('products.layout')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
<style>
    .green-button {
        background-color: green;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .green-button:hover {
        background-color: darkgreen;
    }
    .button-container {
        margin-top: 20px;
        text-align: center;
    }
</style>
<div class="button-container">
    <button id="fetchTableButton" class="green-button">Get API</button>
</div>
<div id="tableContainer" style="display: none;">
    <table id="universities-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>University Name</th>
                <th>Country</th>
                <th>Code</th>
                <th>Domain</th>
                <th>Web Page</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('#fetchTableButton').on('click', function() {
            // Fetch data via AJAX
            $.ajax({
                url: 'http://universities.hipolabs.com/search?country=United+States',
                method: 'GET',
                success: function(data) {
                    if (Array.isArray(data) && data.length > 0) {
                        populateTable(data);
                        $('#tableContainer').show();
                        $('#universities-table').DataTable();
                    } else {
                        console.error('Empty or invalid data returned from the API.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', error);
                }
            });
        });
        function populateTable(data) {
            var tableBody = $('#universities-table tbody');
            tableBody.empty();
            $.each(data, function(index, row) {
                var newRow = $('<tr>').append(
                    $('<td>').text(row.name),
                    $('<td>').text(row.country),
                    $('<td>').text(row.alpha_two_code),
                    $('<td>').text(row.domains ? row.domains[0] : ''),
                    $('<td>').html('<a href="' + (row.web_pages ? row.web_pages[0] : '') + '" target="_blank">' + (row.web_pages ? row.web_pages[0] : '') + '</a>')
                );
                tableBody.append(newRow);
            });
        }
    });
</script>
@endsection