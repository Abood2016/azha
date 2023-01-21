$('{{ '#'.  $selector }}').on('change', function() {
    datatable.search($(this).val().toLowerCase(), '{{ $column }}');
});