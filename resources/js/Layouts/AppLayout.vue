<template>
    <div class="flex h-screen">
<aside class="hidden w-64 bg-gradient-to-b from-[var(--color-primary-900)] to-[var(--color-primary-800)] border-r-2 border-[var(--color-accent)] md:block">
<div class="py-3 text-2xl uppercase text-center tracking-widest bg-[var(--color-primary-900)] border-b-2 border-[var(--color-accent)] mb-8">
<a href="/" class="text-[var(--color-accent)]">NLMAF</a>
</div>
<nav class="text-lg text-[var(--color-text-primary)]">
<ul class="flex flex-col">
<li v-for="(link, index) in $page.props.sidemenu">
<Link :href="link.url" :key="index" class="flex items-center px-4 py-2 hover:bg-[var(--color-accent-500)] hover:text-[var(--color-neutral-900)] hover:text-[var(--color-text-primary)]">{{ link.title }}</Link>
</li>
</ul>
<Link href="/logout" method="post" class="mt-4 px-4 py-2  text-[var(--color-neutral-100)] ">Logout</Link>
</nav>
</aside>
<main class="flex-1 flex flex-col overflow-hidden">
<slot></slot>
</main>
    </div>
</template>
<script setup>
import {Link} from '@inertiajs/vue3';
</script>