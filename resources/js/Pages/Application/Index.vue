<script setup>
import { reactive, defineProps, toRefs } from 'vue'

import AppLayout from '@/Layouts/AppLayout.vue';
import TailRight from '@/Jetstream/Components/Chat/TailRight.vue';
import TailLeft from '@/Jetstream/Components/Chat/TailLeft.vue';
import LoaderDot from '@/Jetstream/Components/Loader/Dot.vue';

const props = defineProps({
    rooms: Object,
});

const rooms = reactive(props.rooms.data);
const chat = reactive({
    messages: [],
    isProcessing: false,
});

const selectedRoom = reactive({
    profile_picture: null,
    name: null,
    room_id: null,
})

const changeRoom = async (room) => {
    resetRoom()
    chat.isProcessing = true
    chat.messages = []
    try {
        const response = await axios.get(`/rooms/${room.id}/messages`)
        if (response.data.messages) {
            chat.messages = response.data.messages
        }
    } catch (e) {
        if (e.response && e.response.data && e.response.data.errors) {
            // Handle error
        }
    } finally {
        chat.isProcessing = false
        selectRoom(room)
    }
}

const resetRoom = () => {
    selectedRoom.profile_picture = null
    selectedRoom.name = null
    selectedRoom.room_id = null
}

const selectRoom = (room) => {
    selectedRoom.profile_picture = room.profile_picture
    selectedRoom.name = room.name
    selectedRoom.room_id = room.id
}
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
                    :class="{
                        'bg-gray-100': room.id === selectedRoom.room_id
                    }" v-for="room in rooms" :key="room.id" @click="changeRoom(room)">
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
        <template #chatHeader v-if="selectedRoom.name">
            <div class="flex items-center gap-4">
                <div class="">
                    <img :src="selectedRoom.profile_picture" class="h-12 w-12 object-cover rounded-full">
                </div>
                <div class="">
                    <div class="text-xl text-gray-700">
                        {{ selectedRoom.name }}
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
            <div class="w-full h-full grid content-center" v-if="chat.isProcessing">
                <div class="flex justify-center">
                    <!-- <div class="bg-white rounded shadow-xl p-2"> -->
                    <LoaderDot class=" w-24 h-2w-24" />
                    <!-- </div> -->
                </div>
            </div>
            <div class="w-full" v-else>
                <div class="grid w-full max-h-full pb-2 gap-4" v-if="chat.messages.length > 0">
                    <!-- Other People -->
                    <div class="" v-for="message in chat.messages" :key="message.id">
                        <div class="flex justify-start" v-if="$page.props.user.id != message.user_id">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow max-w-sm ">
                                <div class="absolute top-0 -left-2 text-white">
                                    <TailLeft />
                                </div>
                                {{ message.message }}
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    {{ message.created_at }}
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end" v-else>
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow max-w-sm">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <TailRight />
                                </div>
                                {{ message.message }}
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    {{ message.created_at }}
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                    </div>
                </div>
                <div class="w-full max-h-full pb-2 flex items-center justify-center" v-else>
                    <div class="bg-gray-100 rounded shadow-sm p-2 w-32 text-center">
                        No message
                    </div>
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
                        class="w-full border-gray-100 rounded-lg bg-white focus:outline-none focus:ring-0 focus:border-transparent text-2xl p-4 resize-none transition-all ease-in-out duration-300"
                        :class="{
                            'bg-gray-200': selectedRoom.name == null
                        }" placeholder="Ketik pesan"
                        rows="1" :disabled="selectedRoom.name == null"></textarea>
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
