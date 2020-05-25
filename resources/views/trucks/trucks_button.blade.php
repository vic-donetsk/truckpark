<div class="trucks_buttons">
    <a href="{{route('index')}}" class="parks_add" title="Вернуться в главное меню">
        <svg class="svg-icon">
            <use xlink:href="#svgBack"/>
        </svg>
    </a>
    @if (\Illuminate\Support\Facades\Route::currentRouteName() === 'truck_show')
        <a href="{{route('truck_edit')}}" class="trucks_add" title="Добавить новый автомобиль">
            <svg class="svg-icon">
                <use xlink:href="#svgAdd"/>
            </svg>
        </a>
    @endif
</div>
