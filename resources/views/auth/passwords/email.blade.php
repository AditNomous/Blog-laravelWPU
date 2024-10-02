<form method="POST" action="{{ route('password.email') }}">
    @csrf
    <div>
        <label>Email:</label>
        <input type="email" name="email" required autofocus>
    </div>
    <button type="submit">Send Password Reset Link</button>
</form>
