@extends('layouts.default')

@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <x-metronic.datatable.table-card>
                <x-slot name="header">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="w-100 card-toolbar justify-content-between">
                            <!--begin::Search Form-->
                            <div class="d-flex">
                                <x-metronic.datatable.search-input/>
                            </div>


                            <!--end::Search Form-->
{{--                            <!--begin::Button-->--}}
{{--                            <x-metronic.button-link href="{{ route('categories.create') }}">--}}
{{--                            <span class="svg-icon svg-icon-md">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg"--}}
{{--                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"--}}
{{--                                     viewBox="0 0 24 24" version="1.1">--}}
{{--                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1"/>--}}
{{--                                        <rect fill="#000000" opacity="0.3"--}}
{{--                                              transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000) "--}}
{{--                                              x="4" y="11" width="16" height="2" rx="1"/>--}}
{{--                                    </g>--}}
{{--                                </svg>--}}
{{--                            </span>--}}
{{--                                أضافة قسم جديد--}}

{{--                            </x-metronic.button-link>--}}


                            <!--end::Button-->


                            <!--end::Button-->

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
        <x-metronic.datatable.table data="{{ route('categories.index') }}" search-columns="name,id">
            <x-slot name="columns">
                <x-metronic.datatable.column field="name" title="{{ __('Name') }}">
                    <x-slot name="template">
                        ${row.name}
                    </x-slot>
                </x-metronic.datatable.column>
                <x-metronic.datatable.column field="image" title="{{ __('Image') }}" sort="off">
                    <x-slot name="template">
                        <a href="javascript:;" type="button" data-toggle="modal" data-target="#popup${row.id}">
                            <div class="symbol symbol-50 mr-3">
                                <div class="symbol-label" style="background-image: url(${row.image_path})"></div>
                            </div>
                        </a>
                        <x-metronic.datatable.image-modal id="${row.id}" image="${row.image_path}" alt="${row.name}"/>
                    </x-slot>
                </x-metronic.datatable.column>
                <x-metronic.datatable.column field="active" title="{{ __('Active') }}">
                    <x-slot name="template">
                    <span
                        class="label font-weight-bold label-lg label-light-${row.active === 1 ? 'success' : 'danger'} label-inline">
                        ${row.active === 1 ? 'نشط' : 'غير نشط'}
                    </span>
                    </x-slot>
                </x-metronic.datatable.column>
            </x-slot>
            <x-slot name="actions">
                <x-metronic.datatable.actions-drop-down>
                    <x-metronic.datatable.actions-drop-down-item href="categories/${row.id}/edit">
                    <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                    fill="#000000" fill-rule="nonzero"
                                    transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                            </g>
                        </svg>
                    </span>
                        {{ __('تعديل') }}
                    </x-metronic.datatable.actions-drop-down-item>

                    <x-metronic.datatable.actions-drop-down-item href="javascript:;" data-id="${row.id}"
                                                                 data-active="${row.active}" class="update">
                    <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            </g>
                        </svg>
                    </span>
                        ${row.active === 1 ? 'تعطيل' : 'تفعيل'}
                    </x-metronic.datatable.actions-drop-down-item>

                    <x-metronic.datatable.actions-drop-down-item href="javascript:;" data-id="${row.id}" class="w-100 delete">
                    <span class="svg-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                                <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                            </g>
                        </svg>
                    </span>
                        {{ __('حذف') }}
                    </x-metronic.datatable.actions-drop-down-item>

                </x-metronic.datatable.actions-drop-down>
            </x-slot>
            <x-slot name="extra">

                $('body').on('click', '.delete', function() {

                axios.delete("/category/"+$(this).data("id"))
                    .then(function (response) {
                        <x-metronic.datatable.reload />
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            });

                $('body').on('click', '.update', function() {

                $.ajax({
                    url: "categories/" + $(this).data("id"),
                    type: 'DELETE',
                    data: {active: $(this).data("active"), "_token": "{{ csrf_token() }}"},
                    success: function (result) {
                        <x-metronic.datatable.reload/>
                    },
                    error: function (error) {
                        console.log(error);

                    }
                });

            })
            </x-slot>
        </x-metronic.datatable.table>
    </script>
@endsection
