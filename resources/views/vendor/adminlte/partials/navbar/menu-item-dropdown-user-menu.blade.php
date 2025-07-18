@php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )
@php( $profile_url = View::getSection('profile_url') ?? config('adminlte.profile_url', 'logout') )

@if (config('adminlte.usermenu_profile_url', false))
    @php( $profile_url = Auth::user()->adminlte_profile_url() )
@endif

@if (config('adminlte.use_route_url', false))
    @php( $profile_url = $profile_url ? route($profile_url) : '' )
    @php( $logout_url = $logout_url ? route($logout_url) : '' )
@else
    @php( $profile_url = $profile_url ? url($profile_url) : '' )
    @php( $logout_url = $logout_url ? url($logout_url) : '' )
@endif


<li class="nav-item dropdown user-menu">
    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <span class="d-none d-md-inline" >
            <div class="default_image d-flex align-items-center">
                <label style="margin-left:-90px;padding: 5px; font-family: 'Circular-Loom';">SELECT YEAR:</label>
                <input style="width: 100px;" type="text" class="filter_form" id="search-year1" name="search-year" value="{{ Session::get('years_data') ? Session::get('years_data') : '2023' }}">
            </div>
        </span>
    </a>
</li>

@if(auth()->user()->role_id==1)
<li class="nav-item dropdown user-menu mt-2">
    {{-- User menu toggler --}}

        <span class="d-none d-md-inline" >
            <div class="default_image align-items-center">
               <a class="btn btn-default"
               href="{{ route('superadmin.changepassword')}}" >
                Change Password
            </a>
            </div>
        </span>
   
</li>
@endif



<li class="nav-item dropdown user-menu">
    {{-- User menu toggler --}}
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        @if(config('adminlte.usermenu_image'))
            <img src="{{ Auth::user()->adminlte_image() }}"
                 class="user-image img-circle elevation-2"
                 alt="{{ Auth::user()->first_name }}">
        @endif
        <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
            <div class="default_image d-flex align-items-center">
                <svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1530_2049)">
                    <path d="M32.051 13.2538C38.2484 13.2663 43.2743 18.3422 43.2518 24.5688C43.2293 30.7179 38.1959 35.7437 32.0485 35.7562C25.8411 35.7663 20.7827 30.7154 20.7827 24.5038C20.7827 18.2922 25.8411 13.2413 32.051 13.2538V13.2538Z" fill="#F7F9FA"/>
                    <path d="M54.0779 12.3332C53.5359 11.7403 53.7332 11.1424 54.0929 10.5495C54.7698 10.1842 55.4268 10.0617 55.9714 10.7671C56.4834 11.4276 56.2062 12.0079 55.7416 12.5558C55.142 12.826 54.565 12.8635 54.0779 12.3332V12.3332Z" fill="#F7F9FA"/>
                    <path d="M40.809 62.7792C22.6464 67.8451 4.42133 56.6727 0.634439 38.1604C-2.94263 20.6588 9.00507 3.35976 26.713 0.462841C35.6432 -0.995628 43.7716 1.0057 51.108 6.30922C51.8699 6.86209 52.2671 7.4725 51.9523 8.41562C51.1055 9.24867 50.3761 8.90344 49.5468 8.29804C38.4859 0.225182 23.9803 0.592928 13.374 9.18613C-0.257329 20.231 -1.12911 41.1048 11.538 53.2179C11.7903 53.463 12.0576 53.6957 12.4073 54.0134C12.4298 54.0134 12.4497 54.0059 12.4697 53.9984C13.6088 49.3328 15.9194 45.5128 19.6089 42.5933C23.2934 39.6814 27.5049 38.2379 32.201 38.2604C41.3036 38.3055 47.6684 43.4414 51.6601 54.0009C56.2938 49.8131 59.3563 44.7322 60.7202 38.6732C62.4163 31.1282 61.3396 23.9584 57.5103 17.234C56.9133 16.1883 56.8333 15.3827 58.0149 14.7648C58.8966 14.7448 59.3188 15.3252 59.716 16.0032C70.1349 33.82 60.6727 57.2405 40.809 62.7792V62.7792Z" fill="#F7F9FA"/>
                    <path d="M32.051 13.2538C38.2484 13.2663 43.2743 18.3422 43.2518 24.5688C43.2293 30.7179 38.1959 35.7437 32.0485 35.7562C25.8411 35.7663 20.7827 30.7154 20.7827 24.5038C20.7827 18.2922 25.8411 13.2413 32.051 13.2538V13.2538Z" fill="#EBF1F2"/>
                    <path d="M11.538 53.2179C11.7903 53.4631 12.0576 53.6957 12.4073 54.0134C12.1425 54.061 11.8053 53.8358 11.2957 53.368C9.722 51.9245 8.35312 50.3085 7.1616 48.5373C-0.632008 36.9521 0.919219 21.0715 10.7437 11.1725C17.1034 4.76822 24.7996 1.78624 33.7398 2.20152C39.3327 2.46169 44.516 4.22286 49.0822 7.57008C49.954 8.20801 50.8433 8.6508 51.9524 8.41564C51.1056 9.2487 50.3762 8.90347 49.5468 8.29807C38.4859 0.225205 23.9803 0.592951 13.374 9.18616C-0.257315 20.231 -1.1291 41.1048 11.538 53.2179Z" fill="#EBF1F2"/>
                    <path d="M54.0779 12.3332C53.5359 11.7404 53.7332 11.1425 54.0929 10.5496C54.1628 11.6236 54.7124 12.2924 55.7416 12.5559C55.142 12.8261 54.565 12.8636 54.0779 12.3332Z" fill="#EBF1F2"/>
                    <path d="M55.1697 50.8312C54.4403 51.7994 53.531 52.6074 52.6568 53.438C51.6901 54.3561 51.3478 54.2885 50.9507 53.0352C50.2787 50.9163 49.4019 48.9225 48.143 47.0687C43.3994 40.0916 34.2169 36.8995 26.2135 39.5187C19.6488 41.6651 15.3499 46.0656 13.2266 52.6299C13.2016 52.7075 13.1791 52.7875 13.1517 52.8676C12.9194 53.5405 12.727 53.9108 12.4697 53.9983C13.6088 49.3327 15.9194 45.5127 19.6089 42.5933C23.2933 39.6813 27.5049 38.2379 32.201 38.2604C41.3036 38.3054 47.6684 43.4413 51.6601 54.0008C56.2938 49.813 59.3563 44.7322 60.7202 38.6731C62.4163 31.1281 61.3396 23.9584 57.5103 17.2339C56.9133 16.1882 56.8333 15.3827 58.0149 14.7648C57.3279 15.858 57.7251 16.7811 58.2522 17.8543C63.9525 29.462 62.9658 40.4768 55.1697 50.8312V50.8312Z" fill="#EBF1F2"/>
                    <path d="M40.809 62.7792C22.6464 67.8451 4.42133 56.6727 0.634439 38.1604C-2.94263 20.6588 9.00507 3.35976 26.713 0.462841C35.6432 -0.995628 43.7716 1.0057 51.108 6.30922C51.8699 6.86209 52.2671 7.4725 51.9523 8.41562C51.1055 9.24867 50.3761 8.90344 49.5468 8.29804C38.4859 0.225182 23.9803 0.592928 13.374 9.18613C-0.257329 20.231 -1.12911 41.1048 11.538 53.2179C11.7903 53.463 12.0576 53.6957 12.4073 54.0134C12.4223 54.0284 12.4398 54.0434 12.4547 54.0584L12.4697 53.9984C13.6088 49.3328 15.9194 45.5128 19.6089 42.5933C23.2934 39.6814 27.5049 38.2379 32.201 38.2604C41.3036 38.3055 47.6684 43.4414 51.6601 54.0009C56.2938 49.8131 59.3563 44.7322 60.7202 38.6732C62.4163 31.1282 61.3396 23.9584 57.5103 17.234C56.9133 16.1883 56.8333 15.3827 58.0149 14.7648C58.8966 14.7448 59.3188 15.3252 59.716 16.0032C70.1349 33.82 60.6727 57.2405 40.809 62.7792V62.7792Z" fill="black"/>
                    <path d="M55.7416 12.5558C55.142 12.826 54.565 12.8635 54.0779 12.3332C53.5359 11.7403 53.7332 11.1424 54.0929 10.5495C54.7698 10.1842 55.4268 10.0617 55.9714 10.7671C56.4834 11.4276 56.2062 12.0079 55.7416 12.5558V12.5558Z" fill="#060606"/>
                    <path d="M43.2518 24.5688C43.2293 30.7179 38.1959 35.7437 32.0485 35.7562C25.8411 35.7663 20.7827 30.7154 20.7827 24.5038C20.7827 18.2922 25.8411 13.2413 32.051 13.2538C38.2484 13.2663 43.2743 18.3422 43.2518 24.5688V24.5688Z" fill="black"/>
                    <path d="M32.0963 61.5209C26.1611 61.4759 20.7531 59.8723 15.8021 56.6702C14.9528 56.1198 14.6705 55.6095 14.9153 54.5563C16.8113 46.3583 23.7381 40.7446 32.0563 40.7571C40.3495 40.7671 47.2788 46.4184 49.1323 54.6313C49.3321 55.5194 49.1947 56.0422 48.3829 56.5751C43.4145 59.8348 37.9714 61.4608 32.0988 61.5209H32.0963Z" fill="#94CD31"/>
                    <path d="M32.0812 15.7555C36.8748 15.778 40.7691 19.7181 40.7566 24.5363C40.7441 29.392 36.7674 33.3021 31.8939 33.2546C27.1128 33.2071 23.2485 29.2369 23.2834 24.4112C23.3184 19.618 27.2677 15.733 32.0837 15.7555H32.0812Z" fill="#86BF22"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_1530_2049">
                    <rect width="64" height="64" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
                <label>{{ Auth::user()->first_name }}</label>
                <svg width="18" height="10" viewBox="0 0 18 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_1533_2062)">
                    <path d="M17.8453 1.30091C17.7543 1.44338 17.6223 1.56089 17.5026 1.6836C14.9378 4.29176 12.3729 6.89887 9.80704 9.50494C9.15943 10.1643 8.82898 10.1643 8.1824 9.50702C5.60527 6.88743 3.02712 4.26888 0.452033 1.64721C0.321079 1.5141 0.182964 1.37474 0.0970253 1.21251C-0.197621 0.65823 0.212633 -4.73631e-05 0.829548 0.0113919C1.17228 0.010352 1.38405 0.239137 1.60197 0.461683C3.93765 2.83689 6.28152 5.20378 8.60288 7.59355C8.91389 7.91384 9.06429 7.92528 9.38349 7.59667C11.6915 5.21834 14.0231 2.86289 16.3476 0.50224C16.4683 0.379528 16.5839 0.245377 16.7241 0.153863C17.0862 -0.0822021 17.4474 -0.0468444 17.7482 0.259936C18.0479 0.566716 18.0786 0.934853 17.8453 1.30091V1.30091Z" fill="#F7F9FA"/>
                    <path d="M17.8453 1.30091C17.7543 1.44338 17.6223 1.56089 17.5026 1.6836C14.9378 4.29176 12.3729 6.89887 9.80704 9.50494C9.15943 10.1643 8.82898 10.1643 8.1824 9.50702C5.60527 6.88743 3.02712 4.26888 0.452033 1.64721C0.321079 1.5141 0.182964 1.37474 0.0970253 1.21251C-0.197621 0.65823 0.212633 -4.73631e-05 0.829548 0.0113919C1.17228 0.010352 1.38405 0.239137 1.60197 0.461683C3.93765 2.83689 6.28152 5.20378 8.60288 7.59355C8.91389 7.91384 9.06429 7.92528 9.38349 7.59667C11.6915 5.21834 14.0231 2.86289 16.3476 0.50224C16.4683 0.379528 16.5839 0.245377 16.7241 0.153863C17.0862 -0.0822021 17.4474 -0.0468444 17.7482 0.259936C18.0479 0.566716 18.0786 0.934853 17.8453 1.30091V1.30091Z" fill="black"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_1533_2062">
                    <rect width="18" height="10" fill="white"/>
                    </clipPath>
                    </defs>
                  </svg>                
            </div>
        </span>
    </a>

    {{-- User menu dropdown --}}
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

        {{-- User menu header --}}
        @if(!View::hasSection('usermenu_header') && config('adminlte.usermenu_header'))
            <li class="user-header {{ config('adminlte.usermenu_header_class', 'bg-primary') }}
                @if(!config('adminlte.usermenu_image')) h-auto @endif">
                @if(config('adminlte.usermenu_image'))
                    <img src="{{ Auth::user()->adminlte_image() }}"
                         class="img-circle elevation-2"
                         alt="{{ Auth::user()->name }}">
                @endif
                <p class="@if(!config('adminlte.usermenu_image')) mt-0 @endif">
                    {{ Auth::user()->name }}
                    @if(config('adminlte.usermenu_desc'))
                        <small>{{ Auth::user()->adminlte_desc() }}</small>
                    @endif
                </p>
            </li>
        @else
            @yield('usermenu_header')
        @endif

        {{-- Configured user menu links --}}
        @each('adminlte::partials.navbar.dropdown-item', $adminlte->menu("navbar-user"), 'item')

        {{-- User menu body --}}
        @hasSection('usermenu_body')
            <li class="user-body">
                @yield('usermenu_body')
            </li>
        @endif

        {{-- User menu footer --}}
        <li class="user-footer">
            @if($profile_url)
                <a href="{{ $profile_url }}" class="btn btn-default btn-flat">
                    <i class="fa fa-fw fa-user"></i>
                    {{ __('adminlte::menu.profile') }}
                </a>
            @endif
            <a class="btn btn-default btn-flat float-right @if(!$profile_url) btn-block @endif"
               href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa fa-fw fa-power-off"></i>
                {{ __('adminlte::adminlte.log_out') }}
            </a>
            <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                @if(config('adminlte.logout_method'))
                    {{ method_field(config('adminlte.logout_method')) }}
                @endif
                {{ csrf_field() }}
            </form>
        </li>

    </ul>

</li>
