<div class="col-5">
    @if (isset($message))
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @endif
    <form wire:submit="login">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="username" name="username" wire:model="username" class="form-control" id="username">
            @error('username') <span class="error text-danger">{{ $message }} </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" wire:model="password" class="form-control" id="exampleInputPassword1">
            @error('password') <span class="error text-danger">{{ $message }} </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Masuk</button>
    </form>
</div>