<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email">
    <button type="submit">Send Password Reset Link</button>
</form>
