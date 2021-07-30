<div
class="offcanvas offcanvas-end rounded-l-rem"
data-bs-keyboard="true"
tabindex="-1"
id="ProfileOffcanvas"
aria-labelledby="ProfileOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold text-gray-700" id="ProfileOffcanvasLabel">{{ __('Profile') }}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="mb-4 d-flex justify-content-center align-items-center">
            <img src="{{ auth()->user()->avatar }}" width="150px" height="150px"class="rounded-circle">
        </div>
        <div class="mb-4 d-flex flex-column gap-1 justify-content-center align-items-center">
            <span class="text-gray-700" style="font-size:1.2rem">{{ auth()->user()->fullname }}</span>
            <span class="text-gray-500">{{ auth()->user()->position }}</span>
        </div>
        <div class="mb-4 d-flex justify-content-around align-items-center">
            <a
            href="/" target="_blank"
            class="btn btn-yellow-100 rounded-circle p-3">
                <i class="fas fa-globe" style="font-size:2rem"></i>
            </a>

            <a
            href="{{ route('admin.profile') }}"
            class="btn btn-green-200 rounded-circle p-3">
                <i class="fas fa-cog" style="font-size:2rem"></i>
            </a>

            <a
            href="{{ route('admin.logout') }}"
            class="btn btn-red-200 rounded-circle p-3">
                <i class="fas fa-sign-out-alt" style="font-size:2rem"></i>
            </a>

        </div>

        <span class="text-gray-500 border-bottom">messages:&#160;&#160;&#160;&#160;&#160; </span>
        <div class="mt-1 d-flex flex-column gap-1 justify-content-center">
            <div role="button" class="card card-body pt-1 message-card">
                <span class="message-type mb-2">message</span>
                <span class="message-content">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, odio.
                </span>
            </div>
            <div role="button" class="card card-body pt-1 message-card">
                <span class="message-type mb-2">message</span>
                <span class="message-content">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, odio.
                </span>
            </div>
            <div role="button" class="card card-body pt-1 message-card">
                <span class="message-type mb-2">message</span>
                <span class="message-content">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, odio.
                </span>
            </div>
        </div>

    </div>
</div>
