<div class="modal fade py-6" id="{{ $id }}" tabindex="-1" style="padding-right: 16px;" aria-modal="true" role="dialog">
    <div class="modal-dialog mt-0 mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-2xl mx-sm-auto" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title">
                    {{ $title }}
                </h5>
            </div>
            <div class="modal-body">
                {{ $content }}
            </div>
            <div class="px-6 py-4 bg-gray-100 text-end">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>
