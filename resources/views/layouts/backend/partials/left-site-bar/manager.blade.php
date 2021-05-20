<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.dashboard') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Dashboard</span>
    </a>
</li>

<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.create') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Create Invoice</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">All Invoice</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.statusConstant', 'received') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Received Invoices</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.statusConstant', 'on-going') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">On Going Invoices</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.invoice.statusConstant', 'delivered') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Delivered Invoices</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('manager.chalan.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Chalan</span>
    </a>
</li>
