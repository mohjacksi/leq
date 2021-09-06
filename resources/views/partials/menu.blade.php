<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.home') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-clipboard"></i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/permissions*') ? 'c-show' : '' }} {{ request()->is('admin/roles*') ? 'c-show' : '' }} {{ request()->is('admin/users*') ? 'c-show' : '' }} {{ request()->is('admin/audit-logs*') ? 'c-show' : '' }} {{ request()->is('admin/user-types*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw far fa-user-circle c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access!')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.permissions.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access!')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access!')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.audit-logs.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/audit-logs') || request()->is('admin/audit-logs/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_type_access!')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.user-types.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/user-types') || request()->is('admin/user-types/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userType.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('dagrtnapezanina_access')
            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/layenetsiyasis*') ? 'c-show' : '' }} {{ request()->is('admin/leqs*') ? 'c-show' : '' }} {{ request()->is('admin/lijnas*') ? 'c-show' : '' }} {{ request()->is('admin/rekxraws*') ? 'c-show' : '' }} {{ request()->is('admin/bingehs*') ? 'c-show' : '' }} {{ request()->is('admin/westgehs*') ? 'c-show' : '' }} {{ request()->is('admin/kandids*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.dagrtnapezanina.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('layenetsiyasi_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.layenetsiyasis.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/layenetsiyasis') || request()->is('admin/layenetsiyasis/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fab fa-font-awesome-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.layenetsiyasi.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('leq_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.leqs.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/leqs') || request()->is('admin/leqs/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-archway c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.leq.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('lijna_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.lijnas.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/lijnas') || request()->is('admin/lijnas/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.lijna.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('rekxraw_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.rekxraws.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/rekxraws') || request()->is('admin/rekxraws/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-calendar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.rekxraw.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bingeh_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.bingehs.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/bingehs') || request()->is('admin/bingehs/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-school c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bingeh.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('westgeh_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.westgehs.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/westgehs') || request()->is('admin/westgehs/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-box-open c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.westgeh.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('kandid_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.kandids.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/kandids') || request()->is('admin/kandids/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-user-check c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.kandid.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('time_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.times.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/times') || request()->is('admin/times/*') ? 'c-active' : '' }}">
                                <i class="fa-fw far fa-clock c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.time.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('daxlkrna_dengan_access')
            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/dengen-layenetsiyasis*') ? 'c-show' : '' }} {{ request()->is('admin/daxlkrna-dengen-kandidas*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-archive c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.daxlkrnaDengan.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('dengen_layenetsiyasi_access!!')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.dengen-layenetsiyasis.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/dengen-layenetsiyasis') || request()->is('admin/dengen-layenetsiyasis/*') ? 'c-active' : '' }}">
                                <i class="fa-fw far fa-flag c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.dengenLayenetsiyasi.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('daxlkrna_dengen_kandida_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.daxlkrna-dengen-kandidas.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/daxlkrna-dengen-kandidas') || request()->is('admin/daxlkrna-dengen-kandidas/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-user-plus c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.daxlkrnaDengenKandida.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('daxlkrnarejabeshdarboyan_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is('admin/reja-beshdarboyans*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-walking c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.daxlkrnarejabeshdarboyan.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('reja_beshdarboyan_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.reja-beshdarboyans.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/reja-beshdarboyans') || request()->is('admin/reja-beshdarboyans/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-walking c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.rejaBeshdarboyan.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('hnartn_access')
            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/hnartna-dengans*') ? 'c-show' : '' }} {{ request()->is('admin/hnartna-reja-beshdarboyans*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-share-square c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.hnartn.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('hnartna_dengan_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.hnartna-dengans.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/hnartna-dengans') || request()->is('admin/hnartna-dengans/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-share-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.hnartnaDengan.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('hnartna_reja_beshdarboyan_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.hnartna-reja-beshdarboyans.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/hnartna-reja-beshdarboyans') || request()->is('admin/hnartna-reja-beshdarboyans/*') ? 'c-active' : '' }}">
                                <i class="fa-fw far fa-share-square c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.hnartnaRejaBeshdarboyan.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('encamen_destpeke_access!!!')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.encamen-destpekes.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/encamen-destpekes') || request()->is('admin/encamen-destpekes/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-hotel c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.encamenDestpeke.title') }}
                </a>
            </li>
        @endcan
        @can('derencamen_destpeke_access!!!')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.derencamen-destpekes.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/derencamen-destpekes') || request()->is('admin/derencamen-destpekes/*') ? 'c-active' : '' }}">
                    <i class="fa-fw far fa-flag c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.derencamenDestpeke.title') }}
                </a>
            </li>
        @endcan
        @can('derencamen_destpeke_bngeh_access!!!')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.derencamen-destpeke-bngehs.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/derencamen-destpeke-bngehs') || request()->is('admin/derencamen-destpeke-bngehs/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-hospital-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.derencamenDestpekeBngeh.title') }}
                </a>
            </li>
        @endcan
        @can('derencamen_destpekewistgeh_access!!!')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.derencamen-destpekewistgehs.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/derencamen-destpekewistgehs') || request()->is('admin/derencamen-destpekewistgehs/*') ? 'c-active' : '' }}">
                    <i class="fa-fw far fa-hospital c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.derencamenDestpekewistgeh.title') }}
                </a>
            </li>
        @endcan
        @can('derencamen_rejabeshdarboyan_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.derencamen-rejabeshdarboyans.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/derencamen-rejabeshdarboyans') || request()->is('admin/derencamen-rejabeshdarboyans/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-walking c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.derencamenRejabeshdarboyan.title') }}
                </a>
            </li>
        @endcan
        @can('web_site_view_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.web-site-views.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/web-site-views') || request()->is('admin/web-site-views/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-sitemap c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.webSiteView.title') }}
                </a>
            </li>
        @endcan
        @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}"
                        href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
