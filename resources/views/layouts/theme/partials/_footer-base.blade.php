<!-- begin:: Footer -->
<div class="kt-footer kt-grid__item" id="kt_footer">
    <div class="kt-footer__copyright">2019&nbsp;&copy;&nbsp;<a href="https://hjelmdal.dk" target="_blank" class="kt-link">Pixel8</a>&nbsp;&nbsp; @if($user && $user->hasRole("super-admin")) {{ "Version: " . Helpers::gitVersion()->getShortVersion() }} @endif</div>
    <div class="kt-footer__menu"><a href="/" target="_blank" class="kt-link">About</a><a href="/" target="_blank" class="kt-link">Team</a><a href="/" target="_blank" class="kt-link">Contact</a></div>
</div>
<!-- end:: Footer -->
