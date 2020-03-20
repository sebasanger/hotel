@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Gestion</div>
            
                
                <div class="card-body">
                    <router-view></router-view>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection