@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Websites
            <a class="btn btn-success pull-right" href="{{ route('websites.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if($websites->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                           <!--  <th>ID</th> -->
                            <th>WEBSITE</th>
                            <th>LOGO</th>
                            <!-- <th>FILE UPLOAD</th> -->
                            <th class="text-right">OPTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($websites as $website)
                            <tr>
                               <!--  <td>{{$website->id}}</td> -->
                                <td>{{$website->website}}</td>
                                <td>{{$website->logo}}</td>
                               <!--   <td>{{$website->file_upload}}</td> -->
                                <td class="text-right">
                                    <a class="btn btn-xs btn-primary" href="{{ route('websites.show', $website->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('websites.edit', $website->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('websites.destroy', $website->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $websites->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

  

@endsection