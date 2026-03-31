<x-layout>

<div class="container my-5">

    <h2 class="mb-4">
        Articoli nella categoria: {{ $category->name }}
    </h2>

    <div class="row">

        @forelse ($articles as $article)
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">

                    <div class="card-body">
                        <h5>{{ $article->title }}</h5>
                        <p>{{ $article->description }}</p>
                        <p><strong>{{ $article->price }} €</strong></p>
                    </div>

                </div>
            </div>
        @empty
            <p>Nessun articolo in questa categoria.</p>
        @endforelse

    </div>

</div>

</x-layout>