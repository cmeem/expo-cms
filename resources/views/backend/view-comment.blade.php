<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="create_categoryLabel">Comment Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
            <div class="writer px-2 text-gray-700 h5">
                Writer:&#160;&#160;&#160;&#160; <span class="h6">{{ $comment_writer }}</span>
            </div>
            <div class="p-2 text-gray-700 h5">
                Content:
            </div>
            <div class="content p-2" style="word-wrap: break-word;">
                {{ $comment_details }}
            </div>
    </div>
    <div class="modal-footer">
            <a
            id="commentChangeStatus"
            type="button"
            wire:click='change_status'
            class="btn btn-sm btn-{{ $comment_status == 'Pending' ? 'green' : 'yellow' }}-200 fw-bold shadow-sm mx-1">
                {{ $comment_status == 'Pending' ? 'Approve' : 'Pending' }}
            </a>
            <button
            id="commentModelDismiss"
            type="button"
            class="btn btn-gray-200"
            data-bs-dismiss="modal">
                Close
            </button>
    </div>
    </div>
</div>

