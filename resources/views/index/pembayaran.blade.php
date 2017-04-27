<?php $settings = App\Models\AdminSettings::first(); ?>
@extends('app')
@section('title')@endsection

@section('css')
<link href="{{ asset('public/plugins/iCheck/all.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="jumbotron md index-header jumbotron_set jumbotron-cover">
      <div class="container wrap-jumbotron position-relative">
        <h1 class="title-site">Donation</h1>
        <p class="subtitle-site"><strong>Metode Pembayaran</strong></p>
      </div>
    </div>

<div class="container margin-bottom-40">
	
	<div class="row">
<!-- Col MD -->
<div class="col-md-12">	
	
<ul class="payment-method-list">

    <li class="payment-method__option payment-method__option--atm ">
        <label class="radio" onclick="document.getElementById('paypal').innerHTML='Anda dapat melakukan donasi melalui paypal.'">
            <input class="js-payment-method__toggle-atm payment-method__toggle" name="payment_payment[payment_method]" type="radio" value="atm">
                Paypal

        </label>
        <div id="paypal" class="payment-method-info payment-info--atm ">

        </div>

    </li>

    <li class="payment-method__option payment-method__option--atm active">
        <label class="radio" onclick="document.getElementById('transfer').innerHTML='Silakan transfer melalui bank Mandiri, BCA, BNI, atau BRI.'">
            <input class="js-payment-method__toggle-atm payment-method__toggle" name="payment_payment[payment_method]" type="radio" value="atm">
                Transfer

        </label>
        <div id="transfer" class="payment-method-info payment-info--atm active">

        </div>

    </li>

    <li class="payment-method__option payment-method__option--atm ">
        <label class="radio" onclick="document.getElementById('bcaclick').innerHTML='Click BCA individu.'">
            <input class="js-payment-method__toggle-atm payment-method__toggle" name="payment_payment[payment_method]" type="radio" value="atm">
                BCA ClickPay

        </label>
        <div id="bcaclick" class="payment-method-info payment-info--atm ">

        </div>

    </li>

    <li class="payment-method__option payment-method__option--atm ">
        <label class="radio" onclick="document.getElementById('mandiriclick').innerHTML='Donasi melalui Mandiri ClickPay.'">
            <input class="js-payment-method__toggle-atm payment-method__toggle" name="payment_payment[payment_method]" type="radio" value="atm">
                Mandiri ClickPay

        </label>
        <div id="mandiriclick" class="payment-method-info payment-info--atm ">

        </div>

    </li>

    <li class="payment-method__option payment-method__option--atm ">
        <label class="radio" onclick="document.getElementById('mandiriecash').innerHTML='Donasi melalui Mandiri E-Cash.'">
            <input class="js-payment-method__toggle-atm payment-method__toggle" name="payment_payment[payment_method]" type="radio" value="atm">
                Mandiri E-Cash

        </label>
        <div id="mandiriecash" class="payment-method-info payment-info--atm ">

        </div>

    </li>

    <li class="payment-method__option payment-method__option--atm ">
        <label class="radio" onclick="document.getElementById('cimb').innerHTML='Donasi melalui Cimb Click atau Rekening Ponsel.'">
            <input class="js-payment-method__toggle-atm payment-method__toggle" name="payment_payment[payment_method]" type="radio" value="atm">
                Cimb Click atau Rekening Ponsel

        </label>
        <div id="cimb" class="payment-method-info payment-info--atm ">

        </div>

    </li>

    <li class="payment-method__option payment-method__option--atm ">
        <label class="radio" onclick="document.getElementById('indomaret').innerHTML='Donasi melalui Indomaret, Alfamart, Kantorpos dan Pegadaian.'">
            <input class="js-payment-method__toggle-atm payment-method__toggle" name="payment_payment[payment_method]" type="radio" value="atm">
                Indomaret, Alfamart, Kantorpos dan Pegadaian

        </label>
        <div id="indomaret" class="payment-method-info payment-info--atm ">

        </div>

    </li>

    <li class="payment-method__option payment-method__option--atm ">
        <label class="radio" onclick="document.getElementById('jemput').innerHTML='Jemput Donasi Oleh Lindungi Hutan.'">
            <input class="js-payment-method__toggle-atm payment-method__toggle" name="payment_payment[payment_method]" type="radio" value="atm">
                Jemput Donasi Oleh Lindungi Hutan

        </label>
        <div id="jemput" class="payment-method-info payment-info--atm ">

        </div>

    </li>

</ul>

 </div><!-- /COL MD -->
  
</div><!-- ROW -->
 
 </div><!-- row -->
 
 <!-- container wrap-ui -->

@endsection

