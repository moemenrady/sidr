<style>
    .brand,
    .hero-nav,
    .hero-icons {
        z-index: 5;
    }

    .hero-banners {
        position: relative;
        width: 100%;
        height: 100vh;
        overflow: hidden;
        background: var(--bg-soft);
    }
.hero-banners img {
    object-fit: cover; /* يغطي كامل الحاوية بدون تشويه */
    height: 100%;
    width: 100%;
}
    .banners-slider {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .banner-slide {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        transform: scale(1.1);
        transition: all 1.2s cubic-bezier(.4, 0, .2, 1);
        cursor: pointer;
    }

    .banner-slide.active {
        opacity: 1;
        transform: scale(1);
        z-index: 2;
    }

    .banner-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.75);
        transition: transform 6s ease;
    }

    .banner-slide.active .banner-image img {
        transform: scale(1.08);
    }

    .banner-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg,
                rgba(0, 0, 0, 0.5),
                rgba(74, 78, 53, 0.4));
    }

    .banner-content {
        position: absolute;
        top: 50%;
        left: 10%;
        transform: translateY(-50%);
        color: white;
        animation: fadeUp 1s ease forwards;
    }

    .banner-title {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 20px;
        letter-spacing: 2px;
    }

    .banner-btn {
        display: inline-block;
        padding: 14px 28px;
        background: var(--sidr-gold);
        color: white;
        text-decoration: none;
        border-radius: 50px;
        transition: 0.4s ease;
        font-weight: bold;
    }

    .banner-btn:hover {
        background: var(--sidr-olive);
        transform: translateY(-3px);
    }

    .banner-dots {
        position: absolute;
        bottom: 30px;
        width: 100%;
        text-align: center;
    }

    .banner-dots .dot {
        display: inline-block;
        width: 12px;
        height: 12px;
        margin: 0 6px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        cursor: pointer;
        transition: 0.3s;
    }

    .banner-dots .dot.active {
        background: var(--sidr-gold);
        transform: scale(1.3);
    }

    /* Animation */
    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(-50%);
        }
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero-banners {
            height: 70vh;
        }

        .banner-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 600px) {
        .hero-banners {
            height: 60vh;
        }

        .banner-content {
            left: 5%;
        }

        .banner-title {
            font-size: 1.5rem;
        }

        .banner-btn {
            padding: 10px 20px;
            font-size: 14px;
        }
    }

    /* ===== Scroll Logo ===== */

    /* ===== Scroll Logo ===== */

    #scroll-logo {

        position: fixed;

        top: -120px;
        /* مخفي فوق */

        right: 40px;

        width: 90px;

        cursor: pointer;

        z-index: 999;

        transition: all .6s cubic-bezier(.4, 0, .2, 1);

        filter: drop-shadow(0 10px 20px rgba(0, 0, 0, .3));

    }


    /* يظهر عند الاسكرول */

    #scroll-logo.show {

        top: 25px;

    }


    /* يختفي */

    #scroll-logo.hide {

        top: -120px;

    }


    /* Hover effect */

    #scroll-logo:hover {

        transform: scale(1.08);

        filter: drop-shadow(0 12px 25px rgba(0, 0, 0, .4));

    }
</style>
{{-- Hero Styles --}}
<style>
    .top-search-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 25px 0 60px;
        z-index: 99999;

        background: linear-gradient(to bottom,
                rgba(43, 46, 38, 0.85) 0%,
                rgba(43, 46, 38, 0.65) 40%,
                rgba(43, 46, 38, 0.0) 100%);

        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .search-wrapper {
        width: 90%;
        max-width: 800px;
        margin: auto;
        position: relative;
    }

    /* Input */

    #mainSearchInput {
        width: 100%;
        padding: 18px 25px;
        border-radius: 50px;
        border: 1px solid rgba(203, 191, 154, 0.3);
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(10px);

        font-size: 16px;
        color: var(--cream);
        outline: none;

        transition: all 0.3s ease;
    }

    #mainSearchInput::placeholder {
        color: rgba(230, 225, 213, 0.6);
    }

    #mainSearchInput:focus {
        border-color: var(--gold-soft);
        box-shadow: 0 0 25px rgba(203, 191, 154, 0.2);
    }

    /* ========================= */
    /* RESULTS DESIGN           */
    /* ========================= */

    .search-results {
        margin-top: 15px;
        border-radius: 20px;
        overflow: hidden;

        background: rgba(43, 46, 38, 0.95);
        backdrop-filter: blur(20px);

        max-height: 400px;
        overflow-y: auto;

        display: none;
        animation: fadeUp .3s ease;
    }

    .search-item {
        padding: 15px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-item:hover {
        background: rgba(203, 191, 154, 0.1);
    }

    .search-item h4 {
        margin: 0;
        font-size: 14px;
        color: var(--cream);
    }

    .search-type {
        font-size: 11px;
        color: var(--gold-soft);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .hero {
        position: relative;
        height: 100vh;
        width: 100%;
        background: var(--olive-dark);
        overflow: hidden;
    }

    /* الصورة الأساسية التي ستظهر بعد انتهاء الانميشن */
    .hero-image-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        animation: fadeIn 0.5s ease forwards 1.8s;
        /* تم تقليل التأخير ليناسب السرعة الجديدة */
    }

    .hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: transparent;
        /* أو امسحه السطر كله */
        z-index: 1;
    }


    .hero-overlay {
        position: relative;
        z-index: 2;
        height: 100%;
        width: 100%;
        padding: 20px;
        display: flex;
        flex-direction: column;
        color: var(--cream);
    }

    .brand {
        position: absolute;
        top: 30px;
        left: 30px;

        font-size: 28px;
        font-family: 'Playfair Display', serif;

        color: var(--sidr-gold);

        opacity: 0;

        animation: navReveal .5s ease forwards .3s;
    }


    .hero-nav {
        position: absolute;
        top: 35px;
        left: 50%;
        transform: translateX(-50%);

        display: flex;
        gap: 25px;

        opacity: 0;

        animation: navReveal .5s ease forwards .45s;
    }



    .brand:hover {
        transform: scale(1.1);
        text-shadow: 0 0 10px rgba(203, 191, 154, 0.5);
    }

  /* Navigation */
.hero-nav {
    position: absolute;
    top: 35px;                 /* فوق الصفحة */
    left: 50%;                 /* نص الصفحة أفقيًا */
    transform: translateX(-50%); /* تعويض نصف العرض ليصبح في الوسط */

    display: flex;
    gap: 25px;

    opacity: 0;

    animation: navReveal .5s ease forwards .45s;
}

.hero-nav a {
    color: white; /* لون النص الأساسي */
    text-decoration: none;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1.5px;

    padding: 8px 18px;
    border-radius: 30px;

    /* Glass Effect */
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);

    border: 1px solid rgba(255, 255, 255, 0.15);

    transition: all .35s cubic-bezier(.4, 0, .2, 1);
    display: inline-block;
    font-weight: 500; /* الوزن الطبيعي للنص */
}

.hero-nav a:hover {
    background: rgba(182, 171, 139, 0.15); /* لمسة جولد خفيفة */
    border-color: var(--gold-soft);
    color: var(--gold-soft);
    font-weight: 700; /* تخلي النص بولد */
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}


    .hero-icons {
        position: absolute;
        top: 35px;
        right: 30px;

        display: flex;
        gap: 22px;

        opacity: 0;

        animation: navReveal .5s ease forwards .6s;
    }

    .hero-icon img {
        width: 25px;
        height: 25px;
        cursor: pointer;
        transition: transform 0.3s, filter 0.3s;

        /* لون أبيض كامل بدل باهت */
        filter: brightness(1) invert(1) opacity(1);
    }

    .hero-icon:hover img {
        transform: scale(1.2);
        filter: brightness(1.2) invert(1) opacity(1);
    }







    /* Hero Title */
    .hero-title {
        position: absolute;
        bottom: 10%;
        left: 30px;
        max-width: 80%;
        font-family: 'Playfair Display', serif;
        font-size: clamp(32px, 8vw, 66px);
        line-height: 1.1;
        opacity: 0;
        animation: fadeUp .8s ease forwards 2.6s;
    }

    .hero-title span {
        color: var(--bg-soft);
        text-shadow: 2px 4px 10px rgba(43, 46, 38, 0.5);
    }

    /* --- Polygon Animation Logic --- */
    .polygon-reveal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        /* تختفي الحاوية بعد 2 ثانية لتسمح بالتفاعل */
        animation: fadeOut 0.2s forwards 2s;
    }

    .polygon-reveal img {
        width: 100vw;
        height: 100vh;
        object-fit: cover;
        clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        transform: scale(0.1) rotate(-15deg);
        opacity: 0;
        /* إجمالي وقت الأنميشن 2 ثانية ليكون أسرع وأكثر حيوية */
        animation: complexReveal 2s cubic-bezier(.22, 1, .36, 1) forwards;
    }

    @keyframes complexReveal {
        0% {
            opacity: 0;
            transform: scale(0.1) rotate(-20deg);
            clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
        }

        /* صدمة البداية أصبحت عند 7.5% بدلاً من 15% (أسرع بالضعف) */
        7.5% {
            opacity: 1;
            transform: scale(0.4) rotate(5deg);
            clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);
        }

        30% {
            transform: scale(0.35) rotate(0deg);
            clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);
        }

        100% {
            transform: scale(1) rotate(0deg);
            /* التمدد الكامل لمقاس الشاشة */
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 0% 100%, 0% 100%);
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            visibility: hidden;
        }
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
        }
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .hero-nav {
            display: none;
        }

        .brand {
            left: 20px;
            top: 20px;
            font-size: 24px;
        }

        .hero-btn {
            right: 20px;
            top: 18px;
            padding: 8px 18px;
            font-size: 12px;
        }

        .hero-title {
            bottom: 15%;
            left: 20px;
            width: 95%;
        }
    }

    .nav-btn {
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        background: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        z-index: 10;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    /* --- تنسيق اللوجو المحدث --- */
    #scroll-logo {
        position: fixed;
        top: 15px;
        /* تقليل المسافة من الأعلى قليلاً للموبايل */
        left: 30px;
        /* مسافة ثابتة من اليسار لضمان عدم خروجه */
        width: 50px;
        /* حجم أصغر قليلاً للموبايل */
        height: auto;
        opacity: 0;
        transition: all 0.5s ease;
        z-index: 100000;
        cursor: pointer;
        pointer-events: none;
        /* لمنع التفاعل معه وهو مخفي */
        transform: translateY(-10px);
        /* يبدأ من أعلى قليلاً */
    }

    #scroll-logo.show {
        opacity: 1;
        transform: translateY(0);
        /* يظهر في مكانه الطبيعي */
        pointer-events: auto;
    }

    #scroll-logo.hide {
        opacity: 0;
        transform: translateY(-20px);
        pointer-events: none;
    }

    /* تعديلات للديسكتوب والشاشات الكبيرة */
    @media (min-width: 769px) {
        #scroll-logo {
            top: 20px;
            left: 40px;
            /* مسافة أكبر قليلاً في الشاشات الكبيرة */
            width: 60px;
        }
    }

    .search-modal {
        position: fixed;
        inset: 0;
        z-index: 999999;
        display: none;
    }

    .search-modal.active {
        display: block;
    }

    .search-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
    }

    /* نخلي السيرش يفضل فوق */
    .modal-search {
        position: relative;
        z-index: 2;
    }

    .search-blur {
        position: absolute;
        inset: 0;
        backdrop-filter: blur(15px);
        background: rgba(0, 0, 0, 0.6);
    }

    .search-content {
        position: relative;
        width: 80%;
        max-width: 600px;
        background: #fff;
        padding: 30px;
        border-radius: 20px;
        z-index: 10000;
    }

   @keyframes navReveal {

    from {
        opacity: 0;
        transform: translate(-50%, -15px);
    }

    to {
        opacity: 1;
        transform: translate(-30%, 0);
    }

}
</style>
