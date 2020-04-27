<footer class="footer">
    <div class="container-fluid">
        <div class="copyright copyright-first">
            Copyright &copy; {{ now()->year }} {{ _( 'All rights reserved.') }}            
        </div>
        <div class="copyright">
            {{ _('This is a free service provided by ' )}}
            <a href="https://sterling.ng" target="_blank">
                {{ _( 'Sterling Bank PLC,' ) }}<img src="{{ asset('white') }}/img/brand/sterling_bank.svg" alt="Sterling Bank">
            </a>
            <a href="https://sterling.ng" target="_blank">
                {{ _( 'Giving,' ) }}<img src="{{ asset('white') }}/img/brand/giving_logo.png" alt="Giving">
            </a> 

            {{ _( ' and ' ) }}
            <a href="https://digitalwebglobal.com" target="_blank">
                {{ _( 'Digitalweb Application Development Limited.' ) }}<img src="{{ asset('white') }}/img/brand/dw_logo.png" alt="Digitalweb AD Limited">
            </a>
        </div>
    </div> 
</footer>
