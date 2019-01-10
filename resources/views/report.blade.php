@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

          Halaman Ini Salah
          

            @include('tahunjur')

            @include('jalurukt')

        </div>
    </div>
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change','.form-control',function(){
      console.log("oke got it");
      var fakultas=$(this).val();
      console.log(fakultas);
    });
  });
</script>
