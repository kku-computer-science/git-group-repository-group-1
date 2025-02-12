@extends('dashboards.users.layouts.user-dash-layout')
@section('title','Settings')

@section('content')
<div class="container">
    <div class="form-group">
        <label>Multiple</label>
        <select class="select2bs4" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
            @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach

        </select>
    </div>
    <!-- Dropdown -->
    <select id='selUser' style='width: 200px;'>
        <option value='0'>Select User</option>
        @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
    <input type='button' value='Seleted option' id='but_read'>
    <br />
    <div id='result'></div>
</div>

@endsection
<!-- @section('javascript')
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    })
    $(document).ready(function(){
 
 // Initialize select2
 $("#selUser").select2();

 // Read selected option
 $('#but_read').click(function(){
   var username = $('#selUser option:selected').text();
   var userid = $('#selUser').val();

   $('#result').html("id : " + userid + ", name : " + username);

 });
});
</script>
@endsection -->