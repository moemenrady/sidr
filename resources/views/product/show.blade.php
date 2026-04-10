@extends('layouts.app')

@section('title', $product->name)

@section('style')

    <style>
        /* باليتة الألوان (تقدر تنقلها لملف app.css لو حابب تطبقها على الموقع كله) */
        :root {
            --bg-soft: #F9F6F0;
            /* لون كريمي فاتح جداً ومريح للعين */
            --text-main: #2C332A;
            /* لون رمادي غامق مايل للزيتي (أفضل من الأسود الصريح) */
            --olive-dark: #4A5D23;
            /* زيتي غامق وفخم للزراير الأساسية */
            --olive-hover: #38471A;
            /* زيتي أغمق لتأثير مرور الماوس */
            --sage: #8A9A5B;
            /* أخضر مريمية فاتح للسعر والحدود */
            --cream: #E8E4D9;
            /* لون كريمي للزراير الثانوية */
            --error-muted: #D9534F;
            /* أحمر هادي لزرار الإلغاء */
        }

        body {
            background-color: var(--bg-soft);
            color: var(--text-main);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            padding: 40px;
            max-width: 1200px;
            margin: auto;
        }

        /* مراجعة الصور */
        .product-gallery {
            display: flex;
            gap: 15px;
        }

        .thumbnail-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .thumbnail-list img {
            width: 80px;
            height: 100px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 8px;
            /* حواف ناعمة */
            transition: all 0.3s ease;
            opacity: 0.6;
        }

        .thumbnail-list img:hover {
            opacity: 1;
        }

        .thumbnail-list img.active {
            border-color: var(--olive-dark);
            opacity: 1;
            transform: scale(1.05);
            /* تكبير بسيط للصورة النشطة */
        }

        .main-image-container {
            flex-grow: 1;
            position: relative;
            overflow: hidden;
            background: #fff;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--cream);
            border-radius: 12px;
            /* حواف ناعمة */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            /* ظل خفيف يبرز الصورة */
        }

        .main-image-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
            cursor: zoom-in;
        }

        /* تفاصيل المنتج */
        .product-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
        }

        .product-details h1 {
            font-size: 2.8rem;
            color: var(--text-main);
            margin: 0;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .price-section {
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--olive-dark);
            /* اللون الغامق بيخلي السعر أوضح */
            background: #fff;
            padding: 10px 15px;
            border-radius: 8px;
            display: inline-block;
            width: fit-content;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .quantity-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .qty-btn {
            background: var(--cream);
            color: var(--text-main);
            border: 1px solid #ccc;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            /* زراير مدورة شكلها أشيك */
            cursor: pointer;
            font-size: 1.2rem;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: var(--sage);
            color: #fff;
            border-color: var(--sage);
        }

        #quantity {
            width: 60px;
            height: 40px;
            text-align: center;
            border: 1px solid var(--sage);
            border-radius: 8px;
            background: #fff;
            font-weight: bold;
            font-size: 1.1rem;
            color: var(--text-main);
        }

        .btn-action {
            padding: 16px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        /* زر الإضافة للسلة */
        .btn-add {
            background: transparent;
            color: var(--olive-dark);
            border: 2px solid var(--olive-dark);
        }

        .btn-add:hover {
            background: var(--olive-dark);
            color: #fff;
        }

        /* زر الشراء السريع */
        .btn-buy {
            background: var(--olive-dark);
            color: #fff;
            box-shadow: 0 4px 15px rgba(74, 93, 35, 0.3);
            /* ظل بنفس لون الزرار */
        }

        .btn-buy:hover {
            background: var(--olive-hover);
            transform: translateY(-2px);
            /* حركة خفيفة لفوق */
            box-shadow: 0 6px 20px rgba(74, 93, 35, 0.4);
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(44, 51, 42, 0.7);
            /* خلفية ضبابية غامقة للتركيز على المودال */
            backdrop-filter: blur(4px);
        }

        .modal-content {
            padding: 40px 30px;
            background-color: #fff;
            border-radius: 16px;
            max-width: 400px;
            margin: 10% auto;
            /* عشان يكون متمركز صح */
            text-align: center;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-title {
            font-size: 24px;
            color: var(--text-main);
            font-weight: 800;
            margin-bottom: 10px;
        }

        .modal-text {
            font-size: 16px;
            color: #666;
            margin-bottom: 25px;
        }

        .modal-content input {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: 0.3s;
            box-sizing: border-box;
            /* عشان الـ padding ميخربش العرض */
        }

        .modal-content input:focus {
            border-color: var(--sage);
            outline: none;
            box-shadow: 0 0 0 3px rgba(138, 154, 91, 0.2);
        }

        .btn-cancel {
            margin-top: 15px;
            border: none;
            background: none;
            cursor: pointer;
            color: var(--error-muted);
            font-weight: bold;
            transition: 0.3s;
            padding: 10px;
            width: 100%;
            border-radius: 8px;
        }

        .btn-cancel:hover {
            background: #fdf2f2;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .product-container {
                grid-template-columns: 1fr;
                padding: 20px;
                gap: 20px;
            }

            .product-gallery {
                flex-direction: column-reverse;
            }

            .thumbnail-list {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 10px;
                /* مساحة للسكرول */
            }

            .thumbnail-list img {
                width: 70px;
                height: 70px;
            }

            .main-image-container {
                height: 350px;
            }

            .product-details h1 {
                font-size: 2rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="back-nav">
        <a href="javascript:history.back()" class="btn-back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Back
        </a>
    </div>
    <div class="product-container">

        <div class="product-gallery">
            <div class="thumbnail-list">

                @foreach ($product->images as $img)
                    <img src="{{ asset('storage/' . $img->image) }}" onclick="changeMainImage(this)"
                        class="{{ $loop->first ? 'active' : '' }}">
                @endforeach
            </div>
            <div class="main-image-container" id="zoom-container">
                <img id="main-product-img" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
        </div>

        <div class="product-details">
            <h1>{{ $product->name }}</h1>

            <div class="price-section">
                LE <span id="totalPrice">{{ number_format($product->price, 2) }}</span>
            </div>


            <div class="quantity-wrapper">
                <button class="qty-btn" onclick="updateQty(-1)">-</button>
                <input type="number" id="quantity" value="1" readonly>
                <button class="qty-btn" onclick="updateQty(1)">+</button>
            </div>

            <button class="btn-action btn-add" onclick="addToCart()">Add To Cart</button>
            <button class="btn-action btn-buy" onclick="buyNow()">Buy It Now</button>
            <input type="hidden" id="productId" value="{{ $product->id }}">
        </div>
    </div>




    <script>
        const basePrice = {{ $product->price }};

        // Zoom Logic
        const container = document.getElementById('zoom-container');
        const img = document.getElementById('main-product-img');

        container.addEventListener('mousemove', (e) => {
            const x = e.clientX - container.offsetLeft;
            const y = e.clientY - container.offsetTop;
            img.style.transformOrigin = `${x}px ${y}px`;
            img.style.transform = "scale(2)";
        });

        container.addEventListener('mouseleave', () => {
            img.style.transform = "scale(1)";
        });

        // Gallery Logic
        function changeMainImage(element) {
            img.src = element.src;
            document.querySelectorAll('.thumbnail-list img').forEach(i => i.classList.remove('active'));
            element.classList.add('active');
        }



        function updateQty(val) {
            const qtyInput = document.getElementById('quantity');
            const priceEl = document.getElementById('totalPrice');

            let qty = parseInt(qtyInput.value);
            qty = Math.max(1, qty + val);
            qtyInput.value = qty;

            const total = basePrice * qty;
            priceEl.textContent = total.toFixed(2);
        }



        function getPayload() {
    return {
        product_id: document.getElementById('productId').value,
        quantity: document.getElementById('quantity').value,
        options: {
            height: null,
            weight: null
        }
    };
}

// Add To Cart
function addToCart() {
    fetch('/cart/api-add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify(getPayload())
    })
    .then(async res => {
        if (!res.ok) {
            const error = await res.text();
            console.error("SERVER ERROR:", error);
            throw new Error("Request failed");
        }
        return res.json();
    })
    .then(data => {
        showSnackbar("Added to cart successfully", "success");
    })
    .catch(err => {
        console.error(err);
        showSnackbar("Something went wrong", "error");
    });
}

// Buy Now
function buyNow() {
    fetch('/cart/api-add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify(getPayload())
    })
    .then(async res => {
        if (!res.ok) {
            const error = await res.text();
            console.error(error);
            throw new Error("Request failed");
        }
        return res.json();
    })
    .then(() => {
        window.location.href = "/checkout";
    })
    .catch(err => {
        console.error(err);
        showSnackbar("Something went wrong", "error");
    });
}
    
    </script>
@endsection
