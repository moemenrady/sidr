@include('home.styles.banners')

<section id="hero-banners" class="hero-banners">
    <a href="/">
        <div class="brand">SIDR</div>
    </a>
    <nav class="hero-nav">

        <a href="/">Home</a>
        <a href="{{ route('home') }}#collections-section">Collections</a>
        <a href="{{ route('home') }}#offers-section">Offers</a>
        <a href="{{ route('home') }}#about-us-section">About Us</a>
    </nav>
    <div class="hero-icons">
        <a href="{{ route('cart.index') }}" class="hero-icon" title="Cart">
            <img src="{{ asset('icons/cart.svg') }}" alt="Cart">
        </a>
        <a href="javascript:void(0)" class="hero-icon" title="Search" onclick="openSearch()">
            <img src="{{ asset('icons/search.svg') }}" alt="Search">
        </a>
        <a href="{{ route('profile') }}" class="hero-icon" title="Profile">
            <img src="{{ asset('icons/profile.svg') }}" alt="Profile">
        </a>
    </div>


    <img src="{{ asset('sidr_logo.png') }}" alt="Sidr Logo" id="scroll-logo">

    <div class="banners-slider" id="bannersSlider">
        <div class="banners-slider" id="bannersSlider">

            @foreach ($bannarItems as $index => $banner)
                <div class="banner-slide {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}"
                    data-url="{{ route('collection.show', $banner->collection->id) }}">

                    <div class="banner-image">
                        <img src="{{ asset('storage/' . $banner->image) }}"
                            alt="{{ $banner->collection->name }}">
                    </div>

                    <div class="banner-overlay"></div>

                    <div class="banner-content">
                        <h2 class="banner-title">
                            {{ $banner->collection->name }}
                        </h2>

                        <a href="{{ route('collection.show', $banner->collection->id) }}" class="banner-btn">
                            Explore Collection →
                        </a>
                    </div>

                </div>
            @endforeach

        </div>

        <div class="banner-dots">
            @foreach ($bannarItems as $index => $banner)
                <span class="dot {{ $index == 0 ? 'active' : '' }}" data-index="{{ $index }}"></span>
            @endforeach
        </div>

</section>

@include('home.scripts.banners')
@include('home.scripts.scroll-logo')
