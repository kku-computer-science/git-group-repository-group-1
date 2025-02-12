

@extends('dashboards.users.layouts.user-dash-layout')

@section('content')
<div class="container">


	<form action="{{url('uploadproduct')}}" method="post" enctype="multipart/form-data">

		@csrf
	<input type="text" name="name" placeholder="Product Name">
	<input type="text" name="description" placeholder="Product description">
	<input type="file" name="file">
	<input type="submit" >
	</form>

</div>
@endsection