<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import { ref, computed } from "vue";
import { usePage } from "@inertiajs/vue3";
const page = usePage();
// Reactive variable for the profile picture source
const profilePicSrc = ref("");
// Ref for the file input element
const fileUploadInput = ref(null);

const handleFileChange = (event) => {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = (e) => {
            profilePicSrc.value = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
};

const triggerFileUpload = () => {
    if (fileUploadInput.value) {
        fileUploadInput.value.click();
    }
};
const isMobileMenuOpen = ref(false); // Initially closed

// Method to toggle the menu state
const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};

const beltOrder = [
    "none",
    "white",
    "yellow",
    "orange",
    "green",
    "purple",
    "blue",
    "brown",
    "red",
    "red_black_stripe",
    "black",
];
const beltRequirements = {
    none: {
        time: "no time limit",
        poomsae: "First 8 moves of ITF Form Chon-Ji",
        stances: [
            "Joon-Be",
            "Walking Stance",
            "Front Stance",
            "Back Stance",
            "Fighting Stance",
        ],
        blocks: ["low", "middle", "high"],
        attacks: {
            punches: ["low", "middle", "high"],
        },
        combinations: ["#1"],
    },
    white: {
        time: "appx 3 months",
        poomsae: ["Taekwondo Form 1 – Il Jang", " ITF Form Chon-Ji"],
        sparringSelfDefense: [
            "Beginner 1 & 2 One Step Sparring",
            "Beginner Self-Defense 1 & 2",
        ],
        combinations: ["#1", "#2"],
        breaking: ["Stomping Kick", "Hammerfist"],
        knowledge: ["Poomsae name & meaning", "School Oath & Motto"],
    },
    yellow: {
        time: "appx 3 months",
        poomsae: ["Taekwondo Form 2 – Ee Jang ", "& ITF Form Dan-Gun"],
        sparringselfDefense: [
            "Beginner 3 & 4 One Step Sparring",
            "Beginner Self-Defense 3 & 4",
        ],

        combinations: ["#3", "#4"],
        breaking: ["Sidekick", " Reverse Elbow"],
        knowledge: [
            "Poomsae name & meaning",
            "Counting to 10 in Korean",
            "Basic classroom terms",
        ],
    },
    orange: {
        time: "appx 3 months",
        poomsae: ["Taekwondo Form 3 – Sam Jang ", " ITF Form Do-San"],
        sparringSelfDefense: [
            "Intermediate 1 & 2 One Step Sparring",
            "Intermediate Self-Defense 1 & 2",
        ],
        combinations: ["#5"],
        breaking: ["Front Snap Kick ", "Knife Hand"],
        knowledge: [
            "Poomsae name & meaning",
            "“What is Taekwondo?” page information",
        ],
    },
    green: {
        time: "appx 4-5 months",
        poomsae: ["Taekwondo Form 4 – Sa Jang", " ITF Won-Hyo"],
        sparringSelfDefense: [
            "Intermediate 3 & 4 One Step Sparring",
            "Intermediate Self-Defense 3 & 4",
        ],
        combinations: ["#6", "#7"],
        breaking: ["Back kick ", " Inside Knife Hand/Neck Chop"],
        knowledge: ["Poomsae name & meaning", "History of TKD"],
    },
    purple: {
        time: "appx 4-5 months",
        poomsae: ["Taekwondo Form 5 – Oh Jang", "ITF Yul-Gok"],
        sparringSelfDefense: [
            "Advanced 1 & 2 One Step Sparring",
            "Advanced Self-Defense 1 & 2",
        ],
        combinations: ["#8", "#9"],
        breaking: ["Roundhouse Kick ", "Front Elbow"],
        knowledge: [
            "Poomsae name & meaning",
            "Korean Flag",
            "Uniform",
            "Bowing and Ki-Yap explanation",
        ],
    },
    blue: {
        time: "appx 4-6 months",
        poomsae: ["Taekwondo Form 6 – Yuk Jang", " ITF Form Joong-Gun"],
        sparringSelfDefense: [
            "Advanced 3 & 4 One Step Sparring",
            "Advanced Self-Defense 3 & 4",
        ],
        combinations: ["#10a", "#10b"],
        breaking: ["Push kick ", " Palm Strike"],
        knowledge: ["Poomsae name & meaning", "Qualities to Develop in TKD"],
    },
    brown: {
        time: "appx 6-8 months",
        poomsae: ["Taekwondo Form 7 – Chil Jang ", " ITF Form Toi-Gye"],
        sparringSelfDefense: [
            "Proficiency 1 & 2 One Step Sparring",
            "Knife Self-Defense 1 & 2",
        ],
        combinations: ["#11", "#12"],
        breaking: ["Hook kick", "Straight Punch"],
        knowledge: ["Poomsae name & meaning", "10 Tenets of TKD"],
        assisting: "Assisting in at least 2 classes a month",
    },
    red: {
        time: "appx 6-8 months",
        poomsae: ["Taekwondo Form 8 – Pal Jang ", " ITF Form Hwa-Rang"],
        sparringSelfDefense: [
            "Proficiency 3 & 4 One Step Sparring",
            "Knife Self-Defense 3 & 4",
        ],
        combinations: ["#13"],
        breaking: ["Ax Kick ", " Back Fist"],
        knowledge: ["Poomsae name & meaning", "Manual Questions through 10"],
        assisting: "Assisting in at least 4 classes a month",
    },
    red_black_stripe: {
        time: "appx 6-9 months",
        notes: "Test for Black Belt",
        poomsae: "Koryo + all additional color belt Poomsae",
        sparringSelfDefense: ["All One-Steps", "All Self-Defense"],
        combinations: ["#1 through #13, both sides"],
        breaking: ["Creative break of 1 board each move, minimum 3 moves"],
        knowledge: [
            "Poomsae name & meaning (all)",
            "Manual Questions through 1-21",
            "History of TKD",
            "Tenets of TKD",
            "Philosophy of TKD - Written and Oral Test",
        ],
        paper: "min 1000 words",
        bookReport: "Book Report/Reading Assignment",
        recommendations: "2 letters of recommendation",
        communityService: "20 hours of community service",
        assisting: "Regular Assistance in classes (1x a week min)",
        preTest: "Dojang Cleanse & Mediation (1 hour)",
    },
};
// Safely compute currentBelt, convert to lowercase, and provide a default.
const currentBelt = computed(() => {
    // Use optional chaining to safely access profile and belt.
    // Convert to lowercase for consistent comparison with beltOrder.
    const belt = page.props.auth.user?.profile?.belt;
    return belt ? belt.toLowerCase() : "white"; // Default to 'white' if no belt or profile.
});

const currentBeltDetails = computed(() => {
    return beltRequirements[currentBelt.value] || {};
});

const getNextBelt = (belt) => {
    const currentIndex = beltOrder.indexOf(belt); // belt is now guaranteed to be lowercase from currentBelt
    if (currentIndex === -1 || currentIndex === beltOrder.length - 1) {
        return "black"; // If the current belt is not found or is the last one, return black
    }
    return beltOrder[currentIndex + 1];
};
const nextBelt = computed(() => getNextBelt(currentBelt.value));
</script>

<template>
    <AppLayout>
        <div
            class="border-1 shadow-lg shadow-[var(--color-base-900)] rounded-lg"
        >
            <!-- top content -->
            <div
                class="flex rounded-t-lg bg-gradient-to-b from-[var(--color-primary-900)] to-[var(--color-primary-800)] sm:px-2 w-full"
            >
                <div
                    class="h-40 w-40 overflow-hidden sm:rounded-full sm:relative sm:p-0 top-10 left-5 p-4"
                >
                    <img
                        :src="$page.props.auth.user.profile_photo_url"
                        alt="Profile Photo"
                        class="w-full h-full object-cover"
                    />
                </div>
                <div
                    class="w-2/3 sm:text-center pl-10 mt-10 text-start flex items-center"
                >
                    <p
                        class="font-bold text-[var(--color-text-primary)] text-heading sm:text-4xl text-2xl"
                    >
                        {{ $page.props.auth.user.name }}
                    </p>
                </div>
            </div>
            <!-- main content -->
            <div class="p-5">
                <div
                    class="grid grid-rows-2 grid-cols-1 sm:mt-10 "
                >
                    <!-- Current Belt Info -->
                    <div class="py-2 sm:order-none order-3">
                        <h2
                            class="text-[var(--color-text-primary)] text-2xl font-bold mb-4"
                        >
                            Current Belt
                        </h2>
                        <div
                            class="w-[100px] h-[25px] mb-6"
                            :style="{ backgroundColor: currentBelt }"
                        ></div>
                        <!-- Use computed currentBelt -->
                        <p
                            class="text-[var(--color-text-primary)] text-lg px-6 mb-2 capitalize"
                        >
                            <strong>{{ currentBelt.replace("_", " ") }}</strong>
                        </p>
                        <!-- Use computed currentBelt -->
                     
                    <div class="py-2 sm:order-none order-2 sm:w-1/3">
                        <h2
                            class="text-[var(--color-text-primary)] text-2xl font-bold mb-4"
                        >
                            Next Belt
                        </h2>
                        <div
                            class="w-[100px] h-[25px] mb-6"
                            :style="{ backgroundColor: nextBelt }"
                        ></div>
                        <!-- Use computed nextBelt -->
                        <p class="text-[var(--color-text-primary)] capitalize">
                        <strong>
						{{ nextBelt.replace("_", " ") }}
						</strong>    
                        </p>
                    </div>
                </div>

                <!-- Current Belt Requirements Checklist -->
                <div class="mt-10">
                    <h2
                        class="text-[var(--color-text-primary)] text-2xl font-bold mb-4"
                    >
                        Requirements for
                        {{ currentBelt.replace("_", " ") }} Belt
                    </h2>
                    <ul class="list-inside text-[var(--color-text-primary)]">
                        <li v-if="currentBeltDetails.time">
                            <strong class="capitalize">Time:</strong>
                            {{ currentBeltDetails.time }}
                        </li>
                        <li v-if="currentBeltDetails.notes">
                            <strong class="capitalize">Notes:</strong>
                            {{ currentBeltDetails.notes }}
                        </li>

                        <li v-if="currentBeltDetails.poomsae">
                            <strong class="capitalize">Poomsae:</strong>
                            <ul
                                v-if="Array.isArray(currentBeltDetails.poomsae)"
                                class="list-disc list-inside ml-4"
                            >
                                <li
                                    v-for="item in currentBeltDetails.poomsae"
                                    :key="item"
                                >
                                    {{ item }}
                                </li>
                            </ul>
                            <span v-else class="ml-2">{{
                                currentBeltDetails.poomsae
                            }}</span>
                        </li>

                        <template
                            v-if="
                                currentBeltDetails.stances &&
                                currentBeltDetails.stances.length
                            "
                        >
                            <li>
                                <strong>Stances:</strong>
                                <ul class="list-disc list-inside ml-4">
                                    <li
                                        v-for="stance in currentBeltDetails.stances"
                                        :key="stance"
                                    >
                                        {{ stance }}
                                    </li>
                                </ul>
                            </li>
                        </template>

                        <template
                            v-if="
                                currentBeltDetails.blocks &&
                                currentBeltDetails.blocks.length
                            "
                        >
                            <li>
                                <strong>Blocks:</strong>
                                <ul class="list-disc list-inside ml-4">
                                    <li
                                        v-for="block in currentBeltDetails.blocks"
                                        :key="block"
                                    >
                                        {{ block }}
                                    </li>
                                </ul>
                            </li>
                        </template>

                        <li
                            v-for="(items, category) in currentBeltDetails"
                            :key="category"
                        >
                            <template
                                v-if="
                                    ![
                                        'time',
                                        'notes',
                                        'poomsae',
                                        'stances',
                                        'blocks',
                                    ].includes(category)
                                "
                            >
                                <strong class="capitalize"
                                    >{{
                                        category
                                            .replace(/([A-Z])/g, " $1")
                                            .trim()
                                    }}:</strong
                                >
                                <template v-if="Array.isArray(items)">
                                    <ul class="list-disc list-inside ml-4">
                                        <li v-for="item in items" :key="item">
                                            {{ item }}
                                        </li>
                                    </ul>
                                </template>
                                <template
                                    v-else-if="
                                        typeof items === 'object' &&
                                        items !== null
                                    "
                                >
                                    <ul class="list-disc list-inside ml-4">
                                        <li
                                            v-for="(
                                                subItems, subCategory
                                            ) in items"
                                            :key="subCategory"
                                            class="capitalize"
                                        >
                                            {{
                                                subCategory
                                                    .replace(/([A-Z])/g, " $1")
                                                    .trim()
                                            }}:
                                            {{
                                                Array.isArray(subItems)
                                                    ? subItems.join(", ")
                                                    : subItems
                                            }}
                                        </li>
                                    </ul>
                                </template>
                                <span v-else> {{ items }}</span>
                            </template>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		</div>
    </AppLayout>
</template>
<style scoped>
.avatar-wrapper {
    position: relative;
    height: 200px;
    width: 200px;
    margin: 50px auto;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 1px 1px 15px -5px black;
    transition: all 0.3s ease;
    &:hover {
        transform: scale(1.05);
        cursor: pointer;
    }
    &:hover .profile-pic {
        opacity: 0.5;
    }
    .profile-pic {
        height: 100%;
        width: 100%;
        object-fit: cover; /* Ensures the image covers the area well */
        transition: all 0.3s ease;
        &:after {
            font-family: FontAwesome;
            content: "\f007";
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            position: absolute;
            font-size: 190px;
            background: #ecf0f1;
            color: #34495e;
            text-align: center;
        }
    }
    .upload-button {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        .fa-arrow-circle-up {
            position: absolute;
            font-size: 234px;
            top: -17px;
            left: 0;
            text-align: center;
            opacity: 0;
            transition: all 0.3s ease;
            color: #34495e;
        }
        &:hover .fa-arrow-circle-up {
            opacity: 0.9;
        }
    }
    /* Hide the actual file input */
    .file-upload {
        display: none;
    }
}
</style>
