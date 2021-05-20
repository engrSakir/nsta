@push('title')
    ড্যাশবোর্ড
@endpush
@extends('layouts.backend.app')
@push('style')

@endpush
@section('breadcrumb')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">ম্যানেজার ড্যাশবোর্ড</h4>
        </div>
        <div class="col-md-7 align-self-center text-right">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{ url('/') }}" target="_blank" type="button" class="btn btn-info d-none d-lg-block m-l-15">
                    <i class="mdi mdi-checkbox-multiple-marked-circle"></i> ওয়েবসাইট </a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <!-- Column 1-->
        @foreach($invoices->groupBy('to_branch_id') as $invoice_group => $invoice_items)
            <div class="col-md-6 col-lg-4 col-xlg-2">
                <a href="{{ route('manager.invoice.statusAndBranchConstant', [\Illuminate\Support\Str::slug('All', ' ', '-'), $invoice_group]) }}">
                    <div class="card">
                        <div class="box @if($loop->odd) bg-info @else bg-success @endif text-center">
                            <h4 class="font-light text-white font-weight-bold"> {{ \App\Models\Branch::find($invoice_group)->name }}</h4>
                            <h6 class="text-white"> ভাউচার: {{ $invoice_items->count() }} </h6>
                            <h6 class="text-white">
                                মূল্য : {{ $invoice_items->sum('price') + $invoice_items->sum('home') + $invoice_items->sum('labour') }}
                                <br>
                                বাকি : {{ $invoice_items->sum('price') + $invoice_items->sum('home') + $invoice_items->sum('labour') - $invoice_items->sum('paid') }}
                                <br>
                                পরিশোধিত : {{ $invoice_items->sum('paid') }}
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
@push('script')

@endpush
