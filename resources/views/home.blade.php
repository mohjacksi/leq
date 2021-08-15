@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-primary">
                <div class="card-header">
                تێبینییەکان
                </div>

                <div class="card-body text-info">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="checkbox" name="" id="">هنده ك بى زانينا لفيرى ديار دبن بو بكارهينه ر
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="checkbox" name="" id="">هنده ك بى زانينا لفيرى ديار دبن بو بكارهينه ر
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="checkbox" name="" id="">هنده ك بى زانينا لفيرى ديار دبن بو بكارهينه ر
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="checkbox" name="" id="">هنده ك بى زانينا لفيرى ديار دبن بو بكارهينه ر
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection