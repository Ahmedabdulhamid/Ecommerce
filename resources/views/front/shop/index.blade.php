@section('title',__('front.shop_page'))
<!DOCTYPE html>
<html lang="en">
@include('front.layouts.head')
<style>
      <style>
    a, a:visited, a:active {
    color: black !important; /* خلي اللون ثابت */
}
  </style>

<body style=";@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @include('front.layouts.header')
    @livewireStyles

    <section class="product product-sidebar footer-padding">
        <div class="container">
           @livewire('front.shop-component')
        </div>
    </section>

    @include('front.layouts.footer')

    @include('front.layouts.script')
  @livewireScripts()
</body>

</html>
