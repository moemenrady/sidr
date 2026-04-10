@push('styles')
    <style>
        /* ====== Collections Section ====== */
        .collections-section {
            padding: 80px 5%;
            background: var(--sidr-cream);

        }

        .collection-wrapper {
            margin-bottom: 100px;
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.8s ease-out;
        }

        .collection-wrapper.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ====== Collection Header ====== */
        .collection-header.center-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .collection-header.center-header h2 {
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 700;
            color: var(--sidr-olive);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .collection-header.center-header .view-all {
            display: inline-block;
            font-size: 16px;
            color: var(--sidr-gold);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .collection-header.center-header .view-all:hover {
            color: var(--sidr-olive);
            transform: translateX(5px);
        }

        /* ====== View All Button ====== */
        .view-all {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            border: 1px solid var(--sidr-gold);
            border-radius: 30px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.3s ease;
        }

        .view-all span {
            transition: transform 0.3s ease;
        }

        .view-all:hover {
            background: var(--sidr-gold);
            color: #fff;
        }

        .view-all:hover span {
            transform: translateX(4px);
        }

        /* ====== Products Row ====== */
        .products-row {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding: 10px 0 30px 0;
            scrollbar-width: none;
            /* Firefox */
            position: relative;
        }

        .products-row::-webkit-scrollbar {
            display: none;
        }

        .product-card {
            flex: 0 0 calc(25% - 12px);
            min-width: calc(25% - 12px);
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            border-bottom: 4px solid var(--sidr-gold);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .product-image-container {
            width: 100%;
            aspect-ratio: 3/4;
            overflow: hidden;
            background: #f3f3f3;
        }

        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card:hover img {
            transform: scale(1.08);
        }

        .product-info {
            padding: 16px 18px 20px;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .product-info h3 {
            font-size: 15px;
            font-weight: 500;
            line-height: 1.4;
        }

        .product-info .price {
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            opacity: 0.85;
            color: var(--sidr-wood);
        }

        .product-card p {
            color: var(--sidr-olive);
            font-weight: bold;
        }

        /* ====== Responsive ====== */
        @media (max-width: 992px) {
            .product-card {
                flex: 0 0 calc(45% - 10px);
                min-width: calc(45% - 10px);
            }
        }

        @media (max-width: 480px) {
            .product-card {
                flex: 0 0 calc(80% - 10px);
                min-width: calc(80% - 10px);
            }
        }

        /* ====== Scroll Buttons ====== */
        .scroll-controls {
            position: relative;
            width: 100%;
        }

        .collection-wrapper:hover .nav-btn {
            opacity: 1;
        }

        .btn-prev {
            left: -20px;
        }

        .btn-next {
            right: -20px;
        }

        .scroll-right,
        .scroll-left {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: var(--sidr-olive);
            color: white;
            border: none;
            font-size: 24px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0.8;
        }

        .scroll-right {
            right: -20px;
        }

        .scroll-left {
            left: -20px;
        }
    </style>
@endpush
