<div>
    <div class="table-nowrap rounded-rem shadow-sm">
        <table class="table custom-table table-responsive-xl mb-0">
            <div class=" header bg-white d-flex justify-content-between py-4 px-4">
                <span class="h3">{{ __('Archive') }}
                    <span class="text-muted col-12" style="font-size: 14px">{{ __(' *Archive contain the Deleted Posts and Posts older then one Year') }}</span>
                </span>
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <select wire:model='pages' class="form-select" aria-label="Default select example">
                            <option value="10">10 Pages</option>
                            <option value="15">15 Pages</option>
                            <option value="20">20 Pages</option>
                            <option value="30">30 Pages</option>
                            <option value="50">50 Pages</option>
                            <option value="100">100 Pages</option>
                        </select>
                    </div>
                    <div class="col-auto">
                      <input type="search" class="form-control" wire:model='search' placeholder="Search...">
                    </div>
                </div>
            </div>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>writer</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Views | Comments</th>
                    <th>Archived At</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr wire:key='post_{{ $post->id }}' class="alert" role="alert">
                    <td wire:key='loop_{{ $post->id }}'>
                        <label class="checkbox-wrap checkbox-primary">
                        <span>{{ $loop->iteration }}</span>
                        </label>
                    </td>
                    <td wire:key='title_{{ $post->id }}'>
                        <div>
                        <span class="fw-bold">{{ $post->title }}</span>
                        </div>
                    </td>
                    <td wire:key='writer_username_{{ $post->id }}'>
                        <span class="fw-bold">{{ $post->admin_username }}</span>
                    </td>
                    <td class="status" wire:key='status_{{ $post->id }}'>
                        <span class="{{  $post->status == 'deleted' ? 'deleted' : ($post->status == 'draft' ? 'waiting':'active') }}">{{  $post->status }}</span>
                    </td>
                    <td class="status" wire:key='status_{{ $post->id }}'>
                        <span class="category">{{  $post->category }}</span>
                    </td>
                    <td wire:key='likes_views_comments_{{ $post->id }}'>
                        <span class="fw-bold" aria-hidden="true">
                            <a href="#" class="gray">{{ $post->views_count }} <i class="fas fa-eye"></i> |&#160;</a>
                            <a href="#" class="gray">{{ $post->likes_count }} <i class="fas fa-thumbs-up"></i> |&#160;</a>
                            <a href="#" class="gray">{{ $post->comments_count }} <i class="fas fa-comments"></i>&#160;</a>
                        </span>
                    </td>
                    <td wire:key='updated_at_{{ $post->id }}'>
                        <span class="fw-bold" aria-hidden="true">{{ $post->updated_at->format('m/d/y - h:m') }}</span>
                    </td>
                    <td wire:key='actions_{{ $post->id }}'>
                        <a target="_blank" href='{{ url(route('admin.posts.view',$post->id)) }}' class="btn btn-sm btn-yellow-100 fw-bold shadow-sm mx-1"><i class="fas fa-eye"></i></a>
                        <a onclick='edit_post({{ $post->id }},"{{ $post->title }}");' class="btn btn-sm btn-green-200 fw-bold shadow-sm mx-1"><i class="fas fa-pen"></i></a>
                        <a onclick='delete_post({{ $post->id }},"{{ $post->title }}");' class="btn btn-sm btn-red-200 fw-bold shadow-sm mx-1"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="footer bg-white d-flex justify-content-between px-4 py-4 mt-0 mb-5 shadow-sm">
            <div class=""></div>
            <div class="mx-5">{{ $posts->links() }}</div>
        </div>
    </div>



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
    .table.custom-table tbody td.status .deleted {
    background: var(--ex-red-100);
    color: var(--ex-red-500); }
    .table.custom-table tbody td.status .deleted:after {
    background: var(--ex-red-500); }
    .table.custom-table tbody td.status .waiting {
    background: var(--ex-yellow-100);
    color: var(--ex-yellow-500); }
    .table.custom-table tbody td.status .waiting:after {
    background: var(--ex-yellow-400); }
    .table.custom-table tbody td.status .active {
    background: var(--ex-green-100);
    color: var(--ex-green-500); }
    .table.custom-table tbody td.status .active:after {
    background: var(--ex-green-500); }
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
function edit_post(id,title) {
    const editPost = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-green-200  mx-1',
        cancelButton: 'btn btn-gray-300 mx-1'
    },
    buttonsStyling: false
    })

    editPost.fire({
        html:'<h5 class="mt-2 mb-1 text-green-500">Are you Sure you want to Edit this Post ?</h5><br><h3>'+title+'</h3>',
        showCancelButton: true,
        confirmButtonText: 'Edit',
        cancelButtonText: 'Cancel',
        focusConfirm: false,
    }).then((result) => {
    if (result.isConfirmed) {
        Livewire.emit('edit_post',id)
    }
    })
}
function delete_post(id,title) {
    const DeletePost = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-red-200 mx-1',
        cancelButton: 'btn btn-gray-300 mx-1'
    },
    buttonsStyling: false
    })

    DeletePost.fire({
        html:'<h5 class="mt-2 mb-1 text-red-500">Are you Sure you want to Delete this Post ?</h5><br><h3>'+title+'</h3><br>You won\'t be able to revert this!!',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        focusConfirm: false,
        showLoading:true,
    }).then((result) => {
    if (result.isConfirmed) {
        Livewire.emit('delete_post',id)
    }
    })

}
</script>
@endsection
</div>
