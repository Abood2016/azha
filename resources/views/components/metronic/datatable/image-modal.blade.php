@props(['id', 'image', 'alt' => null])

<div class="modal fade" id="popup{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-transparent shadow-none">
            <div class="modal-body" style="height: 300px;">
                <img src="{{ $image }}" class="card-img" alt="{{ $alt }}">
            </div>
        </div>
    </div>
</div>