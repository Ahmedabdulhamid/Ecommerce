<!DOCTYPE html>
<html lang="en">

@include('front.layouts.head')>

<body style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9))">
    @include('front.layouts.header')
    <form class="login footer-padding " method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div>
            <x-primary-button>
                {{ __('Resend Verification Email') }}
            </x-primary-button>
        </div>
    </form>

    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
