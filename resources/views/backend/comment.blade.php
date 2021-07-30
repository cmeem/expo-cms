<div>
    <div class="table-nowrap rounded-rem shadow-sm">
        <table class="table custom-table table-responsive-xl mb-0">
            <div class=" header bg-white d-flex justify-content-between py-4 px-4">
                <span class="h3">{{ __('Comments') }}</span>
                <div class="row g-3 align-items-center">
                    <div class="col-auto d-flex justify-content-center align-items-center">
                        <span class="fw-bold text-gray-700 px-2">Filter</span>
                        <select wire:model='status' class="form-select">
                            <option value='' selected>All</option>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                            <option value="Deleted">Deleted</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <select wire:model='pages' class="form-select">
                            <option value="10">10 Pages</option>
                            <option value="15">15 Pages</option>
                            <option value="20">20 Pages</option>
                            <option value="30">30 Pages</option>
                            <option value="50">50 Pages</option>
                            <option value="100">100 Pages</option>
                        </select>
                    </div>
                    <div class="col-auto">
                      <input type="search" class="form-control" wire:model.lazy='search' placeholder="Search...">
                    </div>
                  </div>
            </div>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>writer</th>
                    <th>Attachments</th>
                    <th>Created At</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                <tr wire:key='post_{{ $comment->id }}' class="alert" role="alert">
                    <td wire:key='loop_{{ $comment->id }}'>
                        <label class="checkbox-wrap checkbox-primary">
                        <span>{{ $loop->iteration }}</span>
                        </label>
                    </td>
                    <td class="status" wire:key='status_{{ $comment->id }}'>
                        <span class="{{  $comment->status == 'Pending' ? 'pending' : ($comment->status == 'Deleted' ? 'deleted' : 'active') }}">{{  $comment->status }}</span>
                    </td>
                    <td wire:key='writer_{{ $comment->id }}'>
                        <span class="fw-bold">{{ $comment->writer }}</span>
                    </td>
                    <td wire:key='Attachments_{{ $comment->id }}'>
                    @if(isset($comment->Attachments))
                        @foreach (json_decode($comment->Attachments) as $file)
                            <i class="fas fa-paperclip bg-white rounded-3 gray"></i>
                        @endforeach
                    @else
                        <span class="fw-bold">N/A</span>
                    @endif
                    </td>
                    <td wire:key='created_at_{{ $comment->id }}'>
                        <span class="fw-bold" aria-hidden="true">{{ $comment->created_at->format('m/d/y - h:m') }}</span>
                    </td>
                    <td wire:key='actions_{{ $comment->id }}'>
                        <a onclick='view_comment({{ $comment->id }});' class="btn btn-sm btn-green-200 fw-bold shadow-sm mx-1">
                            View
                        </a>
                        @if($comment->status != 'Deleted')
                        <a
                        wire:key='selete_{{ $comment->id }}'
                        onclick='delete_comment({{ $comment->id }});'
                        class="btn btn-sm btn-red-200 fw-bold shadow-sm mx-1">
                            Delete
                        </a>
                        @else
                        <a
                        wire:key='restore_{{ $comment->id }}'
                        wire:click='restore_comment({{ $comment->id }})'
                        class="btn btn-sm btn-pink-200 fw-bold shadow-sm mx-1">
                            Restore
                        </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="footer bg-white d-flex justify-content-between px-4 py-4 mt-0 mb-5 shadow-sm">
            <div class=""></div>
            <div class="mx-5">{{ $comments->links() }}</div>
        </div>
    </div>

    <div wire:ignore wire:key='view_comment_modal' class="modal fade" id="view_comment" tabindex="-1" aria-labelledby="view_comment_Label" aria-hidden="true">
        <livewire:view-comment />
    </div>
    <button class="d-none hidden" id="O_view_comment" data-bs-toggle="modal" data-bs-target="#view_comment"></button>


@section('page_style')
<style>
    .header{
        border-top-left-radius:20px;
        border-top-right-radius:20px;
    }
    .footer{
        border-bottom-left-radius:20px;
        border-bottom-right-radius:20px;
    }
    .ftco-section {
    padding: 7em 0; }

    .ftco-no-pt {
    padding-top: 0; }

    .ftco-no-pb {
    padding-bottom: 0; }

    .heading-section {
    font-size: 28px;
    color: #000; }

    .img {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center; }

    .table.custom-table {
    min-width: 800px !important;
    width: 100%;
    -webkit-box-shadow: 0px 5px 12px -12px rgba(0, 0, 0, 0.29);
    -moz-box-shadow: 0px 5px 12px -12px rgba(0, 0, 0, 0.29);
    box-shadow: 0px 5px 12px -12px rgba(0, 0, 0, 0.29); }
    .table.custom-table thead th {
    border: none;
    padding: 30px;
    font-size: 15px;
    font-weight: 600;
    color: rgb(100, 100, 100); }
    .table.custom-table thead tr {
    background: #fff;
    border-bottom: 1px solid #eceffa; }
    .table.custom-table tbody tr {
    margin-bottom: 10px;
    border-bottom: 1px solid #f8f9fd; }
    .table.custom-table tbody tr:last-child {
    border-bottom: 0; }
    .table.custom-table tbody th, .table.custom-table tbody td {
    border: none;
    padding: 25px;
    font-size: 14px;
    background: #fff;
    vertical-align: middle; }
    .table.custom-table tbody td.status span {
    position: relative;
    border-radius: 30px;
    padding: 4px 10px 4px 25px; }
    .table.custom-table tbody td.status span:after {
    position: absolute;
    top: 7px;
    left: 10px;
    width: 10px;
    height: 10px;
    content: '';
    border-radius: 50%; }
    .table.custom-table tbody td.status .active {
    background: var(--ex-green-100);
    color: var(--ex-green-500); }
    .table.custom-table tbody td.status .active:after {
    margin-top:1px;
    background: #23bd5a; }
    .table.custom-table tbody td.status .pending {
    background: var(--ex-yellow-100);
    color: var(--ex-yellow-500); }
    .table.custom-table tbody td.status .pending:after {
    margin-top:1px;
    background: var(--ex-yellow-400); }
    .table.custom-table tbody td.status .deleted {
    background: var(--ex-red-100);
    color: var(--ex-red-500); }
    .table.custom-table tbody td.status .deleted:after {
    margin-top:1px;
    background: var(--ex-red-400); }
    .table.custom-table tbody td .img {
    width: 50px;
    height: 50px;
    border-radius: 50%; }
    .table.custom-table tbody td .email span {
    display: block; }
    .table.custom-table tbody td .email span:last-child {
    font-size: 12px;
    color: rgba(0, 0, 0, 0.3); }
    .table.custom-table tbody td .close span {
    font-size: 12px;
    color: #dc3545; }
    .table.custom-table tbody td.status span.category{
    position: relative;
    font-weight: 500;
    border-radius: 30px;
    padding: 4px 12px 4px 12px;
    background: #cff3f6;
    color: #3591dc; }

    .checkbox-wrap {
    display: block;
    position: relative;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none; }

    /* Hide the browser's default checkbox */
    .checkbox-wrap input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0; }

    /* Create a custom checkbox */
    .checkmark {
    position: absolute;
    top: 0;
    left: 0; }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
    content: "\f0c8";
    font-family: "FontAwesome";
    position: absolute;
    color: rgba(0, 0, 0, 0.1);
    font-size: 20px;
    margin-top: -14px;
    -webkit-transition: 0.3s;
    -o-transition: 0.3s;
    transition: 0.3s; }
    @media (prefers-reduced-motion: reduce) {
        .checkmark:after {
        -webkit-transition: none;
        -o-transition: none;
        transition: none; } }

    /* Show the checkmark when checked */
    .checkbox-wrap input:checked ~ .checkmark:after {
    display: block;
    content: "\f14a";
    font-family: "FontAwesome";
    color: rgba(0, 0, 0, 0.2); }

    /* Style the checkmark/indicator */
    .checkbox-primary {
    color: #40bfc1; }
    .checkbox-primary input:checked ~ .checkmark:after {
        color: #40bfc1; }
</style>
@endsection
@section('page_script')
<script>
document.addEventListener('model_dismiss',function() {
    $('#commentModelDismiss').click();
})
function view_comment(id,name) {
    Livewire.emit('getComment',id);
    $('#O_view_comment').click();
    $('#commentChangeStatus').focus();
}
function delete_comment(id,title) {
    const DeleteComment = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-red-200 mx-1',
        cancelButton: 'btn btn-gray-300 mx-1'
    },
    buttonsStyling: false
    })

    DeleteComment.fire({
        html:'<h5 class="mt-2 mb-1 text-red-500">Are you Sure you want to Delete this Comment ?</h5><br><span  class="text-muted">You will be able to revert this !!</span> ',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        focusConfirm: false,
    }).then((result) => {
    if (result.isConfirmed) {
        Livewire.emit('delete_comment',id)
    }
    })

}
</script>
@endsection
</div>
