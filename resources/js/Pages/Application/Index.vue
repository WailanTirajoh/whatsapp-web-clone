<script setup>
import { reactive, defineProps, toRefs } from 'vue'

import AppLayout from '@/Layouts/AppLayout.vue';
import TailRight from '@/Jetstream/Components/Chat/TailRight.vue';
import TailLeft from '@/Jetstream/Components/Chat/TailLeft.vue';

const props = defineProps({
    rooms: Object,
});

const rooms = reactive(props.rooms.data);
const chats = reactive([]);
</script>

<template>
    <AppLayout title="Dashboard">
        <template #rooms>
            <!-- Search -->
            <div class="search p-2 border-b border-gray-200 flex items-center">
                <input type="text"
                    class="w-full border-gray-100 rounded-lg bg-gray-100 focus:outline-none focus:ring-0 focus:border-transparent"
                    placeholder="Cari atau mulai chat baru">
            </div>
            <!-- Search -->
            <!-- Body -->
            <div class="body overflow-auto overflow-x-hidden">
                <div class="transition-all ease-in-out duration-200 py-4 px-2 flex gap-4 hover:bg-gray-100 relative border-b border-gray-100 hover:cursor-pointer"
                    v-for="room in rooms" :key="room.id">
                    <div class="w-14 grid items-center justify-center">
                        <img :src="room.profile_picture" class="h-14 w-14 object-cover rounded-full">
                    </div>
                    <div class="flex items-center">
                        <div class="pr-3 overflow-hidden">
                            <div class="text-lg">
                                {{ room.name }}
                            </div>
                            <div class="flex">
                                <div class="">
                                    <!-- Icon -->
                                </div>
                                <div class="whitespace-nowrap text-ellipsis overflow-hidden text-gray-500">
                                    {{ room.last_message.message }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4">
                        <div class="text-gray-500">
                            {{ room.last_message.created_at }}
                        </div>
                        <div class="">
                            <!-- ICON if pinned -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Body -->
        </template>
        <template #chatHeader>
            <div class="flex items-center gap-4">
                <div class="">
                    <img src="/dummy/profile-picture.jpeg" class="h-12 w-12 object-cover rounded-full">
                </div>
                <div class="">
                    <div class="text-2xl text-gray-600">
                        Babyboss
                    </div>
                </div>
            </div>
            <div class="flex gap-2">
                <!-- Status -->

                <!-- End Status -->
                <!-- New Chat -->
                <div
                    class="w-10 h-10 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                    <i class="fa-solid text-gray-500 fa-magnifying-glass"></i>
                </div>
                <!-- End New Chat -->
                <!-- Menu -->
                <div
                    class="w-10 h-10 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                    <i class="fa-solid text-gray-500 fa-ellipsis-vertical"></i>
                </div>
                <!-- End Menu -->
            </div>
        </template>
        <template #chat>
            <div class="w-full max-h-full pb-8" v-if="chats.length > 0">
                <!-- Other People -->
                <div class="flex justify-start">
                    <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                        <div class="absolute top-0 -left-2 text-white">
                            <TailLeft />
                        </div>
                        Hari ini di traktir lagi Hari ini di traktir lagi Hari ini di traktir lagi Hari ini di
                        traktir lagi Hari ini di traktir lagi Hari ini di traktir lagi
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:45
                        </div>
                    </div>
                </div>
                <!-- End Other People -->

                <!-- Me -->
                <div class="flex justify-end">
                    <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                        <div class="absolute top-0 -right-2 text-green-200">
                            <TailRight />
                        </div>
                        Wih iyo eh
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:47
                        </div>
                    </div>
                </div>

                <!-- End Me -->
                <!-- Other People -->
                <div class="flex justify-start">
                    <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                        <div class="absolute top-0 -left-2 text-white">
                            <TailLeft />
                        </div>
                        Hari ini di traktir lagi
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:45
                        </div>
                    </div>
                </div>
                <!-- End Other People -->

                <!-- Me -->
                <div class="flex justify-end">
                    <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                        <div class="absolute top-0 -right-2 text-green-200">
                            <TailRight />
                        </div>
                        Wih iyo eh
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:47
                        </div>
                    </div>
                </div>

                <!-- End Me -->
                <!-- Other People -->
                <div class="flex justify-start">
                    <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                        <div class="absolute top-0 -left-2 text-white">
                            <TailLeft />
                        </div>
                        Hari ini di traktir lagi
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:45
                        </div>
                    </div>
                </div>
                <!-- End Other People -->

                <!-- Me -->
                <div class="flex justify-end">
                    <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                        <div class="absolute top-0 -right-2 text-green-200">
                            <TailRight />
                        </div>
                        Wih iyo eh
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:47
                        </div>
                    </div>
                </div>

                <!-- End Me -->
                <!-- Other People -->
                <div class="flex justify-start">
                    <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                        <div class="absolute top-0 -left-2 text-white">
                            <TailLeft />
                        </div>
                        Hari ini di traktir lagi
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:45
                        </div>
                    </div>
                </div>
                <!-- End Other People -->

                <!-- Me -->
                <div class="flex justify-end">
                    <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                        <div class="absolute top-0 -right-2 text-green-200">
                            <TailRight />
                        </div>
                        Wih iyo eh
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:47
                        </div>
                    </div>
                </div>

                <!-- End Me -->
                <!-- Other People -->
                <div class="flex justify-start">
                    <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                        <div class="absolute top-0 -left-2 text-white">
                            <TailLeft />
                        </div>
                        Hari ini di traktir lagi
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:45
                        </div>
                    </div>
                </div>
                <!-- End Other People -->

                <!-- Me -->
                <div class="flex justify-end">
                    <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                        <div class="absolute top-0 -right-2 text-green-200">
                            <TailRight />
                        </div>
                        Wih iyo eh
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:47
                        </div>
                    </div>
                </div>

                <!-- End Me -->
                <!-- Other People -->
                <div class="flex justify-start">
                    <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                        <div class="absolute top-0 -left-2 text-white">
                            <TailLeft />
                        </div>
                        Hari ini di traktir lagi
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:45
                        </div>
                    </div>
                </div>
                <!-- End Other People -->

                <!-- Me -->
                <div class="flex justify-end">
                    <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                        <div class="absolute top-0 -right-2 text-green-200">
                            <TailRight />
                        </div>
                        Wih iyo eh
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:47
                        </div>
                    </div>
                </div>

                <!-- End Me -->
                <!-- Other People -->
                <div class="flex justify-start">
                    <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                        <div class="absolute top-0 -left-2 text-white">
                            <TailLeft />
                        </div>
                        Hari ini di traktir lagi
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:45
                        </div>
                    </div>
                </div>
                <!-- End Other People -->

                <!-- Me -->
                <div class="flex justify-end">
                    <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                        <div class="absolute top-0 -right-2 text-green-200">
                            <TailRight />
                        </div>
                        Wih iyo eh
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:47
                        </div>
                    </div>
                </div>

                <!-- End Me -->
                <!-- Other People -->
                <div class="flex justify-start">
                    <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                        <div class="absolute top-0 -left-2 text-white">
                            <TailLeft />
                        </div>
                        Hari ini di traktir lagi
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:45
                        </div>
                    </div>
                </div>
                <!-- End Other People -->

                <!-- Me -->
                <div class="flex justify-end">
                    <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                        <div class="absolute top-0 -right-2 text-green-200">
                            <TailRight />
                        </div>
                        Wih iyo eh
                        <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                            12:47
                        </div>
                    </div>
                </div>

                <!-- End Me -->
            </div>
            <div class="w-full max-h-full pb-2 flex items-center justify-center">
                <div class="bg-gray-100 rounded shadow-sm p-2 w-32 text-center">
                    No message
                </div>
            </div>
        </template>
        <template #chatInput>
            <div class="w-11/12 flex">
                <!-- Start Icon -->
                <div class="flex items-center gap-3 justify-center px-6">
                    <div
                        class="w-16 h-16 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                        <i class="fa-solid text-gray-500 fa-face-smile fa-2xl"></i>
                    </div>
                    <div
                        class="w-16 h-16 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                        <i class="fa-solid text-gray-500 fa-paperclip fa-2xl"></i>
                    </div>
                </div>
                <!-- End Icon -->
                <div class="flex items-center w-full">
                    <textarea @keydown.enter="sendMessage($event)" type="text"
                        class="w-full border-gray-100 rounded-lg bg-white focus:outline-none focus:ring-0 focus:border-transparent text-2xl p-4 resize-none"
                        placeholder="Ketik Pesan" rows="1"></textarea>
                </div>
            </div>
            <!-- Voice Note -->
            <div class="w-1/12 flex items-center justify-center">
                <div
                    class="w-16 h-16 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                    <i class="fa-solid text-gray-500 fa-microphone fa-2xl"></i>
                </div>
            </div>
            <!-- End Voice Note -->
        </template>
    </AppLayout>
</template>
