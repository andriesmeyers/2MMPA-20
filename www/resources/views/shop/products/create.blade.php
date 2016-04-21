@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>New Post</h1>
                @if(count($errors) > 0 )
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::model($product, ['route' => 'shop.products.store']) !!}
                    <div class="form-group{{$errors->has('title') ? ' has-error' : ''}}">
                        {!! Form::label($name='title', $value='Title', $options=[
                            'class' => 'control-label',
                        ]) !!}
                        {!! Form::text($name='title', $value = null, $options = [
                            'class' => 'form-control',
                            'placeholder' => 'The title of your product&hellip;',
                        ]) !!}
                    </div>
                <div class="form-group">
                    {!! Form::label($name='content', $value='Content', $option=[
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::textarea($name = 'content', $value = null, $options = [
                            'class' => 'form-control',
                            'placeholder' => 'Description of the product&hellip;',
                    ])
                    !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name='category', $value='Category', $options=[
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::select($name = 'category', $value = $categories, $selected = null, $options = [
                            'class' => 'form-control',
                    ]) !!}
                </div>
                {!! Form::submit($value = 'Save', $options = [
                        'class' => 'btn btn-primary',
                    ]) !!}
                {!! link_to_route($name = 'shop.products.index', $title = 'Cancel', $parameters = null, $attributes = [
                    'class' => 'btn btn-default',
                ]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection