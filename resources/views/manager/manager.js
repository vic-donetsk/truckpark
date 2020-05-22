// обработка удаления парка
$('.mod_delete').click(function(e) {

   axios.delete('/park_delete', {params: { id: $(this).parent().data('park').id }
   }).then((response) => window.location.reload());
});

// редактирование существующего парка
// $('.parks_item-value.mod_edit').click(function(e) {
//     parkHandler(this);
// });

// $('.park_create').click(function(e) {
//     parkHandler();
// });
//
// // работа с формой для заполнения данных парка
// function parkHandler(elem = null) {
//     let inputs = ['name', 'address', 'work_schedule', 'id'];
//     // если редактируем существующий парк
//     if (elem) {
//         let parkData = $(elem).parent().data('park');
//         for (let oneInput of inputs) {
//             $('#parkEdit_' + oneInput).val(parkData[oneInput]);
//         }
//     } else {
//         for (let oneInput of inputs) {
//             $('#parkEdit_' + oneInput).val('');
//         }
//     }
//     $('.parks_modal').css('display', 'block');
//
//     $(".parkEdit_buttons-item.mod_close").click(function() {
//         $('.parks_modal').css('display', 'none');
//     });
// }
