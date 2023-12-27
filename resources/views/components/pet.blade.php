<x-form class="col-md-4 mb-3">
    <div class="card{{ !$pet->isApproved() ? ' not-approved' : '' }}" style="width: 22rem;">

        <div class="img-container">
            <img src="{{ asset($pet->images->firstWhere('size', '350x200')->path) }}" class="card-img-top img-fluid" alt="{{ $pet->name }}">
        </div>

        <div class="card-body">
            <h5 class="card-title">{{ $pet->name }}</h5>
            <p class="card-text">Порода:   {{ $pet->breed }}</p>
            <a href="{{ route('pets.show', $pet->id) }}" class="btn btn-primary">Детальніше</a>
        </div>

    </div>
</x-form>

<style>
    .img-container {
        height: 200px;
        overflow: hidden;
    }

    .img-container img {
        width: 100%;
        height: auto;
    }

    .card.not-approved {
        border: 2px solid red;
    }
</style>
