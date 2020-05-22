$('.mod_delete').click(function(e) {
   console.log($(this).parent().data('id'));
   axios.delete('/park_delete', {params: { id: $(this).parent().data('id') }
   }).then((response) => window.location.reload());
});
