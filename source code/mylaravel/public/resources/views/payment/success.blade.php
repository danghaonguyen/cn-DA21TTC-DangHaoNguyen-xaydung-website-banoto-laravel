<!-- resources/views/payment/success.blade.php -->
@extends('layouts.app')

@section('title', 'Thanh toán thành công')

@section('content')
    <h1>Thanh toán thành công!</h1>
    <p>Cảm ơn bạn đã thanh toán. Đơn hàng của bạn đã được xác nhận.</p>
    <a href="{{ url('/') }}">Quay lại trang chủ</a>
@endsection
