 <header class="masthead" @if($headerImage!='home' and $headerImage!='contact') style="background-image: url('{{ Storage::url($headerImage) }}')"@endif style="background-image: url('{{ asset('blogStyle') }}/assets/img/{{ $headerImage }}.jpg')">
     <div class="container position-relative px-4 px-lg-5">
         <div class="row gx-4 gx-lg-5 justify-content-center">
             <div class="col-md-10 col-lg-8 col-xl-7">
                 <div class="site-heading">
                     <h1>{{ $headerTitle }}</h1>
                     <h2 class="subheading">{{ $headerInfo }}</h2>
                     <span class="meta">{{ $postBy }}</span>
                 </div>
             </div>
         </div>
     </div>
 </header>
