<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.dashboard') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">ড্যাশবোর্ড</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.conditionInvoice.create') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">কন্ডিশন তৈরি</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.create') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">ভাউচার তৈরি</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.conditionInvoice.get') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">সকল কন্ডিশন</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">সকল ভাউচার</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.statusConstant', 'received') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">রিসিভ ভাউচার</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.statusConstant', 'on-going') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">গাড়িতে ভাউচার</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.statusConstant', 'delivered') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">ডেলিভারি ভাউচার</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.chalan.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">চালান সমূহ</span>
    </a>
</li>
