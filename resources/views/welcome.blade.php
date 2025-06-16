<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SkillConnect - Connect Through Volunteering</title>
        
        
        <link rel="icon" type="image/png" href="{{ asset('images/hand.png') }}">
            
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <style>
            .gradient-bg { background: linear-gradient(90deg, #3b82f6, #10b981); }
        </style>
    </head>
    <body class="bg-gray-100 font-sans antialiased">
        
        {{-- Guest Navigation --}}
        <nav class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                    <img class="h-12 w-50" src="{{ asset('images/skillconnect-logo.png') }}" alt="SkillConnect Logo">
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 hover:text-blue-600">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <div class="gradient-bg text-white py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row items-center">
                        <div class="md:w-1/2 mb-8 md:mb-0">
                            <h1 class="text-4xl md:text-5xl font-bold mb-4">Make a Difference Together</h1>
                            <p class="text-xl mb-6">Connect with local volunteer opportunities and create meaningful change in your community.</p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('register') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-full font-medium transition duration-300">
                                    Get started
                                </a>
                            </div>
                        </div>
                        <div class="md:w-1/2 relative">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&h=600&q=80" alt="Volunteers working together" class="rounded-lg shadow-xl w-full max-w-md mx-auto">
                            <div class="absolute -bottom-4 -left-4 bg-white p-4 rounded-lg shadow-lg hidden md:block">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 p-3 rounded-full mr-3">
                                        <i class="fas fa-hands-helping text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">1,245+</p>
                                        <p class="text-sm text-gray-600">Active Volunteers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="absolute -top-4 -right-4 bg-white p-4 rounded-lg shadow-lg hidden md:block">
                                <div class="flex items-center">
                                    <div class="bg-green-100 p-3 rounded-full mr-3">
                                        <i class="fas fa-heart text-green-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">568+</p>
                                        <p class="text-sm text-gray-600">Projects Completed</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-16 bg-white">
                <div class="max-w-4xl mx-auto px-4 text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">About
                        <span class="text-3xl font-bold text-blue-600">SkillConnect</span></h2>
                        
                    <p class="text-gray-600 leading-relaxed">
                        SkillConnect was founded on a simple principle: everyone has skills to share, and every community has needs to be met. We bridge that gap by creating a platform where individuals can find meaningful volunteer projects, develop their professional and personal skills, and connect with like-minded peers. Our mission is to empower individuals to create positive change while fostering personal growth and community spirit.
                    </p>
                </div>
            </div>

            <div class="py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12">
                         <h2 class="text-3xl font-bold text-gray-800">Featured Projects</h2>
                         <p class="text-gray-600">Get inspired by opportunities happening right now.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @forelse ($projects as $project)
                            <div class="bg-white rounded-lg shadow-md p-6">
                                <h3 class="font-bold text-xl mb-2">{{ $project->title }}</h3>
                                <p class="text-gray-500 text-sm mb-4">
                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $project->location_address }}
                                </p>
                                <p class="text-gray-700">{{ Str::limit($project->description, 100) }}</p>
                            </div>
                        @empty
                            <p class="md:col-span-3 text-center text-gray-500">No projects to feature at the moment.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="py-16 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold text-gray-800 mb-12">How It Works</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        <div class="feature-item">
                            <i class="fas fa-search text-4xl text-blue-500 mb-4"></i>
                            <h3 class="text-xl font-bold mb-2">Discover</h3>
                            <p class="text-gray-600">Easily search and filter through hundreds of local and remote volunteer projects to find the perfect fit for your skills and interests.</p>
                        </div>
                        <div class="feature-item">
                             <i class="fas fa-hands-helping text-4xl text-blue-500 mb-4"></i>
                            <h3 class="text-xl font-bold mb-2">Connect</h3>
                            <p class="text-gray-600">Connect with non-profits and community leaders, join project teams, and collaborate with peers to make a real impact.</p>
                        </div>
                        <div class="feature-item">
                             <i class="fas fa-chart-line text-4xl text-blue-500 mb-4"></i>
                            <h3 class="text-xl font-bold mb-2">Grow</h3>
                            <p class="text-gray-600">Gain valuable hands-on experience, learn new skills, and build your portfolio, all while contributing to causes you care about.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">What Our Volunteers Say</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&auto=format&fit=crop&w=64&h=64&q=80" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <h4 class="font-medium text-gray-900">Sarah Johnson</h4>
                                    <p class="text-sm text-gray-500">Environmental Volunteer</p>
                                </div>
                            </div>
                            <p class="text-gray-600">"SkillConnect made it so easy to find meaningful volunteer opportunities in my area. I've met amazing people and made a real difference in my community."</p>
                            <div class="mt-4 flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=64&h=64&q=80" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <h4 class="font-medium text-gray-900">Michael Chen</h4>
                                    <p class="text-sm text-gray-500">Data Engineer</p>
                                </div>
                            </div>
                            <p class="text-gray-600">"As a busy professional, I love how SkillConnect helps me find flexible volunteering options that fit my schedule."</p>
                            <div class="mt-4 flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <div class="flex items-center mb-4">
                                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5cd?ixlib=rb-1.2.1&auto=format&fit=crop&w=64&h=64&q=80" alt="Testimonial" class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <h4 class="font-medium text-gray-900">Lisa Thompson</h4>
                                    <p class="text-sm text-gray-500">Community Volunteer</p>
                                </div>
                            </div>
                            <p class="text-gray-600">"I've volunteered with many organizations, but SkillConnect stands out for its user-friendly platform and the quality of opportunities available. Highly recommend!"</p>
                            <div class="mt-4 flex text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="gradient-bg text-white py-16">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-3xl font-bold mb-6">Ready to Make a Difference?</h2>
                    <p class="text-xl mb-8 max-w-3xl mx-auto">Join thousands of volunteers who are creating positive change in their communities every day.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-100 px-8 py-4 rounded-full font-medium text-lg transition duration-300">
                            Sign Up as Volunteer
                        </a>
                        {{-- This button now also links to the registration page --}}
                        <a href="{{ route('register') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-4 rounded-full font-medium text-lg transition duration-300">
                            Post a Volunteer Need
                        </a>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-gray-800 text-white py-8 text-center">
            <p>© {{ date('Y') }} SkillConnect. All rights reserved.</p>
        </footer>

    </body>
</html>