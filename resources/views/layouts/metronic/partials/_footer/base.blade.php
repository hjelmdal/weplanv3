
<!-- begin:: Footer -->
<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
	<div class="kt-container  kt-container--fluid ">
		<div class="kt-footer__copyright">
			{{ date("Y") }}&nbsp;&copy;&nbsp;<a href="https://hjelmdal.dk" target="_blank" class="kt-link" rel="noreferrer">Pixel8</a>
            @if($user && $user->hasRole("super-admin")) {{ ". Version: " . Helpers::gitVersion()->getShortVersion() }} @endif
		</div>
		<div class="kt-footer__menu">
			<a rel="noreferrer"href="https://hjelmdal.dk" target="_blank" class="kt-footer__menu-link kt-link" rel="noreferrer">About</a>
			<a href="https://hjelmdal.dk" target="_blank" class="kt-footer__menu-link kt-link" rel="noreferrer">Team</a>
			<a href="https://hjelmdal.dk" target="_blank" class="kt-footer__menu-link kt-link" rel="noreferrer">Contact</a>
		</div>
	</div>
</div>

<!-- end:: Footer -->
