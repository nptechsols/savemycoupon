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
                            <p><h5><b>COUPON_CODE</b></h5> 
                            {{$coupon->coupon_code}}</p>
                            <p><h5><b>LOGO</b></h5>  
                            {{@$coupon->website->logo}}</p>
                            <!-- <p><h5><b>DESCRIPTION</b></h5> 
                            {{$coupon->description}}</p> -->
                            <p><h5><b>EXPIRY_DATE</h5></b> 
                            {{$coupon->expiry_date}}</p>
                            <!-- <h5 class="text-left"><b>OPTIONS</b></h5> : --> 
                                <p class="text-left">
                                    <a class="btn btn-xs btn-primary" href="{{ route('coupons.show', $coupon->id) }}"><i class="glyphicon glyphicon-eye-open"></i> View</a>
                                    <a class="btn btn-xs btn-warning" href="{{ route('coupons.edit', $coupon->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('coupons.destroy', $coupon->id) }}" meh5od="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_meh5od" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
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