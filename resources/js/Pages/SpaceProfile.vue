<script setup>
import GenericLayout from "@/Layouts/GenericLayout.vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { usePage } from "@inertiajs/vue3";
import { reactive, ref } from "vue";

let description = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
let space_name = 'Space Name';
let avatar = 'https://picsum.photos/200/300';
</script>

<template>
    <GenericLayout>
        <div class="space-sales-pitch">
        <!-- Profile Sale / Pitch Header (The follow it pitch) -->
            <img :src="avatar" :alt="space_name" class="space-avatar" />
            <div class="name">{{ space_name }}</div>
            <div class="gallery">

            </div>
            <div class="pinned-events">

            </div>
            <span id="follower-info">
                <span id="follower-image-mini-tile"></span>
                <span id="follower-friends-count">Followed by 3,000 & 199 Friends</span>
            </span>
            <div id="follow-buttons">
                <button id="follow-button" class="buttons">Follow</button>
                <button id="more-button" class="buttons">More</button>
                <button id="qr-button" class="buttons">More</button>
            </div>
            <div class="location-info"></div>
            <div class="description">{{ description }}</div>
            <div class="space-profile-call-out">
                <img src="" alt=""/>
                <span class="event-tile-title">Event Title</span>
                <span class="event-date">Event Date</span>
            </div>

            <!-- TODO: HOW CAN I CONDENSE ALL OF THIS-->
            <!-- Schedule -->
            <!-- Contact -->
            <!-- Gallery -->
        </div>
        <div id="page-footer">
            <div class="space-profile-call-out">
                <img src="" alt=""/>
                <span class="event-tile-title">Event Title</span>
                <span class="event-date">Event Date</span>
            </div>
            <div class="footer-icons">
                <img src="" alt="home" class="footer-icon"/>
                <img src="" alt="search" class="footer-icon"/>
                <img src="" alt="create" class="footer-icon"/>
                <img src="" alt="unknown" class="footer-icon"/>
                <img src="" alt="my-profile" class="footer-icon"/>
            </div>
        </div>
        <!-- Profile Main (The come and visit asap pitch) -->
            <!-- Events -->
                <!-- Soon/Now/Next/ in X hours/ tonight -->
                <!-- Past events -->
                <!-- Occupancy / how busy -->
                <!-- "Shouts" of news information etc -->
            <!-- Call out -->

    <div class="flex flex-col items-center justify-center min-h-screen py-2">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-6xl font-bold">
                Welcome to your profile space
            </h1>
            <p class="mt-3 text-2xl">
                This is your profile space. You can edit your profile here.
            </p>
        </div>
    </div>
    </GenericLayout>
</template>

<style scoped>

</style>
