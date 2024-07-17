@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left mb-4">
                    <div class="float-end">
                        @can('product-create')
                            <a class="btn btn-success" href="{{ route('purchasecreate') }}"> Create New Purchase</a>
                        @endcan
                    </div>
                
            </div>

            <div class="form-group" style="display: flex;
            gap: 12px;justify-content: flex-end;">
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="searchInput" placeholder="Enter inventory" name="search">
                </div>
            </div>
        </div>
    </div>


    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('failure'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table id="myTable" class="table table-striped table-hover">
        <thead>
            <th>S.no</th>
            <th>Name</th>
            <th>Stock</th>
            <th>Price</th>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                searching: false,
                "columnDefs": [
            { "className": "text-center", "targets": "_all" } // Align all columns to center
        ]
            });

            $('#searchInput').on('keyup', function() {
                search();
            });
            search();

            function search() {
                var keyword = $('#searchInput').val();
                $.post('{{ route('purchase.search') }}', {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        keyword: keyword
                    },
                    function(data) {
                        table_post_row(data);
                    });
            }
           
            function table_post_row(res) {
                $('#myTable').DataTable().clear().draw();
                
                console.log(res.product.length);
                if (res.product.length > 0) {
        res.product.forEach(function(product, index) {
            $('#myTable').DataTable().row.add([
                index + 1,
                product.name,
                product.stock,
                product.price,
            ]).draw(false);
        });
    } else {
        $('#myTable').DataTable().row.add([
            '','No data available', '', ''
        ]).draw(false);
    }
}


        });
    </script>
@endsection
