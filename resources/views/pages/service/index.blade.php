@extends('layouts.default')

@section('content')
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <x-metronic.datatable.table-card>
            <x-slot name="header">
                <div x-data="{ open: false }" class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="w-100 card-toolbar justify-content-between">
                        <!--begin::Search Form-->
                        <div class="d-flex">
                            <x-metronic.datatable.search-input />

                            <x-metronic.button type="button" class="mx-2" style="light" @click="open = ! open">
                                Filters
                            </x-metronic.button>
                        </div>
                        <!--end::Search Form-->

                    </div>
                    <div x-show="open" class="w-100 card-toolbar">
                        <div class="col-md-4 my-2 my-md-0 pl-0">
                            <x-metronic.datatable.drop-down label="Status" selector="status_filter">
                                <x-metronic.datatable.drop-dowm-option value="1">
                                    {{ __('Active') }}
                                </x-metronic.datatable.drop-dowm-option>
                                <x-metronic.datatable.drop-dowm-option value="0">
                                    {{ __('Blocked') }}
                                </x-metronic.datatable.drop-dowm-option>
                            </x-metronic.datatable.drop-down>
                        </div>
                    </div>
                </div>
            </x-slot>
            <x-slot name="body">
                <div class="datatable datatable-bordered datatable-head-custom" id="datatable"></div>
            </x-slot>
        </x-metronic.datatable.table-card>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
@endsection

@section('scripts')
<script>
    <x-metronic.datatable.table data="{{ route('services.index') }}" search-columns="name,servicez.name" relation="category">
        <x-slot name="columns">


            {{--<x-metronic.datatable.column field="recruiter" title="{{ __('صاحب الخدمة') }}">--}}
            {{--    <x-slot name="template">--}}
            {{--        ${row.recruiter}--}}
            {{--    </x-slot>--}}
            {{--</x-metronic.datatable.column>--}}

            {{--<x-metronic.datatable.column field="category" title="{{ __('القسم ') }}">--}}
            {{--    <x-slot name="template">--}}
            {{--        ${row.category}--}}
            {{--    </x-slot>--}}
            {{--</x-metronic.datatable.column>--}}

            <x-metronic.datatable.column field="subcategory" title="{{ __('القسم الفرعي ') }}">
                <x-slot name="template">
                    ${row.subcategory}
                </x-slot>
            </x-metronic.datatable.column>

            <x-metronic.datatable.column field="image" title="{{ __('الصورة') }}" sort="off">
                <x-slot name="template">
                    <a href="javascript:;" type="button" data-toggle="modal" data-target="#popup${row.id}">
                        <div class="symbol symbol-50 mr-3">
                            <div class="symbol-label" style="background-image: url(${row.image})"></div>
                        </div>
                    </a>
                    <x-metronic.datatable.image-modal id="${row.id}" image="${row.image}" alt="${row.name}"/>
                </x-slot>
            </x-metronic.datatable.column>


            <x-metronic.datatable.column field="status" title="{{ __('الحالة') }}">
                <x-slot name="template">
                    <span class="order label font-weight-bold label-lg label-light-${row.status === 0 ? 'dark' : (row.status === 1 ? 'primary' : (row.status === 2 ?'danger':row.status === 3? 'danger' :row.status === 4?'danger':row.status === 5?'danger':row.status === 6?'danger':row.status === 8?'success':''))} label-inline">
                        ${row.status === 0 ? 'قيد الأنتظار' : (row.status === 1 ? 'مقبولة' :
                        (row.status === 2 ? 'مرفوضة' : ''
                        ))
                    }
                    </span>
                </x-slot>
            </x-metronic.datatable.column>

        </x-slot>
        <x-slot name="actions">
            <x-metronic.datatable.actions-drop-down>
                <x-metronic.datatable.actions-drop-down-item href="services/${row.id}/">
                    <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                            </g>
                        </svg>
                    </span>
                    {{ __('التفاصيل') }}

                </x-metronic.datatable.actions-drop-down-item>
                ${row.status === 0 ?`
                 <x-metronic.datatable.actions-drop-down-item href="javascript:;" data-update="status"  data-id="${row.id} " class="cancel">
                    <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        </g>
                        </svg>
                        </span>
                            {{ __('رفض الخدمة') }}
            </x-metronic.datatable.actions-drop-down-item>
`:``}
                ${row.status === 0 ?`
                <x-metronic.datatable.actions-drop-down-item href="javascript:;" data-id="${row.id}" data-update="status" class="update">
                    <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            </g>
                        </svg>
                    </span>
                    {{ __('قبول') }}
                </x-metronic.datatable.actions-drop-down-item>

                `:``}


            </x-metronic.datatable.actions-drop-down>
        </x-slot>
        <x-slot name="extra">

        <x-metronic.datatable.search selector="category_filter" column="category.name" />
        <x-metronic.datatable.search selector="status_filter" column="status" />

            $('body').on('click', '.update', function() {
                axios.post("{{ route('metronic.service.status') }}", {
                        id: $(this).data("id"),
                        update: $(this).data("update")
                    })
                    .then(function (response) {
                        <x-metronic.datatable.reload />
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            })

            $('body').on('click', '.cancel', function() {
            axios.post("{{ route('services.status') }}", {
                id: $(this).data("id"),
                update: $(this).data("cancel")
            })
                .then(function (response) {
                    <x-metronic.datatable.reload />
                })
                .catch(function (error) {
                    console.log(error);
                });
        })





        </x-slot>
    </x-metronic.datatable.table>
</script>
@endsection
