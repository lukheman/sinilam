<div>
    <!-- Register Section -->
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <div class="login-card animate__fadeIn">
                    <h2>Daftar Akun</h2>

                    <form wire:submit="register">
                        <x-input model="name" label="Nama" type="text" placeholder="Masukkan nama lengkap"
                            :description="$errors->has('name') ? $errors->first('name') : null" />
                        <x-input model="email" label="Email" type="email" placeholder="Masukkan email"
                            :description="$errors->has('email') ? $errors->first('email') : null" />
                        <x-input model="password" label="Password" type="password" placeholder="Masukkan password"
                            :description="$errors->has('password') ? $errors->first('password') : null" />
                        <x-input model="password_confirmation" label="Konfirmasi Password" type="password"
                            placeholder="Masukkan ulang password" :description="$errors->has('password_confirmation') ? $errors->first('password_confirmation') : null" />
                        <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    </form>

                    <div class="text-center mt-3">
                        <span class="text-muted">Sudah punya akun?</span>
                        <a href="{{ route('login') }}" wire:navigate class="text-primary">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>