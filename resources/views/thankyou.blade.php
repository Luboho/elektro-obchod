@extends('layout')

@section('title', 'Ďakujeme')

@section('extra-css')

@endsection

@section('body-class', 'sticky-footer')

@section('content')

   <div class="thank-you-section">
       <h1>Ďakujeme za <br> vašu objednávku!</h1>
       <p>Potvrdzujúci email bol odoslaný.</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ url('/') }}" class="button">Do obchodu</a>
       </div>
   </div>




@endsection
