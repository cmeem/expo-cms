<div>
    <div class="row rounded-rem bg-white shadow-sm">
        <div class="col-12 px-0 rounded-rem">
            <div class="user-info d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-start align-items-center">
                    <div class="py-3 rounded-rem profile-container bg-whire">
                        <img src="{{ asset(auth()->user()->avatar) }}" width="90px" height="90px" alt="" class="profile-img rounded-5 shadow-sm">
                    </div>
                    <div class="username px-4 py-3 row">
                        <span class="col-12 mt-2 text-gray-800 h4 fw-bold">{{ auth()->user()->fullname }}</span>
                        <span style="font-size:14px" class="col-12 mt-1 text-gray-500 fw-bold"><i class="fas fa-user text-gray-400"></i> {{ auth()->user()->position }}</span>
                        <span style="font-size:14px" class="col-12 mt-1 text-gray-500 fw-bold">{{ '@'.auth()->user()->username }}</span>
                    </div>
                </div>
                <div class="user-buttons d-flex justify-content-end px-5 mt-4">
                    <a href="{{ route('admin.logout') }}" class="btn bg-white gray rounded-4 nav-light-button d-none d-md-flex shadow-sm border-1 border-light mx-2">
                        <i class="fas fa-sign-out-alt"></i> &nbsp; logout
                    </a>
                </div>
            </div>
            <nav class="nav nav-pills d-flex justify-content-start px-5" role="tablist" wire:ignore wire:key='navTabs'>

                <a role="button" class="text-gray-600 text-decoration-none fw-bold pb-2 px-4 mx-4 rounded-1 profile-links active"
                id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview-tab" aria-selected="true">
                overview
                </a>

                <a role="button" class="text-gray-600 text-decoration-none fw-bold pb-2 px-4 mx-4 rounded-1 profile-links"
                id="Editprofile-tab" data-bs-toggle="tab" data-bs-target="#editUserInfo" type="button" role="tab" aria-controls="editUserInfo-tab" aria-selected="false">
                Edit profile
                </a>

                <a role="button" class="text-gray-600 text-decoration-none fw-bold pb-2 px-4 mx-4 rounded-1 profile-links"
                id="Settings-tab" data-bs-toggle="tab" data-bs-target="#Settings" type="button" role="tab" aria-controls="Settings-tab" aria-selected="false">
                Settings
                </a>

                <a role="button" class="text-gray-600 text-decoration-none fw-bold pb-2 px-4 mx-4 rounded-1 profile-links"
                id="ChangePassword-tab" data-bs-toggle="tab" data-bs-target="#ChangePassword" type="button" role="tab" aria-controls="ChangePassword-tab" aria-selected="false">
                Change Password
                </a>

                <a role="button" class="text-gray-600 text-decoration-none fw-bold pb-2 px-4 mx-4 rounded-1 profile-links"
                id="SocialMedia-tab" data-bs-toggle="tab" data-bs-target="#Social" type="button" role="tab" aria-controls="Social-tab" aria-selected="false">
                Social Media
                </a>

            </nav>
        </div>
    </div>
    <div class="row bg-white rounded-rem mt-3 py-4 px-5 tab-content" wire:key="TabsContent" wire:ignore>
        <div class="rounded-rem tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <span class="h6 text-gray-600 fw-bold">Profile Details</span>
            <livewire:settings.profile.overview />
        </div>
        <div class="rounded-rem tab-pane fade" id="editUserInfo" role="tabpanel" aria-labelledby="editUserInfo-tab">
            <span class="h6 text-gray-700 fw-bold">Edit Profile</span>
            <livewire:settings.profile.edit-profile />
        </div>
        <div class="rounded-rem tab-pane fade" id="Settings" role="tabpanel" aria-labelledby="Settings-tab">
            <span class="h6 text-gray-700 fw-bold">Settings</span>
            <livewire:settings.profile.setting />
        </div>
        <div class="rounded-rem tab-pane fade" id="ChangePassword" role="tabpanel" aria-labelledby="ChangePassword-tab">
            <span class="h6 text-gray-700 fw-bold">Change Password</span>
            <livewire:settings.profile.change-password />
        </div>
        <div class="rounded-rem tab-pane fade" id="Social" role="tabpanel" aria-labelledby="Social-tab">
            <span class="h6 text-gray-700 fw-bold">Social Media</span>
            <livewire:settings.profile.social-media />
        </div>
    </div>
@section('page_style')
<style scoped>
    .benner{
        width:100%
    }
    .profile-container{
        height:120px;
        padding-left:3rem;
        margin-top:0.4rem;
    }
    .user-info{
        position:relative;
        bottom:5px;
        width:100%;
    }
    .profile-links{
        border:0;
        border-bottom:2px solid #fff;
    }
    .profile-links:hover,.profile-links:focus,.profile-links.active{
        color:var(--ex-blue-400) !important;
        border-bottom:2px solid var(--ex-blue-400);
    }
</style>
@endsection
@section('page_script')
<script>

$('.eyeToPassword').click(function(){
    if ($('.newPasswordFeild').attr('type') == 'password') {
        $('.newPasswordFeild').attr('type','text')
        $('#eye1').removeClass('fa-eye')
        $('#eye2').removeClass('fa-eye')
        $('#eye1').addClass('fa-eye-slash')
        $('#eye2').addClass('fa-eye-slash')
    }else{
        $('.newPasswordFeild').attr('type','password')
        $('#eye1').removeClass('fa-eye-slash')
        $('#eye2').removeClass('fa-eye-slash')
        $('#eye1').addClass('fa-eye')
        $('#eye2').addClass('fa-eye')
    }
})
function restore_default() {
    const restore_default = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-red-200 mx-1',
        cancelButton: 'btn btn-gray-300 mx-1'
    },
    buttonsStyling: false
    })

    restore_default.fire({
        html:'<h5 class="mt-2 mb-1 text-red-500">Are you Sure you want to Restore the Default settings ?</h5><br><span class="text-muted">You won\'t be able to revert this !!</span> ',
        showCancelButton: true,
        confirmButtonText: 'Restore',
        cancelButtonText: 'Cancel',
        focusConfirm: false,
    }).then((result) => {
    if (result.isConfirmed) {
        Livewire.emit('restore_default')
    }
    })

}
</script>
@endsection
</div>
