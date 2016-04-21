@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p><a href="{{ route('shop.products.create') }}" data-toggle="tooltip" data-placement="right"
                      title="New Product" class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i></a></p>
                @foreach($products as $product)
                    <div class="panel panel-primary mobili-product">
                        <div class="panel panel-heading">
                        {{ $product->title }}
                        <span class="label label-info pull-right">{{ $product->category->name }}</span>
                    </div>
                    <div class="panel-body">
                        <p>{{ $product->content  }}</p>
                    </div>
                    <div class="panel-footer">
                        <small><i class="glyphicon glyphicon-user"></i>
                            <b>
                                {{ $product->user->name }}
                            </b>
                            <i class="glyphicon glyphicon-calendar"></i>
                            {{ $product->created_at }}
                        </small>
                        <div class="btn-group pull-right">
                            <a class="btn btn-xs btn-default" href="{{ route('shop.products.show', $product->id) }}"
                               data-toggle="tooltip"
                               data-placement="top" title="Show"><i class="glyphicon glyphicon-open-file"></i></a>
                            <a href="{{ route('shop.products.edit', $product->id) }}" class="btn btn-xs btn-default"
                               data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="glyphicon glyphicon-edit"></i></a>
                            <button class="btn btn-xs btn-default" data-method="DELETE"
                                    data-uri="{{ route('shop.products.destroy', $product->id) }}"
                                    data-toggle="tooltip" data-placement="top" title="Delete">
                                <i class="glyphicon glyphicon-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts-bottom')

<script>
    $(function () {
        // Tooltip
        $('[data-toggle=tooltip]')
                .tooltip();

        // Delete buttons
        $('button[data-method]').on('click', function () {
            var self = $(this),
                    product = self.parents('.mobili-product');
            product.hide();
            $.ajax({
                        url: self.data('uri'),
                        type: self.data('method'),
                        data: {
                            _token : '{!! csrf_token() !!}'
                        }
                    })
                    .success(function (response) {
                        console.log('deleted:', self.data('uri'), response);
                    })
                    .error(function (error) {
                        product.show();
                        console.error('error:', self.data('uri'), error);
                    });
        });
    });

</script>
@endpush