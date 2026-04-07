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

    <div class="mb-3">
        <label class="form-label">Immagini:</label>
        <input 
            type="file" 
            wire:model="temporary_images" 
            multiple
            class="form-control shadow @error('temporary_images.*') is-invalid @enderror"
        >

        @error('temporary_images.*')
            <p class="fst-italic text-danger">{{ $message }}</p>
        @enderror
    </div>

    @if (!empty($temporary_images))
        <div class="row">
            <div class="col-12">
                <p>Photo preview:</p>

                <div class="row border border-success rounded shadow py-4">
                    @foreach ($temporary_images as $key => $image)
                        <div class="col d-flex flex-column align-items-center my-3">
                            <div 
                                class="img-preview mx-auto shadow rounded"
                                style="width:120px; height:120px; background-size:cover; background-position:center; background-image: url('{{ $image->temporaryUrl() }}');">
                            </div>
                            <button type="button" class="btn btn-sm btn-danger mt-2" wire:click="removeImage({{ $key }})">X</button>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    @endif

    <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-dark">Crea</button>
    </div>

</form>