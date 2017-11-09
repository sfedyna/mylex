@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Test Assignment</div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="voucher-box">
                            @if (\Session::has('msg-success'))
                                <div class="alert alert-success">
                                    {{ \Session::get('msg-success') }}
                                </div>
                            @endif
                            @if (\Session::has('msg-error'))
                                <div class="alert alert-danger">
                                    {{ \Session::get('msg-error') }}
                                </div>
                            @endif
                            @if (count($companies) > 0)
                            <div class="row">
                                @foreach ($companies as $company)
                                <div class="col-sm-4">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            #{{ $company->getId() }} {{ $company->getName() }}
                                        </div>
                                        <div class="panel-body">
                                            <h3>Voucher Info</h3>
                                            <div>
                                                <strong>Duration</strong> : {{ $company->getVoucherDuration() }}
                                            </div>
                                            <div>
                                                <strong>Percent off</strong> : {{ $company->getVoucherPercentOff() }}
                                            </div>
                                            <div>
                                                <strong>Currency</strong> : {{ $company->getVoucherCurrency() }}
                                            </div>
                                            <div align="center">
                                                <br>
                                                <form method="POST" action="{{ URL::route('voucher.generate') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $company->getId() }}">
                                                    <button type="submit" class="btn btn-primary btn-md">
                                                        Apply
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                            </div>
                            @endif
                            <button type="button" class="btn btn-primary btn-md" data-toggle="modal"
                                    data-target="#refer-model"> Refer a client
                            </button>
                        </div>

                        @include('popup.invite-client')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection