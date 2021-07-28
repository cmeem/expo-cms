
{{-- profile offcanvas --}}
<div
class="offcanvas offcanvas-end rounded-l-rem"
data-bs-keyboard="true"
tabindex="-1"
id="ProfileOffcanvas"
aria-labelledby="ProfileOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold" id="ProfileOffcanvasLabel">{{ __('Profile') }}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Try scrolling the rest of the page to see this option in action.</p>
  </div>
</div>

{{-- notifications offcanvas --}}
<div
class="offcanvas offcanvas-end rounded-l-rem"
data-bs-keyboard="true"
tabindex="-1"
id="NotificationOffcanvas"
aria-labelledby="NotificationOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold" id="offcanvasWithBackdropLabel">{{ __('Notifications') }}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>.....</p>
  </div>
</div>

{{-- quick actions offcanvas --}}
<div
class="offcanvas offcanvas-end rounded-l-rem"
data-bs-keyboard="true"
tabindex="-1"
id="SearchOffcanvas"
aria-labelledby="SearchOffcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold" id="offcanvasWithBothOptionsLabel">{{ __('Search') }}</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
      <!-- main navbar left --buttons-- -->
    <div class="justify-content-center mb-2">
        <input type="search" id="offcanvanSearch" class="form-control py-3 border-0 rounded-rem shadow-sm" placeholder="Search...">
    </div>

  </div>
</div>
