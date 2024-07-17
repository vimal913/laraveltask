@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pull-left mb-4">
                    <div class="float-end">
                        @can('product-create')
                            <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Inventory</a>
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

    <table id="myTable" class="table table-striped table-hover">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Stock</th>
            <th>Price</th>
            <th width="280px">Action</th>
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
                $.post('{{ route('products.search') }}', {
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
                product.name,
                product.description,
                product.stock,
                product.price,
                `<div class="d-flex justify-content-center">
                    <a class="btn btn-info mx-1" href="/products/${product.id}">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-primary mx-1" href="/products/${product.id}/edit">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <form action="/products/${product.id}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mx-1">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                </div>`
            ]).draw(false);
        });
    } else {
        $('#myTable').DataTable().row.add([
            '',
            '', 'No data available', '', ''
        ]).draw(false);
    }
}


        });
    </script>
@endsection
