@props(['checkbox' => 'on', 'data', 'actions' => null, 'extra' => null, 'relation' => null])  

'use strict';
var datatable =  {
    init: function() {
        var datatable = $('#datatable').KTDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "{{ $data }}",
                        method: 'GET',
                        params: {
                            relation: "{{ $relation }}"
                        }
                    },
                },
                saveState: false,
                pageSize: 10,
                serverPaging: !0,
                serverSorting: !0,
                serverFiltering: !0,
            },
        
            layout: {
                scroll: !1,
                footer: !1
            },
            sortable: !0,
            pagination: !0,
            search: {
                input: $("#search"),
                key: "{{ $searchColumns }}"
            },
            columns: [
                @if ($checkbox == "on")
                {
                    field: "id",
                    title: "#",
                    sortable: !1,
                    width: 20,
                    type: "number",
                    selector: {
                        class: ''
                    },
                    textAlign: "center",
                },
                @endif

                {{ $columns }}

                @if ($actions !== 'disabled')
                    
                {
                    field: "Actions",
                    title: `{{ __("Actions") }}`,
                    sortable: !1,
                    // autoHide: true,
                    overflow: "visible",
                    template: function(row) {
                        return  `{{ $actions }}`;
                    }
                }

                @endif

            ]
        });

        $('#search').on('change', function() {
            datatable.search($(this).val().toLowerCase(), `{{ $searchColumns }}`);
        });

        {{ $extra }}
    }
};
jQuery(document).ready(function() {
    datatable.init();
});