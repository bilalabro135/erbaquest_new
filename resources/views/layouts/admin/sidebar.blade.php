        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin') }}">
                <img src="{{asset('images/admin_logo.png')}}">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ ($globalsettings->getValue( 'site_name')) ? $globalsettings->getValue('site_name') : config('app.name', 'Laravel') }}</div> -->
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item {{(request()->is('admin')) ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            @can ('allowNotifications')
            <div class="sidebar-heading">
                Notification 
            </div>
                <li class="nav-item {{(request()->is('admin/notification') || request()->is('admin/notification/*')) ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('notification') }}">
                        <i class="fas fa-bell"></i>
                        <span>Send Notification</span></a>
                </li> 
            <hr class="sidebar-divider">

            @endcan
            @if ( Bouncer::can('viewBlogs') || Bouncer::can('addBlogs') || Bouncer::can('viewCategories') || Bouncer::can('addCategories') )
                <div class="sidebar-heading">
                    Media & Categories
                </div>
                @if (Bouncer::can('viewBlogs') || Bouncer::can('addBlogs'))
                <li class="nav-item {{(request()->is('admin/blogs/*') || request()->is('admin/blogs') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/blogs/*') || request()->is('admin/blogs') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#blogs"
                        aria-expanded="true" aria-controls="Media">
                        <i class="fas fa-sticky-note"></i>
                        <span>Media</span>
                    </a>
                    <div id="blogs" class="collapse {{(request()->is('admin/blogs/*') || request()->is('admin/blogs') ) ? 'show' : ''}}" aria-labelledby="All Blogs" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewBlogs')
                            <a class="collapse-item text-light" href="{{route('blogs')}}">All Media</a>
                            @endcan
                            @can('addBlogs')
                            <a class="collapse-item text-light" href="{{route('blogs.add')}}">Add Media</a>
                            @endcan
                            <a class="collapse-item text-light" href="{{route('categories')}}">All Categories</a>
                        </div>
                    </div>
                </li>
                @endif

                
                <hr class="sidebar-divider">
            @endif

            <div class="sidebar-heading">
                Podcasts & Categories
            </div>
            
            <li class="nav-item {{(request()->is('admin/podcasts/*') || request()->is('admin/podcasts') ) ? 'active' : ''}}">
                <a class="nav-link {{(request()->is('admin/podcasts/*') || request()->is('admin/podcasts') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#podcasts"
                    aria-expanded="true" aria-controls="Media">
                    <i class="fas fa-sticky-note"></i>
                    <span>Podcast</span>
                </a>
                <div id="podcasts" class="collapse {{(request()->is('admin/podcasts/*') || request()->is('admin/podcasts') ) ? 'show' : ''}}" aria-labelledby="All Podcasts" data-parent="#accordionSidebar">
                    <div class="bg-primary py-2 collapse-inner rounded">
                        <a class="collapse-item text-light" href="{{route('podcasts')}}">All Podcasts</a>
                        <a class="collapse-item text-light" href="{{route('podcasts.add')}}">Add Podcasts</a>
                        <!-- <a class="collapse-item text-light" href="{{route('podcast.categories')}}">All Categories</a> -->
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">


             @if (Bouncer::can('viewAreas') || Bouncer::can('addAreas'))
            <div class="sidebar-heading">
                Areas 
            </div>
                <li class="nav-item {{(request()->is('admin/areas') || request()->is('admin/areas/*')) ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('areas') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Areas</span></a>
                </li> 
            <hr class="sidebar-divider">

            @endif

            @if (Bouncer::can('viewAmenities') || Bouncer::can('addAmenities'))
            <div class="sidebar-heading">
                Amenities 
            </div>
                <li class="nav-item {{(request()->is('admin/amenities') || request()->is('admin/amenities/*')) ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('amenities') }}">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Amenities</span></a>
                </li> 
            <hr class="sidebar-divider">

            @endif


            @if ( Bouncer::can('viewPackages') || Bouncer::can('addPackages') )
                <div class="sidebar-heading">
                    packages
                </div>
                <li class="nav-item {{(request()->is('admin/packages/*') || request()->is('admin/packages') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/packages/*') || request()->is('admin/packages') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#packages"
                        aria-expanded="true" aria-controls="packages">
                        <i class="fas fa-file"></i>
                        <span>Packages</span>
                    </a>
                    <div id="packages" class="collapse {{(request()->is('admin/packages/*') || request()->is('admin/packages') ) ? 'show' : ''}}" aria-labelledby="All packages" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewPackages')
                            <a class="collapse-item text-light" href="{{route('packages')}}">All Packages</a>
                            @endcan
                            @can('addPackages')
                            <a class="collapse-item text-light" href="{{route('packages.add')}}">Add Package</a>
                            @endcan
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
            @endif

            @if ( Bouncer::can('viewSponsors') || Bouncer::can('addSponsors') )
                <div class="sidebar-heading">
                    Sponsors
                </div>
                <li class="nav-item {{(request()->is('admin/sponsors/*') || request()->is('admin/sponsors') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/sponsors/*') || request()->is('admin/sponsors') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#sponsors"
                        aria-expanded="true" aria-controls="sponsors">
                        <i class="fas fa-file"></i>
                        <span>Sponsors</span>
                    </a>
                    <div id="sponsors" class="collapse {{(request()->is('admin/sponsors/*') || request()->is('admin/sponsors') ) ? 'show' : ''}}" aria-labelledby="All sponsors" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewSponsors')
                            <a class="collapse-item text-light" href="{{route('sponsors')}}">All Sponsors</a>
                            @endcan
                            @can('addSponsors')
                            <a class="collapse-item text-light" href="{{route('sponsors.add')}}">Add Sponsor</a>
                            @endcan
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
            @endif

            @if ( Bouncer::can('viewEvents') || Bouncer::can('addEvents') )
                <div class="sidebar-heading">
                    Events
                </div>
                <li class="nav-item {{(request()->is('admin/events/*') || request()->is('admin/events') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/events/*') || request()->is('admin/events') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#events"
                        aria-expanded="true" aria-controls="events">
                        <i class="fas fa-file"></i>
                        <span>Events</span>
                    </a>
                    <div id="events" class="collapse {{(request()->is('admin/events/*') || request()->is('admin/events') ) ? 'show' : ''}}" aria-labelledby="All events" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewEvents')
                            <a class="collapse-item text-light" href="{{route('events')}}">All Events</a>
                            @endcan
                            @can('addEvents')
                            <a class="collapse-item text-light" href="{{route('events.add')}}">Add Event</a>
                            @endcan
                            <a class="collapse-item text-light" href="{{route('event.type')}}">Type of Event</a>
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
            @endif


            <div class="sidebar-heading">
                Newletters
            </div>
            <li class="nav-item {{(request()->is('admin/newsletter/*') || request()->is('admin/newsletter') ) ? 'active' : ''}}">
                <a class="nav-link {{(request()->is('admin/newsletter/*') || request()->is('admin/newsletter') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#newsletters"
                    aria-expanded="true" aria-controls="events">
                    <i class="fas fa-file"></i>
                    <span>Newsletter</span>
                </a>
                <div id="newsletters" class="collapse {{(request()->is('admin/newsletter/*') || request()->is('admin/newsletter') ) ? 'show' : ''}}" aria-labelledby="All newsletters" data-parent="#accordionSidebar">
                    <div class="bg-primary py-2 collapse-inner rounded">
                        <a class="collapse-item text-light" href="{{route('newsletter')}}">All Newsletter</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Payments
            </div>
            <li class="nav-item {{(request()->is('admin/payment/*') || request()->is('admin/payment') ) ? 'active' : ''}}">
                <a class="nav-link {{(request()->is('admin/payment/*') || request()->is('admin/payment') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#payment"
                    aria-expanded="true" aria-controls="events">
                    <i class="fas fa-file"></i>
                    <span>Payments</span>
                </a>
                <div id="payment" class="collapse {{(request()->is('admin/payment/*') || request()->is('admin/payment') ) ? 'show' : ''}}" aria-labelledby="All payment" data-parent="#accordionSidebar">
                    <div class="bg-primary py-2 collapse-inner rounded">
                        <a class="collapse-item text-light" href="{{route('admin.payment')}}">All Payments</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Vendors
            </div>
            <li class="nav-item {{(request()->is('admin/payment/*') || request()->is('admin/payment') ) ? 'active' : ''}}">
                <a class="nav-link {{(request()->is('admin/payment/*') || request()->is('admin/payment') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#vendor"
                    aria-expanded="true" aria-controls="events">
                    <i class="fas fa-file"></i>
                    <span>Vendors</span>
                </a>
                <div id="vendor" class="collapse {{(request()->is('admin/vendor/*') || request()->is('admin/payment') ) ? 'show' : ''}}" aria-labelledby="All payment" data-parent="#accordionSidebar">
                    <div class="bg-primary py-2 collapse-inner rounded">
                        <a class="collapse-item text-light" href="{{route('admin.vendor')}}">All Vendors</a>
                        <a class="collapse-item text-light" href="{{route('admin.vendor.categories')}}">Vendor Category</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                Contact
            </div>
            <li class="nav-item {{(request()->is('admin/contact/*') || request()->is('admin/contact') ) ? 'active' : ''}}">
                <a class="nav-link {{(request()->is('admin/contact/*') || request()->is('admin/contact') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#contact"
                    aria-expanded="true" aria-controls="events">
                    <i class="fas fa-file"></i>
                    <span>Contact</span>
                </a>
                <div id="contact" class="collapse {{(request()->is('admin/contact/*') || request()->is('admin/contact') ) ? 'show' : ''}}" aria-labelledby="All contact" data-parent="#accordionSidebar">
                    <div class="bg-primary py-2 collapse-inner rounded">
                        <a class="collapse-item text-light" href="{{route('admin.contact')}}">All Contact</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider">



            @if ( Bouncer::can('viewPages') || Bouncer::can('addPages') || Bouncer::can('editPageComponents') )
                <div class="sidebar-heading">
                    Pages
                </div>
                @if ( Bouncer::can('viewPages') || Bouncer::can('addPages') )
                <li class="nav-item {{(request()->is('admin/pages/*') || request()->is('admin/pages') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/pages/*') || request()->is('admin/pages') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#pages"
                        aria-expanded="true" aria-controls="pages">
                        <i class="fas fa-file"></i>
                        <span>Pages</span>
                    </a>
                    <div id="pages" class="collapse {{(request()->is('admin/pages/*') || request()->is('admin/pages') ) ? 'show' : ''}}" aria-labelledby="All Pages" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewPages')
                            <a class="collapse-item text-light" href="{{route('pages')}}">All Pages</a>
                            @endcan
                            @can('addPages')
                            <a class="collapse-item text-light" href="{{route('pages.add')}}">Add Page</a>
                            @endcan
                        </div>
                    </div>
                </li>
                @endif
                @can ('editPageComponents')
                    <li class="nav-item {{(request()->is('admin/components') || request()->is('admin/components/*')) ? 'active' : ''}}">
                        <a class="nav-link" href="{{ route('components', ['type' => 'home-banner']) }}">
                            <i class="fas fa-file"></i>
                            <span>Components</span></a>
                    </li> 
                @endcan
                <hr class="sidebar-divider">
            @endif
            @if ( Bouncer::can('viewMenus') )
                <div class="sidebar-heading">
                    Menus
                </div>


                <li class="nav-item {{(request()->is('admin/menus/*') || request()->is('admin/menus') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/menus/*') || request()->is('admin/menus') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#menus"
                        aria-expanded="true" aria-controls="menus">
                        <i class="fas fa-bars"></i>
                        <span>Menus</span>
                    </a>
                    <div id="menus" class="collapse {{(request()->is('admin/menus/*') || request()->is('admin/menus') ) ? 'show' : ''}}" aria-labelledby="All Menus" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewMenus')
                                @foreach(config('settings.menus') as $menu_name => $menu)
                                    <a class="collapse-item text-light" href="{{route('menus', ['type' => $menu])}}">{{$menu_name}}</a>
                                @endforeach
                            @endcan
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider">
            @endif

             @if (Bouncer::can('viewUsers') || Bouncer::can('addUsers') || Bouncer::can('viewRoles') || Bouncer::can('addRoles') )
                <div class="sidebar-heading">
                    Users & Roles
                </div>
                 @if (Bouncer::can('viewUsers') || Bouncer::can('addUsers') )
                <li class="nav-item {{(request()->is('admin/users/*') || request()->is('admin/users') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/users/*') || request()->is('admin/users') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#users"
                        aria-expanded="true" aria-controls="users">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <div id="users" class="collapse {{(request()->is('admin/users/*') || request()->is('admin/users') ) ? 'show' : ''}}" aria-labelledby="All Users" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewUsers')
                            <a class="collapse-item text-light" href="{{route('users')}}">All Users</a>
                            @endcan
                            @can('addUsers')
                            <a class="collapse-item text-light" href="{{route('users.add')}}">Add User</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endif
            @if ( Bouncer::can('viewRoles') || Bouncer::can('addRoles') )
                <li class="nav-item {{(request()->is('admin/roles/*') || request()->is('admin/roles') ) ? 'active' : ''}}">
                    <a class="nav-link {{(request()->is('admin/roles/*') || request()->is('admin/roles') ) ? '' : 'collapsed'}} " href="#" data-toggle="collapse" data-target="#roles"
                        aria-expanded="true" aria-controls="roles">
                        <i class="fas fa-users"></i>
                        <span>Roles</span>
                    </a>
                    <div id="roles" class="collapse {{(request()->is('admin/roles/*') || request()->is('admin/roles') ) ? 'show' : ''}}" aria-labelledby="All Roles" data-parent="#accordionSidebar">
                        <div class="bg-primary py-2 collapse-inner rounded">
                            @can('viewRoles')
                            <a class="collapse-item text-light" href="{{route('roles')}}">All Roles</a>
                            @endcan
                            @can('addRoles')
                            <a class="collapse-item text-light" href="{{route('roles.add')}}">Add Role</a>
                            @endcan
                        </div>
                    </div>
                </li>
            @endif
            <hr class="sidebar-divider">
            @endif

            @can('accessSettings')
                <div class="sidebar-heading">
                    Site Settings
                </div>
                <li class="nav-item {{(request()->is('admin/settings')) ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('settings', ['type' => 'general']) }}">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Settings</span></a>
                </li><!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">
            @endcan


            

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>