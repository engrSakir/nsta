<li>
    <a class="waves-effect waves-dark" href="{{ route('admin.dashboard') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Dashboard</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('admin.manager.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Manager</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('admin.branch.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Branch</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('admin.company.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Company</span>
    </a>
</li>
{{-- <li style="display:none;">
    <a class="waves-effect waves-dark" href="{{ route('admin.package') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Package</span>
    </a>
</li> --}}

{{--Super access--}}

<hr class="bg-white">
<li>
    <a class="waves-effect waves-dark" href="{{ route('admin.banner') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Banner</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('admin.about') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">About</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('admin.subscriber.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Subscriber</span>
    </a>
</li>
<li>
    <a class="waves-effect waves-dark" href="{{ route('admin.websiteMessage.index') }}">
        <i class="far fa-circle text-success"></i><span class="hide-menu">Messages<span  class="badge badge-warning">{{ count_of_website_incomplete_messages() }}</span></span>
    </a>
</li>

<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Partner</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.partner.index') }}">Partner list </a></li>
        <li><a href="{{ route('admin.partner.create') }}">Partner create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Home content</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.homeContent.index') }}">List view</a></li>
        <li><a href="{{ route('admin.homeContent.create') }}">Create new</a></li>
        <li><a href="{{ route('admin.homeContentFaq.index') }}">Q/A list</a></li>
        <li><a href="{{ route('admin.homeContentFaq.create') }}">Create Q/A</a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Strength</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.strength') }}">Strength </a></li>
        <li><a href="{{ route('admin.strength.index') }}">Strength list </a></li>
        <li><a href="{{ route('admin.strength.create') }}">Strength create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Service</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.service') }}">Service </a></li>
        <li><a href="{{ route('admin.service.index') }}">Service list </a></li>
        <li><a href="{{ route('admin.service.create') }}">Service create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Call to action</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.callToAction.index') }}">Call to action list </a></li>
        <li><a href="{{ route('admin.callToAction.create') }}">Call to action create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Portfolio</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.portfolio') }}">Portfolio </a></li>
        <li><a href="{{ route('admin.portfolio.index') }}">Portfolio list </a></li>
        <li><a href="{{ route('admin.portfolio.create') }}">Portfolio create </a></li>
        <li><a href="{{ route('admin.portfolioCategory.index') }}">Category list </a></li>
        <li><a href="{{ route('admin.portfolioCategory.create') }}">Category create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Team</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.team') }}">Team </a></li>
        <li><a href="{{ route('admin.team.index') }}">Team list </a></li>
        <li><a href="{{ route('admin.team.create') }}">Team create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Price</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.price') }}">Price </a></li>
        <li><a href="{{ route('admin.price.index') }}">Price list </a></li>
        <li><a href="{{ route('admin.price.create') }}">Price create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Faq</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.faq') }}">Faq </a></li>
        <li><a href="{{ route('admin.faq.index') }}">Faq list </a></li>
        <li><a href="{{ route('admin.faq.create') }}">Faq create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Blog</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.blog.index') }}">Blog list </a></li>
        <li><a href="{{ route('admin.blog.create') }}">Blog create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Testimonial</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.testimonial.index') }}">Testimonial list </a></li>
        <li><a href="{{ route('admin.testimonial.create') }}">Testimonial create </a></li>
    </ul>
</li>
<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Gallery</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.gallery.index') }}">Gallery list </a></li>
        <li><a href="{{ route('admin.gallery.create') }}">Gallery create </a></li>
    </ul>
</li>

<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Custom page</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.customPage.index') }}">Custom page List </a></li>
        <li><a href="{{ route('admin.customPage.create') }}">Custom page create </a></li>
    </ul>
</li>

<li><a href="javascript:void(0)" class="has-arrow"> <i class="far fa-circle text-success"></i>Subscriber</a>
    <ul aria-expanded="false" class="collapse">
        <li><a href="{{ route('admin.subscriber.index') }}">Subscriber List </a></li>
        <li><a href="{{ route('admin.subscriberEmail') }}">Mail to Subscriber </a></li>
    </ul>
</li>

{{--Super access--}}
