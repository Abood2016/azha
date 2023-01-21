@props(['field', 'title', 'sort' => 'on'])

{
    field: `{{ $field }}`,
    title: `{{ $title }}`,
    @if ($sort != "on")
    sortable: false,
    @endif
    template: function(row) {
        return `{{ $template }}`;
    }
},