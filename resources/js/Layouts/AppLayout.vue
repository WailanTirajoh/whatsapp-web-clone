<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    Inertia.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div class="bg-gray-200 h-screen p-0">

        <Head :title="title" />
        <div class="grid grid-cols-10 h-full">
            <aside class="col-span-5 md:col-span-4 lg:col-span-3 xl:col-span-2 bg-white border-r">
                <!-- Header -->
                <div class="bg-gray-100 flex p-5 items-center justify-between header">
                    <div>
                        <img src="dummy/profile-picture.jpeg" class="h-14 w-14 object-cover rounded-full">
                    </div>
                    <div class="flex gap-2">
                        <!-- Status -->

                        <!-- End Status -->
                        <!-- New Chat -->
                        <div
                            class="w-10 h-10 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                            <i class="fa-solid text-gray-500 fa-message"></i>
                        </div>
                        <!-- End New Chat -->
                        <!-- Menu -->
                        <div
                            class="w-10 h-10 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                            <i class="fa-solid text-gray-500 fa-ellipsis-vertical"></i>
                        </div>
                        <!-- End Menu -->
                    </div>
                </div>
                <!-- End Header -->
                <!-- Search -->
                <div class="search p-2 border-b border-gray-200 flex items-center">
                    <input type="text"
                        class="w-full border-gray-100 rounded-lg bg-gray-100 focus:outline-none focus:ring-0 focus:border-transparent"
                        placeholder="Cari atau mulai chat baru">
                </div>
                <!-- Search -->
                <!-- Body -->
                <div class="body overflow-auto overflow-x-hidden">
                    <div
                        class="transition-all ease-in-out duration-200 py-4 px-2 flex gap-3 hover:bg-gray-100 relative border-b border-gray-100 hover:cursor-pointer">
                        <div class="w-16 grid items-center justify-center">
                            <img src="dummy/profile-picture.jpeg" class="h-16 w-16 object-cover rounded-full">
                        </div>
                        <div class="flex items-center w-full">
                            <div class="pr-3 overflow-hidden">
                                <div class="text-lg">
                                    Babyboss
                                </div>
                                <div class="flex">
                                    <div class="">
                                        <!-- Icon -->
                                    </div>
                                    <div class="whitespace-nowrap text-ellipsis overflow-hidden text-gray-500">
                                        wkwkwkwk emote apatuh sayang
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <div class="text-gray-500">
                                13.10
                            </div>
                            <div class="">
                                <!-- ICON if pinned -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Body -->
            </aside>
            <div class="col-span-5 md:col-span-6 lg:col-span-7 xl:col-span-8">
                <header class="bg-gray-100 flex items-center p-4 justify-between">
                    <!-- <slot name="header" /> -->
                    <div class="flex items-center gap-4">
                        <div class="">
                            <img src="dummy/profile-picture.jpeg" class="h-14 w-14 object-cover rounded-full">
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
                </header>
                <!-- Page Content -->
                <main class="py-4 overflow-y-auto overflow-x-hidden px-32 flex items-end pb-8">
                    <!-- <slot /> -->
                    <div class="w-full max-h-full pb-8">
                        <!-- Other People -->
                        <div class="flex justify-start">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -left-2 text-white">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13" fill="#0000000"
                                            d="M1.533 3.568 8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                                        <path fill="currentColor"
                                            d="M1.533 2.568 8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                                    </svg>
                                </div>
                                Hari ini di traktir lagi sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:45
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end">
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13"
                                            d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                        <path fill="currentColor"
                                            d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                                    </svg>
                                </div>
                                Wih iyo eh sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:47
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                        <!-- Other People -->
                        <div class="flex justify-start">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -left-2 text-white">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13" fill="#0000000"
                                            d="M1.533 3.568 8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                                        <path fill="currentColor"
                                            d="M1.533 2.568 8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                                    </svg>
                                </div>
                                Hari ini di traktir lagi sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:45
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end">
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13"
                                            d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                        <path fill="currentColor"
                                            d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                                    </svg>
                                </div>
                                Wih iyo eh sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:47
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                        <!-- Other People -->
                        <div class="flex justify-start">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -left-2 text-white">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13" fill="#0000000"
                                            d="M1.533 3.568 8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                                        <path fill="currentColor"
                                            d="M1.533 2.568 8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                                    </svg>
                                </div>
                                Hari ini di traktir lagi sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:45
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end">
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13"
                                            d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                        <path fill="currentColor"
                                            d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                                    </svg>
                                </div>
                                Wih iyo eh sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:47
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                        <!-- Other People -->
                        <div class="flex justify-start">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -left-2 text-white">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13" fill="#0000000"
                                            d="M1.533 3.568 8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                                        <path fill="currentColor"
                                            d="M1.533 2.568 8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                                    </svg>
                                </div>
                                Hari ini di traktir lagi sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:45
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end">
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13"
                                            d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                        <path fill="currentColor"
                                            d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                                    </svg>
                                </div>
                                Wih iyo eh sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:47
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                        <!-- Other People -->
                        <div class="flex justify-start">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -left-2 text-white">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13" fill="#0000000"
                                            d="M1.533 3.568 8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                                        <path fill="currentColor"
                                            d="M1.533 2.568 8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                                    </svg>
                                </div>
                                Hari ini di traktir lagi sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:45
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end">
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13"
                                            d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                        <path fill="currentColor"
                                            d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                                    </svg>
                                </div>
                                Wih iyo eh sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:47
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                        <!-- Other People -->
                        <div class="flex justify-start">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -left-2 text-white">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13" fill="#0000000"
                                            d="M1.533 3.568 8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                                        <path fill="currentColor"
                                            d="M1.533 2.568 8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                                    </svg>
                                </div>
                                Hari ini di traktir lagi sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:45
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end">
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13"
                                            d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                        <path fill="currentColor"
                                            d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                                    </svg>
                                </div>
                                Wih iyo eh sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:47
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                        <!-- Other People -->
                        <div class="flex justify-start">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -left-2 text-white">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13" fill="#0000000"
                                            d="M1.533 3.568 8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                                        <path fill="currentColor"
                                            d="M1.533 2.568 8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                                    </svg>
                                </div>
                                Hari ini di traktir lagi sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:45
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end">
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13"
                                            d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                        <path fill="currentColor"
                                            d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                                    </svg>
                                </div>
                                Wih iyo eh sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:47
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                        <!-- Other People -->
                        <div class="flex justify-start">
                            <div class="bg-white rounded-xl rounded-tl-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -left-2 text-white">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13" fill="#0000000"
                                            d="M1.533 3.568 8 12.193V1H2.812C1.042 1 .474 2.156 1.533 3.568z"></path>
                                        <path fill="currentColor"
                                            d="M1.533 2.568 8 11.193V0H2.812C1.042 0 .474 1.156 1.533 2.568z"></path>
                                    </svg>
                                </div>
                                Hari ini di traktir lagi sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:45
                                </div>
                            </div>
                        </div>
                        <!-- End Other People -->

                        <!-- Me -->
                        <div class="flex justify-end">
                            <div class="bg-green-200 rounded-xl rounded-tr-none p-3 pr-16 relative shadow">
                                <div class="absolute top-0 -right-2 text-green-200">
                                    <svg viewBox="0 0 8 13" width="8" height="13" class="">
                                        <path opacity=".13"
                                            d="M5.188 1H0v11.193l6.467-8.625C7.526 2.156 6.958 1 5.188 1z"></path>
                                        <path fill="currentColor"
                                            d="M5.188 0H0v11.193l6.467-8.625C7.526 1.156 6.958 0 5.188 0z"></path>
                                    </svg>
                                </div>
                                Wih iyo eh sayang
                                <div class="absolute bottom-2 right-2 text-xs text-gray-500">
                                    12:47
                                </div>
                            </div>
                        </div>

                        <!-- End Me -->
                    </div>
                </main>
                <div class="chat bg-gray-100 flex">
                    <!-- <slot name="chat" /> -->
                    <!-- Start Icon -->
                    <!-- End Icon -->
                    <div class="w-11/12 flex">
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
                        <div class="flex items-center w-full">
                            <textarea type="text"
                                class="w-full border-gray-100 rounded-lg bg-white focus:outline-none focus:ring-0 focus:border-transparent text-2xl p-4 resize-none"
                                placeholder="Ketik Pesan" rows="1"></textarea>
                        </div>
                    </div>
                    <div class="w-1/12 flex items-center justify-center">
                        <div
                            class="w-16 h-16 rounded-full grid place-items-center border-0 hover:border-2 transition-all ease-in-out duration-300">
                            <i class="fa-solid text-gray-500 fa-microphone fa-2xl"></i>
                        </div>
                    </div>
                    <!-- Voice Note -->
                    <!-- End Voice Note -->
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
aside {
    .header {
        height: 5rem;
    }

    .search {
        height: 4rem;
    }

    .body {
        height: calc(100vh - (5rem + 4rem));

        &::-webkit-scrollbar {
            width: 0.65rem;
            height: 0.1rem;
        }

        &::-webkit-scrollbar-track {
            display: none;
        }

        &::-webkit-scrollbar-thumb {
            transition: all .5s ease-in-out;
            background-color: #c4c2bd;
        }

        &::-webkit-scrollbar-thumb:hover {
            background-color: #c4c2bd;
        }
    }
}

header {
    height: 5rem;
}

main {
    height: calc(100vh - (5rem + 6rem));
    background-image: url("/default/room-bg.webp");
    overflow: auto;

    &::-webkit-scrollbar {
        width: 0.65rem;
        height: 0.1rem;
    }

    &::-webkit-scrollbar-track {
        display: none;
    }

    &::-webkit-scrollbar-thumb {
        transition: all .5s ease-in-out;
        background-color: #c4c2bd;
    }

    &::-webkit-scrollbar-thumb:hover {
        background-color: #c4c2bd;
    }
}

.chat {
    height: 6rem;
}
</style>
