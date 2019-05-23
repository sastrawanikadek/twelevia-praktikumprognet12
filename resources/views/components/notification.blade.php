<div class="notification {{ session('error') ? 'bg-red visible' : '' }} {{ session('warning') ? 'bg-yellow visible' : '' }} {{ session('success') ? 'bg-green visible' : '' }}">
    <h4 class="notification-message">
        @if (session('error'))
            <i class="fa fa-exclamation-circle"></i>
            {{ session('error') }}
        @endif
        @if (session('warning'))
            <i class="fa fa-warning"></i>
            {{ session('warning') }}
        @endif
        @if (session('success'))
            <i class="fa fa-check"></i>
            {{ session('success') }}
        @endif
    </h4>
</div>