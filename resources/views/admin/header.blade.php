<div class="header">
    <h1>Dashboard Admin Agrowisata</h1>
    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn" style="border: none; cursor: pointer;">Logout</button>
    </form>
</div>
