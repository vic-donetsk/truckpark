let $truckEditForm = $('.truckEdit_form');
let $selectBlock = $('.parksBlock.mod_select');
let $saveButton = $('.parkEdit_buttons-item.mod_accept');
let $plusAdd = $('.parksBlock_add');
let headers = ['id', 'name', 'driver'];

// добавляем автопарки, к которым привязан автомобиль
$plusAdd.click(function () {
    // формируем список "непривязанных" автопарков
    let freeParks = $selectBlock.data('set');
    outputSelect = `<option value="">Выберите автопарк</option>`
    for (let truckId in freeParks) {
        outputSelect += `<option value="${truckId}">${freeParks[truckId]}</option>`
    }
    $('.selectParkName').html(outputSelect);

    $plusAdd.slideUp();
    $saveButton.prop('disabled', true);
    $selectBlock.slideDown();
    // Обрабатываем выбор нового автопарка
    $('.selectParkName').on('change', function (e) {
        let newChoice = $(this).val();
        if (newChoice) {
            // формируем и вставляем новый привязанный парк
            $selectBlock.before(`
            <div class="parksBlock">
                <div class="parksBlock_item mod_name" data-id="${newChoice}">${freeParks[newChoice]}</div>
                <div class="parksBlock_delete">
                    <svg class="svg-delete">
                        <use xlink:href="#svgDelete" class="mod_delete"/>
                    </svg>
                </div>
            </div>`);

            // удаляем парк из списка свободных
            delete freeParks[newChoice];
            $selectBlock.data('set', freeParks);
            // возвращаем форму в обычный вид
            $selectBlock.slideUp();
            $plusAdd.slideDown();
            $saveButton.prop('disabled', false);
            $('.selectParkName').off('change');
        }
        ;
    });
});

// отправка заполненной формы на валидацию
$truckEditForm.submit(function (e) {
    e.preventDefault();
    // формируем данные свойств автомобиля
    let axiosParams = {};
    for (let oneHeader of headers) {
        axiosParams[oneHeader] = $(`.truckEdit_form input[name=${oneHeader}]`).val();
    }

    // формируем данные привязанных автопарков
    let newParkIds = $('.parksBlock_item.mod_name');
    axiosParams.newParkIds = newParkIds.map(function () {
        return $(this).data('id');
    }).get();

    axios.post('/truck_update', axiosParams).then((response) => {
        if (response.data === 'ok') {
            window.location.pathname = '/my_trucks';
        } else {
            // если не введены данные автомобиля
            for (let errorData of response.data) {
                $(`.truckEdit_form input[name=${errorData[0]}]`).addClass('is-invalid').next().text(errorData[1]);
            }
        }
    });
});

// при фокусе на поле ввода убираем красную рамку и сообщение об ошибке под ним
$truckEditForm.focusin(function (e) {
    if (e.target.tagName === 'INPUT') {
        $(e.target).removeClass('is-invalid').siblings('.is-error').empty();
    }
});

// удаляет ранее привязанный к машине парк или
// привязанный в процессе создания/редактирования машины парк
$truckEditForm.click(function (e) {
    if ($(e.target).hasClass('mod_delete')) {
        let parksList = $selectBlock.data('set');
        let $elem = $(e.target).closest('.parksBlock_delete').siblings('.mod_name');
        parksList[$elem.data('id')] = $elem.text();
        $(e.target).closest('.parksBlock').remove();
    }
});

// обработка удаления автомобиля
$('.trucks_item-value.mod_delete').click(function(e) {

    axios.delete('/truck_delete', {params: { id: $(this).parent().data('id') }
    }).then((response) => window.location.reload());
});


