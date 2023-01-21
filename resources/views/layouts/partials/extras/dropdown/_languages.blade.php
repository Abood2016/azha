{{-- Nav --}}


<ul class="navi navi-hover py-4">

    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

        <li class="navi-item active">
            <a rel="alternate" hreflang="{{ $localeCode }}"
               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="navi-link">
													<span class="symbol symbol-20 mr-3">
														<img src="{{ global_asset('media/svg/flags/195-france.svg') }}"
                                                             alt="">
													</span>
                <span class="navi-text">{{ $properties['native'] }}</span>
            </a>
        </li>

    @endforeach


</ul>
