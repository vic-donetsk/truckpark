// обработка удаления парка
$('.parks_item-value.mod_delete').click(function(e) {

   axios.delete('/park_delete', {params: { id: $(this).parent().data('id') }
   }).then((response) => window.location.reload());
});
