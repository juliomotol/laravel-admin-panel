<footer class="footer">
    @if ($footer ?? false)
        {{ $footer }}
    @else
        <div>
            &copy; 2022.
        </div>
        <div class="ms-auto">
            🔨 by <a href="https://github.com/juliomotol">Julio Motol</a> and 🎨 by <a href="https://coreui.io">CoreUI
            </a>
        </div>
    @endif
</footer>
