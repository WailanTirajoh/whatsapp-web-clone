<script setup>
import { Inertia } from '@inertiajs/inertia';
import { Head } from '@inertiajs/inertia-vue3';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';

defineProps({
    title: String,
});

const logout = () => {
    Inertia.post(route('logout'));
};
</script>

<template>
    <div class="bg-gray-200 h-screen p-0">

        <Head :title="title" />
        <div class="grid grid-cols-12 h-full">
            <aside class="col-span-5 md:col-span-4 lg:col-span-3 xl:col-span-3 bg-white border-r">
                <!-- Room List Header -->
                <div class="bg-gray-100 flex p-5 items-center justify-between header">
                    <div>
                        <img :src="$page.props.user.profile_photo_url"
                            class="h-12 w-12 object-cover rounded-full border">
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

                                <JetDropdownLink :href="route('application')">
                                    New Chat
                                </JetDropdownLink>
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
                <!-- End Room List Header -->
                <slot name="rooms" />
            </aside>
            <div class="col-span-7 md:col-span-8 lg:col-span-9 xl:col-span-9">
                <header class="bg-gray-100 flex items-center p-4 justify-between">
                    <slot name="chatHeader" />
                </header>
                <!-- Page Content -->
                <main class="py-4 overflow-y-auto overflow-x-hidden px-32 flex items-end pb-8">
                    <slot name="chat" />
                </main>
                <div class="chat bg-gray-100 flex">
                    <slot name="chatInput" />
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
$headerHeight: 4.5rem;
$chatHeight: 6rem;

aside {
    .header {
        height: $headerHeight;
    }

    .search {
        height: 4rem;
    }

    .body {
        height: calc(100vh - ($headerHeight + 4rem));

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
    height: $headerHeight;
}

main {
    height: calc(100vh - ($headerHeight + $chatHeight));
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
    height: $chatHeight;
}
</style>
