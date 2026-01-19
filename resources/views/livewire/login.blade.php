<div>
    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <div class="login-card animate__fadeIn">
                    <h2>Login Admin</h2>

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form wire:submit="login">
                        <x-input model="email" label="Email" type="email" placeholder="Masukkan email"
                            :description="$errors->has('email') ? $errors->first('email') : null" />
                        <x-input model="password" label="Password" type="password" placeholder="Masukkan password"
                            :description="$errors->has('password') ? $errors->first('password') : null" />
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                    </form>

                    <div class="text-center mt-3">
                        <span class="text-muted">Belum punya akun?</span>
                        <a href="{{ route('register') }}" wire:navigate class="text-primary">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>