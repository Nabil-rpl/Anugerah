<form action="{{ route('login.process') }}" method="POST">
    @csrf

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit">Login</button>

    @error('email')
        <p style="color:red">{{ $message }}</p>
    @enderror
</form>
