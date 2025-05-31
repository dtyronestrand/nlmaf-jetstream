<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { ref } from 'vue';

// Reactive variable for the profile picture source
const profilePicSrc = ref('');
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
</script>


<template>
<AppLayout>

   <div class="border-1 shadow-lg shadow-[var(--color-base-900)] rounded-lg">
   <!-- top content -->
   <div class=" flex rounded-t-lg bg-gradient-to-b from-[var(--color-primary-900)] to-[var(--color-primary-800)] sm:px-2 w-full ">
      <div class="h-40 w-40 overflow-hidden sm:rounded-full sm:relative sm:p-0 top-10 left-5 p-4">
         <img :src="$page.props.auth.user.profile_photo_url" alt="Profile Photo" class="w-full h-full object-cover"/>
      </div>
      <div class=" w-2/3 sm:text-center pl-10 mt-10 text-start flex items-center">
         <p class="font-bold text-[var(--color-text-primary)] text-heading  sm:text-4xl text-2xl">{{ $page.props.auth.user.name }}</p>
      </div> 
   </div>
   <!-- main content -->
   <div class="p-5">
   <div class="flex flex-col sm:flex-row sm:mt-10">
   <div class="fle flex-col sm:w-1/3">
   <!-- Contact Info -->
   <div class="py-2 sm:order-none order-3">
 <h2 class="text-[var(--color-text-primary)] text-2xl font-bold mb-4">Contact Info</h2>
    <p class="text-[var(--color-text-primary)] mb-2"><strong>Email:</strong> {{ $page.props.auth.user.email }}</p>
    <p v-if="$page.props.auth.user.address" class="text-[var(--color-text-primary)] mb-2"><strong>Address:</strong> {{ $page.props.auth.user.address || 'Not provided' }}</p>
    <p v-if="$page.props.auth.user.city && $page.props.auth.user.state && $page.props.auth.user.zip" class="text-[var(--color-text-primary)] mb-2">{{ $page.props.auth.user.city }}, {{ $page.props.auth.user.state }} {{ $page.props.auth.user.zip }}</p>

   </div>
   </div>
   <div class="py-2 sm:order-none order-2">
   <h2 class="text-[var(--color-text-primary)] text-2xl font-bold mb-4"> Bio</h2>
    <p v-if="$page.props.auth.user.bio" class="text-[var(--color-text-primary)]">{{ $page.props.auth.user.bio}}</p>
   </div>
   </div>
   </div>
   </div>
   
   

 

</AppLayout>
</template>
<style scoped>
.avatar-wrapper{
	position: relative;
	height: 200px;
	width: 200px;
	margin: 50px auto;
	border-radius: 50%;
	overflow: hidden;
	box-shadow: 1px 1px 15px -5px black;
	transition: all .3s ease;
	&:hover{
		transform: scale(1.05);
		cursor: pointer;
	}
	&:hover .profile-pic{
		opacity: .5;
	}
	.profile-pic {
    height: 100%;
		width: 100%;
		object-fit: cover; /* Ensures the image covers the area well */
		transition: all .3s ease;
		&:after{
			font-family: FontAwesome;
			content: "\f007";
			top: 0; left: 0;
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
		top: 0; left: 0;
		height: 100%;
		width: 100%;
		.fa-arrow-circle-up{
			position: absolute;
			font-size: 234px;
			top: -17px;
			left: 0;
			text-align: center;
			opacity: 0;
			transition: all .3s ease;
			color: #34495e;
		}
		&:hover .fa-arrow-circle-up{
			opacity: .9;
		}
	}
	/* Hide the actual file input */
	.file-upload {
		display: none;
	}
}
</style>
