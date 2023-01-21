@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-label">
                             {{ __('تفاصيل خدمة -  ') . ' ' . $service['recruiter']}}
                        </h3>


                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-box"></i>
                                    </span>
                                        <h3 class="card-label">{{ __('تفاصيل صاحب الخدمة') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('الأسم') }}:</label>
                                        <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['recruiter']}}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row my-2">
                                        <label class="col-4 col-form-label">{{ __('رقم الجوال') }}:</label>
                                        <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['recruiter_phone']}}</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card card-custom card-fit card-border h-100">
                                <div class="card-header">
                                    <div class="card-title">
                                    <span class="card-icon">
                                        <i class="fas fa-box"></i>
                                    </span>
                                        <h3 class="card-label">{{ __('تفاصيل الخدمة') }}</h3>
                                    </div>
                                </div>
                                <div class="card-body pt-2">
{{--                                    @if(!is_null($service['driver_id']))--}}
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('رقم الخدمة') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['id']}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('القسم الرئيسي') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['category']}}</span>
                                            </div>
                                        </div>
                                        <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('القسم الفرعي') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['subcategory']}}</span>
                                            </div>
                                        </div>


                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('المنطقة ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['region']}}</span>
                                            </div>
                                        </div>
                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('وقت التنفيذ ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['execution_time']}}</span>
                                            </div>
                                        </div>
                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('عدد الأشخاص') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['number_person']}}</span>
                                            </div>
                                        </div>
                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' نوع المكان') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['place_type']}}</span>
                                            </div>
                                        </div>     <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' نوع التصوير') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['photography_type']}}</span>
                                            </div>
                                        </div>



                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' نوع الورق') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['paper_type']}}</span>
                                            </div>
                                        </div>
                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' نوع التكييف') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['conditioning_type']}}</span>
                                            </div>
                                        </div>
                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' نوع السيارة') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['car_type']}}</span>
                                            </div>
                                        </div>  <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' عدد الصور ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['count_photos']}}</span>
                                            </div>
                                        </div>


                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' عدد الفيديوهات') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['count_videos']}}</span>
                                            </div>
                                        </div>    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' نوع البولش ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['polish_type']}}</span>
                                            </div>
                                        </div>
                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('  منطقة التوصيل') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['delivery_area']}}</span>
                                            </div>
                                        </div>

                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('  الوحدة السكنية ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['residential_unit']}}</span>
                                            </div>
                                        </div>

                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('  عدد العمال  ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['count_workers']}}</span>
                                            </div>
                                        </div>
                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __(' قطع الغيار   ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['spare_parts']}}</span>
                                            </div>
                                        </div>



                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('  سنة الانتاج   ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['year_production']}}</span>
                                            </div>
                                        </div>

                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('   الحالة   ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['status']}}</span>
                                            </div>
                                        </div>
                                    <div class="form-group row my-2">
                                            <label class="col-4 col-form-label">{{ __('   الرسالة   ') }}:</label>
                                            <div class="col-8">
                                        <span
                                            class="form-control-plaintext font-weight-bolder">{{$service['message']}}</span>
                                            </div>
                                        </div>    <div class="form-group row my-2">
                                            {{-- <label class="col-4 col-form-label">{{ __('   الصورة   ') }}:</label> --}}
                                            <div class="col-8">
                                                <img src="{{$service['image']}}" alt="">
                                            </div>
                                        </div>

{{--                                    @else--}}
{{--                                        No Driver--}}
{{--                                    @endif--}}
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
