@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb mb-4">
            <div class="pullleft">
                <h2>Create New Sold</h2>
                    <div class="float-end">
                        <a class="btn btn-primary" href="{{ route('soldindex') }}"> Back</a>
                    </div>
                
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('soldstore') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Product Name:</strong>
                    <select name="name" id="product" class="form-control">
                        <option value="">Select Product</option>
                        @foreach ($collection as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Stock:</strong>
                    <input type="text" name="stock" id="stock" class="form-control" placeholder="Stock">
                </div>
            </div>
            <div class="col-xs-12 mb-3">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                </div>
            </div>
            <div class="col-xs-12 mb-3 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function(){
            $('#product').on('change', function() {
                search();
            });

            function search() {
                var keyword = $('#product').val();
                $.post('{{ route('sold.searchstock') }}', {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        keyword: keyword
                    },
                    function(data) {
                        console.log(data.product.stock);
                        $('#stock').val(data.product.stock);
                        $('#price').val(data.product.price);
                    });
            }
        });
    </script>
@endsection
