@extends('layouts.master')

@section('title', 'Photo Gallery - Jariah Fund')
@section('meta_description', 'Browse our collection of impact photos showing how Jariah Fund is making a difference in communities across Malaysia through Islamic crowdfunding initiatives.')

@section('content')
<div class="bg-gray-50">
    <!-- Page Header -->
    <div class="bg-primary-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">Impact Gallery</h1>
                <p class="text-lg md:text-xl text-primary-100 max-w-3xl mx-auto">
                    Visual stories of change, hope, and community transformation through your generous contributions
                </p>
            </div>
        </div>
    </div>
    
    <!-- Gallery Categories Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="category-filter px-6 py-2 bg-white rounded-full shadow-md hover:shadow-lg transition-all duration-300 text-primary-600 font-medium border border-primary-100 active" data-category="all">
                All Photos
            </button>
            <button class="category-filter px-6 py-2 bg-white rounded-full shadow-md hover:shadow-lg transition-all duration-300 text-gray-700 font-medium border border-gray-200" data-category="community">
                Community
            </button>
            <button class="category-filter px-6 py-2 bg-white rounded-full shadow-md hover:shadow-lg transition-all duration-300 text-gray-700 font-medium border border-gray-200" data-category="education">
                Education
            </button>
            <button class="category-filter px-6 py-2 bg-white rounded-full shadow-md hover:shadow-lg transition-all duration-300 text-gray-700 font-medium border border-gray-200" data-category="healthcare">
                Healthcare
            </button>
            <button class="category-filter px-6 py-2 bg-white rounded-full shadow-md hover:shadow-lg transition-all duration-300 text-gray-700 font-medium border border-gray-200" data-category="infrastructure">
                Infrastructure
            </button>
            <button class="category-filter px-6 py-2 bg-white rounded-full shadow-md hover:shadow-lg transition-all duration-300 text-gray-700 font-medium border border-gray-200" data-category="events">
                Events
            </button>
        </div>
        
        <!-- Gallery Grid -->
        <div class="gallery-masonry">
            <!-- Gallery Item 1 - Large -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="community"
                 data-index="0"
                 data-image="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Community Gathering in Kelantan" 
                 data-description="Local community members coming together for a charity event in rural Malaysia. These gatherings strengthen bonds and provide valuable services including health screenings, food distribution, and educational workshops for children and adults alike.">
                <div class="aspect-w-16 aspect-h-9 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/map_01.jpg') }}" alt="Community gathering" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg md:text-xl">Community Gathering</h4>
                            <p class="text-sm text-white/80">Kelantan, Malaysia</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 2 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="community"
                 data-index="1"
                 data-image="{{ asset('assets/images/gallery/food-distribution.svg') }}" 
                 data-title="Food Security Initiative" 
                 data-description="Volunteers distributing food packages to families in need. Our food security initiatives reach thousands of beneficiaries monthly, providing nutritious meals and essential supplies to those experiencing financial hardship.">
                <div class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/map_02.jpg') }}" alt="Food distribution" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg">Food Distribution</h4>
                            <p class="text-sm text-white/80">Kuala Lumpur</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 3 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="education"
                 data-index="2"
                 data-image="{{ asset('assets/images/campaigns/education-initiative.svg') }}" 
                 data-title="Rural Education Program" 
                 data-description="Children attending classes in our newly built school. Education is a cornerstone of our development approach, empowering future generations with knowledge and skills needed for sustainable livelihoods and community leadership.">
                <div class="aspect-w-4 aspect-h-3 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/mab_01.jpg') }}" alt="Education program" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg md:text-xl">Education Program</h4>
                            <p class="text-sm text-white/80">Sabah Rural District</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 4 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="healthcare"
                 data-index="3"
                 data-image="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Mobile Healthcare Services" 
                 data-description="Mobile clinic providing medical care to remote communities that would otherwise lack access to essential healthcare. Our medical teams travel to isolated villages, providing preventive care, treatments, and health education.">
                <div class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/mab_02.jpg') }}" alt="Healthcare service" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg">Healthcare Services</h4>
                            <p class="text-sm text-white/80">Perak Rural Communities</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 5 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="infrastructure"
                 data-index="4"
                 data-image="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Clean Water Project in Sarawak" 
                 data-description="New water well providing clean water to rural villages, dramatically improving health outcomes and quality of life for hundreds of families. Access to clean water reduces waterborne diseases and allows children more time for education instead of water collection.">
                <div class="aspect-w-3 aspect-h-2 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/mab_03.jpg') }}" alt="Water well project" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg md:text-xl">Water Well Project</h4>
                            <p class="text-sm text-white/80">Sarawak Village</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 6 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="education"
                 data-index="5"
                 data-image="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Vocational Skills Training Center" 
                 data-description="Vocational training program for young adults, equipping them with marketable skills for sustainable livelihoods and economic independence. Programs include carpentry, electronics repair, sewing, culinary arts, and computer literacy.">
                <div class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/02.jpg') }}" alt="Skills training" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg">Skills Training</h4>
                            <p class="text-sm text-white/80">Johor Bahru Center</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 7 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="community"
                 data-index="6"
                 data-image="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Orphan Support Program" 
                 data-description="Supporting orphaned children with education and care. Our holistic approach ensures these children receive the emotional and educational support they need to thrive despite difficult circumstances.">
                <div class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/03.jpg') }}" alt="Orphan support" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg">Orphan Support</h4>
                            <p class="text-sm text-white/80">Kuala Lumpur Orphanage</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 8 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="infrastructure"
                 data-index="7"
                 data-image="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Mosque Construction Project" 
                 data-description="Building new mosques for local communities, creating spiritual and community centers that serve multiple functions beyond worship. These facilities become focal points for education, community gatherings, and charitable work.">
                <div class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/04.jpg') }}" alt="Mosque construction" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg">Mosque Construction</h4>
                            <p class="text-sm text-white/80">Terengganu Community</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 9 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="events"
                 data-index="8"
                 data-image="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Annual Charity Fundraising Dinner" 
                 data-description="Our annual charity fundraising dinner brings together donors, community leaders, and beneficiaries to celebrate accomplishments and set ambitious goals for the upcoming year. These events strengthen our community bonds and inspire greater generosity.">
                <div class="aspect-w-3 aspect-h-2 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/map_01.jpg') }}" alt="Charity dinner" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg md:text-xl">Annual Charity Dinner</h4>
                            <p class="text-sm text-white/80">Kuala Lumpur Convention Center</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 10 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="healthcare"
                 data-index="9"
                 data-image="https://images.unsplash.com/photo-1584515979956-d9f6e5d09980?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Emergency Medical Relief" 
                 data-description="Our emergency medical relief teams respond quickly to natural disasters and crises, providing critical care and supplies when they're needed most. These rapid response initiatives save lives and provide comfort in the most challenging circumstances.">
                <div class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/mab_02.jpg') }}" alt="Emergency medical relief" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg">Emergency Medical Relief</h4>
                            <p class="text-sm text-white/80">Flood-affected Areas</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 11 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="community"
                 data-index="10"
                 data-image="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Elderly Support Program" 
                 data-description="Our elderly support program ensures senior citizens receive the care, companionship, and dignity they deserve. Services include home visits, medical assistance, recreational activities, and spiritual support for elderly community members.">
                <div class="aspect-w-4 aspect-h-3 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/map_02.jpg') }}" alt="Elderly support" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg md:text-xl">Elderly Support</h4>
                            <p class="text-sm text-white/80">Multiple Locations</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 12 -->
            <div class="gallery-item cursor-pointer group" 
                 data-category="events"
                 data-index="11"
                 data-image="https://images.unsplash.com/photo-1560523159-6b681a1e1852?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                 data-title="Ramadan Food Distribution" 
                 data-description="During the holy month of Ramadan, we organize special food distribution events to ensure families can break their fast with nutritious meals. This annual tradition brings communities together in the spirit of giving and gratitude.">
                <div class="aspect-w-1 aspect-h-1 rounded-xl overflow-hidden">
                    <img src="{{ asset('assets/images/campaigns/mab_03.jpg') }}" alt="Ramadan distribution" class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 p-4 md:p-5 text-white">
                            <h4 class="font-bold text-lg">Ramadan Distribution</h4>
                            <p class="text-sm text-white/80">Nationwide Initiative</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Modal -->
<div id="gallery-modal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50 flex items-center justify-center p-4">
    <div class="relative max-w-5xl w-full">
        <button id="close-gallery-modal" class="absolute -top-12 right-0 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="bg-black bg-opacity-30 backdrop-blur-sm rounded-xl overflow-hidden">
            <img id="modal-image" src="" alt="" class="w-full h-auto max-h-[80vh] object-contain">
            <div class="p-6 text-white">
                <h3 id="modal-title" class="text-white text-xl md:text-2xl font-bold mb-2"></h3>
                <p id="modal-description" class="text-gray-200 text-sm md:text-base"></p>
            </div>
        </div>
        
        <!-- Navigation Controls -->
        <div class="absolute top-1/2 left-0 right-0 flex justify-between items-center px-4 transform -translate-y-1/2">
            <button id="prev-image" class="bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-3 rounded-full transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button id="next-image" class="bg-black bg-opacity-50 hover:bg-opacity-70 text-white p-3 rounded-full transition-all duration-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Gallery Masonry Layout */
    .gallery-masonry {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        grid-auto-flow: dense;
        gap: 1rem;
    }
    
    @media (min-width: 640px) {
        .gallery-masonry {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.25rem;
        }
    }
    
    @media (min-width: 768px) {
        .gallery-masonry {
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
    }
    
    @media (min-width: 1024px) {
        .gallery-masonry {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    /* Item sizing for different screen sizes */
    /* Mobile - Single column */
    .gallery-masonry .gallery-item:nth-child(1) {
        grid-column: span 1;
    }
    
    /* Tablet - Two columns */
    @media (min-width: 640px) {
        .gallery-masonry .gallery-item:nth-child(1),
        .gallery-masonry .gallery-item:nth-child(9) {
            grid-column: span 2;
        }
        
        .gallery-masonry .gallery-item:nth-child(3),
        .gallery-masonry .gallery-item:nth-child(11) {
            grid-column: span 2;
        }
    }
    
    /* Desktop - Three or Four columns */
    @media (min-width: 768px) {
        .gallery-masonry .gallery-item:nth-child(1) {
            grid-column: span 2;
            grid-row: span 2;
        }
        
        .gallery-masonry .gallery-item:nth-child(5),
        .gallery-masonry .gallery-item:nth-child(9) {
            grid-column: span 2;
        }
        
        .gallery-masonry .gallery-item:nth-child(11) {
            grid-column: span 2;
            grid-row: span 1;
        }
    }
    
    /* Fade-in animation for gallery items */
    .gallery-item {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Staggered animation delay */
    .gallery-item:nth-child(1) { animation-delay: 0.1s; }
    .gallery-item:nth-child(2) { animation-delay: 0.15s; }
    .gallery-item:nth-child(3) { animation-delay: 0.2s; }
    .gallery-item:nth-child(4) { animation-delay: 0.25s; }
    .gallery-item:nth-child(5) { animation-delay: 0.3s; }
    .gallery-item:nth-child(6) { animation-delay: 0.35s; }
    .gallery-item:nth-child(7) { animation-delay: 0.4s; }
    .gallery-item:nth-child(8) { animation-delay: 0.45s; }
    .gallery-item:nth-child(9) { animation-delay: 0.5s; }
    .gallery-item:nth-child(10) { animation-delay: 0.55s; }
    .gallery-item:nth-child(11) { animation-delay: 0.6s; }
    .gallery-item:nth-child(12) { animation-delay: 0.65s; }
    
    /* Filter button transitions */
    .category-filter {
        transition: all 0.3s ease;
    }
    
    /* Modal animation */
    #modal-image {
        transition: opacity 0.3s ease;
    }
    
    /* Category filter active state */
    .category-filter.active {
        background-color: var(--primary-color, #0ea5e9);
        color: white;
        border-color: var(--primary-color, #0ea5e9);
    }
    
    /* Gallery item hover effects */
    .gallery-item img {
        transform-origin: center;
        backface-visibility: hidden;
    }
    
    .gallery-item:hover .absolute {
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gallery Functionality
    const galleryItems = document.querySelectorAll('.gallery-item');
    const galleryModal = document.getElementById('gallery-modal');
    const modalImage = document.getElementById('modal-image');
    const modalTitle = document.getElementById('modal-title');
    const modalDescription = document.getElementById('modal-description');
    const closeGalleryModal = document.getElementById('close-gallery-modal');
    const prevImageBtn = document.getElementById('prev-image');
    const nextImageBtn = document.getElementById('next-image');
    const categoryFilters = document.querySelectorAll('.category-filter');
    
    let currentIndex = 0;
    let visibleItems = [...galleryItems]; // All items initially
    
    // Category filtering
    categoryFilters.forEach(filter => {
        filter.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active state
            categoryFilters.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            if (category === 'all') {
                visibleItems = [...galleryItems];
                galleryItems.forEach(item => {
                    item.style.display = 'block';
                });
            } else {
                visibleItems = [...galleryItems].filter(item => item.dataset.category === category);
                galleryItems.forEach(item => {
                    if (item.dataset.category === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }
        });
    });
    
    // Open modal when clicking on gallery item
    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            currentIndex = parseInt(this.dataset.index);
            updateModalContent(currentIndex);
            galleryModal.classList.remove('hidden');
            galleryModal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Update modal content
    function updateModalContent(index) {
        const item = galleryItems[index];
        const imageSrc = item.dataset.image;
        const title = item.dataset.title;
        const description = item.dataset.description;
        
        // Add fade out effect
        modalImage.classList.add('opacity-0');
        setTimeout(() => {
            modalImage.src = imageSrc;
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            
            // Add fade in effect after content is updated
            modalImage.classList.remove('opacity-0');
        }, 300);
    }
    
    // Navigate to previous visible image
    prevImageBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        let newIndex = currentIndex;
        do {
            newIndex = (newIndex - 1 + galleryItems.length) % galleryItems.length;
        } while (!visibleItems.includes(galleryItems[newIndex]) && newIndex !== currentIndex);
        
        if (visibleItems.includes(galleryItems[newIndex])) {
            currentIndex = newIndex;
            updateModalContent(currentIndex);
        }
    });
    
    // Navigate to next visible image
    nextImageBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        let newIndex = currentIndex;
        do {
            newIndex = (newIndex + 1) % galleryItems.length;
        } while (!visibleItems.includes(galleryItems[newIndex]) && newIndex !== currentIndex);
        
        if (visibleItems.includes(galleryItems[newIndex])) {
            currentIndex = newIndex;
            updateModalContent(currentIndex);
        }
    });
    
    // Close modal
    closeGalleryModal.addEventListener('click', function() {
        galleryModal.classList.add('hidden');
        galleryModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    });
    
    // Close modal when clicking outside
    galleryModal.addEventListener('click', function(e) {
        if (e.target === galleryModal) {
            galleryModal.classList.add('hidden');
            galleryModal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (galleryModal.classList.contains('flex')) {
            if (e.key === 'ArrowLeft') {
                prevImageBtn.click();
            } else if (e.key === 'ArrowRight') {
                nextImageBtn.click();
            } else if (e.key === 'Escape') {
                galleryModal.classList.add('hidden');
                galleryModal.classList.remove('flex');
                document.body.style.overflow = 'auto';
            }
        }
    });
});
</script>
@endpush 