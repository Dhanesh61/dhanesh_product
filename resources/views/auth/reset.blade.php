<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" value="{{ $email }}" required autocomplete="email" placeholder="Enter your email">
    <input type="password" name="password" required autocomplete="new-password" placeholder="Enter your new password">
    <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your new password">
    <button type="submit">Reset Password</button>
</form>
