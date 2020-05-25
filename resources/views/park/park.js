let $parkEditForm = $('.parkEdit_form');
let headers = ['id', 'name', 'address', 'work_schedule'];

// добавляем машину на странице автопарка
$('.trucksBlock_add').click(function () {

    let inputLayout = `<div class="trucksBlock">
                          <div class="trucksBlock_wrapper">
                              <div class="trucksBlock_item">
                                  <input type="text" name="trucks[name][]" class="modTruckName">
                                  <input type="hidden" name="trucks[id][]" class="modTruckId">
                              </div>
                              <div class="is-error"></div>
                          </div>
                          <div class="trucksBlock_wrapper">
                              <div class="trucksBlock_item">
                                  <input type="text" name="trucks[driver][]" class="modTruckDriver" disabled>
                              </div>
                              <div class="is-error"></div>
                          </div>
                          <div class="trucksBlock_delete">
                            <svg class="svg-delete">
                                <use xlink:href="#svgDelete"/>
                            </svg>
                          </div>
                       </div>`;

    $(this).parent().before(inputLayout);
});

// после ввода номера проверяем наличие машины в БД
$parkEditForm.focusout(function (e) {
    if ($(e.target).hasClass('modTruckName') && $(e.target).val()) {
        // временно запрещаем отправку формы
        $parkEditForm.unbind('submit', parkFormSubmit);
        axios.get('/truck', {
            params: {
                name: $(e.target).val()
            }
        }).then((response) => {
            let $driverInput = $(e.target).closest('.trucksBlock_wrapper').next().find('.modTruckDriver');
            // если машина уже в базе
            if (response.data) {
                // заполняем водителя, заносим ИД-шку и снимаем ошибку, если была
                $driverInput.val(response.data.driver);
                $(e.target).next('input').val(response.data.id);
                if ($driverInput.parent().hasClass('is-invalid')) {
                    $driverInput.parent().removeClass('is-invalid').next().empty();
                }
            } else {
                // если машины в базе нет - обнуляем ИД и разрешаем ввод данных водителя
                $driverInput.prop('disabled', false).val('').focus();
            }
            // восстанавливаем обработчик отправки формы
            $parkEditForm.bind('submit', parkFormSubmit);
        });
    }
});

// отправка заполненной формы на валидацию
$parkEditForm.submit((e) => {
   e.preventDefault();
});

$parkEditForm.bind('submit', parkFormSubmit);

function parkFormSubmit(e) {
    // формируем данные полей автопарка
    let axiosParams = {};
    for (let oneHeader of headers) {
        axiosParams[oneHeader] = $(`.parkEdit_form input[name=${oneHeader}]`).val();
    }

    // формируем данные добавленных машин
    let newTruckNames = $("input[name='trucks[name][]']");
    axiosParams.newTruckNames = newTruckNames.map(function () {
        return $(this).val();
    }).get();
    let newTruckDrivers = $("input[name='trucks[driver][]']");
    axiosParams.newTruckDrivers = newTruckDrivers.map(function () {
        return $(this).val();
    }).get();
    let newTruckIds = $("input[name='trucks[id][]']");
    axiosParams.newTruckIds = newTruckIds.map(function () {
        return $(this).val();
    }).get();

    // формируем данные оставшихся после редактирования ранее привязанных машин
    let oldTruckIds = $('.trucksBlock_item.mod_name');
    axiosParams.oldTruckIds = oldTruckIds.map(function () {
        return $(this).data('id');
    }).get();

    axios.post('/park_update', axiosParams).then((response) => {
        if (response.data === 'ok') {
            window.location.pathname = '/parks';
        } else {
            for (let errorData of response.data) {
                // если не введены данные автопарка
                if (headers.indexOf(errorData[0]) !== -1) {
                    $(`.parkEdit_form input[name=${errorData[0]}]`).addClass('is-invalid').next().text(errorData[1]);
                } else {
                    // если не введены данные добавляемых машин
                    let errorElem = errorData[0].split('_');
                    if (errorElem[0] === 'truck') {
                        $(newTruckNames[errorElem[1]]).parent().addClass('is-invalid').siblings('.is-error').text(errorData[1]);
                    } else {
                        $(newTruckDrivers[errorElem[1]]).parent().addClass('is-invalid').siblings('.is-error').text(errorData[1]);
                    }
                }
            }
        }
    });
}

// при фокусе на поле ввода убираем красную рамку и сообщение об ошибке под ним
$parkEditForm.focusin(function (e) {
    if (e.target.tagName === 'INPUT') {
        $(e.target).parent().removeClass('is-invalid').siblings('.is-error').empty();
    }
});

// удаляет ранее привязанную к парку машину или
// добавленную в процессе редактирования новую машину
$parkEditForm.click(function (e) {
    if ($(e.target).hasClass('mod_delete')) {
        $(e.target).closest('.trucksBlock').remove();
    }
});





