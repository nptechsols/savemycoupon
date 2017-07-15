@extends('layout')
@section('header')
<div class="page-header">
        <h1>Coupons / Show #{{$coupon->coupon_code}}</h1>
        <form action="{{ route('coupons.destroy', $coupon->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="btn-group pull-right" role="group" aria-label="...">
                <a class="btn btn-warning btn-group" role="group" href="{{ route('coupons.edit', $coupon->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
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
                     <label for="coupon_code">COUPON_CODE</label>
                     <p class="form-control-static">{{$coupon->coupon_code}}</p>
                </div>
                    <div class="form-group">
                     <label for="website">WEBSITE</label>
                     <p class="form-control-static">{{$coupon->website}}</p>
                </div>
                    <div class="form-group">
                     <label for="description">DESCRIPTION</label>
                     <p class="form-control-static">{{$coupon->description}}</p>
                </div>
                    <div class="form-group">
                     <label for="expiry_date">EXPIRY_DATE</label>
                     <p class="form-control-static">{{$coupon->expiry_date}}</p>
                </div>
            </form>

            <a class="btn btn-link" href="{{ route('coupons.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>

        </div>
    </div>

@endsection