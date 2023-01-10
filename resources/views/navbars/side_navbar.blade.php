<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto text-center">
                    <a class="navbar-brand" >
                        <div class="brand-logo" style="width:60px">
                            <img src="../../../app-assets/images/logo/Dataflow_logo_part1.png" style="width:100%">
                        </div>
                        <div class="brand-text" style="width:140px;margin-left:-12px">
                        <img src="../../../app-assets/images/logo/Dataflow_logo_part2.png" style="width:110%">
                        </div>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="nav-item" id="view_dashboard"><a href="/dashboard"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                </li>
                @if(CheckPermission('view_invoices') || CheckPermission('view_orders') || CheckPermission('view_desadv'))
                <li class="nav-item" id="view_flux"><a><i class="feather icon-grid"></i><span class="menu-title" data-i18n="Flux">Flux</span></a>
                    <ul class="menu-content">
                        @if(CheckPermission('view_invoices'))
                            <li id="view_invoices"><a href="/flux/invoices"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Invoices">Invoices</span></a></li>
                        @endif
                        @if(CheckPermission('view_orders'))
                            <li id="view_orders"><a href="/flux/orders"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Orders">Orders</span></a></li>
                        @endif
                        @if(CheckPermission('view_desadv'))
                            <li id="view_desadv"><a href="/flux/desadv"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Desadv">Desadv</span></a></li>
                        @endif    
                    </ul>
                </li>
                @endif
                <!-- @if(CheckPermission('view_demat_invoice'))
                    <li class="nav-item" id="view_demat_invoice"><a href="/demat/invoice"><i class="feather icon-share-2"></i><span class="menu-title" data-i18n="demat-invoice">Demat Invoice</span></a></li>
                @endif -->
                @if(CheckPermission('view_partners') || CheckPermission('view_societies') || CheckPermission('view_main_company'))
                <li class="nav-item" id="view_societies"><a><i class="feather icon-globe"></i><span class="menu-title" data-i18n="Clients">Clients</span></a>
                    <ul class="menu-content">
                        @if(CheckPermission('view_main_company'))
                            <li id="siege_nav"><a href="/MainCompany"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="MainCompany">Head office</span></a></li>
                        @endif
                        @if(CheckPermission('view_societies'))
                            <li id="companies_nav"><a href="/societies"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Company">Companies</span></a></li>
                        @endif
                        @if(CheckPermission('view_partners'))
                            <li id="partners_nav"><a href="/partners"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Partner">Partners</span></a></li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(CheckPermission('view_users'))
                    <li class="nav-item" id="view_users"><a href="/users"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Users">Users</span></a></li>
                @endif

                @if(CheckPermission('view_permissions'))
                    <li class="nav-item" id="view_permissions"><a href=""><i class="feather icon-unlock"></i><span class="menu-title" data-i18n="Permissions">Permissions</span></a>
                        <ul class="menu-content">
                            <li id="permissions_nav"><a href="/permissions"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Roles" title="Roles">Roles and Permissions</span></a>
                            </li>
                            <li id="acces_nav"><a href="/acces"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="Access">Users access</span></a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(CheckPermission('view_logs'))
                    <li class="nav-item" id="view_logs"><a href="/logs"><i class="feather icon-file-text"></i><span class="menu-title" data-i18n="Logs">Logs</span></a></li>
                @endif
                <li class="navigation-header"><span>Support</span></li>
                @if(CheckPermission('view_configuration'))
                    <li class="nav-item" id="view_configuration"><a href="/configurations"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Configurations">Configurations</span></a></li>
                @endif
                <li class="nav-item"><a href="/support"><i class="feather icon-life-buoy"></i><span class="menu-title" data-i18n="Support">Support</span></a></li>
            </ul>
        </div>
    </div>