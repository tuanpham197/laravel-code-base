<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Button } from '@/components/ui/button';
import HeroImage from '@/assets/images/hero-illustration.svg';

const mobileMenuOpen = ref(false);

const props = defineProps({
  auth: Object,
});

const faqs = [
  {
    question: 'the quick fox jumps over the lazy dog',
    answer: 'Things on a very small scale behave like nothing that you have any direct experience about.'
  },
  {
    question: 'the quick fox jumps over the lazy dog',
    answer: 'Things on a very small scale behave like nothing.'
  },
  {
    question: 'the quick fox jumps over the lazy dog',
    answer: 'Things on a very small scale behave like nothing.'
  },
  {
    question: 'the quick fox jumps over the lazy dog',
    answer: 'Things on a very small scale behave like nothing.'
  },
  {
    question: 'the quick fox jumps over the lazy dog',
    answer: 'Things on a very small scale behave like nothing.'
  },
  {
    question: 'the quick fox jumps over the lazy dog',
    answer: 'Things on a very small scale behave like nothing.'
  },
];

const pricingPlans = [
  {
    name: 'FREE',
    price: 0,
    description: 'Organize across all apps by hand',
    features: [
      { name: 'Unlimited product updates', included: true },
      { name: 'Unlimited product updates', included: true },
      { name: 'Unlimited product updates', included: true },
      { name: '1GB Cloud storage', included: false },
      { name: 'Email and community support', included: false },
    ]
  },
  {
    name: 'STANDARD',
    price: 9.99,
    description: 'Organize across all apps by hand',
    features: [
      { name: 'Unlimited product updates', included: true },
      { name: 'Unlimited product updates', included: true },
      { name: 'Unlimited product updates', included: true },
      { name: '1GB Cloud storage', included: true },
      { name: 'Email and community support', included: true },
    ]
  },
  {
    name: 'PREMIUM',
    price: 19.99,
    description: 'Organize across all apps by hand',
    features: [
      { name: 'Unlimited product updates', included: true },
      { name: 'Unlimited product updates', included: true },
      { name: 'Unlimited product updates', included: true },
      { name: '1GB Cloud storage', included: true },
      { name: 'Email and community support', included: true },
    ]
  }
];

const isLoggedIn = computed(() => props.auth?.user?.email)
const userName = computed(() => props.auth?.user?.name)
</script>

<template>
  <Head title="Financial Assistance" />
  
  <div class="min-h-screen bg-[#1E2231] text-white">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-[#1E2231]/95 backdrop-blur-sm">
      <div class="container mx-auto px-4">
        <div class="flex h-16 items-center justify-between">
          <div class="flex items-center gap-6">
            <span class="text-xl font-semibold">BrandName</span>
          </div>
          
          <!-- Desktop Menu -->
          <div class="hidden md:flex items-center space-x-8">
            <a href="#" class="text-gray-300 hover:text-white">Home</a>
            <a href="#" class="text-gray-300 hover:text-white">Product</a>
            <a href="#" class="text-gray-300 hover:text-white">Pricing</a>
            <a href="#" class="text-gray-300 hover:text-white">Contact</a>
          </div>

          <div class="hidden md:flex items-center gap-4">

            <Button v-if="!isLoggedIn" variant="ghost" class="text-gray-300 hover:text-black">Login</Button>
            <div v-else-if="isLoggedIn" class="flex items-center gap-2">
              <span class="text-gray-300 hover:text-black">{{ userName }}</span>
              <Button variant="ghost" class="text-gray-300 hover:text-black">Logout</Button>
            </div>

            <Button class="bg-[#3B82F6] hover:bg-blue-600 text-white px-6">Become a member</Button>
          </div>

          <!-- Mobile Menu Button -->
          <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Mobile Menu -->
        <div v-show="mobileMenuOpen" class="md:hidden py-4 space-y-4">
          <a href="#" class="block text-gray-300 hover:text-black py-2">Home</a>
          <a href="#" class="block text-gray-300 hover:text-black py-2">Product</a>
          <a href="#" class="block text-gray-300 hover:text-black py-2">Pricing</a>
          <a href="#" class="block text-gray-300 hover:text-black py-2">Contact</a>
          <div class="pt-4 space-y-3">
            <Button variant="ghost" class="w-full text-gray-300 hover:text-black">Login</Button>
            <Button class="w-full bg-[#3B82F6] hover:bg-blue-600 text-white">Become a member</Button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-16">
      <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
          <div class="text-center lg:text-left">
            <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-6">
              Financial Assistance With True Purpose
            </h1>
            <p class="text-gray-400 text-base lg:text-lg mb-8">
              We know how large objects will act, but things on a small scale.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
              <Button class="bg-[#3B82F6] hover:bg-blue-600 text-white px-8 w-full sm:w-auto">Get Quote Now</Button>
              <Button variant="outline" class="border-gray-600 text-gray-300 hover:text-white px-8 w-full sm:w-auto">Learn More</Button>
            </div>
          </div>
          <div class="relative mt-8 lg:mt-0">
            <div class="border-2 border-[#3B82F6] rounded-lg p-4">
              <img :src="HeroImage" alt="Financial Assistance" class="w-full" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 lg:py-20 bg-[#1A1F2D]">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12 lg:mb-16">
          <h2 class="text-2xl lg:text-3xl font-bold mb-4">Better Strategy</h2>
          <p class="text-gray-400 max-w-2xl mx-auto text-sm lg:text-base">
            Problems trying to resolve the conflict between the two major realms of Classical physics: Newtonian mechanics
          </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
          <!-- Feature Cards -->
          <div v-for="feature in [
            { title: 'Investment Trading', icon: 'chart' },
            { title: 'Support On Raising Funds', icon: 'money' },
            { title: 'Financial Analysis', icon: 'analysis' },
            { title: 'Taxation Planning', icon: 'tax' },
            { title: 'Save money and tim', icon: 'save' },
            { title: 'Outsourced Consulting Business', icon: 'business' }
          ]" :key="feature.title" class="bg-white rounded-lg p-4 lg:p-6 flex items-start gap-4">
            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-[#3B82F6] rounded-full flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5 lg:w-6 lg:h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
              </svg>
            </div>
            <h3 class="text-[#1E2231] font-semibold text-sm lg:text-base">{{ feature.title }}</h3>
          </div>
        </div>

        <div class="mt-12 flex flex-col sm:flex-row justify-center gap-4">
          <Button class="bg-[#3B82F6] hover:bg-blue-600 text-white px-8 w-full sm:w-auto">Get Quote Now</Button>
          <Button variant="outline" class="border-gray-600 text-gray-300 hover:text-white px-8 w-full sm:w-auto">Learn More</Button>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 lg:py-20">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12 lg:mb-16">
          <h2 class="text-2xl lg:text-3xl font-bold mb-4">What Clients Say</h2>
          <p class="text-gray-400 max-w-2xl mx-auto text-sm lg:text-base">
            Problems trying to resolve the conflict between the two major realms of Classical physics: Newtonian mechanics
          </p>
        </div>

        <div class="max-w-2xl mx-auto px-4">
          <div class="bg-white rounded-lg p-6 lg:p-8 text-center">
            <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-4 overflow-hidden rounded-full">
              <img src="/images/avatar.jpg" alt="Client" class="w-full h-full object-cover" />
            </div>
            <p class="text-gray-600 mb-6 text-sm lg:text-base">
              State helps you see how many more days you need to work to reach your financial goal for the month and year.
            </p>
            <div class="flex justify-center gap-1 mb-4">
              <svg v-for="i in 4" :key="i" class="w-4 h-4 lg:w-5 lg:h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
              <svg class="w-4 h-4 lg:w-5 lg:h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
              </svg>
            </div>
            <h3 class="text-[#1E2231] font-semibold text-base lg:text-lg">Regina Miles</h3>
            <p class="text-gray-500 text-sm">Designer</p>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-16 lg:py-20 bg-[#1A1F2D]">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12 lg:mb-16">
          <h2 class="text-2xl lg:text-3xl font-bold mb-4">FAQ</h2>
          <p class="text-gray-400 max-w-2xl mx-auto text-sm lg:text-base">
            Problems trying to resolve the conflict between the two major realms of Classical physics: Newtonian mechanics
          </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
          <div v-for="(faq, index) in faqs" :key="index" class="bg-white rounded-lg p-4 lg:p-6 cursor-pointer hover:shadow-lg transition-shadow">
            <div class="flex items-start gap-4">
              <div class="text-[#3B82F6] text-lg">→</div>
              <div>
                <h3 class="text-[#1E2231] font-semibold mb-2 text-sm lg:text-base">{{ faq.question }}</h3>
                <p class="text-gray-600 text-xs lg:text-sm">{{ faq.answer }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-16 lg:py-20">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12 lg:mb-16">
          <h2 class="text-2xl lg:text-3xl font-bold mb-4">Pricing</h2>
          <p class="text-gray-400 max-w-2xl mx-auto text-sm lg:text-base">
            Problems trying to resolve the conflict between the two major realms of Classical physics: Newtonian mechanics
          </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
          <div v-for="plan in pricingPlans" :key="plan.name" 
               class="bg-white rounded-lg p-6 lg:p-8 text-center relative"
               :class="{ 'transform scale-105 shadow-xl': plan.name === 'STANDARD' }">
            <h3 class="text-[#1E2231] font-bold text-lg lg:text-xl mb-4">{{ plan.name }}</h3>
            <p class="text-gray-600 mb-6 text-sm">{{ plan.description }}</p>
            
            <div class="flex items-center justify-center gap-1 mb-6">
              <span class="text-3xl lg:text-4xl font-bold text-[#1E2231]">{{ plan.price }}</span>
              <div class="text-left">
                <div class="text-xs lg:text-sm text-gray-400">$</div>
                <div class="text-xs text-gray-400">Per Month</div>
              </div>
            </div>

            <ul class="space-y-4 mb-8">
              <li v-for="feature in plan.features" :key="feature.name" class="flex items-center gap-2">
                <svg class="w-4 h-4 lg:w-5 lg:h-5" :class="feature.included ? 'text-green-500' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span :class="feature.included ? 'text-[#1E2231]' : 'text-gray-400'" class="text-sm">{{ feature.name }}</span>
              </li>
            </ul>

            <Button class="w-full text-sm" :class="plan.name === 'STANDARD' ? 'bg-[#3B82F6] hover:bg-blue-600 text-white' : 'bg-[#1E2231] hover:bg-gray-800 text-white'">
              Try for free
            </Button>
          </div>
        </div>
      </div>
    </section>

    <!-- Get In Touch Section -->
    <section class="py-16 lg:py-20 bg-[#1A1F2D]">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12 lg:mb-16">
          <h2 class="text-2xl lg:text-3xl font-bold mb-4">Get In Touch</h2>
          <p class="text-gray-400 max-w-2xl mx-auto text-sm lg:text-base">
            The gradual accumulation of information about atomic and small-scale behaviour during the first quarter of the 20th
          </p>
        </div>

        <div class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
          <input type="email" placeholder="Your Email" class="flex-1 px-4 py-2 rounded-lg bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-[#3B82F6]" />
          <Button class="bg-[#3B82F6] hover:bg-blue-600 text-white px-8 w-full sm:w-auto">Subscribe</Button>
        </div>

        <div class="mt-16 lg:mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 text-sm">
          <div>
            <h3 class="font-bold mb-4">Get In Touch</h3>
            <p class="text-gray-400 mb-4">the quick fox jumps over the lazy dog</p>
            <div class="flex gap-4">
              <a href="#" class="text-[#3B82F6] hover:text-blue-400">Facebook</a>
              <a href="#" class="text-[#3B82F6] hover:text-blue-400">Instagram</a>
              <a href="#" class="text-[#3B82F6] hover:text-blue-400">Twitter</a>
            </div>
          </div>
          
          <div>
            <h3 class="font-bold mb-4">Company Info</h3>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white">About Us</a></li>
              <li><a href="#" class="hover:text-white">Carrier</a></li>
              <li><a href="#" class="hover:text-white">We are hiring</a></li>
              <li><a href="#" class="hover:text-white">Blog</a></li>
            </ul>
          </div>

          <div>
            <h3 class="font-bold mb-4">Features</h3>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white">Business Marketing</a></li>
              <li><a href="#" class="hover:text-white">User Analytic</a></li>
              <li><a href="#" class="hover:text-white">Live Chat</a></li>
              <li><a href="#" class="hover:text-white">Unlimited Support</a></li>
            </ul>
          </div>

          <div>
            <h3 class="font-bold mb-4">Resources</h3>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white">IOS & Android</a></li>
              <li><a href="#" class="hover:text-white">Watch a Demo</a></li>
              <li><a href="#" class="hover:text-white">Customers</a></li>
              <li><a href="#" class="hover:text-white">API</a></li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>