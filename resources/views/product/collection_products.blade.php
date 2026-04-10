@extends('layouts.app')
@section('title', $collectionName)

@section('style')
    <style>
        /* تعريف متغيرات الثيم من ملف الـ layout وتطبيقها على هذا القسم */


        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Arial', sans-serif;
            /* يمكن تغيير الخط حسب تفضيلك */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* تنسيق العنوان الرئيسي */
        .collection-header h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* قسم الفلتر وعدد المنتجات */
        .collection-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(98, 70, 65, 0.1);
            /* خط خفيف لأسفل */
        }

        .controls-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .controls-info span {
            color: var(--light-text-color);
            font-size: 0.9rem;
        }

        .filter-sort-btn {
            color: var(--text-color);
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
            border: none;
            background: none;
        }

        /* شبكة عرض المنتجات */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            /* الافتراضي: 2 في الصف (لشاشات التابلت) */
            gap: 40px 20px;
        }

        /* بطاقة المنتج الفردية */
        .product-card {
            display: flex;
            flex-direction: column;
            text-align: right;
            /* محاذاة النص لليمين */
            position: relative;
        }

        /* قسم الصور */
        .product-image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            /* حواف مستديرة للصور */
            height: 400px;
            /* ارتفاع ثابت للصور للحفاظ على التناسق */
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* لضمان ملء الصورة للمساحة دون تشويه */
            transition: opacity 0.3s ease;
        }

        /* صورة الـ hover (الصورة الثانية) */
        .product-card:hover .hover-image {
            opacity: 1;
        }

        .hover-image {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        /* شارة "Sale" */
        .sale-badge {
            position: absolute;
            bottom: 10px;
            left: 10px;
            /* في اليمين إذا كانت اللغة عربية */
            background-color: var(--primary-color);
            color: var(--bg-color);
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
            z-index: 10;
        }

        /* ------------------------------------------- */
        /* تعديلات لإزالة ستايل اللينك (الخط تحت النص)  */
        /* ------------------------------------------- */

        /* استهداف اللينك الرئيسي وإزالة الخط السفلي */
        .product-link {
            text-decoration: none;
            /* إزالة الخط تحت النص */
            color: inherit;
            /* لضمان أن جميع النصوص داخل اللينك ترث لونها من الـ container */
            display: block;
        }

        /* تفاصيل المنتج (الاسم والسعر) */
        .product-details {
            padding: 10px 0 0;
        }

        /* ستايل اسم المنتج (يستخدم وسم h2 الآن) */
        .product-name {
            color: var(--text-color);
            text-decoration: none;
            /* تأكيد إزالة الخط السفلي */
            font-size: 1.1rem;
            margin-bottom: 5px;
            display: block;
        }

        /* ملاحظة: لا نحتاج إلى .product-details a لأنه غير موجود في الهيكلية الجديدة */

        /* قسم السعر */
        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            /* محاذاة لليسار، عكس اتجاه القراءة العربية */
            margin-top: 5px;
        }

        .original-price {
            font-size: 1rem;
            color: var(--light-text-color);
            text-decoration: line-through;
            font-weight: normal;
            margin-left: 10px;
        }

        .current-price {
            color: var(--primary-color);
            /* السعر الحالي بلون الثيم الأساسي */
        }


        /* زر الخيارات/الإضافة */
        .choose-options-btn {
            display: block;
            width: 100%;
            padding: 12px 20px;
            margin-top: 15px;
            background-color: var(--bg-color);
            /* خلفية فاتحة */
            color: var(--button-border-color);
            /* لون النص والحد الغامق */
            border: 2px solid var(--button-border-color);
            /* حد غامق */
            border-radius: 30px;
            /* حواف مستديرة جداً */
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .choose-options-btn:hover {
            background-color: var(--button-border-color);
            color: var(--bg-color);
        }

        /* تصميم الأيقونات (على افتراض استخدام Font Awesome أو أيقونات SVG) */
        .icon-filter:before {
            content: "\f0b0";
            /* مثال لـ Font Awesome Filter Icon */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
        }

        /* ------------------------------------------- */
        /* Media Queries لتطبيق التجاوبية المطلوبة     */
        /* ------------------------------------------- */

        /* 1. شاشات الموبايل الصغيرة (أقل من 600 بكسل) - عمود واحد */
        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
                /* عمود واحد */
            }

            .collection-header h1 {
                font-size: 2rem;
            }
        }

        /* 2. شاشات التابلت/الموبايل الأكبر (601 بكسل إلى 992 بكسل) - عمودين */
        @media (min-width: 601px) and (max-width: 992px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* 3. شاشات سطح المكتب (أكبر من 993 بكسل) - 3 أعمدة */
        @media (min-width: 993px) {
            .product-grid {
                grid-template-columns: repeat(3, 1fr);
                /* 3 أعمدة متساوية */
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- عنوان المجموعة -->
        <header class="collection-header">
            <h1>{{ $collectionName }}</h1>
        </header>

        <!-- أدوات التحكم والفرز -->
        <div class="collection-controls">
            <div class="controls-info">
                <button class="filter-sort-btn" aria-label="Filter and sort products">
                    <!-- أيقونة فلتر، يمكن استبدالها بأيقونة Font Awesome أو SVG -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 3.5H2l8.5 10.9V20l3-2.5v-3.6L22 3.5z" />
                    </svg>
                    <span>Filter and sort</span>
                </button>
            </div>
            <span>{{ $products->count() }} products</span>
        </div>

        <!-- شبكة عرض المنتجات -->
        <div class="product-grid">
            @foreach ($products as $product)
                <!-- بطاقة المنتج -->
                <div class="product-card">
                    <a href="{{ route('product.show', $product->id ?? '#') }}" class="product-link">
                        <div class="product-image-wrapper">
                            <!-- الصورة الأساسية -->
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="product-image main-image">

                            <!-- صورة الـ Hover (إذا كانت متوفرة) -->
                            @if ($product->hover_image)
                                <img src="{{ asset('storage/' . $product->hover_image) }}" alt="{{ $product->name }} Hover"
                                    class="product-image hover-image">
                            @endif

                            <!-- شارة "Sale" إذا كان هناك تخفيض (افتراضياً: إذا كان السعر أقل من 1650 كمثال) -->
                            @if ($product->price < 1650 && $product->price > 0)
                                <span class="sale-badge">Sale</span>
                            @endif
                        </div>

                        <div class="product-details">
                            <!-- اسم المنتج -->
                            <h2 class="product-name">{{ $product->name }}</h2>

                            <!-- قسم السعر -->
                            <div class="product-price">
                                <!-- السعر المخفض (إذا كان هناك تخفيض) -->
     
                                <!-- السعر الحالي -->
                                <span class="current-price">LE {{ number_format($product->price, 2) }} EGP</span>
                            </div>
                        </div>
                    </a>

                    <!-- زر الخيارات/الإضافة إلى السلة -->
                    <button class="choose-options-btn">
                        Choose options
                    </button>
                </div>
            @endforeach
        </div>
        <!-- نهاية شبكة عرض المنتجات -->

    </div>
@endsection
