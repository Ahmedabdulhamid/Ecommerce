<h1 class="text-center mt-5">{{ $page->getTranslation('title', app()->getLocale()) }}</h1>
       <div class="container d-flex justify-content-center">
        {!!$page->getTranslation('content',app()->getLocale())!!}
       </div>
