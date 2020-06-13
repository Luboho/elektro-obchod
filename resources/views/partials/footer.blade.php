<footer>

    <div class="container p-3">

        <div class="p-3" id="footer-section1">             
            <p><a href="{{ route('landing-page') }}" class="text-warning">Domov</a></p>
            <p><a href="{{ route('shop.index') }}" class="text-warning">Obchod</a></p>
            <p><a href="#" class="text-warning">O nás</a></p>
            <p><a href="#" class="text-warning">Blog</a></p>
            @guest
                <p><a href="{{ route('register') }}" class="text-warning">Registrovať</a></p>
                <p><a href="{{ route('login') }}" class="text-warning">Prihlásiť</a></p>
            @else 
                <p><a href="{{ route('users.edit') }}" class="text-warning">Môj účet</a></p>
                <p><a href="{{ route('logout') }}" class="text-warning">Odhlásiť</a></p>
            @endguest
            <p><a href="{{ route('cart.index') }}" class="text-warning">Košík</a></p>
        </div>
        
    
        
        @if(!empty(Helper::companyData()))
            <div class="rounded p-1" id="footer-section2" style="color:silver">  
                @foreach(Helper::companyData() as $company)

                    <div class="ml-3">
                        <h5 class="pt-3 font-weight-bold">Kontakt</h5>
                        <p class="ml-2">{!! $company->mobile !!}</p>
                        <p class="ml-2">{!! $company->phone !!}</p>
                        <p class="ml-2">{!! $company->facebook !!}</p>
                    </div>

                    <div class="ml-3">
                        <h5 class="pt-3 font-weight-bold">Otvorené</h5>
                        <p class="ml-2">{!! $company->openHours !!}</p>
                    </div>

                    <div class="ml-3 border-secondary">
                        <h5 class="pt-3 font-weight-bold">Adresa</h5>
                        <p class="ml-2">{!! $company->name !!}</p>
                        <p class="ml-2">{!! $company->street !!}</p>
                        <p class="ml-2">{!! $company->city !!}</p>
                    </div>
                        
                @endforeach
            </div>
        @endif
            
        <div class="contact-create pt-3" id="footer-section3">               
            {{-- @include('contact.create') --}}
        </div>

        <div class="row footer-content" id="footer-section4">
            <div class="made-with ml-2">Made with <i class="fa fa-heart heart"></i> by Luboho Web.</div>
            {{ menu('footer', 'partials.menus.footer') }}
        </div> <!-- end footer-content -->

    </div>

</footer>
