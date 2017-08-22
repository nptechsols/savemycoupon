@if(session()->get('role_id')==1)

@extends('layout')
@section('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/css/bootstrap-datepicker.css" rel="stylesheet">
@endsection
@section('header')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Websites / Edit #{{$website->id}}</h1>
    </div>
@endsection

@section('content')
    @include('error')

    <div class="row">
        <div class="col-md-12">

            <form action="{{ route('websites.update', $website->id) }}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group @if($errors->has('website')) has-error @endif">
                       <label for="website-field">Website</label>
                    <input type="text" id="website-field" name="website" class="form-control" value="{{ is_null(old("website")) ? $website->website : old("website") }}"/>
                       @if($errors->has("website"))
                        <span class="help-block">{{ $errors->first("website") }}</span>
                       @endif
                    </div>

                    <div class="form-group @if($errors->has('logo')) has-error @endif">
            <label for="logo-field">Profile Picture</label>
            
            <input type="file" id="logo-field" name="logo" class="form-control">
            
            @if($errors->has("logo"))
              <span class="help-block">{{ $errors->first("logo") }}</span>
            @endif
                    </div>

<!-- 
                    <div class="form-group @if($errors->has('file_upload')) has-error @endif">
            <label for="file_upload-field">Profile Picture</label>
            
            <input type="file" id="file_upload-field" name="file_upload" class="form-control">
            
            @if($errors->has("file_upload"))
              <span class="help-block">{{ $errors->first("file_upload") }}</span>
            @endif
                    </div> -->

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-link pull-right" href="{{ route('websites.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                </div>
            </form>

        </div>
    </div>
@endsection
@section('scripts')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    $('.date-picker').datepicker({
    });
  </script>
@endsection

@else

    <script type="text/javascript">
        window.location = "{{ url('login') }}";
    </script>

@endif

