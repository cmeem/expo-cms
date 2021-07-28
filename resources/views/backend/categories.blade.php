<div>
    @section('nav_buttons')
    <a  data-bs-toggle="modal" data-bs-target="#create_category"
    class="btn bg-white gray rounded-4 nav-light-button d-none d-md-flex shadow-sm border-1 border-light mx-2">
        <i class="fas fa-plus"></i> &nbsp; Add Category
    </a>
    @endsection
    <div class="table-nowrap rounded-rem shadow-sm">
        <table class="table custom-table table-responsive-xl mb-0">
            <div class=" header bg-white d-flex justify-content-between py-4 px-4">
                <span class="h3">{{ __('Categories') }}</span>
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
                      <input type="search" class="form-control" wire:model.lazy='search' placeholder="Search...">
                    </div>
                  </div>
            </div>
            <thead>
                <tr>
                    <th width='10px'>#</th>
                    <th width='20%'>Name</th>
                    <th class="d-none d-md-table-cell">Details</th>
                    <th width='150px'>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr wire:key='category_{{ $category->id }}' class="alert" role="alert">
                    <td wire:key='loop_{{ $category->id }}'>
                        <label class="checkbox-wrap checkbox-primary">
                        <span>{{ $loop->iteration }}</span>
                        </label>
                    </td>
                    <td class="status fw-bold" wire:key='name_{{ $category->id }}'>
                        <span class="active">{{  $category->name }}</span>
                    </td>
                    <td class="d-none d-md-table-cell" wire:key='likes_views_comments_{{ $category->id }}'>
                        <span aria-hidden="true">
                            {{ $category->details }}
                        </span>
                    </td>
                    <td wire:key='actions_{{ $category->id }}'>
                        <a onclick='edit_category({{ $category->id }},"{{ $category->name }}");' class="btn btn-sm btn-green-200 fw-bold shadow-sm mx-1"><i class="fas fa-pen"></i></a>
                        <a onclick='delete_category({{ $category->id }},"{{ $category->name }}");' class="btn btn-sm btn-red-200 fw-bold shadow-sm mx-1"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="footer bg-white d-flex justify-content-between px-4 py-4 mt-0 mb-5 shadow-sm">
            <div class=""></div>
            <div class="mx-5">{{ $categories->links() }}</div>
        </div>
    </div>
    <div wire:ignore wire:key='create_category_modal' class="modal fade" id="create_category" tabindex="-1" aria-labelledby="create_categoryLabel" aria-hidden="true">
        <livewire:create-category />
    </div>
    <div wire:ignore wire:key='edit_category_modal' class="modal fade" id="edit_category" tabindex="-1" aria-labelledby="edit_categoryLabel" aria-hidden="true">
        <livewire:edit-category />
    </div>
    <button class="d-none hidden" id="editModel" data-bs-toggle="modal" data-bs-target="#edit_category"></button>
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
    padding: 20px;
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
    background: #23bd5a; }
    .table.custom-table tbody td.status .default {
    background: var(--ex-yellow-100);
    color: var(--ex-yellow-500); }
    .table.custom-table tbody td.status .default:after {
    background: var(--ex-yellow-400); }
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
$(document).ready(function() {
    document.addEventListener('CategorySuccess',function() {
        $('#category_name').val('');
        $('#category_details').val('');
        $('button[data-bs-dismiss="modal"]').click();
        Livewire.emit('updatingSearch')
    })
});
function edit_category(id,name) {
    const editCategory = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-green-200  mx-1',
        cancelButton: 'btn btn-gray-300 mx-1'
    },
    buttonsStyling: false
    })

    editCategory.fire({
        html:'<h5 class="mt-2 mb-1 text-green-500">Are you Sure you want to Edit this Category ?</h5><br><h3>'+name+'</h3>',
        showCancelButton: true,
        confirmButtonText: 'Edit',
        cancelButtonText: 'Cancel',
        focusConfirm: false,
    }).then((result) => {
    if (result.isConfirmed) {
        Livewire.emit('getOldCategory',id);
        $('#editModel').click();
    }
    })
}
function delete_category(id,name) {
    const deleteCategorys = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-red-200 mx-1',
        cancelButton: 'btn btn-gray-300 mx-1'
    },
    buttonsStyling: false
    })

    deleteCategorys.fire({
        html:'<h5 class="mt-2 mb-1 text-red-500">Are you Sure you want to Delete this Category ?</h5><br><h3>'+name+'</h3><br><span  class="text-muted">You won\'t be able to revert this!!</span> ',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        focusConfirm: false,
        showLoading:true,
    }).then((result) => {
    if (result.isConfirmed) {
        Livewire.emit('delete_category',id)
    }
    })

}
</script>
@endsection
</div>
