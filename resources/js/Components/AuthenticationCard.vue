<template>
    <div class="wrapper min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <div class=" form w-full sm:max-w-md mt-6 px-12 py-8  text-[var(--color-text-primary)] shadow-md overflow-hidden sm:rounded-lg">
            <slot />
      
        </div>
    </div>
</template>
<style scoped>
.wrapper{
background-image: url('/assets/images/formbg.webp') ;
background-size: cover;
background-position: top center;
}
.form{
    background-color: rgba(110, 31, 26, 0.8);
    backdrop-filter: blur(10px);
    border: 2px solid var(--color-accent-500);
}
</style>
