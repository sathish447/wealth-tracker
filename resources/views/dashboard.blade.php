@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

<div class="row">

    <div class="col-lg-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>0</h3>
                <p>Family Members</p>
            </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>₹0</h3>
                <p>Total Assets</p>
            </div>
        </div>
    </div>

</div>

@stop
