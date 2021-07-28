<div class="">
    <div class="mt-5 pb-5 row border-bottom">
        <div class="col-6 col-md-3 col-lg-2 d-flex flex-column text-gray-500 gap-5" >
            <span>Full Name</span>
            <span>Username</span>
            <span>Email</span>
            <span>Phone</span>
            <span>Created At</span>
            <span>Status</span>
        </div>
        <div class="col-6 d-flex flex-column text-gray-800 fw-bold gap-5" >
            <span>{{ auth()->user()->fullname }}</span>
            <span>{{ auth()->user()->username }}</span>
            <span>{{ auth()->user()->email }}
                @if(auth()->user()->email_verified_at)
                 <span class="bg-green-100 text-green-500 px-2 rounded-5 fw-light" style="font-size: 14px">verified</span>
                @endif
            </span>
            <span>{{ auth()->user()->phone }}</span>
            <span>{{ auth()->user()->created_at->format('d/M/Y') }}</span>
            <span>
                @if(auth()->user()->status == "active")
                    <span class="bg-green-100 text-green-500 px-2 rounded-4 fw-light" style="font-size: 14px">Active</span>
                @else
                    <span class="bg-red-100 text-red-500 px-2 rounded-4 fw-light" style="font-size: 14px">Inactive</span>
                @endif
            </span>
        </div>
    </div>
    <div class="mt-5 pb-5 row">
        <div class="col-6 col-md-3 col-lg-2 d-flex flex-column text-gray-500 gap-5 " >
            <span><i class="text-blue-400 fab fa-twitter"></i>&nbsp; twitter</span>
            <span><i class="text-pink-600 fab fa-instagram"></i>&nbsp; instagram</span>
            <span><i class="text-blue-700 fab fa-facebook"></i>&nbsp; facebook</span>
            <span><i class="text-red-600 fab fa-youtube"></i>&nbsp; youtube</span>
            <span><i class="text-gray-800 fab fa-github"></i>&nbsp; github</span>
            <span><i style="color: #f87203;" class="fab fa-reddit"></i>&nbsp; reddit</span>
            <span><i class="text-yellow-400 fab fa-goodreads"></i>&nbsp; goodreads</span>
            <span><i class="text-red-600 fab fa-pinterest"></i>&nbsp; pinterest</span>
        </div>
        <div class="col-6 d-flex flex-column text-gray-800 fw-bold gap-5" >
            <a target="_blank" href="https://twitter.com/{{ auth()->user()->twitter }}" class="text-blue-400">{{ auth()->user()->twitter }}</a>
            <a target="_blank" href="https://www.instagram.com/{{ auth()->user()->instagram }}" class="text-pink-600">{{ auth()->user()->instagram }}</a>
            <a target="_blank" href="https://www.facebook.com/{{ auth()->user()->facebook }}" class="text-blue-700">{{ auth()->user()->facebook }}</a>
            <a target="_blank" href="https://www.youtube.com/{{ auth()->user()->youtube }}" class="text-red-600">{{ auth()->user()->youtube }}</a>
            <a target="_blank" href="https://www.github.com/{{ auth()->user()->github }}" class="text-gray-800">{{ auth()->user()->github }}</a>
            <a target="_blank" href="https://www.reddit.com/user/{{ auth()->user()->reddit }}" style="color: #f87203;">{{ auth()->user()->reddit }}</a>
            <a target="_blank" href="https://www.goodreads.com/author/show{{ auth()->user()->goodreads }}" class="text-yellow-400">{{ auth()->user()->goodreads }}</a>
            <a target="_blank" href="https://www.pinterest.com/{{ auth()->user()->pinterest }}" class="text-red-600">{{ auth()->user()->pinterest }}</a>
        </div>
    </div>
</div>
