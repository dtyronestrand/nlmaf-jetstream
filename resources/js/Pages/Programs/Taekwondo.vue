<template>
    <Head :item="item"></Head>
    <div v-if="$page.props.auth.user !== null" class="flex h-screen">
    <aside class="hidden w-64 bg-gradient-to-b from-[var(--color-primary-900)] to-[var(--color-primary-800)] border-r-2 border-[var(--color-accent)] md:block">
<div class="py-3 text-2xl uppercase text-center tracking-widest bg-[var(--color-primary-900)] border-b-2 border-[var(--color-accent)] mb-8">
<a href="/" class="text-[var(--color-accent)]">NLMAF</a>
</div>
<nav class="text-lg text-[var(--color-text-primary)]">
<ul class="flex flex-col">
<li v-for="(link, index) in $page.props.menu">
<Link :href="link.url" :key="index" class="flex items-center px-4 py-2 hover:bg-[var(--color-accent-500)] hover:text-[var(--color-neutral-900)] ">{{ link.title }}</Link>
</li>
</ul>
<Link href="/logout" method="post" class="mt-4 px-4 py-2  text-[var(--color-neutral-100)] ">Logout</Link>
</nav>
      <div class="h-40 w-40 overflow-hidden sm:rounded-full sm:relative sm:p-0 top-10 left-5 p-4">
         <img :src="$page.props.auth.user.profile_photo_url" alt="Profile Photo" class="w-full h-full object-cover"/>
      </div>
            <div class=" w-2/3 sm:text-center pl-10 mt-10 text-start flex items-center">
         <p class="font-bold text-[var(--color-text-primary)] text-heading  sm:text-4xl text-2xl">{{ $page.props.auth.user.name }}</p>
      </div> 
</aside>
<main class="grid grid-cols-4 gap-4 auto-rows-fr grid-flow-dense">
   <!-- top content -->
<BlockCommonBento :block="bentoBlock"/>
   
</main>
    </div>
  <div v-else>
<Default>
    <h1>
        <TextGenerate
            :words="words"
            :duration="2.5"
            class="text-[var(--color-text-primary)] mb-12 mt-12 text-5xl md:text-7xl text-center text-balance"
        />
    </h1>
    <div class="section-dots">
  <span
    v-for="(headline, idx) in headlines"
    :key="idx"
    :class="['dot', { active: currentSection === idx }]"
  ></span>
</div>
    <section
        v-for="(headline, index) in headlines"
        :key="index"
        class="hero mb-8"
    >
        <div class="hero-inner" :id="'section-' + index">
            <figure
                :style="{ backgroundImage: 'url(' + headline.image + ')' }"
                class="hero__image"
            ></figure>
            <div class="headline-stack">
  
                <h2
                    class="hero__title"
                    :class="{ 'is-hidden': descriptionActive[index] }"
                    ref="titleRefs"
                >
                    {{ headline.title }}
                </h2>
                <div
                    class="hero__description-container"
                    :class="{ 'is-active': descriptionActive[index] }"
                    :ref="(el) => (horizontalRefs[index] = el)"
                >
                    <div class="ct">
                        <p class="hero__description">
                            {{ headline.description }}
                        </p>
                    </div>
                </div>
            </div>
            </div>
     
    </section>
    <section class="content">
        <article class="content-inner">
            <h2 class="content__title">
                Taekwondo is More Than Just a Martial Art
            </h2>
            <p>
                Originating in Korea over 2,000 years ago, Taekwondo is a
                martial art that combines combat techniques, self-defense,
                sport, and exercise. The name "Taekwondo" is derived from the
                Korean words "Tae" (foot), "Kwon" (fist), and "Do" (way of
                life). This powerful yet graceful martial art is known for its
                high-flying kicks, swift strikes, and dynamic movements. But
                taekwondo is so much more, with regular practice, it can improve
                your overall health and well-being. Our Taekwondo classes are
                designed for students of all ages, from young children to
                adults. Whether you are a beginner looking to learn the basics
                or an experienced practitioner aiming to refine your skills, our
                expert instructors will guide you every step of the way.
            </p>
        </article>
        <article class="content__inner">
            <h2 class="content__title mt-12">
                Why Choose Our Taekwondo Classes?
            </h2>
            <p>
                Our Taekwondo classes offer a unique blend of physical fitness,
                mental discipline, and self-defense skills. Here are some of the
                key benefits you can expect:
            </p>
            <ul class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <li class="bg-[var(--color-primary-900)] rounded-lg shadow-lg p-9">
            <h3 class="text-xl font-bold text-[var(--color-text-primary)] mb-4">
                Flexible Location
            </h3>
            <p class="text-[var(--color-text-primary)]">
            With location in Beaverdam, VA and J Sargeat Reynolds Community College*. We believe in bringing the fitness to you. Contact us, to learn about bringing our classes to your business, organization, or community.</p>
            </li>
            <li class="bg-[var(--color-primary-900)] rounded-lg shadow-lg p-9">
            <h3 class="text-xl font-bold text-[var(--color-text-primary)] mb-4">
            Affordability</h3>
            <p class="text-[var(--color-text-primary)]">
            Whether you pay per class or monthly in advance, our rates are designed to make fitness accessible to everyone.
            </p>
            </li>
            <li class="bg-[var(--color-primary-900)] rounded-lg shadow-lg p-9">
            <div>
            <GlowingEffect   :spread="40"
          :glow="true"
          :disabled="false"
          :proximity="64"
          :inactive-zone="0.01"/>
            <h3 class="text-xl font-bold text-[var(--color-text-primary)] mb-4">
            Made for Everyone</h3>
            <p class="text-[var(--color-text-primary)]">
            Encorporating best practice in martial arts with the science of teacching and learning, our classess meet you where you are and help you to grow to where you want to be.
            </p>
            </div>
            </li>
            </ul>
        </article>

    </section>

    <div
        v-if="
            item?.blocks && Array.isArray(item.blocks) && item.blocks.length > 0
        "
    >
        <div v-for="(block, index) in item.blocks" :key="index">
            <BlockCommonText
                v-if="block.type === 'common-text'"
                :block="block"
            ></BlockCommonText>
            
        </div>
        
        </div>
  
     
   
    </Default>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount, nextTick, computed } from "vue";
import Head from "@/Components/Theme/Head.vue";
import { defineAsyncComponent } from "vue";
import { Link } from "@inertiajs/vue3";
import TextGenerate from "@/Components/Theme/UI/TextGenerate.vue";
import TextScrollReveal from "@/Components/Theme/UI/TextScroll/TextScrollReveal.vue";
import Default from '../../Layouts/Default.vue';
import GlowingEffect from "@/Components/Theme/UI/GlowingEffect.vue";

interface Props {
    item: Model.Program;
}
const props = defineProps<Props>();
const words = "What Can Taekwondo Do For You?";
const headlines = [
    {
        title: "Enhance Physical Fitness",
        description:
            "Improve your strength, flexibility, and endurance through dynamic workouts.",
        image: "/assets/images/physical.png",
    },
    {
        title: "Boost Mental Clarity",
        description:
            "Develop focus, discipline, and resilience, reducing stress and enhancing mental clarity.",
        image: "/assets/images/mental.jpg",
    },
    {
        title: "Build Self-Confidence",
        description:
            "Gain a sense of accomplishment and self-assurance as you progress through the ranks and achieve your goals.",
        image: "/assets/images/confidence.jpg",
    },
    {
        title: "Foster Community",
        description:
            "Join a supportive and welcoming community where you can make new friends and build lasting relationships",
        image: "/assets/images/community.jpg",
    },
];
const bentoBlock = computed(() => {
    if (props.item?.blocks && Array.isArray(props.item.blocks)) {
        return props.item.blocks.find((block) => block.type === 'common-bento');
    }
    return null;
});
let bentoSize  = null;
switch(bentoBlock.value?.content.size){
    case "small":
     bentoSize = 2;
     break;
    case "medium":
        bentoSize = 4;
        break;
    case "large":
        bentoSize = 6;
        break;
    default:
        bentoSize = 4;

}
const BlockCommonHeading = defineAsyncComponent(
    () => import("../../Components/Theme/Block/Common/Heading.vue")
);
const BlockCommonText = defineAsyncComponent(
    () => import("../../Components/Theme/Block/Common/Text.vue")
);
const BlockCommonBento = defineAsyncComponent(
    () => import("../../Components/Theme/Block/Common/Bento.vue")
);

// --- Horizontal scroll on vertical scroll logic ---
const horizontalRefs = ref<HTMLElement[]>([]);
const titleRefs = ref<HTMLElement[]>([]);
const descriptionActive = ref<boolean[]>([]);
const currentSection = ref(0);

function handleScroll() {
  let found = false;
  horizontalRefs.value.forEach((el, index) => {
    if (!el) return;
    const rect = el.getBoundingClientRect();
    const windowHeight = window.innerHeight;

    // Section is in view
    if (!found && rect.top < windowHeight * 0.6 && rect.bottom > windowHeight * 0.4) {
      currentSection.value = index;
      found = true;
    }

    if (rect.top < windowHeight * 0.5 && rect.bottom > windowHeight * 0.2) {
      descriptionActive.value[index] = true;
      const maxScroll = el.scrollWidth - el.clientWidth;
      const progress = Math.min(
        Math.max((windowHeight * 0.5 - rect.top) / rect.height, 0),
        1
      );
      el.scrollLeft = maxScroll * progress;
    } else {
      descriptionActive.value[index] = false;
    }
  });
}

onMounted(() => {
    // Initialize array
    descriptionActive.value = headlines.map(() => false);
    window.addEventListener("scroll", handleScroll, { passive: true });
});
onBeforeUnmount(() => {
    window.removeEventListener("scroll", handleScroll);
});

</script>

<style scoped>
.section-dots {
  position: fixed;
  top: 50%;
  right: 2vw;
  transform: translateY(-50%);
  display: flex;
  flex-direction: column;
  gap: 1rem;
  z-index: 20;
  pointer-events: none;
}

.dot {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background: var(--color-base-100, #444);
  opacity: 0.4;
  transition: background 0.3s, opacity 0.3s, transform 0.3s;
}

.dot.active {
  background: var(--color-accent-500, #ffb300);
  opacity: 1;
  transform: scale(1.2);
}
p {
    font-size: 1.75rem;
    line-height: 3rem;
    color: var(--color-text-primary);
}
figure {
    display: flex;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
}
.hero {
    position: relative;
    width: 100vw;
    height: 100vh;
}
.hero-inner {
    position: absolute;
    overflow: hidden;
    width: 100%;
    height: 100%;
    clip: rect(0, auto, auto, 0);
}
.headline-stack {
    position: relative;
    width: 100vw;
    height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    pointer-events: none;
    z-index: 3;
}
.hero__title {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    font-size: 8vw;
    letter-spacing: -0.125rem;
    text-align: center;
    color: var(--color-primary-500);
    text-shadow: 0 0 10px var(--color-accent-500);
    z-index: 2;
    pointer-events: none;
    margin-bottom: 4rem;
    opacity: 1;
    transform: none;
}
.hero__description-container {
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.5s, transform 0.5s;
    transform: translateY(40px);
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;
    background: none;
    position: relative;
    top: 0;
    left: 0;
    height: auto;
}
.hero__description-container.is-active {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0);
}
.ct {
    display: inline-block;
    min-width: 60vw;;
    padding-left: 10vw;

    
}
.hero__description {
    font-size: 2.5rem;
    color: var(--color-secondary-200);
    display: inline-block;
    white-space: pre-wrap;
    margin: 0 auto;
    background: none;
}
.spane {
    width: 100vw;
    height:60vh;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    position: relative;
    z-index: 3;
}
.pane.an {
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap;
    width: 100vw;
    position: sticky;
    top: 30vh; /* Adjust as needed */
    background: var(--color-base-800, #181818);
    z-index: 2;
    padding: 2rem 0;
    margin-bottom: 8vh;
    scroll-behavior: smooth;
    border-radius: 1rem;
    box-shadow: 0 2px 24px 0 rgba(0, 0, 0, 0.12);
}
.content {
    position: relative;
    margin: 0 auto -5rem;
    padding: 3rem;
    border-bottom: 2px solid var(--color-accent-500);
    background-color: var(--color-base-800);
}
.content::before {
    content: "";
    display: block;
    position: absolute;
    top: -100px;
    left: 0;
    width: 100%;
    height: 100px;
    background-color: var(--color-base-800);
    clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
}
.content__Inner {
    margin: 0 auto;
    max-width: 700px;
}
.content__inner > * + * {
    margin-top: 1.5rem;
}
.content__title {
    font-size: 3rem;
    line-height: 1.25;
    letter-spacing: -0.125rem;
    text-align: center;
    color: var(--color-text-primary);
    margin-bottom: 2rem;
}
</style>
