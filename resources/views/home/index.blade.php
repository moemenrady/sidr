@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @include('home.sections.banners')

    <div class="lux-divider"></div>

    @include('home.sections.collections')

    <div class="lux-divider"></div>

    @include('home.sections.offers')

    <div class="lux-divider"></div>

    @include('home.sections.about_us')
    @include('components.search-modal')

    <style>
        /* ===== Ultra Luxury Divider ===== */
        .lux-divider {
            position: relative;
            width: 70%;
            height: 3px;
            margin: 120px auto;

            background: linear-gradient(90deg,
                    transparent,
                    var(--sidr-gold),
                    var(--sidr-cream),
                    var(--sidr-gold),
                    transparent);

            border-radius: 20px;

            box-shadow:
                0 0 10px rgba(189, 167, 37, 0.4),
                0 0 25px rgba(189, 167, 37, 0.2);

            overflow: hidden;
            /* مهم جداً لمنع overflow يسبب scroll */
        }

        .lux-divider::before {
            content: "✦";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) scale(1);
            font-size: 26px;
            color: var(--sidr-gold);
            text-shadow:
                0 0 10px rgba(189, 167, 37, 0.7),
                0 0 20px rgba(189, 167, 37, 0.4);
            animation: centerGlow 2.5s ease-in-out infinite;
        }

        .lux-divider::after {
            content: "";
            position: absolute;
            top: -2px;

            /* العرض الآن يعتمد على العنصر */
            left: -30%;
            width: 60%;
            height: 7px;

            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, 0.8),
                    transparent);

            filter: blur(2px);

            animation: shineMove 3s infinite;
        }

        @keyframes shineMove {
            0% {
                left: -30%;
            }

            100% {
                left: 100%;
                /* ينتهي عند نهاية العنصر فقط */
            }
        }

        @keyframes centerGlow {

            0%,
            100% {
                transform: translate(-50%, -50%) scale(1);
                opacity: 1;
            }

            50% {
                transform: translate(-50%, -50%) scale(1.3);
                opacity: .7;
            }
        }
    </style>
     <script>
        function openSearch() {
            document.getElementById('searchModal').classList.add('active');
            document.getElementById('mainSearchInput').focus();
        }

        function closeSearch() {
            document.getElementById('searchModal').classList.remove('active');
        }

        const input = document.getElementById('mainSearchInput');
        const resultsBox = document.getElementById('mainSearchResults');

        let debounceTimer;

        input.addEventListener('input', (e) => {
            clearTimeout(debounceTimer);

            const query = e.target.value.trim();

            if (query.length < 0) {
                resultsBox.style.display = "none";
                return;
            }

            debounceTimer = setTimeout(async () => {

                const res = await fetch(`/search/results?q=${query}`);
                const data = await res.json();

                let html = '';

                data.products.forEach(p => {
                    html += `
            <div class="search-item" onclick="window.location='/products/${p.id}'">
                <div class="search-type">Product</div>
                <h4>${p.name}</h4>
            </div>
            `;
                });

                data.collections.forEach(col => {
                    html += `
            <div class="search-item" onclick="window.location='/collection/${col.id}'">
                <div class="search-type">Collection</div>
                <h4>${col.name}</h4>
            </div>
            `;
                });

                data.offers.forEach(o => {
                    html += `
            <div class="search-item">
                <div class="search-type">Offer</div>
                <h4>${o.title}</h4>
            </div>
            `;
                });

                resultsBox.innerHTML = html;
                resultsBox.style.display = html ? "block" : "none";

            }, 300);
        });
    </script>
@endsection
