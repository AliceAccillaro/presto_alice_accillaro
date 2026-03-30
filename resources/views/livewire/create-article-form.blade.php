@if (session()->has('message'))
    <div class="alert alert-success text-center">
        {{ session('message') }}
    </div>
@endif

<form class="bg-body-tertiary shadow rounded p-5 my-5" wire:submit.prevent="save">
    
    <div class="mb-3">
        <label class="form-label">Titolo:</label>
        <input type="text" class="form-control" wire:model="title">
        @error('title')
            <p class="fst-italic text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Descrizione:</label>
        <textarea class="form-control" wire:model="description"></textarea>    
        @error('description')
            <p class="fst-italic text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Prezzo:</label>
        <input type="text" class="form-control" wire:model="price">
        @error('price')
            <p class="fst-italic text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <select class="form-select" wire:model="category">
            <option disabled selected>Seleziona una categoria</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category')
            <p class="fst-italic text-danger">{{ $message }}</p>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-dark">Crea</button>
    </div>
</form>