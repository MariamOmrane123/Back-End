@section('content')
    <h1>Produits</h1>
    @if(count($produits)>1)
        @foreach($produits as $produit)
            <div class="well">
                <h3>{{$produit->label}}</h3>
            </div>
        @endforeach
    @else
        <p>No produits found</p>
    @endif
@endsection
