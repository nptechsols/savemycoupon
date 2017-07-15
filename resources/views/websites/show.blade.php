@extends('layout')
@section('header')
<div class="page-header">
        <h1>Websites / Show #{{$website->website}}</h1>
        <form action="{{ route('websites.destroy', $website->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('websites.edit', $website->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                <button type="submit" class="btn btn-danger">Delete <i class="glyphicon glyphicon-trash"></i></button>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <form action="#">
               <!--  <div class="form-group">
                    <label for="nome">ID</label>
                    <p class="form-control-static"></p>
                </div> -->
                <div class="form-group">
                     <label for="website">WEBSITE</label>
                     <p class="form-control-static">{{$website->website}}</p>
                </div>

                <div class="form-group">
                     <label for="logo">LOGO</label>
                     <p class="form-control-static"><img src="{{ $storagePath }}" width="200px" height="200px"/></p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('websites.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection