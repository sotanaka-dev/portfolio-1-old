@section('title', 'ResetEmail')

<div class="container-sm">
    <div class="form-group">
        <label class="form-group__label" for="email">メールアドレス</label>
        @error('email')
            <strong class="form-group__error-message">{{ $message }}</strong>
        @enderror
        <input type="email" class="form-input" id="email" autocomplete="email" wire:model.lazy="email" />
    </div>

    <button class="btn btn--lg btn--black" wire:click="resetEmail">確認メールを送信</button>
</div>
