{{-- Subheader V1 --}}

<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
    <div
        class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

        {{-- Info --}}
        <div class="d-flex align-items-center flex-wrap mr-1">


            @if(isset($available_drivers ))
                <div>
                    <button type="button" id="manual_assign" style="margin: 0 9px;" class="btn btn-success"
                            data-toggle="modal">
                        <i class="fa fa-arrow-alt-circle-right"></i> {{__('Manual Assign')}}
                    </button>
                </div>

            @endif

            {{-- Page Title --}}
            <h4 class="text-dark font-weight-bold my-2 mr-5">
                {{ @$page_title }}

                @if (isset($page_description) && config('layout.subheader.displayDesc'))
                    <small>{{ @$page_description }}</small>
                @endif
            </h4>

            @if (!empty($page_breadcrumbs))
                {{-- Separator --}}
                <div class="subheader-separator subheader-separator-ver my-2 mr-4 d-none"></div>

                {{-- Breadcrumb --}}
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
                    <li class="breadcrumb-item"><a href="#"><i class="flaticon2-shelter text-muted icon-1x"></i></a>
                    </li>
                    @foreach ($page_breadcrumbs as $k => $item)
                        <li class="breadcrumb-item">
                            <a href="{{ url($item['page']) }}" class="text-muted">
                                {{ $item['title'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Toolbar --}}
        <div class="d-flex align-items-center">

            @hasSection('page_toolbar')
                @section('page_toolbar')
                    @endif
        </div>

    </div>
</div>
