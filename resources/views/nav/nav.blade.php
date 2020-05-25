<div class="mainPage">
    <nav class="mainPage_nav">
        <a href="{{route($route)}}" class="mainPage_nav-item mod_enter">{{$message}}</a>
        @can('all-parks')
            <a href="{{route('truck_index')}}" class="mainPage_nav-item mod_enter">Список транспортных средств</a>
        @endcan
    </nav>

    <footer>
        <a href="{{route('logout')}}" class="mainPage_nav-item mod_exit"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    </footer>


</div>

