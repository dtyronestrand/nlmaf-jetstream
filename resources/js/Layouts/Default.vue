<template>
   <!-- Added z-20 to ensure header is above other content, including the main area and any fixed backgrounds -->
   <header class=" sticky z-20 top-0 left-0 w-[100vw] bg-[var(--color-primary-800)] border-b border-[var(--color-accent-500)] ">
    <nav class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <Link href="/" class="flex items-center">
            <span class="self-center text-xl font-semibold whitespace-nowrap text-[var(--color-accent-500)]">NLMAF</span><p>{{ route().current() }}</p>
         
        </Link>

        <!-- Right-aligned items group (Download, Login/Logout, Mobile Hamburger) --
        <div class="flex items-center md:order-2">
            <div class="hidden m-2 mr-4 sm:inline-block"> <!-- This span's purpose is unclear, might be for spacing or a placeholder -->
       
 
         
            
            <div v-if="$page.props.auth.user" class="md:order-2 ml-2 sm:mr-2"> <!-- Adjusted margins for consistency --><span class="mr-2 text-lg text-[var(--color-text-primary)]"><a href="/user/profile" >{{ $page.props.auth.user.name }}</a></span>
                <SecondaryButton @click="handleLogout">Logout</SecondaryButton>
            </div>
            <div v-else class="md:order-2 ml-2 sm:mr-2"> <!-- Adjusted margins for consistency -->
                <SecondaryButton @click="handleLogin">Login</SecondaryButton>
            </div>

            <!-- Mobile Menu Hamburger Button -->
          <button type="button"
    @click="toggleMobileMenu"
    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-md md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
    :aria-expanded="isMobileMenuOpen.toString()"
    aria-controls="main-menu-content">
                <span class="sr-only">Open main menu</span>
                <svg v-if="!isMobileMenuOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg  v-if="isMobileMenuOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <!-- The md:hidden hamburger button was here, it's removed as it seems redundant -->
      

        <!-- Collapsible Menu Links -->
<div id="main-menu-content"
     :class="{ 'block': isMobileMenuOpen, 'hidden': !isMobileMenuOpen }"
     class="items-center justify-between w-full md:flex md:w-auto md:order-1">
            <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0">
                <li v-for="link in $page.props.menuLinks" :class="link.submenu ? 'has-dropdown' : ''" :key="link.id">
                    <NavLink v-if="!link.submenu" :href="link.url"
                       :active="isLinkActive(link.url)" class="block py-2 pl-3 pr-4 rounded md:bg-transparent bg-[var(--color-primary-600)] md:p-0 text-[var(--color-text-primary)] transition hover:text-[var(--color-secondary-500)]"
                        aria-current="page">{{ link.title }}</NavLink>
                    <span v-else>
                        <NavLink :href="link.url"
                            :active="isParentLinkActive(link.url)"
                            class=" block py-2 pl-3 pr-4 rounded md:flex md:bg-transparent bg-[var(--color-primary-600)] md:p-0 text-[var(--color-text-primary)] transition hover:text-[var(--color-secondary-500)]">
                        {{ link.title }} <svg class="icon chevron-icon" viewBox="0 0 24 24" width="14" height="14">
                            <path d="M7 10l5 5 5-5z" fill="currentColor"></path>
                        </svg>
                        </NavLink>
                        <ul class="dropdown">
                            <li v-for="sub in link.submenu" :key="sub.id">
                                <NavLink  :active="isLinkActive(sub.url)" :href="sub.url">{{ sub.title }}</NavLink>
                            </li>
                        </ul>
                    </span>
                </li>
            </ul>
        </div>
    </nav>
   </header>
    <!-- Added z-0 and a background color.
         z-0 ensures this main content area is above any z-index: -1 elements (like the homepage canvas)
         and correctly positioned below the z-20 header.
         IMPORTANT: Replace 'bg-white dark:bg-neutral-800' with your site's actual page background color classes or variables. -->
    <main class="gradient">
        <slot></slot>
     
    </main>
    <footer class="hidden  bg-[var(--nav-bg)] md:static md:bottom-0 md:grid md:grid-cols-3 mt-20 w-full h-[auto] border-t border-[var(--color-accent-500)]">
    <!-- Image Section -->
    <div class="flex flex-col justify-center  items-center py-8 md:justify-start">
        <img src="http://localhost:8000/img/9b0fd4e7-c2f7-485b-a09b-e9078080a064/z2sbzpbqstj980jj-nlmaf-logo-2shues-smallcropped.jpeg?fm=jpg&q=80&fit=max&crop=2048%2C2048%2C0%2C0" 
             alt="No Limits Martial Arts and Fitness" 
             class="rounded-full h-[10rem] w-[10rem] object-cover">
             <p class="mt-4 block text-[var(--color-text-primary)] text-xs">2025 No Limits Martial Arts and Fitness</p>
    </div>
    <!-- Content Section -->
    <div class="justify-center items-center align-center pt-0 pb-8 sm:px-6 md:px-2 md:py-16">
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
    <div>
    <p>
    <span class="text-2xl tracking-wide text-[var(--color-text-primary)] uppercae">Contact Us</span>
    <span class="block text-xl font-medium text-[var(--color-text-primary)]">804-867-5309</span>
    <PrimaryButton >Leave a Message</PrimaryButton>
    </p>

    </div>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
    <div>
    <p class="font-medium text-[var(--color-text-primary)]">Navigation</p>
    <ul class="mt-6 space-y-4 text-sm">
    <li v-for="link in $page.props.menuLinks" :key="link.id">
    <Link :href="link.url" class="text-[var(--color-text-primary)] hover:text-[var(--color-accent)]">{{ link.title }}</Link>
    </li>
    </ul>
    </div>
    </div>
    </div>
    </div>
    </footer>
</template>
<script setup>

import NavLink from "@/Components/NavLink.vue";
import {usePage, router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import IconButton from "@/Components/Theme/UI/IconButton.vue";

const page = usePage();
const handleLogout = ()=>{
    router.post(route('logout'));
}
const handleLogin  = ()=>{
    router.visit(route('login'))
}

const getCurrentPath = computed(() =>{
    return page.url.split('?')[0];
});

const isLinkActive = (linkUrl)=>{
    const currentPathValue = getCurrentPath.value;
    if (linkUrl === '/'){
        return currentPathValue === '/';
    }
    return currentPathValue === linkUrl
};
const isParentLinkActive = (parentUrl, submenu = []) => {
    const currentPathValue = getCurrentPath.value;
    if (parentUrl !== '/' && (currentPathValue === parentUrl || currentPathValue.startsWith(parentUrl + '/'))) {
        return true; // Parent link is active
    }
    return submenu.some(sub => sub.url === currentPathValue);

};

// Reactive state for mobile menu visibility
const isMobileMenuOpen = ref(false); // Initially closed

// Method to toggle the menu state
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

</script>
<style scoped>

/* Reset some default browser styles */


/* Basic content styling for demo */


/* Header and Navbar */

/* Icons */

.icon {
    transition: var(--transition-medium);
    vertical-align: middle;
}

.chevron-icon {
    transition: transform var(--transition-medium);
}

.has-dropdown:hover .chevron-icon {
    transform: rotate(180deg);
}



/* Dropdown Menus */
.has-dropdown {
    position: relative;
}

.dropdown {
    position: absolute;
    top: calc(100% + 10px);
    left: 0;
    min-width: 220px;
    background: var(--dropdown-bg);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
    border: 1px solid var(--border-color);
    border-radius: var(--border-radius);
    padding: 0.5rem;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px) scale(0.98);
    transition: all var(--transition-medium);
    box-shadow: 0 10px 30px var(--shadow-color);
    z-index: 100;
}

.has-dropdown:hover .dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.dropdown::before {
    content: '';
    position: absolute;
    top: -6px;
    left: 20px;
    width: 12px;
    height: 12px;
    background: var(--dropdown-bg);
    border-left: 1px solid var(--border-color);
    border-top: 1px solid var(--border-color);
    transform: rotate(45deg);
    backdrop-filter: var(--glass-effect);
    -webkit-backdrop-filter: var(--glass-effect);
}

.dropdown li {
    list-style: none;
}

.dropdown a {
    color: var(--text-color);
    text-decoration: none;
    padding: 0.7rem 1rem;
    display: block;
    border-radius: var(--border-radius);
    transition: all var(--transition-medium);
    margin-bottom: 2px;
}

.dropdown a:hover {
    background: rgba(244, 208, 63, 0.15);
    color: var(--primary-color);
    transform: translateX(5px);
}

</style>
