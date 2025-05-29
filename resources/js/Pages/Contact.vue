<script setup lang="ts">

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import WordList from '../Components/Theme/UI/WordList.vue';
import IconButton from '../Components/Theme/UI/IconButton.vue';

import Default from '../Layouts/Default.vue';
const form = useForm({
   first_name: '',
    last_name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
});
const submit = () => {
    form.post(route('contact'), {
        onFinish: () => {
            form.reset('message');
        },
    });
};
const words = [
  "joy",
  "happiness",
  "success",
  "challenge",
  "move",
  "change",
  "grow",
  "experience",
  "self",
  "journey",
  "sustainable"]
</script>

<template>
   <Head title="Contact Us" />
    <Default>
    <WordList :words="words" />
  <div class="bg-transparent flex items-center justify-center mx-auto w-full max-w-6xl">
   <form @submit.prevent="submit" class="mt-10 bg-[var(--color-primary-900)] px-20  text-lg flex align-center justify-center border-2 border-[var(--color-accent-500)] rounded-lg shadow-lg">
   <div class="flex flex-row justify-content-center">
   <div class="flex flex-col">
   <h1 class="text-[var(--color-text-primary)] text-5xl text-center pt-4 mb-6">Contact Us</h1>
<div class="flex flex-row gap-4 mt-4 mb-3">
<div class="flex flex-col">
   <label for="first_name" class="text-[var(--color-text-primary)] ">First Name</label>
   <input type="text" id="first_name" v-model="form.first_name" class=" col-span-1 border-2 border-[var(--color-accent-500)]" />
</div>
<div class="flex flex-col">
   <label for="last_name" class="text-[var(--color-text-primary)]">Last Name</label>
   <input type="text" id="last_name" v-model="form.last_name" class="border-2 border-[var(--color-accent-500)]" />
</div>
</div>
<div class="flex flex-row gap-4 mb-3">
    <div class="flex flex-col">
   <label for="email" class="text-[var(--color-text-primary)]">Email</label>
   <input type="email" id="email" v-model="form.email" class="border-2 border-[var(--color-accent-500)]" />
</div>
<div class="flex flex-col">
   <label for="phone" class="text-[var(--color-text-primary)]">Phone</label>
   <input type="tel" id="phone" v-model="form.phone" class="border-2 border-[var(--color-accent-500)]" />
</div>
</div>
<label for ="subject" class="text-[var(--color-text-primary)]">Subject</label>
<input type="text" id="subject" v-model="form.subject" class="border-2 border-[var(--color-accent-500)]" />

   <label for="message" class="text-[var(--color-text-primary)]">Message</label>
   <textarea id="message" v-model="form.message" class="border-2 border-[var(--color-accent-500)]"></textarea>
   <IconButton type="submit" class="mt-6 mb-10 p-2 bg-[var(--color-accent-500)] text-[var(--color-text-primary )] hover:text-[var(--color-accent-500)] hover:border-4 hover:border-[var(--color-accent-500)] rounded-lg]">Submit</IconButton>
   <InputError :message="form.errors.message" class="mt-2" />
   </div>
   </div>    
   </form>

  </div>
</Default>
</template>