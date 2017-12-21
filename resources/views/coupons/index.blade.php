@if(session()->get('role_id')==2)

@extends('layout')

@section('header')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Coupons
            <a class="btn btn-success pull-right" href="{{ route('coupons.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
@endsection

@section('content')

        @if($coupons->count())
            
                 @foreach($coupons as $coupon)
                    <div class="col-md-3">
                            <h5><b>{{$coupon->coupon_code}}</b></h5>
                            <img src="/storage/{{$coupon->website->logo}}" width="100px" height="100px"/>
                            <p><h5><b>{{$coupon->expiry_date}}</h5></b></p>
                            <p><h5><b>{{@$coupon->website_id->website}}</h5></b></p>
                                <p class="pull-left">
                                    <a class="btn btn-xs btn-primary" href="{{ route('coupons.show', $coupon->id) }}"><i class="glyphicon glyphicon-eye-open"></i> </a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('coupons.edit', $coupon->id) }}"><i class="glyphicon glyphicon-edit"></i> </a> &nbsp;
                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                    </form>
                                </p>
                                <br><br><br><br>
                    </div>  
                @endforeach
                  
                {!! $coupons->render() !!}
            @else
                <h5 class="text-center alert alert-info">Empty!</h5>
            @endif

        </div>
  

@endsection

@else

    <script type="text/javascript">
        window.location = "{{ url('login') }}";
    </script>

@endif
