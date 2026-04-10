@extends('layouts.app')

@section('style')
<style>
    /* أنيميشن الظهور */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-card {
        animation: fadeInUp 0.6s ease-out forwards;
        opacity: 0;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    /* ستايل البطاقات المطور */
    .profile-card {
        background: white;
        border: 1px solid rgba(74, 78, 53, 0.1); /* olive transparency */
        border-radius: 24px;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(74, 78, 53, 0.1);
    }

    .stat-icon {
        background: var(--sidr-cream);
        color: var(--sidr-olive);
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .admin-badge {
        background: var(--sidr-gold);
        color: white;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: bold;
        text-transform: uppercase;
    }

    .user-badge {
        background: var(--sidr-olive);
        color: white;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="min-h-screen py-8" dir="ltr">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-6 animate-card">
        <a href="{{ route('home') }}" class="btn-back group">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="group-hover:-translate-x-1 transition-transform">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            <span>Back to Store</span>
        </a>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="profile-card p-6 mb-8 animate-card delay-1 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-6 flex-col md:flex-row text-center md:text-left">
                <div class="relative">
                    <div class="w-24 h-24 rounded-2xl flex items-center justify-center text-white text-4xl font-bold shadow-inner"
                         style="background: linear-gradient(135deg, var(--sidr-olive), var(--sidr-wood))">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="absolute -bottom-2 -right-2">
                        @if(Auth::user()->role === 'admin')
                            <span class="admin-badge shadow-sm">Admin</span>
                        @else
                            <span class="user-badge shadow-sm">Member</span>
                        @endif
                    </div>
                </div>
                <div>
                    <h1 class="text-3xl font-bold" style="color: var(--sidr-olive)">{{ Auth::user()->name }}</h1>
                    <p class="text-gray-500">Joined Sidr on {{ Auth::user()->created_at->format('F Y') }}</p>
                </div>
            </div>

            <div class="flex gap-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-6 py-3 rounded-xl border-2 border-red-100 text-red-500 font-bold hover:bg-red-50 transition-all flex items-center gap-2">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 space-y-6 animate-card delay-2">
                <div class="profile-card p-6">
                    <h3 class="font-bold text-lg mb-6 flex items-center gap-2" style="color: var(--sidr-olive)">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Profile Details
                    </h3>
                    <div class="space-y-6">
                        <div class="group">
                            <span class="block text-xs uppercase tracking-widest text-gray-400 mb-1">Email Address</span>
                            <span class="font-medium text-gray-800">{{ Auth::user()->email }}</span>
                        </div>
                        <div>
                            <span class="block text-xs uppercase tracking-widest text-gray-400 mb-1">Account Security</span>
                            <span class="text-sm text-green-600 flex items-center gap-1">
                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                                Verified Account
                            </span>
                        </div>
                        <a href="{{ route('profile.edit') }}" 
                           class="block w-full text-center py-3 rounded-xl font-bold transition-all"
                           style="background: var(--sidr-cream); color: var(--sidr-olive); border: 1px solid var(--sidr-olive)">
                           Edit Profile Settings
                        </a>
                    </div>
                </div>

                <div class="profile-card p-6 text-white overflow-hidden relative" style="background: var(--sidr-olive)">
                    <div class="relative z-10">
                        <h4 class="font-bold mb-2">Need Assistance?</h4>
                        <p class="text-sm opacity-80 mb-4">Our team is available 24/7 to help with your orders.</p>
                        <a href="#" class="inline-block px-4 py-2 rounded-lg text-sm font-bold bg-white" style="color: var(--sidr-olive)">
                            Contact Support
                        </a>
                    </div>
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 rounded-full opacity-10 bg-white"></div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6 animate-card delay-3">
                
                @if (Auth::user()->role === 'admin')
                    {{-- ADMIN VIEW: Dashboard Focus --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="profile-card p-8 flex flex-col items-center text-center group cursor-pointer border-2 border-transparent hover:border-yellow-500" 
                             style="border-color: var(--sidr-gold)">
                            <div class="w-16 h-16 rounded-full mb-4 flex items-center justify-center bg-yellow-50" style="color: var(--sidr-gold)">
                                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2" style="color: var(--sidr-olive)">Manage Orders</h3>
                            <p class="text-sm text-gray-500 mb-6">Review, update, and track all customer orders from one place.</p>
                            <a href="{{ route('admin.orders.index') }}" class="w-full py-3 rounded-xl text-white font-bold" style="background: var(--sidr-gold)">
                                Go to Dashboard
                            </a>
                        </div>

                        <div class="profile-card p-8 flex flex-col items-center text-center opacity-60">
                            <div class="w-16 h-16 rounded-full mb-4 flex items-center justify-center bg-gray-100 text-gray-400">
                                <svg width="32" height="32" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">User Directory</h3>
                            <p class="text-sm text-gray-500">Feature coming soon: Manage and view all registered customers.</p>
                        </div>
                    </div>
                @else
                    {{-- USER VIEW: Shopping Stats Focus --}}
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('orders.index') }}" class="profile-card p-6 flex flex-col items-center group">
                            <div class="stat-icon group-hover:scale-110 transition-transform mb-3">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            </div>
                            <span class="text-3xl font-black" style="color: var(--sidr-olive)">{{ $activeOrdersCount ?? 0 }}</span>
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Active Orders</span>
                        </a>

                        <a href="{{ route('cart.index') }}" class="profile-card p-6 flex flex-col items-center group">
                            <div class="stat-icon group-hover:scale-110 transition-transform mb-3">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <span class="text-3xl font-black" style="color: var(--sidr-olive)">{{ $cartItemsCount ?? 0 }}</span>
                            <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Items in Cart</span>
                        </a>
                    </div>

                    <div class="profile-card p-12 text-center border-dashed border-2 flex flex-col items-center">
                        <div class="w-20 h-20 mb-6 rounded-full bg-gray-50 flex items-center justify-center text-gray-300">
                             <svg width="40" height="40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-800">Ready to explore?</h3>
                        <p class="text-gray-500 max-w-xs mx-auto mb-8">Your recent activity will appear here once you start shopping our collection.</p>
                        <a href="/" class="px-8 py-3 rounded-xl text-white font-bold transition-transform hover:scale-105 shadow-lg" style="background: var(--sidr-olive)">
                            Start Shopping Now
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection