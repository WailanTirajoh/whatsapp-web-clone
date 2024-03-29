<script setup>
import { reactive, defineProps, toRefs, onMounted, onUnmounted } from 'vue'

import AppLayout from '@/Layouts/AppLayout.vue';
import TailRight from '@/Jetstream/Components/Chat/TailRight.vue';
import TailLeft from '@/Jetstream/Components/Chat/TailLeft.vue';
import LoaderDot from '@/Jetstream/Components/Loader/Dot.vue';
import JetDialogModal from '@/Jetstream/DialogModal.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';
import JetInput from '@/Jetstream/Input.vue';
import Toast from '@/Jetstream/Components/System/Toast.vue';

import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';

const user = usePage().props.value.user

let sections = {};
onMounted(() => {
    Echo.private(`user.${user.id}`)
        .subscribed(() => {
        })
        .listen('.receive-message', (event) => {
            let roomIndex = rooms.data.findIndex((room => room.id == event.room.id));
            rooms.data[roomIndex] = event.room
        })
    var i = 0;
    const mainView = document.querySelector("#main")
    let theText = ''
    mainView.onscroll = function () {
        var scrollPosition = mainView.scrollTop;
        let newArr = []
        for (i in sections) {
            if (sections[i] + 30 <= scrollPosition) {
                newArr.push(i)
            }
        }
        if (newArr.length > 0) {
            let viewedDiv = newArr[newArr.length - 1]
            if (document.querySelector(`#${viewedDiv} .text`)) {
                if (theText != document.querySelector(`#${viewedDiv} .text`).textContent) {
                    theText = document.querySelector(`#${viewedDiv} .text`).textContent
                    if (document.getElementById('curdate')) {
                        document.getElementById('curdate').innerHTML = theText
                    }
                }
            }
        }
    };
})


const app = reactive({
    title: 'Dashboard'
})

const setTitle = (newTitle) => {
    app.title = newTitle
}

const toast = reactive({
    show: false,
    message: "",
    type: "error",
})

const showToast = ({ message, type }) => {
    toast.show = true;
    toast.message = message;
    toast.type = type;
    hideToast();
}

const hideToast = async () => {
    await wait(5000);
    toast.show = false;
    toast.message = "";
    toast.type = "success";
}

const wait = (timeout) => {
    return new Promise((resolve) => {
        setTimeout(resolve, timeout);
    });
}

const props = defineProps({
    rooms: Object,
});

const rooms = reactive({
    data: props.rooms.data
});

const selectedRoom = reactive({
    profile_picture: null,
    name: null,
    id: null,
    messages: [],
    isChangingRoom: false,
    form: {
        message: null,
        isProcessing: false
    }
})

const changeRoom = async (room) => {
    selectRoom(room)
    setTitle(room.name)
    selectedRoom.isChangingRoom = true
    selectedRoom.messages = []
    try {
        const response = await axios.get(`/rooms/${room.id}/messages`)
        if (response.data.messages) {
            selectedRoom.messages = response.data.messages
        }
    } catch (e) {
        if (e.response && e.response.data && e.response.data.errors) {
            // Handle error
        }
    } finally {
        selectedRoom.isChangingRoom = false
        scrollToBottomOfChat()
        await new Promise((resolve) => setTimeout(resolve, 1))

        const section = document.querySelectorAll("main .dates");
        const m = document.querySelector("main")
        Array.prototype.forEach.call(section, function (e) {
            sections[e.id] = e.offsetTop - m.offsetTop;
        });
    }
}

const scrollToBottomOfChat = async () => {
    await new Promise((resolve) => setTimeout(resolve, 0.3))
    var objDiv = document.getElementById("main");
    objDiv.scrollTop = objDiv.scrollHeight;
}

const resetRoom = () => {
    selectedRoom.profile_picture = null
    selectedRoom.name = null
    selectedRoom.id = null
}

const selectRoom = (room) => {
    if (selectedRoom.id) {
        Echo.leave(`room.message.${selectedRoom.id}`)
    }

    selectedRoom.id = room.id
    selectedRoom.profile_picture = room.profile_picture
    selectedRoom.name = room.name

    Echo.private(`room.message.${selectedRoom.id}`)
        .subscribed(() => {
        })
        .listen('.send-message', (event) => {
            selectedRoom.messages.push(event.message)
            scrollToBottomOfChat()
        })
}

const sendMessage = async (e) => {
    if (e.keyCode == 13 && e.shiftKey) {
        return
    }
    const message = selectedRoom.form.message
    const messageWithoutNewLine = message ? message.replace(/\n/g, "") : null;
    if (messageWithoutNewLine == null || messageWithoutNewLine == '') {
        e.preventDefault();
        return
    }

    const id = Math.floor(Math.random() * 100000)
    selectedRoom.form.isProcessing = true
    selectedRoom.form.message = null
    const newMessage = {
        id: id,
        created_at: "mengirim...",
        message: message,
        user_id: Inertia.page.props.user.id,
        user_name: Inertia.page.props.user.name,
        reads: [],
    }
    selectedRoom.messages.push(newMessage)
    scrollToBottomOfChat()
    try {
        const response = await axios.post(`/rooms/${selectedRoom.id}/messages`, {
            'message': message
        })
        if (response) {
            const index = selectedRoom.messages.findIndex(message => message.id === id)
            selectedRoom.messages[index] = response.data.data.message
        }
    } catch (e) {
        const index = selectedRoom.messages.findIndex(message => message.id === id)
        selectedRoom.messages[index] = {
            id: id,
            created_at: "Gagal",
            message: message,
            user_id: Inertia.page.props.user.id,
            user_name: Inertia.page.props.user.name,
        }
        errorHandler(e)
    } finally {
        selectedRoom.form.isProcessing = false

    }
}

const logout = () => {
    Inertia.post(route('logout'));
};

const newChat = reactive({
    showModal: false,
    email: '',
    isProcessing: false,
})

const openModal = () => {
    newChat.showModal = true
}

const closeModal = () => {
    newChat.showModal = false
}

const findUsersByEmail = async () => {
    if (newChat.email == null || newChat.email == '') return

    newChat.isProcessing = true
    try {
        const response = await axios.get(`/new-chat/get-users-by-email`, {
            params: {
                email: newChat.email
            }
        })
        showToast({ message: response.data.message, type: "success" });
        closeModal()
        const userRoomsResponse = await getUserRooms()
        if (userRoomsResponse) {
            rooms.data = userRoomsResponse.data.data
            email = ''
        }
    } catch (e) {
        errorHandler(e)
    } finally {
        newChat.isProcessing = false
    }
}

const errorHandler = (e) => {
    if (e.response && e.response.data.message) {
        return showToast({ message: e.response.data.message, type: "error" });
    }
    return showToast({ message: e.message, type: "error" });
}

const getUserRooms = async () => {
    try {
        const response = await axios.get(`/`, {
            params: {
                type: 'getUserRooms',
                params: null,
            }
        })
        return response
    } catch (e) {
        errorHandler(e)
    }
}

const checkMessageRead = (messageReads) => {
    return messageReads.filter((read) => {
        return read.user_id != Inertia.page.props.user.id
    }).length > 0
}

const checkIndex = (index) => {
    if (index === selectedRoom.messages.length - 1) scrollToBottomOfChat()
}
</script>

<template>
    <AppLayout :title="app.title">
        <template #roomHeader>
            <Toast :message="toast.message" :is-shown="toast.show" :type="toast.type" />
            <div class="bg-gray-100 flex p-5 items-center justify-between header">
                <div>
                    <img :src="$page.props.user.profile_photo_url" class="h-12 w-12 object-cover rounded-full border">
                </div>
                <div class="flex gap-2">
                    <!-- Status -->

                    <!-- End Status -->
                    <!-- New Chat -->
                    <JetDropdown align="right" width="48">
                        <template #trigger>
                            <div
                                class="w-10 h-10 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300 cursor-pointer">
                                <i class="fa-solid text-gray-500 fa-message"></i>
                            </div>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Chat
                            </div>
                            <div class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition cursor-pointer"
                                @click="openModal">
                                New Chat
                            </div>
                            <JetDialogModal :show="newChat.showModal" @close="closeModal">
                                <template #title>
                                    Find people you know
                                </template>

                                <template #content>
                                    Please type your friends email address to connect with

                                    <div class="mt-4">
                                        <JetInput ref="emailInput" v-model="newChat.email" type="email"
                                            class="mt-1 block w-3/4 transition-all ease-in-out duration-200"
                                            placeholder="Find by email" :class="{
                                                'bg-gray-200': newChat.isProcessing
                                            }" @keyup.enter="findUsersByEmail" :disabled="newChat.isProcessing" />
                                    </div>
                                </template>

                                <template #footer>
                                    <JetSecondaryButton @click="closeModal">
                                        Cancel
                                    </JetSecondaryButton>
                                </template>
                            </JetDialogModal>
                        </template>
                    </JetDropdown>


                    <!-- End New Chat -->
                    <!-- Menu -->
                    <JetDropdown align="right" width="48">
                        <template #trigger>
                            <div
                                class="w-10 h-10 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300 cursor-pointer">
                                <i class="fa-solid text-gray-500 fa-ellipsis-vertical"></i>
                            </div>
                        </template>

                        <template #content>
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                System
                            </div>

                            <form @submit.prevent="logout">
                                <JetDropdownLink as="button">
                                    Log Out
                                </JetDropdownLink>
                            </form>
                        </template>
                    </JetDropdown>
                    <!-- End Menu -->
                </div>
            </div>
        </template>
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
                        'bg-gray-100': room.id === selectedRoom.id
                    }" v-for="room in rooms.data" :key="room.id" @click="changeRoom(room)">
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
                                    {{ room.last_message?.message }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4">
                        <div class="text-gray-500">
                            {{ room.last_message?.created_at }}
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
            <div class="w-full h-full grid content-center" v-if="selectedRoom.isChangingRoom">
                <div class="flex justify-center">
                    <!-- <div class="bg-white rounded shadow-xl p-2"> -->
                    <LoaderDot class=" w-24 h-2w-24" />
                    <!-- </div> -->
                </div>
            </div>
            <div ref="chatbody" class="w-full chat-body relative" v-else>
                <div class="grid w-full max-h-full pb-4 pt-12 gap-x-4 gap-y-1" v-if="selectedRoom.messages.length > 0">
                    <div class="sticky top-0 flex justify-center z-10">
                        <div id="curdate" class="p-2 bg-gray-50 shadow-sm rounded-lg">
                        </div>
                    </div>
                    <!-- Other People -->
                    <div class="" v-for="message, index in selectedRoom.messages" :key="message.id">
                        <div :id="`dates_${index}`" class="flex justify-center dates"
                            v-if="(index == 0 || moment(selectedRoom.messages[index - 1].created_at).format('DD') != moment(message.created_at).format('DD') && moment(message.created_at).isValid())">
                            <div class="p-2 bg-gray-50 shadow-sm rounded-lg text">
                                {{ moment(message.created_at).calendar({
                                        sameDay: '[Today]',
                                        nextDay: '[Tomorrow]',
                                        nextWeek: 'dddd',
                                        lastDay: '[Yesterday]',
                                        lastWeek: '[Last] dddd',
                                        sameElse: 'DD/MM/YYYY'
                                    })
                                }}
                            </div>
                        </div>
                        <div class="flex justify-start" v-if="$page.props.user.id != message.user_id">
                            <div class="bg-white rounded-xl p-3 pr-16 pb-4 relative shadow max-w-sm " :class="{
                                'rounded-tl-none': index == 0 || selectedRoom.messages[index - 1].user_id != message.user_id
                            }">
                                <div class="absolute top-0 -left-2 text-white"
                                    v-if="index == 0 || selectedRoom.messages[index - 1].user_id != message.user_id">
                                    <TailLeft />
                                </div>
                                {{ message.message }}
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    {{ moment(message.created_at).isValid()
                                            ? moment(message.created_at).format('HH.mm')
                                            : message.created_at
                                    }}
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end" v-else>
                            <div class="bg-green-200 rounded-xl p-3 pr-16 pb-6 relative shadow max-w-sm" :class="{
                                'rounded-tr-none': index == 0 || selectedRoom.messages[index - 1].user_id != message.user_id
                            }">
                                <div class="absolute top-0 -right-2 text-green-200"
                                    v-if="index == 0 || selectedRoom.messages[index - 1].user_id != message.user_id">
                                    <TailRight />
                                </div>
                                {{ message.message }}
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    <div class="flex gap-x-2">
                                        <div class="">
                                            {{ moment(message.created_at).isValid()
                                                    ? moment(message.created_at).format('HH.mm')
                                                    : message.created_at
                                            }}
                                        </div>
                                        <div class="w-3 text-right">
                                            <JetDropdown align="right" width="48">
                                                <template #trigger>
                                                    <div class="transition-all ease-in-out duration-300 cursor-pointer w-2"
                                                        @click="checkIndex(index)">
                                                        <i class="fa-solid " :class="{
                                                            'fa-check-double text-blue-400': checkMessageRead(message.reads),
                                                            'fa-check text-gray-500': !checkMessageRead(message.reads),
                                                            'fa-clock text-gray-500': !moment(message.created_at).isValid(),
                                                        }"></i>
                                                    </div>
                                                </template>

                                                <template #content>
                                                    <!-- Account Management -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        Dibaca oleh:
                                                    </div>

                                                    <JetDropdownLink as="button" v-for="read in message.reads"
                                                        :key="read.id">
                                                        <div class="flex items-center gap-x-2">
                                                            <div class="flex items-center">
                                                                <img :src="read.user.profile_photo_url"
                                                                    class="h-6 w-6 object-cover rounded-full border">
                                                            </div>
                                                            <div class="flext items-center">
                                                                <div class="">
                                                                    {{ read.user.name }}
                                                                </div>
                                                                <div class="text-xs text-gray-600">
                                                                    {{ moment(read.read_at).calendar() }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </JetDropdownLink>
                                                </template>
                                            </JetDropdown>
                                        </div>
                                    </div>
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
                    <input v-model="selectedRoom.form.message" @keydown.enter="sendMessage($event)" type="text"
                        class="w-full border-gray-100 rounded-lg bg-white focus:outline-none focus:ring-0 focus:border-transparent text-2xl p-4 resize-none transition-all ease-in-out duration-300"
                        :class="{
                            'bg-gray-200': selectedRoom.id == null || selectedRoom.isChangingRoom
                        }" placeholder="Ketik pesan" rows="1"
                        :disabled="selectedRoom.id == null || selectedRoom.isChangingRoom" />
                    <!-- <textarea v-model="selectedRoom.form.message" @keydown.enter="sendMessage($event)" type="text"
                        class="w-full border-gray-100 rounded-lg bg-white focus:outline-none focus:ring-0 focus:border-transparent text-2xl p-4 resize-none transition-all ease-in-out duration-300"
                        :class="{
                            'bg-gray-200': selectedRoom.id == null || selectedRoom.isChangingRoom
                        }" placeholder="Ketik pesan" rows="1"
                        :disabled="selectedRoom.id == null || selectedRoom.isChangingRoom"></textarea> -->
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
