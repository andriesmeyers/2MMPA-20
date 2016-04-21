@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary mobili-product">
                    <div class="panel-heading">
                        {{ $product->title }}
                        <span class="label label-info pull-right">{{ $product->category->name }}</span>
                    </div>
                    <div class="panel-body">
                        <p>{{ $product->content }}</p>
                    </div>
                    <div class="panel-footer">
                        <small>
                            <i class="glyphicon glyphicon-user"></i>&nbsp;<b>{{ $product->user->name }}</b>
                            &mdash;
                            <i class="glyphicon glyphicon-calendar"></i>&nbsp; {{ $product->created_at }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection