
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
</head>
<body>
<div class="container">
    <br />
    <br />
    <br />
        <form id="filter" >
            <div class="flex space-x-4">
        <div class="col-md-4">
            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date"   />
        </div>
        <div class="col-md-4">
            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date"  />
        </div>
            </div>
            <br />
            <br />
            <br />
            <div class="flex space-x-4">
            <div class="col-md-4">
                <input type="date" name="date" id="date"  class="form-control" placeholder="date"  />
            </div>
            <select name="operatorDate" id="operatorDate">
                <option value="=">=</option>
                <option value="!=">!=</option>
                <option value="<"><</option>
                <option value="<="><=</option>
                <option value=">">></option>
                <option value=">=">>=</option>
            </select>
            </div>
            <br />
            <br />
            <br />
            <div class="col-md-4">
            <input type="text" name="name" id="name" class="form-control" placeholder="Name"/></div>
                <select name="operatorName" id="operatorName" >
                    <option value="=">=</option>
                    <option value="!=">!=</option>

                </select>

            <br />
            <br />
            <br />
            <div class="col-md-4">
            <input type="number" name="id" id="id" class="form-control" placeholder="ID"/>
                </div>
            <select name="operatorId" id="operatorId">
                <option value="=">=</option>
                <option value="!=">!=</option>
                <option value="<"><</option>
                <option value="<="><=</option>
                <option value=">">></option>
                <option value=">=">>=</option>
            </select>
           <button type="submit">Flt</button>

    </form>
    <br />
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="user_table">
            <thead>
            <tr>
                <th>NO</th>
                <th>Full Name</th>
                <th>TOTAL IN</th>

            </tr>
            </thead>
            <tbody></tbody>

        </table>
    </div>
</div>
</body>
</html>

<script>
    var oTable = $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('show') }}',
            data: function (d) {
                d.from_date = $('input[name=from_date]').val();
                d.to_date = $('input[name=to_date]').val();
                d.date = $('input[name=date]').val();
                d.operatorDate = $("#operatorDate").val();
                d.operatorName = $("#operatorName").val();
                d.operatorId=$("#operatorId").val();
                d.name=$('input[name=name]').val();
                d.id=$('input[name=id]').val();

            }
        },

        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            {data: 'full_name', name: 'full_name'},
            {data:'total_in',name:'total_in'}


        ]
    });

    $('#filter').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();
    });




</script>

