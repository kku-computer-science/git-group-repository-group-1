@extends('dashboards.users.layouts.user-dash-layout')


@section('content')
<div class="container mt-5">

  
  @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
  @endif

  <div class="card">
    <div class="card-body">
        <h4 class="card-title">Import  Excel, CSV File</h4>
        <form id="import-csv-form" method="POST"  action="{{ url('import') }}" accept-charset="utf-8" enctype="multipart/form-data">
          @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="file" placeholder="Choose file">
                    </div>
                    @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>              
                 <div class="col-md-12">
                    <button type="submit" class="btn btn-primary mt-3" id="submit">Submit</button>
                </div>
            </div>     
        </form>
    </div>
  </div>
</div>
@endsection