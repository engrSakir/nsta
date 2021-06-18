@push('title')
    সার্চ
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor font-weight-bold">সার্চ</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('manager.dashboard') }}">ড্যাশবোর্ড</a></li>
                    <li class="breadcrumb-item active">সার্চ</li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">এডভান্স সার্চ করতে পছন্দ অনুযায়ী নিচের ফর্ম ফিলাপ করুন</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('manager.advanceSearchSubmit') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row p-t-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">শুরু তারিখ</label>
                                        <input type="date" id="" name="starting_date" class="form-control" value="{{ old('starting_date') }}">
                                        @error('starting_date')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">শেষ তারিখ</label>
                                        <input type="date" id="" name="ending_date" class="form-control" value="{{ old('ending_date') }}">
                                        @error('ending_date')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">প্রেরকের নাম</label>
                                        <input type="text" id="" name="prerok_name" class="form-control" value="{{ old('prerok_name') }}">
                                        @error('prerok_name')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">প্রেরকের ফোন নাম্বার</label>
                                        <input type="text" name="prerok_phone" class="form-control" value="{{ old('prerok_phone') }}">
                                        @error('prerok_phone')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">প্রাপকের নাম</label>
                                        <input type="text" name="prapok_name" class="form-control" value="{{ old('prapok_name') }}">
                                        @error('prapok_name')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">প্রাপকের ফোন নাম্বার</label>
                                        <input type="text" name="prapok_phone" class="form-control" value="{{ old('prapok_phone') }}">
                                        @error('prapok_phone')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">ভাউচার নাম্বার</label>
                                        <input type="text" name="invoice_number" class="form-control" value="{{ old('invoice_number') }}">
                                        @error('invoice_number')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">ব্রাঞ্চ অফিস পছন্দ করুন</label>
                                        <select name="branch_office" class="form-control custom-select">
                                            <option value="" selected disabled>Select one</option>
                                            @foreach(auth()->user()->branch->fromLinkedBranchs as $linked)
                                            <option @if(old('branch_office') == $linked->toBranch->id) selected @endif value="{{ $linked->toBranch->id }}">{{ $linked->toBranch->name ?? '#' }}</option>
                                            @endforeach
                                        </select>
                                        @error('branch_office')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions text-center">
                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> --সার্চ--</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($invoices)
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {{--                    <h4 class="card-title">ভাউচার লিস্ট</h4>--}}
                        {{--                    <h6 class="card-subtitle">Add class <code>.color-bordered-table .primary-bordered-table</code></h6>--}}
                        {{ $invoices->links() }}
                        <div class="invoice-table table-responsive">
                            <table class="table color-bordered-table primary-bordered-table text-center">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>নাম</th>
                                    <th>ফোন</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->custom_counter }}</td>
                                        <td>{{ $invoice->sender_name }}</td>
                                    </tr>
                                @endforeach
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>নাম</th>
                                    <th>ফোন</th>
                                </tr>
                                </thead>
                                </tbody>
                            </table>
                        </div>
                        {{ $invoices->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('script')

@endpush
@push('summer-note')

@endpush
