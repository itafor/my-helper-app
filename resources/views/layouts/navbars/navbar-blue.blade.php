@auth()
    @include('layouts.navbars.navs.auth-blue')
@endauth

@guest()
    @include('layouts.navbars.navs.guest-blue')
@endguest
