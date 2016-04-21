@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Edit Product</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::model($product, [
                    'method' => 'put',
                    'route' => ['shop.products.update', $product->id]
                ]) !!}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {!! Form::label($name = 'title', $value = 'Title', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::text($name = 'title', $value = null , $options = [
                        'class' => 'form-control',
                        'placeholder' => 'The name of your product&hellip;',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'content', $value = 'Content', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::textarea($name = 'content', $value = null, $options = [
                        'class' => 'form-control',
                        'placeholder' => 'Description of your product&hellip;',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'category', $value = 'Category', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::select($name = 'category', $value = $categories, $selected = $product->category->id,
                        $options = [
                        'class' => 'form-control',
                    ]) !!}
                </div>
                {!! Form::submit($value = 'Save', $options = [
                        'class' => 'btn btn-primary',
                    ]) !!}
                {!! link_to_route($name = 'shop.products.index', $value = 'Cancel', $parameters = null, $attributes = [
                    'class' => 'btn btn-default',
                ]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>