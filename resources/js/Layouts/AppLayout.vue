<script setup>
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    title: String,
});
</script>

<template>
    <div class="bg-gray-200 h-screen p-0">

        <Head :title="title" />
        <div class="grid grid-cols-12 h-full">
            <aside class="col-span-5 md:col-span-4 lg:col-span-3 xl:col-span-3 bg-white border-r">
                <!-- Room List Header -->
                <slot name="roomHeader" />
                <!-- End Room List Header -->
                <slot name="rooms" />
            </aside>
            <div class="col-span-7 md:col-span-8 lg:col-span-9 xl:col-span-9">
                <header class="bg-gray-100 flex items-center p-4 justify-between">
                    <slot name="chatHeader" />
                </header>
                <!-- Page Content -->
                <main id="main" class="py-4 overflow-y-auto overflow-x-hidden px-32 flex items-end pb-8 scroll-smooth relative">
                    <slot name="chat" />
                </main>
                <div class="chat bg-gray-100 flex">
                    <slot name="chatInput" />
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
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

    .chat-body {
        max-height: calc(100vh - ($headerHeight + $chatHeight));
    }

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
